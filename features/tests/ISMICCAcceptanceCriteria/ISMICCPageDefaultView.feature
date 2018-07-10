@ISMICC
Feature: ISMICC acceptance criteria
  In order to verify the presence of content on the ISMICC Page
  As a regular user
  I need to use the step definitions of this context

  Scenario Outline: User finds the Interdepartmental Serious Mental Illness Coordinating Committee icon on the Programs & Campaigns page with a short summary & icon
    Given The user access "Programs & Campaigns page"
    When The user searches for Programs & Campaigns page using the following terms
    |Keyword|Type  | Topic |
    |<Keyword>|<Type>  | <Topic>  |
    Then The Programs & Campaigns page search results shows "ISMICC" icon
    Then The Programs & Campaigns page search results shows "Interdepartmental Serious Mental Illness Coordinating Committee" title & short summary block

    Examples:
      |Keyword                                                                |Type        |Topic                                   |
      |Interdepartmental Serious Mental Illness Coordinating Committee       |Campaigns    |  Mental and Substance Use Disorders    |
      |Interdepartmental Serious Mental Illness Coordinating Committee       |Campaigns    |  Mental Health                         |


  Scenario: View ISMICC banner,SAMHSA header,SAMHSA footer & breadcrumb
    Given The user access "ISMICC page"
    Then The user sees the SAMHSA header
    And The user sees the SAMHSA header logo
    And The user sees the SAMHSA footer at the bottom of the page
    And The user sees the breadcrumb link for "Interdepartmental Serious Mental Illness Coordinating Committee" as main node
    And The user sees the breadcrumb link for "Programs & Campaigns" as parent nodes

  Scenario: View the search box and the social media icons on the header
    Given The user access "ISMICC page"
    Then The user sees the SAMHSA search box in the header
    And The user sees the search button for the SAMHSA search in the header
    And The user sees the text "CONNECT WITH SAMHSA:" as a label for socila media icons
    And The user sees following social media icons in the header
    |Social Media Icons|
    | facebook         |
    |twitter           |
    |youtube           |
    |blog              |


  Scenario: View the ISMICC heading and sub heading
    Given The user access "ISMICC page"
    Then The user see the main title "Interdepartmental Serious Mental Illness Coordinating Committee"
    And The user sees the following subheadings
    |subheadings                                                                                                           |
    |The Current Needs of Americans with Serious Mental Illnesses (SMI) and Serious Emotional Disturbances (SED)           |
    |Key Advances in Research on SMI and SED                                                                               |
    |About ISMICC                                                                                                          |
    |Recommendations to Improve Federal Coordination                                                                       |
    |Full Report and Executive Summary                                                                                     |
    |The Way Forward: Actions to Improve Access, Quality and Affordability of Care to Persons with SMI and SED             |


  Scenario: The content sections on page link to specific pages of the PDF report
    Given The user access "ISMICC page"
    Then The user sees for the following subheadings on ISMICC page there are respective links
      |subheadings                                                                                                  |links                                     |
      |The Current Needs of Americans with Serious Mental Illnesses (SMI) and Serious Emotional Disturbances (SED)  |Read more information about current needs |
      |Key Advances in Research on SMI and SED                                                                      |Learn about advances in SMI and SED       |
      |About ISMICC                                                                                                 |View committee and meeting schedule       |
      |Recommendations to Improve Federal Coordination                                                              |View recommendations                      |
      |Full Report and Executive Summary                                                                            |Get the report            |
      |The Way Forward: Actions to Improve Access, Quality and Affordability of Care to Persons with SMI and SED    |Read monthly newsletters and blogs on actions to address ISMICC recommendations|



  Scenario Outline: The content sections on page link to specific pages of the PDF report
    Given The user access "ISMICC page"
    When The following content assistance "<links>" are accessed
    Then The link opens in the same tab with the "<url>"
    Examples:
  |links                                                                          |url                                         |
  |Learn about advances in SMI and SED                                            |sites/default/files/programs_campaigns/ismicc_2017_report_to_congress.pdf#page=48 |
  |View committee and meeting schedule                                            |about-us/advisory-councils/ismicc      |
  |View recommendations                                                           |sites/default/files/programs_campaigns/ismicc_2017_report_to_congress.pdf#page=84 |
  |Get the report                                                  |sites/default/files/programs_campaigns/ismicc_2017_report_to_congress.pdf |
  |Read monthly newsletters and blogs on actions to address ISMICC recommendations|https://blog.samhsa.gov/|
  |Read more information about current needs                                      |sites/default/files/programs_campaigns/ismicc_2017_report_to_congress.pdf#page=18 |


  Scenario: The ISMICC 2017 Report to congress is available for download on the right rail of the ISMICC page
    Given The user access "ISMICC page"
    Then On the side block of the ISMICC page the user sees the subheading “ISMICC 2017 Report to Congress”
    And On the side block of the ISMICC page the user sees a linked image for ISMICC 2017 Report to Congress report cover
    And On the side block of the ISMICC page the user sees the link Download the ISMICC 2017 Report to Congress pdf

  Scenario: The ISMICC 2017 Report to congress is available for download on the right rail of the ISMICC page
    Given The user access "ISMICC page"
    When The user clicks the link "Download the ISMICC 2017 Report to Congress (PDF | 4.37 MB)" from the ISMICC 2017 Report block
    Then The link opens in the same tab with the "sites/default/files/programs_campaigns/ismicc_2017_report_to_congress.pdf"
    Given The user access "ISMICC page"
    When The user clicks on the ISMICC 2017 Report cover image
    Then The link opens in the same tab with the "sites/default/files/programs_campaigns/ismicc_2017_report_to_congress.pdf"


  Scenario: The external links 'ISMICC News and Blogs', 'Behavioral Health Treatment Locator', 'National Helpline' and 'National Suicide Prevention Helpline' on lg/xl view
    Given The user access "ISMICC page"
    Then The user sees the following helper blocks
      |blocks|
      |SAMHSA Behavioral Health Treatment Locator|
      |National Suicide Prevention Lifeline|
      |National Helpline         |
      |Disaster Distress Helpline          |
#      |ISMICC News and Blogs|


#
