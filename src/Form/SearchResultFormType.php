<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
// use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use App\Entity\SearchResult;

class SearchResultFormType extends AbstractType
{
    /**
    * @return void 
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genus')
            ->add('species');
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchResult::class
        ]);
    }
}