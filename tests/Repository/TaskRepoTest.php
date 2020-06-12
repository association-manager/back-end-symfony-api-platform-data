<?php

namespace App\Tests\Repository;

use App\Entity\Task;

class TaskRepoTest extends BaseKernelTestCase
{

    public function testTaskAll(): void
    {
        $task = $this->entityManager
            ->getRepository(Task::class)
            ->findAll();
        $this->assertSame(gettype(new Task()), gettype($task[0]));
    }
}
