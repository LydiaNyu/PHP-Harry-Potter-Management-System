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
          <li><a href="index.php" class="navlink active">Home</a></li>
          <li><a href="about.php" class="navlink">About</a></li>
          <li><a href="policies.php" class="navlink">Policies</a></li>
          <li><a href="admin.php" class="navlink">Admin</a></li>
        </ul>
      </div>
      <div id="rightcolumn">
        <div id="header">
        Admin View Reports         
        </div>

       <?php

  

  // security audit - make sure the user is logged in before making changes!
  if ($_COOKIE['loggedin'] == 'yes') {
    
    // put this into the text file
    $contents = file_get_contents($file_path.'/adminlog.txt');
    
    $eachHistory = explode("\n", $contents);
    
    print"<table>";
    for($i = 0; $i <sizeof($eachHistory); $i++){
    	
    $credentials = explode(" ", $eachHistory[$i]);
    $time = date('Y-m-d H:i:s', $credentials[0]);
    print"<tr><td>".$time."</td><td>".$credentials[1]."</td></tr>";
    
    }
    print"</table>";

   
    
  }
  else {
    // send them back to the admin page
    header('Location: admin.php?error=notloggedin&nocache='.rand());
    exit();
  }





 ?>
        </div>
      </div>
    </div>
  </body>
</html>
