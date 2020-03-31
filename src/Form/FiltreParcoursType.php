<?php

namespace App\Form;

use App\Entity\Trajet;
use App\Entity\Destination;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type as TypeS;

class FiltreParcoursType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('pointDepart', TypeS\EntityType::class, 
        [                
            'class' => Destination::class,
            'label' => 'trips.departure'
        ])
        ->add('pointArrivee', TypeS\EntityType::class, 
        [                
            'class' => Destination::class,
            'label' => 'trips.arrival'
        ])
    ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null,
        ]);
    }
}
