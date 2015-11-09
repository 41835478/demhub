<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\Context;
use Behat\Behat\Context\SnippetAcceptingContext;
use Behat\Gherkin\Node\PyStringNode;
use Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\MinkContext;
use Laracasts\Behat\Context\Migrator;
use Laracasts\Behat\Context\DatabaseTransactions;
use PHPUnit_Framework_Assert as PHPUnit;

/**
 * Defines application features from the specific context.
 */
class FeatureContext extends MinkContext implements Context, SnippetAcceptingContext
{
    use Migrator, DatabaseTransactions;

    /**
     * Initializes context.
     *
     * Every scenario gets its own context instance.
     * You can also pass arbitrary arguments to the
     * context constructor through behat.yml.
     */
    public function __construct()
    {
    }

    /**
     * @Given I am not a registered user
     */
    public function iAmNotARegisteredUser()
    {
        PHPUnit::assertFalse(Auth::check());
    }

    /**
     * @Given I am a registered user
     */
    public function iAmARegisteredUser()
    {
        PHPUnit::assertTrue(Auth::check());
    }

    /**
     * @Given I am not logged in
     */
    public function iAmNotLoggedIn()
    {
        PHPUnit::assertFalse(Auth::check());
    }

    /**
     * @When I wait :seconds second(s)
     */
    public function iWaitSecond($seconds)
    {
      $this->getSession()->wait(1000);
    }
}
