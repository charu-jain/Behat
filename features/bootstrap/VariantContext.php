<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class VariantContext extends RawMinkContext
{
    private $BaseUrl;

    public function __construct($BaseUrl) {
        $this->BaseUrl = $BaseUrl;
    }

    /**
     * @Given /^I am on Model overview page$/
     */
    public function iAmOnModelOverviewPage()
    {
        $Session = $this->getSession();
        $Session->visit($this->BaseUrl['base_url']);
    }

    /**
     * @Given /^session city is Delhi$/
     */
    public function sessionCityIsDelhi()
    {
        $city = $this->getSession()->getPage()->find('css', '.change-city-icon')->getText();
        if($city == 'Delhi')
        {
            echo "Session City is ", $city, "\n";
        } else { echo "Default session city not found."; }
     }


    /**
     * @When /^I scroll to variant section$/
     */
    public function iScrollToVariantSection()
    {

        $section = $this->getSession()->getPage()->find('css', '#brandsDiv');

        //Not supported by goutte
        // $section->mouseOver();
        // if($section !== null)
        // {
        //     echo "Element is visible";
        // } else { echo "Element is not visible"; }
        
        //Not supported by goutte
        // $this->getSession()->wait(5000);
    }

    /**
     * @Then /^I should see price of variant$/
     */
    public function iShouldSeePriceOfVariant()
    {        
        echo "Price of variant ", $var1=$this->getSession()->getPage()->find('css', '.s-heading.m-btm-15>a')->getText(), " is ",  $price1=$this->getSession()->getPage()->find('css', '#price_pulsar-150-ns-std')->getText();

        $escapedValue = $this->getSession()->getSelectorsHandler()->xpathLiteral('Bajaj Pulsar 150');

        echo "\nPrice of variant", $var2=$this->getSession()->getPage()->find('named', array('link', $escapedValue))->getText(), " is ",  $price2=$this->getSession()->getPage()->find('css', '#price_pulsar-dtsi')->getText(), "\n";

        if($var1 !== 'Bajaj Pulsar 150 NS' && $var2 !== 'Bajaj Pulsar 150')
        {
            throw new PendingException('Variant mismatch'); 
            if($price1 != '77, 595' || $price2 !== '81, 623')
            {
                throw new PendingException('Price mismatch');
            }
        }
        
    }


    /**
     * @Given /^I am on Model price page$/
     */
    public function iAmOnModelPricePage() 
    {
        $this->getSession()->visit($this->BaseUrl['base_url']);
        $this->getSession()->getPage()->find('css', '#orpUrl')->click();
    }
        
    /**
     * @Given /^session city is Delhi on page$/
     */
    public function sessionCityIsDelhiOnPage()
    {
        $escapedValue = $this->getSession()->getSelectorsHandler()->xpathLiteral('Delhi');
        $element = $this->getSession()->getPage()->find('named', array('option', $escapedValue));
        $city = $element->getText();
        if($city == 'Delhi')
        {
            echo "Session City is ", $city, "\n";
        } else { echo "Default session city not found."; }
    }


    /**
     * @When /^I see prices of variant at price breakup table$/
     */
    public function iSeePricesOfVariantAtPriceBreakupTable()
    {
        echo "Price of variant ", $var1=$this->getSession()->getPage()->find('css', '.font18.variantcenter>a')->getText(), " is ",  $price1=$this->getSession()->getPage()->find('css', '#modelonroad')->getText(), "\n";
    }

    /**
     * @Then /^I should see same price of variant at model overview page$/
     */
    public function iShouldSeeSamePriceOfVariantAtModelOverviewPage()
    {
        $price1=$this->getSession()->getPage()->find('css', '#modelonroad')->getText();
        $url1 = $this->getSession()->visit($this->BaseUrl['base_url']);
        $price2 = $this->getSession()->getPage()->find('css', '#price_pulsar-dtsi')->getText();

        if($price1 != $price2)
        {
           throw new PendingException("Prices mismatch"); 
        } else { echo "Price @ price page:", $price1, " & ", "Price @ overview page:", $price2, "\n"; }
        
    }
}
