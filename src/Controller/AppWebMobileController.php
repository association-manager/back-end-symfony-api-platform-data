<?php

namespace App\Controller;

use App\Entity\AppWebMobile;
use App\Entity\Advertisement;
use App\Form\AdvertisementType;
use App\Form\Admin\AppWebMobileType as AppWebMobileAdminType;
use App\Form\AppWebMobileType;
use Doctrine\ORM\EntityManagerInterface;
use App\Repository\AppWebMobileRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin/regie-publicitaire")
 */
class AppWebMobileController extends AbstractController
{
    private $manager;

    private $appWebMobileRepo;

    public function __construct(EntityManagerInterface $manager, AppWebMobileRepository $appWebMobileRepo)
    {
        $this->manager = $manager;
        $this->appWebMobileRepo = $appWebMobileRepo;
    }

    /**
     * @Route("/applications", name="app_web_mobile_admin_index", methods={"GET"})
     */
    public function indexAdmin(): Response
    {
        $appWebMobiles = $this->appWebMobileRepo->findAll();

        return $this->render('ad_admin/app_web_mobile/index.html.twig', [
            'appWebMobiles' => $appWebMobiles,
        ]);
    }


    /**
     * @IsGranted("ROLE_ADVERTISER")
     * @Route("/annonces/{id}/applications", name="app_web_mobile_index", methods={"GET"})
     */
    public function indexAppShow(Advertisement $advertisement): Response
    {        
        $appWebMobilesByAd = $this->appWebMobileRepo->findBy(array('advertisement' => $advertisement->getId()));

        // dd($appWebMobilesByUser);

        return $this->render('ad_admin/app_web_mobile/index.html.twig', [
            'appWebMobilesByAd' => $appWebMobilesByAd
        ]);
    }

    /**
     * @IsGranted("ROLE_ADVERTISER")
     * @Route("/annonces/{id}/applications/ajouter", name="app_web_mobile_new", methods={"GET","POST"})
     */
    public function new(Advertisement $advertissement, Request $request): Response
    {
        $appWebMobile = new AppWebMobile();

        $user = $this->getUser();

        if ($user->getRoles() === array('ROLE_ADMIN', 'ROLE_USER')) {
            $form = $this->createForm(AppWebMobileAdminType::class, $appWebMobile);
            $form->handleRequest($request);
        }elseif ($user->getRoles() === array('ROLE_ADVERTISER', 'ROLE_USER')) {
            $form = $this->createForm(AppWebMobileType::class, $appWebMobile);
            $form->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {

            $appWebMobile->setAdvertisement($advertissement);

            // Set user app to annonce
            $user = $this->getUser();

            $this->manager->persist($appWebMobile);
            $this->manager->flush();

            $this->addFlash('success', "L'application a été ajoutée avec succès");

            return $this->redirectToRoute('advertisement_index');
        }

        if ($user->getRoles() === array('ROLE_ADMIN', 'ROLE_USER')) {
            return $this->render('ad_admin/app_web_mobile/save.html.twig', [
                'advertissement' => $advertissement->getId(),
                'appWebMobile' => $appWebMobile,
                'form' => $form->createView(),
            ]);
        }elseif ($user->getRoles() === array('ROLE_ADVERTISER', 'ROLE_USER')) {
            return $this->render('ad_admin/app_web_mobile/restricted_save.html.twig', [
                'advertissement' => $advertissement->getId(),
                'appWebMobile' => $appWebMobile,
                'form' => $form->createView(),
            ]);
        }
    }

    

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/applications/{id}/afficher", name="app_web_mobile_admin_show", methods={"GET"})
     */
    public function showAdAdmin(AppWebMobile $appWebMobile): Response
    {
        return $this->render('ad_admin/app_web_mobile/show.html.twig', [
            'appWebMobile' => $appWebMobile,
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADVERTISER') and user === appWebMobile.getAdvertisement().getUser()", message="Cette application ne vous appartient pas, vous ne pouvez pas la consulter")
     * @Route("/applications/{id}/consulter", name="app_web_mobile_advertiser_show", methods={"GET"})
     */
    public function showAdAdvertiser(AppWebMobile $appWebMobile): Response
    {
        return $this->render('ad_admin/app_web_mobile/show.html.twig', [
            'appWebMobile' => $appWebMobile,
        ]);
    }


    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/applications/{id}/modifier", name="app_web_mobile_admin_edit", methods={"GET","POST"})
     */
    public function editAdAdmin(Request $request, AppWebMobile $appWebMobile): Response
    {
        $user = $this->getUser();

        if ($user->getRoles() === array('ROLE_ADMIN', 'ROLE_USER')) {
            $form = $this->createForm(AppWebMobileAdminType::class, $appWebMobile);
            $form->handleRequest($request);
        }
        if ($form->isSubmitted() && $form->isValid()) {

            $this->manager->flush();

            $this->addFlash('success', "L'application a été modifiée avec succès");

            return $this->redirectToRoute('advertisement_index');
        }
        return $this->render('ad_admin/app_web_mobile/save.html.twig', [
            'appWebMobile' => $appWebMobile,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Security("is_granted('ROLE_ADVERTISER') and appWebMobile.getAdvertisement().getUser()", message="Cette application ne vous appartient pas, vous ne pouvez pas la modifier")
     * @Route("/applications/{id}/editer", name="app_web_mobile_advertiser_edit", methods={"GET","POST"})
     */
    public function editAdAdvertiser(Request $request, AppWebMobile $appWebMobile): Response
    {
        $user = $this->getUser();
    
            $form = $this->createForm(AppWebMobileType::class, $appWebMobile);
            $form->handleRequest($request);

            if ($form->isSubmitted() && $form->isValid()) {
    
                $this->manager->flush();
    
                $this->addFlash('success', "L'application a été modifiée avec succès");
    
                return $this->redirectToRoute('advertisement_index');
            }

            return $this->render('ad_admin/app_web_mobile/restricted_save.html.twig', [
                'appWebMobile' => $appWebMobile,
                'form' => $form->createView(),
            ]);
                
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour éxecuter cette fonction")
     * @Route("/applications/{id}/supprimer", name="app_web_mobile_admin_delete", methods={"DELETE"})
     */
    public function deleteAdAdmin(Request $request, AppWebMobile $appWebMobile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appWebMobile->getId(), $request->request->get('_token'))) {

            // Remove Add
            $this->manager->remove($appWebMobile);
            $this->manager->flush();
            $this->addFlash('success', "L'application a été supprimée avec succès");
        }

        return $this->redirectToRoute('advertisement_index');
    }

    /**
     * @Security("is_granted('ROLE_ADVERTISER') and appWebMobile.getAdvertisement().getUser()", message="Cette application ne vous appartient pas, vous ne pouvez pas la modifier")
     * @Route("/applications/{id}/effacer", name="app_web_mobile_advertiser_delete", methods={"DELETE"})
     */
    public function deleteAdAdvertiser(Request $request, AppWebMobile $appWebMobile): Response
    {
        if ($this->isCsrfTokenValid('delete'.$appWebMobile->getId(), $request->request->get('_token'))) {

            // Remove Add
            $this->manager->remove($appWebMobile);
            $this->manager->flush();
            $this->addFlash('success', "L'application a été supprimée avec succès");
        }

        return $this->redirectToRoute('advertisement_index',);
    }
}
