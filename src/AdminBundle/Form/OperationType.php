<?php

namespace App\AdminBundle\Form;

use App\Entity\Operation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;//FileType

class OperationType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('operationName', TextType::class, ['label' => 'Nom de l\'opération*'])
			->add('operationUrlPage', UrlType::class, ['label' => 'URL de la page*'])
			->add('operationHeadBandVisual', TextType::class, ['label' => 'Bandeau visuel (upload)*'])
			->add('operationLateralVisual', TextType::class, ['label' => 'Bandeau lateral (upload)*'])
			->add('operationDisplayed', CheckboxType::class, ['label' => 'Afficher l\'opération', 'required' => false])
			->add('operationModified', CheckboxType::class, ['label' => 'Opération modifiable par le contact', 
																								'required' => false
															 ]
				 )
			->add('operationBinding', CheckboxType::class, ['label' => 'Rendre l\'opération obligatoire', 'required' => false])
			->add('save', SubmitType::class, ['label' => 'Valider'])
			->getForm()
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => Operation::class]);
	}
}

?>
