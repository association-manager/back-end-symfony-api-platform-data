<?php

namespace App\Form;

use App\Entity\AdvertisementFile;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class VideoPosterType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('posterFile', FileType::class, $this->getFormConf(false, 'Couverture', 'Choissez une image de couverture pour la vidéo'))
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdvertisementFile::class,
        ]);
    }
}
