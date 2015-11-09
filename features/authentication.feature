Feature: Membership

  In ordered to give registered members access to restricted features
  As an administrator
  I need authentication and registration for users

  # When I register "John Doe" "john@example.com"
  # Given I am on (?:|the )homepage$/
  # |first_name|last_name|email|password|etc|

  Scenario: Guest Visit
    When I go to the homepage
    Then I should be on the homepage

  Scenario: Guest Wants to Register
    Given that I am not a registered user
    When I go to the homepage
    And I press "REGISTER"
    Then I should see "GET THE BETA VERSION"

  Scenario: Guest Wants to Register - Part 2
    Given that I am not a registered user
    And that I am on the "registration page"
    When I fill "username" with "TestUser"
    And I fill "email" with "test@example.com"
    And I fill "password" with "password"
    And I fill "password confirm" with "password"
    Then I should see "We verify each member who signs up."

  Scenario: Member Visit
    When I go to the homepage
    Given that I am a registered user
    Then I should be on the userhome
