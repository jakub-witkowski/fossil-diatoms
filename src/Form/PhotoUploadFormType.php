<?php

namespace App\Form;

use App\Entity\Photo;
//use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Image;

class PhotoUploadFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $date = date(
            'Y-m-d',
        );

        $builder
            ->add('imageFile', FileType::class, [
                'label' => 'Select image:',
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'maxSize' => '5k',
                    ])
                ]
            ])
//            ->add('isPublished', CheckboxType::class, ['required' => false, 'empty_data' => null])
//            ->add('description', TextType::class, ['required' => false])
//            ->add('timesViewed', IntegerType::class, ['required' => false, 'empty_data' => '0'])
//            ->add('dateAdded', DateType::class, ['required' => false, 'empty_data' => $date])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Photo::class,
        ]);
    }
}
