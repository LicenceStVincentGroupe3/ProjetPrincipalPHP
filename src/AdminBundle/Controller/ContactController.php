<?php
namespace App\AdminBundle\Controller;
use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\VarDumper\VarDumper;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
/**
 * @Route("/contact")
 */
class ContactController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newContact")
     */
    public function new(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
                $contact = new Contact();
                $form = $this->createForm(ContactType::class, $contact);

                // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid()) {
                    $contact = $form->getData();
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
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editContact")
     */
    public function edit($id, Request $request)
    {
                // Appel de Doctrine
                $repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
                $editContact = $repository->find($id);
                // Equivalent du SELECT * where id=(paramètre) //
                $form = $this->createForm(ContactType::class, $editContact);

                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $editContact = $form->getData();
                    $entityManager = $this->getDoctrine()->getManager();
                    $editContact->setContactDateUpdatePlug(new \DateTime());
                    $entityManager->flush();

                    return $this->redirect($this->generateUrl('listCont'));
                }
                return $this->render('contact/edit.html.twig', ['editContact' => $editContact, 'form' => $form->createView()]);
    }

    /**
     * @Route("/delete/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="deleteContact")
     */
    public function delete($id)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_DIRECTEUR')) {
                $suppBD = $this->getDoctrine()->getManager();
                // On créer un objet instance de contact
                $suppContact = $suppBD->getRepository(Contact::class)->find($id);
                // Suppression du contact
                $suppBD->remove($suppContact);
                // Execution
                $suppBD->flush();
                return $this->redirectToRoute('listCont');
            } else {
                return $this->redirect($this->generateUrl('index'));
            }
        } else {

            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/list", name="listCont", methods={"GET"})
     */
    public function list()
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();
                // récup de la liste des contacts
                //$repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
                $repository = $display->getRepository(Contact::class);
                $listContact = $repository->findAll();
                // --------------------------
                // on demande à la vue d'afficher la liste des contacts
                // --------------------------
                return $this->render('contact/list.html.twig', array('lesContacts' => $listContact, 'contactTeamLink' => true));
            } else {
                return $this->redirect($this->generateUrl('index'));
            }
        } else {

            return $this->redirect($this->generateUrl('login'));
        }
    }
}
