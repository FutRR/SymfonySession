<?php

namespace App\Controller;

use App\Entity\Unite;
use App\Entity\Session;
use App\Entity\Programme;
use App\Form\SessionType;
use App\Repository\SessionRepository;
use App\Repository\ProgrammeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository): Response
    {
        $sessionsDevWeb = $sessionRepository->findBy(['Formation' => '1']);
        $sessionsBureautique = $sessionRepository->findBy(['Formation' => '2']);
        $sessionsCommerce = $sessionRepository->findBy(['Formation' => '3']);
        $sessionsEsthetique = $sessionRepository->findBy(['Formation' => '4']);
        return $this->render('session/index.html.twig', [
            'sessionsDevWeb' => $sessionsDevWeb,
            'sessionsBureautique' => $sessionsBureautique,
            'sessionsCommerce' => $sessionsCommerce,
            'sessionsEsthetique' => $sessionsEsthetique,
        ]);
    }

    #[Route('/session/new', name: 'new_session')]
    #[Route('/session/{id}/edit', name: 'edit_session')]
    public function new_edit(Session $session = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        if (!$session) {
            $session = new Session();
        }

        $form = $this->createForm(SessionType::class, $session);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $session = $form->getData();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
        }

        return $this->render("session/new.html.twig", [
            'formAddSession' => $form,
            'edit' => $session->getId()
        ]);

    }



    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, Programme $programme, Request $request, EntityManagerInterface $entityManager): Response
    {
        $programme->setSession($session);

        $moduleForm = $this->createFormBuilder($programme)
            ->add('unite', EntityType::class, [
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
            ])->getForm();

        $moduleForm->handleRequest($request);
        if ($moduleForm->isSubmitted() && $moduleForm->isValid()) {
            $programme = $moduleForm->getData();
            $entityManager->persist($session);
            $entityManager->flush();

            return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
        }

        return $this->render("session/show.html.twig", [
            'moduleForm' => $moduleForm,
            'session' => $session,
        ]);
    }

}
