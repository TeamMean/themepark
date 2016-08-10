<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");

  $query = "UPDATE hours SET date_worked = '".date($data->{"date_worked"})."', hour_rate = ".$data->{"hour_rate"}.", hours_per_attract = ".$data->{"hours_per_attract"}." WHERE emp_num = ".$data->{"emp_num"}." AND attract_no = ".$data->{"attract_no"}.";";

  echo $query;
  $con->query($query);

  echo $con->error;
?>
