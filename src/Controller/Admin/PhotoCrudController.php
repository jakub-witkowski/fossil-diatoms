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
//            ->setBasePath('%app.uploads_base_url%')            // <--- Here is the root path of my bucket.. (https://myBucket.s3.us-east-1.amazonaws.com
//            ->setUploadDir('https://fossil-diatoms.s3.eu-central-1.amazonaws.com/fossil-diatom-website-assets/atlas/')
//            ->setFormTypeOption('upload_new', function($file, $uploadDir, $filename) {
//                $uploadDir = 'https://fossil-diatoms.s3.eu-central-1.amazonaws.com/fossil-diatom-website-assets/atlas/';              // <--- I had to manually burn this value here, but I don't know if it's a good practice.
//                $filename = $file->getClientOriginalName();
//                $result = $file->move($uploadDir, $filename);                  // <--- Output: Unable to create the "https://myBucket.s3.us-east-1.amazonaws.com/public/images/users" directory.
//            })
//            ->setUploadedFileNamePattern('[name].[extension]')
//            ->setRequired(false)
//            ->hideOnIndex();
//            ->hideOnIndex()
////            ->onlyOnIndex()
////            ->hideWhenCreating()
////            ->hideWhenUpdating()
//            ->setFormTypeOption()
//            ->setBasePath('/assets/images/atlas')
//            ->setUploadDir('/assets/images/atlas');
//        yield TextField::new('filename', 'Image filename')
//            ->hideOnIndex();
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
        yield IntegerField::new('timesViewed');
        yield DateField::new('dateAdded')
            ->hideOnIndex()
            ->hideOnForm();

    }
}
