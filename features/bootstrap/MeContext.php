<?php

use Behat\Behat\Context\BehatContext;
use Behat\Behat\Exception\BehaviorException;

class MeContext extends BehatContext
{
    /**
     * @Then /^I can access MeContext step definition$/
     */
    public function iCanAccessMeContextStepDefinition()
    {
        return true;
    }

    /**
     * @Then /^I can access FeatureContext resources from MeContext$/
     */
    public function iCanAccessFeatureContextResourcesFromMeContext()
    {
        /** @var FeatureContext $mainContext */
        $mainContext = $this->getMainContext();

        if ($mainContext->sayHello() != $mainContext::SAY_HELLO) {
            throw new BehaviorException('Cannot access FeatureContext resources.');
        }
    }
}