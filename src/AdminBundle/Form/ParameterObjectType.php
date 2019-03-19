<?php
namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\ParameterObject;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class ParameterObjectType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder     
			->add('parameterObjectObject', TextType::class, array('label' => 'Objet du paramètre'))

            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
            ->getForm()
    	;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
		'data_class' => ParameterObject::class]);	
	}
}
?>
