@smokeTests@200
Feature: SAMHSA smoke test scenarios
  In order to check every link listed in the sitemap responds with 200
  As a regular user
  I wanted to execute the following scenarios

Scenario Outline:
  Given A user access the following "<URI>"
  Then The URI responds with 200 status code
  Examples:
  |URI|
  |find-help   |
  |https://store.samhsa.gov/|
  |topics   |
  |programs-campaigns   |
  |grants   |
  |data     |
  |about-us |
  |newsroom |
  |about-us/contact-us|
  |search_results     |
  |workplace/resources/drug-free-helpline|
  |find-help/disaster-distress-helpline  |
  |find-help/national-helpline           |
  |https://findtreatment.samhsa.gov/     |
  |medication-assisted-treatment/physician-program-data/treatment-physician-locator|
  |https://dpt2.samhsa.gov/treatment/directory.aspx                                |