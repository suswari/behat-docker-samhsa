Feature: Bupe Lookup
  In order to verify Buprenorphine practitioners
  As a pharmacist
  I need to search for practitioners by last name and DEA registration number

  Background:
    Given I am on "/bupe/lookup-form"

  Scenario: Search for correct help text on the page
    Then I should see "To verify a physician's DATA waiver, search using his or her last name and DEA registration number."
    And I should see "Each physician's DEA license gives two registration numbers. Search using the first number, which generally starts with A, B, F or M."
    And I should see "If you need to search for a number that starts with \"X,\" replace the X with an asterisk (*)."
  Scenario: Enter valid Bupe practitioner and submit form
    When I fill in "Physician Last Name" with "Severance"
    And I fill in "DEA Registration Number" with "AS7927099"
    And I press "Submit"
    Then I should see "Douglas Severance is a certified Buprenorphine Physician. DEA Registration Number: AS7927099 Licensed State: CA Date Certified: 2016-10-12 Certified for 275 patients."

  Scenario: Enter an invalid Bupe Practitioner and submit form
    When I fill in "Physician Last Name" with "Rumplestilsken"
    And I fill in "DEA Registration Number" with "A55555555"
    And I press "Submit"
    Then I should see "Rumplestilsken is not a Buprenorphine Certified Physician. DEA Registration Number: A55555555"

  Scenario: A cross-site script injects a malevelant script into the physician last name field
    When I fill in "Physician Last Name" with "<script>window.location = 'https://www.cnn.com/terms';</script>"
    And I fill in "DEA Registration Number" with "AS7927099"
    And I press "Submit"
    Then I should not see "CNN Terms of Use"
    And I should see "<script>window.location = 'https://www.cnn.com/terms';</script> is not a Buprenorphine Certified Physician."

  Scenario: A cross-site script injects a malevelant script into the DEA Registration Number field
    When I fill in "Physician Last Name" with "Rumplestilsken"
    And I fill in "DEA Registration Number" with "<script>window.location = 'https://www.cnn.com/terms';</script>"
    And I press "Submit"
    Then I should not see "CNN Terms of Use"
    And I should see "The following information is not available at this time. Please try again later."
