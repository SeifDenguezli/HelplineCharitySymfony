<?php

namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;

class SearchServiceType extends  AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
      /*  ->add ('typeservice',ChoiceType::class, [
        'choices' => [
            'Santé' => 'Santé',
            'Transport' => 'Transport',
            'Construction' => 'Construction',
            'Education' => 'Education',
            'Autre' => 'Autre',
        ]])*/
        ->add('lieu')
        ->add('datedisponibilite')
       /* ->add('description')*/
        ->add('Rechercher ',SubmitType::class);
    }


}