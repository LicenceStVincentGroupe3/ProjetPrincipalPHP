<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use App\AdminBundle\Form\OperationType;
use App\AdminBundle\Entity\Operation;
use App\AdminBundle\Entity\Commercial;

// Préfix url
/**
 * @Route("/operation")
 */
class OperationController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newOperation")
     */
    public function new(Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            $new = new Operation();

            // Variable qui contient le Repository
            $commmercialCountry = $display->getRepository(Commercial::class);

            $listCommercial = $commmercialCountry->findAll();

            $form = $this->createForm(OperationType::class, $new);

            // Contient les name des <input>
            $formData = Request::createFromGlobals();

            // On récupère le name de la <select>
            $idAuthorSelected = $formData->request->get('author');
            
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
            {
                $new = $form->getData();

                // On récupère le commercial séléctionné
                $authorSelected = $commmercialCountry->find($idAuthorSelected);

                // On l'attribut à l'opération
                $new->setIdCommercial($authorSelected);
                
                $display->persist($new);
                $display->flush();

                return $this->redirect($this->generateUrl('listOperation'));
            }

            return $this->render('operation/new.html.twig', ['form' => $form->createView(), 'listCommercial' => $listCommercial, 'operationLink' => true]);
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editOperation")
     */
    public function edit($id, Request $request)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $operationRepository = $display->getRepository(Operation::class);

            // Equivalent du SELECT * where id=(paramètre)
            $edit = $operationRepository->find($id);

            $form = $this->createForm(OperationType::class, $edit);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
            {
                $edit = $form->getData();

                $entityManager = $this->getDoctrine()->getManager();

                $entityManager->flush();

                return $this->redirect($this->generateUrl('listOperation'));
            }

            // ----------------------------------
            // On demande à la vue d'afficher la commande plus tous ses produits
            // ----------------------------------
            return $this->render('operation/edit.html.twig', ['form' => $form->createView(), 'operationLink' => true]); // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/list", name="listOperation", methods={"GET"})
     */
    public function list()
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            // Appel de Doctrine
            $display = $this->getDoctrine()->getManager();

            // Variable qui contient le Repository
            $operationRepository = $display->getRepository(Operation::class);

            // Equivalent du SELECT *
            $list = $operationRepository->findAll();

            // ----------------------------------
            // On demande à la vue d'afficher la liste des commandes
            // ----------------------------------
            return $this->render('operation/list.html.twig', ['listOp' => $list, 'operationLink' => true]);
            // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        }
        else {
            return $this->redirect($this->generateUrl('login'));
        }
    }
}
