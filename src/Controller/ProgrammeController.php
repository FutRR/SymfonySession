<?php

namespace App\Controller;

use App\Entity\Programme;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ProgrammeController extends AbstractController
{
    #[Route('/programme', name: 'app_programme')]
    public function index(): Response
    {
        return $this->render('programme/index.html.twig', [
            'controller_name' => 'ProgrammeController',
        ]);
    }

    #[Route('/programme/{id}/delete', name: 'delete_programme')]
    public function delete(Programme $programme, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($programme);
        $entityManager->flush();
        return $this->redirectToRoute('show_session', ['id' => $programme->getSession()->getId()]);

    }
}
