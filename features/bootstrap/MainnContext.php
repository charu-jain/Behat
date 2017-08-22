<?php

use Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;
use Behat\MinkExtension\Context\RawMinkContext;

use Behat\MinkExtension\Context\MinkContext;


// require_once 'PHPUnit/Autoload.php';
// require_once 'PHPUnit/Framework/Assert/Functions.php';

class MainnContext extends MinkContext
{

    const SAY_HELLO = 'Hello';

    private $container;

    public function __construct()
    {
        $this->useContext('you_context', new YouContext());
        $this->useContext('me_context', new MeContext());
    }

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }

    public function sayHello()
    {
        return self::SAY_HELLO;
    }

}
