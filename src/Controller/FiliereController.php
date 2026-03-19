<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    #[Route('/filieres', name: 'filieres')]
    public function index(): Response
    {
        
        $filiereData = [
            'nom' => 'Informatique et Systèmes Numériques',
            'description' => 'Accompagner les élèves dans leur orientation numérique.',
            'conditionsAdmission' => 'Baccalauréat scientifique ou technique requis.',
            'debouches' => [
                'Ingénieur Logiciel',
                'Analyste de données',
                'Expert en Cybersécurité'
            ],
            'ecoles' => [
                ['nom' => 'Institut Polytechnique'],
                ['nom' => 'École Supérieure du Numérique']
            ]
        ];

        // On passe le tableau 'filiere'
        return $this->render('filiere/index.html.twig', [
            'filiere' => $filiereData
        ]);
    }
}