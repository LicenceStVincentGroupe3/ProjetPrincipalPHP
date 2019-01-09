<?php

namespace App\Controller;

use App\Entity\ParameterObject;
use App\Form\ParameterObjectType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/parameterObject")
 */
class ParameterObjectController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function new(Request $request)
    {
    	$parameterObject = new ParameterObject();

    	$form = $this->createForm(ParameterObjectType::class, $parameterObject);

        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
    	   $parameterObject=$form->getData();

           $entityManager = $this->getDoctrine()->getManager();
           // Persist prépare l'entité "parameterObject" pour la création //
           $entityManager->persist($parameterObject);
           // Flush envoie les infos en base (ajout) //
           $entityManager->flush();

           return $this->redirect($this->generateUrl('listParamObject'));
    	}	

        return $this->render('parameterObject/new.html.twig', array('form' => $form->createView(),));
    }



    /**
     * @Route("/edit/{id}", name="editParameterObject", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(ParameterObject::class);

        $editParameterObject = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ParameterObjectType::class, $editParameterObject);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $editParameterObject = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('listParamObject');

        }


        return $this->render('parameterObject/edit.html.twig', ['editParameterObject' => $editParameterObject, 'form' => $form->createView()]);
    } 


    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppParameterObject = $suppBD->getRepository(ParameterObject::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppParameterObject);
        // Execution
        $suppBD->flush();

        return $this->redirectToRoute('listParamObject');
    } 

    /**
     * @Route("/list", name="listParamObject")
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(ParameterObject::class);
        $repository = $display->getRepository(ParameterObject::class);

        $listParameterObject = $repository->findAll();
        // --------------------------
        // on demande à la vue d'afficher la liste des contacts
        // --------------------------
        return $this->render('parameterObject/list.html.twig', array('lesParamObjects'=>$listParameterObject));
    }           
}
