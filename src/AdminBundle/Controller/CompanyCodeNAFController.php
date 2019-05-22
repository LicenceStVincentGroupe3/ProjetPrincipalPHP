<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyCodeNAF;
use App\AdminBundle\Form\CompanyCodeNAFType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;

class CompanyCodeNAFController extends AbstractController
{
    /**
     * @Route("/company/code/n/a/f", name="company_code_n_a_f")
     */
    public function index()
    {
        return $this->render('company_code_naf/index.html.twig', [
            'controller_name' => 'CompanyCodeNAFController',
        ]);
    }
}
