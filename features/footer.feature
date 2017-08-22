Feature: To see data listed at footer
 In order to see social site links & copyright info of hcl
 As a user
 I need to find it at footer

 @javascript
 Scenario: To check social site link redirection
  Given I am on Homepage
  When I am at footer
  Then I can see all social site links

 @copy
 Scenario: To check copyright information
  Given I am on Homepage
  When I am at footer
  Then I can see copyright info

 @alllinks
 Scenario: To get all links on a page
  Given I am on Homepage
  When I find all links
  Then I can see all links info
 