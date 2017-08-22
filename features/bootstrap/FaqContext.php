<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class FaqContext extends RawMinkContext
{
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
     * @When /^I click on "([^"]*)"$/
     */
    public function iClickOn($arg1)
    {
        $this->getSession()->getPage()->findLink($arg1)->click();
    }

    /**
     * @Then /^I should see help questions regarding Application$/
     */
    public function iShouldSeeHelpQuestionsRegardingApplication()
    {
        
        $items = array_map(
            function ($element) {
                $element->click();
                return $element->getText();
            },
            $this->getSession()->getPage()->findAll('css', 'a[id^="t4n"]')

        );

        print_r($items);

        if($items == null)
        {
            throw new Exception("No Questions found. note: it is not working for goutte, working with selenium");
        }

        $items1 = array_map(function ($element){ return $element->getText(); }, $this->getSession()->getPage()->findAll('css', '.field-item.even>p'));

        print_r($items1);

        if($items1 == null)
        {
            throw new Exception("No Questions found.");
        }


    }

    /**
     * @Given /^I am on Homepage$/
     */
    public function iAmOnHomepage()
    {
        throw new PendingException();
    }

}
