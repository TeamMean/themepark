<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");

  $query = "INSERT INTO themepark VALUES ('".$data->{"park_code"}."', '".$data->{"park_name"}."', '".$data->{"park_city"}."', '".$data->{"park_country"}."');";
#  echo $query;
  $con->query($query);
  echo $con->error;
  echo "{\"all_data\":";
  require("get_all.php");
  echo ", \"user_data\":";
  require("get_user.php");
  echo "}";
?>
