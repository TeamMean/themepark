<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");
  echo date($data->{"emp_dob"});
  $query = "INSERT INTO employee VALUES (".$data->{"emp_num"}.", '".$data->{"emp_title"}."', '".$data->{"emp_lname"}."', '".$data->{"emp_fname"}."', '".date($data->{"emp_dob"})."', '".date($data->{"emp_hire_date"})."', '".$data->{"emp_area_code"}."', '".$data->{"emp_phone"}."', '".hash("sha512", $data->{"emp_num"}.$data->{"emp_password"})."', 1);";

  echo $query;
  $con->query($query);

  echo $con->error;
?>
