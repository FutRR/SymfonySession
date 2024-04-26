<?php

namespace App\Form;

use App\Entity\Session;
use App\Entity\Formateur;
use App\Entity\Formation;
use App\Entity\Stagiaire;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class SessionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nomSession', TextType::class, [
                'label' => 'Nom de la session : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('dateDebut', DateTimeType::class, [
                'html5' => false,
                'label' => 'Date de début :',
                'label_attr' => ['class' => 'label'],
                'years' => range(date("Y"), date("Y") + 5),
                'format' => 'dd MM yyyy | H:i',
                'attr' => [
                    'class' => 'form date'
                ]
            ])
            ->add('dateFin', DateTimeType::class, [
                'html5' => false,
                'label' => 'Date de fin :',
                'label_attr' => ['class' => 'label'],
                'years' => range(date("Y"), date("Y") + 5),
                'format' => 'dd MM yyyy | H:i',
                'attr' => [
                    'class' => 'form date'
                ]
            ])
            ->add('nbPlaces', NumberType::class, [
                'label' => 'Nombre de places : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('description', TextareaType::class, [
                'label' => 'Description : ',
                'attr' => [
                    'class' => 'form'
                ]
            ])
            ->add('Formation', EntityType::class, [
                'class' => Formation::class,
                'choice_label' => 'titreFormation',
            ])
            ->add('Formateur', EntityType::class, [
                'class' => Formateur::class,
                'choice_label' => 'nomFormateur',
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
            'data_class' => Session::class,
        ]);
    }
}
