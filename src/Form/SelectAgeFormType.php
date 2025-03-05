<?php

namespace App\Form;

use App\Entity\RelativeAge;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectAgeFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('relativeAge', EntityType::class, [
                'class' => RelativeAge::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('a')
                        ->orderBy('a.midpointDate', 'ASC');
                },
                'choice_value' => function (?RelativeAge $relativeAge) : string {
                    return $relativeAge ? $relativeAge->getId() : '';
                },
                'label' => 'Geological age:',
                'placeholder' => 'Select age...',
                'autocomplete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => RelativeAge::class,
        ]);
    }
}
