<?php

namespace App\Controller;

use App\Entity\RendezVous;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RendezVousController extends AbstractController
{

    #[Route('/rendezvous', name: 'rendezvous')]
    public function index(EntityManagerInterface $em): Response
    {

        $rendezvous = $em->getRepository(RendezVous::class)->findAll();

        return $this->render('rendezvous/index.html.twig', [
            'rendezvous' => $rendezvous
        ]);
    }


    #[Route('/rendezvous/new', name: 'rendezvous_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {

        if ($request->isMethod('POST')) {

            $rdv = new RendezVous();

            $rdv->setEtudiant($request->request->get('etudiant'));
            $rdv->setMentor($request->request->get('mentor'));

            $date = new \DateTime($request->request->get('date'));
            $rdv->setDate($date);

            $em->persist($rdv);
            $em->flush();

            return $this->redirectToRoute('rendezvous');
        }

        return $this->render('rendezvous/new.html.twig');
    }

}