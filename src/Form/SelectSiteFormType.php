<?php

namespace App\Form;

//use App\Entity\Campaign;
//use App\Entity\Geography;
//use App\Entity\Genus;
use App\Entity\Site;
//use App\Entity\SiteType;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\QueryBuilder;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SelectSiteFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Site', EntityType::class, [
                'class' => Site::class,
                'choice_label' => function (Site $site) {
                    return sprintf('%s', $site->getFullNameOrNumber());
                },
                'choice_value' => function (?Site $site) : string {
                    return $site ? $site->getId() : '';
                },
                'label' => 'Site name or number:',
                'placeholder' => 'Select site...',
                'autocomplete' => true,
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Site::class,
        ]);
    }
}
