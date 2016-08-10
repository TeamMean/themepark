<?php
  $data = json_decode(file_get_contents("php://input"));
  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  $con->query("USE ".$conf_arr['database'].";");
  echo date($data->{"emp_dob"});
  for($i = 0; $i < $data->{"adults"}->{"quantity"}; $i++) 
  {
    $query = "INSERT INTO ticket(ticket_price, ticket_type, emp_num, park_code) VALUES (".$data->{"adults"}->{"price"}.", 'Adult', ".$data->{"emp_num"}.", '".$data->{"park_code"}."');";
    echo $query;
    $con->query($query);
  }
  for($i = 0; $i < $data->{"children"}->{"quantity"}; $i++)
  {
    $query = "INSERT INTO ticket(ticket_price, ticket_type, emp_num, park_code) VALUES (".$data->{"children"}->{"price"}.", 'Child', ".$data->{"emp_num"}.", '".$data->{"park_code"}."');";
    echo $query;
    $con->query($query);
  }

  for($i = 0; $i < $data->{"seniors"}->{"quantity"}; $i++)
  {
    $query = "INSERT INTO ticket(ticket_price, ticket_type, emp_num, park_code) VALUES (".$data->{"seniors"}->{"price"}.", 'Senior', ".$data->{"emp_num"}.", '".$data->{"park_code"}."');";
    echo $query;
    $con->query($query);
  }



#  echo $query;
#  $con->query($query);

  echo $con->error;
?>
