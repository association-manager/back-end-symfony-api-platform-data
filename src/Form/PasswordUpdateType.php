<?php

namespace App\Form;

use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;

class PasswordUpdateType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('oldPassword', PasswordType::class, $this->getFormConf(true, "Mot de passe actuel", "Entrez votre mot de passe actuel"))
            ->add('newPassword', PasswordType::class, $this->getFormConf(true, "Nouveau mot de passe", "Saisissez un nouveau mot de passe"))
            ->add('confirmPassword', PasswordType::class, $this->getFormConf(true, "Confirmation du mot de passe", "Confirmez votre nouveau mot de passe"))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([]);
    }
}
