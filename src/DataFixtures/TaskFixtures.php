<?php

namespace App\DataFixtures;

use App\Entity\Task;
use Doctrine\Persistence\ObjectManager;


class TaskFixtures extends BaseFixture
{
    
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Task::class, 10, function(Task $task){

            $taskTypes = [
                "TaskType1", 
                "TaskType2",
                "TaskType3", 
                "TaskType4"
            ];

                $task->setTitle($this->faker->sentence(5, true))
                    ->setStartDate($this->faker->dateTimeBetween('-2 months'))
                    ->setEndDate($this->faker->dateTimeBetween('now'))
                    ->setType($this->faker->randomElement($taskTypes))
                    ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>');
        });
        $manager->flush();
    }

}
