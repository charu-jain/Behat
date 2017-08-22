Feature:
 In order to see price of bike variant
 As a User
 I need to check it at all occurances
  
 Scenario: To check variant price at model overview page
  Given I am on Model overview page
  And session city is Delhi
  When I scroll to variant section
  Then I should see price of variant 
 
 @model
 Scenario: To check variant price at model price page
  Given I am on Model price page
  And session city is Delhi on page
  When I see prices of variant at price breakup table
  Then I should see same price of variant at model overview page

  
