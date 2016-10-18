Feature: Authentication
  In order to see a list of books
  As a user
  I need to be able to login and logout

  Scenario: Login and logout
    Given I am on "/"
    And I fill in "Username" with "diar+3@gmail.com"
    And I fill in "Password" with "diar333"
    And I press "Submit"
    Then the "h1" should contain "Hello there, diar"