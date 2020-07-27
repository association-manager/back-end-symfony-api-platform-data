<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Advertisement;
use App\Form\VideoPosterType;
use App\Form\AdvertisementFileType;
use App\Form\FormConfig\FormConfig;
use App\Repository\CategoryRepository;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;

class AdvertisementType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('title', TextType::class, $this->getFormConf(false, 'Titre', 'Titre de l\'annonce'))
            ->add('details', TextType::class, $this->getFormConf(false, 'Détails', 'Détails de l\'annonce'))

            ->add('status', ChoiceType::class, [
                'placeholder' => false,
                'label' => 'Statut',
                'required' => true,
                'choices'  => [
                    'Publier l\'annonce' => 'Publié',
                    'Dépublier l\'annonce' => 'Dépublié',
                    'Mettre en pause' => 'En pause'
                ],
            ])

            ->add('categories', EntityType::class, array(
                'label' => 'Catégorie(s)',
                'class' => Category::class,
                'query_builder' => function (CategoryRepository $er) {
                    return $er->getCategorySubTypeIfNotNull();
                },
                'choice_label' => 'subType',
                'placeholder' => 'Sélectionner une catégory',
                'required' => true,
                'expanded' => false,
                'multiple' => true
            ))
            
            ->add(
                'advertisementFiles', CollectionType::class,
                [
                    'entry_type' => AdvertisementFileType::class,
                    'allow_add' => true,
                    'allow_delete' => true,
                    'by_reference' => false,
                    'prototype' => true,
                    'delete_empty' => true,
                    'label' => ' ',
                ]
            )

            ->add('adVideoFiles', FileType::class, [
                'label' => 'Vidéos',
                'required' => false,
                'multiple' => true,
                'attr' => ['placeholder' => 'Chargez une vidéo']
            ])
            ->add('audience', ChoiceType::class, [
                'placeholder' => false,
                'label' => 'Public cible',
                'required' => true,
                'choices'  => [
                    'Approuvée' => 'Approuvée',
                    'Approuvée (pour adultes)' => 'Approuvée (pour adultes)',
                    'Approuvée (non adaptée à tous publics)' => 'Approuvée (non adaptée à tous publics)'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,
        ]);
    }
}