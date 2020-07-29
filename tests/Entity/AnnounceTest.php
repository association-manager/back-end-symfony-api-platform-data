<?php

namespace App\Tests\Entity;

use App\Entity\Announce;
use App\Entity\FileManager;
use PHPUnit\Framework\TestCase;

class AnnounceTest extends TestCase
{
    public function testAnnounce(): void
    {
        $announce = new Announce();
        $announce->setName('name')
            ->setAdUnitId('addUnitId')
            ->setDescription('Description')
            ->setDuration(45)
            ->setPriority(1)
            ->setFileManager(new FileManager());

        $this->getResultOfPrivateProperty( Announce::class, 'id', $announce, 1);
        $this->assertEquals("name", $announce->getName());
        $this->assertEquals(1, $announce->getId());
        $this->assertEquals('Description', $announce->getDescription());
        $this->assertEquals(45, $announce->getDuration());
        $this->assertEquals(1, $announce->getPriority());
        $this->assertEquals('addUnitId', $announce->getAdUnitId());
        $this->assertEquals(gettype(new FileManager()), gettype($announce->getFileManager()));
   ;

    }

    /**
     * @param string $class
     * @param string $propertyName
     * @param object $newClass
     * @param int|null $value
     * @return \ReflectionProperty
     * @throws \ReflectionException
     */
    protected function getResultOfPrivateProperty(
        string $class,
        string $propertyName,
        object $newClass,
        ?int $value
    ): \ReflectionProperty {
        $reflection = new \ReflectionClass($class);
        $method = $reflection->getProperty($propertyName);
        $method->setAccessible(true);
        $method->setValue($newClass, $value);
        return $method;
    }

}
