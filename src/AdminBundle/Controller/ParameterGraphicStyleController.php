<?php

namespace App\AdminBundle\Controller;

use App\AdminBundle\Entity\ParameterGraphicStyle;
use App\AdminBundle\Form\ParameterGraphicStyleType;
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
 * @Route("/parameterGraphicStyle")
 */
class ParameterGraphicStyleController extends AbstractController
{
    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/new", methods={"GET","POST"}, name="newParameterGraphicStyle")
     */
    public function new(Request $request)
    {
    	$newParameterGraphicStyle = new ParameterGraphicStyle();
					

    	$form = $this->createForm(ParameterGraphicStyleType::class, $newParameterGraphicStyle);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newParameterGraphicStyle = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newParameterGraphicStyle);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('listParameterGraphicStyle'));
        }

        return $this->render('parameter_graphic_style/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", methods={"POST"})
     */
    /*public function newApi(Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $parameterGraphicStyle,
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
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editParameterGraphicStyle")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterGraphicStyleRepository = $display->getRepository(ParameterGraphicStyle::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $parameterGraphicStyleRepository->find($id);

        $form = $this->createForm(ParameterGraphicStyleType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listParameterGraphicStyle'));
        }

        // ----------------------------------
        // On demande à la vue d'afficher la commande plus tous ses produits
        // ----------------------------------
        return $this->render('parameter_graphic_style/edit.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"POST"})
     */
    /*public function editApi($id, Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $parameterGraphicStyle,
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
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteParameterGraphicStyle")
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $parameterGraphicStyleRepository = $display->getRepository(ParameterGraphicStyle::class);

        $delete = $parameterGraphicStyleRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirect($this->generateUrl('listParameterGraphicStyle'));
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    /*public function deleteApi($id, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $parameterGraphicStyle,
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
     * @Route("/list", name="listParameterGraphicStyle", methods={"GET"})
     */
    public function list(Request $request/*, SerializerInterface $serializer*/)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $parameterGraphicStyleRepository = $display->getRepository(ParameterGraphicStyle::class);

        // Equivalent du SELECT *
        $list = $parameterGraphicStyleRepository->findAll();

        /*if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $parameterGraphicStyle,
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
            return $this->render('parameter_graphic_style/list.html.twig', ['listParameterGraphicStyle' => $list]);
            // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        //}
    }
}

?>
