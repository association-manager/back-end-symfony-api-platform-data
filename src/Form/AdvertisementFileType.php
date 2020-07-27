<?php

namespace App\Form;

use App\Entity\AdvertisementFile;
use App\Form\FormConfig\FormConfig;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class AdvertisementFileType extends FormConfig
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('pictureSize', ChoiceType::class, [
                'placeholder' => false,
                'label' => 'Format de l\'annonce',
                'required' => true,
                'choices'  => [
                    'Bannière 728x90' => '728x90',
                    'Bannière 300x600' => '300x600',
                    'Bannière 336x280' => '336x280',
                    'Bannière 300x250' => '300x250'
                ],
            ])
            ->add('imageFile', FileType::class, $this->getFormConf(false, 'Image', 'Choissez une image'))
            // ->add('imageFile', FileType::class, $this->getFormConf(false, 'Image', 'Choissez une image'))
            // ->add('videoFile')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => AdvertisementFile::class,
        ]);
    }
}
