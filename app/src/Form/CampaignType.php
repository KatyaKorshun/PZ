<?php

namespace App\Form;

use App\Entity\Campaign;
use App\Entity\CompanyType;
use App\Entity\Industry;
use Symfony\Component\Form\AbstractType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'Название',
                'label_attr' => [
                    'class' => 'col-form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('ynp', TextType::class, [
                'label' => 'УНП',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('address', TextType::class, [
                'label' => 'Адрес',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('phone', TextType::class, [
                'required' => false,
                'label' => 'Телефон',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('email', TextType::class, [
                'label' => 'email',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('additionalInformation', TextareaType::class, [
                'required' => false,
                'label' => 'Дополнительная информация',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('contactPerson', TextType::class, [
                'label' => 'Контактное лицо',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('typeCompany', EntityType::class, [
                'label' => 'Организационно-прававая форма',
                'class' => CompanyType::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('industry', EntityType::class, [
                'label' => 'Отрасль',
                'class' => Industry::class,
                'choice_label' => 'name',
                'attr' => [
                    'class' => 'form-control',
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Campaign::class,
        ]);
    }
}
