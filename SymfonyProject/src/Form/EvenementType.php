<?php

namespace App\Form;

use App\Entity\Evenement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Vich\UploaderBundle\Form\Type\VichImageType;
use Captcha\Bundle\CaptchaBundle\Form\Type\CaptchaType;
use Captcha\Bundle\CaptchaBundle\Validator\Constraints\ValidCaptcha;

class EvenementType extends AbstractType
{

    private function getConfiguration($label, $placeholder){
        return[
            'label' => $label,
            'attr' => [
                'placeholder' => $placeholder,
                'class' => "form-control"
            ]
        ];
    }
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('donCategorie', TextType::class, $this->getConfiguration("Catégorie de l'évènement", "Catégorie de l'évènement"))
            ->add('cause', TextType::class, $this->getConfiguration("Objectif", "Objectif à atteindre de cet évènement"))
            ->add('Region',TextType::class, $this->getConfiguration("Région", "Région de l'évènement"))
            #->add('date_creation', DateType::class, $this->getConfiguration("Date de l'évènement", "Date de l'évènement"))
            ->add('description', TextareaType::class, $this->getConfiguration("Description", "Briéve description de votre évènement"))
            ->add('imageFile', VichImageType::class, [
                'required' => true,
                'delete_label' => false,
                'download_label' => false,
                'download_uri' => false,
                'image_uri' => false,
                'asset_helper' => false,
            ])
            ->add('captchaCode', CaptchaType::class,[
                'captchaConfig' => 'CaptchaEventCreation',
                'constraints' => [
                    new ValidCaptcha(['message' => 'Priére de vérifier le Captcha'])
                ]
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Evenement::class,
        ]);
    }
}
