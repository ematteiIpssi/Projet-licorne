<?php

namespace App\Form;

use App\Entity\Licorne;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Callback;


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
            'constraints' =>[
                new Callback([$this,'validSum'])
            ]
        ]);
    }

    public function validSum($data,$context){
        $total = $data->getStrenght() + $data->getIntelligence() + $data->getEsquive();
        if($total !== 5){
            $context->buildViolation('Le total des points doit être de 5')
                ->atPath('strenght')
                ->addViolation();
            $context->buildViolation('Le total des points doit être de 5')
                ->atPath('intelligence')
                ->addViolation();
            $context->buildViolation('Le total des points doit être de 5')
                ->atPath('esquive')
                ->addViolation();
        }
    }
}
