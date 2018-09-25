Notes:
I created this simple app according to the specifications below. If I had more time to spend, I would fix the case of a username not being found. I would also trigger a search on the enter key as well as button click. I would also do some further testing, edge case handling, comments, clean up, etc. As I developed this initially, I only found documentation on user/search which returns a list of users. So I developed to use this and built in some code to handle a list of users. I later discovered the API for a specific user and modified things accordingly.

Demo specifications:

GitHub Followers
Create a page that allows for a user to search for a GitHub username. On a successful search return, display the user's GitHub handle, follower count, and a list of the user's followers (just the avatar is fine). Since some users (e.g.taylorotwell, etc.) have many thousands of followers, GitHub only returns a portion of the followers with each request. Create a "load more" button that, when clicked, fetches the next payload of followers. This button should persist until there are no more pages of followers to fetch.

Technical spec

Use PHP to make the API calls to Github and use Javascript to make AJAX requests to your PHP and get the results. You can use any framework of choice, however Laravel is preferred.
