<?php

namespace App\Controller;

use Doctrine\ORM\Mapping\Entity;
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
        $formations = $formationRepository->findAll();
        return $this->render('session/index.html.twig', [
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

    #[Route('/session/{id}/{id_stagiaire}/registerStagiaire', name: 'registerStagiaire')]
    public function registerStagiaire(Session $session, int $id_stagiaire, EntityManagerInterface $entityManager): Response
    {
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($id_stagiaire);

        $session->addStagiaire($stagiaire);
        $entityManager->flush();
        return $this->redirectToRoute('show_session', ['id' => $session->getId()]);
    }


    #[Route('/session/{id}/{id_stagiaire}/unregisterStagiaire', name: 'unregisterStagiaire')]
    public function unregisterStagiaire(Session $session, int $id_stagiaire, EntityManagerInterface $entityManager): Response
    {
        $stagiaire = $entityManager->getRepository(Stagiaire::class)->find($id_stagiaire);

        $session->removeStagiaire($stagiaire);
        $entityManager->flush();
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

        $query = $entityManager->getRepository(Stagiaire::class)->createQueryBuilder('s')
            ->select('s')
            ->where(':session NOT MEMBER OF s.Sessions')
            ->setParameter('session', $session)
            ->orderBy('s.nomStagiaire', 'ASC')
            ->getQuery();
        $stagiaires = $query->getResult();

        return $this->render("session/show.html.twig", [
            'moduleForm' => $moduleForm,
            'stagiaires' => $stagiaires,
            'session' => $session,
        ]);
    }

}
