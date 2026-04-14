<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

#[Route('/fil')]
final class FilieresController extends AbstractController
{
    #[Route(name: 'app_filieres_index', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $filieres = $entityManager
            ->getRepository(Filiere::class)
            ->findAll();

        return $this->render('fil/index.html.twig', [
            'filieres' => $filieres,
        ]);
    }

    #[Route('/new', name: 'app_filieres_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filiere);
            $entityManager->flush();

            return $this->redirectToRoute('app_filieres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fil/new.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filieres_show', methods: ['GET'])]
    public function show(Filiere $filiere): Response
    {
        return $this->render('fil/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_filieres_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_filieres_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('fil/edit.html.twig', [
            'filiere' => $filiere,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_filieres_delete', methods: ['POST'])]
    public function delete(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filiere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($filiere);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_filieres_index', [], Response::HTTP_SEE_OTHER);
    }
}
