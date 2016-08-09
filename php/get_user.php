<?php
  session_start();
  if(!isset($_SESSION['emp_num']) || !isset($_SESSION['password']))
  {
    echo json_encode([]);
  }
  else
  {
    $conf_arr = parse_ini_file("../../database.ini");
    $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
    echo $con->error;

    $con->query("USE ".$conf_arr['database']);

    $collections = [];

    //Temporary storage variable
    $collection_curr = [];

    //For storing the tickets
    $collection_tk = [];
    //For storing the hours
    $collection_hr = [];
    //For storing the employees
    $collection_em = [];

    //Getting the ticket data  
    $collection_curr = [];
    $res = $con->query("SELECT * FROM ticket LEFT JOIN themepark ON ticket.park_code = themepark.park_code LEFT JOIN employee ON employee.emp_num = ticket.emp_num WHERE ticket.emp_num=".$_SESSION['emp_num'].";");
    while($row = $res->fetch_assoc())
    {
      $collection_curr[] = $row;
    }

    $collection_tk['name'] = "ticket";
    $collection_tk['data'] = $collection_curr;

    //Getting all hours data
    $collection_curr = [];
    $res = $con->query("SELECT * FROM hours JOIN employee ON employee.emp_num = hours.emp_num JOIN attraction ON attraction.attract_no = hours.attract_no JOIN themepark ON themepark.park_code = attraction.park_code WHERE employee.emp_num = ".$_SESSION['emp_num'].";");
    while($row = $res->fetch_assoc())
    {
      $row['emp_passwd'] = "";
      $collection_curr[] = $row;
    }

    $collection_hr['name'] = "hours";
    $collection_hr['data'] = $collection_curr;

    //Getting all employees
    $collection_curr = [];
    $res = $con->query("SELECT * FROM employee WHERE employee.emp_num = ".$_SESSION['emp_num'].";");
    while($row = $res->fetch_assoc())
    {
      $row['emp_passwd'] = "";
      $collection_curr[] = $row;
    }

    $collection_em['name'] = "employee";
    $collection_em['data'] = $collection_curr;

    $collections[] = $collection_tk;
    $collections[] = $collection_hr;
    $collections[] = $collection_em;
  
    echo json_encode($collections);
  }
?>
