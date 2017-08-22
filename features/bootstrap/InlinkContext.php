<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

use Behat\MinkExtension\Context\MinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class InlinkContext extends MinkContext
{
    private $BaseUrl;

    public function __construct($BaseUrl) {
        $this->BaseUrl = $BaseUrl;
    }

    /**
     * @Given /^I am on Home page$/
     */
    public function iAmOnHomePage()
    {
        $Session = $this->getSession();
        $Session->visit($this->BaseUrl['base_url']);

    }

    /**
     * @When /^I click on all inlinks one by one$/
     */
    public function iClickOnAllInlinksOneByOne()
    {
        $Page = $this->getSession()->getPage();
        
        $About = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(2)>a');
        $About->click();


        $Objectives = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(3)>a');
        $Objectives->click();


        $Categories = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(4)>a');
        $Categories->click();


        $EvaluationProcess = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(5)>a');
        $EvaluationProcess->click();


        $Contact = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(9)>a');
        $Contact->click();

        if($About == null || $Objectives == null || $Categories == null || $EvaluationProcess == null || $Contact == null)
        {
            throw new Exception("Element not found.");
        }

    }

    /**
     * @Then /^I should see redirection of each inlink$/
     */
    public function iShouldSeeRedirectionOfEachInlink()
    {
        $Page = $this->getSession()->getPage();
        // $About = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(2)>a')->getText();
        $Objectives = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(3)>a')->getText();
        $Categories = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(4)>a')->getText();
        $EvaluationProcess = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(5)>a')->getText();
        $Contact = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(9)>a')->getText();
        if(!strcmp($Objectives, 'OBJECTIVES') || !strcmp($Categories, 'THE THEMATIC GRANT CATEGORIES') || !strcmp($EvaluationProcess, 'EVALUATION PROCESS') || !strcmp($Contact, 'CONTACT US')) 
        {
            throw new PendingException("Invalid");    
        }
        // else
        // {
        //     echo $Objectives, "\n", $Categories, "\n", $EvaluationProcess, "\n", $Contact;
        // }
    }

    /**
     * @When /^I click on all links one by one$/
     */
    public function iClickOnAllLinksOneByOne()
    {
        $Page = $this->getSession()->getPage();
        $Gallary = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(6)>a');
        $Gallary->click();


        $Apply = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(7)>a');
        $Apply->click();

        // $this->getSession()->wait(5000);

        $Faqs = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(8)>a');
        $Faqs->click();

        // $this->getSession()->wait(5000);

        if($Gallary == null || $Apply == null || $Faqs == null)
        {
            throw new Exception("Element not found.");
        }
    }

    /**
     * @Then /^I should see redirection to respective page$/
     */
    public function iShouldSeeRedirectionToRespectivePage()
    {
        $Page = $this->getSession()->getPage();
        $Gallary = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(6)>a');
        $Gallary->click();

        $gallary1 = $this->getSession()->getCurrentUrl();

        $Apply = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(7)>a');
        $Apply->click();

        // $this->getSession()->wait(5000);

        $apply1 = $this->getSession()->getCurrentUrl();

        $Faqs = $Page->find('css', '.nav.navbar-nav>li:nth-of-type(8)>a');
        $Faqs->click();        

        // $this->getSession()->wait(5000);

        $faqs1 = $this->getSession()->getCurrentUrl();        

        if($gallary1 !== 'http://hclgrant.hcltech.com/gallery' || $apply1 !== 'http://hclgrant.hcltech.com/#Apply' || $faqs1 !== 'http://hclgrant.hcltech.com/faq')
        {
            throw new PendingException("Link not working");    
        }
        else
        {
            echo $gallary1, "\n", $apply1, "\n", "$faqs1";
        }

    }

    
}
