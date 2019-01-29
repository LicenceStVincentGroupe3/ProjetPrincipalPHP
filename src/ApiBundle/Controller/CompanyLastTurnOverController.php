<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\CompanyLastTurnover;
use App\AdminBundle\Form\CompanyLastTurnOverType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/lastTurnOver")
 */
class CompanyLastTurnOverController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request, SerializerInterface $serializer)
    {
        $newLastTurnOver = new CompanyLastTurnover();
        $form = $this->createForm(CompanyLastTurnOverType::class, $newLastTurnOver);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $newLastTurnOver = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newLastTurnOver);
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
    public function edit($id, Request $request, SerializerInterface $serializer)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();

        // Variable qui contient le Repository
        $lastTurnoverRepository = $display->getRepository(CompanyLastTurnover::class);

        // Equivalent du SELECT * where id=(paramètre)
        $edit = $lastTurnoverRepository->find($id);

        $form = $this->createForm(CompanyLastTurnoverType::class, $edit);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('PUT'))
        {
            $edit = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $json = $serializer->serialize(
                $edit,
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
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"DELETE")
     */
    public function delete($id, SerializerInterface $serializer)
    {
        $suppBD = $this->getDoctrine()->getManager();

        // On crée un objet, instance de CompanyTurnover
        $suppLastTurnOver = new CompanyLastTurnover();

        $suppLastTurnOver = $suppBD->getRepository(CompanyLastTurnover::class)->find($id);

        // Suppression du chiffre d'affaire
        $suppBD->remove($suppLastTurnOver);

        // Exécution
        $suppBD->flush();

        $json = $serializer->serialize(
            $suppLastTurnOver,
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
    public function list(SerializerInterface $serializer)
    {
        // ---------------------------------------
        // Récupération de la liste des derniers chiffres d'affaires
        // ---------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyLastTurnover::class);

        $listLastTurnOver = $repository->findAll();
        // -------------------------------------------------------------
        // On demande à la vue d'afficher la liste des derniers chiffres d'affaires
        // -------------------------------------------------------------
        $json = $serializer->serialize(
            $listLastTurnOver,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }

}
