## Introduction
This program aims to create a multi-page "CRUD" site (Create, Read, Update, Delete) - this kind of application will demonstration some techniques that can be used to create a simple content management system.

## Course Website
It has been already been uploaded to my school website:  
https://i6.cims.nyu.edu/~st3890/webdev/macro08/index.php  

## Requirements
Task #1: Dynamic Page Content

- Set up the 'index', 'about' and 'policies' page to include dynamic content that is stored in the 'home.txt', 'about.txt' and 'policies.txt' files.

- If the site administrator ever changes these files these pages should automatically update with the new content without having to edit the PHP files.

- You can test your work by visiting your site in the browser - when you visit any of these pages the contents from the related text file should appear on the page.

	- Hint: use the 'include' function to do this.
	- Hint: look at the first few lines in 'index.php' - you will see that you are already including 'config.php' - this means that any variables defined in 'config.php are available to your program already, including '$file_path'



Task #2: Emergency Alert System

- Create a new text file in the 'data' folder called 'alerts.txt'

- Store some text in this file that you want to appear on all pages in the case of a Hogwarts emergency (i.e. "Classes canceled: dragon attack!")

- Set up every page so that the alert shows up at the top of the page, directly above the 'header' div.  If there is text in this alert file.  Use the CSS ID of "alert" on this element to display it using a red background.

- If the contents of the file is empty you should not show anything on the page.

- Test your work by repeatedly editing this file - if you put text into it and refresh a page you should see the alert show up.  If you delete the contents of this file you should see no alert box when you refresh the page.

	- Hint: use 'file_get_contents' to get the contents of the file
	- Hint: test the data in the file to make sure it is not empty using an 'if' statement





Task #3: User Login System

- Note: this exercise is much better than using JavaScript for authentication, but it's still not perfect due to the fact that we're using insecure cookies that the user can easily mess with.  We will cover a better way to do this later in this assignment.  For now, this is an exercise is learning how to work with files and cookies using PHP.

- Design an HTML form to prompt the user for a username and password

- When the use submits the form, send the data to a file called 'login.php' - this file should then do the following:

	- Extract the username and password from the $_POST superglobal

	- Open up the 'teacheraccounts.txt' file and read its data into a string (hint: you might need to include the 'config.php' file to access your file path!)

	- Before you continue, print out the string.  It will contain information about the school administrator in the following format:

		username,password,first_name,last_name

	- Check the supplied username & password against this string.  hint: use the 'explode' function to separate the string into its individual components.  This works like the 'split' function in Python.  Hint: the 'trim' function in PHP can be used to remove any extra 'whitespace' breaks at the beginning or end of a string.  Ex:  $data = trim($data);

	- If the supplied username & password are correct you should do the following:

		- Set a cookie on their computer indicating that they logged in successfully.
		- Set a cookie on their computer with their first name
		- Set a cookie on their computer with their last name
		- Set a cookie on their computer with their username
		- Redirect the user's browser to 'admin.php'

	- If the supplied an incorrect username & password you should just redirect the user's browser to 'admin.php' without setting a cookie. Send back an error message using a GET variable too.

	- Check your work! See if you have a cookie set by opening up your developer's console in your browser

	- Edit 'admin.php' to look for the presence of this cookie using the $_COOKIE superglobal.  If it exists, display a 'Welcome' message to the user instead of the login form.  Welcome the user by name using the cookie you set to hold their first & last name (i.e. the page should read "Welcome Albus Dumbledore!"





Task #4: Logout

- If the user is logged in, add in a 'logout' link to the 'admin.php' page. This link should point to a page named 'logout.php'

- When run, this script should remove the cookies on the client's computer.

- You can remove a cookie on the client's computer by setting the cookie's expiration data to sometime in the past.  We generally do this in PHP using the following line of code:

	setcookie(COOKIENAME, '', time()-3600);

- Redirect the user back to 'admin.php' when this is done - the page will reload, and the login form should appear again

- Make a special message show up indicating that the user has logged out (Hint: use the GET method to send a variable to 'admin.php' telling it that you just logged the user out.  For example:  admin.php?action=loggedout)





Task #5: Content Management System

- If the user is logged in, add in a form and a series of four 'textarea' elements to the 'admin.php' page.

- These 'textarea' units will be used to display an editable version of each of the four text files that you set up in Tasks #1 and #2 above.

- When the page loads, open these files and display their contents into these four text areas, like this:

	<textarea name="home">TEXT_FOR_HOME_GOES_HERE</textarea>

- Add in a 'submit' button to the form

- When the user clicks the 'submit' button, send the data to a file named 'updatecontent.php'

- Create the 'updatecontent.php' file to do the following:

	- Access the user's cookie - if they are not authenticated, redirect them back to 'admin.php'. This is a security feature!  If someone tries to access this script and they aren't logged in they could potentially update the content of our site.  By checking the cookie here we can 'prove' that they are logged in before we do anything dangerous.  You can check to see if a value is set or not set by using the 'isset' function in PHP (i.e. if (!isset(VARIABLE)) )

	- If they are logged in, access the value of each 'textarea' using the $_POST superglobal

	- Overwrite each text file with its new contents

	- Redirect the user back to 'admin.php'

- Check your work by visiting the other pages - you should be able to update the contents of each page using your 'admin' interface as well as set up an emergency alert to show up on all pages.

- Once the system works you can add in confirmation message letting the user know that their changes have been saved (using the GET method described in the previous task)






Task #6: Multiple Administrator Support

- Next, we are going to open up the site so that multiple administrators can log in and use the system.

- Edit the 'teacheraccounts.txt' file in the 'data' folder to include two additional entries for two new administrators:

	dumbledore,phoenix1,Albus,Dumbledore
	mcgonigal,iCanTurnIntoCat,Minerva,McGonical
	snape,hatePotter?,Severus,Snape

- Update your 'login.php' to include the following:

	- You will need to isolate each individual record by splitting up the file based on the line break

	- Next, visit every line using a 'for' loop

	- Split apart the individual to extract each individual value

	- Text to see if the incoming username/password combination matches the account you are currently examining.  If so, you can set a cookie and redirect the user.  You can simply end the program here by calling the 'exit' function or using the 'break' statement to stop the loop.






Task #7: Administrator Logging System

- When an administrator successfully logs in you should log this activity into a new file called 'adminlog.txt'

- Append a record that looks like the following to this log file:

CURRENT_TIME,dumbledore,login

- Make sure to print a linebreak at the end of your line ("\n") - make sure you use double quotes, otherwise PHP will treat the linebreak as the literal characters '\n'.

- You can get the current time as a UNIX timestamp in PHP using the time() function

- Check your work by looking at your 'data' folder to make sure that this file was created successfully

- Once this works update your system so that the website logs every time the user logs out as well as when they make a change to the site's contents.







Task #8: Administrator View Login History

- On the 'admin.php' page, add in a link to a new page called 'admin_report.php' - this link should only be displayed if there is a logged in user.

- Create this page by duplicating one of your other pages.  This page should do the following:

	- If the user visits 'admin_report.php' the page checks to see if they are logged in - if not, the page immediately redirects them to 'admin.php' and exits the program (using 'exit;'). Do this at the top of the page, before you print any HTML to the browser

	- If the user is logged in the page should access the 'adminlog.txt' file and display all of the records to the user using a table.  Hint: create a table tag with the appropriate # of columns in regular HTML.  Then process your data by splitting it accordingly.  Print out the data inside of a 'for' loop using the approbate "td" and "tr" tags.

	- Hint: you can covert a UNIX timestamp into a human readable date using PHP's 'date' function, like this:  date('Y-m-d H:i:s', TIMESTAMP);




 
