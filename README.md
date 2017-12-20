# webphp
1.
This is an application of webphp project. The index.php uses "Get" method to get the value of "init", which is the commit  json's url address. So that this function is modularitied.

At the first glance at this project, I was not quite excited to work on it.  Because I am not so familiar with php programming. I used 2 hours to learn about the grammar and complete the function of php page. And then I utilize Bootstrap and Jquery framework to realize the layout of the page.
The api of Github offered the json of the commit information. I used curl package to get the json string and encode it as json file. Then I get the needed information from the json, using php grammar, and arrange it in the new table. Finally, the php page use some css format layout to display the table we need.
2.
To utilize this application, we need to deploy the whole project on the server. The default port is 8080, if we use the restclient software, we could use get method to send the API's url address to "init" at index.php, then we will get the table of the commit information.

3.During programming, I always exceeded the limit rate of Github API's request rate. I didn't use confidential request to maintain a unlimited rate request. It can be improved by changing the http request to a confidential one. Besides, the php framework I chose didn't work a lot for the link from the front to the back end. I need to finish it.
