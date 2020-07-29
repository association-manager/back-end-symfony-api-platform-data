<?php

namespace App\Tests\Repository;

use App\Entity\FileManager;

class FileManagerRepoTest extends BaseKernelTestCase
{

    public function testFileManagerAll(): void
    {
        $fileManager = $this->entityManager
            ->getRepository(FileManager::class)
            ->findAll();
        $this->assertSame(gettype(new FileManager()), gettype($fileManager[0]));
    }
}
