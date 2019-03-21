<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class AccueilController extends AbstractController
{
    /**
     * @Route("/", name="index")
     */
    public function index()
    {
    	if ($this->isGranted('ROLE_COMMERCIAL')) {
    		return $this->render('accueil/index.html.twig', ['dashBordLink' => true]);
    	}
    	else {
    		return $this->redirect($this->generateUrl('login'));
    	}
    }
}
