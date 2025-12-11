<?php

namespace App\Controller\Admin;

use App\Entity\Commande;
use Doctrine\Migrations\Version\State;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;


class CommandeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Commande::class;
    }


    public function configureFields(string $pageName): iterable
    {
        $fields = [
            IdField::new('id')->hideOnForm(),
            TextField::new('nom'),
            TextField::new('email'),
            TextField::new('adresse'),
            CollectionField::new('detail')
                ->setTemplatePath('admin/details_list.html.twig') // optionnel si tu veux personnaliser
                ->onlyOnDetail() // ou supprimer si tu veux sur la liste aussi
                ->setFormTypeOptions([
                    'by_reference' => false, // obligatoire pour ajouter/supprimer des détails depuis la commande
                ])
                ->setEntryIsComplex(true),
            DateField::new('date_de_commmande'),
            IntegerField::new('etat'),
            AssociationField::new('details')
                ->setLabel('Détails')
                ->onlyOnDetail(),

        ];

        // dump($fields);

        return $fields;
    }

    private $adminUrlGenerator;

    public function __construct(AdminUrlGenerator $adminUrlGenerator)
    {
        $this->adminUrlGenerator = $adminUrlGenerator;
    }

    public function configureActions(Actions $actions): Actions
    {
        $viewDetails = Action::new('viewDetails', 'Voir les détails')
            ->linkToUrl(function (Commande $commande) {
                return $this->adminUrlGenerator
                    ->setController(DetailCrudController::class)
                    ->setAction('index')
                    ->set('commandeId', $commande->getId())
                    ->generateUrl();
            });

        return $actions->add('detail', $viewDetails);
    }
}
