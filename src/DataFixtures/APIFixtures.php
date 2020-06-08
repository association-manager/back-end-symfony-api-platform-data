<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Address;
use App\Entity\Announce;
use App\Entity\Association;
use App\Entity\AssociationProfile;
use App\Entity\AssoManagerEvent;
use App\Entity\Category;
use App\Entity\Donation;
use App\Entity\FileManager;
use App\Entity\InvoiceDonation;
use App\Entity\InvoiceShop;
use App\Entity\Member;
use App\Entity\MemberTaskWorkGroupRelation;
use App\Entity\NetworksSocialLink;
use App\Entity\Planning;
use App\Entity\ProductWebsite;
use App\Entity\Project;
use App\Entity\ProjectPlanning;
use App\Entity\Staff;
use App\Entity\Task;
use App\Entity\Transaction;
use App\Entity\WorkGroup;
use Doctrine\Persistence\ObjectManager;


class APIFixtures extends BaseFixture
{
    protected function loadData(ObjectManager $manager)
    {
        $this->manager = $manager;

        $this->createMany(Association::class, 10, function (Association $association, $count) {

            // Start Category - fixtures
            $category = new Category();

            $category->setName($this->faker->sentence(3, false))
                    ->setType($this->faker->sentence(2, false));

            $this->manager->persist($category);
            // End Category - fixtures


            // Start User - fixtures

            // User Adress Type
            $userAddressTypes = [
                "Domicile",
                "Travail",
                "Autre"
            ];

            // User Address 
            $userAddress = new Address();
            $userAddress->setAddressLine1($this->faker->streetAddress)
                    ->setPostalCode($this->faker->postcode)
                    ->setCity($this->faker->city)
                    ->setCountry($this->faker->country)
                    ->setType($this->faker->randomElement($userAddressTypes));

            // Association User Custom Phone 
            $userCustomPhone = (6023156326 + $count);
            // Association User
            $user = new User();
            $hash = $this->encoder->encodePassword($user, "password");
            $user->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName)
                ->setEmail('test1789'.$count.'@test.com')
                ->setCreatedAt($this->faker->dateTime)
                ->setMobile($count != 0 ? '+336' . strval($userCustomPhone) : '+336023156325')
                ->setSex($this->faker->randomElement(['male', 'female', '']))
                ->setDob($this->faker->dateTime)
                ->setPassword($hash)
                ->setDataUsageAgreement($this->faker->randomElement([1, 0]))
                ->addAddress($userAddress);
            // En User - fictures 

            // Others Users
            $otherUserCustomPhone = (6013150011 + $count);
            
            $otherUser = new User();
            $otherHash = $this->encoder->encodePassword($otherUser, "password");
            $otherUser->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName)
                ->setEmail('test265987'.$count.'@test.com')
                ->setCreatedAt($this->faker->dateTime)
                ->setMobile($count != 0 ? '+336' . strval($otherUserCustomPhone) : '+336013150011')
                ->setSex($this->faker->randomElement(['male', 'female', '']))
                ->setDob($this->faker->dateTime)
                ->setPassword($otherHash)
                ->setDataUsageAgreement($this->faker->randomElement([1, 0]))
                ->addAddress($userAddress);

            $this->manager->persist($otherUser);

            // Start Member - fixtures
            // Member Type
            $memberRoles = [
                "Bénévole",
                "Intervenant",
                "Autre"
            ];
                // Association User Member

            $member = new Member();
            $member->setProfile([$user->getFirstName().$count])
                    ->setRoles($this->faker->randomElements($memberRoles))
                    ->setUserId($user)
                    ->addAssociation($association);

            $this->manager->persist($member);
            // End Member - fixtures




            // Start Donation - fixtures
                // donation amount
            $donationAmount = [
                1500.38,
                1789.05,
                20.56,
                190,02,
                1.00,
                300.00
            ];

                // donation created at
            $donationCreatedAt = [
                $this->faker->dateTimeBetween("-12 months"),
                $this->faker->dateTimeBetween("-11 months"),
                $this->faker->dateTimeBetween("-10 months"),
                $this->faker->dateTimeBetween("-9 months"),
                $this->faker->dateTimeBetween("-8 months"),
                $this->faker->dateTimeBetween("-7 months"),
                $this->faker->dateTimeBetween("-6 months"),
                $this->faker->dateTimeBetween("-5 months"),
                $this->faker->dateTimeBetween("-4 months"),
                $this->faker->dateTimeBetween("-3 months"),
                $this->faker->dateTimeBetween("-2 months"),
                $this->faker->dateTimeBetween("-1 months"),
                $this->faker->dateTimeBetween("now")
            ];


            // donation created at
            $donationTvaPercentage = [
                10,
                5.5
            ];



                // Association User Member

            $donation = new Donation();
            $donation->setAmount($this->faker->randomElement($donationAmount))
                    ->setMensuality(mt_rand(0, 1))
                    ->setTaxDeductionPercentage($this->faker->randomElement($donationTvaPercentage))
                    ->setCreatedAt($this->faker->randomElement($donationCreatedAt))
                    ->setMember($member);

            $this->manager->persist($donation);
            // End Donation - fixtures




            // Start WorkGroup - fixtures 
            
                // Association WorkGroup
            $associationWorkGroups = [];

            for ($wg = 1; $wg < mt_rand(1, 3); $wg++) {
                $associationWorkGroup = new WorkGroup();

                $associationWorkGroup->setName("Groupe".$count)
                ->addAssociationId($association)
                ->addWorkGroup($associationWorkGroup);
                    // Can be completed

                $this->manager->persist($associationWorkGroup);

                $associationWorkGroups[] = $associationWorkGroup;

                // Linked project
                // Start Project - fixtures
                    // project status
                $projectStatus = [
                    "EN ÉTUDE",
                    'CONFIRMÉ',
                    'DÉMARRÉ',
                    'EN COURS',
                    'TERMINÉ',
                    'ANNULÉ',
                    'EN PRODUCTION',
                ];

                    // project type
                $projectTypes = [
                    "Project Type 1",
                    'Project Type 2',
                    'Project Type 3',
                    'Project Type 4',
                    'Project Type 5',
                    'Project Type 6',
                    'Project Type 7',
                ];
                
                for ($p = 1; $p < 2; $p++) {
                    // linked planning
                    // Start Planning - fixtures 

                    $associationPlanningProjectColor = [
                        "red",
                        "green",
                        "gray",
                        "blue"
                    ];

                    $associationPlanningProject = new Planning();

                    $associationPlanningProject->setName("Planning".$count)
                                                ->setStartAt($this->faker->dateTimeBetween('-20 days'))
                                                ->setEndAt($this->faker->dateTimeBetween('now'))
                                                ->setColor($this->faker->randomElement($associationPlanningProjectColor))
                                                ->setAssociation($association)
                                                ->setCategory($category);

                    $this->manager->persist($associationPlanningProject);
                    // End Planning - fixtures


                    $project = new Project();

                    $project->setName("Project".$count)
                            ->setStartAt($this->faker->dateTimeBetween('-6 months'))
                            ->setEndAt($this->faker->dateTimeBetween('now'))
                            ->setStatus($this->faker->randomElement($projectStatus))
                            ->setProjectType($this->faker->randomElement($projectTypes))
                            ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>')
                            ->setWorkGroup($associationWorkGroup)
                            ->setPlanning($associationPlanningProject);
                    
                    $this->manager->persist($project);

                        // Project Planning
                    for ($pp = 1; $pp < 2; $pp++) {

                        $projectPlanning = new ProjectPlanning();

                        $projectPlanning->setName($this->faker->sentence(2, true))
                                        ->setStartAt($this->faker->dateTimeBetween('-2 months'))
                                        ->setEndAt($this->faker->dateTimeBetween('now'))
                                        ->setProject($project);

                        $this->manager->persist($projectPlanning);


                            // Linked Task
                        $taskType = [
                            "Task Type 1",
                            "Task Type 2",
                            "Task Type 3",
                            "Task Type 4"
                        ];

                        for ($t = 1; $t < 2; $t++) {

                            $task = new Task();

                            $task->setTitle("Tâche ".$count)
                                ->setStartDate($this->faker->dateTimeBetween('-2 months'))
                                ->setEndDate($this->faker->dateTimeBetween('now'))
                                ->setType($this->faker->randomElement($taskType))
                                ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>')
                                ->setProjectPlanning($projectPlanning);

                            $this->manager->persist($task);
                        }

                    }

                    // Start Member Task Work Group - fixtures
                    $memberTaskWorkGroup = new MemberTaskWorkGroupRelation();
                    
                    $memberTaskWorkGroup->setMember($member)
                                        ->setTask($task)
                                        ->setWorkGroup($associationWorkGroup);

                    $this->manager->persist($memberTaskWorkGroup);
                    // End Member Task Work Group - fixtures
                }
                // End Project - fixtures
            }

            // End WorkGroup - fixtures
            
            // Start Association - fixtures
            
                // Association Profile

            $associationProfile = new AssociationProfile();

            $associationProfile->setTitle("Profile".$count)
                                ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>')
                                ->setDescriptionTitle("Description par défaut".$count);



                // Association Address Type
            $associationAddressTypes = [
                "Paris",
                "Lyon"
            ];

                // Association Address 
            $associationAddress = new Address();
            $associationAddress->setAddressLine1($this->faker->streetAddress)
                ->setPostalCode($this->faker->postcode)
                ->setCity($this->faker->city)
                ->setCountry($this->faker->country)
                ->setType("Notre adresse à ".$this->faker->randomElement($associationAddressTypes));

                // Association Type
            $associationTypes = [
                1,
                2,
                3,
            ];

                // Association
            $associationCustomPhone = (87985471 + $count);
            $name = $this->faker->company;
            $associationCustomName = strtolower(str_replace(" ", "", $name));


            $association->setName($name)
                ->setDataUsageAgreement($this->faker->randomElement([1, 0]))
                ->setAssociationType($this->faker->randomElement($associationTypes))
                ->setPhoneNumber($count != 0 ? '+331' . strval($associationCustomPhone) : '+33187985470')
                ->setMobile($count != 0 ? '+336' . strval($associationCustomPhone) : '+33687985470')
                ->setWebsite($count != 0 ? 'https://www.association-manager.fr/' . trim(str_replace(".", "", $associationCustomName)) : 'https://www.association-manager.fr/test')
                ->setEmail($count != 0 ? trim($associationCustomName) . '@association-manager.fr' : 'test@association-manager.fr')
                ->setFirstName($this->faker->firstName())
                ->setLastName($this->faker->lastName)
                ->setAssemblyConstituveDate($this->faker->dateTimeBetween('-6 months'))
                ->setFoundedAt($this->faker->dateTimeBetween('-6 months'))
                ->setCreatedAt($this->faker->dateTimeBetween('-3 months'))
                ->setCreatedBy($user)
                ->addAddress($associationAddress)
                ->setAssociationProfile($associationProfile);

            // End Association - fixtures

            // Start Staff - fixtures

            $staff = new Staff();
            $staff->setName("Staff ".$count)
                ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>')
                ->setDataUsageAgreement(mt_rand(0,1))
                ->setAssociationType($association->getAssociationType())
                ->setPhoneNumber($association->getPhoneNumber())
                ->addMember($member);

            $this->manager->persist($staff);
            // End Staff - fixtures


            // Start NetWorkSocialLink - fixtures

                // Social Link
            $netWorkSocialLinkWebsite = [
                "https://www.facebook.com/",
                "https://twitter.com/",
            ];
            
            $website = $this->faker->randomElement($netWorkSocialLinkWebsite);

            $networkSocialLink = new NetworksSocialLink();
            
            $networkSocialLink->setWebsite($website.trim(strtolower(str_replace(".", "", str_replace(" ", "", $association->getName())))))
                                ->setName($website != 'https://www.facebook.com/' ? 'Twitter' : 'Facebook')
                                ->setIcon($website != 'https://www.facebook.com/' ? 'twitter.png' : 'facebook.png')
                                ->setAssociation($association);

            $this->manager->persist($networkSocialLink);
            // End NetWorkSocialLink - fixtures


            // Start Transaction - fixtures

                // Type
            $transactionType = [
                "Virement occasionnel",
                "Virement programmé",
                "Virement immédiat",
                "Virement différé",
                "Virement interne",
                "Virement externe",
                "Prélèvement",
                "Retrait",
                "Paiement sortant",
                "Paiement rentrant",
            ];

                //Status
            
            $transactionStatus = [
                // "Terminée",
                // "En cours",
                // "A venir",
                // "Annulée"
            ];

                // Transaction amount
            $transactionAmount = [
                1500.38,
                1789.05,
                20.56,
                190,02,
                1.00,
                300.00
            ];

                // Transaction created at
            $transactionCreatedAt = [
                $this->faker->dateTimeBetween("-12 months"),
                $this->faker->dateTimeBetween("-11 months"),
                $this->faker->dateTimeBetween("-10 months"),
                $this->faker->dateTimeBetween("-9 months"),
                $this->faker->dateTimeBetween("-8 months"),
                $this->faker->dateTimeBetween("-7 months"),
                $this->faker->dateTimeBetween("-6 months"),
                $this->faker->dateTimeBetween("-5 months"),
                $this->faker->dateTimeBetween("-4 months"),
                $this->faker->dateTimeBetween("-3 months"),
                $this->faker->dateTimeBetween("-2 months"),
                $this->faker->dateTimeBetween("-1 months"),
                $this->faker->dateTimeBetween("now")
            ];

            $transaction = new Transaction();

            $transaction->setType($this->faker->randomElement($transactionType))
                        ->setDate($this->faker->randomElement($transactionCreatedAt))
                        ->setDetails('<p>' . join('</p><p>', $this->faker->paragraphs(3)) . '</p>')
                        ->setAmount($this->faker->randomElement($transactionAmount))
                        ->setStatus(mt_rand(0,1))
                        ->setAssociation($association)
                        ->setCategory($category);

            $this->manager->persist($transaction);
            // End Transaction - fixtures


            // Start FileManager - fixtures for Association

            $fileManagerTypes = [
                "pdf",
                "jpg"
            ];

            $fileManagerS3Key = [
                "s3-file".$count.".pdf",
                "s3-file".$count.".jpg"
            ];

            $fileManagerUrl = [
                "association/manager/pdf/file".$count.".pdf",
                "association/manager/images/file".$count.".jpg"
            ];


            $fileManager = new FileManager();

            $fileManager->setCreatedBy($user)
                        ->setAssociation($association)
                        ->setType($this->faker->randomElement($fileManagerTypes))
                        ->setText('<p>' . join('</p><p>', $this->faker->paragraphs(1)) . '</p>')
                        ->setUrl($this->faker->randomElement($fileManagerUrl))
                        ->setStatus(mt_rand(0,1))
                        ->setS3key($fileManager->getType() != 'pdf' ? $fileManagerS3Key[1] : $fileManagerS3Key[0])
                        ->setCreatedAt($this->faker->dateTimeBetween("-2 months"))
                        ->setName($fileManager->getType() != 'pdf' ? $fileManagerS3Key[1] : $fileManagerS3Key[0])
                        ->setSize(mt_rand(100,512)."ko");

            $this->manager->persist($fileManager);
            // End FileManager - fixtures for Association


            // Start Announce - fixtures

            $announce = new Announce();

            $announce->setName($this->faker->firstName())
                    ->setPriority($this->faker->numberBetween($min = 0, $max = 1))
                    ->setDescription($this->faker->realText($maxNbChars = 200, $indexSize = 2))
                    ->setDuration($this->faker->numberBetween($min = 1000, $max = 9000))
                    ->setAdUnitId($this->faker->uuid());

            $this->manager->persist($announce);
                // Start FileManager - fixtures for Announce

            $fileManagerTypes1 = [
                "pdf",
                "jpg"
            ];

            $fileManagerS3Key1 = [
                "s3-file".$count.".pdf",
                "s3-file".$count.".jpg"
            ];

            $fileManagerUrl1 = [
                "association/manager/pdf/file".$count.".pdf",
                "association/manager/images/file".$count.".jpg"
            ];


            $fileManager1 = new FileManager();

            $fileManager1->setCreatedBy($user)
                        ->addAnnounce($announce)
                        ->setType($this->faker->randomElement($fileManagerTypes1))
                        ->setText('<p>' . join('</p><p>', $this->faker->paragraphs(1)) . '</p>')
                        ->setUrl($this->faker->randomElement($fileManagerUrl1))
                        ->setStatus(mt_rand(0,1))
                        ->setS3key($fileManager1->getType() != 'pdf' ? $fileManagerS3Key1[1] : $fileManagerS3Key1[0])
                        ->setCreatedAt($this->faker->dateTimeBetween("-2 months"))
                        ->setName($fileManager1->getType() != 'pdf' ? $fileManagerS3Key1[1] : $fileManagerS3Key1[0])
                        ->setSize(mt_rand(100,512)."ko");

            $this->manager->persist($fileManager1);
                // End FileManager - fixtures for Announce

            // End Announce - fixtures


            // Start AssoManagerEvent - fixtures

                // Start Planning - fixtures for AssoManagerEvent

            $assoManagerEventPlanningColor = [
                "red",
                "green",
                "gray",
                "blue"
            ];

            $assoManagerEventPlanning = new Planning();

            $assoManagerEventPlanning->setName("Planning".$count)
                                        ->setStartAt($this->faker->dateTimeBetween('-20 days'))
                                        ->setEndAt($this->faker->dateTimeBetween('now'))
                                        ->setColor($this->faker->randomElement($assoManagerEventPlanningColor))
                                        ->setAssociation($association)
                                        ->setCategory($category);

            $this->manager->persist($assoManagerEventPlanning);
                // End Planning - fixtures for AssoManagerEvent

            $assoManagerEvent = new AssoManagerEvent();

            $assoManagerEvent
            ->setName("Evènement$count")
                            ->setStartDate($assoManagerEventPlanning->getStartAt())
                            ->setEndDate($assoManagerEventPlanning->getEndAt())
                            ->addPlanning($assoManagerEventPlanning);

            $this->manager->persist($assoManagerEvent);
            // End AssoManagerEvent - fixtures 

            // INVOICIES
            $amounts = [
                5000,
                15000
            ];

            $invoiceTva = [
                10,
                5.5
            ];


            $totalAmount = $this->faker->randomElement($amounts);

            $totalAfterDeduction = (($totalAmount * $this->faker->randomElement($invoiceTva)) / 100);


            // Start InvoiceDonation -- fixtures
            $invoiceDonation = new InvoiceDonation();
            
            $invoiceDonation->setCreatedAt($this->faker->dateTimeBetween('-20 days'))
                            ->setTotalAmount(floatval($totalAmount))
                            ->setTotalAfterDeduction(floatval($totalAmount - $totalAfterDeduction));

            $this->manager->persist($invoiceDonation);

            // End InvoiceDonation -- fixtures


            // Start InvoiceShop -- fixtures

            // Data

            $a = [
                "user" => [
                    "id" => 20, 
                    "email" => "test@test.com", 
                    "mobile" => 123456789, 
                    "last_name" => "last_name", 
                    "first_name" => "first_name"], 
                "address" => [
                    "city" => "city", 
                    "postalCode" => 91080, 
                    "addressLine1" => "addressLine1", 
                    "addressLine2" => "addressLine2"], 
                "products" => [
                    [
                        "id" => "15", 
                        "url" => "url", 
                        "vat" => 5, 
                        "name" => "test", 
                        "price" => 15.5, 
                        "quantity" => 15, 
                        "description" => "test", 
                        "associationId" => 15
                    ], 
                    [
                        "id" => "15", 
                        "url" => "url", 
                        "vat" => 5, 
                        "name" => "test", 
                        "price" => 15.5, 
                        "quantity" => 15, 
                        "description" => "test", 
                        "associationId" => 15
                    ]
                ], 
                "totalVat" => 15, 
                "totalAmount" => 31
            ];

            // $data = json_encode($a);


            $invoiceShop = new InvoiceShop();
            
            $invoiceShop->setCreatedAt($this->faker->dateTimeBetween('-20 days'))
                        ->setAmount($this->faker->randomElement($amounts))
                        ->setVat($this->faker->randomElement($invoiceTva))
                        ->setData($a);

            $this->manager->persist($invoiceShop);

            // End InvoiceShop -- fixtures

            $productWs = [
                "Boutique",
                "Billeterie",
                "Donation",
                "Adhésion",
                "Administration"
            ];

            // Start ProductWebsite -- fixtures
            $productWebsite = new ProductWebsite();
            
            $productWebsite->setTitle($this->faker->randomElement($productWs))
                            ->setDescription('<p>' . join('</p><p>', $this->faker->paragraphs(1)) . '</p>')
                            ->setLogo($this->productWbS($productWebsite->getTitle(), $productWs));

            $this->manager->persist($productWebsite);

            // End ProductWebsite -- fixtures


        });
        $manager->flush();
    }

    public function productWbS($param1, $param2){
        if ($param1 === $param2[0]) {
            return "association/manager/images/store.png";
        }else if ($param1 === $param2[1]) {
            return "association/manager/images/ticket-office.png";
        }else if ($param1 === $param2[2]) {
            return "association/manager/images/donation.png";
        }else if ($param1 === $param2[3]) {
            return "association/manager/images/membership.png";
        }else {
            return "association/manager/images/dashboard.png";
        }
    }

}
