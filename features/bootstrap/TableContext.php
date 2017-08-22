<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class TableContext extends RawMinkContext
{
    private $BaseUrl;

    public function __construct($BaseUrl) {
        $this->BaseUrl = $BaseUrl;
    }

     /**
     * @Given /^the following people exist:$/
     */
    public function theFollowingPeopleExist(TableNode $table)
    {
        $hash = $table->getHash();
        foreach ($hash as $row) 
        {   
            echo $row['username'], " ", $row['pass'], "\n";
        }
        
    }

    /**
     * @When /^I open table$/
     */
    public function iOpenTable()
    {
   
        $table = new TableNode();
        $hash = $table->getHash();
        foreach ($hash as $row) 
        {   
            echo $row['username'], " ", $row['pass'], "\n";
        }
    }

    /**
     * @Then /^I should see table data$/
     */
    public function iShouldSeeTableData()
    {
        $table = new TableNode();
        $hash = $table->getHash();
        foreach ($hash as $row) 
        {
            if($hash == ""||0||Null)
            {
            throw new PendingException("invalid");
            }
        }
    }

}