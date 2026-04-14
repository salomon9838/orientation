<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminEtablissementController extends AbstractController
{
    #[Route('/admin/etablissements', name: 'admin_etablissement')]
    public function index()
    {
         $etablissements = [
            [
                'id' => 1,
                'nom' => 'Université de Lomé',
                'ville' => 'Lomé'
            ],
            [
                'id' => 2,
                'nom' => 'ESGIS',
                'ville' => 'Lomé'
            ],
            [
                'id' => 3,
                'nom' => 'IAI Togo',
                'ville' => 'Lomé'
            ],
        ];

        return $this->render('admin/etablissement/index.html.twig', [
            'etablissements' => $etablissements,
        ]);
    }
}

    
   