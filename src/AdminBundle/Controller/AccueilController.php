<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/")
     */
    public function index()
    {
        return $this->render('base.html.twig', ['mainNavHome'=>true]);
    }
}
