<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class TaxonFormType extends AbstractType
{
    /**
    * @return void 
    */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('genus:', TextType::class)
            ->add('species:', TextType::class);
    }

}