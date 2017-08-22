<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\RawMinkContext;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends RawMinkContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */

    private $BaseUrl;
    public function __construct($BaseUrl)
    {
        $this->BaseUrl = $BaseUrl;
    }

/**
     * @Given /^I am on page "([^"]*)"$/
     */
    public function iAmOnPage($arg1)
    {
        $Session = $this->getSession();
        $Session->visit($this->BaseUrl['base_url'] . $arg1);
        $Page = $this->getSession()->getPage();
        $Page->findButton("Sign In")->press();
    }


     /**
     * @When /^I fill username with \'([^\']*)\'$/
     */
    public function iFillUsernameWith($arg1)
    {
        $Page = $this->getSession()->getPage();
        //$Page->find('css', '#edit-name--2')->setValue($arg1);
        $Page->findField("Email Address")->setValue($arg1);
    }

    /**
     * @When /^I fill password with \'([^\']*)\'$/
     */
    public function iFillPasswordWith($arg1)
    {
        $Page = $this->getSession()->getPage();
       // $Page->find('css', '#edit-pass--2')->setValue($arg1);
        $Page->findField("Password")->setValue($arg1);
    }


    /**
     * @Then /^I can "([^"]*)"$/
     */
    public function iCan($arg1)
    {
        $Page = $this->getSession()->getPage();
        //$Page->find('css', '#edit-submit')->press();
        $Page->find("css", ".submit")->click();
        $CurrentUrl = $this->getSession()->getCurrentUrl();
        if(!$CurrentUrl = "http://hclgrant.hcltech.com/register-ngo")
        {
        throw new PendingException("Enter valid credentials");
        }
    }

    /**
     * @Then /^I cannot "([^"]*)"$/
     */
    public function iCannot($arg1)
    {

        $Page = $this->getSession()->getPage();
        //$Page->find('css', '#edit-submit')->press();
        $Page->find("css", ".submit")->click();
        $CurrentUrl = $this->getSession()->getCurrentUrl();
        if(!$CurrentUrl = "http://hclgrant.hcltech.com/register-ngo")
        {
        throw new PendingException("Enter valid credentials");
        }
        else
        {
        throw new PendingException("Error: Enter valid credentials");
        }

    }
}
