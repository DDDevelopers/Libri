Feature: Authentication
  In order to see a list of books
  As a user
  I need to be able to login and logout


  Scenario: Login and logout
    Given I am on "/login"
    And I fill in "Username" with "diar+4@gmail.com"
    And I fill in "Password" with "diar123"
    And I press "Submit"
    And I should be login as "diar+4@gmail.com"