<?php

namespace App\Controller;

use App\Entity\Filiere;
use App\Form\FiliereType;
use App\Service\ImageUploadService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/filieres', name: 'admin_filiere')]
#[IsGranted('ROLE_ADMIN')]
final class AdminFiliereController extends AbstractController
{
    #[Route('', name: '', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $filieres = $entityManager->getRepository(Filiere::class)->findAll();

        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filieres,
        ]);
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ImageUploadService $imageUploadService): Response
    {
        $filiere = new Filiere();
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $imageUrl = $imageUploadService->upload($imageFile);
                $filiere->setImageUrl($imageUrl);
            }

            $filiere->setCreatedAt(new \DateTime());
            $entityManager->persist($filiere);
            $entityManager->flush();

            $this->addFlash('success', 'Filière créée avec succès.');
            return $this->redirectToRoute('admin_filiere');
        }

        return $this->render('admin/filiere/new.html.twig', [
            'form' => $form,
            'filiere' => $filiere,
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Filiere $filiere): Response
    {
        return $this->render('admin/filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Filiere $filiere, EntityManagerInterface $entityManager, ImageUploadService $imageUploadService): Response
    {
        $form = $this->createForm(FiliereType::class, $filiere);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $imageUrl = $imageUploadService->upload($imageFile);
                $filiere->setImageUrl($imageUrl);
            }

            $entityManager->flush();

            $this->addFlash('success', 'Filière modifiée avec succès.');
            return $this->redirectToRoute('admin_filiere');
        }

        return $this->render('admin/filiere/edit.html.twig', [
            'form' => $form,
            'filiere' => $filiere,
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: ['POST'])]
    public function delete(Request $request, Filiere $filiere, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $filiere->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($filiere);
            $entityManager->flush();
            $this->addFlash('success', 'Filière supprimée avec succès.');
        }

        return $this->redirectToRoute('admin_filiere');
    }
}