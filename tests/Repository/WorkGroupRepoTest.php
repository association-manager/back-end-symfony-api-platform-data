<?php

namespace App\Tests\Repository;

use App\Entity\WorkGroup;

class WorkGroupRepoTest extends BaseKernelTestCase
{

    public function testWorkGroupAll(): void
    {
        $workGroup = $this->entityManager
            ->getRepository(WorkGroup::class)
            ->findAll();
        $this->assertSame(gettype(new WorkGroup()), gettype($workGroup[0]));
    }
}
