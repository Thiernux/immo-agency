<?php

namespace App\Form;

use App\Entity\Property;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title')
            ->add('description')
            ->add('surface')
            ->add('rooms', null, [
                'label'=> 'Pièces'
            ])
            ->add('bedrooms', null, [
                'label'=> 'Chambres'
            ])
            ->add('floor', null, [
                'label'=> 'Ville'
            ])
            ->add('price', null, [
                'label'=> 'Prix'
            ])
            ->add('heat', null, [
                'label'=> 'Chauffage'
            ])
            ->add('city', null, [
                'label'=> 'Ville'
            ])
            ->add('adress', null, [
                'label'=>'Adresse'
            ])
            ->add('postal_code', null, [
                'label'=> 'Code postal'
            ])
            ->add('sold', null, [
                'label'=>'Vendu'
            ])
            //->add('created_at')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class
        ]);
    }
}
