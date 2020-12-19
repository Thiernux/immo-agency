<?php

namespace App\Form;

use App\Entity\SearchProperty;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use App\Entity\Option;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class SearchPropertyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('maxPrice', IntegerType::class, ['required' => false, 'label'=>false, 'attr'=>['placeholder'=>'budget max']])
            ->add('minSurface', IntegerType::class, ['required' => false, 'label'=>false, 'attr'=>['placeholder'=>'Surface min']])
           ->add('option', EntityType::class, [
                'required'=> false,
                'label' => false,
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true
            ]) ;
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
