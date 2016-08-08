<?php

  $conf_arr = parse_ini_file("database.ini");
  $con = new mysqli("localhost", $conf_arr['user'], $conf_arr['password']);
  //Drop the existing database
  $query = "DROP DATABASE IF EXISTS ".$conf_arr['database'].";";
  $con->query($query);
  //Recreate the database
  $query = "CREATE DATABASE IF NOT EXISTS ".$conf_arr['database'].";";
  $con->query($query);
  //Use the newly created database
  $query = "USE ".$conf_arr['database'].";";
  $con->query($query);

  //Create the new table themepark
  $query = "CREATE TABLE IF NOT EXISTS themepark (
    park_code	VARCHAR(10) PRIMARY KEY,
    park_name	VARCHAR(35) NOT NULL,
    park_city	VARCHAR(50) NOT NULL,
    park_country	CHAR(2) NOT NULL)
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);
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
  //Create the ticket table
  $query = "CREATE TABLE IF NOT EXISTS ticket (
    ticket_no 	INT AUTO_INCREMENT PRIMARY KEY,
    ticket_price 	FLOAT DEFAULT 0.00 NOT NULL,
    ticket_type	VARCHAR(10),
    park_code	VARCHAR(10),
    CONSTRAINT 	FK_ticket_park FOREIGN KEY(park_code) REFERENCES themepark(park_code))
  ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;";
  $con->query($query);
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

  $query = "";
  $con->query($query);
?>
