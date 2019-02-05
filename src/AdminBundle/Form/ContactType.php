<?php
namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Contact;
use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Entity\ContactJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContactType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
            ->add('contactStatus', CheckboxType::class, array(
                'label'    => 'Statut Actif',
                'required' => false))       
			->add('contactCode', TextType::class, array('label' => 'Code'))
    		->add('contactLastName', TextType::class, array('label' => 'Nom'))
    		->add('contactFirstName', TextType::class,  array('label' => 'Prénom'))

    		->add('contactGender', ChoiceType::class, array('choices' => array('Homme'=>0, 'Femme'=>1)))

    		->add('contactBirthDate', DateType::class,  array('label' => 'Date de naissance'))
    		->add('contactEmail', TextType::class, array('label' => 'Email'))
    		->add('contactMobilePhone', TextType::class, array('label' => 'Tel. Mobile'))
    		->add('contactDirectLandline', TextType::class, array('label' => 'Tel. Fixe direct'))
            ->add('contactLinkedinAddress', TextType::class, array('label' => 'Adresse Linkedin'))
            ->add('contactPhoto', TextType::class, array('label' => 'Photo'))   
            ->add('contactSourceOperation', TextType::class, array('label' => 'Opération source'))
            ->add('contactComment', TextareaType::class, array('label' => 'Commentaire'))  

    		->add('idUser', EntityType::class, array('class' => Commercial::class,'choice_label' => 'CommercialName', 'label'=>'Commercial'))

    		->add('idCompany', EntityType::class, array('class' => Company::class, 'choice_label' => 'CompanyLastName', 'label'=>'Entreprise'))

    		->add('contactDecisionLevel', ChoiceType::class, array('choices' => array('Très faible'=>1, 'Faible'=>2, 'Moyen'=>3, 'Elevé'=>4, 'Très elevé'=>5)))

    		->add('idContactJob', EntityType::class, array('class' => ContactJob::class, 'choice_label' => 'contactJobName', 'label'=>'Poste' ))

    		->add('contactOptInCommercialOffers', CheckboxType::class, array('label'    => 'Autoriser HAFA à envoyer des informations','required' => false))

    		->add('contactOptInNewsletterCustomers', CheckboxType::class, array( 'label'    => 'Autoriser le contact à recevoir un bulletin d\'information client', 'required' => false))

            // Bouton Submit //
            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->add('save2', SubmitType::class, array('label' => 'Enregistrer et envoyer l\'invitation'))->getForm();            
    	;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
		'data_class' => Contact::class]);	
	}
}
?>
