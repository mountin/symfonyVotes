<?php

namespace App\DataFixtures;

use App\Factory\EventFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // $product = new Product();
        // $manager->persist($product);

        UserFactory::createMany(20);
        EventFactory::createMany(20);
        //PokemonFactory::createMany(20);

        $manager->flush();
    }
}
