<?php
  session_start();
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);

  $con->query("USE ".$conf_arr['database'].";");

  //Checking if there are login credentials
  if($data->{'emp_num'} && $data->{'password'})
  {
    $query = "SELECT * FROM employee WHERE emp_num = ".$data->{'emp_num'}." AND emp_passwd = '".hash("sha512", $data->{'emp_num'}.$data->{'password'})."';";
    $res = $con->query($query);
    if ($res->num_rows == 1)
    {
      $row = $res->fetch_assoc();
      $_SESSION['emp_num'] = $row['emp_num'];
      $_SESSION['password'] = $row['emp_passwd'];
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
    var_dump($data);
  } 
?>
