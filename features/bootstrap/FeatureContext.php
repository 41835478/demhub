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
     * @Given I am a guest
     */
    public function iAmAGuest()
    {
        PHPUnit::assertFalse(Auth::check());
    }

    /**
     * @Given /^(?:|I )am on (?:|the )landing(?:| page)$/
     * @When /^(?:|I )go to (?:|the )landing(?:| page)$/
     */
    public function iAmOnLanding()
    {
        $this->visitPath('/');
    }

    /**
     * @When I register
     */
    public function iRegister()
    {
        // Check if user is in the registration page
        $this->assertSession()->addressEquals($this->locatePath("/auth/register"));
        // Fill in username
        $field = $this->fixStepArgument("Username");
        $value = $this->fixStepArgument("johndoe123");
        $this->getSession()->getPage()->fillField($field, $value);
        // Fill in email
        $field = $this->fixStepArgument("email");
        $value = $this->fixStepArgument("johndoe123@example.com");
        $this->getSession()->getPage()->fillField($field, $value);
        // Fill in password
        $field = $this->fixStepArgument("password");
        $value = $this->fixStepArgument("password123");
        $this->getSession()->getPage()->fillField($field, $value);
        // Fill in password confirmation
        $field = $this->fixStepArgument("password_confirmation");
        $value = $this->fixStepArgument("password123");
        $this->getSession()->getPage()->fillField($field, $value);
        // Click "Join"
        $link = $this->fixStepArgument("JOIN");
        $this->getSession()->getPage()->clickLink($link);
        // Check for modal
        $this->assertSession()->pageTextContains($this->fixStepArgument("We verify each member who signs up"));



        // Click "Continue"
        // $link = $this->fixStepArgument("CONTINUE");
        // $this->getSession()->getPage()->clickLink($link);

        $button = $this->getSession()->getPage()->findButton("CONTINUE");

        // If not found throw an exception
        if (null === $button) {
            throw new \InvalidArgumentException('Element not found');
        }

        // Otherwise click on it
        $button->click();





        // Fill in First Name
        $field = $this->fixStepArgument("first_name");
        $value = $this->fixStepArgument("John");
        $this->getSession()->getPage()->fillField($field, $value);
        // Fill in Last Name
        $field = $this->fixStepArgument("last_name");
        $value = $this->fixStepArgument("Doe");
        $this->getSession()->getPage()->fillField($field, $value);
        // Fill in Job Title
        $field = $this->fixStepArgument("job_title");
        $value = $this->fixStepArgument("Cool Job");
        $this->getSession()->getPage()->fillField($field, $value);
        // Fill in Organization/Agency Name
        $field = $this->fixStepArgument("organization_name");
        $value = $this->fixStepArgument("Cool Organization");
        $this->getSession()->getPage()->fillField($field, $value);
        // Click "Done"
        $link = $this->fixStepArgument("DONE");
        $this->getSession()->getPage()->pressButton($link);
    }
}
