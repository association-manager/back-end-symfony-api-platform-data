<?php

namespace App\Tests\Repository;

use App\Entity\Category;

class CategoryRepoTest extends BaseKernelTestCase
{

    public function testCategoryAll(): void
    {
        $category = $this->entityManager
            ->getRepository(Category::class)
            ->findAll();
        $this->assertSame(gettype(new Category()), gettype($category[0]));
    }
}
