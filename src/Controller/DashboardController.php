<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/regie-publicitaire", name="home")
     */
    public function index()
    {
        return $this->render('ad_admin/dashboard/home.html.twig');
    }
}