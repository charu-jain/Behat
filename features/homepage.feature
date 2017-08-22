Feature: To check all inlinking at home page  
 In order to access all inlinking
 As a user
 I need to check all redirection of inlinkings

 	
 Scenario: Inlinking at Home Page
  Given I am on Home page 
  When I click on all inlinks one by one
  Then I should see redirection of each inlink

 
 Scenario: Other links redirection
  Given I am on Home page 
  When I click on all links one by one
  Then I should see redirection to respective page
