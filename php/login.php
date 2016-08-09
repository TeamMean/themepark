<?php
  session_start();
//  if(isset($_SESSION['emp_num']) && isset($_SESSION['password']))
//  {
    echo "{ \"all_data\":";
    require("get_all.php");
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
  }* 
?>
