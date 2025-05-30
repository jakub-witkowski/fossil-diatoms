<?php
namespace App\Form;

use App\Entity\Genus;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SelectGenusFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', EntityType::class, [
                'class' => Genus::class,
                'query_builder' => function (EntityRepository $er): QueryBuilder {
                    return $er->createQueryBuilder('g')
                        ->orderBy('g.name', 'ASC');
                },
                'label' => 'Genus name:',
                'placeholder' => 'Select genus...',
                'autocomplete' => true,
            ]);
    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Genus::class
        ]);
    }
}