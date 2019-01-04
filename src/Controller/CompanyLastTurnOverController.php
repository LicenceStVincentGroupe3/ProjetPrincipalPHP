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
        return $this->render('companyLastTurnOver/list.html.twig', array('lesDerniersChiffresDAffaires' => $listLastTurnOver)); // On affecte le tableau à la vue
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

}
