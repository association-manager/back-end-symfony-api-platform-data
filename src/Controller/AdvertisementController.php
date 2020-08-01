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

/**
 * @Route("/admin/regie-publicitaire")
 */
class AdvertisementController extends AbstractController
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
     * @Route("/annonces", name="advertisement_index", methods={"GET"})
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
            return $this->render('ad_admin/advertisement/index.html.twig', [
                'advertisements' => $advertisements,
                'advertisementsByUser' => $advertisementsByUser
            ]);
        }
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/annonces/creer", name="advertisement_new")
     *
     * @param Request $request
     * @return Response
     */
    public function new(Request $request): Response
    {
        $this->denyAccessUnlessGranted('IS_AUTHENTICATED_FULLY');
        
        $advertisement = new Advertisement();

        $user = $this->getUser();


        // $form = $this->createForm(AdAdminType::class, $advertisement);
        // $form->handleRequest($request);

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            $form = $this->createForm(AdAdminType::class, $advertisement, ['userID' => $user->getId()]);
            $form->handleRequest($request);
        }elseif (in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles()) || in_array($this->isGranted('ROLE_USER'), $user->getRoles())) {
            $form = $this->createForm(AdDefaultType::class, $advertisement, ['userID' => $user->getId()]);
            $form->handleRequest($request);
        }

        if ($form->isSubmitted() && $form->isValid()) {
            // Set user app to annonce
            // $user = $this->getUser();
            
            if (!in_array($this->isGranted('ROLE_ADVERTISE'), $user->getRoles())) {
                $user->setRoles(['ROLE_ADVERTISER']);
            }

            $advertisement->setUser($user);

            // Add advertisement picture file to advertisement
            foreach($advertisement->getAdvertisementFiles() as $advertisementFile) {
                $advertisementFile->setAdvertisement($advertisement);
                $this->manager->persist($advertisementFile);
            }

            $this->manager->persist($advertisement);
            $this->manager->flush();

            $this->addFlash('success', "L'annonce a été ajoutée avec succès");

            return $this->redirectToRoute('advertisement_index');
        }

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            return $this->render('ad_admin/advertisement/save.html.twig', [
                'advertisement' => $advertisement,
                'form' => $form->createView(),
            ]);
        }elseif (in_array($this->isGranted('ROLE_USER'), $user->getRoles()) || in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles())) {
            return $this->render('ad_admin/advertisement/restricted_save.html.twig', [
                'advertisement' => $advertisement,
                'form' => $form->createView(),
            ]);
        }
    }

    

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/annonces/{id}/afficher", name="advertisement_admin_show", methods={"GET"})
     */
    public function showAdAdmin(Advertisement $advertisement): Response
    {
        $user = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            return $this->render('ad_admin/advertisement/show.html.twig', [
                'advertisement' => $advertisement,
            ]);
        }
    }

    /**
     * @Security("is_granted('ROLE_ADVERTISER') and user === advertisement.getUser()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la consulter")
     * @Route("/annonces/{id}/consulter", name="advertisement_advertiser_show", methods={"GET"})
     */
    public function showAdAdvertiser(Advertisement $advertisement): Response
    {
        $user = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles())) {
            return $this->render('ad_admin/advertisement/show.html.twig', [
                'advertisement' => $advertisement,
            ]);
        }
    }


    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour consulter cette page")
     * @Route("/annonces/{id}/modifier", name="advertisement_admin_edit", methods={"GET","POST"})
     */
    public function editAdAdmin(Request $request, Advertisement $advertisement): Response
    {
        $user = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            $form = $this->createForm(AdAdminType::class, $advertisement, ['userID' => $user->getId()]);
            $form->handleRequest($request);
        }
        if ($form->isSubmitted() && $form->isValid()) {

            // Add advertisement picture file to advertisement
            foreach($advertisement->getAdvertisementFiles() as $advertisementFile) {
                $advertisementFile->setAdvertisement($advertisement);
                $this->manager->persist($advertisementFile);
            }

            $this->manager->flush();

            $this->addFlash('success', "L'annonce a été modifiée avec succès");

            return $this->redirectToRoute('advertisement_index');
        }
        if (in_array($this->isGranted('ROLE_ADMIN'), $user->getRoles())) {
            return $this->render('ad_admin/advertisement/save.html.twig', [
                'advertisement' => $advertisement,
                'form' => $form->createView(),
            ]);
        }
    }

    /**
     * @Security("is_granted('ROLE_ADVERTISER') and user === advertisement.getUser()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * @Route("/annonces/{id}/editer", name="advertisement_advertiser_edit", methods={"GET","POST"})
     */
    public function editAdAdvertiser(Request $request, Advertisement $advertisement): Response
    {
        $user = $this->getUser();

        // dd($advertisement->getStatus());

        if (in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles())) {
            if (
                $advertisement->getStatus() == 'Validé' || 
                $advertisement->getStatus() == 'Publié' ||
                $advertisement->getStatus() == 'En pause' ||
                $advertisement->getStatus() == 'Dépublié' ||
                $advertisement->getStatus() == 'Validé et publié'
                ) {
                    $form = $this->createForm(AdvertisementType::class, $advertisement, ['userID' => $user->getId()]);
                    $form->handleRequest($request);
            }elseif ($advertisement->getStatus() == 'Refusé' || $advertisement->getStatus() == 'En attente de validation') {
                $form = $this->createForm(AdDefaultType::class, $advertisement, ['userID' => $user->getId()]);
                $form->handleRequest($request);
            }

            if ($form->isSubmitted() && $form->isValid()) {

                // Add advertisement picture file to advertisement
                foreach($advertisement->getAdvertisementFiles() as $advertisementFile) {
                    $advertisementFile->setAdvertisement($advertisement);
                    $this->manager->persist($advertisementFile);
                }
    
                $this->manager->flush();
    
                $this->addFlash('success', "L'annonce a été modifiée avec succès");
    
                return $this->redirectToRoute('advertisement_index');
            }
            if (in_array($this->isGranted('ROLE_ADVERTISER'), $user->getRoles())) {
                if (
                    $advertisement->getStatus() == 'Validé' || 
                    $advertisement->getStatus() == 'Publié' ||
                    $advertisement->getStatus() == 'En pause' ||
                    $advertisement->getStatus() == 'Dépublié' ||
                    $advertisement->getStatus() == 'Validé et publié'
                    ) {
                    return $this->render('ad_admin/advertisement/save.html.twig', [
                        'advertisement' => $advertisement,
                        'form' => $form->createView(),
                    ]);
                }else {
                    return $this->render('ad_admin/advertisement/restricted_save.html.twig', [
                        'advertisement' => $advertisement,
                        'form' => $form->createView(),
                    ]);
                }
            }
        }
    }

    /**
     * @Security("is_granted('ROLE_ADMIN')", message="Vous devez être un admin pour éxecuter cette fonction")
     * @Route("/annonces/{id}/supprimer", name="advertisement_admin_delete", methods={"DELETE"})
     */
    public function deleteAdAdmin(Request $request, Advertisement $advertisement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advertisement->getId(), $request->request->get('_token'))) {

            // Remove advertisement picture file to advertisement
            foreach($advertisement->getAdvertisementFiles() as $advertisementFile) {
                $advertisement->removeAdvertisementFile($advertisementFile);
                $this->manager->remove($advertisementFile);
            }

            // Remove Add
            $this->manager->remove($advertisement);
            $this->manager->flush();
            $this->addFlash('success', "L'annonce a été supprimée avec succès");
        }

        return $this->redirectToRoute('advertisement_index');
    }

    /**
     * @Security("is_granted('ROLE_ADVERTISER') and user === advertisement.getUser()", message="Cette annonce ne vous appartient pas, vous ne pouvez pas la modifier")
     * @Route("/annonces/{id}/effacer", name="advertisement_advertiser_delete", methods={"DELETE"})
     */
    public function deleteAdAdvertiser(Request $request, Advertisement $advertisement): Response
    {
        if ($this->isCsrfTokenValid('delete'.$advertisement->getId(), $request->request->get('_token'))) {

            // Remove advertisement picture file to advertisement
            foreach($advertisement->getAdvertisementFiles() as $advertisementFile) {
                $advertisement->removeAdvertisementFile($advertisementFile);
                $this->manager->remove($advertisementFile);
            }

            // Remove Add
            $this->manager->remove($advertisement);
            $this->manager->flush();
            $this->addFlash('success', "L'annonce a été supprimée avec succès");
        }

        return $this->redirectToRoute('advertisement_index');
    }
}
