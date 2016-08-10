<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");

  $query = "UPDATE themepark SET park_name = '".$data->{"park_name"}."', park_city = '".$data->{"park_city"}."', park_country = '".$data->{"park_country"}."' WHERE park_code = '".$data->{'park_code'}."';";

  echo $query;
  $con->query($query);

  echo $con->error;
?>
