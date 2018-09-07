@smokeTests@MenubarOptions
Feature: SAMHSA smoke test scenarios
  To check if the Grant awards page for a certain year and state show up right headers and blocks
  As a regular user
  I wanted to execute the following scenarios

  Scenario Outline: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "Find Help & Treatment"
    Then Treatment help line for "<Option>" is seen
    Examples:
      |Option|
      |National Suicide Prevention Lifeline |
      |National Helpline          |
      |Disaster Distress Helpline |

  Scenario Outline: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "Grants"
    Then Grant option "<Option>" is seen
    Examples:
    |Option|
    |Fiscal Year 2018 Grant Announcements|
    |Applying for a New SAMHSA Grant     |
    |Grant Review Process                |
    |Continuation Grants                 |
    |Grants Management                   |
    |GPRA Measurement Tools              |
    |Contact Grants                      |
    |More Grants Information             |

  Scenario Outline: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "Programs & Campaigns"
    Then Programs & Campaign option "<Option>" is seen
    Examples:
      |Option|
      |Featured Campaign                                |
      |Popular Programs, Campaigns, & Initiatives                      |
      |Popular Technical Assistance & Resource Centers  |


  Scenario Outline: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "About Us"
    Then About Us option "<Option>" is seen
    Examples:
      |Option                     |
      |Who We Are                 |
      |Interagency Activities     |
      |Advisory Councils          |
      |Strategic Initiatives      |
      |Budget                     |
      |Speeches and presentations |
      |Jobs & Internships         |
      |Contact Us                 |