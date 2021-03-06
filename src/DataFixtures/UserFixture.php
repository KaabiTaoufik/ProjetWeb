<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 1; $i < 5; $i++) {
            $user = new User();
            $user->setEmail("admin$i@gmail.com");
            $user->setPassword("admin");
            $manager->persist($user);
        }

        $manager->flush();
        $manager->flush();
    }
}
