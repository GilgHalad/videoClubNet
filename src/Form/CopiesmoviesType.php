<?php

namespace App\Form;

use App\Entity\Copiesmovies;
use App\Entity\Movies;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;


class CopiesmoviesType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('ref')
            //->add('idState')
            ->add('idMovie',EntityType::class, [
                'class' => Movies::class,
                'choice_label' => function($pa){
                    return $pa->getName();
                }
            ]);
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Copiesmovies::class,
        ]);
    }
}
