<?php

namespace App\Controller\Admin;

use App\Entity\Categories;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class CategoriesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Categories::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField ::new('dish_categorie', 'Nom de la catégorie'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            -> setEntityLabelInSingular('Catégorie de plats')
            -> setEntityLabelInPlural('Catégories de plats');
    }
}
