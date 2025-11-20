<?php

namespace App\DataFixtures;

use App\Entity\Address;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class AddressFixtures extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager): void
    {
        $address1 = new Address();
        $address1->setStreet('23 rue du Temple')
                 ->setPostalCode(75004)
                 ->setCity('Paris')
                 ->setCountry('France');
        $manager->persist($address1);

        /** @var User $customer */
        $customer = $this->getReference(UserFixtures::CUSTOMER_REFERENCE, User::class);
        $customer->setAddress($address1);

        $address2 = new Address();
        $address2->setStreet('10 avenue de Lyon')
                 ->setPostalCode(69003)
                 ->setCity('Lyon')
                 ->setCountry('France');
        $manager->persist($address2);

        /** @var User $admin */
        $admin = $this->getReference(UserFixtures::ADMIN_REFERENCE, User::class);
        $admin->setAddress($address2);

        $manager->flush();
    }

    public function getDependencies(): array
    {
        return [UserFixtures::class];
    }
}
