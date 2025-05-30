<?php

namespace App\Controller\Admin;

use App\Entity\DeepSeaSite;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\NumberField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class DeepSeaSiteCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return DeepSeaSite::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id'),
            IntegerField::new('geography'),
            IntegerField::new('campaign'),
            NumberField::new('latitude'),
            NumberField::new('longitude'),
            TextField::new('discriminator'),
            TextField::new('nameOrNumberPrimary'),
            TextField::new('nameOrNumberSecondary'),
            TextField::new('localityName'),
            TextField::new('country'),
        ];
    }
}
