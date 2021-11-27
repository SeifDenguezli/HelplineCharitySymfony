<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class RegistrationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name',TextType::class,['attr'=>['placeholder'=>'Entrer votre Nom et Prénom...','class'=>'w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium'],])
            ->add('photo', FileType::class,['attr'=>['class'=>"cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium"],])
            ->add('password',PasswordType::class,['attr'=>['@keydown'=>'checkPasswordStrength()','placeholder'=>'Votre fort mot de passe...','x-model'=>'password','type'=>'togglePassword ? text : password','class'=>'w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium'],])
            ->add('city',TextType::class,['attr'=>['placeholder'=>'Entrer votre Ville...','class'=>'w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium'],])
            ->add('gouvernorat',TextType::class,['attr'=>['placeholder'=>'Entrer votre Gouvernorat...','class'=>'w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium'],])
            ->add('phone',TextType::class,['attr'=>['placeholder'=>'Entrer votre téléphone...','class'=>'w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium'],])
            ->add('mail',TextType::class,['attr'=>['placeholder'=>'Entrer votre adresse email...','class'=>'w-full px-4 py-3 rounded-lg shadow-sm focus:outline-none focus:shadow-outline text-gray-600 font-medium'],])
            ->add('role', ChoiceType::class, [
            'choices'  => [
                'Association ou Club' => "Association",
                    'Donneur' => "Donneur",
            ],
        ]);


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
