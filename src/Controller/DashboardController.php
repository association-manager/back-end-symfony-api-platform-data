<?php

namespace App\Controller;

use App\Service\StatsService;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppWebMobileRepository;
use App\Repository\AdvertisementRepository;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class DashboardController extends AbstractController
{
    /**
     * @Route("/admin/regie-publicitaire", name="admin_advertisement_home")
     */
    public function index(AdvertisementRepository $adRepo, EntityManagerInterface $manager, StatsService $statsService)
    {
        $user = $this->getUser();

        if ($user === null) {
            return $this->redirectToRoute('app_advertisement_login');
        }
        elseif (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles()) === false & in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles()) === false ) {
            return $this->redirectToRoute('advertisement_new');
        }
        elseif (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles()) || in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles())) {
            // ---Start admin user stats
            $stats = $statsService->getStats();

            // Ads valid staus
            $findAllValidAds = $adRepo->findBy(array('status' => 'Validé'));

            $AllValidAds = count($findAllValidAds);

            // Ads Waiting for validation
            $findAllWattingForValidationAds = $adRepo->findBy(array('status' => 'En attente de validation'));

            $AllWattingForValidationAds = count($findAllWattingForValidationAds);

            // Ads Validated and published
            $findAllValidatedAndPublishedAds = $adRepo->findBy(array('status' => 'Validé et publié'));

            $AllValidatedAndPublishedAds = count($findAllValidatedAndPublishedAds);

            // Unpublished
            $findAllUnpublishedAds = $adRepo->findBy(array('status' => 'Dépublié'));

            $AllUnpublishedAds = count($findAllUnpublishedAds);

            // Refuse
            $findAllRefuseAds = $adRepo->findBy(array('status' => 'Refusé'));

            $AllRefuseAds = count($findAllRefuseAds);

            // ---End admin user stats
            
            //-----------------------------------

                    
            // ---Start App user stats
            $user = $this->getUser();

            // Ads
            $findUserAds = $adRepo->findBy(array('user' => $user));

            $advertisementsByAppUser = count($findUserAds);
            // dd($advertisementsByAppUser);
            
            // Ads valid staus
            $findValidAds = $adRepo->findBy(array('user' => $user, 'status' => 'Validé'));

            $validAds = count($findValidAds);

            // Ads Waiting for validation
            $findWattingForValidationAds = $adRepo->findBy(array('user' => $user, 'status' => 'En attente de validation'));

            $wattingForValidationAds = count($findWattingForValidationAds);

            // Ads Validated and published
            $findValidatedAndPublishedAds = $adRepo->findBy(array('user' => $user, 'status' => 'Validé et publié'));

            $validatedAndPublishedAds = count($findValidatedAndPublishedAds);

            // Unpublished
            $findUnpublishedAds = $adRepo->findBy(array('user' => $user, 'status' => 'Dépublié'));

            $unpublishedAds = count($findUnpublishedAds);

            // Refuse
            $findRefuseAds = $adRepo->findBy(array('user' => $user, 'status' => 'Refusé'));

            $refuseAds = count($findRefuseAds);

            // ---End app user stat
            
            // --------------------------------

            return $this->render('ad_admin/dashboard/home.html.twig', [
                // Admin stats
                'stats'     => $stats,
                'AllValidAds' => $AllValidAds,
                'AllWattingForValidationAds' => $AllWattingForValidationAds,
                'AllValidatedAndPublishedAds' => $AllValidatedAndPublishedAds,
                'AllUnpublishedAds' => $AllUnpublishedAds,
                'AllRefuseAds' => $AllRefuseAds,

                // User stats
                'advertisementsByAppUser' => $advertisementsByAppUser,
                'validAds' => $validAds,
                'wattingForValidationAds' => $wattingForValidationAds,
                'validatedAndPublishedAds' => $validatedAndPublishedAds,
                'unpublishedAds' => $unpublishedAds,
                'refuseAds' => $refuseAds
            ]);

        }
    }
}