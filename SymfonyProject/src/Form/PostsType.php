<?php

namespace App\Form;

use App\Entity\Posts;
use Symfony\Component\DomCrawler\Field\TextareaFormField;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Contracts\Service\Attribute\Required;
use Vich\UploaderBundle\Form\Type\VichImageType;

class PostsType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('posttitle',TextType::class)
            ->add('posttype',TextType::class)
            //->add('postdate',DateType::HTML5_FORMAT)
            //->add('likecount')
            ->add('postcontent',TextareaType::class,[
            'attr' => ['class' => 'md-textarea form-control'],
            ])
            ->add('imageFile', VichImageType::class,[
                'attr' => ['class' => 'md-textarea form-control'],'required' => true,
                'delete_label' => false,
                'download_label' => false,
                'download_uri' => false,
                'image_uri' => false,
                'asset_helper' => false,
            ]);



    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Posts::class,
        ]);
    }
}
