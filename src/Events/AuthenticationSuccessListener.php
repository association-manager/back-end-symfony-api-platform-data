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
                'addresse' => 
                    count($addresses) != 0 ? 
                    [
                        "id" => $addresses[0]->getId(), 
                        "addressLine1" => $addresses[0]->getAddressLine1(),
                        "addressLine2" => $addresses[0]->getAddressLine2(),
                        "postalCode" => $addresses[0]->getPostalCode(),
                        "city" => $addresses[0]->getCountry(),
                        "type" => $addresses[0]->getType()
                    ] : 
                    'Aucune adresse enregistrée pour cet utilisateur',
                'roles' => $user->getRoles()
            );
        
            $event->setData($data);
        }
    }
?>