<?php

namespace App\Tests\Repository;

use App\Entity\Project;

class ProjectRepoTest extends BaseKernelTestCase
{

    public function testProjectAll(): void
    {
        $project = $this->entityManager
            ->getRepository(Project::class)
            ->findAll();
        $this->assertSame(gettype(new Project()), gettype($project[0]));
    }
}
