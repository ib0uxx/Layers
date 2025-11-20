<?php

namespace App\DataFixtures;

use App\Entity\Image;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class ImageFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $image1 = new Image();
        $image1->setName('Jordan 1')
               ->setUrl('https://cdn.shopify.com/s/files/1/0506/3834/9004/products/jordan1_universityblue.jpg')
               ->setProduct($this->getReference(ProductFixtures::PRODUCT_1, Product::class));
        $manager->persist($image1);

        $image2 = new Image();
        $image2->setName('Supreme Hoodie')
               ->setUrl('https://cdn.shopify.com/s/files/1/0506/3834/9004/products/supreme_boxlogo_red.jpg')
               ->setProduct($this->getReference(ProductFixtures::PRODUCT_2, Product::class));
        $manager->persist($image2);

        $image3 = new Image();
        $image3->setName('Stüssy Cargo')
               ->setUrl('https://cdn.shopify.com/s/files/1/0506/3834/9004/products/stussy_cargo_olive.jpg')
               ->setProduct($this->getReference(ProductFixtures::PRODUCT_3, Product::class));
        $manager->persist($image3);

        $image4 = new Image();
        $image4->setName('New Era Cap')
               ->setUrl('https://cdn.shopify.com/s/files/1/0506/3834/9004/products/newera_yankees_black.jpg')
               ->setProduct($this->getReference(ProductFixtures::PRODUCT_4, Product::class));
        $manager->persist($image4);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [ProductFixtures::class];
    }
}
