Feature: Login

@javascript
Scenario: Login
Given I am on page "/user-login"
When I fill username with 'st1@test.com'
When I fill password with 'innoraft'
Then I can "login"

Scenario: Login1
Given I am on page "/user"
When I fill username with ' '
When I fill password with ' '
Then I cannot "login"

Scenario: Login2
Given I am on page "/user"
When I fill username with '$%^&'
When I fill password with '&^^%'
Then I cannot "login"
