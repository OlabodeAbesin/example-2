<?php

namespace App\DataFixtures;

use App\Domain\Entity\User;
use App\Domain\Repository\UserRepository;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class UserFixtures extends Fixture
{

    public function __construct(UserRepository $repository)
    {
    }

    public function load(ObjectManager $manager)
    {
        $user = new User('cb6b2eb0-a1de-410e-b554-e720365ed037', 'test@test.com', '+48661387693', 'a6345d0278adc55d3474f5');

        $manager->persist($user);
        $manager->flush();
    }
}
