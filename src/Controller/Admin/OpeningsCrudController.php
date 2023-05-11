<?php

namespace App\Controller\Admin;

use App\Entity\Openings;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class OpeningsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Openings::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField ::new('opening_day', 'Jour'),
            yield TextField ::new('opening_morning', 'Heures du service du midi'),
            yield TextField ::new('opening_afternoon', 'Heures de service du soir'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            -> setEntityLabelInSingular('Horaire en pied de page')
            -> setEntityLabelInPlural('Horaires en pied de page');
    }

}
