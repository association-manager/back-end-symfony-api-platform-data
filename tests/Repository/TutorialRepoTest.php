<?php

namespace App\Tests\Repository;

use App\Entity\Tutorial;

class TutorialRepoTest extends BaseKernelTestCase
{

    public function testTutorialAll(): void
    {
        $tutorial = $this->entityManager
            ->getRepository(Tutorial::class)
            ->findAll();
        $this->assertSame(gettype(new Tutorial()), gettype($tutorial[0]));
    }
}
