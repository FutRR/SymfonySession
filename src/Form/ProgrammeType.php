<?php

namespace App\Form;

use App\Entity\Unite;
use App\Entity\Session;
use App\Entity\Programme;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class ProgrammeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('Session', EntityType::class, [
            //     'class' => Session::class,
            //     'choice_label' => 'id',
            // ])
            ->add('Unite', EntityType::class, [
                'class' => Unite::class,
                'choice_label' => 'nomUnite',
                'attr' => ['class' => 'form'],
                'label' => 'Unité'
            ])
            ->add('nbJours', IntegerType::class, [
                'attr' => ['class' => 'form'],
                'label' => 'Nombre de jours'
            ])
            ->add('ajouter', SubmitType::class, [
                'attr' => ['class' => 'btn submit']
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Programme::class,
        ]);
    }
}
