<?php

namespace App\Form;

use App\Entity\CampaignRisk;
use App\Entity\Risk;
use App\Service\Traits\EntityManagerTrait;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CampaignRiskType extends AbstractType
{
    use EntityManagerTrait;

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('risk', EntityType::class, [
                'label' => 'Риски',
                'class' => Risk::class,
                'choice_label' => 'name',
                'choice_value' => 'key',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('volatility', NumberType::class, [
                'required' => false,
                'label' => 'Волатильность изменения риск-фактора(σ)',
                'label_attr' => [
                    'class' => 'col-form-label',
                ],
                'attr' => [
                    'class' => 'form-control',
                ]
            ])
            ->add('quantile', NumberType::class, [
                'required' => false,
                'label' => 'Квантиль нормального распределения для выбранного доверительного уровня(λ)',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('openPositionValue', NumberType::class, [
                'required' => false,
                'label' => 'Текущая стоимость открытой позиции(V)',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('k1', NumberType::class, [
                'required' => false,
                'label' => 'Показатель рентабельности предприятия(k1)',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('k2', NumberType::class, [
                'required' => false,
                'label' => 'Показатель состояния оборотного капитала(k2)',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('k3', NumberType::class, [
                'required' => false,
                'label' => 'Финансовый риск предприятия(k3)',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('k4', NumberType::class, [
                'required' => false,
                'label' => 'Коэффициент ликвидности(k4)',
                'attr' => [
                    'class' => 'form-control',
                ],
            ])
            ->add('response', TextareaType::class, [
                'required' => false,
                'label' => 'Ответ',
                'attr' => [
                    'class' => 'form-control response',
                    'rows'  => 40,
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => CampaignRisk::class,
            'csrf_protection' => false,
        ]);
    }
}
