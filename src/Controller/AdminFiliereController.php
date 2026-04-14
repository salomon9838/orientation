<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminFiliereController extends AbstractController
{
    #[Route('/admin/filieres', name: 'admin_filiere')]
    public function index(): Response
    {
        // Données simulées (comme un template pro)
        $filieres = [
            [
                'id' => 1,
                'nom' => 'Sciences et Technologies',
                'description' => 'Développement logiciel et applications',
                'niveau' => 'Lycée'
            ],
            [
                'id' => 2,
                'nom' => 'Administration et Réseaux',
                'description' => 'Administration réseaux et systèmes',
                'niveau' => 'Lycée'
            ],
            [
                'id' => 3,
                'nom' => 'Communication Digitale',
                'description' => 'Communication et technologies modernes',
                'niveau' => 'Collège / Lycée'
            ],
        ];

        return $this->render('admin/filiere/index.html.twig', [
            'filieres' => $filieres,
        ]);
    }
}