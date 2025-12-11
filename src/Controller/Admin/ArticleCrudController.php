<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Articles')
            ->setEntityLabelInSingular('Article');
    }


    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('libelle'),
            TextField::new('description'),
            TextField::new('image'),
            NumberField::new('prix')
                ->setLabel('Prix')
                ->setHelp('Entrez un nombre — ex : 12.50')
                ->setNumDecimals(2),
            BooleanField::new('active')->setLabel('Actif'),


            AssociationField::new('categorie')
                ->setLabel('Categorie')
                ->setRequired(true), // optionnel
        ];
    }
}
