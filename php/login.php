<?php
  session_start();
  $_SESSION['emp_num'] = 102;
  $_SESSION['password'] = "abc";
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);

  $con->query("USE ".$conf_arr['database'].";");

  //Checking if there are login credentials
  if(isset($_POST['emp_num']) && isset($_POST['password']))
  {
    $query = "SELECT * FROM employee WHERE emp_num = ".$_POST['emp_num']." AND emp_passwd = '".hash("sha512", $_POST['emp_num'].$_POST['password'])."';";
    $res = $con->query($query);
    if ($res->num_rows == 1)
    {
      $_SESSION['emp_num'] = $_POST['emp_num'];
      $_SESSION['password'] = hash("sha512", $_POST['emp_num'].$_POST['password']);
    }
  }

  if(isset($_SESSION['emp_num']) && isset($_SESSION['password']))
  {
    echo "{ \"all_data\":";
    require("get_all.php");
    echo ", \"user_data\":";
    require("get_user.php");
    echo "}";
  }
  else
  {
    //echo "You are not authorized to see this.";
    var_dump($_POST);
  } 
?>
