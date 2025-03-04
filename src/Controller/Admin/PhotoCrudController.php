<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield AssociationField::new('taxon');
        yield AssociationField::new('sample');
        yield AssociationField::new('microscope');
        yield AssociationField::new('technique')
            ->hideOnIndex();
        yield BooleanField::new('isPublished');
        yield TextField::new('filename')
            ->hideOnIndex();
        yield TextEditorField::new('description')
            ->hideOnIndex();
        yield IntegerField::new('timesViewed');
        yield DateField::new('dateAdded')
            ->hideOnIndex()
            ->hideOnForm();

    }
}
