<?php

namespace App\Form;

use App\Entity\Service;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ServiceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('typeservice',ChoiceType::class, [
        'choices' => [
            'Santé' => 'Santé',
            'Transport' => 'Transport',
            'Construction' => 'Construction',
            'Education' => 'Education',
            'Autre' => 'Autre',
        ]])

            ->add('lieu')
            ->add('datedisponibilite')
            ->add('donorid')
            ->add('description')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Service::class,
        ]);
    }
}
