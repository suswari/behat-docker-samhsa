
@MindBreeze
Feature: Mind Breeze smoke test scenarios
  In order to smoke test mind breeze
  As a regular user
  I wanted to execute the following scenarios

  Scenario: searching terms form the header would lead to a search page
    Given The user access the following <pages> related to SAMHSA site
    When The users searches for <terms> using the search bar from the header
    Then The the user is taken to the search page


  Scenario: searching terms form the header would lead to a search page with appropriate results
    Given The user access the following <pages> related to SAMHSA site
    When The users searches for <terms> using the search bar from the header
    Then The the user is taken to the search page with results
    And The results contains atleast one occurence
