<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class EtablissementController extends AbstractController
{
    #[Route('/etablissements', name: 'etablissement_index')]
    public function index()
    {
        $etablissements = [
            'Université de Lomé',
            'ESGIS',
            'IAI Togo'
        ];

        return $this->render('etablissement/index.html.twig', [
            'etablissements' => $etablissements
        ]);
    }
}