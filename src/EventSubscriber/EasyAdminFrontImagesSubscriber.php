<?php

namespace App\EventSubscriber;

use App\Entity\Images;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Core\Security;


// Allows to retrieve the connected user to associate it with the image (user_id)
class EasyAdminFrontImagesSubscriber implements EventSubscriberInterface
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
            BeforeEntityPersistedEvent::class => ['setImageFrontAndDate'],
        ];
    }

// We retrieve the instance of the Images entity
    public function setImageFrontAndDate(BeforeEntityPersistedEvent $event): void
    {
        $entity = $event -> getEntityInstance();
// Check that the entity is indeed an instance of Images
        if (!($entity instanceof Images)) {
            return;
        }
// Retrieve the current user
        $user = $this -> security -> getUser();
// Send the user to the entity
        $entity -> setUser($user);
    }
}