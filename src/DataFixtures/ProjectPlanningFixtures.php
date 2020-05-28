<?php

namespace App\DataFixtures;

use App\Entity\ProjectPlanning;
use Doctrine\Persistence\ObjectManager;


class ProjectPlanningFixtures extends BaseFixture
{
    
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(ProjectPlanning::class, 10, function(ProjectPlanning $projectPlanning){

            $projectPlanning->setName($this->faker->sentence(2, true))
                ->setStartAt($this->faker->dateTimeBetween('-2 months'))
                ->setEndAt($this->faker->dateTimeBetween('now'));
        });
        $manager->flush();
    }

}
