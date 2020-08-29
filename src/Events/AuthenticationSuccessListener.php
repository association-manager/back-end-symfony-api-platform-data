<?php

    namespace App\Events;
    use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;

    use Symfony\Component\Security\Core\User\UserInterface;

    class AuthenticationSuccessListener{
    
        /**
         * @param AuthenticationSuccessEvent $event
         * @return void
         */
        public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
        {
            $data = $event->getData();
            $user = $event->getUser();
            $addresses = $event->getUser()->getAddresses();

            if (!$user instanceof UserInterface) {
                return;
            }
        
        
            $data['data'] = array(
                'id' => $user->getId(),
                'firstName' => $user->getFirstName(),
                'lastName' => $user->getLastName()
                // 'addresse' => strlen($addresses) != 0 ? ["id" => $addresses->getId(), "addressLine1" => $addresses->getAddressLine1()] : 'Aucune adresse enregistrée pour cet utilisateur'
                // 'addresse' => $addresses[0]->getId()
            );
        
            $event->setData($data);
        }
    }
?>