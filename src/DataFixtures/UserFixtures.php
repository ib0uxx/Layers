<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Enum\UserRoles;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    public const ADMIN_REFERENCE = 'user_admin';
    public const CUSTOMER_REFERENCE = 'user_customer';

    public function __construct(private UserPasswordHasherInterface $passwordHasher) {}

    public function load(ObjectManager $manager): void
    {
        $admin = new User();
        $admin->setFirstName('Alex')
              ->setLastName('Street')
              ->setEmail('admin@streetshop.com')
              ->setPassword($this->passwordHasher->hashPassword($admin, 'admin123'));
        $admin->setRoles([UserRoles::ADMIN->value, 'ROLE_USER']);
        $manager->persist($admin);
        $this->addReference(self::ADMIN_REFERENCE, $admin);

        $customer = new User();
        $customer->setFirstName('Jordan')
                 ->setLastName('Walker')
                 ->setEmail('jordan@streetshop.com')
                 ->setPassword($this->passwordHasher->hashPassword($customer, 'user123'));
        $customer->setRoles(['ROLE_USER']);
        $manager->persist($customer);
        $this->addReference(self::CUSTOMER_REFERENCE, $customer);

        $manager->flush();
    }
}
