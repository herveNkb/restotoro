<?php

namespace App\EventSubscriber;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;


// Allows to associate categories with the menus (categories_id)
class EasyAdminCategoriesMenusSubscriber implements EventSubscriberInterface
{
// This method is called a event when an entity is persisted
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setCategoriesMenus'],
        ];
    }

// We retrieve the instance of the Categories entity
    public function setCategoriesMenus(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event -> getEntityInstance();
// Check that the entity is indeed an instance of Categories
        if (!($entity instanceof Categories)) {
            return;
        }
    }
}