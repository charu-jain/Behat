<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

use Behat\MinkExtension\Context\MinkContext;
use Behat\Behat\Context\Step;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class MainContext extends MinkContext
{
    private $Cucumbers;
    private $EatCucumbers;
    private $LeftCucumber;
    
    public function __construct(array $parameters)
    {
        // Initialize your context here
        // ...
        $this->useContext('SubContext', new SubContext($parameters));
    }

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

        $this->getMainContext()->getSubContext('SubContext')->iShouldHaveCucumber($arg1);
        // echo 'I should have', " ", $this->LeftCucumber = $this->Cucumbers - $this->EatCucumbers, " ", 'cucumber';
        // if($this->LeftCucumber != $arg1)
        // {
        //     throw new Exception("Error Processing Request", 1);
            
        // }
    }



}