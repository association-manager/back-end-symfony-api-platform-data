<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Persistence\ObjectManager;


class CategoryFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->createMany(Category::class, 5, function(Category $category, $count){
            $category->setName($this->faker->sentence(3, false))
                ->setType($this->faker->sentence(2, false));
        });
        $manager->flush();
    }

}
