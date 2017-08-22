<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Event\SuiteEvent,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;
use Behat\vendor\phpmailer\phpmailer\PHPMailerAutoload;

// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';
// require_once 'Behat\vendor\phpmailer\phpmailer\PHPMailerAutoload.php';
// include("class.phpmailer.php");
// include("class.smtp.php");


class LogContext extends RawMinkContext
{
    private $Url;

    public function __construct($BaseUrl) {
        $this->Url = $BaseUrl;
    }

    /**
     * @Given /^I am on page "([^"]*)"$/
     */
    public function iAmOnPage($arg1)
    {
        $Session = $this->getSession();
        $Session->visit($this->Url.$arg1);
        $this->getSession()->resizeWindow(1366, 768, 'current');
    }

    /**
     * @When /^I fill username "([^"]*)"$/
     */
    public function iFillUsername($arg1)
    {
        $Page = $this->getSession()->getPage();
        $Page->find('css', '#edit-name')->setValue($arg1);
    }

    /**
     * @Given /^I fill password "([^"]*)"$/
     */
    public function iFillPassword($arg1)
    {
        $Page = $this->getSession()->getPage();
        $Page->find('css', '#edit-pass')->setValue($arg1);
    }

    /**
     * @Given /^I click on button "([^"]*)"$/
     */
    public function iClickOnButton($arg1)
    {
        $this->getSession()->executeScript("window.scrollTo(0,200)");
        $Page = $this->getSession()->getPage();
        $Page->find('css', '#edit-submit')->press();
    }

    /**
     * @Then I should see first page
     */
    public function iShouldSeeFirstPage()
    {
        $CurrentUrl = $this->getSession()->getCurrentUrl();
        assert($CurrentUrl=="http://hclstg.sites.innoraft.com/user/299398/edit");
    }

    /**
     * @Then /^I should see validation$/
     */
    public function iShouldSeeValidation()
    {
        $Page = $this->getSession()->getPage();
        $Error = $Page->find('css', 'div.alert.alert-block.alert-danger.messages.error > h4')->getText();
        // echo $Error;
        echo $Page->find('css', 'div.alert.alert-block.alert-danger.messages.error')->getText();
        assert($Error=="Error message");
    }

    /** @AfterFeature */
    public static function teardownFeature()
    {
        $msg = "First line of text\nSecond line of text";

        $mail = new PHPMailer();  // create a new object
        $body = file_get_contents('C:\Behat\report\index.html');
        $mail->Subject = "Report";
        $mail->AddAddress("charu.jain@innoraft.com");
        $mail->MsgHTML($body);
        if(!$mail->Send()) {
            $error = 'Mail error: '.$mail->ErrorInfo;
            return false;
        } else {
            $error = 'Message sent!';
            return true;
        }
        echo "Report has been sent!";
    }
}
