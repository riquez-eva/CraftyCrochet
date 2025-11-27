<?php

namespace App\Controller\Admin;

use App\Entity\Detail;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DetailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Detail::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud 
            ->setEntityLabelInPlural('Détails des commandes')
            ->setEntityLabelInSingular('Detail de la commande'); 
    }

    /*
    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            TextField::new('title'),
            TextEditorField::new('description'),
        ];
    }
    */
}
