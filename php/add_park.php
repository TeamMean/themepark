<?php
  $data = json_decode(file_get_contents("php://input"));
  echo "{\"all_data\":";
  require("get_all.php");
  echo ", \"user_data\":";
  require("get_user.php");
  echo "}";
?>
