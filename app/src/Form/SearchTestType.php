<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SearchType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SearchTestType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', SearchType::class, [
                'required' => false,
                'label' => false,
                'attr' => [
                    'placeholder' => 'Имя',
                    'style' => 'float:left;height:38px'
                ]
            ])
            ->add('save', SubmitType::class,
                [
                    'label' => 'Поиск',
                    'attr' => [
                        'class' => 'btn btn-primary',
                    ]
                ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => null]);
    }
}
