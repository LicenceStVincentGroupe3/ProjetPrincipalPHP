<?php
namespace App\ApiBundle\Controller;

use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;
/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/", methods={"POST"})
     */
    public function new(Request $request)
    {
        $contact = new Contact();
        $form = $this->createForm(ContactType::class, $contact);
        // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
        $form->handleRequest($request);
    
        if($form->isSubmitted() && $form->isValid())
        {
            $contact=$form->getData();

            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact);
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
        $repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $editContact = $repository->find($id);
        // Equivalent du SELECT * where id=(paramètre) //
        $form = $this->createForm(ContactType::class, $editContact);
        $form->handleRequest($request);
        if($form->isSubmitted() && $form->isValid() && $request->isMethod('POST'))
        {
            $editContact = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $editContact->setContactDateUpdatePlug(new \DateTime());
            $entityManager->flush();

            $json = $serializer->serialize(
                $editContact,
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
        // On créer un objet instance de contact
        $suppContact = $suppBD->getRepository(Contact::class)->find($id);
        // Suppression du contact
        $suppBD->remove($suppContact);
        // Execution
        $suppBD->flush();

        $json = $serializer->serialize(
            $suppContact,
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
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        // récup de la liste des contacts
        //$repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
        $repository = $display->getRepository(Contact::class);
        $listContact = $repository->findAll();
        // --------------------------
        // on demande à la vue d'afficher la liste des contacts
        // --------------------------
        $json = $serializer->serialize(
            $listContact,
            'json',
            ['groups'=>["Light"]]
        );

        $response = new Response();
        $response->setContent($json);
        $response->headers->set('Content-type', 'application/JSON');

        return $response;
    }           
}
