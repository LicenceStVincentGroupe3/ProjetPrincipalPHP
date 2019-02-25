<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterTypeSite;
use App\AdminBundle\Form\ParameterTypeSiteType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/parameterTypeSite")
 */
class ParameterTypeSiteController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function new(Request $request)
    {
    	$parameterTypeSite = new ParameterTypeSite();

    	$form = $this->createForm(ParameterTypeSiteType::class, $parameterTypeSite);

        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
    	   $parameterTypeSite=$form->getData();

           $entityManager = $this->getDoctrine()->getManager();
           // Persist prépare l'entité "ParameterTypeSite" pour la création //
           $entityManager->persist($parameterTypeSite);
           // Flush envoie les infos en base (ajout) //
           $entityManager->flush();

           return $this->redirect($this->generateUrl('listParamTypeSite'));
    	}	

        return $this->render('parameterTypeSite/new.html.twig', array('form' => $form->createView(),));
    }



    /**
     * @Route("/edit/{id}", name="editParameterTypeSite", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(ParameterTypeSite::class);

        $editParameterTypeSite = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ParameterTypeSiteType::class, $editParameterTypeSite);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $editParameterTypeSite = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listParamTypeSite');

        }


        return $this->render('parameterTypeSite/edit.html.twig', ['editParameterTypeSite' => $editParameterTypeSite, 'form' => $form->createView()]);
    } 


    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppParameterTypeSite = $suppBD->getRepository(ParameterTypeSite::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppParameterTypeSite);
        // Execution
        $suppBD->flush();

        return $this->redirectToRoute('listParamTypeSite');
    } 

    /**
     * @Route("/list", name="listParamTypeSite")
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(ParameterTypeSite::class);
        $repository = $display->getRepository(ParameterTypeSite::class);

        $listParameterTypeSite = $repository->findAll();
        // --------------------------
        // on demande à la vue d'afficher la liste des contacts
        // --------------------------
        return $this->render('parameterTypeSite/list.html.twig', array('lesParamTypeSite'=>$listParameterTypeSite));
    }           
}
