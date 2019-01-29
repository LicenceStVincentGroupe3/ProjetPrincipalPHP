<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Form\CompanyTurnOverType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/turnOver")
 */
class CompanyTurnOverController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
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

            $json = $serializer->serialize(
                'json',
                ['groups'=>["Light"]]);

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"PUT"})
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

            $json = $serializer->serialize(
                $editTurnOver,
                'json',
                ['groups'=>["Light"]]
            );

            $response = new Response();
            $response->setContent($json);
            $response->headers->set('Content-type', 'application/JSON');

            return $response;
        }
    }

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"DELETE"})
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

        $json = $serializer->serialize(
            $suppTurnOver,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }

    /**
     * @Route("/", methods={"GET"})
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
        $json = $serializer->serialize(
            $listTurnOver,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }
}
