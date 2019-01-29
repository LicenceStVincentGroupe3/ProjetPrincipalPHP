<?php

namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\CompanyNbEmployee;
use App\AdminBundle\Form\CompanyNbEmployeeType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

/**
 * @Route("/company/NbEmployee")
 */
class CompanyNbEmployeeController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request)
    {
        $newNbEmployee = new CompanyNbEmployee();
        $form = $this->createForm(CompanyNbEmployeeType::class, $newNbEmployee);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $newNbEmployee = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($newNbEmployee);
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
        $editNbEmployee = $this->getDoctrine()->getManager()->getRepository(CompanyNbEmployee::class)->find($id);

        $form = $this->createForm(CompanyNbEmployeeType::class, $editNbEmployee);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) 
        {
            $editNbEmployee = $form->getData();

            $entityManager = $this->getDoctrine()->getManager();

            $entityManager->flush();

            $json = $serializer->serialize(
                $editNbEmployee,
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

        // On crée un objet, instance de CompanyNbEmployee
        $suppNbEmployee = new CompanyNbEmployee();

        $suppNbEmployee = $suppBD->getRepository(CompanyNbEmployee::class)->find($id);

        // Suppression de la tranche de nombre d'employés
        $suppBD->remove($suppNbEmployee);

        // Exécution
        $suppBD->flush();

        $json = $serializer->serialize(
            $suppNbEmployee,
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
        // ---------------------------------------------------------------
        // Récupération de la liste des tranches de nombre d'employés
        // ---------------------------------------------------------------
        $repository = $this->getDoctrine()->getManager()->getRepository(CompanyNbEmployee::class);

        $listNbEmployee = $repository->findAll();
        // -------------------------------------------------------------------------
        // On demande à la vue d'afficher la liste des tranches de nombre d'employés
        // -------------------------------------------------------------------------
        $json = $serializer->serialize(
            $listNbEmployee,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }
}
