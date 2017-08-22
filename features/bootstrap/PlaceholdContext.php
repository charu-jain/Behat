<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class PlaceholdContext extends RawMinkContext
{
    private $Cucumbers;
    private $EatCucumbers;
    private $LeftCucumber;
    
    /**
     * @Given /^there are (\d+) cucumbers$/
     */
    public function thereAreCucumbers($arg1)
    {
        $this->Cucumbers = $arg1;
        
    }

    /**
     * @When /^I eat (\d+) cucumbers$/
     */
    public function iEatCucumbers($arg1)
    {
        $this->EatCucumbers = $arg1;
    }

    /**
     * @Then /^I should have (\d+) cucumbers$/
     */
    public function iShouldHaveCucumbers($arg1)
    {
        echo 'I should have', " ", $this->LeftCucumber = $this->Cucumbers - $this->EatCucumbers, " ", 'cucumber';
        if($this->LeftCucumber != $arg1)
        {
            throw new Exception("Error Processing Request", 1);
            
        }
    }

}