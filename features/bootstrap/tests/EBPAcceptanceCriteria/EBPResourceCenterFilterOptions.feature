@EBP
Feature: Evidence-Based Practices Resource Center Display content
  In order to verify the presence of content of the EBP Resource Page
  As a regular user
  I need to use the step definitions of this context

  Background:
    Given The user is on the "EBP Resource Center page"

  Scenario:
    When The user expands on the "Topic Area" filter from the EBP filter section
    Then The "Topic Area" filter has the following options
    |Options|
    |- All -|
    |Opioid-Specific Resources|
    |Substance Use Prevention|
    |Substance Use Treatment & Recovery|

  Scenario:
    When The user expands on the "Target Audience" filter from the EBP filter section
    Then The "Target Audience" filter has the following options
      |Options|
      |- All -|
      |Care Providers|
      |Clinicians    |
      |Community Organizations|
      |Educators              |
      |Family and Caregivers  |
      |Patients               |
      |Policymakers           |
      |Prevention Professionals|
      |Program Planners and Administrators|
      |Public                             |


  Scenario:
    When The user expands on the "Populations" filter from the EBP filter section
    Then The "Populations" filter has the following options
      |Options|
      |- All -|
      |Adults|
      |Children    |
      |People in the Criminal Justice System|
      |Pregnant Women              |
      |Women                       |
      |Youth |



  Scenario:
    When The user expands on the "Resource Type" filter from the EBP filter section
    Then The "Resource Type" filter has the following options
      |Options|
      |- All -|
      |Evidence Review|
      |External Resource|
      |Fact Sheet       |
      |Guidance or Guideline|
      |Screening Tool       |
      |Toolkit              |

  Scenario:
    When The user expands on the "Resource Type" filter from the EBP filter section
    Then The "Resource Type" filter has the following options
      |Options|
      |- All -|
      |Evidence Review|
      |External Resource|
      |Fact Sheet       |
      |Guidance or Guideline|
      |Screening Tool       |
      |Toolkit              |

  Scenario:
    When The user expands on the "Sort by" filter from the EBP filter section
    Then The "Sort by" filter has the following options
      |Options|
      |Title A->Z|
      |Title Z->A|

  Scenario:
    When The user expands on the "Items per page" filter from the EBP filter section
    Then The "Items per page" filter has the following options
      |Options|
      |15|
      |25|
      |50|


  Scenario: OnSelect of Sort By drop down, page refreshes to show records in order by users choice.
    When The user selects the filter "Sort by" as "Title Z->A"
    And The users hits apply button
    Then The user sees the resource list is sorted by title in the descending order of alphabets


  Scenario Outline: On Select of Items per page drop down, the number of records change to users choice. Any filtered choices remain as part of the result set.
    When The user selects the filter "Items per page" as "<selection>"
    And The users hits apply button
    Then The total number of resources listed per page is <selection>
    Examples:
      |selection|
      |15|
      |25|
      |50|



  Scenario Outline: OnSelect of filter drop down, the resource list changes to users choice. Any other filtered choices remain as part of the result set.
    When The user selects the following set of filter criteria for "EBP resources"
      |Topic Area               |Populations|Target Audience          |Resource Type  |
      |<Topic Area>|<Populations>|<Target Audience>|<Resource Type>|
    And The users hits apply button
    Then The user sees either results for EBP resources or the text “Sorry, we could not find any resources that matched your search. Please try again.”
  Examples:
  |Topic Area               |Populations|Target Audience          |Resource Type  |
  |Opioid-Specific Resources|Children   |Prevention Professionals |Screening Tool |
  |Opioid-Specific Resources|Adults      |Prevention Professionals |    External Resource   |
  |Opioid-Specific Resources|Youth       |Prevention Professionals | Fact Sheet       |
  |                         |Children   |Prevention Professionals |  Fact Sheet     |