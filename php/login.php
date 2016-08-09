<?php
  session_start();
  $_SESSION['emp_num'] = 101;
  $_SESSION['password'] = "abc";
//  if(isset($_SESSION['emp_num']) && isset($_SESSION['password']))
//  {
    echo "{ \"all_data\":";
    require("get_all.php");
    echo ", \"user_data\":";
    require("get_user.php");
    echo "}";
/*  }
  else
  {
    if(isset($_POST['emp_num']) && isset($_POST['password']))
    {
      echo "Loggining in...";
    }
    else
    {
      echo "You are not authorized to see this.";
    }
  }*/ 
?>
