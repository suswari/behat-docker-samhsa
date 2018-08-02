@smokeTests@GrantAwards
Feature: SAMHSA smoke test scenarios
  In order to check every link listed in the sitemap responds with 200
  As a regular user
  I wanted to execute the following scenarios

  Scenario: breadcrumbs show up correct
    Given The user access "Grant awards by state page"
    Then The user sees the breadcrumb link for "SAMHSA Grant Awards By State" as main node
    And The user sees the breadcrumb link for "Grants" as parent nodes


  Scenario Outline: View Grant Awards By Fiscal Year and state
    Given The user access "Grant awards by state page"
    When The user views the grant awards for the following fiscal year and state
      |fiscal year  |state  |
      |<fiscal year>|<state>|
    Then The Grants summary page for the following state and year is seen
      |fiscal year  |state  |
      |<fiscal year>|<state>|
    And There are Grants summary blocks for "Formula Funding", "Discretionary Funding", "Total Funding"
    Examples:
    |fiscal year|state|
    |2016       |Tennessee|

  Scenario Outline: View Grant Discretionary Funds in Detail By Fiscal Year and state
    Given The user access "Grant awards by state page"
    When The user views the grant awards for the following fiscal year and state
      |fiscal year  |state  |
      |<fiscal year>|<state>|
    And From the summary page the user views Discretionary Funds in Detail
    Then The Grants Discretionary Funds page for the following state and year is seen
      |fiscal year  |state  |
      |<fiscal year>|<state>|
    And There are Grants details blocks
    Examples:
      |fiscal year|state|
      |2016       |Tennessee|

  Scenario Outline: View Grant Non-Discretionary Funds in Detail By Fiscal Year and state
    Given The user access "Grant awards by state page"
    When The user views the grant awards for the following fiscal year and state
      |fiscal year  |state  |
      |<fiscal year>|<state>|
    And From the summary page the user views Non-Discretionary Funds in Detail
    Then The Grants Non-Discretionary Funds page for the following state and year is seen
      |fiscal year  |state  |
      |<fiscal year>|<state>|
    And There are Grants details blocks
    Examples:
      |fiscal year|state|
      |2016       |Tennessee|