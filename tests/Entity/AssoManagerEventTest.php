<?php

namespace App\Tests\Entity;

use App\Entity\AssoManagerEvent;
use App\Entity\Planning;
use PHPUnit\Framework\TestCase;

class AssoManagerEventTest extends TestCase
{
    public function testEvent(): void
    {
        $event = new AssoManagerEvent();
        $planning = new Planning();
        $event->setName('name')
            ->addPlanning($planning)
            ->setStartDate(new \DateTime())
            ->setEndDate(new \DateTime())
            ;

        $this->getResultOfPrivateProperty( AssoManagerEvent::class, 'id', $event, 1);
        $this->assertEquals("name", $event->getName());
        $this->assertEquals(1, $event->getId());
        $this->assertEquals(gettype(new \DateTime()), gettype($event->getEndDate()));
        $this->assertEquals(gettype(new \DateTime()), gettype($event->getStartDate()));
        $this->assertEquals(gettype(new Planning()), gettype($event->getPlanning()));
   ;
   $event->removePlanning($planning);

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
