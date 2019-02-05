<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\CompanyNbEmployee;
use App\AdminBundle\Form\CompanyNbEmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/NbEmployee")
 */
class CompanyNbEmployeeController extends AbstractController
{
    /**
     * @Route("/new", name="newNbEmployee")
     */
    public function new(Request $request)
    {
        $newNbEmployee = new CompanyNbEmployee();
        $form = $this->createForm(CompanyNbEmployeeType::class, $newNbEmployee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newNbEmployee = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newNbEmployee);
            $entityManager->flush();

            return $this->redirectToRoute('listNbEmployee');
        }

        return $this->render('companyNbEmployee/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editNbEmployee", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editNbEmployee = $this->getDoctrine()->getManager()->getRepository(CompanyNbEmployee::class)->find($id);

        $form = $this->createForm(CompanyNbEmployeeType::class, $editNbEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editNbEmployee = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listNbEmployee');
        }

        return $this->render('companyNbEmployee/edit.html.twig', array(
        'form' => $form->createView(),'company' => $editNbEmployee
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteNbEmployee", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyNbEmployee
        $suppNbEmployee = new CompanyNbEmployee();

        $suppNbEmployee = $suppBD->getRepository(CompanyNbEmployee::class)->find($id);

        // Suppression de la tranche de nombre d'employés
        $suppBD->remove($suppNbEmployee);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listNbEmployee');
    }

    /**
     * @Route("/list", name="listNbEmployee")
     */
    public function list()
    {
        // ---------------------------------------------------------------
        // Récupération de la liste des tranches de nombre d'employés
        // ---------------------------------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyNbEmployee::class);

        $listNbEmployee = $repository->findAll();
        // -------------------------------------------------------------------------
        // On demande à la vue d'afficher la liste des tranches de nombre d'employés
        // -------------------------------------------------------------------------
        return $this->render('companyNbEmployee/list.html.twig', array('lesNbEmployees' => $listNbEmployee)); // On affecte le tableau à la vue
    }
}
