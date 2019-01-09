<?php
namespace App\Controller;
use App\Entity\Contact;
use App\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\VarDumper\VarDumper;
/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/new", name="new")
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
           VarDumper::dump($contact);
           $entityManager = $this->getDoctrine()->getManager();
           // Persist prépare l'entité "contact" pour la création //
           $entityManager->persist($contact);
           // Flush envoie les infos en base (ajout) //
           $entityManager->flush();
           return $this->redirect($this->generateUrl('listCont'));
           //return $this->render('contact/new.html.twig', array('form' => $form->createView(),));
        }   
        return $this->render('contact/new.html.twig', array('form' => $form->createView(),));
    }
    /**
     * @Route("/edit/{id}", name="edit")
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

            return $this->redirect($this->generateUrl('listCont'));
        }
        return $this->render('contact/edit.html.twig', ['editContact' => $editContact, 'form' => $form->createView()]);
    } 
    /**
     * @Route("/delete/{id}", name="delete", requirements={"id"="\d+"})
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
        return $this->redirectToRoute('listCont');
    }
    /**
     * @Route("/list", name="listCont")
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
        return $this->render('contact/list.html.twig', array('lesContacts'=>$listContact));
    }           
}