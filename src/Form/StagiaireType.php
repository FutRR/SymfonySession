<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\BirthdayType;

class StagiaireType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomStagiaire', TextType::class, [
                'label' => 'Nom : ',
                "attr" => [
                    'class' => "form"
                ]
            ])
            ->add('prenomStagiaire', TextType::class, [
                'label' => 'Prenom : ',
                "attr" => [
                    'class' => "form"
                ]
            ])
            ->add('emailStagiaire', TextType::class, [
                'label' => 'Email : ',
                "attr" => [
                    'class' => "form"
                ]
            ])
            ->add('dateNaissance', BirthdayType::class, [
                'label' => 'Date de naissance :',
                "attr" => [
                    'class' => "form date"
                ],
                'format' => 'dd-MM-yyyy'
            ])
            ->add('telephone', TextType::class, [
                'label' => 'Téléphone',
                'required' => false,
                "attr" => [
                    'class' => "form"
                ]
            ])
            ->add('ville', TextType::class, [
                'label' => 'Ville',
                'required' => false,
                "attr" => [
                    'class' => "form"
                ]
            ])
            ->add('valider', SubmitType::class, [
                "attr" => [
                    'class' => "submit btn"
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
