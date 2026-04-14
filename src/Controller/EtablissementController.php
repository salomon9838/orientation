<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'etablissement_index')]
    public function index(): Response
    {
        // Données structurées pour chaque établissement
        $etablissements = [
            ['nom' => 'Université de Lomé', 'ville' => 'Lomé', 'desc' => 'La plus grande institution publique du Togo.'],
            ['nom' => 'ESGIS', 'ville' => 'Lomé', 'desc' => 'École Supérieure de Gestion, d\'Informatique et de Sciences.'],
            ['nom' => 'IAI Togo', 'ville' => 'Lomé', 'desc' => 'Institut Africain d\'Informatique, spécialisé en génie logiciel.'],
            ['nom' => 'IPNET', 'ville' => 'Lomé', 'desc' => 'Institut Polytechnique de Technologies de pointe.']
        ];

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }
}