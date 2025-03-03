<?php

namespace App\Controller\Admin;

use App\Entity\Taxon;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class TaxonCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Taxon::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id');
        yield AssociationField::new('genus');
        yield AssociationField::new('species');
        yield AssociationField::new('variety');
        yield AssociationField::new('taxonType');
        yield TextField::new('diatomBase');

    }
}
