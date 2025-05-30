<?php

namespace App\Controller\Admin;

use App\Entity\Photo;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use Symfony\Component\HttpFoundation\File\UploadedFile;

//use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
//use EasyCorp\Bundle\EasyAdminBundle\Form\Type\FileUploadType;

class PhotoCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Photo::class;
    }

    public function configureFields(string $pageName): iterable
    {
//        yield ImageField::new('filename','Image')
//            ->setUploadDir('/assets/images/atlas')
//                ->setFormTypeOption('upload_new',
//                function(UploadedFile $file, string $uploadDir, string $filename)
//                {
//                    $uploadDir = 'https://fossil-diatoms.s3.eu-central-1.amazonaws.com/fossil-diatom-website-assets/atlas/';
//                    $filename = $file->getClientOriginalName();
//                    $file->move($uploadDir, $filename);
//                })
//            ->setRequired(true)
//            ->hideOnIndex()
//                ;
        yield IdField::new('id')
            ->onlyOnIndex();
        yield AssociationField::new('taxon');
        yield AssociationField::new('sample');
        yield AssociationField::new('microscope');
        yield AssociationField::new('technique')
            ->hideOnIndex();
        yield BooleanField::new('isPublished');
        yield TextEditorField::new('description')
            ->hideOnIndex();
//        yield IntegerField::new('timesViewed');
//        yield DateField::new('dateAdded')
//            ->hideOnIndex()
//            ->hideOnForm();

    }
}
