<?php
namespace App\AdminBundle\Controller;
use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Form\ContactType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
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
                $display = $this->getDoctrine()->getManager();
                $form = $this->createForm(ContactType::class, $contact);
                $repository = $display->getRepository(Contact::class);
                $listContact = $repository->findAll();

                // La méthode handleRequest de la class form permet de récupérer les valeurs des champs dans les imputs du formulaire //
                $form->handleRequest($request);

                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $contact = $form->getData();
                    $contactPhoto = $form['contactPhoto']->getData();
                    $contactLastName = $form['contactLastName']->getData();
                    $contactFirstName = $form['contactFirstName']->getData();

                $file = $contactPhoto;

                if ($file !== null)
                {
                    $fileName = $file->getClientOriginalName();
                    $newFileName = $contactLastName.'_'.$contactFirstName.'_'.$fileName;

                    // On envoit le fichier dans le dossier images
                    try {
                        $file->move($this->getParameter('images_directory'), $newFileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $contact->setContactPhoto($newFileName);
                }

                $entityManager = $this->getDoctrine()->getManager();
                // Persist prépare l'entité "contact" pour la création //
                $entityManager->persist($contact);
                // Flush envoie les infos en base (ajout) //
                $entityManager->flush();
                return $this->redirect($this->generateUrl('listCont'));
                //return $this->render('contact/new.html.twig', array('form' => $form->createView(),));
                }
                return $this->render('contact/new.html.twig', array('form' => $form->createView(), 'lesContacts' => $listContact));
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editContact")
     */
    public function edit($id, Request $request)
    {
                // Appel de Doctrine
                $repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
                $editContact = $repository->find($id);

                $display = $this->getDoctrine()->getManager();

                $repository = $display->getRepository(Contact::class);
                $listContact = $repository->findAll();

                // Equivalent du SELECT * where id=(paramètre) //
                $form = $this->createForm(ContactType::class, $editContact);
                $form->add('contactStatus', CheckboxType::class, array(
                    'label'    => 'Statut Actif',
                    'required' => false));

                $form->handleRequest($request);
                if ($form->isSubmitted() && $form->isValid() && $request->isMethod('POST')) {
                    $editContact = $form->getData();
                    $contactPhoto = $form['contactPhoto']->getData();
                    $contactLastName = $form['contactLastName']->getData();
                    $contactFirstName = $form['contactFirstName']->getData();

                    $file = $contactPhoto;

                    $entityManager = $this->getDoctrine()->getManager();

                    if ($file !== null)
                    {
                        // On vérifie si le fichier est en base
                        if($editContact->getContactPhoto() !== null)
                        {
                            // Variable qui contient l'ancien fichier
                            $oldFile = $this->getParameter('images_directory').'/'.
                                $editContact->getContactPhoto();

                            // On supprime l'ancien fichier en local
                            if (file_exists($oldFile)) {
                                unlink($oldFile);
                            }
                        }

                        $fileName = $file->getClientOriginalName();
                        $newFileName = $contactLastName.'_'.$contactFirstName.'_'.$fileName;

                        // On envoit le fichier dans le dossier images
                        try {
                            $file->move($this->getParameter('images_directory'), $newFileName);
                        } catch (FileException $e) {
                            // S'il y a un soucis pendant l'upload on catch
                        }

                        $editContact->setContactPhoto($newFileName);
                    }
                    $editContact->setContactDateUpdatePlug(new \DateTime());
                    $entityManager->flush();

                    return $this->redirect($this->generateUrl('listCont'));
                }
                return $this->render('contact/edit.html.twig', array('form' => $form->createView(), 'lesContacts' => $listContact, 'editContact' => $editContact ));
    }


    /**
     * @Route("/list", name="listCont", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();
                // récup de la liste des contacts
                //$repository = $this->getDoctrine()->getManager()->getRepository(Contact::class);
                $repository = $display->getRepository(Contact::class);
                $listContact = $repository->findAll();

                if ($httpRequest->isMethod('POST'))
                {
                    // Appel de Doctrine
                    $display = $this->getDoctrine()->getManager();

                    $contactRepository = $display->getRepository(Contact::class);

                    // Contient les name des <input>
                    $formData = Request::createFromGlobals();

                    // On récupère le name de la checkbox
                    $listData = $formData->request->get('deleteData');

                    // Si l'utilisateur a coché une checkbox
                    if ($listData != null) {
                        // Appel de la fonction deleteCommercial()
                        $contactRepository->deleteContact($listData);
                    }

                    return $this->redirect($this->generateUrl('listCont'));
                }
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
