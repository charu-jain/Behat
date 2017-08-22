Feature: To compare data of two web pages
 In order to check redundancy of two web pages
 As a Tester
 I need to compare data of both web pages altogether

 @compare @javascript
 Scenario: To compare data of two web pages
  Given I am on copyscape
  When I put url1 & url2
  And click on comapre button
  Then I can see data comparison of both webpages