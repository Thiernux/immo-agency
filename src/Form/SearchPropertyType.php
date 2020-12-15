<?php

namespace App\Form;

use App\Entity\SearchProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SearchPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, ['required' => false, 'label'=>false, 'attr'=>['placeholder'=>'budget max']])
            ->add('minSurface', IntegerType::class, ['required' => false, 'label'=>false, 'attr'=>['placeholder'=>'Surface min']]);
           // ->add('submit', SubmitType::class, ['label'=> 'Rechercher']) ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => SearchProperty::class,
            'method' => 'GET',
            'csrf_protection' => false
        ]);
    }

    public function getBlockPrefix()
    {
        return '';
    }

}
