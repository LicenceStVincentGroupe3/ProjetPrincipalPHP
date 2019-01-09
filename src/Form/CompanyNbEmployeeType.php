<?php

namespace App\Form;

use App\Entity\CompanyNbEmployee;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\Entity;

class CompanyNbEmployeeType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder
			->add('nbEmployee', TextType::class, array('label' => 'Nombre demployé'))
	        ->add('save', SubmitType::class, array('label' => 'Valider'))
	        ->getForm();
	}
}
?>