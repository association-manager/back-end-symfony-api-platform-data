<?php

namespace App\Controller;

use App\Form\UserType;
use App\Form\AccountType;
use App\Entity\PasswordUpdate;
use App\Form\PasswordUpdateType;
use Symfony\Component\Form\FormError;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * @Route("/admin/regie-publicitaire")
 */
class SecurityController extends AbstractController
{
    private $manager;

    public function __construct(EntityManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @Route("/connexion", name="app_advertisement_login")
     */
    public function login(AuthenticationUtils $authenticationUtils): Response
    {
        // if ($this->getUser()) {
        //     return $this->redirectToRoute('target_path');
        // }

        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();
        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', ['last_username' => $lastUsername, 'error' => $error]);
    }

    /**
     * @Route("/deconnexion", name="app_advertisement_logout")
     */
    public function logout()
    {
        throw new \LogicException('This method can be blank - it will be intercepted by the logout key on your firewall.');
    }


    /**
     * @Route("/compte/profile", name="app_advertisement_account_profile")
     * 
     * @return Response
     */
    public function profile(Request $request) {
        $user = $this->getUser();

        $form = $this->createForm(UserType::class, $user);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            // Add addresses to user
            foreach($user->getAddresses() as $address) {
                $address->setUser($user);
                $this->manager->persist($address);
            }

            $this->manager->persist($user);
            $this->manager->flush();

            $this->addFlash('success', "Votre profil a été modifié avec succès !"
            );

            return $this->redirectToRoute('admin_advertisement_home');

        }

        return $this->render('security/profile.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * Password update
     *
     * @Route("/compte/modification-du-mot-de-passe", name="app_advertisement_account_password_update")
     * 
     * @return Response
     */
    public function updatePassword(Request $request, UserPasswordEncoderInterface $encoder) {
        $passwordUpdate = new PasswordUpdate();

        $user = $this->getUser();

        $form = $this->createForm(PasswordUpdateType::class, $passwordUpdate);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            if(!password_verify($passwordUpdate->getOldPassword(), $user->getPassword())){
                $form->get('oldPassword')->addError(new FormError("Le mot de passe que vous avez saisi ne correspond pas au mot de passe connu dans notre système."));
            } else {
                $newPassword = $passwordUpdate->getNewPassword();
                $password = $encoder->encodePassword($user, $newPassword);

                $user->setPassword($password);

                $this->manager->persist($user);
                $this->manager->flush();

                $this->addFlash(
                    'success',
                    "Votre mot de passe a été bien modifié"
                );

                return $this->redirectToRoute('admin_advertisement_home');
            }
        }


        return $this->render('security/password_update.html.twig', [
            'form' => $form->createView()
        ]);
    }
    
    
}
