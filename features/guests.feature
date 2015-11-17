Feature: Guests

  In ordered to give guests (non-registered users) access to guest-specific features and pages
  As an administrator
  I need guests navigation and registration

  Background:
    Given I am a guest
    And I am on the landing page

  Scenario: Landing Page (Logo) Navigation
    When I follow "DEMHUB logo"
    Then I should be on "/"
    And I should see "The Disaster & Emergency Management Network"
    And I should see "What Is DEMHUB?"

  Scenario: Landing Page (Link) Navigation
    When I follow "DEMHUB Inc"
    Then I should be on "/"
    And I should see "The Disaster & Emergency Management Network"
    And I should see "What Is DEMHUB?"

  Scenario: About Page Navigation
    When I follow "ABOUT"
    Then I should be on "/about"
    And I should see "About Us"
    And I should see "Jennifer Duke Holmes"
    And I should see "Sean William Kondra"
    And I should see "Aldo Rui­z Luna"
    And I should see "Leon Haggarty"
    And I should see "Jiao Xue"
    And I should see "Hilary Julien"

  Scenario: Privacy Policy Navigation
    When I follow "Privacy Policy"
    Then I should be on "/policy"
    And I should see "Privacy Policy"
    And I should see "Introduction"
    And I should see "What Information Do We Collect?"
    And I should see "How Do We Use the Information We Collect?"
    And I should see "What Information Do We Disclose to Third Parties?"
    And I should see "Notice of Privacy Rights to California Residents"
    And I should see "Privacy Settings/Opt Out"
    And I should see "Access and Updating of Information"
    And I should see "General"

  Scenario: Terms Of Service Navigation
    When I follow "Terms of Service"
    Then I should be on "/terms"
    And I should see "TERMS OF SERVICE"
    And I should see "A. Account Terms"
    And I should see "B. Copyright and Content Ownership"
    And I should see "C. General Conditions"

  Scenario: Try The Beta Navigation
    When I follow "TRY THE BETA"
    Then I should be on "/divisions"
    And I should see "ALL DIVISIONS"

  Scenario: Six Divisions Navigation
      When I follow "SIX DIVISIONS"
      Then I should be on "/divisions"
      And I should see "ALL DIVISIONS"

  Scenario Outline: Divisions Navigation via Landing Page
    When I follow "<DivisionName>"
    Then I should be on "/division/<DivisionSlug>"
    And I should see "<DivisionName>"

    Examples:
    |DivisionName               |DivisionSlug |
    |Health & Epidemics         |health       |
    |Science & Environment      |science      |
    |EM Practitioner & Response |response     |
    |Civil & Cyber Security     |security     |
    |Business Continuity        |continuity   |
    |NGO & Humanitarian         |humanitarian |

  @javascript
  Scenario: Guest Wants to Register
    When I follow "REGISTER"
    And I register
    Then I should be on "/userhome"
    And I should see "Your account was successfully created. Welcome to DEMHUB."
