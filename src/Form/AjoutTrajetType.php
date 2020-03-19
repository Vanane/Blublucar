<?php

namespace App\Form;

use App\Entity\Destination;
use App\Entity\Trajet;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type as Type;
use Symfony\Bridge\Doctrine\Form\Type as TypeS;

class AjoutTrajetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('tempsTrajet')
            ->add('prix')
            ->add('nbPlaces')
            ->add('vehicule')
            ->add('options')
            ->add('date')
            ->add('pointDepart', TypeS\EntityType::class, 
            [                
                'class' => Destination::class
            ])
            ->add('pointArrivee', TypeS\EntityType::class, 
            [                
                'class' => Destination::class
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Trajet::class,
        ]);
    }
}
