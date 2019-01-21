<?php

namespace App\AdminBundle\Controller;

use App\Entity\Company;
use App\Form\CompanyType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/company")
 */
class CompanyController extends AbstractController
{
    /**
     * @Route("/new", name="newCompany")
     */
    public function new(Request $request)
    {
        $newCompany = new Company();
        $form = $this->createForm(CompanyType::class, $newCompany);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newCompany = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newCompany);
            $entityManager->flush();


            return $this->redirectToRoute('listCompany');
        }
        return $this->render('company/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editCompany", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editCompany = $this->getDoctrine()->getManager()->getRepository(Company::class)->find($id);

        $form = $this->createForm(CompanyType::class, $editCompany);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editCompany = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listCompany');
        }

        return $this->render('company/edit.html.twig', array(
        'form' => $form->createView(),'company' => $editCompany
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteCompany", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de Company
        $suppCompany = new Company();

        $suppCompany = $suppBD->getRepository(Company::class)->find($id);

        // Suppression de l'entreprise
        $suppBD->remove($suppCompany);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listCompany');
    }

    /**
     * @Route("/list", name="listCompany")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des entreprises
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(Company::class);

        $listCompany = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des entreprises
        // -------------------------------------------------------------
        return $this->render('company/list.html.twig', array('lesEntreprises' => $listCompany)); // On affecte le tableau à la vue
    }
}
