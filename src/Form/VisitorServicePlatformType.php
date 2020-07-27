<?php

namespace App\Form;

use App\Entity\VisitorServicePlatform;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class VisitorServicePlatformType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('visitedTime')
            ->add('visitorNumber')
            ->add('platform')
            ->add('usersAgentInformation')
            ->add('ipAddress')
            ->add('appScreen')
            ->add('advertisements')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => VisitorServicePlatform::class,
        ]);
    }
}
