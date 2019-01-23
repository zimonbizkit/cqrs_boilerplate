Business Need: Given a technical test
  as a potential employee
  I would like to check that my command goes over behat so they can see I can use it

  Scenario: Basic test
    When I execute the symfony command "user:subscribe" with email "blabla@oh.com"
    Then the output of the command should have in its output the following string:
    """
    email blabla@oh.com created
    """