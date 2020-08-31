<?php

declare(strict_types=1);

namespace App\Tests\Behat;

use Behat\Behat\Context\Context;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\KernelInterface;
use App\Tests\Behat\Functional\LoginPage;
use Behat\MinkExtension\Context\MinkContext;

/**
 * This context class contains the definitions of the steps used by the demo
 * feature file. Learn how to get started with Behat and BDD on Behat's website.
 *
 * @see http://behat.org/en/latest/quick_start.html
 */
final class FeatureContext extends MinkContext
{
    /** @var LoginPage */
    private $loginPage;

    public function __construct(LoginPage $loginPage)
    {
        $this->loginPage = $loginPage;
    }

    /**
     * @Given I am in login page
     */
    public function iAmInLoginPage(): void
    {
        $this->loginPage->open();
    }

    /**
     * @Then I log in user :username with pass :password
     * @param string $email
     * @param string $password
     */
    public function iLogInUserWithPass(string $email, string $password): void
    {
        $this->loginPage->login($email, $password);
    }
}
