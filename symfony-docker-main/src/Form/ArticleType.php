<?php

namespace App\Form;

use App\Entity\Article;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class ArticleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
{
    $builder
        ->add('Titre', TextType::class, [
            'attr' => [
                'class' => 'form-control mb-3 shadow-sm',
                'placeholder' => 'Entrez le titre de l\'article',
            ],
            'label' => 'Titre de l\'article',
            'label_attr' => ['class' => 'form-label fw-bold']
        ])
        ->add('publie', CheckboxType::class, [
            'required' => false,
            'label' => 'Publié',
            'attr' => [
                'class' => 'form-check-input me-2',
            ],
            'label_attr' => ['class' => 'form-check-label fw-bold'],
            'row_attr' => ['class' => 'form-check mb-3']
        ])
        ->add('date', DateType::class, [
            'widget' => 'single_text',
            'attr' => [
                'class' => 'form-control mb-3 shadow-sm',
            ],
            'label' => 'Date de publication',
            'label_attr' => ['class' => 'form-label fw-bold']
        ])
        ->add('text', TextareaType::class, [
            'attr' => [
                'class' => 'form-control mb-3 shadow-sm',
                'rows' => 5,
                'placeholder' => 'Entrez le contenu de l\'article...',
            ],
            'label' => 'Contenu de l\'article',
            'label_attr' => ['class' => 'form-label fw-bold']
        ])
        ->add('imageUrl', TextType::class, [
            'required' => false,
            'attr' => [
                'class' => 'form-control mb-3 shadow-sm',
                'placeholder' => 'Entrez l\'URL de l\'image',
            ],
            'label' => 'URL de l\'image',
            'label_attr' => ['class' => 'form-label fw-bold']
        ]);
}


    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Article::class,
        ]);
    }

    
}
