<?php

namespace App\Controller\Admin;

use App\Entity\Reservations;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ReservationsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Reservations::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield DateTimeField ::new('date_reservation', 'Date de réservation'),
            yield TextField ::new('hour_reservation', 'Heure de réservation'),
            yield TextField ::new('name', 'Nom'),
            yield IntegerField ::new('customer_number', 'Nombre de couverts'),
            yield TextareaField ::new('allergies', 'Allergie(s) possible(s)'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            -> setEntityLabelInSingular('Réservation')
            -> setEntityLabelInPlural('Réservations')
            -> setPaginatorPageSize(30)
            -> setPaginatorRangeSize(4)
            -> setDefaultSort(['dateReservation' => 'ASC'])
            -> setDateTimeFormat('dd/MM/yyyy');
    }

}
