<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;


class UsersCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Users::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField ::new('name', 'Nom'),
            yield TextField ::new('first_name', 'Prénom'),
            yield TextField ::new('email', 'Email'),
            yield IntegerField ::new('default_customer_number', 'Nombre de convives'),
            yield TextareaField ::new('default_allergies', 'Allergies'),
            yield BooleanField ::new('is_verified', 'compte vérifié'),
        ];
    }


    // Prevents the admin from deleting their own account.
    public function deleteEntity(EntityManagerInterface $entityManager, $entityInstance): void
    {
        // Retrieve logged in user
        $currentUser = $this -> getUser();
        // checks that the logged in user is not deleting their own account
        if ($entityInstance === $currentUser) {

            throw new AccessDeniedException('Vous ne pouvez pas supprimer votre propre compte.');
        }
        // If this is not the case, delete the account normally
        parent ::deleteEntity($entityManager, $entityInstance);
    }
}
