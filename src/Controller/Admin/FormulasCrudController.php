<?php

namespace App\Controller\Admin;

use App\Entity\Formulas;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class FormulasCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Formulas::class;
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            yield TextField ::new('formula_title', 'Nom de la formule'),
            yield IntegerField ::new('formula_price', 'Tarif'),
            yield TextEditorField ::new('description', 'Description') -> hideOnIndex() -> setNumOfRows(20), // hideOnIndex() is used to hide the field on the index page,
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            -> setEntityLabelInSingular('Menu')
            -> setEntityLabelInPlural('Menus');
    }

}
