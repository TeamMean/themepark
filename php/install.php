<?php

  $conf_arr = parse_ini_file("../../database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  echo $con->error;
  //Drop the existing database
  $query = "DROP DATABASE IF EXISTS ".$conf_arr['database'].";";
  $con->query($query);
  echo $con->error;
  //Recreate the database
  $query = "CREATE DATABASE IF NOT EXISTS ".$conf_arr['database'].";";
  $con->query($query);
  echo $con->error;
  //Use the newly created database
  $query = "USE ".$conf_arr['database'].";";
  $con->query($query);
  echo $con->error;
  //Create the new table themepark
  $query = "CREATE TABLE IF NOT EXISTS themepark (
    park_code	VARCHAR(10) PRIMARY KEY,
    park_name	VARCHAR(35) NOT NULL,
    park_city	VARCHAR(50) NOT NULL,
    park_country	CHAR(2) NOT NULL)
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);
  echo $con->error;
  //Create the employee table
  $query = "CREATE TABLE IF NOT EXISTS employee (
    emp_num		INT AUTO_INCREMENT PRIMARY KEY,
    emp_title	VARCHAR(4),
    emp_lname	VARCHAR(15) NOT NULL,
    emp_fname	VARCHAR(15) NOT NULL,
    emp_dob		DATE NOT NULL,
    emp_hire_date	DATE,
    emp_area_code	VARCHAR(4) NOT NULL,
    emp_phone	VARCHAR(12) NOT NULL,
    emp_passwd	VARCHAR(128) NOT NULL,
    emp_priv	INT(1) NOT NULL)
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);
  echo $con->error;
  //Create the ticket table
  $query = "CREATE TABLE IF NOT EXISTS ticket (
    ticket_no 	INT AUTO_INCREMENT PRIMARY KEY,
    ticket_price 	FLOAT DEFAULT 0.00 NOT NULL,
    ticket_type	VARCHAR(10),
    emp_num INT,
    park_code	VARCHAR(10),
    CONSTRAINT 	FK_ticket_park FOREIGN KEY(park_code) REFERENCES themepark(park_code),
    CONSTRAINT	FK_ticket_employee FOREIGN KEY (emp_num) REFERENCES employee(emp_num))
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);
  echo $con->error;
  //Create the attraction table
  $query = "CREATE TABLE IF NOT EXISTS attraction (
    attract_no 	INT AUTO_INCREMENT PRIMARY KEY,
    attract_name	VARCHAR(35),
    attract_age	INT DEFAULT 0 NOT NULL,
    attract_capacity INT NOT NULL,
    park_code	VARCHAR(10),
    CONSTRAINT 	FK_attract_park FOREIGN KEY(park_code) REFERENCES themepark(park_code))
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);
  echo $con->error;
  //Create the hours table
  $query = "CREATE TABLE IF NOT EXISTS hours (
    emp_num		INT,
    attract_no 	INT,
    hours_per_attract	INT NOT NULL,
    hour_rate	FLOAT NOT NULL,
    date_worked	DATE NOT NULL,
    CONSTRAINT	PK_hours PRIMARY KEY(emp_num, attract_no, date_worked),
    CONSTRAINT 	FK_hours_emp  FOREIGN KEY   (emp_num) REFERENCES employee(emp_num),
    CONSTRAINT	FK_hours_attract FOREIGN KEY (attract_no) REFERENCES attraction(attract_no))
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);

  //Create the individual themeparks
  $query = "INSERT INTO themepark VALUES ('FR1001','FairyLand','PARIS','FR'), ('NL1202','Efling','NOORD','NL'), ('SP4533','AdventurePort','BARCELONA','SP'), ('SW2323','Labyrinthe','LAUSANNE','SW'), ('UK2622','MiniLand','WINDSOR','UK'), ('UK3452','PleasureLand','STOKE','UK'), ('ZA1342','GoldTown','JOHANNESBURG','ZA');";
  $con->query($query);

  //Create the employees
  $query = "INSERT INTO employee VALUES (100,'Ms','Calderdale','Emma',STR_TO_DATE('15-Jun-72','%d-%b-%Y'),STR_TO_DATE('15-Mar-92','%d-%b-%Y'),'0181','324-9134', '".hash('sha512', '100password')."', 2), (101,'Ms','Ricardo','Marshel',STR_TO_DATE('19-Mar-78','%d-%b-%Y'),STR_TO_DATE('25-Apr-96','%d-%b-%Y'),'0181','324-4472', '".hash('sha512', '101password')."', 1), (102,'Mr','Arshad','Arif',STR_TO_DATE('14-Nov-69','%d-%b-%Y'),STR_TO_DATE('20-Dec-90','%d-%b-%Y'),'7253','675-8993', '".hash('sha512', '102password')."', 1), (103,'Ms','Roberts','Anne',STR_TO_DATE('16-Oct-74','%d-%b-%Y'),STR_TO_DATE('16-Aug-94','%d-%b-%Y'),'0181','898-3456', '".hash('sha512', '103password')."', 1), (104,'Mr','Denver','Enrica',STR_TO_DATE('08-Nov-80','%d-%b-%Y'),STR_TO_DATE('20-Oct-01','%d-%b-%Y'),'7253','504-4434', '".hash('sha512', '104password')."', 1), (105,'Ms','Namowa','Mirrelle',STR_TO_DATE('14-Mar-90','%d-%b-%Y'),STR_TO_DATE('08-Nov-06','%d-%b-%Y'),'0181','890-3243', '".hash('sha512', '105password')."', 1), (106,'Mrs','Smith','Gemma',STR_TO_DATE('12-Feb-68','%d-%b-%Y'),STR_TO_DATE('05-Jan-89','%d-%b-%Y'),'0181','324-7845', '".hash('sha512', '106password')."', 1);";
  $con->query($query);

  //Create the tickets
  $query = "INSERT INTO ticket VALUES (4668,24.99,'Adult', 106, 'SP4533'), (13001,14.99,'Child', 100, 'FR1001'), (13002,34.99,'Adult', 100, 'FR1001'), (13003,34.99,'Adult', 103, 'FR1001'), (18721,14.99,'Child', 103, 'FR1001'), (18722,14.99,'Child', 103, 'FR1001'), (18723,20.99,'Senior', 104, 'FR1001'), (18724,34.99,'Adult', 102, 'FR1001'), (32450,24.99,'Adult', 102, 'SP4533'), (45767,24.99,'Adult', 101, 'SP4533'), (67832,18.56,'Child', 105, 'ZA1342'), (67833,28.67,'Adult', 105, 'ZA1342'), (67855,18.56,'Child', 101, 'ZA1342'), (88567,22.50,'Child', 102, 'UK3452'), (88568,42.10,'Adult', 100, 'UK3452'), (89720,22.50,'Child', 102, 'UK3452'), (89723,22.50,'Child', 102, 'UK3452'), (89725,22.50,'Child', 102, 'UK3452'), (89728,42.10,'Adult', 102, 'UK3452')";
  $con->query($query);

  //Create the attractions
  $query = "INSERT INTO attraction VALUES (10034,'ThunderCoaster',11,34,'FR1001'), (10056,'SpinningTeacups',4,62,'FR1001'), (10067,'FlightToStars',11,24,'FR1001'), (10078,'Ant-Trap',23,30,'FR1001'), (10098,'Carnival',3,120,'FR1001'), (20056,'3D-Lego_Show',3,200,'UK2622'), (30011,'BlackHole2',12,34,'UK3452'), (30012,'Pirates',10,42,'UK3452'), (30044,'UnderSeaWord',4,80,'UK3452'), (98764,'GoldRush',5,80,'ZA1342');";
  $con->query($query);

  //Create the Jobs
  $query = "INSERT INTO hours VALUES (100,10034,6,6.5,STR_TO_DATE('18-May-2007','%d-%b-%Y')), (100,10034,6,6.5,STR_TO_DATE('20-May-2007','%d-%b-%Y')), (101,10034,6,6.5,STR_TO_DATE('18-May-2007','%d-%b-%Y')), (102,30012,3,5.99,STR_TO_DATE('23-May-2007','%d-%b-%Y')), (102,30044,6,5.99,STR_TO_DATE('22-May-2007','%d-%b-%Y')), (102,30044,3,5.99,STR_TO_DATE('23-May-2007','%d-%b-%Y')), (104,30011,6,7.2,STR_TO_DATE('21-May-2007','%d-%b-%Y')), (104,30012,6,7.2,STR_TO_DATE('22-May-2007','%d-%b-%Y')), (105,10078,3,8.5,STR_TO_DATE('18-May-2007','%d-%b-%Y')), (105,10098,3,8.5,STR_TO_DATE('18-May-2007','%d-%b-%Y')), (105,10098,6,8.5,STR_TO_DATE('19-May-2007','%d-%b-%Y'));";
  $con->query($query);


  $result = $con->query("SELECT * FROM employee;");
  $ret = [];
  while($row = $result->fetch_assoc())
  {
    $ret[] = $row;
  }
  echo json_encode($ret);
?>
