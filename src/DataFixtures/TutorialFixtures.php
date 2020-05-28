<?php

namespace App\DataFixtures;

use App\Entity\Tutorial;
use Doctrine\Persistence\ObjectManager;


class TutorialFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Tutorial::class, 10, function(Tutorial $tutorial){
            $tutorial->setTitle($this->faker->sentence(6, true))
                ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>');
        });
        $manager->flush();
    }

}
