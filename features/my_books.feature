Feature: List my books
  In order to see my books that i added
  As a web user
  I need to se the list of the books

  Scenario: List my books
    Given I am logged in as "Diar+3@gmail.com"
    And I am on "/books/added"
    Then I should see "Your books"