Feature: Search
  In order to see the list of books
  As a web user
  I need to be able to search books

  Background:
    Given I am on "/"

  Scenario Outline:
    When I fill in "Search" with "<term>"
    And I press "search_button"
    Then I should see "<result>"
    Examples:
      | term  | result |
      | Great | 1      |
      | test  | No     |