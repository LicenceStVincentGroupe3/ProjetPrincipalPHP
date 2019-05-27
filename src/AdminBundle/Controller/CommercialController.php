<?php

namespace App\AdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\VarDumper\VarDumper;
use App\AdminBundle\Form\CommercialType;
use App\AdminBundle\Form\UserSettingsType;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Entity\Operations;
use App\AdminBundle\Entity\AffectedZone;
use Symfony\Component\HttpFoundation\RequestStack;
use Faker;

// Préfix url
/**
 * @Route("/commercial")
 */
class CommercialController extends AbstractController
{
    /**
     * @Route("/new", methods={"GET","POST"}, name="newCommercial")
     */
    public function new(Request $httpRequest, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                $new = new Commercial();

                // Variable qui contient le Repository
                $affectedZone = $display->getRepository(AffectedZone::class);

                // Variable qui contient le Repository
                $commercial = $display->getRepository(Commercial::class);

                // Equivalent du SELECT *
                $listZone = $affectedZone->findAllASC();

                $form = $this->createForm(CommercialType::class, $new);

                // Contient les name des <input>
                $formData = Request::createFromGlobals();

                // On récupère le name de la <select>
                $idZoneSelected = $formData->request->get('zone');

                // Si c'est le Directeur
                if ($this->isGranted('ROLE_DIRECTEUR')) {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'Directeur' => 'ROLE_DIRECTEUR',
                            'Responsable' => 'ROLE_RESPONSABLE',
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercial->listHierarchyDirAndResp('ROLE_DIRECTEUR','ROLE_RESPONSABLE');
                }
                // Sinon
                else {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercial->listHierarchyResp('ROLE_RESPONSABLE');
                }

                // On récupère le name de la <select>
                $idHierarchy = $formData->request->get('hierarchy');
                
                $form->handleRequest($httpRequest);

                if ($form->isSubmitted())
                {
                    $commercialPhoto = $form['commercialSexe']->getData();
                }

                if ($form->isSubmitted() && $form->isValid() && $httpRequest->isMethod('POST'))
                {
                    $new = $form->getData();

                    $password = $passwordEncoder->encodePassword($new, $new->getPlainPassword());
                    $role = $new->getCommercialProfil();

                    $commercialName = $form['commercialName']->getData();
                    $commercialFirstName = $form['commercialFirstname']->getData();
                    $commercialPhoto = $form['commercialPhoto']->getData();
                    
                    $file = $commercialPhoto;

                    if ($file !== null) 
                    {
                        $fileName = $file->getClientOriginalName();
                        $newFileName = $commercialName.'_'.$commercialFirstName.'_'.$fileName;

                        // On envoit le fichier dans le dossier images
                        try {
                            $file->move($this->getParameter('images_directory'), $newFileName);
                        } catch (FileException $e) {
                            // S'il y a un soucis pendant l'upload on catch
                        }

                        $new->setCommercialPhoto($newFileName);
                    }

                    // Si l'utilisateur n'a séléctioné aucune région
                    if ($idZoneSelected == "0")
                    {
                       $new->setIdAffectedZone(null);
                    }
                    // Sinon
                    else
                    {
                        // On récupère la région séléctionnée
                        $zoneSelected = $affectedZone->find($idZoneSelected);

                        // On l'attribut au commercial
                        $new->setIdAffectedZone($zoneSelected);
                    }

                    // Si l'utilisateur n'a séléctioné aucun responsable N+1
                    if ($idHierarchy == "0")
                    {
                       $new->setHierarchy(null);
                    }
                    // Sinon
                    else
                    {
                        $new->setHierarchy($idHierarchy);
                    }
 
                    $new->setPassword($password);
                    $new->addRole([0 => $role]);

                    $display->persist($new);
                    $display->flush();

                    $this->addFlash('success', 'Votre compte à bien été enregistré.');

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                return $this->render('commercial/new.html.twig', ['form' => $form->createView(), 'listZone' => $listZone, 'listHierarchy' => $listHierarchy, 'comCode' => Faker\Factory::create('fr_FR'), 'commercialTeamLink' => true]);
            }
            
            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/edit/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="editCommercial")
     */
    public function edit($id, Request $httpRequest, UserPasswordEncoderInterface $passwordEncoder)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {

            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                $commercialRepository = $display->getRepository(Commercial::class);
                $affectedZone = $display->getRepository(AffectedZone::class);
                $companyRepository = $display->getRepository(Company::class);
                $contactRepository = $display->getRepository(Contact::class);

                // Equivalent du SELECT * where id=(paramètre)
                $edit = $commercialRepository->find($id);

                // Equivalent du SELECT *
                $listZone = $affectedZone->findAllASC();

                // Appel de la fonction countCompany() du repository de la classe Company
                $nbCompany = $companyRepository->countCompany($id);

                // Appel de la fonction listCompanyOfCommercial() du repository de la classe Company
                $listCompany = $companyRepository->listCompanyOfCommercial($id);

                // Appel de la fonction countContact() du repository de la classe Contact
                $nbContact = $contactRepository->countContact($id);


                $nbContactCompany = $contactRepository->countContactOfCompany($id);

                $nbsContact = [];
                // Equivalent du SELECT *
                $list = $companyRepository->findAll();
                foreach ($list as $key => $value) {
                    // La clé de l'array devient l'id du commercial
                    $key = $value->getId();

                    // Appel de la fonction countContact() du repository de la classe Contact
                    $nbContactC = $contactRepository->countContactOfCompany($value->getId());

                    // Array $nbsContact
                    $nbsContact += [$key => $nbContactC[1]]; // Exemple $nbsContact = [2 => 48]
                }

                // Appel de la fonction listContactOfCommercial() du repository de la classe Contact
                $listContact = $contactRepository->listContactOfCommercial($id);

                $form = $this->createForm(CommercialType::class, $edit);

                // Contient les name des <input>
                $formData = Request::createFromGlobals();

                // On récupère le name de la <select>
                $idZoneSelected = $formData->request->get('zone');


                $form->add('commercialStatus', CheckboxType::class, ['label' => 'Actif', 'required' => false]);

                // Si c'est le Directeur
                if ($this->isGranted('ROLE_DIRECTEUR')) {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'A définir' => null,
                            'Directeur' => 'ROLE_DIRECTEUR',
                            'Responsable' => 'ROLE_RESPONSABLE',
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercialRepository->listHierarchyDirAndResp('ROLE_DIRECTEUR','ROLE_RESPONSABLE');
                }
                // Sinon
                else {
                    $form->add('commercialProfil', ChoiceType::class, [
                        'choices'  => [
                            'A définir' => null,
                            'Commercial' => 'ROLE_COMMERCIAL'
                        ]
                    ]);

                    $listHierarchy = $commercialRepository->listHierarchyResp('ROLE_RESPONSABLE');
                }

                // On récupère le name de la <select>
                $idHierarchy = $formData->request->get('hierarchy');

                $responsableN1 = $commercialRepository->hierarchyN1($edit->getHierarchy());


                $form->handleRequest($httpRequest);

                if ($form->isSubmitted() && $form->isValid() && $httpRequest->isMethod('POST'))
                {
                    $edit = $form->getData();

                    $role = $edit->getCommercialProfil();

                    $commercialName = $edit->getCommercialName();
                    $commercialFirstName = $edit->getCommercialFirstname();
                    $commercialPhoto = $form['commercialPhoto']->getData();
                    $plainPassword = $form['plainPassword']->getData();

                    $file = $commercialPhoto;

                    $entityManager = $this->getDoctrine()->getManager();

                    if ($file !== null) 
                    {
                        // On vérifie si le fichier est en base
                        if($edit->getCommercialPhoto() !== null) 
                        {
                            // Variable qui contient l'ancien fichier
                            $oldFile = $this->getParameter('images_directory').'/'.
                              $edit->getCommercialPhoto();

                            // On supprime l'ancien fichier en local
                            if (file_exists($oldFile)) {
                                unlink($oldFile);
                            }
                        }

                        $fileName = $file->getClientOriginalName();
                        $newFileName = $commercialName.'_'.$commercialFirstName.'_'.$fileName;

                        // On envoit le fichier dans le dossier images
                        try {
                            $file->move($this->getParameter('images_directory'), $newFileName);
                        } catch (FileException $e) {
                            // S'il y a un soucis pendant l'upload on catch
                        }

                        $edit->setCommercialPhoto($newFileName);
                    }

                    // Si l'utilisateur n'a séléctioné aucune région
                    if ($idZoneSelected == "0")
                    {
                       $edit->setIdAffectedZone(null);
                    }
                    // Sinon
                    else
                    {
                        // On récupère la région séléctionnée
                        $zoneSelected = $affectedZone->find($idZoneSelected);

                        // On l'attribut au commercial
                        $edit->setIdAffectedZone($zoneSelected);
                    }

                    // Si l'utilisateur n'a séléctioné aucun responsable N+1
                    if ($idHierarchy == "0")
                    {
                       $edit->setHierarchy(null);
                    }
                    // Sinon
                    else
                    {
                        $edit->setHierarchy($idHierarchy);
                    }

                    // Si le profil du commercial change
                    if ($edit->getRoles()[0] !== $role) {
                        $edit->addRole([0 => $role]);
                    }

                    if ($plainPassword !== null) 
                    {
                        $password = $passwordEncoder->encodePassword($edit, $edit->getPlainPassword());
                        $edit->setPassword($password);
                    }

                    $edit->setCommercialLastUpdate(new \DateTime());

                    $entityManager->flush();

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                // ----------------------------------
                // On demande à la vue d'afficher la commande plus tous ses produits
                // ----------------------------------
                return $this->render('commercial/edit.html.twig', ['editCom' => $edit, 'form' => $form->createView(), 'listZone' => $listZone, 'listHierarchy' => $listHierarchy, 'responsableN1' => $responsableN1, 'listCompany' => $listCompany, 'nbCompany' => $nbCompany, 'listContact' => $listContact, 'nbContact' => $nbContact, 'nbContactListCompany' => $nbsContact, 'nbContactCompany' => $nbContactCompany, 'commercialTeamLink' => true]);
            }

            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }

    }

    /**
     * @Route("/delete/{id}", name="deleteCommercial", requirements={"id"="\d+"}, methods={"GET","POST"})
     */
    public function delete($id)
    {
        // Appel de Doctrine
        $display = $this->getDoctrine()->getManager();
        $commercialRepository = $display->getRepository(Commercial::class);
        $operationsRepository = $display->getRepository(Operations::class);
        $contactRepository = $display->getRepository(Contact::class);

        $commercialRepository->resetHierarchy([$id]);
        $operationsRepository->resetOperation([$id]);
        $contactRepository->resetContacts([$id]);
        $commercialRepository->activeArchive([$id]);

        return $this->redirectToRoute('listCommercial');
    }

    /**
     * @Route("/list", name="listCommercial", methods={"GET","POST"})
     */
    public function list(Request $httpRequest)
    {
        if ($this->isGranted('ROLE_COMMERCIAL')) {
            
            if ($this->isGranted('ROLE_RESPONSABLE')) {
                // Déclaration des variables
                $nbsCompany = [];
                $nbsContact = [];

                // Appel de Doctrine
                $display = $this->getDoctrine()->getManager();

                // Variable qui contient le Repository
                $commercialRepository = $display->getRepository(Commercial::class);
                $operationsRepository = $display->getRepository(Operations::class);
                $companyRepository = $display->getRepository(Company::class);
                $contactRepository = $display->getRepository(Contact::class);

                // Si c'est le Directeur
                if ($this->isGranted('ROLE_DIRECTEUR')) {
                    // Equivalent du SELECT *
                    $list = $commercialRepository->findBy(['archived' => false]);
                }
                // Sinon
                else {
                    // Equivalent du SELECT xxx FROM xxx::class WHERE xxx
                    $list = $commercialRepository->listCommercialsOfUser($this->getUser()->getId());
                }

                // Pour récupérer le nombre d'entreprise et contact géré par un commercial
                foreach ($list as $key => $value) {
                    // La clé de l'array devient l'id du commercial
                    $key = $value->getId();

                    // Appel de la fonction countCompany() du repository de la classe Company
                    $nbCompany = $companyRepository->countCompany($value->getId());

                    // Appel de la fonction countContact() du repository de la classe Contact
                    $nbContact = $contactRepository->countContact($value->getId());

                    // Array $nbsCompany
                    $nbsCompany += [$key => $nbCompany[1]]; // Exemple $nbsCompany = [2 => 48]

                    // Array $nbsContact
                    $nbsContact += [$key => $nbContact[1]]; // Exemple $nbsContact = [2 => 48]
                }
                

                // Dans le cas d'une suppression d'un(ou plusieurs) commercial(commerciaux)
                if ($httpRequest->isMethod('POST'))
                {
                    // Contient les name des <input>
                    $formData = Request::createFromGlobals();

                    // On récupère le name de la checkbox
                    $listData = $formData->request->get('deleteData');

                    // Si l'utilisateur a coché une checkbox
                    if ($listData != null) {
                        // Appel des fonctions resetHierarchy() et activeArchive()
                        $commercialRepository->resetHierarchy($listData);
                        $commercialRepository->activeArchive($listData);
                        $operationsRepository->resetOperation($listData);
                        $contactRepository->resetContacts($listData);
                    }

                    return $this->redirect($this->generateUrl('listCommercial'));
                }

                // ----------------------------------
                // On demande à la vue d'afficher la liste des commandes
                // ----------------------------------
                return $this->render('commercial/list.html.twig', ['listCom' => $list, 'nbCompany' => $nbsCompany, 'nbContact' => $nbsContact, 'commercialTeamLink' => true]);
                // On affecte notre tableau contenant la(les) valeur(s) de la variable à la vue
                }
            
            else {
                return $this->redirect($this->generateUrl('index'));
            }
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }
    }

    /**
     * @Route("/settings/{id}", requirements={"id"="\d+"}, methods={"GET","POST"}, name="settingsCommercial")
     */
    public function settings(Request $request, Commercial $commercial, UserPasswordEncoderInterface $passwordEncoder)
    {

        if ($this->isGranted('ROLE_COMMERCIAL')) {
            $form = $this->createForm(UserSettingsType::class, $commercial);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
                $edit = $form->getData();

                $plainPassword = $form['plainPassword']->getData();
                $commercialPhoto = $form['commercialPhoto']->getData();
                $file = $commercialPhoto;

                $entityManager = $this->getDoctrine()->getManager();

                if ($file !== null) 
                {
                    // On vérifie si le fichier est en base
                    if($edit->getCommercialPhoto() !== null) 
                    {
                        // Variable qui contient l'ancien fichier
                        $oldFile = $this->getParameter('images_directory').'/'.
                          $edit->getCommercialPhoto();

                        // On supprime l'ancien fichier en local
                        if (file_exists($oldFile)) {
                            unlink($oldFile);
                        }
                    }

                    $fileName = $file->getClientOriginalName();
                    $newFileName = $commercialName.'_'.$commercialFirstName.'_'.$fileName;

                    // On envoit le fichier dans le dossier images
                    try {
                        $file->move($this->getParameter('images_directory'), $newFileName);
                    } catch (FileException $e) {
                        // S'il y a un soucis pendant l'upload on catch
                    }

                    $edit->setCommercialPhoto($newFileName);
                }

                if ($plainPassword !== null) 
                {
                    $password = $passwordEncoder->encodePassword($edit, $edit->getPlainPassword());
                    $edit->setPassword($password);
                }

                $edit->setCommercialLastUpdate(new \DateTime());

                $entityManager->flush();

                return $this->redirect($this->generateUrl('index'));
            }

            return $this->render('commercial/settings.html.twig', [
                'form' => $form->createView(),
                'commercial' => $commercial
            ]);
        }

        else {

            return $this->redirect($this->generateUrl('login'));
        }
    }
}
