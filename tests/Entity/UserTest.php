<?php

namespace App\Tests\Entity;

use App\Entity\Address;
use App\Entity\Association;
use App\Entity\FileManager;
use App\Entity\Member;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use DateTime;

class UserTest extends TestCase
{
    public function testUser(): void
    {
        $user = new User();
        $userAddress = new Address();
        $userAddress->setAddressLine1('AddressLine1')
            ->setPostalCode('PostalCode')
            ->setCity('City')
            ->setCountry('Country')
            ->setUser(new User())
            ->setType('Type');

        $member = new Member();
        $member->setProfile(['profile' => 'Name'])
            ->setRoles(['User'])
            ->setUserId($user)
            ->addAssociation(new Association());
        $association = new Association();
        $fileManager = new FileManager();
        $fileManager->setCreatedBy($user)
        ->setName('Name')
        ->setAssociation($association)
        ->setCreatedAt(new DateTime())
        ->setS3key('123456')
        ->setSize('23')
        ->setStatus(1)
        ->setType('jpg');

        $user->setFirstName('firstName')
            ->setLastName('LastName')
            ->setEmail('test@test.com')
            ->setMobile('+336023156325')
            ->setSex('male')
            ->setPassword('password')
            ->setPlainPassword('password')
            ->setDataUsageAgreement(0)
            ->setRoles(['User'])
            ->setCreatedAt(new DateTime())
            ->setDataUsageAgreement(1)
            ->setDob(new DateTime())
            ->setValidatedAt(new DateTime())
            ->setPasswordResetToken('123456')
            ->setValidatedBy(new User())
            ->setUpdatedBy(new User())
            ->addMember($member)
            ->addAddress($userAddress)
            ->addAssociation($association)
            ->addFileManager($fileManager)
            ->removeMember($member)
            ->removeFileManager($fileManager)
            ->removeAssociation($association)
            ->removeAddress($userAddress);

        $this->getResultOfPrivateProperty( User::class, 'id', $user, 1);

        $this->assertEquals(1, $user->getId());
        $this->assertEquals('firstName', $user->getFirstName());
        $this->assertEquals('test@test.com', $user->getEmail());
        $this->assertEquals('test@test.com', $user->getUsername());
        $this->assertEquals('LastName', $user->getLastName());
        $this->assertEquals('firstName LastName', $user->getFullName());
        $this->assertEquals('+336023156325', $user->getMobile());
        $this->assertEquals('male', $user->getSex());
        $this->assertEquals(gettype(new DateTime()), gettype($user->getCreatedAt()));
        $this->assertEquals(gettype(new DateTime()), gettype($user->getDob()));
        $this->assertEquals(gettype(new DateTime()), gettype($user->getValidatedAt()));
        $this->assertEquals(gettype(new User()), gettype($user->getValidatedBy()));
        $this->assertEquals(gettype(new User()), gettype($user->getUpdatedBy()));
        $this->assertEquals('password', $user->getPassword());
        $this->assertEquals('password', $user->getPlainPassword());
        $this->assertEquals(['User', 'ROLE_USER'], $user->getRoles());
        $this->assertEquals(1, $user->getDataUsageAgreement());
        $this->assertEquals(gettype(new Member()), gettype($user->getMembers()));
        $this->assertEquals(gettype(new Association()), gettype($user->getAssociations()));
        $this->assertEquals(gettype(new FileManager()), gettype($user->getFileManagers()));
        $this->assertEquals('123456', $user->getPasswordResetToken());
        $this->assertEquals(gettype(new Address()), gettype($user->getAddress()));
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
