<?php

namespace App\Controller;

use App\Entity\ParameterBehavior;
use App\Form\ParameterBehaviorType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
/*use App\Controller\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;*/

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/parameterBehavior")
 */
class ParameterBehaviorController extends AbstractController
{
    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/new", methods={"GET","POST"}, name="newParameterBehavior")
     */
    public function new(Request $request)
    {
    	$newParameterBehavior = new ParameterBehavior();
					

    	$form = $this->createForm(ParameterBehaviorType::class, $newParameterBehavior);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newParameterBehavior = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newParameterBehavior);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('listParameterBehavior'));
        }

        return $this->render('parameter_behavior/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", methods={"POST"})
     */
    /*public function newApi(Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $parameterBehavior,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }*/

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editParameterBehavior")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterBehaviorRepository = $display->getRepository(ParameterBehavior::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $parameterBehaviorRepository->find($id);

        $form = $this->createForm(ParameterBehaviorType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listParameterBehavior'));
        }

        // ----------------------------------
        // On demande à la vue d'afficher la commande plus tous ses produits
        // ----------------------------------
        return $this->render('parameter_behavior/edit.html.twig', ['editParameterBehavior' => $edit, 'form' => $form->createView()]);
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"POST"})
     */
    /*public function editApi($id, Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $parameterBehavior,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }*/

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteParameterBehavior")
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $parameterBehaviorRepository = $display->getRepository(ParameterBehavior::class);

        $delete = $parameterBehaviorRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirect($this->generateUrl('listParameterBehavior'));
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    /*public function deleteApi($id, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $parameterBehavior,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }*/

    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/list", name="listParameterBehavior", methods={"GET"})
     */
    public function list(Request $request/*, SerializerInterface $serializer*/)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterBehaviorRepository = $display->getRepository(ParameterBehavior::class);

        // Equivalent du SELECT *
        $list = $parameterBehaviorRepository->findAll();

        /*if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $parameterBehavior,
                'json',
                ['groups'=>["Light"]]
            );

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }*/
        //else {
            // ----------------------------------
            // On demande à la vue d'afficher la liste des commandes
            // ----------------------------------
            return $this->render('parameter_behavior/list.html.twig', ['listParameterBehavior' => $list]);
            // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        //}
    }
}

?>