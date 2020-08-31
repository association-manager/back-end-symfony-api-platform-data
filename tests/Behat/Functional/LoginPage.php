<?php

declare(strict_types=1);

namespace App\Tests\Behat\Functional;

use Behat\Mink\Exception\ElementNotFoundException;
use FriendsOfBehat\PageObjectExtension\Page\SymfonyPage;
use FriendsOfBehat\PageObjectExtension\Page\UnexpectedPageException;

class LoginPage extends SymfonyPage
{
    public function getRouteName(): string
    {
        return 'app_login';
    }

    /**
     * @param string $user
     * @param string $password
     * @throws ElementNotFoundException
     * @throws UnexpectedPageException
     */
    public function login(string $user, string $password): void
    {
        $this->open();
        $this->getDocument()->fillField('email', $user);
        $this->getDocument()->fillField('password', $password);
        $this->getDocument()->pressButton('Connexion');
    }
}
