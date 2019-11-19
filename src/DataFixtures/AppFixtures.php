<?php

namespace App\DataFixtures;

use App\Entity\Event;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $ev1 = (new Event)
            ->setName("BlaBla")
            ->setLocation("Lons")
            ->setPrice(22.00);
        $ev2 = (new Event)
            ->setName("Yeah")
            ->setLocation("Pau")
            ->setPrice(22.00);
        $ev3 = (new Event)
            ->setName("Nul")
            ->setLocation("Lescar")
            ->setPrice(22.00);

        $manager->persist($ev1);
        $manager->persist($ev2);
        $manager->persist($ev3);
        $manager->flush();

        $manager->flush();
    }
}
