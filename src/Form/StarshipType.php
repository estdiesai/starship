<?php

declare(strict_types=1);

namespace App\Form;

use App\Entity\Starship;
use App\Entity\StarshipStatusEnum;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\TypeInfo\Type\EnumType;

class StarshipType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('class')
            ->add('captain')
            ->add('status', EnumType::class, [
                'class' => StarshipStatusEnum::class,
            ])
            ->add('arrivedAt', null, [
                'widget' => 'single_text',
            ])
            ->add('slug')
            ->add('createdAt')
            ->add('updatedAt')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Starship::class,
        ]);
    }
}
