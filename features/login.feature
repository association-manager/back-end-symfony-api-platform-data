@acceptance @javascript
Feature:
    Scenario: Login to application
        Given I am in login page
        Then I should see "Connexion"
        Then I log in user "admin@admin.com" with pass "adminPassword"
