<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Persistence\ObjectManager;


class UserFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 10, function(User $user, $count){
            $hash = $this->encoder->encodePassword($user, "password");
            $user->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName)
                ->setEmail($this->faker->email.$count)
                ->setCreatedAt($this->faker->dateTime)
                ->setMobile($this->faker->phoneNumber)
                ->setSex($this->faker->randomElement(['male','female', '']))
                ->setDob($this->faker->dateTime)
                ->setPassword($hash)
                ->setDataUsageAgreement($this->faker->randomElement([1,0]))
            ;
        });
        $manager->flush();
    }

}
