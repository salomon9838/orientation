<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Form\EtablissementType;
use App\Service\ImageUploadService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[Route('/admin/etablissements', name: 'admin_etablissement')]
#[IsGranted('ROLE_ADMIN')]
final class AdminEtablissementController extends AbstractController
{
    #[Route('', name: '', methods: ['GET'])]
    public function index(EntityManagerInterface $entityManager): Response
    {
        $etablissements = $entityManager->getRepository(Etablissement::class)->findAll();

        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }

    #[Route('/new', name: '_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager, ImageUploadService $imageUploadService): Response
    {
        $etablissement = new Etablissement();
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $imageUrl = $imageUploadService->upload($imageFile);
                $etablissement->setImageUrl($imageUrl);
            }

            $entityManager->persist($etablissement);
            $entityManager->flush();

            $this->addFlash('success', 'Établissement créé avec succès.');
            return $this->redirectToRoute('admin_etablissement');
        }

        return $this->render('admin/etablissement/new.html.twig', [
            'form' => $form,
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/{id}', name: '_show', methods: ['GET'])]
    public function show(Etablissement $etablissement): Response
    {
        return $this->render('admin/etablissement/show.html.twig', [
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/{id}/edit', name: '_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager, ImageUploadService $imageUploadService): Response
    {
        $form = $this->createForm(EtablissementType::class, $etablissement);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $imageFile = $form->get('imageFile')->getData();
            if ($imageFile) {
                $imageUrl = $imageUploadService->upload($imageFile);
                $etablissement->setImageUrl($imageUrl);
            }

            $entityManager->flush();

            $this->addFlash('success', 'Établissement modifié avec succès.');
            return $this->redirectToRoute('admin_etablissement');
        }

        return $this->render('admin/etablissement/edit.html.twig', [
            'form' => $form,
            'etablissement' => $etablissement,
        ]);
    }

    #[Route('/{id}', name: '_delete', methods: ['POST'])]
    public function delete(Request $request, Etablissement $etablissement, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete' . $etablissement->getId(), $request->getPayload()->getString('_token'))) {
            $entityManager->remove($etablissement);
            $entityManager->flush();
            $this->addFlash('success', 'Établissement supprimé avec succès.');
        }

        return $this->redirectToRoute('admin_etablissement');
    }
}