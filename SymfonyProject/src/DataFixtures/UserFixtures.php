<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\User;
use Faker;

class  UserFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Faker\Factory::create('fr_FR');
        // on crée 4 users
        $auteurs = Array();
        for ($i = 0; $i < 4; $i++) {
            $user[$i] = new User();
            $user[$i]->setUsername($faker->userName);
            $user[$i]->setPhoto($faker->image());
            $user[$i]->setPassword($faker->password);
            $user[$i]->setCity($faker->city);
            $user[$i]->setGouvernorat($faker->country);
            $user[$i]->setPhone($faker->phoneNumber);
            $user[$i]->setMail($faker->email);
            $user[$i]->setRole($faker->job);


            $manager->persist($user[$i]);
        }

        $manager->flush();
    }
}
