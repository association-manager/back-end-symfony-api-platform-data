<?php

namespace App\DataFixtures;

use App\Entity\Project;
use Doctrine\Persistence\ObjectManager;


class ProjectFixtures extends BaseFixture
{
    
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Project::class, 10, function(Project $project){

            $projectTypes = [
                "ProjectType1", 
                "ProjectType2",
                "ProjectType3", 
                "ProjectType4"
            ];

                $project->setName($this->faker->sentence(5, true))
                    ->setStartAt($this->faker->dateTimeBetween('-2 months'))
                    ->setEndAt($this->faker->dateTimeBetween('now'))
                    ->setStatus($this->faker->randomElement([1,0]))
                    ->setProjectType($this->faker->randomElement($projectTypes))
                    ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>');
        });
        $manager->flush();
    }

}
