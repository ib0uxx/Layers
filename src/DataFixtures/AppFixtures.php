<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AppFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        // Orchestrator fixture: actual data is created by the per-entity fixtures.
        // Keep this method empty to avoid duplicating data when running fixtures.
    }

    public function getDependencies(): array
    {
        return [
            UserFixtures::class,
            CategoryFixtures::class,
            ProductFixtures::class,
            ImageFixtures::class,
            AddressFixtures::class,
            OrderFixtures::class,
            OrderItemFixtures::class,
        ];
    }
}
