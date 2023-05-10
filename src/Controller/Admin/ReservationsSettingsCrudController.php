<?php

namespace App\Controller\Admin;

use App\Entity\ReservationsSettings;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TimeField;

class ReservationsSettingsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return ReservationsSettings::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TimeField ::new('lunchOpeningTime', 'Début service de midi'),
            yield TimeField ::new('lunchClosingTime', 'Fin service de midi'),
            yield TimeField ::new('dinnerOpeningTime', 'Début service du soir'),
            yield TimeField ::new('dinnerClosingTime', 'Début service du soir'),
            yield IntegerField ::new('maxCustomers', 'Nombre de places maximum'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            -> setEntityLabelInSingular('Paramètre pour les réservations')
            -> setEntityLabelInPlural('Paramètres pour les réservations')
            -> setTimeFormat('HH:mm');
    }
}
