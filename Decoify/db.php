<?php

//Connection to database

function db_connect() {

    // Define connection as a static variable, to avoid connecting more than once 
    static $connection;

    // Try and connect to the database
    if(!isset($connection)) {
        $config = parse_ini_file('config/config.ini'); 
        $connection = mysqli_connect($config['host'],$config['username'],$config['password'],$config['dbname']);
    }

    // If connection was not successful, handle the error
    if($connection === false) {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
    }
    return $connection;
}

//Query the database

function db_query($query) {
    // Connect to the database
    $connection = db_connect();

    // Query the database
    $result = mysqli_query($connection,$query);

    return $result;
}

//Check Session

function check_session(){

  if(!isset($_SESSION)) 
  { 
      session_start(); 
  }


  if(isset($_SESSION['user_name']) &&  $_SESSION['role'] == 'admin')
  {
    $logged_in = 'true';
    return $logged_in;
  }

  else
  {
    header('location:loginView.php');
  }

}

// validate input -  string, numeric, space and . --> ^[A-Za-z0-9. ]*$

function val_input($str)
{

  if(preg_match("/^[A-Za-z0-9.\-]*$/", $str)) {
    return true;
  }

  else{
    return false; 
  }

}

// IP Validation

function val_ip($str)
{

  if(preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}/',$str)) {
    return true;
  }

  else{
    return false;
  }

}

// Data Filter

function dataFilter($str)
{
  return htmlspecialchars($str, ENT_QUOTES);
}



?>
