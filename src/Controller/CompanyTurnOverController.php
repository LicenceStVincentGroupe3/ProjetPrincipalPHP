<?php

namespace App\Controller;

use App\Entity\CompanyTurnover;
use App\Form\CompanyTurnOverType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/turnOver")
 */
class CompanyTurnOverController extends AbstractController
{
    /**
     * @Route("/new", name="newTurnOver")
     */
    public function new(Request $request)
    {
        $newTurnOver = new CompanyTurnover();
        $form = $this->createForm(CompanyTurnOverType::class, $newTurnOver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newTurnOver = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newTurnOver);
            $entityManager->flush();

            return $this->redirectToRoute('listTurnOver');
        }

        return $this->render('companyTurnOver/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editTurnOver", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editTurnOver = $this->getDoctrine()->getManager()->getRepository(CompanyTurnover::class)->find($id);

        $form = $this->createForm(CompanyTurnOverType::class, $editTurnOver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editTurnOver = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listTurnOver');
        }

        return $this->render('companyTurnOver/edit.html.twig', array(
        'form' => $form->createView(),'turnOver' => $editTurnOver
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteTurnOver", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyTurnover
        $suppTurnOver = new CompanyTurnover();

        $suppTurnOver = $suppBD->getRepository(CompanyTurnover::class)->find($id);

        // Suppression du chiffre d'affaire
        $suppBD->remove($suppTurnOver);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listTurnOver');
    }

    /**
     * @Route("/list", name="listTurnOver")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des chiffres d'affaires
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyTurnOver::class);

        $listTurnOver = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des chiffres d'affaires
        // -------------------------------------------------------------
        return $this->render('companyTurnOver/list.html.twig', array('lesChiffresDAffaires' => $listTurnOver)); // On affecte le tableau à la vue
    }
}
