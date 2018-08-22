@EBP
Feature: Evidence-Based Practices Resource Center Display content
  In order to verify the presence of content of the EBP Resource Page
  As a regular user
  I need to use the step definitions of this context

  Background:
    Given The user access SAMHSA homesite

  Scenario: View default page layout for each EBP Resource page
    When The user navigates to the "EBP Resource Center" page from Programs & Campaigns
    Then The user sees the SAMHSA header logo
    And The user sees the EBP banner at the top of the page
    And The user sees the title “Evidence-Based Practices Resources Center” is visible
    And The user sees the EBP welcome statement below the title
    And The user sees the sub heading “Filter Resources”
    And The user sees that all the EBP related document resources are listed below the filter section
    And The user sees the EBP “Technical Assistance” section to the right side of the page

  Scenario: View default page layout for each EBP Resource page
    When The user navigates to the "EBP Resource Center" page from Programs & Campaigns
    Then The user sees the "Summary" text for landing page
      """
      SAMHSA is committed to improving prevention, treatment, and recovery support services for mental and substance use disorders.
      """
    And The user sees the "Description" text for landing page
      """
      This new Evidence-Based Practices Resource Center aims to provide communities, clinicians, policy-makers and others in the field with the information and tools they need to incorporate evidence-based practices into their communities or clinical settings. The Resource Center contains a collection of scientifically-based resources for a broad range of audiences, including Treatment Improvement Protocols, toolkits, resource guides, clinical practice guidelines, and other science-based resources.
      """
    And The user sees the link "Learn more about the Evidence-Based Practices Resource Center"


  Scenario: View the default breadcrumb link for the EBP resource center page
    When The user navigates to the "EBP Resource Center" page from Programs & Campaigns
    Then The user sees the breadcrumb link for "EBP Resource Center" as main node
    And The user sees the breadcrumb link for "Programs & Campaigns" as parent nodes

  Scenario: View the 'Filter Resources' section
    Given The user is on the "EBP Resource Center page"
    Then From the EBP filter section the user sees the following filters and default selection
    |filter          |default selection     |
    |Topic Area      |   - All -              |
    |Populations     |   - All -              |
    |Target Audience |   - All -              |
    |Resource Type   |   - All -              |
    |Sort by         |      Title A->Z        |
    |Items per page  |     15                 |
    And The user sees the “Apply” button for the EBP filters

  Scenario: View the resource descriptions and tags for each resource listing
    Given The user is on the "EBP Resource Center page"
    Then From the list of EBP resources the user sees the resource title come links
    And The resource records are sorted by title in ascending order by default
    And The total number of resources listed per page is 15
    And The user sees the resource description
    And The user always sees the following resource tags
      |tag|
      |Topic Area|
      |Populations|
      |Target audience|
      |Resource Type|
    And The user sees the following resource tags only when their value is not blank
      |tag|
      |Substances|
      |Conditions|


  Scenario: View the 'Technical Assistance' section
    Given The user is on the "EBP Resource Center page"
    When In the Technical Assistance section on the right rail of the EBP page there are following weblinks
    |links|
    |Providers' Clinical Support System for Medication Assisted Treatment (PCSS-MAT)|
    |Addiction Technology Transfer Center (ATTC) Network                            |
    |Center for the Application of Prevention Technologies (CAPT)                   |
    |Bringing Recovery Supports to Scale Technical Assistance Center Strategy (BRSS TACS)|
    |SAMHSA-HRSA Center for Integrated Health Solutions (CIHS)                           |
    |National Center on Substance Abuse and Child Welfare (NCSACW)                      |
    |National Training and Technical Assistance Center for Child, Youth & Family Mental Health (NTTAC)|
    And The user sees "View more technical assistance resources on the SAMHSA Knowledge Network" in the Technical Assistance section


  Scenario Outline: View the 'Technical Assistance' section
    Given The user is on the "EBP Resource Center page"
    When The following Technical Assistance "<links>" are accessed
    Then The link opens in the same tab with the "<url>"
    Examples:
      |links                                                                          |url|
      |Providers' Clinical Support System for Medication Assisted Treatment (PCSS-MAT)|https://pcssnow.org/|
      |Addiction Technology Transfer Center (ATTC) Network                            |http://attcnetwork.org/home/|
      |Center for the Application of Prevention Technologies (CAPT)                   |https://www.samhsa.gov/capt/|
      |Bringing Recovery Supports to Scale Technical Assistance Center Strategy (BRSS TACS)|https://www.samhsa.gov/brss-tacs|
      |SAMHSA-HRSA Center for Integrated Health Solutions (CIHS)                           |https://www.samhsa.gov/integrated-health-solutions|
      |National Center on Substance Abuse and Child Welfare (NCSACW)                      |https://ncsacw.samhsa.gov/                         |
      |National Training and Technical Assistance Center for Child, Youth & Family Mental Health (NTTAC)|https://www.samhsa.gov/nttac         |
      |View more technical assistance resources on the SAMHSA Knowledge Network|https://knowledge.samhsa.gov/                                 |


  Scenario: View the 'blocks' section
    Given The user is on the "EBP Resource Center page"
    Then The user sees the following helper blocks
    |blocks|
    |SAMHSA Behavioral Health Treatment Locator|
    |National Suicide Prevention Lifeline|
    |National Helpline         |
    |Disaster Distress Helpline          |


  Scenario: View default pagination on the EBP resource center page
    Given The user is on the "EBP Resource Center page"
    Then The user sees the page number links at the bottom of the page
    And The user sees the "next" pagination link
    And The user sees the "last" pagination link

  Scenario: View 'first' and 'previous' pagination on the EBP resource center page
    Given The user is on the "EBP Resource Center page"
    When The user clicks on "next" link for the next page EBP resources
    Then The user sees the "first" pagination link
    And The user sees the "previous" pagination link


  Scenario: View the Samsha footer at the bottom of the page
    Given The user is on the "EBP Resource Center page"
    Then The user sees the SAMHSA footer at the bottom of the page


  Scenario: About Page
    Given The user is on the "EBP Resource Center page"
    When The user clicks the link "Learn more about the Evidence-Based Practices Resource Center"
    Then The user expects to be on "EBP about page"
    And The user sees the EBP about page title as "About the Evidence-Based Practices Resource Center"
    And The user sees the EBP about page description text "SAMHSA is committed to improving prevention, treatment, and recovery support services for mental and substance use disorders."
    And The user sees the Sidebar navigation with the following links
    |link|
    |EBP Resource Center|
    |About              |
    And The user sees the EBP about page text
   And The user sees the link "Return to the Evidence-Based Practices Resource Center search page"


  Scenario: About Page Links
    Given The user is on the "EBP about page"
    When The user clicks the link "EBP Resource Center" from the sidebar navigation
    Then The user expects to be on "EBP Resource Center page"

  Scenario: About Page Links
    Given The user is on the "EBP about page"
    When The user clicks the link "Return to the Evidence-Based Practices Resource Center search page"
    Then The user expects to be on "EBP Resource Center page"


