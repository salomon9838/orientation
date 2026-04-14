<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereShowController extends AbstractController
{
    // On ajoute {id} à la route pour rendre l'URL dynamique
    #[Route('/filiere/{id}', name: 'filiere_show')]
    public function show(int $id): Response
    {
        // 1. Simulation de données (à remplacer plus tard par une requête Doctrine)
        $filiere = [
            'id' => $id,
            'nom' => 'Informatique et Systèmes Numériques',
            'description' => 'Ceci est la description complète de la filière...',
            'conditionsAdmission' => 'Baccalauréat requis.',
            'debouches' => ['Développeur', 'Analyste', 'Expert Réseaux'],
            'ecoles' => [
                ['id' => 101, 'nom' => 'Institut Polytechnique (IPNET)'],
                ['id' => 102, 'nom' => 'IAEC']
            ]
        ];

        // 2. On envoie la variable 'filiere' au template
        return $this->render('filiere/show.html.twig', [
            'filiere' => $filiere,
        ]);
    }
}