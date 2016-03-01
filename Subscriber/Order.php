<?php
/**
 * Order Subscriber.
 *
 * @author Bryan Folliot <bfolliot@clever-age.com>
 */

namespace Arii\JoeXmlConnectorBundle\Subscriber;

use Arii\JOEBundle\Event\Order as Event;
use Arii\JOEBundle\Entity\Order as Entity;
use Arii\JOEBundle\Event\JobCollection as EventCollection;
use Arii\JOEBundle\Service\Order as Service;
use Arii\JoeXmlConnectorBundle\Converter\EntityToXML;
use Arii\JoeXmlConnectorBundle\Converter\XMLToEntity;
use Aura\Payload_Interface\PayloadStatus;
use BFolliot\Filesystem\Path;
use DirectoryIterator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class Order implements EventSubscriberInterface
{
    protected $config;
    protected $fs;
    protected $service;
    protected $em;

    public function __construct($config, Service $service, $em)
    {
        $this->config  = $config;
        $this->fs      = new Filesystem;
        $this->service = $service;
        $this->em      = $em;
    }

    public static function getSubscribedEvents()
    {
        return array(
           Event::ON_CREATE_POST           => 'onCreate',
           Event::ON_FETCH_POST            => 'onCreate',
           Event::ON_UPDATE_POST           => 'onUpdate',
           Event::ON_DELETE_POST           => 'onDelete',
           EventCollection::ON_FETCH_ERROR => 'onCollectionFetch',
           EventCollection::ON_FETCH_POST  => 'onCollectionFetch',
        );
    }

    public function onCreate(Event $event)
    {
        $order = $event->getOutput();
        $this->createXml($order);
    }

    public function onDelete(Event $event)
    {
        $entity = $event->getInput();
        $filePath = Path::join(
            $this->config['live_folder_path'],
            $entity->getJobScheduler()->getName(),
            $entity->getName() . '.order.xml'
        );
        $this->fs->remove($filePath);
    }

    public function onUpdate(Event $event)
    {
        $entity = $event->getInput();

        // Check if fileName changed.

        $original = clone $entity; // Create a copy of your object
        $this->em->detach($entity); // Prevent your object from being refreshed
        $original = $this->em->merge($original); // Attach the copy to the EntityManager
        $this->em->refresh($original); // Get the database version of the entity

        $oldName = $original->getName();
        $newName = $entity->getName();
        dump($oldName);
        dump($newName);
        exit;

        $this->em->detach($original); // Detach the copy from the EntityManager
        $original = $this->em->merge($entity); // Attach the entity back to the EntityManager


        if ($oldName != $newName) {
            $filePath = Path::join(
                $this->config['live_folder_path'],
                $entity->getJobScheduler()->getName(),
                $oldName . '.order.xml'
            );
            $this->fs->remove($filePath);
        }

        $this->createXml($entity, true);
    }

    /**
     * Create in db not existing Job.
     * Create not existing job from db.
     * Store in output.
     *
     * @param EventCollection $event
     */
    public function onCollectionFetch(EventCollection $event)
    {
        $inDB             = array();
        $output           = $event->getOutput();
        $jobSchedulerPath = $this->getFolderPath($event->getInput()['jobScheduler']->getName());

        if (!empty($output)) {
            foreach ($output as $order) {
                $this->createXml($order);
                $inDB[] = $order->getName();
            }
        }

        $folder = new DirectoryIterator($jobSchedulerPath);

        foreach ($folder as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }
            if ($this->endsWith($fileInfo->getFilename(), '.order.xml')) {
                $filename = substr($fileInfo->getFilename(), 0, - strlen('.order.xml'));
                // Only not existing file.
                if (in_array($filename, $inDB)) {
                    continue;
                }
                $converter = new XMLToEntity(
                    $fileInfo->getPathname(),
                    \Arii\JoeXmlConnectorBundle\Converter\Specification\Order::class
                );
                $order = $converter->toEntity();
                $order->setName($filename);
                $order->setJobScheduler($event->getInput()['jobScheduler']);
                $return = $this->service->create($order);
                if ($return->getStatus() == PayloadStatus::CREATED) {
                    $output[] = $return->getOutput();
                }
            }
        }
        if ($event->getStatus() == PayloadStatus::NOT_FOUND && !empty($output)) {
            $event->setStatus(PayloadStatus::FOUND);
        }
        $event->setOutput($output);
    }

    protected function createXml(Entity $order, $force = false)
    {
        if (empty($order->getName())) {
            throw new Exception('A job need to have a name');
        }

        $jobScheduler = $order->getJobScheduler();

        if (empty($jobScheduler)) {
            throw new Exception('JobScheduler cannot be null.');
        }

        $filePath = Path::join(
            $this->config['live_folder_path'],
            $jobScheduler->getName(),
            $order->getName() . '.order.xml'
        );

        if ($force && $this->fs->exists($filePath)) {
            $this->fs->remove($filePath);
        }

        if (!$this->fs->exists($filePath)) {
            $converter = new EntityToXML(
                $order,
                \Arii\JoeXmlConnectorBundle\Converter\Specification\Order::class
            );
            $xml = $converter->toXML();
            file_put_contents($filePath, $xml);
        }
    }

    protected function getFolderPath($name)
    {
        return Path::join(
            $this->config['live_folder_path'],
            $name
        );
    }

    protected function endsWith($haystack, $needle)
    {
        $expectedPosition = strlen($haystack) - strlen($needle);

        return strripos($haystack, $needle, 0) === $expectedPosition;
    }
}
