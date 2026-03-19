<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MentorController extends AbstractController
{
    #[Route('/mentors', name: 'mentors')]
    public function index(): Response
    {
        
        $mentorsData = [
            [
                'id' => 1,
                'nom' => 'Dr. Sophie Martin',
                'type' => 'Conseiller d\'orientation', 
                'expertise' => 'Sciences et Santé', 
                'note' => 5, 
                'feedbackCount' => 12,
                'photo' => 'https://i.pravatar.cc/150?u=sophie'
            ],
            [
                'id' => 2,
                'nom' => 'Thomas Durand',
                'type' => 'Ancien élève', 
                'expertise' => 'Ingénierie Aéronautique',
                'note' => 4,
                'feedbackCount' => 8,
                'photo' => 'https://i.pravatar.cc/150?u=thomas'
            ],
            [
                'id' => 3,
                'nom' => 'Marc Lefebvre',
                'type' => 'Professionnel', 
                'expertise' => 'Architecture et Design',
                'note' => 5,
                'feedbackCount' => 24,
                'photo' => 'https://i.pravatar.cc/150?u=marc'
            ]
        ];

        return $this->render('mentor/index.html.twig', [
            'mentors' => $mentorsData 
        ]);
    }
}