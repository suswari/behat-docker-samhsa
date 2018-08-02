@smokeTests @refreshresults
Feature:SAMHSA smoke test scenarios
  In order to verify the the search result are refreshed everytime for a new search
  As a regular user
  I wanted to execute the following scenarios

Scenario Outline: OnSelect of filter drop down, the resource list changes to users choice. Any other filtered choices remain as part of the result set.
  Given The user is on the "EBP Resource Center page"
  When The user selects the following set of filter criteria for "EBP resources"
|Topic Area               |Populations|Target Audience          |Resource Type  |
|<Topic Area>|<Populations>|<Target Audience>|<Resource Type>|
And Perform a search
Then The user sees the results are refreshed everytime for a new search
Examples:
|Topic Area               |Populations|Target Audience          |Resource Type  |
|Opioid-Specific Resources|Children   |Prevention Professionals |Screening Tool |
|Opioid-Specific Resources|Adults      |Prevention Professionals |    External Resource   |
|                         |Children   |Prevention Professionals |  Fact Sheet     |