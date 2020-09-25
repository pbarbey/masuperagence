<?php

namespace App\DataFixtures;

use App\Entity\Property;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class PropertyFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $faker = Factory::create('fr_FR');
        for ($i=0; $i<100; $i++)
        {
            $property = new Property();
            $property
                ->setTitle($faker->words(3,true))
                ->setDescription($faker->sentences(4,true))
                ->setSurface($faker->numberBetween(20,150))
                ->setSold(false)
                ->setRooms($faker->numberBetween(1,9))
                ->setPrice($faker->numberBetween(5000, 150000))
                ->setPostalCode($faker->postcode())
                ->setHeat($faker->numberBetween(0, count(Property::HEAT) -1 ))
                ->setFloor($faker->numberBetween(0,5))
                ->setCity($faker->city())
                ->setAddress($faker->address())
                ->setBedrooms($faker->numberBetween(1,5));
                $manager->persist($property);
        }
        // $product = new Product();
        // $manager->persist($product);

        $manager->flush();
    }
}
