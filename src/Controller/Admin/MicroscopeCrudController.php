<?php

namespace App\Controller\Admin;

use App\Entity\Microscope;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class MicroscopeCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Microscope::class;
    }


    public function configureFields(string $pageName): iterable
    {
        yield IdField::new('id')
            ->onlyOnIndex();
        yield TextField::new('name')
            ->onlyOnIndex();
        yield AssociationField::new('producer')
            ->onlyOnForms();
        yield AssociationField::new('model')
            ->onlyOnForms();
        yield AssociationField::new('objective')
            ->onlyOnForms();
        yield AssociationField::new('camera')
            ->onlyOnForms();
    }

}
