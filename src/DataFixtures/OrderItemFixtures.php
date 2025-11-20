<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\OrderItem;
use App\Entity\Product;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderItemFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $orderItem1 = new OrderItem();
        $orderItem1->setOrderItemOrder($this->getReference(OrderFixtures::ORDER_1, Order::class))
                   ->setProduct($this->getReference(ProductFixtures::PRODUCT_1, Product::class))
                   ->setQuantity(1)
                   ->setPrice($this->getReference(ProductFixtures::PRODUCT_1, Product::class)->getPrice());
        $manager->persist($orderItem1);

        $orderItem2 = new OrderItem();
        $orderItem2->setOrderItemOrder($this->getReference(OrderFixtures::ORDER_1, Order::class))
                   ->setProduct($this->getReference(ProductFixtures::PRODUCT_2, Product::class))
                   ->setQuantity(1)
                   ->setPrice($this->getReference(ProductFixtures::PRODUCT_2, Product::class)->getPrice());
        $manager->persist($orderItem2);

        $orderItem3 = new OrderItem();
        $orderItem3->setOrderItemOrder($this->getReference(OrderFixtures::ORDER_2, Order::class))
                   ->setProduct($this->getReference(ProductFixtures::PRODUCT_4, Product::class))
                   ->setQuantity(2)
                   ->setPrice($this->getReference(ProductFixtures::PRODUCT_4, Product::class)->getPrice() * 2);
        $manager->persist($orderItem3);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [OrderFixtures::class, ProductFixtures::class];
    }
}
