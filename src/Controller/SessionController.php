<?php

namespace App\Controller;

use Exception;
use App\Entity\Session;
use App\Entity\Programme;
use App\Entity\Stagiaire;
use App\Form\SessionType;
use App\Form\ProgrammeType;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SessionController extends AbstractController
{
    #[Route('/session', name: 'app_session')]
    public function index(SessionRepository $sessionRepository, FormationRepository $formationRepository): Response
    {
        // $sessionsDevWeb = $sessionRepository->findBy(['Formation' => '1']);
        // $sessionsBureautique = $sessionRepository->findBy(['Formation' => '2']);
        // $sessionsCommerce = $sessionRepository->findBy(['Formation' => '3']);
        // $sessionsEsthetique = $sessionRepository->findBy(['Formation' => '4']);
        $formations = $formationRepository->findAll();
        return $this->render('session/index.html.twig', [
            // 'sessionsDevWeb' => $sessionsDevWeb,
            // 'sessionsBureautique' => $sessionsBureautique,
            // 'sessionsCommerce' => $sessionsCommerce,
            // 'sessionsEsthetique' => $sessionsEsthetique,
            'formations' => $formations
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

    #[Route('/session/{id}/delete', name: 'delete_session')]
    public function delete(Session $session, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($session);
        $entityManager->flush();
        return $this->redirectToRoute('app_session');
    }

    #[Route('/session/{id}/unregisterStagiaire', name: 'unregisterStagiaire')]
    public function unregisterStagiaire(Session $session, Stagiaire $stagiaire, SessionRepository $sessionRepository, EntityManagerInterface $entityManager): Response
    {
        $session->removeStagiaire($stagiaire);
        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }


    #[Route('/session/{id}', name: 'show_session')]
    public function show(Session $session, Request $request, EntityManagerInterface $entityManager): Response
    {
        $programme = new Programme();
        $programme->setSession($session);

        $moduleForm = $this->createForm(ProgrammeType::class, $programme);

        $moduleForm->handleRequest($request);
        if ($moduleForm->isSubmitted() && $moduleForm->isValid()) {
            $programme = $moduleForm->getData();
            $entityManager->persist($programme);
            $entityManager->flush();

            return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
        }

        // $stagiaireForm = $this->createFormBuilder()
        //     ->add('stagiaires', EntityType::class, [
        //         'class' => Stagiaire::class,
        //         'choice_label' => 'fullnameStagiaire',
        //         'attr' => ['class' => 'form'],
        //         'multiple' => false,
        //         'expanded' => false,
        //         'label' => 'Stagiaire'
        //     ])
        //     ->add('ajouter', SubmitType::class, [
        //         'attr' => ['class' => 'btn submit']
        //     ])->getForm();

        // $stagiaireForm->handleRequest($request);
        // if ($stagiaireForm->isSubmitted() && $stagiaireForm->isValid()) {
        //     $data = $stagiaireForm->getData();
        //     $stagiaire = $data['stagiaires'];

        //     $session->addStagiaire($stagiaire);

        //     $entityManager->persist($session);
        //     $entityManager->flush();

        //     return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
        // }


        return $this->render("session/show.html.twig", [
            'moduleForm' => $moduleForm,
            // 'stagiaireForm' => $stagiaireForm,
            'session' => $session,
        ]);
    }

}
