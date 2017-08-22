Feature: Table
 In order to access table
 As a user
 I need to draw it

 Scenario: table
  Given the following people exist:
    | username | pass |
    | Aslak    | 123  |
    | Joe      | 234  |
    | Bryan    | 456  |
  When I open table
  Then I should see table data