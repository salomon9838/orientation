<?php
namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'etablissement_index')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(): Response
    {
        $etablissements = [
            [
                'nom' => 'Université de Lomé',
                'ville' => 'Lomé',
                'desc' => 'La plus grande institution publique du Togo, offrant des formations dans toutes les disciplines.',
                'imageUrl' => null,
            ],
            [
                'nom' => 'ESGIS',
                'ville' => 'Lomé',
                'desc' => 'École Supérieure de Gestion, d\'Informatique et de Sciences, reconnue pour l\'excellence en gestion.',
                'imageUrl' => null,
            ],
            [
                'nom' => 'IAI Togo',
                'ville' => 'Lomé',
                'desc' => 'Institut Africain d\'Informatique, spécialisé en génie logiciel et systèmes d\'information.',
                'imageUrl' => null,
            ],
            [
                'nom' => 'IPNET',
                'ville' => 'Lomé',
                'desc' => 'Institut Polytechnique de Technologies de pointe, formation en ingénierie et réseaux.',
                'imageUrl' => null,
            ],
        ];

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }
}
