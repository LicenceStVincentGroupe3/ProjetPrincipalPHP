<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterTarget;
use App\AdminBundle\Form\ParameterTargetType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;

/**
 * @Route("/parameterTarget")
 */
class ParameterTargetController extends AbstractController
{
    /**
     * @Route("/new")
     */
    public function new(Request $request)
    {
    	$parameterTarget = new ParameterTarget();

    	$form = $this->createForm(ParameterTargetType::class, $parameterTarget);

        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
 	
    	if($form->isSubmitted() && $form->isValid())
        {
    	   $parameterTarget=$form->getData();

           $entityManager = $this->getDoctrine()->getManager();
           // Persist prépare l'entité "ParameterTarget" pour la création //
           $entityManager->persist($parameterTarget);
           // Flush envoie les infos en base (ajout) //
           $entityManager->flush();

           return $this->redirect($this->generateUrl('ListParamTarget'));
    	}	

        return $this->render('parameterTarget/new.html.twig', array('form' => $form->createView(),));
    }



    /**
     * @Route("/edit/{id}", name="editParameterTarget", requirements={"id"="\d+"})
     */
    public function edit($id, Request $request)
    {
        $repository = $this->getDoctrine()->getManager()->getRepository(ParameterTarget::class);

        $editParameterTarget = $repository->find($id);

        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ParameterTargetType::class, $editParameterTarget);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $editParameterTarget = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirectToRoute('ListParamTarget');

        }


        return $this->render('parameterTarget/edit.html.twig', ['editParameterTarget' => $editParameterTarget, 'form' => $form->createView()]);
    } 


    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"})
     */
    public function delete($id)
    {
        $suppBD = $this->getDoctrine()->getManager();
        // On créer un objet instance de contact
        $suppParameterTarget = $suppBD->getRepository(ParameterTarget::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppParameterTarget);
        // Execution
        $suppBD->flush();

        return $this->redirectToRoute('ListParamTarget');
    } 

    /**
     * @Route("/list", name="ListParamTarget")
     */
    public function list()
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(ParameterTarget::class);
        $repository = $display->getRepository(ParameterTarget::class);

        $listParameterTarget = $repository->findAll();
        // --------------------------
        // on demande à la vue d'afficher la liste des contacts
        // --------------------------
        return $this->render('parameterTarget/list.html.twig', array('lesParamTargets'=>$listParameterTarget));
    }           
}
