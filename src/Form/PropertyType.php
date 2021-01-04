<?php

namespace App\Form;

use App\Entity\Property;
use App\Entity\Option;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Validator\Constraints\File;

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
                'label'=> 'Etage'
            ])
            ->add('price', null, [
                'label'=> 'Prix'
            ])
            ->add('heat',/*null, [
                'label'=> 'Chauffage'
            ],*/ ChoiceType::class, [
                'choices'=>$this->getChoices()
            ])

            ->add('options', EntityType::class, [
                'class' => Option::class,
                'choice_label' => 'name',
                'multiple' => true
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
            
            ->add('image', FileType::class, [
                'label' => 'Image (PNG file)',
                'mapped' => false,
                'required' => false,
                'constraints' => [
                    new File([
                        'maxSize' => '1024k',
                        'mimeTypes' => [
                            'image/png',
                        ],
                        'mimeTypesMessage' => 'Chargez une image au format PNG',
                    ])
                ],

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Property::class
        ]);
    }

    private function getChoices()
    {
        $choices = Property::HEAT;
        $output = [];
        foreach ($choices as $key => $value) {
            $output[$value] = $key;
        }
        return $output;
    }
}
