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
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContactType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('contactCode', TextType::class, array('label' => 'Code'))
    		->add('contactLastName', TextType::class, array('label' => 'Nom'))
    		->add('contactFirstName', TextType::class,  array('label' => 'Prénom'))

    		->add('contactGender', ChoiceType::class, array('choices' => array('Homme'=>0, 'Femme'=>1)))

    		->add('contactBirthDate', DateType::class,  array('label' => 'Date de naissance', 'widget' => 'single_text', 'required' => false))
    		->add('contactEmail', EmailType::class, array('label' => 'Email', 'required' => false))
    		->add('contactMobilePhone', TelType::class, array('label' => 'Tel. Mobile', 'required' => false))
    		->add('contactDirectLandline', TelType::class, array('label' => 'Tel. Fixe direct', 'required' => false))
			->add('contactStandartPhone', TelType::class, array('label' => 'Tel. du standard', 'required' => false))
            ->add('contactLinkedinAddress', UrlType::class, array('label' => 'Profil Linkedin', 'required' => false))
			->add('contactFacebookAddress', UrlType::class, array('label' => 'Profil Facebook', 'required' => false))
			->add('contactTwitterAddress', UrlType::class, array('label' => 'Profil Twitter', 'required' => false))
			->add('contactPoste', TextType::class, array('label' => 'Nom du poste', 'required' => false))
			->add('contactPhoto', FileType::class, ['label' => 'Photo', 'required' => false,
				'data_class' => null])
			->add('arrivalDate', DateType::class, ['label' => 'Début/fin du poste', 'required' => false,
				'widget' => 'single_text'
			])
			->add('departureDate', DateType::class, ['label' => 'Date de départ', 'required' => false,
				'widget' => 'single_text'
			])
            ->add('contactComment', TextareaType::class, array('label' => 'Remarques', 'required' => false))

    		->add('idUser', EntityType::class, array('class' => Commercial::class,'choice_label' => 'commercialName', 'label' => 'Commercial', 'placeholder'=>'', 'required' => false))

    		->add('idCompany', EntityType::class, array('class' => Company::class, 'choice_label' => 'CompanyLastName', 'label'=>'Entreprise', 'placeholder'=>'', 'required' => false))

    		->add('contactDecisionLevel', ChoiceType::class, array('choices' => array('Employé'=>1, 'Cadre'=>2, 'Cadre supérieur'=>3, 'Manager'=>4, 'Directeur'=>5), 'required' => false))

    		->add('idContactJob', EntityType::class, array('class' => ContactJob::class, 'choice_label' => 'contactJobName', 'label'=>'Métier', 'placeholder'=>'', 'required' => false))

    		->add('contactOptInCommercialOffers', CheckboxType::class, array('label'    => 'Informations','required' => false))

    		->add('contactOptInNewsletterCustomers', CheckboxType::class, array( 'label'    => 'Offres commerciales', 'required' => false))

            // Bouton Submit //
            ->add('save', SubmitType::class, array('label' => 'ENREGISTRER'))->getForm();
    	;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
		'data_class' => Contact::class]);	
	}
}
?>
