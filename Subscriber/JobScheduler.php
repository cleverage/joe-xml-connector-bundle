<?php
/**
 * Job Scheduler Subscriber.
 *
 * @author Bryan Folliot <bfolliot@clever-age.com>
 */

namespace Arii\JoeXmlConnectorBundle\Subscriber;

use Arii\JOEBundle\Event\JobScheduler as Event;
use Arii\JOEBundle\Event\JobSchedulerCollection as EventCollection;
use Arii\JOEBundle\Service\JobScheduler as Service;
use Aura\Payload_Interface\PayloadStatus;
use BFolliot\Filesystem\Path;
use DirectoryIterator;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Filesystem\Exception\IOExceptionInterface;
use Symfony\Component\Filesystem\Filesystem;

class JobScheduler implements EventSubscriberInterface
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
           Event::ON_UPDATE_VALID          => 'onUpdate',
           Event::ON_DELETE_POST           => 'onDelete',
           Event::ON_FETCH_POST            => 'onCreate',
           EventCollection::ON_FETCH_ERROR => 'onCollectionFetch',
           EventCollection::ON_FETCH_POST  => 'onCollectionFetch',
        );
    }

    public function onCreate(Event $event)
    {
        $folder = $this->getFolderPath(
            $event->getOutput()->getName()
        );

        if (!$this->fs->exists($folder)) {
            $this->fs->mkdir($folder, 0700);
        }
    }

    public function onDelete(Event $event)
    {
        $folder = $this->getFolderPath(
            $event->getInput()->getName()
        );

        if ($this->fs->exists($folder)) {
            $this->fs->remove($folder);
        }
    }

    public function onUpdate(Event $event)
    {
        // Get the old and new name.
        $entity = $event->getInput();

        $original = clone $entity; // Create a copy of your object
        $this->em->detach($entity); // Prevent your object from being refreshed
        $original = $this->em->merge($original); // Attach the copy to the EntityManager
        $this->em->refresh($original); // Get the database version of the entity

        $oldName = $this->getFolderPath($original->getName());
        $newName = $this->getFolderPath($entity->getName());

        $this->em->detach($original); // Detach the copy from the EntityManager
        $original = $this->em->merge($entity); // Attach the entity back to the EntityManager

        // Create or rename.
        if (!$this->fs->exists($oldName)) {
            $this->fs->mkdir($newName, 0700);
        } elseif ($oldName != $newName) {
            $this->fs->rename(
                $oldName,
                $newName
            );
        }
    }

    /**
     * Create in db not existing JobScheduler.
     * Create not existing folder from db.
     * Store in output.
     *
     * @param EventCollection $event
     */
    public function onCollectionFetch(EventCollection $event)
    {
        $inDB   = array();
        $output = $event->getOutput();

        if (!empty($output)) {
            foreach ($output as $jobScheduler) {
                $inDB[] = $jobScheduler->getName();
                $path          = $this->getFolderPath($jobScheduler->getName());
                if (!$this->fs->exists($path)) {
                    $this->fs->mkdir($path, 0700);
                }
            }
        }

        $liveFolder = new DirectoryIterator($this->config['live_folder_path']);

        foreach ($liveFolder as $fileInfo) {
            // Only directory.
            if ($fileInfo->isDot() || !$fileInfo->isDir()) {
                continue;
            }
            // Only not existing directory.
            if (in_array($fileInfo->getFilename(), $inDB)) {
                continue;
            }

            $entity = $this->service->getNew($fileInfo->getFilename());
            $return = $this->service->create($entity);
            if ($return->getStatus() == PayloadStatus::CREATED) {
                $output[] = $return->getOutput();
            }
        }
        if ($event->getStatus() == PayloadStatus::NOT_FOUND && !empty($output)) {
            $event->setStatus(PayloadStatus::FOUND);
        }
        $event->setOutput($output);
    }

    protected function getFolderPath($name)
    {
        return Path::join(
            $this->config['live_folder_path'],
            $name
        );
    }
}
