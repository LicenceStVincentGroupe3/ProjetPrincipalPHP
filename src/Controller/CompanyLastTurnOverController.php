<?php

namespace App\Controller;

use App\Entity\CompanyLastTurnover;
use App\Form\CompanyLastTurnOverType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/lastTurnOver")
 */
class CompanyLastTurnOverController extends AbstractController
{
    /**
     * @Route("/new", name="newLastTurnOver")
     */
    public function new(Request $request)
    {
        $newLastTurnOver = new CompanyLastTurnover();
        $form = $this->createForm(CompanyLastTurnoverType::class, $newLastTurnOver);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newLastTurnOver = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newLastTurnOver);
            $entityManager->flush();

            return $this->redirectToRoute('listLastTurnOver');
        }

        return $this->render('companyLastTurnOver/new.html.twig', array('form' => $form->createView(),));
    }

    /**
     * @Route("/edit/{id}", name="editLastTurnOver", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $editLastTurnOver = $this->getDoctrine()->getManager()->getRepository(CompanyLastTurnover::class)->find($id);

        $form = $this->createForm(CompanyLastTurnoverType::class, $editLastTurnOver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editLastTurnOver = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listLastTurnOver');
        }

        return $this->render('companyLastTurnOver/edit.html.twig', array(
        'form' => $form->createView(),'turnOver' => $editLastTurnOver
        ));
    }

    /**
     * @Route("/delete/{id}", name="deleteLastTurnOver", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyTurnover
        $suppLastTurnOver = new CompanyLastTurnover();

        $suppLastTurnOver = $suppBD->getRepository(CompanyLastTurnover::class)->find($id);

        // Suppression du chiffre d'affaire
        $suppBD->remove($suppLastTurnOver);

        // Exécution
        $suppBD->flush();

        return $this->redirectToRoute('listLastTurnOver');
    }

    /**
     * @Route("/list", name="listLastTurnOver")
     */
    public function list()
    {
        // ---------------------------------------
        // Récupération de la liste des derniers chiffres d'affaires
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyLastTurnover::class);

        $listLastTurnOver = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des derniers chiffres d'affaires
        // -------------------------------------------------------------
        return $this->render('companyLastTurnOver/list.html.twig', array('lesDernsChiffresDAffaires' => $listLastTurnOver)); // On affecte le tableau à la vue
    }

}
