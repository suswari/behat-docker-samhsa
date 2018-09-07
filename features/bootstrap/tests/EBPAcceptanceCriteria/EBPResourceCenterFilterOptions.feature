@EBPS
Feature: Evidence-Based Practices Resource Center Display content
  In order to verify the presence of content of the EBP Resource Page
  As a regular user
  I need to use the step definitions of this context

  Background:
    Given The user is on the "EBP Resource Center page"

  Scenario:
    When The user expands on the "Topic Area" filter from the EBP filter section
    Then The "Topic Area" filter has the options "- All -"
    Then The "Topic Area" filter has the options "Opioid-Specific Resources"
    Then The "Topic Area" filter has the options "Substance Use Prevention"
    Then The "Topic Area" filter has the options "Substance Use Treatment & Recovery"

  Scenario:
    When The user expands on the "Target Audience" filter from the EBP filter section
    Then The "Target Audience" filter has the options "- All -"
    Then The "Target Audience" filter has the options "Care Providers"
    Then The "Target Audience" filter has the options "Clinicians"
    Then The "Target Audience" filter has the options "Community Organizations"
    Then The "Target Audience" filter has the options "Educators"
    Then The "Target Audience" filter has the options "Family and Caregivers"
    Then The "Target Audience" filter has the options "Patients"
    Then The "Target Audience" filter has the options "Policymakers"
    Then The "Target Audience" filter has the options "Prevention Professionals"
    Then The "Target Audience" filter has the options "Program Planners and Administrators"
    Then The "Target Audience" filter has the options "Public"

  Scenario:
    When The user expands on the "Populations" filter from the EBP filter section
    Then The "Populations" filter has the options "- All -"
    Then The "Populations" filter has the options "Adults"
    Then The "Populations" filter has the options "Children"
    Then The "Populations" filter has the options "People in the Criminal Justice System"
    Then The "Populations" filter has the options "Pregnant Women"
    Then The "Populations" filter has the options "Women"
    Then The "Populations" filter has the options "Youth"

  Scenario:
    When The user expands on the "Resource Type" filter from the EBP filter section
    Then The "Resource Type" filter has the options "- All -"
    Then The "Resource Type" filter has the options "Evidence Review"
    Then The "Resource Type" filter has the options "External Resource"
    Then The "Resource Type" filter has the options "Fact Sheet"
    Then The "Resource Type" filter has the options "Guidance or Guideline"
    Then The "Resource Type" filter has the options "Screening Tool"
    Then The "Resource Type" filter has the options "Toolkit"

  Scenario:
    When The user expands on the "Sort by" filter from the EBP filter section
    Then The "Sort by" filter has the options "Title A->Z"
    Then The "Sort by" filter has the options "Title Z->A"


  Scenario:
    When The user expands on the "Items per page" filter from the EBP filter section
    Then The "Items per page" filter has the options "15"
    Then The "Items per page" filter has the options "25"
    Then The "Items per page" filter has the options "50"


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
    When The user selects the following set of filter criteria for EBP resources "<Topic Area>" "<Populations>" "<Target Audience>" "<Resource Type>"
    And The users hits apply button
    Then The user sees either results for EBP resources or the text “Sorry, we could not find any resources that matched your search. Please try again.”
  Examples:
  |Topic Area               |Populations|Target Audience          |Resource Type  |
  |Opioid-Specific Resources|Children   |Prevention Professionals |Screening Tool |
  |Opioid-Specific Resources|Adults      |Prevention Professionals |    External Resource   |
  |Opioid-Specific Resources|Youth       |Prevention Professionals | Fact Sheet       |
  |                         |Children   |Prevention Professionals |  Fact Sheet     |