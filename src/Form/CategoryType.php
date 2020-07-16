<?php

namespace App\Form;

use App\Entity\Category;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class CategoryType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, $this->getFormConf(true, 'Nom', 'Nom de la catégorie'))
            ->add('type', TextType::class, $this->getFormConf(true, 'Type', 'Indiquez un type : "Annonce"'))
            ->add('details', TextType::class, $this->getFormConf(false, 'Détails', 'Détails de la catégorie'))
            ->add('subType', TextType::class, $this->getFormConf(false, 'Sous type', 'Sous type (Ex : Informative, Transformative) '))
            // ->add('advertisements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
