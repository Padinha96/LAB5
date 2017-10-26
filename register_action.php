<?php
 require_once "HTML/Template/IT.php";
include 'db.php'; 
  // Process signup submission
  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);  

  if(
     $_POST['name']  == '' or 
     $_POST['email'] == ''
	 {
   error('One or more required fields were left blank.\\n'.
         'Please fill them in and try again.');
	 header('Location: register.php?name = $_POST['name']&email = $_POST['name']&message="Fill blank fields"');
	 }
	 
	 if(strlen($_POST['pass1'] <5)
		 error('password must have at least 5 characters');
	  header('Location: register.php?name = $_POST['name']&email = $_POST['name']&message=""');
   
  // Check for existing user with the new id
  $query = "SELECT * FROM users WHERE email = '" .$_POST[email] ."'";
  $result = @ mysql_query($query,$db);
  if(!$result)
     error('A database error occurred in processing your submission');

  if(mysql_num_rows($result) > 0)
  {
     error('A user already exists with your chosen email.\\n'.
           'Please try another.');
		    header('Location: register.php?name = $_POST['name']&email = ""&message="Email already exists,try another"');
  }
  
  $userid  = $_POST[newid];
  substr(md5($_POST['pass1']),0,32)
  $fullname = $_POST[name];
  $email    = $_POST[email];
  $present_date = date("Y-m-d H:i:s");

  $sql_insert = "INSERT INTO users(uid,name,email, created_at, updated_at, password_digest) 
                 VALUES('$userid','$fullname','$email','$present_date','$present_date','$password')";

  if(!mysql_query($sql_insert,$db))
  {
     error('A database error occurred in processing your submission');
	 header('Location: register.php');
  }
  // Close database
  mysql_close($db);
             
  // Email the new password to the person.
  $message = "Hello

Your personal account for the Project Web Site
has been created! 

Your personal login ID and password are as
follows:

   userid: $_POST[id]
   password: $password

- Figo
";

  mail($_POST['email'],"Your Password for the Website",
       $message, "From:Figo <figo@blabla.com>");
  
  header("Location: signup_success.html");      

?>
