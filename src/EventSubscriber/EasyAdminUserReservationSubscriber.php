<?php

namespace App\EventSubscriber;

use App\Entity\Reservations;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;


// Allows to retrieve the connected user to associate it with the reservation (users_id)
class EasyAdminUserReservationSubscriber implements EventSubscriberInterface
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
            BeforeEntityPersistedEvent::class => ['setUserReservation'],
        ];
    }

// We retrieve the instance of the Reservations entity
    public function setUserReservation(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event -> getEntityInstance();
// Check that the entity is indeed an instance of Reservations
        if (!($entity instanceof Reservations)) {
            return;
        }
// Retrieve the current user
        $user = $this -> security -> getUser();
// Send the user to the entity
        $entity -> setUsers($user);
    }
}