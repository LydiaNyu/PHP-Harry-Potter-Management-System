<?php

  // grab the username & password
  $username = $_POST['username'];
  $password = $_POST['password'];


  // make sure they entered something into both blanks
  if ($username && $password) {
    // access the 'teacheraccounts.txt' text file
    include('config.php');

    $data = file_get_contents($file_path.'/teacheraccounts.txt');
    $admins = explode("\n", $data);
    
    for($i = 0; $i <sizeof($admins); $i++){
    	
    $credentials = explode(",", $admins[$i]);
    
    // check to make sure the username & password are correct
    if ($username == $credentials[0] && $password == $credentials[1]) {
      // login successful!

      // drop a cookie on the client computer
      setcookie('loggedin', 'yes');
      setcookie('username', $credentials[0]);
      setcookie('firstname', $credentials[2]);
      setcookie('lastname', $credentials[3]);
      $record = time()." ".$credentials[0].' login'."\n";
      file_put_contents($file_path.'/adminlog.txt', $record, FILE_APPEND);
      // send them back to the form
      header('Location: admin.php');
      exit();
    }
    }
    
      // send them back to the form
      header('Location: admin.php?error=incorrect');
      exit();
    
  }
  else {
    // send them back to the form
    header('Location: admin.php?error=missinginfo');
    exit();
  }

 ?>
