<?php

namespace App\Form\Admin;

use App\Entity\Category;
use App\Entity\Advertisement;
use App\Entity\Association;
use App\Form\AdvertisementFileType;
use App\Form\FormConfig\FormConfig;
use App\Repository\AssociationRepository;
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
        $userID = $options['userID'];

        $builder
            ->add('title', TextType::class, $this->getFormConf(false, 'Titre', 'Titre de l\'annonce'))
            ->add('details', TextType::class, $this->getFormConf(false, 'Détails', 'Détails de l\'annonce'))

            ->add('status', ChoiceType::class, [
                'placeholder' => false,
                'label' => 'Statut',
                'required' => true,
                'choices'  => [
                    'En attente de validation' => 'En attente de validation',
                    'Valider l\'annonce' => 'Validé',
                    'Valider et publier l\'annonce' => 'Validé et publié',
                    'Dépublier l\'annonce' => 'Dépublié',
                    'Refuser l\'annonce' => 'Refusé',
                    'Publier l\'annonce' => 'Publié',
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
            ->add('priority', TextType::class, $this->getFormConf(false, 'Priorité', 'Priorité de l\'annonce'))
            ->add('duration', TextType::class, $this->getFormConf(false, 'Durée', 'Durée de l\'annonce'))
            ->add('association', EntityType::class, array(
                'label' => 'Association',
                'class' => Association::class,
                'query_builder' => function (AssociationRepository $er) use ($userID) {
                    return $er->getAssociationsWhereUserIsAdmin($userID);
                },
                'choice_label' => 'name',
                'placeholder' => 'Sélectionner une association parmi lesquelles vous êtes administrateur',
                'required' => false,
                'expanded' => false,
                'multiple' => false
            ))

            // ->add('visitorServicePlatforms')
            // ->add('appWebMobile')
            
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
                    'Approuvée -18 ans' => 'APPROVED_UNDER_18',
                    'Approuvée 18 et 29 ans' => 'APPROVED_BETWEEN_18_AND_29_YEARS_OLD',
                    'Approuvée 30 et 45 ans' => 'APPROVED_BETWEEN_30_AND_45_YEARS_OLD',
                    'Approuvée entre 46 et 60 ans' => 'APPROVED_BETWEEN_46_AND_60_YEARS_OLD',
                    'Approuvée 60 et plus' => 'APPROVED_60_YEARS_OLD_AND_OVER'
                ],
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Advertisement::class,
        ]);

        $resolver->setRequired(['userID']);
    }
}
