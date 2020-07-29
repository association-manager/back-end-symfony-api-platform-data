<?php

namespace App\Tests\Repository;

use App\Entity\Staff;

class StaffRepoTest extends BaseKernelTestCase
{

    public function testStaffAll(): void
    {
        $staff = $this->entityManager
            ->getRepository(Staff::class)
            ->findAll();
        $this->assertSame(gettype(new Staff()), gettype($staff[0]));
    }
}
