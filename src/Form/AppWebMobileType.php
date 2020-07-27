<?php

namespace App\Form;

use App\Entity\AppWebMobile;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class AppWebMobileType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('webPageUrlTitle', TextType::class, $this->getFormConf(false, 'Titre pour le web', 'Titre pour le web'))
            ->add('webPageUrl', TextType::class, $this->getFormConf(false, 'Url', 'Lien du profile de votre association'))
            ->add('mobileScreenTitle', TextType::class, $this->getFormConf(false, 'Titre pour le mobile', 'Titre pour le mobile'))
            ->add('mobile_screen', TextType::class, $this->getFormConf(false, 'Page', 'Ecran du profile de votre association'))
            ->add('description', TextType::class, $this->getFormConf(true, 'Description', 'description de l\'applicationn'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AppWebMobile::class,
        ]);
    }
}
