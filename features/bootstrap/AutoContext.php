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
class AutoContext extends RawMinkContext
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
    }

    /**
     * @When /^I fill keyword \'([^\']*)\'$/
     */
    public function iFillKeyword($arg1)
    {
        $Page = $this->getSession()->getPage();
        $Page->find("xpath", "//input[@id='lst-ib']")->setValue($arg1);

        // Set up implicit timeouts
        $driver = $this->getSession()->getDriver()->getWebDriverSession();
        $driver->timeouts()->implicit_wait(array("ms" => 10000));
     }

    /**
     * @Given /^select suggestion \'([^\']*)\'$/
     */
    public function selectSuggestion($arg1)
    {
        $Page = $this->getSession()->getPage();
        $Sel = $Page->find("xpath", "//ul[@class='sbsb_b']");
        $Sugg = $Sel->findAll("xpath", "//li//div[@class='sbqs_c']");
        foreach ($Sugg as $key) {
        sleep(3);

            if ($key->getText()==$arg1) {
                $key->click();
                break;
            }

                }        
    }

    /**
     * @When /^I click on "([^"]*)" link$/
     */
    public function iClickOnLink($arg1)
    {
        
        $Page = $this->getSession()->getPage();
        $Page->find("xpath", "//a[@href='".$arg1."']")->click();
    }

    /**
     * @Then /^I can see behat documentation$/
     */
    public function iCanSeeBehatDocumentation()
    {
        $Page = $this->getSession()->getPage();
        $Title = $Page->find("css", "title")->getText();
        $String = "Behat — a php framework for autotesting your business expectations.";
        if($Title==$String)
            return("true");
        
    }
}
