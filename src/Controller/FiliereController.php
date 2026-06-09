<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class FiliereController extends AbstractController
{
    private function getFilieresData(): array
    {
        return [
            1 => [
                'id' => 1,
                'nom' => 'Informatique et Systèmes Numériques',
                'slug' => 'informatique-systemes-numeriques',
                'description' => 'Conception de logiciels, réseaux et maintenance informatique. Formez-vous aux métiers du numérique et devenez expert en développement, cybersécurité ou administration systèmes.',
                'imageUrl' => null,
                'conditionsAdmission' => 'Baccalauréat C, D, E ou TI requis.',
                'debouches' => ['Développeur Fullstack', 'Administrateur Réseaux', 'Expert Sécurité', 'Analyste Données'],
                'ecoles' => [
                    ['id' => 101, 'nom' => 'Institut Polytechnique (IPNET)'],
                    ['id' => 102, 'nom' => 'IAEC Togo']
                ]
            ],
            2 => [
                'id' => 2,
                'nom' => 'Génie Civil et Construction',
                'slug' => 'genie-civil',
                'description' => 'Apprendre à concevoir des infrastructures, ponts et bâtiments. Une formation complète en ingénierie civile adaptée aux défis de construction modernes en Afrique.',
                'imageUrl' => null,
                'conditionsAdmission' => 'Baccalauréat scientifique ou technique (F4) avec mention.',
                'debouches' => ['Chef de chantier', 'Ingénieur BTP', 'Dessinateur Projeteur', 'Architecte'],
                'ecoles' => [
                    ['id' => 103, 'nom' => 'ENSI (Université de Lomé)'],
                    ['id' => 104, 'nom' => 'EAMAU']
                ]
            ],
            3 => [
                'id' => 3,
                'nom' => 'Gestion des Entreprises et Administration',
                'slug' => 'gestion-entreprises',
                'description' => 'Maîtriser la comptabilité, les RH et le management moderne. Préparez-vous à diriger des organisations et à gérer des équipes avec efficacité.',
                'imageUrl' => null,
                'conditionsAdmission' => 'Baccalauréat toutes séries (A, G, D, C).',
                'debouches' => ['Comptable', 'Gestionnaire RH', 'Auditeur', 'Manager'],
                'ecoles' => [
                    ['id' => 105, 'nom' => 'ESA (École Supérieure des Affaires)'],
                    ['id' => 106, 'nom' => 'Faseg']
                ]
            ],
        ];
    }

    #[Route('/filieres', name: 'filieres')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(): Response
    {
        return $this->render('filiere/index.html.twig', [
            'filieres' => $this->getFilieresData()
        ]);
    }

    #[Route('/filiere/{id}', name: 'filiere_show')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
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
