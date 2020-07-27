<?php

namespace App\Form;

use App\Entity\Address;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AddressType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('addressLine1', TextType::class, $this->getFormConf(true, 'Adresse', 'Votre adresse'))
            ->add('addressLine2', TextType::class, $this->getFormConf(true, 'Adresse suite', 'Complément d\'adresse'))
            ->add('postalCode', TextType::class, $this->getFormConf(true, 'Code postal', 'Code postal'))
            ->add('city', TextType::class, $this->getFormConf(true, 'Ville', 'Vile'))
            ->add('country', TextType::class, $this->getFormConf(true, 'Pays', 'Pays'))
            ->add('type', TextType::class, $this->getFormConf(true, 'Type', 'Type d\'adresse'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Address::class,
        ]);
    }
}
