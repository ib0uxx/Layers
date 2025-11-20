<?php

namespace App\DataFixtures;

use App\Entity\Order;
use App\Entity\User;
use App\Enum\OrderStatus;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class OrderFixtures extends Fixture implements DependentFixtureInterface
{
    public const ORDER_1 = 'order_1';
    public const ORDER_2 = 'order_2';

    public function load(ObjectManager $manager): void
    {
        $order1 = new Order();
        $order1->setReference('ORD-STREET-001')
               ->setCreatedAt(new \DateTimeImmutable('2025-03-15'))
               ->setStatus(OrderStatus::COMPLETED)
               ->setOrderUser($this->getReference(UserFixtures::CUSTOMER_REFERENCE, User::class));
        $manager->persist($order1);
        $this->addReference(self::ORDER_1, $order1);

        $order2 = new Order();
        $order2->setReference('ORD-STREET-002')
               ->setCreatedAt(new \DateTimeImmutable('2025-04-01'))
               ->setStatus(OrderStatus::PENDING)
               ->setOrderUser($this->getReference(UserFixtures::CUSTOMER_REFERENCE, User::class));
        $manager->persist($order2);
        $this->addReference(self::ORDER_2, $order2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
