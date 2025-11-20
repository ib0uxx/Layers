<?php

namespace App\Form;

use App\Entity\Product;
use App\Entity\Category;
use App\Enum\ProductStatus;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;
use Symfony\Component\Form\Extension\Core\Type\EnumType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            // Champ "Nom" du produit
            ->add('name', null, [
                'label' => 'Nom du produit',
                'attr' => ['placeholder' => 'Ex: Nike Air Jordan 1'],
            ])
            
            // Champ "Description" du produit
            ->add('description', null, [
                'label' => 'Description',
                'attr' => ['rows' => 5, 'placeholder' => 'Décrivez le produit...'],
            ])
            
            // Champ "Prix" en euros
            ->add('price', MoneyType::class, [
                'label' => 'Prix (€)',
                'currency' => 'EUR',
                'divisor' => 100, // Si tu stockes en centimes
            ])
            
            // Champ "Stock" (nombre d'articles)
            ->add('stock', IntegerType::class, [
                'label' => 'Quantité en stock',
                'attr' => ['min' => 0],
            ])
            
            // Champ "Catégorie" - liaison avec l'entité Category
            ->add('categories', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name', // Affiche le nom de la catégorie
                'label' => 'Catégories',
                'multiple' => true, // Permet de sélectionner plusieurs catégories
                'expanded' => false, // Affiche comme dropdown (true = checkboxes)
            ])
            
            // Champ "Statut" avec l'enum ProductStatus
            ->add('status', EnumType::class, [
                'class' => ProductStatus::class,
                'label' => 'Statut',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class, // Lie le formulaire à l'entité Product
        ]);
    }
}
