<?php

namespace App\Controller;

use App\Entity\Session;
use App\Repository\SessionRepository;
use App\Repository\FormationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function index(FormationRepository $formationRepository, SessionRepository $sessionRepository, EntityManagerInterface $entityManager): Response
    {
        $formations = $formationRepository->findAll();

        $query = $sessionRepository->createQueryBuilder('s')
            ->select('s')
            ->where('s.dateFin > :now')
            ->andWhere('s.dateDebut < :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('s.dateFin', 'ASC')
            ->getQuery();
        $sessionsEnCours = $query->setMaxResults(4)->getResult();


        $query = $sessionRepository->createQueryBuilder('s')
            ->select('s')
            ->where('s.dateDebut > :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('s.dateDebut', 'ASC')
            ->getQuery();
        $sessionsProchaines = $query->setMaxResults(2)->getResult();

        return $this->render('home/index.html.twig', [
            'sessionsEnCours' => $sessionsEnCours,
            'sessionsProchaines' => $sessionsProchaines,
            'formations' => $formations
        ]);
    }
}
