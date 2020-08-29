<?php

namespace App\Form\Admin;

use App\Entity\User;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class AdminRegistrationUserFormType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('email', EmailType::class, $this->getFormConf(true, ' ', 'Votre adresse email'))
            ->add('firstName', TextType::class, $this->getFormConf(true, ' ', 'Votre nom de famille'))
            ->add('lastName', TextType::class, $this->getFormConf(true, ' ', 'Votre prénom'))
            ->add('dataUsageAgreement', CheckboxType::class, [
                'label'    => 'J\'accepte l\'utilisation de mes données personnelles à des fins d\'enregistrement 
                et de traitement de mon compte électronique sur Association Manager et son opérateur de paiement.',
                'data' => false,
                'label_attr' => ['class' => 'switch-custom'],
                'required' => false,
            ])
            ->add('roles', ChoiceType::class, [
                'placeholder' => false,
                'label' => 'Rôles',
                'required' => false,
                'multiple' => true,
                'expanded' => true,
                'choices'  => [
                    'Administrateur' => 'ROLE_ADMIN',
                    'Annonceur' => 'ROLE_ADVERTISER',
                    'Utilisateur' => 'ROLE_USER'
                ],
            ])
            ->add('plainPassword', PasswordType::class, $this->getFormConf(true, ' ', 'Votre mot de passe'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
