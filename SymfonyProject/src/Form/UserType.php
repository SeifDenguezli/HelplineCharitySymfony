<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Vich\UploaderBundle\Form\Type\VichImageType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('imageFile', VichImageType::class,['attr'=>['type'=>'file','name'=>'photo','id'=>'fileInput','accept'=>'image/*','@change'=>'let file = document.getElementById("fileInput").files[0]; 
								var reader = new FileReader();reader.onload = (e) => image = e.target.result;reader.readAsDataURL(file);','class'=>"cursor-pointer inine-flex justify-between items-center focus:outline-none border py-2 px-4 rounded-lg shadow-sm text-left text-gray-600 bg-white hover:bg-gray-100 font-medium"],])
            ->add('name')
            ->add('password')
            ->add('city')
            ->add('gouvernorat')
            ->add('phone')
            ->add('mail')
            ->add('role', ChoiceType::class, [
                'choices'  => [
                    'ADMIN' => "Admin",
                ],
            ]);


        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class ,
        ]);
    }
}
