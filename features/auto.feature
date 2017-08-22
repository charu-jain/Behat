Feature: Autocomplete

@javascript
Scenario: autocomplete
Given I am on page "/"
When I fill keyword 'behat'
And select suggestion 'behat'
When I click on "http://behat.org/" link
Then I can see behat documentation