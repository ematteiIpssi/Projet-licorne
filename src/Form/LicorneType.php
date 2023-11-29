<?php

namespace App\Form;

use App\Entity\Licorne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints as Assert;


class LicorneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom')
            ->add('strenght')
            ->add('intelligence')
            ->add('esquive');
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Licorne::class,
            // 'constraints' =>[
            //     new Assert\Expression([
            //         'expression' => 'value["strenght"] + value["intelligence"] + value["esquive"] > 5',
            //         'message'=> 'Les 10 points sont à répartir correctement'
            //     ])
            // ]
        ]);
    }
}
