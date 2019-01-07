<?php
namespace App\Form;

use App\Entity\Contact;
use App\Entity\ContactJob;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\FormType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class ContactJobType extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		$builder     
			->add('contactJobName', TextType::class, array('label' => 'Nom du job'))

            ->add('save', SubmitType::class, array('label' => 'Enregistrer'))
    	;
	}

	public function configureOptions(OptionsResolver $resolver)
	{
		$resolver->setDefaults([
		'data_class' => ContactJob::class]);	
	}
}
?>