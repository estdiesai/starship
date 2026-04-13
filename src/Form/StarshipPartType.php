<?php

namespace App\Form;

use App\Entity\Starship;
use App\Entity\StarshipPart;
use Doctrine\Common\Collections\Order;
use Doctrine\ORM\EntityRepository;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class StarshipPartType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')
            ->add('price')
            ->add('notes')
            ->add('createdAt')
            ->add('updatedAt')
            ->add('starship', EntityType::class, [
                'class' => Starship::class,
                'choice_label' => 'id',
                'query_builder' => function (EntityRepository $repo) {
                    return $repo->createQueryBuilder('starship')
                        ->orderBy('starship.name', Order::Ascending->value);
                },
            ])
            ->add('createAndAddNew', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => StarshipPart::class,
        ]);
    }
}