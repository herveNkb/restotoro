<?php

namespace App\Controller\Admin;

use App\Entity\Users;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;


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
            yield TextEditorField ::new('default_allergies', 'Allergies'),
            yield BooleanField ::new('is_verified', 'compte vérifié'),

        ];
    }

}
