<?php

namespace App\Form;

use App\Entity\MangArt;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class MangArtType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // ->add('imageName')
            ->add('imageFile', FileType::class, [
                'required' => false
            ])
            ->add('theme')
            ->add('calqMangart', FileType::class, [
                'required' => false
            ])
            ->add('name', TextType::class,[
                'required' => false
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => MangArt::class,
        ]);
    }
}
