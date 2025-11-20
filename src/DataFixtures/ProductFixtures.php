<?php

namespace App\DataFixtures;

use App\Entity\Category;
use App\Entity\Product;
use App\Enum\ProductStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ProductFixtures extends Fixture implements DependentFixtureInterface
{
    public const PRODUCT_1 = 'product_1';
    public const PRODUCT_2 = 'product_2';
    public const PRODUCT_3 = 'product_3';
    public const PRODUCT_4 = 'product_4';

    public function load(ObjectManager $manager): void
    {
        $product1 = new Product();
        $product1->setName('Nike Air Jordan 1 Retro High OG')
                 ->setDescription('Coloris University Blue — cuir premium, édition limitée.')
                 ->setPrice(399.99)
                 ->setStock(5)
                 ->addCategory($this->getReference(CategoryFixtures::SNEAKERS, Category::class))
                 ->setStatus(ProductStatus::AVAILABLE);
        $manager->persist($product1);
        $this->addReference(self::PRODUCT_1, $product1);

        $product2 = new Product();
        $product2->setName('Hoodie Supreme Box Logo')
                 ->setDescription('Sweat à capuche avec logo iconique brodé. Coloris Red.')
                 ->setPrice(249.90)
                 ->setStock(8)
                 ->addCategory($this->getReference(CategoryFixtures::TOPS, Category::class))
                 ->setStatus(ProductStatus::AVAILABLE);
        $manager->persist($product2);
        $this->addReference(self::PRODUCT_2, $product2);

        $product3 = new Product();
        $product3->setName('Cargo Pants Stüssy Olive')
                 ->setDescription('Pantalon cargo coupe droite avec poches latérales.')
                 ->setPrice(119.99)
                 ->setStock(0)
                 ->addCategory($this->getReference(CategoryFixtures::PANTS, Category::class))
                 ->setStatus(ProductStatus::OUT_OF_STOCK);
        $manager->persist($product3);
        $this->addReference(self::PRODUCT_3, $product3);

        $product4 = new Product();
        $product4->setName('Casquette New Era Yankees Black')
                 ->setDescription('Casquette 9FIFTY en coton noir brodée du logo NY.')
                 ->setPrice(44.99)
                 ->setStock(25)
                 ->addCategory($this->getReference(CategoryFixtures::ACCESSORIES, Category::class))
                 ->setStatus(ProductStatus::AVAILABLE);
        $manager->persist($product4);
        $this->addReference(self::PRODUCT_4, $product4);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [CategoryFixtures::class];
    }
}
