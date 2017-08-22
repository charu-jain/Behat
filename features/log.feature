Feature: To log in
 In order to login
 As a User
 I need to provide credentials

@javascript @TC_001
  Scenario: Check Successful login for signup user
  Given I am on page "/user"
  When I fill username "mahak.jain@innoraft.com"
  And I fill password "mahak@innoraft"
  And I click on button "Log in"
  Then I should see first page

@javascript @TC_002
  Scenario: Check login for non-signup user
  Given I am on page "/user"
  When I fill username "charu.rohi@gmail.com"
  And I fill password "123ty"
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_003
  Scenario: Check required fields via blank submission
  Given I am on page "/user"
  When I fill username " "
  And I fill password " "
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_004
  Scenario: Check required fields via alternate blank submission
  Given I am on page "/user"
  When I fill username "mahak.jain@innoraft.com"
  And I fill password " "
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_005
  Scenario: Check required fields via alternate blank submission
  Given I am on page "/user"
  When I fill username " "
  And I fill password "mahak@innoraft"
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_006
  Scenario: Check login via username (If functionality accepts)
  Given I am on page "/user"
  When I fill username "mahak.jain"
  And I fill password "mahak@innoraft"
  And I click on button "Log in"
  Then I should see first page

@javascript @TC_007
  Scenario: Check login via valid username but wrong password
  Given I am on page "/user"
  When I fill username "mahak.jain@innoraft.com"
  And I fill password "admin"
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_008
  Scenario: Check login via wrong username but correct password
  Given I am on page "/user"
  When I fill username "mahak.jai@innoraft.com"
  And I fill password "mahak@innoraft"
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_009
  Scenario: Check Email validation
  Given I am on page "/user"
  When I fill username "mahak.jain@@innoraft.com"
  And I fill password "mahak@innoraft"
  And I click on button "Log in"
  Then I should see validation

@javascript @TC_010
  Scenario: Check password validation
  Given I am on page "/user"
  When I fill username "mahak.jain@innoraft.com"
  And I fill password "**************"
  And I click on button "Log in"
  Then I should see validation
