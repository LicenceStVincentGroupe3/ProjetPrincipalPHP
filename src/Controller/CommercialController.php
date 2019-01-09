<?php

namespace App\Controller;

use App\Entity\Commercial;
use App\Form\CommercialType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
/*use App\Controller\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;*/

// Préfix url
//* @Groups({"Light"})
//* @MaxDepth(1)
/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
    /* ---------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    ------------------------------------------------------------------------
    */

    /**
     * @Route("/new", methods={"GET","POST"}, name="newCommercial")
     */
    public function new(Request $request)
    {
    	$newCommercial = new Commercial();

    	$form = $this->createForm(CommercialType::class, $newCommercial);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newCommercial = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newCommercial);
            $entityManager->flush();

            return $this->redirect($this->generateUrl('listCommercial'));
        }

        return $this->render('commercial/new.html.twig', ['form' => $form->createView()]);
    }

    /**
     * @Route("/", methods={"POST"})
     */
    /*public function newApi(Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $commercial,
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
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editCommercial")
     */
    public function edit($id, Request $request)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $commercialRepository = $display->getRepository(Commercial::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $commercialRepository->find($id);

        $form = $this->createForm(CommercialType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $edit->setCommercialLastUpdate(new \DateTime());

            $entityManager->flush();

            return $this->redirect($this->generateUrl('listCommercial'));
        }

        // ----------------------------------
        // On demande à la vue d'afficher la commande plus tous ses produits
        // ----------------------------------
        return $this->render('commercial/edit.html.twig', ['editCom' => $edit, 'form' => $form->createView()]);
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"POST"})
     */
    /*public function editApi($id, Request $request, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $commercial,
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
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteCommercial")
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        $commercialRepository = $display->getRepository(Commercial::class);

        $delete = $commercialRepository->find($id);

        $display->remove($delete);

        $display->flush();

        return $this->redirect($this->generateUrl('listCommercial'));
    }

    /**
     * @Route("/", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    /*public function deleteApi($id, SerializerInterface $serializer)
    {
        $json = $serializer->serialize(
            $commercial,
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
     * @Route("/list", name="listCommercial", methods={"GET"})
     */
    public function list(Request $request/*, SerializerInterface $serializer*/)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $commercialRepository = $display->getRepository(Commercial::class);

        // Equivalent du SELECT *
        $list = $commercialRepository->findAll();

        /*if ($request->isXmlHttpRequest()) {
            $json = $serializer->serialize(
                $commercial,
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
            return $this->render('commercial/list.html.twig', ['listCom' => $list]);
            // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
        //}
    }
}

?>