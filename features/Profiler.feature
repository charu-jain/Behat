Feature: Interest Profiler

@javascript @anno
Scenario: Interest profiler for annonymous user
Given I am on page "/interest-profiler"
And I click on 'Ignore and continue'
And I click on button 'Get Started'
And I wait for text "How would you like to..."
And I will answer the questions
Then I submit form

@javascript @reg
Scenario: Interest profiler for registered user
Given I am on page "/interest-profiler"
And I logged in with username 'student100@kv.com' and password 'pass'
And I click on button 'Get Started'
And I wait for text "How would you like to..."
And I will answer the questions
Then I submit form
