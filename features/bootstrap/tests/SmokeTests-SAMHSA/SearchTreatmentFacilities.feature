@smokeTests@SearchFacilities
Feature: SAMHSA smoke test scenarios
  In order to verify if the search list appear
  As a regular user
  I wanted search for some treatment facilities by different criteria

  Scenario Outline: Search treatment facilities
    Given The user access SAMHSA homesite
    When The user searches for treatment facilities with "<condition>"
    Then The user is directed to treatment locator page
    And The search list "<is seen>" accordingly
  Examples:
    |condition|is seen    |
    |22043    |true       |
    |&(@      |false      |
    |9300 Lee Highway|true|
    |Virgina         |true|

