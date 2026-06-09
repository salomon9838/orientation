<?php

namespace App\Controller;

use App\Entity\Etablissement;
use App\Entity\Evenement;
use App\Entity\Filiere;
use App\Entity\Utilisateur;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    #[IsGranted('ROLE_ADMIN')]
    public function index(EntityManagerInterface $em)
    {
        $utilisateurs = (int) $em->getRepository(Utilisateur::class)
            ->createQueryBuilder('u')
            ->select('COUNT(u.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $evenements = (int) $em->getRepository(Evenement::class)
            ->createQueryBuilder('e')
            ->select('COUNT(e.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $filieres = (int) $em->getRepository(Filiere::class)
            ->createQueryBuilder('f')
            ->select('COUNT(f.id)')
            ->getQuery()
            ->getSingleScalarResult();

        $etablissements = (int) $em->getRepository(Etablissement::class)
            ->createQueryBuilder('et')
            ->select('COUNT(et.id)')
            ->getQuery()
            ->getSingleScalarResult();

        // Récupérer les derniers établissements
        $derniersEtablissements = $em->getRepository(Etablissement::class)
            ->createQueryBuilder('et')
            ->orderBy('et.id', 'DESC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        // Récupérer les prochains événements
        $prochainsEvenements = $em->getRepository(Evenement::class)
            ->createQueryBuilder('e')
            ->where('e.dateDebut >= :now')
            ->setParameter('now', new \DateTime())
            ->orderBy('e.dateDebut', 'ASC')
            ->setMaxResults(3)
            ->getQuery()
            ->getResult();

        return $this->render('admin/dashboard.html.twig', [
            'utilisateurs'   => $utilisateurs,
            'evenements'     => $evenements,
            'filieres'       => $filieres,
            'etablissements' => $etablissements,
            'visites'        => max(0, $utilisateurs * 1250),
            'pageviews'      => max(0, $utilisateurs * 3200),
            'new_users'      => max(0, (int) round($utilisateurs * 0.18)),
            'bounce_rate'    => round(35 + ($evenements / max(1, $utilisateurs)) * 3.5, 2),
            'derniersEtablissements' => $derniersEtablissements,
            'prochainsEvenements' => $prochainsEvenements,
        ]);
    }
}