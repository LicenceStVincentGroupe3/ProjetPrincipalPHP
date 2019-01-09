<?php

namespace App\Form;

use App\Entity\CompanyActivitySector;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\Entity;

class CompanyActivitySectorType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('label', TextType::class, array('label' => 'Libelle du secteur dactivité'))
	        ->add('save', SubmitType::class, array('label' => 'Valider'))
	        ->getForm();
	}
}
?>