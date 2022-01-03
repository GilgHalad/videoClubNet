<?php

namespace App\Form;

use App\Entity\Copiesmovies;
use App\Entity\State;
use App\Entity\Rental;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;

class RentalType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('idUser')
            ->add('idCopieMovie', EntityType::class, [
                'class' => Copiesmovies::class,
                'choice_label' => function($pa){
                    return $pa->getRef();
                }
            ])           
           ->add('idState', EntityType::class, [
                'class' => State::class,
               'choice_label' => function($paa){
                    return $paa->getId();
                }
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Rental::class,
        ]);
    }
}
