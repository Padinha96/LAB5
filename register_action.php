<?php
require_once ('HTML/Template/IT.php');
  require_once ('db.php');

  $db = dbconnect($hostname,$db_name,$db_user,$db_passwd);
  if($db){

    $name=$_GET['name'];
    $email=$_GET['email'];
    //$senha=substr(md5($_GET['pass1']),0,32);
    $senha=$_GET['pass1'];
    $senha2=$_GET['pass2'];
    $error = 0;
    //header("Location:register.php");
    

    $sql=mysql_query("SELECT email FROM users WHERE email='$email';");
    if(mysql_num_rows($sql)){
      $error = 1;
      header("Location:register.php?error=1&name=$name&email=$email");
    }elseif($senha!=$senha2){
      $error = 2;
      header("Location:register.php?error=2&name=$name&email=$email");
    }else{
      $senha=substr(md5($_GET['password']),0,32);
      $data=date("Y-m-d H:i:s");
      $query="INSERT INTO users (name,email,password_digest,created_at,updated_at) VALUES ('$name','$email','$senha','$data','data');";
      mysql_query($query,$db);
      header("Location:register_success.html");
    }
    mysql_close($db); 
  }
  else{
    echo "Erro ao fazer a ligacao"; 
  }
?>