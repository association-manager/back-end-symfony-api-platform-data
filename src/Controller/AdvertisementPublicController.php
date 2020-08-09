<?php

namespace App\Controller;

use App\Entity\Advertisement;
use App\Form\AdvertisementType;
use App\Entity\AdvertisementFile;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AdvertisementRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\Admin\AdvertisementType as AdAdminType;
use App\Form\DefaultForm\AdvertisementType as AdDefaultType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


class AdvertisementPublicController extends AbstractController
{
    private $manager;

    private $advertisementRepo;

    public function __construct(EntityManagerInterface $manager, AdvertisementRepository $advertisementRepo)
    {
        $this->manager = $manager;
        $this->advertisementRepo = $advertisementRepo;
    }

    /**
     * @IsGranted("ROLE_ADVERTISER")
     * @Route("/admin/annonces/template/mobile", name="advertisement_admin_public_show", methods={"GET"})
     */
    public function index(): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');

        // Admin user :
        $advertisements = $this->advertisementRepo->findAll();

        // Advertiser user : 
        $user = $this->getUser();
        $advertisementsByUser = $this->advertisementRepo->findBy(array('user' => $user));

        
        //start user roles
        // if ad is null

        // dd(count($user->getAdvertisements()));
        $advertiserRole = $user->getRoles();

        $ads = count($user->getAdvertisements());

        if(($ads < 1) & (array_search('ROLE_ADMIN', $advertiserRole) === false ) & (array_search('ROLE_ADVERTISER', $advertiserRole) !== false )){  
            $user->setRoles([]);
        }

        $this->manager->flush($user);
        
        //end user roles
        
        // dd($advertisementsByUser);
        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles()) || in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles())) {
            return $this->render('ad_public_mobile/advertisement/index.html.twig', [
                'advertisements' => $advertisements,
                'advertisementsByUser' => $advertisementsByUser
            ]);
        }
    }

    /**
     * @Route("/annonces/{iframeLink}", name="advertisement_public_mobile_show", methods={"GET"})
     */
    public function showAdPublicMobile(Advertisement $advertisement): Response
    {
        return $this->render('ad_public_mobile/advertisement/show.html.twig', [
            'advertisement' => $advertisement,
        ]);
    }
    
}
