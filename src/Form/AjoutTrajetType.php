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
            ->add('tempsTrajet', Type\NumberType::class, [
                'label' => 'trips.time'
            ])
            ->add('prix', Type\NumberType::class, [
                'label' => 'trips.price'
            ])
            ->add('nbPlaces', Type\NumberType::class, [
                'label' => 'trips.places'
            ])
            ->add('vehicule', Type\TextType::class, [
                'label' => 'trips.vehicle'
            ])
            ->add('options')
            ->add('date')
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
            'data_class' => Trajet::class,
        ]);
    }
}
