<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\ParameterBehavior;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;//FileType

class ParameterBehaviorType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $option)
	{
		$builder
			->add('parameterBehaviorBehavior', TextareaType::class, ['label' => 'Comportement du paramètre',
																		'attr' => ['class' => 'tinymce']
																	]
					)
			->add('save', SubmitType::class, ['label' => 'Valider'])
			->getForm()
		;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults(['data_class' => ParameterBehavior::class]);
	}
}

?>
