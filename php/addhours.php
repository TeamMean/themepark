<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");
  echo date($data->{"emp_dob"});
  $query = "INSERT INTO hours VALUES (".$data->{"emp_num"}.", ".$data->{"attract_no"}.", ".$data->{"hours_per_attract"}.", ".$data->{"hour_rate"}.", '".date($data->{"date_worked"})."');";

  echo $query;
  $con->query($query);

  echo $con->error;
?>
