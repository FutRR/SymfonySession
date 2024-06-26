<?php

namespace App\Controller;

use App\Entity\Formateur;
use App\Form\FormateurType;
use App\Repository\FormateurRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FormateurController extends AbstractController
{
    #[Route('/formateur', name: 'app_formateur')]
    public function index(FormateurRepository $formateurRepository): Response
    {
        $formateurs = $formateurRepository->findBy([], ["nomFormateur" => "ASC"]);
        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurs,
        ]);
    }

    #[Route('/formateur/new', name: 'new_formateur')]
    #[Route('/formateur/{id}/edit', name: 'edit_formateur')]
    public function new_edit(Formateur $formateur = null, Request $request, EntityManagerInterface $entityManager): Response
    {
        $isNewFormateur = !$formateur;
        $message = $isNewFormateur ? 'Formateur créé' : 'Formateur modifié';

        if (!$formateur) {
            $formateur = new Formateur();
        }

        $form = $this->createForm(FormateurType::class, $formateur);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $formateur = $form->getData();
            $entityManager->persist($formateur);
            $entityManager->flush();
            $this->addFlash('success', $message);
            return $this->redirectToRoute('app_formateur');
        }

        return $this->render("formateur/new.html.twig", [
            'formAddFormateur' => $form,
            'edit' => $formateur->getId()
        ]);

    }

    #[Route('/formateur/{id}/delete', name: 'delete_formateur')]
    public function delete(Formateur $formateur, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($formateur);
        $entityManager->flush();
        $this->addFlash('success', 'Formateur supprimé');
        return $this->redirectToRoute('app_formateur');
    }


    #[Route('/formateur/{id}', name: 'show_formateur')]
    public function show(Formateur $formateur): Response
    {
        return $this->render("formateur/show.html.twig", [
            'formateur' => $formateur
        ]);
    }

}
