<?php

use Behat\Behat\Tester\Exception\PendingException;
use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

use Behat\MinkExtension\Context\RawMinkContext;
use Behat\Mink\Driver\Selenium2Driver;

require_once 'PHPUnit/Autoload.php';
require_once 'PHPUnit/Framework/Assert/Functions.php';

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class CareerPlanContext extends elkan\BehatFormatter\Context\BehatFormatterContext
{
    /**
     * Initializes context.
     * Every scenario gets it's own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */

    private $Url;

    public function __construct($BaseUrl)
    {
        $this->Url = $BaseUrl;
    }

    /**
     * Based on Behat's own example
     * @see http://docs.behat.org/en/v2.5/cookbook/using_spin_functions.html#adding-a-timeout
     * @param $lambda
     * @param int $wait
     * @throws \Exception
     */
    public function spin ($lambda)
    {
        while (true)
        {
        try {
            if ($lambda($this)) {
                return true;
            }
        } catch (Exception $e) {
            // do nothing
        }

        sleep(10);
        }
    }



    /**
     * @Given I am on login page :arg1
     */
    public function iAmOnLoginPage($arg1)
    {
        $Session = $this->getSession();
        $Session->visit($this->Url.$arg1);
        $this->getSession()->resizeWindow(1366, 768, 'current');
    }

    /**
     * @Given I logged in with username :arg1 and password :arg2
     */
    public function iLoggedInWithUsernameAndPassword($arg1, $arg2)
    {
        $Page = $this->getSession()->getPage();
        $this->getSession()->wait(2000);
        $Page->findButton('Sign In')->click();
        $this->getSession()->wait(2000);
        $Page->find("xpath", "//input[@placeholder='Email Address']")->setValue($arg1);
        $Page->find("xpath", "//input[@placeholder='Password']")->setValue($arg2);
        echo "submit button";
        sleep(1);
        $el = $Page->find("css", "div.ng-scope div.signin-block div.button.submit");
        $this->getSession()->executeScript("window.scrollTo(0, 0);");
        $el->click();
    }

    /**
     * @Given I moved to Career search page
     */
    public function iMovedToCareerSearchPage()
    {
        $Page = $this->getSession()->getPage();
        $c = $Page->findLink("Career");
        // $c = $Page->find("xpath", "//div[@class='navbar']/ul/li/a[@href='/#/career']");
        $c->click();
        echo "\non career page\n";
        //echo $this->getSession()->getCurrentUrl();
        $this->getSession()->wait(2000);
        //$this->getSession()->executeScript("window.scrollTo(0, 0);");
        $p = $Page->find('named', array('link', 'Career Search Tool'));
        if($p->isVisible()==true)
        {
            echo "\nelement is visible\n";
            $p->click();
        }
        else
            echo "\nnot visible\n";
        echo "\non Career search\n";
        $this->getSession()->wait(2000);
    }

    /**
     * @Given I marked :arg1 as fav career
     */
    public function iMarkedAsFavCareer($arg1)
    {

    }

    /**
     * @Then I moved to :arg1 page
     */
    public function iMovedToPage($arg1)
    {
        throw new PendingException();
    }

    /**
     * @Then I waited for career list to appear
     */
    public function iWaitedForCareerListToAppear()
    {
        throw new PendingException();
    }

    /**
     * @Then I verified for marked career here
     */
    public function iVerifiedForMarkedCareerHere()
    {
        throw new PendingException();
    }
}
