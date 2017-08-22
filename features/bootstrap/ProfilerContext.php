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
class ProfilerContext extends RawMinkContext
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
     * @Given /^I am on page "([^"]*)"$/
     */
    public function iAmOnPage($arg1)
    {
        $Session = $this->getSession();
        echo $this->Url.$arg1;
        $Session->visit($this->Url.$arg1);
        $this->getSession()->resizeWindow(1366, 768, 'current');
    }

    /**
     * @Given /^I click on \'([^\']*)\'$/
     */
    public function iClickOn($arg1)
    {
        $this->getSession()->wait(1000, '(0 === jQuery.active)');
        $Page = $this->getSession()->getPage();
        $Page->findButton($arg1)->click();
    }

    /**
     * @Given /^I click on button \'([^\']*)\'$/
     */
    public function iClickOnButton($arg1)
    {

        //Scroll Automatically to the Bottom of the Page
        $this->getSession()->executeScript("window.scrollTo(0,document.body.scrollHeight)");
        $Page = $this->getSession()->getPage();
        $el = $Page->find("xpath", "//div[@class='buttons-group']/ul/li/a[text()='".$arg1."']");
//        echo $el->isVisible();
//        sleep(1);
        if(strcmp($arg1, "Get Started")){
            $el->click();
        }
        else{
            $Page->find("xpath", "//a[text()='Continue']")->click();
        }
    }

    /**
     * @Given /^I wait for text "([^"]*)"$/
    */
    public function iWaitForText($arg1)
    {
        $this->spin(function() use($arg1) {
            echo "spin here";
            return $this->getSession()->getPage()->find("xpath", "//h2[text()='".$arg1."']");
        });
    }

    /**
     * @Given /^I will answer the questions$/
     */
    public function iWillAnswerTheQuestions()
    {
        $Page = $this->getSession()->getPage();

            for($j=0; $j<12; $j++)
            {
                for ($i=1; $i<=5; $i++)
                {
                    $el1 = $Page->find("xpath", "//div[@class='container-box']/div[@class='question-cols ng-scope'][".$i."]");
//                    sleep(1);
                    $index = rand(1, 5);
                    $el2 = $el1->find("xpath", "ul/li[".$index."]/button");
                    echo " ".$el2->isVisible();
//                    sleep(1);
                    $el2->click();
                }
                echo " Page: $j completed \n";
            $this->getSession()->wait(1000);
            $el3 = $Page->find("xpath", "//a[text()='Next']");
            if (!is_null($el3)) {
                $el3->click();
            }
            else{
                break;
            }
            }
    }

    /**
     * @Then /^I submit form$/
     */
    public function iSubmitForm()
    {
        $el = $this->getSession()->getPage()->find("xpath", "//a[text()='Complete']");
        if (!is_null($el))
        {
            $el->click();
            echo "Test completed. ";
            $this->getSession()->wait(5000);
        }
        else{
           throw new PendingException("Unable to submit.");
        }
    }

    /**
     * @Given I logged in with username :arg1 and password :arg2
     */
    public function iLoggedInWithUsernamePassword($arg1, $arg2)
    {
        try {
        $Page = $this->getSession()->getPage();
        $Page->findButton('Register')->click();
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
        $this->getSession()->wait(1000, '(0 === jQuery.active)');
        $c = $Page->find("xpath", "//div[@class='navbar']/ul/li/a[@href='/#/career']");
        $this->getSession()->executeScript("$c.scrollIntoView()");
        $c->click();
        echo "on career page";
        //echo $this->getSession()->getCurrentUrl();
        $this->getSession()->wait(2000);
        //$this->getSession()->executeScript("window.scrollTo(0, 0);");
        $p = $Page->find("xpath", "//div[@class='nav-container']/ul/li/a[@href='/#/interest-profiler']");
        $this->getSession()->executeScript("$p.scrollIntoView()");
        $p->click();
        echo "on profiler page";
        $this->getSession()->wait(2000);
        } catch (Exception $e) {
            echo $e;
        }
    }
}
