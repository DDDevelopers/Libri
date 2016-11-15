<?php
namespace AppBundle\Services;


use AppBundle\Entity\Review;
use AppBundle\Entity\Timeline;
use Doctrine\Common\EventSubscriber;
use Doctrine\ORM\Event\LifecycleEventArgs;

class TimelineLogger implements EventSubscriber
{
    public function getSubscribedEvents()
    {
        return array(
            'postPersist',
            'postUpdate',
        );
    }

    public function postUpdate(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function postPersist(LifecycleEventArgs $args)
    {
        $this->index($args);
    }

    public function index(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity();
        // for now I am logging only the review for the book
        if ($entity instanceof Review) {
            $em = $args->getEntityManager();

            $timeline = new Timeline();
            $timeline->setDescription('You reviewed this book');
            $timeline->setTable('Review');
            $timeline->setParentId($entity->getId());
            $timeline->setLink('no link');
            $timeline->setUserId($entity->getUser()->getId());

            $em->persist($timeline);
            $em->flush();

        }
    }
}