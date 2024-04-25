<?php

namespace App\Form;

use App\Entity\Formateur;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class FormateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomFormateur', TextType::class, [
                'label' => 'Nom : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('prenomFormateur', TextType::class, [
                'label' => 'Prénom : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('emailFormateur', TextType::class, [
                'label' => 'Email : ',
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
            'data_class' => Formateur::class,
        ]);
    }
}
