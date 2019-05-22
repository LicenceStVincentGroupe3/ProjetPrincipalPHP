<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Company;
use App\AdminBundle\Entity\Commercial;
use App\AdminBundle\Entity\CompanyCountry;
use App\AdminBundle\Entity\CompanyTurnover;
use App\AdminBundle\Entity\CompanyCodeNAF;
use App\AdminBundle\Entity\CompanyStatus;
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
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\Entity;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\FileType;

class CompanyType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		//, 'required' => false
		$builder
			->add('CompanyCode', TextType::class, array('label' => 'Code entreprise', 'required' => true))
			->add('CompanyLastName', TextType::class, array('label' => 'Nom', 'required' => true))
			->add('CompanyPotential', IntegerType::class, array('label' => 'Potentiel', 'required' => false))
			->add('CompanyStatus', CheckboxType::class, array('label' => 'Statut', 'required' => false))
			->add('CompanyEmail', TextType::class, array('label' => 'Email', 'required' => false))
			->add('CompanyLogo', FileType::class, ['label' => 'Logo', 'required' => false, 'data_class' => null])
			->add('CompanyComments', TextareaType::class, array('label' => 'Commentaires','attr' => array('class' => 'tinymce'), 'required' => false))
			->add('CompanyAddress', TextType::class, array('label' => 'Adresse', 'required' => false))
			->add('CompanyPostalCode', TextType::class, array('label' => 'Code postal', 'required' => false))
			->add('CompanyCity', TextType::class, array('label' => 'Ville', 'required' => false))
			->add('CompanyStandardPhone', TextType::class, array('label' => 'Téléphone','required' => false))
			->add('CompanyFax', TextType::class, array('label' => 'Fax', 'required' => false))
			->add('CompanyWebSite', TextType::class, array('label' => 'Site web', 'required' => false))
			->add('CompanySiret', TextType::class, array('label' => 'N° SIRET', 'required' => false))
			->add('idCompanyCountry', EntityType::class, array('class' => CompanyCountry::class,'choice_label' => 'label', 'label'=>'Pays', 'placeholder'=>'', 'required' => false))
			->add('idCompanyStatus', EntityType::class, array('class' => CompanyStatus::class,'choice_label' => 'label', 'label'=>'Statut', 'placeholder'=>'', 'required' => true))
			->add('idUser', EntityType::class, array('class' => Commercial::class,'choice_label' => 'CommercialName', 'label'=>'Compte suivi par', 'placeholder'=>'', 'required' => false))
			->add('idCompanyNbEmployee', EntityType::class, array('class' => CompanyNbEmployee::class,'choice_label' => 'nbEmployee', 'label'=>'Effectifs', 'placeholder'=>'Non précisé', 'required' => false))
			->add('idCompanyTurnover', EntityType::class, array('class' => CompanyTurnover::class,'choice_label' => 'turnover', 'label'=>'Chiffre d\'affaires', 'placeholder'=>'Non précisé', 'required' => false))
			->add('idCompanyCodeNAF', EntityType::class, array('class' => CompanyCodeNAF::class,'choice_label' => 'label', 'label'=>'Activité (NAF)', 'placeholder'=>'Non précisé', 'required' => false))
			->add('idCompanyLegalStatus', EntityType::class, array('class' => CompanyLegalStatus::class,'choice_label' => 'label', 'label'=>'Statut juridique', 'placeholder'=>'', 'required' => false))
			->add('save', SubmitType::class, array('label' => 'Valider'))
	        ->getForm();
	}
}
?>
