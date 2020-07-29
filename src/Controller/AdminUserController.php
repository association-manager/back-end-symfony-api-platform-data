<?php

namespace App\Controller;

use App\Entity\User;
use App\Service\AdminAdService;
use App\Repository\UserRepository;
use Symfony\Component\Mime\Address;
use Doctrine\ORM\EntityManagerInterface;
use App\Form\Admin\AdminRegistrationUserFormType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use App\Security\EmailVerifier;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/regie-publicitaire")
 */
class AdminUserController extends AbstractController
{
    private $emailVerifier;

    public function __construct(EntityManagerInterface $manager, EmailVerifier $emailVerifier)
    {
        $this->manager = $manager;
        $this->emailVerifier = $emailVerifier;
    }

    /**
     * @Route("/annonceurs", name="admin_user_index", methods={"GET"})
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé à effectuer cette action !")
     *
     * @param UserRepository $userRepo
     * @param EntityManagerInterface $manager
     * @param AdminAdService $adUsersService
     * @return void
     */
    public function adminIndexUser(UserRepository $userRepo, EntityManagerInterface $manager, AdminAdService $adUsersService) : Response
    {
        $adminUser = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $adminUser->getRoles())) {
            $users = $adUsersService->getAllUserWhereAdIsNotNull();

            return $this->render('ad_admin/admin_user/index.html.twig', [
                'users' => $users,
            ]);
        }
    }

    /**
     * Permet d'afficher le formulaire d'inscription
     *
     * @Route("/annonceurs/creer", name="admin_user_new", methods={"GET", "POST"})
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé à effectuer cette action !")
     *
     * @param Request $request
     * @param UserPasswordEncoderInterface $encoder
     * @return Response
     */
    public function adminNewUser(Request $request, UserPasswordEncoderInterface $passwordEncoder): Response
    {
        $adminUser = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $adminUser->getRoles())) {
            $user = new User();
            $form = $this->createForm(AdminRegistrationUserFormType::class, $user);
            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                // encode the plain password
                $user->setPassword(
                    $passwordEncoder->encodePassword(
                        $user,
                        $form->get('plainPassword')->getData()
                    )
                );

                $this->manager->persist($user);
                $this->manager->flush();

                // generate a signed url and email it to the user
                $this->emailVerifier->sendEmailConfirmation('app_verify_email', $user,
                    (new TemplatedEmail())
                        ->from(new Address('association-manager-imie-2020-noreply@gmail.com', 'Association Manager'))
                        ->to($user->getEmail())
                        ->subject('Merci de confirmer votre email')
                        ->htmlTemplate('registration/confirmation_email.html.twig')
                );
                // do anything else you need here, like send an email
                
                $this->addFlash('success', "Le compte utilisateur <strong>{$user->getFullName()} </strong> a été créé avec succès");

                return $this->redirectToRoute('admin_user_show', [
                    'user' => $user,
                    'id' => $user->getId(),
                ]);

            }

            return $this->render('ad_admin/admin_user/save.html.twig', [
                'form' => $form->createView()
            ]);
        }
    }

    /**
     * @Route("/annonceurs/{id}/afficher", name="admin_user_show", methods={"GET"})
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé à effectuer cette action !")
     *
     * @param User $user
     * @return Response
     */
    public function adminShowUser(User $user): Response
    {
        $adminUser = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $adminUser->getRoles())) {
            return $this->render('ad_admin/admin_user/show.html.twig', [
                'user' => $user,
            ]);
        }
    }

    /**
     * @Route("/annonceurs/{id}/modifier", name="admin_user_edit", methods={"GET","POST"})
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé à effectuer cette action !")
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function adminEditUser(Request $request, User $user): Response
    {
        $adminUser = $this->getUser();

        if (in_array($this->isGranted('ROLE_ADMIN'), $adminUser->getRoles())) {
            $form =$this->createForm(AdminRegistrationUserFormType::class, $user);

            $form->handleRequest($request);

            if($form->isSubmitted() && $form->isValid()){
                $this->manager->persist($user);
                $this->manager->flush();

                $this->addFlash('success', "Le compte utilisateur a été modifié avec succès");

                return $this->redirectToRoute('admin_user_show', [
                    'id' => $user->getId(),
                ]);

            }

            return $this->render('ad_admin/admin_user/save.html.twig', [
                'form' => $form->createView(),
                'user' => $user,
            ]); 
        }
    }

    /**
     * @Route("/annonceurs/{id}/supprimer", name="admin_user_delete")
     * @Security("is_granted('ROLE_ADMIN')", message="Vous n'êtes pas autorisé à effectuer cette action !")
     *
     * @param Request $request
     * @param User $user
     * @return Response
     */
    public function adminDeleteUser(Request $request, User $user) : Response
    {
        if ($this->isCsrfTokenValid('delete'.$user->getId(), $request->request->get('_token'))) {
            $this->manager->remove($user);
            $this->manager->flush();

            $this->addFlash('success', "L'utilisateur a été supprimé avec succès");
        }

        return $this->redirectToRoute('admin_user_index');
    }
}
