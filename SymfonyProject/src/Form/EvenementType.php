<?php

namespace App\Form;

use App\Entity\Evenement;
use Doctrine\DBAL\Types\ObjectType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CurrencyType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EvenementType extends AbstractType
{

    private function getConfiguration($label, $placeholder){
        return[
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder
            ]
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('donCategorie', TextType::class, $this->getConfiguration("Catégorie de l'évènement", "Catégorie de l'évènement"))
            ->add('cause', TextType::class, $this->getConfiguration("Objectif", "Objectif à atteindre de cet évènement"))
            ->add('Region',TextType::class, $this->getConfiguration("Région", "Région de l'évènement"))
            ->add('date_creation', DateType::class, $this->getConfiguration("Date de l'évènement", "Date de l'évènement"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "Briéve description de votre évènement"))
            ->add('coverImage', TextType::class, $this->getConfiguration("Image", "Insérer une image représentative de l'évènement"))
            ->add('associationId')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
