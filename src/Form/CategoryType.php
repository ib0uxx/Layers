<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ "Nom" de la catégorie
            ->add('name', null, [
                'label' => 'Nom de la catégorie',
                'attr' => ['placeholder' => 'Ex: Sneakers, Tops...'],
            ])
            
            // Champ "Description" de la catégorie
            ->add('description', null, [
                'label' => 'Description',
                'attr' => ['rows' => 4, 'placeholder' => 'Décrivez cette catégorie...'],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Category::class, // Lie le formulaire à l'entité Category
        ]);
    }
}
