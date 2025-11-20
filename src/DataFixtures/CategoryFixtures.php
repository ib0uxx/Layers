<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
    public const SNEAKERS = 'cat_sneakers';
    public const TOPS = 'cat_tops';
    public const PANTS = 'cat_pants';
    public const ACCESSORIES = 'cat_accessories';

    public function load(ObjectManager $manager): void
    {
        $sneakers = new Category();
        $sneakers->setName('Sneakers')->setDescription('Les dernières paires les plus prisées.');
        $manager->persist($sneakers);
        $this->addReference(self::SNEAKERS, $sneakers);

        $tops = new Category();
        $tops->setName('Tops')->setDescription('T-shirts, hoodies et sweats streetwear.');
        $manager->persist($tops);
        $this->addReference(self::TOPS, $tops);

        $pants = new Category();
        $pants->setName('Pantalons')->setDescription('Jeans, joggings et cargos stylés.');
        $manager->persist($pants);
        $this->addReference(self::PANTS, $pants);

        $accessories = new Category();
        $accessories->setName('Accessoires')->setDescription('Casquettes, sacs, montres et plus.');
        $manager->persist($accessories);
        $this->addReference(self::ACCESSORIES, $accessories);

        $manager->flush();
    }
}
