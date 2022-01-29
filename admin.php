<?php
  // before we load the page we need to load in our 'config.php' file
  // this file contains PHP variables that our page will need to access,
  // such as the file path of the 'data' folder
  include('config.php');
?>
<!DOCTYPE html>
<html lang="en-us">
  <head>
    <title>Hogwarts School Management System</title>
    <link type="text/css" href="styles.css" rel="stylesheet" />
  </head>
  <body>
    <div id="container">
      <div id="leftcolumn">
        <img src="images/hogwarts_logo.png">
        <ul>
          <li><a href="index.php" class="navlink">Home</a></li>
          <li><a href="about.php" class="navlink">About</a></li>
          <li><a href="policies.php" class="navlink">Policies</a></li>
          <li><a href="admin.php" class="navlink active">Admin</a></li>
        </ul>
      </div>
      <div id="rightcolumn">
        <div id="header">
          Welcome to Hogwarts
        </div>

        <?php

          // open the 'alert.txt' file
          $data = file_get_contents($file_path.'/alert.txt');

          // if it has contents generate an alert box
          if ( strlen($data) > 0 ) {
            print "<div id=\"alert\">$data</div>";
          }

         ?>

        <div id="content">

          <?php
           
            // check the cookie - are they logged in?
            if ($_COOKIE['loggedin'] == 'yes') {

              print "<p>Welcome " . $_COOKIE['firstname'] . " " . $_COOKIE['lastname'] . "</p>";
              print "<p><a href=\"logout.php\">Logout</a></p>";
              print "<p><a href=\"admin_report.php\">See Admin Login Report</a></p>";
             
              if($_GET['confirmation']=='savedtext'){
              	print"<h2>An change of all or some of the following textareas has been done!</h2>";
              }
              // give the admin user a form to fill out to change any of the text files
              $hometext = file_get_contents($file_path.'/home.txt');
              $abouttext = file_get_contents($file_path.'/about.txt');
              $policiestext = file_get_contents($file_path.'/policies.txt');
              $alerttext = file_get_contents($file_path.'/alert.txt');

              ?>

              <form method="post" action="savetext.php">
                Homepage Text:
                <textarea name="homepage"><?php print $hometext; ?></textarea>
         
                About Page Text:
                <textarea name="aboutpage"><?php print $abouttext; ?></textarea>
              
                Policies Page Text:
                <textarea name="policiespage"><?php print $policiestext; ?></textarea>
               
                Alert Text:
                <textarea name="alertpage"><?php print $alerttext; ?></textarea>
                <input type="submit">
              </form>



              <?php
              


            } 
            
            else if($_GET['action']=='loggedout'){
            print "An admin just logged out! Please Log in Again";
            ?>

          <form method="post" action="login.php">
            Username:
            <input type="text" name="username"><br>
            Password:
            <input type="text" name="password">
            <input type="submit">
          </form>

          <?php

           }
         
         else if($_GET['error']=='incorrect'){
            print "Your Password and Username does not match";
            ?>

          <form method="post" action="login.php">
            Username:
            <input type="text" name="username"><br>
            Password:
            <input type="text" name="password">
            <input type="submit">
          </form>

          <?php

           }
           else if($_GET['error']=='missinginfo'){
            print "Please fill all the blanks";
            ?>

          <form method="post" action="login.php">
            Username:
            <input type="text" name="username"><br>
            Password:
            <input type="text" name="password">
            <input type="submit">
          </form>

          <?php

           }
         
         
            else {

           ?>

          <form method="post" action="login.php">
            Username:
            <input type="text" name="username"><br>
            Password:
            <input type="text" name="password">
            <input type="submit">
          </form>

          <?php

        }

           ?>

        </div>
      </div>
    </div>
  </body>
</html>
