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
                'lastName' => $user->getLastName(),
                'addresse' => $addresses[0]->getId()
            );
        
            $event->setData($data);
        }
    }
?>