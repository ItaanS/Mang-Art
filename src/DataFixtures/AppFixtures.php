<?php

namespace App\DataFixtures;

use App\Entity\ThemArt;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    const THEMART = [
        'Streetwear Concept',
        'Contrast Concept',
        'Cyber Concept'
    ];

    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);
        foreach (self::THEMART as $them) {
            $themart = new ThemArt();
            $themart->setName($them);
            $manager->persist($themart);
            $this->addReference('theme_' . $them, $themart);
        }

        $manager->flush();
    }
}
