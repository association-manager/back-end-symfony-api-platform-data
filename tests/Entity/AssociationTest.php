<?php

namespace App\Tests\Entity;

use App\Entity\Address;
use App\Entity\Association;
use App\Entity\AssociationProfile;
use App\Entity\FileManager;
use App\Entity\Member;
use App\Entity\NetworksSocialLink;
use App\Entity\Planning;
use App\Entity\Transaction;
use App\Entity\User;
use App\Entity\WorkGroup;
use PHPUnit\Framework\TestCase;

class AssociationTest extends TestCase
{
    public function testAssociation(): void
    {
        $user = new User();
        $planning = new Planning();
        $fileManager = new FileManager();
        $member = new Member();
        $address = new Address();
        $networksSocialLink = new NetworksSocialLink();
        $transaction = new Transaction();
        $workGroup = new WorkGroup();

        $association = new Association();
        $association->setName('name')
            ->setCreatedBy($user)
            ->addPlanning(new Planning())
            ->setCreatedAt(new \DateTime())
            ->setDataUsageAgreement(1)
            ->setEmail('test@test.com')
            ->setFirstName('FirstName')
            ->setLastName('LastName')
            ->setFoundedAt(new \DateTime())
            ->setCreatedAt(new \DateTime())
            ->setCreatedBy($user)
            ->setPhoneNumber('1234')
            ->setMobile('1234')
            ->setAssociationType('type')
            ->setWebsite('Website')
            ->setAssemblyConstituveDate(new \DateTime())
            ->addPlanning($planning)
            ->addFileManager($fileManager)
            ->addMember($member)
            ->addAddress($address)
            ->addNetworksSocialLink($networksSocialLink)
            ->addTransaction($transaction)
            ->addWorkGroup($workGroup)
        ->setAssociationProfile(new AssociationProfile());

        $association2 = new Association();
        $association->prePersist();


        $this->getResultOfPrivateProperty(Association::class, 'id', $association, 1);
        $this->assertEquals("name", $association->getName());
        $this->assertEquals(1, $association->getId());
        $this->assertEquals('FirstName', $association->getFirstName());
        $this->assertEquals('LastName', $association->getLastName());
        $this->assertEquals('test@test.com', $association->getEmail());
        $this->assertEquals(true, $association->getDataUsageAgreement());
        $this->assertEquals(gettype(new \DateTime()), gettype($association->getCreatedAt()));
        $this->assertEquals(gettype(new \DateTime()), gettype($association->getFoundedAt()));
        $this->assertEquals(gettype(new \DateTime()), gettype($association->getAssemblyConstituveDate()));
        $this->assertEquals(gettype(new User()), gettype($association->getCreatedBy()));
        $this->assertEquals(gettype(new Member()), gettype($association->getMembers()));
        $this->assertEquals(gettype(new WorkGroup()), gettype($association->getWorkGroups()));
        $this->assertEquals(gettype(new AssociationProfile()), gettype($association->getAssociationProfile()));
        $this->assertEquals(gettype(new Planning()), gettype($association->getPlannings()));
        $this->assertEquals(gettype(new Address()), gettype($association->getAddresses()));
        $this->assertEquals(gettype(new FileManager()), gettype($association->getFileManagers()));
        $this->assertEquals(gettype(new NetworksSocialLink()), gettype($association->getNetworksSocialLinks()));
        $this->assertEquals(gettype(new Transaction()), gettype($association->getTransactions()));
        $this->assertEquals(gettype(new Association()), gettype($association));

        $this->assertEquals('1234', $association->getPhoneNumber());
        $this->assertEquals('1234', $association->getMobile());
        $this->assertEquals('Website', $association->getWebsite());
        $this->assertEquals('type', $association->getAssociationType());


        $association->removePlanning($planning)
            ->removeFileManager($fileManager)
            ->removeMember($member)
            ->removeAddress($address)
            ->removeNetworksSocialLink($networksSocialLink)
            ->removeTransaction($transaction)
            ->removeWorkGroup($workGroup);

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
    ): \ReflectionProperty
    {
        $reflection = new \ReflectionClass($class);
        $method = $reflection->getProperty($propertyName);
        $method->setAccessible(true);
        $method->setValue($newClass, $value);
        return $method;
    }

}
