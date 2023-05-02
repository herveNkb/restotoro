<?php

namespace App\EventSubscriber;

use App\Entity\Openings;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;


// Allows to retrieve the connected user to associate it with the Openings (user_id)
class EasyAdminOpeningsSubscriber implements EventSubscriberInterface
{
// Security is a service that allows to get the current user
    private Security $security;

// We inject the Security service in the constructor
    public function __construct(Security $security)
    {
        $this -> security = $security;
    }

// This method is called a event when an entity is persisted
    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => ['setOpeningsDayMorningAndAfternoon'],
        ];
    }

// We retrieve the instance of the Openings entity
    public function setOpeningsDayMorningAndAfternoon(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event -> getEntityInstance();
// Check that the entity is indeed an instance of Openings
        if (!($entity instanceof Openings)) {
            return;
        }
// Retrieve the current user
        $user = $this -> security -> getUser();
// Send the user to the entity
        $entity -> setUsers($user);
    }
}