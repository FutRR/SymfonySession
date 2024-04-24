<?php

namespace App\Controller;

use App\Repository\FormationRepository;
use App\Repository\SessionRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(FormationRepository $formationRepository, SessionRepository $sessionRepository): Response
    {
        $formations = $formationRepository->findAll();
        $sessions = $sessionRepository->findBy([], ["dateDebut" => "ASC"], 2);

        return $this->render('home/index.html.twig', [
            'sessions' => $sessions,
            'formations' => $formations
        ]);
    }
}
