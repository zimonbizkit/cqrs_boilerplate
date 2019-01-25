<?php

use Behat\Behat\Context\ClosuredContextInterface,
    Behat\Behat\Context\TranslatedContextInterface,
    Behat\Behat\Context\BehatContext,
    Behat\Behat\Exception\PendingException;
use Behat\Gherkin\Node\PyStringNode,
    Behat\Gherkin\Node\TableNode;

//
// Require 3rd-party libraries here:
//
//   require_once 'PHPUnit/Autoload.php';
//   require_once 'PHPUnit/Framework/Assert/Functions.php';
//

/**
 * Features context.
 */
class FeatureContext extends BehatContext
{

    private $output;
    /**
     * Initializes context.
     * Every scenario gets its own context object.
     *
     * @param array $parameters context parameters (set them up through behat.yml)
     */
    public function __construct(array $parameters)
    {
        // Initialize your context here
    }

    /**
     * @When /^I execute the symfony command "([^"]*)" with email "([^"]*)"$/
     */
    public function iExecuteTheSymfonyCommandWithEmail($commandName, $email)
    {
        $this->output = shell_exec("bin/console $commandName $email");
    }

    /**
     * @Then /^the output of the command should have in its output the following string:$/
     */
    public function theOutputOfTheCommandShouldHaveInItsOutputTheFollowingString(PyStringNode $string)
    {
        \Webmozart\Assert\Assert::contains($this->output,$string->getRaw());
    }

    /**
     * @Then /^the exact output for the command should be:$/
     */
    public function theExactOutputForTheCommandShouldBe(PyStringNode $string)
    {
        \Webmozart\Assert\Assert::eq(trim($this->output),trim($string->getRaw()));
    }

    /**
     * @Given /^the user with email "([^"]*)" will be persisted in the read model$/
     */
    public function theUserWithEmailWillBePersistedInTheReadModel($mail)
    {

        \Webmozart\Assert\Assert::string(strstr(file_get_contents('./_filestore__userdata'),$mail));
    }

//
// Place your definition and hook methods here:
//
//    /**
//     * @Given /^I have done something with "([^"]*)"$/
//     */
//    public function iHaveDoneSomethingWith($argument)
//    {
//        doSomethingWith($argument);
//    }
//
}
