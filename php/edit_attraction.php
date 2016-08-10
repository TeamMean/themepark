<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");

  $query = "UPDATE attraction SET attract_name = '".$data->{"attract_name"}."', attract_age = ".$data->{"attract_age"}.", attract_capacity = ".$data->{"attract_capacity"}." WHERE attract_no = ".$data->{'attract_no'}.";";

#  echo "Hello";
  $con->query($query);

  echo $con->error;
?>
