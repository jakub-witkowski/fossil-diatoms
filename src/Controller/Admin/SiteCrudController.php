<?php

namespace App\Controller\Admin;

use App\Entity\Site;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class SiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Site::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield AssociationField::new('siteType');
        yield AssociationField::new('campaign');
        yield TextField::new('nameOrNumber')
            ->onlyOnIndex();
        yield TextField::new('nameOrNumberPrimary')
            ->hideOnIndex();
        yield TextField::new('nameOrNumberSecondary')
            ->hideOnIndex();
//        yield AssociationField::new('sample');
        yield AssociationField::new('geography');

    }
}
