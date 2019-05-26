<?php

namespace App\AdminBundle\Form;

use Symfony\Component\Form\AbstractType;
use App\AdminBundle\Entity\OperationSettings;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class OperationSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('operationSettingsEmailObject', TextType::class, ["label" => "Objet du mail"])
            ->add('operationSettingsEmailText', TextAreaType::class, ["label" => "Texte du email", "required" => true])
            ->add('operationSettingsEmailLabelBtn', TextType::class, ["label" => "Libellé du bouton", "required" => false])
            ->add('operationSettingsTitlePage', TextType::class, ["label" => "Titre de la page"])
            ->add('operationSettingsIntroductionTitle', TextType::class, ["label" => "Titre d'introduction", "required" => true])
            ->add('operationSettingsIntroductionText', TextAreaType::class, ["label" => "Texte d'introduction","required" => true])
            ->add('operationSettingsLabelBtnPage', TextType::class, ["label" => "Libellé du bouton", "required" => false])
            ->add('operationSettingsBtnReject', CheckboxType::class, [
                "label" => "Bouton de refus",
                "required" => false
            ])
            ->add('operationSettingsEmailVisual', FileType::class, ['label' => 'Visuel du email', 'required' => false,
                'data_class' => null])
            ->add('operationSettingsVisualPage', FileType::class, ['label' => 'Visuel de la page', 'required' => false,
                'data_class' => null])
            ->add('save', SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => OperationSettings::class
        ]);
    }
}
