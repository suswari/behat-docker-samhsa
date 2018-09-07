@smokeTests@SearchProgramsAndCampaigns
Feature: SAMHSA smoke test scenarios

  Scenario Outline: Search programs and campaigns
    Given The user access "Programs & Campaigns page"
    When The user searches for Programs & Campaigns page using Keyword:"<Keyword>" Type:"<Type>" Topic:"<Topic>"
    Then The Programs & Campaigns page search results shows "<Icon>" icon
    Then The Programs & Campaigns page search results shows "<Title>" title & short summary block

    Examples:
      |Keyword                                                         |Type         |Topic                                   |Icon   |Title|
      |Interdepartmental Serious Mental Illness Coordinating Committee |Campaigns    |  Mental and Substance Use Disorders    |ISMICC |Interdepartmental Serious Mental Illness Coordinating Committee|
      |(MAT)                                                           |             |                                        |medication-assisted-treatment|Medication-Assisted Treatment (MAT)     |
      |EBP                                                             |             |                                        |ebp-resource-center|EBP Resource Center                               |
      |EBP                                                             |             |                                        |ebp-web-guide      |EBP Web Guide                                     |

