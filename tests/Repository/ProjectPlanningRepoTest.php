<?php

namespace App\Tests\Repository;

use App\Entity\ProjectPlanning;

class ProjectPlanningRepoTest extends BaseKernelTestCase
{

    public function testWorkGroupAll(): void
    {
        $projectPlanning = $this->entityManager
            ->getRepository(ProjectPlanning::class)
            ->findAll();
        $this->assertSame(gettype(new ProjectPlanning()), gettype($projectPlanning[0]));
    }
}
