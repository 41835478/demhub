Feature: Membership

  In ordered to give registered members access to restricted features
  As an administrator
  I need authentication and registration for users

  # When I register "John Doe" "john@example.com"
  # Given I am on (?:|the )homepage$/
  # |first_name|last_name|email|password|etc|

  Scenario: Guest Visit
    When I go to the homepage
    Given I am not logged in
    Then I should be on the homepage

  Scenario: Guest Wants to Register from Navbar
    Given I am not a registered user
    When I go to the homepage
    And I follow "REGISTER"
    Then I should see "GET THE BETA VERSION"

  # Scenario: Guest Wants to Register from final landing page section
  #   Given I am not a registered user
  #   When I go to the homepage
  #   And I follow "REGISTER"
  #   Then I should see "GET THE BETA VERSION"

  Scenario: Guest Wants to Register - Part 2
    Given I am not logged in
    And I am on "auth/register"
    When I fill in "user_name" with "TestUser"
    And I fill in "email" with "test@example.com"
    And I fill in "password" with "password"
    And I fill in "password_confirmation" with "password"
    And I follow "JOIN"
    And I follow "SOUNDS GOOD"
    And I fill in "first_name" with "TestUser"
    And I fill in "last_name" with "Gorilla"
    And I fill in "job_title" with "password"
    And I fill in "organization_name" with "password"
    And I press "DONE"
    # And I wait 1 second
    # Then I should be on the homepage
    And I should see "Your account was successfully created. We have sent you an e-mail to confirm your account."

  Scenario: Member Visit
    When I go to the homepage
    Given I am a registered user
    Then I should be on "userhome"
