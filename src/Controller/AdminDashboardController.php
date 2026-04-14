<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminDashboardController extends AbstractController
{
    #[Route('/admin', name: 'admin_dashboard')]
    public function index()
    {
        return $this->render('admin/dashboard.html.twig' , [
    'utilisateurs'  => 26,
    'evenements'    => 6200,
    'filieres'      => 2.49,
    'etablissements'=> 44,
    'visites'       => 29703,
    'unique'        => 24095,
    'pageviews'     => 76790,
    'new_users'     => 22123,
    'bounce_rate'   => 40.15,
]);
    }
}