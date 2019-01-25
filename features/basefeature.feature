Business Need: Given a technical test
  as a potential employee
  I would like to check that my command goes over behat so they can see I can use it

  Scenario: E2E shallow user subscription
    When I execute the symfony command "user:subscribe" with email "blabla@oh.com"
    Then the output of the command should have in its output the following string:
    """
    email blabla@oh.com created
    """
    And the user with email "blabla@oh.com" will be persisted in the read model

    Scenario: Error handling
    When I execute the symfony command "user:subscribe" with email "heywhatsup"
    Then the exact output for the command should be:
    """
    ERROR:Email address is not valid

    """

