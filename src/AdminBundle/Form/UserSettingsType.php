<?php

namespace App\AdminBundle\Form;

use App\AdminBundle\Entity\Commercial;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class UserSettingsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('commercialPhoto', FileType::class, ['label' => 'Photo', 'required' => false,
                'data_class' => null])
            ->add('email', EmailType::class, ['label' => 'E-mail', 'required' => false])
            ->add('plainPassword', PasswordType::class, ['label' => 'Mot de passe', 'required' => false, 'data_class' => null, 'empty_data' => ''])
            ->add('commercialMobilePhone', TelType::class, ['label' => 'Tél. mobile', 'required' => false])
            ->add('commercialLinkedinAddress', UrlType::class, ['label' => 'Profil LinckedIn', 'required' => false])
            ->add('commercialFacebookAddress', UrlType::class, ['label' => 'Profil Facebook', 'required' => false])
            ->add('commercialTwitterAddress', UrlType::class, ['label' => 'Profil Twitter', 'required' => false])
            ->add('save', SubmitType::class, ['label'=>'ENREGISTRER'])
            ->getForm()
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Commercial::class,
        ]);
    }
}
