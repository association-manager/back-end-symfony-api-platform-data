<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Address;
use App\DataFixtures\BaseFixture;
use Doctrine\Persistence\ObjectManager;


class UserFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(User::class, 10, function(User $user, $count){

            // User Adress Type
            $addressTypes = [
                "Domicile",
                "Travail",
                "Autre"
            ];

            // User Address 
            $address = new Address();
            $address->setAddressLine1($this->faker->streetAddress)
                    ->setPostalCode($this->faker->postcode)
                    ->setCity($this->faker->city)
                    ->setCountry($this->faker->country)
                    ->setType($this->faker->randomElement($addressTypes));

            // User
            $hash = $this->encoder->encodePassword($user, "password");
                $user->setFirstName($this->faker->firstName())
                    ->setLastName($this->faker->lastName)
                    ->setEmail($count != 0 ? $this->faker->email.$count : 'test@test'.$count.'.com')
                    ->setCreatedAt($this->faker->dateTime)
                    ->setMobile($this->faker->phoneNumber)
                    ->setSex($this->faker->randomElement(['male','female', '']))
                    ->setDob($this->faker->dateTime)
                    ->setPassword($hash)
                    ->setDataUsageAgreement($this->faker->randomElement([1,0]))
                    ->addAddress($address);
        });
        $manager->flush();
    }

}
