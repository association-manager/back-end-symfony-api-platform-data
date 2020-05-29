<?php

namespace App\DataFixtures;

use App\Entity\Announce;
use Doctrine\Persistence\ObjectManager;

class AnnounceFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Announce::class, 10, function(Announce $announce, $count){
                $announce->setName($this->faker->firstName())
                    ->setPriority($this->faker->numberBetween($min = 0, $max = 1))
                    ->setDescription($this->faker->realText($maxNbChars = 200, $indexSize = 2))
                    ->setDuration($this->faker->numberBetween($min = 1000, $max = 9000))
                    ->setAdUnitId($this->faker->uuid());
        });
        $manager->flush();
    }
}
