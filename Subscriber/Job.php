<?php
/**
 * Job Subscriber.
 *
 * @author Bryan Folliot <bfolliot@clever-age.com>
 */

namespace Arii\JoeXmlConnectorBundle\Subscriber;

use Arii\JOEBundle\Event\Job as Event;
use Arii\JOEBundle\Entity\Job as Entity;
use Arii\JOEBundle\Event\JobCollection as EventCollection;
use Arii\JOEBundle\Service\Job as Service;
use Arii\JoeXmlConnectorBundle\Converter\EntityToXML;
use Arii\JoeXmlConnectorBundle\Converter\XMLToEntity;
use Aura\Payload_Interface\PayloadStatus;
use BFolliot\Filesystem\Path;
use DirectoryIterator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class Job implements EventSubscriberInterface
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
        $job = $event->getOutput();
        $this->createXml($job);
    }

    public function onDelete(Event $event)
    {
        $entity = $event->getInput();
        $filePath = Path::join(
            $this->config['live_folder_path'],
            $entity->getJobScheduler()->getName(),
            $entity->getName() . '.job.xml'
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
                $oldName . '.job.xml'
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
            foreach ($output as $job) {
                $this->createXml($job);
                $inDB[] = $job->getName();
            }
        }

        $folder = new DirectoryIterator($jobSchedulerPath);

        foreach ($folder as $fileInfo) {
            if (!$fileInfo->isFile()) {
                continue;
            }
            if ($this->endsWith($fileInfo->getFilename(), '.job.xml')) {
                $filename = substr($fileInfo->getFilename(), 0, - strlen('.job.xml'));
                // Only not existing file.
                if (in_array($filename, $inDB)) {
                    continue;
                }
                $converter = new XMLToEntity(
                    $fileInfo->getPathname(),
                    \Arii\JoeXmlConnectorBundle\Converter\Specification\Job::class
                );
                $job = $converter->toEntity();
                $job->setName($filename);
                $job->setJobScheduler($event->getInput()['jobScheduler']);
                $return = $this->service->create($job);
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

    protected function createXml(Entity $job, $force = false)
    {
        if (empty($job->getName())) {
            throw new Exception('A job need to have a name');
        }

        $jobScheduler = $job->getJobScheduler();

        if (empty($jobScheduler)) {
            throw new Exception('JobScheduler cannot be null.');
        }

        $filePath = Path::join(
            $this->config['live_folder_path'],
            $jobScheduler->getName(),
            $job->getName() . '.job.xml'
        );

        if ($force && $this->fs->exists($filePath)) {
            $this->fs->remove($filePath);
        }

        if (!$this->fs->exists($filePath)) {
            $converter = new EntityToXML(
                $job,
                \Arii\JoeXmlConnectorBundle\Converter\Specification\Job::class
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
