@smokeTests@MenubarOptions
Feature: SAMHSA smoke test scenarios
  To check if the Grant awards page for a certain year and state show up right headers and blocks
  As a regular user
  I wanted to execute the following scenarios

  Scenario: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "Find Help & Treatment"
    Then All valid Treatment helpline images and phone numbers are seen
    #[National Suicide Prevention Lifeline,National Helpline,Disaster Distress Helpline]

  Scenario: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "Grants"
    Then All valid Grant categories are seen
#  ('Fiscal Year 2018 Grant Announcements','Applying for a New SAMHSA Grant','Grant Review Process','Continuation Grants','Grants Management','GPRA Measurement Tools','Contact Grants','More Grants Information');


  Scenario: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "Programs & Campaigns"
    Then All valid Programs & Campaign categories are seen
#    ('Featured Campaign','Popular Programs, Campaigns, & Initiatives','Popular Technical Assistance & Resource Centers')


  Scenario: Main menu bar opens with right options
    Given The user access SAMHSA homesite
    When The user hover over main menu for "About Us"
    Then All valid About Us categories are seen
  #('Who We Are','Interagency Activities','Advisory Councils','Strategic Initiatives','Budget','Speeches and presentations','Jobs & Internships','Contact Us')
