<?php

namespace App\DataFixtures;

use App\Entity\Association;
use Doctrine\Persistence\ObjectManager;


class AssociationFixtures extends BaseFixture
{
    // private $types = [
    //     'Association de fait ou association non déclarée', 
    //     'association loi de 1901','Association avec agrément', 
    //     'Association d\'utilité publique'
    // ];
    

    // public function getTypes()
    // {
    //     return $this->types;
    // }

    // public function setTypes($types): self
    // {
    //     $this->cgu = $types;

    //     return $this;
    // }   


    protected function loadData(ObjectManager $manager)
    {        
        $this->createMany(Association::class, 10, function(Association $association, $count){
                $associationTypes = [
                    "Association1", 
                    "association2",
                    "Association3", 
                    "Association4"
                ];

                $customPhone = (87985471 + $count);
                $name = $this->faker->company;
                $customName = strtolower(str_replace(" ", "", $name));

                $association->setName($name)
                            ->setDataUsageAgreement($this->faker->randomElement([1,0]))
                            ->setAssociationType($this->faker->randomElement($associationTypes))
                            ->setPhoneNumber($count != 0 ? '+331'.strval($customPhone) : '+33187985470')
                            ->setMobile($count != 0 ? '+336'.strval($customPhone) : '+33687985470')
                            ->setWebsite($count != 0 ? 'https://www.association-manager.fr/'.trim(str_replace(".", "", $customName)) : 'https://www.association-manager.fr/test')
                            ->setEmail($count != 0 ? trim($customName).'@association-manager.fr' : 'test@association-manager.fr')
                            ->setFirstName($this->faker->firstName())
                            ->setLastName($this->faker->lastName)
                            ->setAssemblyConstituveDate($this->faker->dateTimeBetween('-6 months'))
                            ->setFoundedAt($this->faker->dateTimeBetween('-6 months'))
                            ->setCreatedAt($this->faker->dateTimeBetween('-3 months'));
        });
        $manager->flush();
    }

}
