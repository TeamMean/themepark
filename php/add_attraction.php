<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");

  $query = "INSERT INTO attraction VALUES (".$data->{"attract_no"}.", '".$data->{"attract_name"}."', ".$data->{"attract_age"}.", ".$data->{"attract_capacity"}.", '".$data->{"park_code"}."');";
#  echo $query;
  $con->query($query);
  echo $con->error;
  echo "{\"all_data\":";
  require("get_all.php");
  echo ", \"user_data\":";
  require("get_user.php");
  echo "}";
?>
