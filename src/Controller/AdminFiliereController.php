<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AdminFiliereController extends AbstractController
{
    #[Route('/admin/filieres', name: 'admin_filiere')]
    public function index()
    {
        return $this->render('admin/filiere/index.html.twig');
    }
}