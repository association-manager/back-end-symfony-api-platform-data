<?php

namespace App\Tests\Repository;

use App\Entity\Planning;

class PlanningRepoTest extends BaseKernelTestCase
{

    public function testPlanningAll(): void
    {
        $planning = $this->entityManager
            ->getRepository(Planning::class)
            ->findAll();
        $this->assertSame(gettype(new Planning()), gettype($planning[0]));
    }
}
