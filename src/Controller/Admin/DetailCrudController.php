<?php

namespace App\Controller\Admin;

use App\Entity\Detail;
use Doctrine\ORM\QueryBuilder;
use EasyCorp\Bundle\EasyAdminBundle\Dto\EntityDto;
use EasyCorp\Bundle\EasyAdminBundle\Dto\SearchDto;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FieldCollection;
use EasyCorp\Bundle\EasyAdminBundle\Collection\FilterCollection;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class DetailCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Detail::class;
    }

    public function createIndexQueryBuilder(
    SearchDto $searchDto,
    EntityDto $entityDto,
    FieldCollection $fields,
    FilterCollection $filters
): QueryBuilder {
    $qb = parent::createIndexQueryBuilder($searchDto, $entityDto, $fields, $filters);

    if ($commandeId = $this->getContext()->getRequest()->query->get('commandeId')) {
        $qb->andWhere('entity.commande = :commandeId')
           ->setParameter('commandeId', $commandeId);
    }

    return $qb;
}

    public function configureFields(string $pageName): iterable
{
    return [
        IdField::new('id'),
        IntegerField::new('quantite'),
        TextField::new('article.nom', 'Article')
    ];
}

}
