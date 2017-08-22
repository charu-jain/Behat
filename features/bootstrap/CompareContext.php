<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class CompareContext extends RawMinkContext
{
    private $BaseUrl;
    private $url1 = array('http://dev.upf.sites.capitalnumbers.com:83/', 
'http://dev.upf.sites.capitalnumbers.com:83/profitable-franchises-brand-power', 
'http://dev.upf.sites.capitalnumbers.com:83/about-the-ups-store-franchise', 
'http://dev.upf.sites.capitalnumbers.com:83/contact-ups-franchise', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-franchise-information-FAQ', 
'http://dev.upf.sites.capitalnumbers.com:83/owning-and-opening-a-ups-store', 
'http://dev.upf.sites.capitalnumbers.com:83/what-is-a-franchise-opportunity', 
'http://dev.upf.sites.capitalnumbers.com:83/franchise-training', 
'http://dev.upf.sites.capitalnumbers.com:83/franchise-benefits', 
'http://dev.upf.sites.capitalnumbers.com:83/national-marketing-programs', 
'http://dev.upf.sites.capitalnumbers.com:83/financing-and-franchise-loan', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-franchise-cost', 
'http://dev.upf.sites.capitalnumbers.com:83/buying-a-franchise-approval-process', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-franchise-info', 
'http://dev.upf.sites.capitalnumbers.com:83/franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/business-service-franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/shipping-franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/minority-franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/veteran-franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/women-franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/retiree-franchise-opportunities', 
'http://dev.upf.sites.capitalnumbers.com:83/rural-market-low-cost-franchises', 
'http://dev.upf.sites.capitalnumbers.com:83/open-a-ups-store-nontraditional-center', 
'http://dev.upf.sites.capitalnumbers.com:83/events-ups-franchises', 
'http://dev.upf.sites.capitalnumbers.com:83/franchise-events', 
'http://dev.upf.sites.capitalnumbers.com:83/franchise-webinars', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-store-franchises-featured-markets', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-franchise-profitability-testimonials', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-store-franchise-reviews', 
'http://dev.upf.sites.capitalnumbers.com:83/run-a-franchise-case-studies', 
'http://dev.upf.sites.capitalnumbers.com:83/real-estate-ups-franchise-opportunity', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-store-franchise-information-specs', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-franchise-information-site-selection', 
'http://dev.upf.sites.capitalnumbers.com:83/about-the-ups-store-franchise', 
'http://dev.upf.sites.capitalnumbers.com:83/contact-ups-franchise', 
'http://dev.upf.sites.capitalnumbers.com:83/ups-franchise-information-FAQ', 
'http://dev.upf.sites.capitalnumbers.com:83/privacy-policy', 
'http://dev.upf.sites.capitalnumbers.com:83/ca-privacy-policy', 
'http://dev.upf.sites.capitalnumbers.com:83/terms-and-conditions', 
'http://dev.upf.sites.capitalnumbers.com:83/blog');

private $url2 = array('https://theupsstorefranchise.com/', 
'https://theupsstorefranchise.com/profitable-franchises-brand-power', 
'https://theupsstorefranchise.com/about-the-ups-store-franchise', 
'https://theupsstorefranchise.com/contact-ups-franchise', 
'https://theupsstorefranchise.com/ups-franchise-information-FAQ', 
'https://theupsstorefranchise.com/owning-and-opening-a-ups-store', 
'https://theupsstorefranchise.com/what-is-a-franchise-opportunity', 
'https://theupsstorefranchise.com/franchise-training', 
'https://theupsstorefranchise.com/franchise-benefits', 
'https://theupsstorefranchise.com/national-marketing-programs', 
'https://theupsstorefranchise.com/financing-and-franchise-loan', 
'https://theupsstorefranchise.com/ups-franchise-cost', 
'https://theupsstorefranchise.com/buying-a-franchise-approval-process', 
'https://theupsstorefranchise.com/ups-franchise-info', 
'https://theupsstorefranchise.com/franchise-opportunities', 
'https://theupsstorefranchise.com/business-service-franchise-opportunities', 
'https://theupsstorefranchise.com/shipping-franchise-opportunities', 
'https://theupsstorefranchise.com/minority-franchise-opportunities', 
'https://theupsstorefranchise.com/veteran-franchise-opportunities', 
'https://theupsstorefranchise.com/women-franchise-opportunities', 
'https://theupsstorefranchise.com/retiree-franchise-opportunities', 
'https://theupsstorefranchise.com/rural-market-low-cost-franchises', 
'https://theupsstorefranchise.com/open-a-ups-store-nontraditional-center', 
'https://theupsstorefranchise.com/events-ups-franchises', 
'https://theupsstorefranchise.com/franchise-events', 
'https://theupsstorefranchise.com/franchise-webinars', 
'https://theupsstorefranchise.com/ups-store-franchises-featured-markets', 
'https://theupsstorefranchise.com/ups-franchise-profitability-testimonials', 
'https://theupsstorefranchise.com/ups-store-franchise-reviews', 
'https://theupsstorefranchise.com/run-a-franchise-case-studies', 
'https://theupsstorefranchise.com/real-estate-ups-franchise-opportunity', 
'https://theupsstorefranchise.com/ups-store-franchise-information-specs', 
'https://theupsstorefranchise.com/ups-franchise-information-site-selection', 
'https://theupsstorefranchise.com/about-the-ups-store-franchise', 
'https://theupsstorefranchise.com/contact-ups-franchise', 
'https://theupsstorefranchise.com/ups-franchise-information-FAQ', 
'https://theupsstorefranchise.com/privacy-policy', 
'https://theupsstorefranchise.com/ca-privacy-policy', 
'https://theupsstorefranchise.com/terms-and-conditions', 
'https://theupsstorefranchise.com/blog');

    public function __construct($BaseUrl) {
        $this->BaseUrl = $BaseUrl;
    }


     /**
     * @Given /^I am on copyscape$/
     */
    public function iAmOnCopyscape()
    {
        $Session = $this->getSession();
        $Session->visit($this->BaseUrl['base_url']);

    }

    /**
     * @When /^I put url(\d+) & url(\d+)$/
     */
    public function iPutUrlUrl($arg1, $arg2)
    {        
        foreach(array_combine($this->url1, $this->url2) as $u1 => $u2) 
        {
          
            $Item1 = $this->getSession()->getPage()->find('css', 'input[name=url1]');
            //$Item1->isVisible();
            $Item2 = $this->getSession()->getPage()->find('css', 'input[name=url2]');
            //$Item2->isVisible();

            $Item1->setValue($u1);
            $Item2->setValue($u2);
            // echo $tuple[0], "\n"; // name
            // echo $tuple[1], "\n"; // type

            $button = $this->getSession()->getPage()->find('css', 'input[name=docompare]');
            $button->click();

            $this->getSession()->wait(7000);

            $this->getSession()->getPage()->findlink("Perform another comparison...")->click();
        }

    }

    /**
     * @Given /^click on comapre button$/
     */
    public function clickOnComapreButton()
    {
        // $button = $this->getSession()->getPage()->find('css', 'input[name=docompare]');
        // $button->click();
        if(empty($this->getSession()))
        {
            throw new PendingException("Not found");    
        }
        
    }

    /**
     * @Then /^I can see data comparison of both webpages$/
     */
    public function iCanSeeDataComparisonOfBothWebpages()
    {
        
        // $result1 = $this->getSession()->getPage()->find('css', 'td.section.matchwidth>p')->getText();
        // echo $result1;

        // $this->getSession()->getPage()->find('css', '.doublegap')->click();

        if(empty($result1))
        {
            throw new PendingException("No result found.");
        }
    }
}
