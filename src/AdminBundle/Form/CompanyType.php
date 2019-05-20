<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Entity\CompanyActivitySector;
use App\AdminBundle\Entity\CompanyBusinessCategory;
use App\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Entity\CompanyLastTurnover;
use App\AdminBundle\Entity\CompanyLegalStatus;
use App\AdminBundle\Entity\CompanyNbEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CompanyType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder			
			->add('CompanyCode', TextType::class, array('label' => 'Code entreprise'))
			->add('CompanyLastName', TextType::class, array('label' => 'Nom'))
			->add('CompanyDateCreatedPlug', DateType::class, array('label' => 'Date de création de la fiche'))
			->add('CompanyDateUpdate', DateType::class, array('label' => 'Date de la dernière mise à jour'))
			->add('CompanyCodeCommercial', TextType::class, array('label' => 'Code du commercial'))
			->add('CompanyStatus', CheckboxType::class, array('label' => 'Status'))
			->add('CompanyLogo', FileType::class, ['label' => 'Logo', 'required' => false,
				'data_class' => null])
			->add('CompanyComments', TextareaType::class, array('label' => 'Commentaires','attr' => array('class' => 'tinymce')))
			->add('CompanyAddress', TextType::class, array('label' => 'Adresse'))
			->add('CompanyPostalCode', TextType::class, array('label' => 'Code postal'))
			->add('CompanyCity', TextType::class, array('label' => 'Ville'))
			->add('CompanyStandardPhone', TextType::class, array('label' => 'Numéro de téléphone'))
			->add('CompanyFax', TextType::class, array('label' => 'Fax'))
			->add('CompanyWebSite', TextType::class, array('label' => 'URL du site web'))
			->add('CompanyCreationDate', DateType::class, array('label' => 'Date de création de l\'entreprise', 'widget' => 'single_text'))
			->add('CompanySiret', TextType::class, array('label' => 'N° SIRET'))
			->add('CompanyCodeNAF', TextType::class, array('label' => 'Activité (NAF)'))
			->add('CompanySource', TextType::class, array('label' => 'Source'))
			->add('idCompanyCountry', EntityType::class, array('class' => CompanyCountry::class,'choice_label' => 'label', 'label'=>'Pays'))
			->add('idCompanyLegalStatus', EntityType::class, array('class' => CompanyLegalStatus::class,'choice_label' => 'label', 'label'=>'Status légal'))
			->add('idUser', EntityType::class, array('class' => Commercial::class,'choice_label' => 'CommercialName', 'label'=>'Utilisateur'))
			->add('idCompanyActivitySector', EntityType::class, array('class' => CompanyActivitySector::class,'choice_label' => 'label', 'label'=>'Secteur d\'activité'))
			->add('idCompanyBusinessCategory', EntityType::class, array('class' => CompanyBusinessCategory::class,'choice_label' => 'label', 'label'=>'Catégorie d\'affaire'))
			->add('idCompanyNbEmployee', EntityType::class, array('class' => CompanyNbEmployee::class,'choice_label' => 'nbEmployee', 'label'=>'Effectifs'))
			->add('idCompanyTurnover', EntityType::class, array('class' => CompanyTurnover::class,'choice_label' => 'turnover', 'label'=>'Chiffre d\'affaires'))
			->add('idCompanyLastTurnover', EntityType::class, array('class' => CompanyLastTurnover::class,'choice_label' => 'turnover', 'label'=>'Dernier chiffre d\'affaire'))
	        ->add('save', SubmitType::class, array('label' => 'Valider'))
	        ->getForm();
	}
}
?>
