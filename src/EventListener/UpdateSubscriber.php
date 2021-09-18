<?php

namespace App\EventListener;

use App\Entity\Contact;
use App\Entity\Product;
use App\Service\CurlService;
use Doctrine\Bundle\DoctrineBundle\EventSubscriber\EventSubscriberInterface;
use Doctrine\ORM\Events;
use Doctrine\Persistence\Event\LifecycleEventArgs;

class UpdateSubscriber implements EventSubscriberInterface
{

    // this method can only return the event names; you cannot define a
    // custom method name to execute when each event triggers
    /**
     * @var CurlService
     */
    private CurlService $curlService;

    /**
     * UpdateSubscriber constructor.
     * @param CurlService $curlService
     */
    public function __construct(CurlService $curlService)
    {
        $this->curlService = $curlService;
    }

    public function getSubscribedEvents(): array
    {
        return [
            Events::preUpdate,
        ];
    }

    public function preUpdate(LifecycleEventArgs $args): void
    {
        $changes = [];
        foreach ($args->getEntityChangeSet() as $key => $change) {
            $changes[$key] = $change[1];
        }

        $entity = $args->getObject();
        if ($entity instanceof Product) {
            $this->curlService->send($_ENV["ERP_URL"] . 'products/'.$entity->getBillyId(), CURLOPT_PUT, ['product'=>$changes]);
        }

        if ($entity instanceof Contact) {
            $this->curlService->send($_ENV["ERP_URL"] . 'contacts/'.$entity->getBillyId(), CURLOPT_PUT, ['contact'=>$changes]);
        }
    }

}