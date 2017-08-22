Feature: Career Plan

@javascript @stu
Scenario: Favorite career for registered user
Given I am on login page "/user-login"
And I logged in with username 'new3@allsaint.com' and password 'pass'
And I moved to Career search page
And I select "Educational Services" from "Select Industry"
And I marked "Biological Science Teachers, Postsecondary" as fav career
Then I moved to "My Career Plan" page
And I waited for career list to appear
And I verified for marked career here
