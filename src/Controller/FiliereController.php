<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FiliereController extends AbstractController
{
    private function getFilieresData(): array
    {
        return [
            1 => [
                'id' => 1,
                'nom' => 'Informatique et Systèmes Numériques',
                'slug' => 'informatique-systemes-numeriques',
                'description' => 'Conception de logiciels, réseaux et maintenance informatique.',
                'conditionsAdmission' => 'Baccalauréat C, D, E ou TI requis.',
                'debouches' => ['Développeur Fullstack', 'Administrateur Réseaux', 'Expert Sécurité'],
                'ecoles' => [
                    ['id' => 101, 'nom' => 'Institut Polytechnique (IPNET)'],
                    ['id' => 102, 'nom' => 'IAEC Togo']
                ]
            ],
            2 => [
                'id' => 2,
                'nom' => 'Génie Civil et Construction',
                'slug' => 'genie-civil',
                'description' => 'Apprendre à concevoir des infrastructures, ponts et bâtiments.',
                'conditionsAdmission' => 'Baccalauréat scientifique ou technique (F4) avec mention.',
                'debouches' => ['Chef de chantier', 'Ingénieur BTP', 'Dessinateur Projeteur'],
                'ecoles' => [
                    ['id' => 103, 'nom' => 'ENSI (Université de Lomé)'],
                    ['id' => 104, 'nom' => 'EAMAU']
                ]
            ],
            3 => [
                'id' => 3,
                'nom' => 'Gestion des Entreprises et Administration',
                'slug' => 'gestion-entreprises',
                'description' => 'Maîtriser la comptabilité, les RH et le management moderne.',
                'conditionsAdmission' => 'Baccalauréat toutes séries (A, G, D, C).',
                'debouches' => ['Comptable', 'Gestionnaire RH', 'Auditeur'],
                'ecoles' => [
                    ['id' => 105, 'nom' => 'ESA (École Supérieure des Affaires)'],
                    ['id' => 106, 'nom' => 'Faseg']
                ]
            ],
        ];
    }

    #[Route('/filieres', name: 'filieres')]
    public function index(): Response
    {
        return $this->render('filiere/index.html.twig', [
            'filieres' => $this->getFilieresData()
        ]);
    }

    #[Route('/filiere/{id}', name: 'filiere_show')]
    public function show(int $id): Response
    {
        $allFilieres = $this->getFilieresData();

        if (!isset($allFilieres[$id])) {
            throw $this->createNotFoundException('La filière demandée n\'existe pas.');
        }

        return $this->render('filiere/show.html.twig', [
            'filiere' => $allFilieres[$id]
        ]);
    }
}