Feature: To check all faq links
 In order to see any help regarding application
 As an user
 I need to see it at FAQ page 

 
 Scenario: To check if question exists at FAQ page
  Given I am on page "/faq"
  When I click on "Application Process"
  Then I should see help questions regarding Application