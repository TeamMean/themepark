<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");

  $query = "UPDATE employee SET emp_title = '".$data->{"emp_title"}."', emp_lname = '".$data->{"emp_lname"}."', emp_fname = '".$data->{"emp_fname"}."', emp_area_code = '".$data->{"emp_area_code"}."', emp_phone = '".$data->{"emp_phone"}."', emp_passwd = '".hash("sha512", $json->{"emp_num"}.$json->{"emp_passwd"})."' WHERE emp_num = ".$data->{'emp_num'}.";";

  if($data->{"emp_passwd"} == $data->{"emp_confirm"})
  {
    $con->query($query);
  }

  echo $con->error;
?>
