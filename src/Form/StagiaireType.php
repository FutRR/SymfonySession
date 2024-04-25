<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStagiaire', TextType::class, [
                'label' => 'Nom : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('prenomStagiaire', TextType::class, [
                'label' => 'Prenom : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('emailStagiaire', TextType::class, [
                'label' => 'Email : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('dateNaissance', DateType::class, [
                'label' => 'Date de naissance :',
                'label_attr' => ['class' => 'label'],
                'years' => range(1950, date("Y")),
                'data' => new \DateTime(),
                'format' => 'dd MM yyyy',
                'attr' => [
                    'class' => 'form date'
                ]
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('valider', SubmitType::class, [
                'attr' => [
                    'class' => 'submit btn'
                ]
            ])

        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Stagiaire::class,
        ]);
    }
}
