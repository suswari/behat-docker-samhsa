@smokeTests@AboutUs
Feature: SAMHSA smoke test scenarios

  Scenario: Search treatment facilities
    Given The user access "About us"
    Then The user sees there is a map frame pointing to SAMHSA address
    And The user sees the link "Get directions to SAMHSA"
    And The user sees the link "Contact SAMHSA"
