<?php

use Behat\Behat\Context\BehatContext;

class YouContext extends BehatContext
{
    /**
     * @Then /^I can access YouContext step definition$/
     */
    public function iCanAccessYouContextStepDefinition()
    {
        return true;
    }
}

