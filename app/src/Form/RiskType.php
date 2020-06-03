<?php

namespace App\Form;

use App\Entity\Risk;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class RiskType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('key', TextType::class,
                [
                    'label' => 'Ключ',
                    'attr'  => [
                        'class' => 'form-control',
                    ]
                ]
            )
            ->add('name', TextType::class,
                [
                    'label' => 'Название',
                    'attr'  => [
                        'class' => 'form-control',
                    ]
                ]
            );
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Risk::class,
        ]);
    }
}
