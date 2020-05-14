<?php


namespace App\Events;


use ApiPlatform\Core\EventListener\EventPriorities;
use App\Entity\User;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\HttpKernel\KernelEvents;
use Symfony\Component\HttpKernel\Event\ViewEvent;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class PasswordEncoderSubscriber implements EventSubscriberInterface
{
    /**
     * @var UserPasswordEncoderInterface
     */
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $userPasswordEncoder)
    {
        $this->passwordEncoder = $userPasswordEncoder;
    }

    public static  function getSubscribedEvents()
    {
        return [
            KernelEvents::VIEW => [ 'encodePassword', EventPriorities::POST_VALIDATE]
        ];
    }

    public function encodePassword(ViewEvent $event)
    {
        $user = $event->getControllerResult();

        if ($user instanceof User && $user->getPlainPassword()) {
            $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
            $user->setPassword($password);
        }
    }
}
