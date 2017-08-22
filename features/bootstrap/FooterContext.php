<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class FooterContext extends RawMinkContext
{
    private $BaseUrl, $Footer, $i;

    public function __construct($BaseUrl) {
        $this->BaseUrl = $BaseUrl;
    }


    /**
     * @Given /^I am on Homepage$/
     */
    public function iAmOnHomepage()
    {
        $Session = $this->getSession();
        $Session->visit($this->BaseUrl['base_url']);

    }

    /**
     * @When /^I am at footer$/
     */
    public function iAmAtFooter()
    {
        $this->Footer = $this->getSession()->getPage()->find('css', '.footer');
    }

    /**
     * @Then /^I can see all social site links$/
     */
    public function iCanSeeAllSocialSiteLinks()
    {
        $arr = array($this->getSession()->getPage()->find('css', '.fb'),
                    $this->getSession()->getPage()->find('css', '.twitter'),
                    $this->getSession()->getPage()->find('css', '.gl'),
                    $this->getSession()->getPage()->find('css', '.tum'));
        foreach($arr as $value)
        {
            $value->click();
            echo $urls = $this->getSession()->getCurrentUrl(), "\n";            
            $this->getSession()->back();
            if(empty($urls))
            {
                throw new PendingException("Links not working.");    
            }
        }

        // $FB = $this->getSession()->getPage()->find('css', '.fb');
        // $FB->click();
        // echo $FbUrl = $this->getSession()->getCurrentUrl(), "\n";
        
        // $this->getSession()->back();

        // $TwittrUrl = $this->getSession()->getPage()->find('css', '.twitter');
        // $TwittrUrl->click();
        // echo $TwittrUrl = $this->getSession()->getCurrentUrl(), "\n";

        // $this->getSession()->back();

        // $Gplus = $this->getSession()->getPage()->find('css', '.gl');
        // $Gplus->click();
        // echo $Gplus = $this->getSession()->getCurrentUrl(), "\n";

        // $this->getSession()->back();

        // $YouTube = $this->getSession()->getPage()->find('css', '.tum');
        // $YouTube->click();
        // echo $YouTube = $this->getSession()->getCurrentUrl(), "\n";

        // if(empty($FbUrl) || empty($TwittrUrl) || empty($Gplus) || empty($YouTube))
        // {
        //     throw new PendingException("Links not working.");    
        // }
        
    }

    /**
     * @Then /^I can see copyright info$/
     */
    public function iCanSeeCopyrightInfo()
    {
        echo $copy = $this->getSession()->getPage()->find('css', '.footer>div.container>div.row>div.col-md-6>p')->getText(), "\n";
        if(empty($copy))
        {
            throw new PendingException("Copyright info found missing");    
        }
        
    }

    /**
     * @When /^I find all links$/
     */
    public function iFindAllLinks()
    {

        $arr = $this->getSession()->getPage()->findAll('css', 'a');
        $arr1 = array();
        foreach($arr as $values)
        {
            var_dump($values);
            if(empty($values))
            {
                throw new PendingException("Element not found.");
            }
            
            $values->click();

            echo $this->getSession()->getCurrentUrl(), "     ", "\n", $this->getSession()->getStatusCode(), "\n";

            $this->iFindAllLinks();
            $this->getSession()->back();
        }
        
        // foreach($arr as $value)
        // {   
        //     $value->click();
        //     echo $urls = $this->getSession()->getCurrentUrl(), "\n";            
        //     $this->getSession()->back();
        //     if(empty($urls))
        //     {
        //         throw new PendingException("Links not working.");    
        //     }
        // }

    }

    /**
     * @Then /^I can see all links info$/
     */
    public function iCanSeeAllLinksInfo()
    {
            $q = $this->getSession()->getCurrentUrl();
            if(empty($q))
            {
                throw new PendingException("empty");    
            }
                        
    }
}
