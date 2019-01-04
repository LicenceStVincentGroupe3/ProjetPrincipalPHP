<?php

namespace App\Controller;

use App\Entity\CompanyNbEmployee;
use App\Form\CompanyCompanyNbEmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class CompanyNbEmployeeController extends AbstractController
{
    /**
     * @Route("/new", name="newNbEmployee")
     */
    public function new(Request $request)
    {
        $newNbEmployee = new CompanyNbEmployee();
        $form = $this->createForm(CompanyCompanyNbEmployeeType::class, $newNbEmployee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newNbEmployee = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newNbEmployee);
            $entityManager->flush();

            return $this->redirectToRoute('listTurnOver');
        }

        return $this->render('companyTurnOver/new.html.twig', array('form' => $form->createView(),));
    }
}
