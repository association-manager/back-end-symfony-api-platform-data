<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Address;
use App\Entity\Association;
use Doctrine\Persistence\ObjectManager;


class AssociationFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createMany(Association::class, 10, function (Association $association, $count) {

            // Association Address Type
            $addressTypes = [
                "Paris",
                "Lyon"
            ];

            // Association Address 
            $address = new Address();
            $address->setAddressLine1($this->faker->streetAddress)
                ->setPostalCode($this->faker->postcode)
                ->setCity($this->faker->city)
                ->setCountry($this->faker->country)
                ->setType("Notre adresse à ".$this->faker->randomElement($addressTypes));

            // Association Type
            $associationTypes = [
                "Association1",
                "association2",
                "Association3",
                "Association4"
            ];

            // Association User
            $user = new User();
            $hash = $this->encoder->encodePassword($user, "password");
            $user->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName)
                ->setEmail('test1789'.$count.'@test.com')
                ->setCreatedAt($this->faker->dateTime)
                ->setMobile($this->faker->phoneNumber)
                ->setSex($this->faker->randomElement(['male', 'female', '']))
                ->setDob($this->faker->dateTime)
                ->setPassword($hash)
                ->setDataUsageAgreement($this->faker->randomElement([1, 0]));

            // Association
            $customPhone = (87985471 + $count);
            $name = $this->faker->company;
            $customName = strtolower(str_replace(" ", "", $name));


            $association->setName($name)
                ->setDataUsageAgreement($this->faker->randomElement([1, 0]))
                ->setAssociationType($this->faker->randomElement($associationTypes))
                ->setPhoneNumber($count != 0 ? '+331' . strval($customPhone) : '+33187985470')
                ->setMobile($count != 0 ? '+336' . strval($customPhone) : '+33687985470')
                ->setWebsite($count != 0 ? 'https://www.association-manager.fr/' . trim(str_replace(".", "", $customName)) : 'https://www.association-manager.fr/test')
                ->setEmail($count != 0 ? trim($customName) . '@association-manager.fr' : 'test@association-manager.fr')
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName)
                ->setAssemblyConstituveDate($this->faker->dateTimeBetween('-6 months'))
                ->setFoundedAt($this->faker->dateTimeBetween('-6 months'))
                ->setCreatedAt($this->faker->dateTimeBetween('-3 months'))
                ->setCreatedBy($user)
                ->addAddress($address);
        });
        $manager->flush();
    }

}
