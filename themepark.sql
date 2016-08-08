-- themepark.SQL
-- Introduction to SQL
-- Script file for MySQL  DBMS
-- This script file creates the following tables:
-- themepark, employee, ticket, attraction, hours
-- and loads the default data rows

CREATE DATABASE themepark;
USE themepark;

DROP TABLE IF EXISTS hours;
DROP TABLE IF EXISTS attraction;
DROP TABLE IF EXISTS ticket;
DROP TABLE IF EXISTS employee;
DROP TABLE IF EXISTS themepark;

CREATE TABLE IF NOT EXISTS themepark (
park_code	VARCHAR(10) PRIMARY KEY,
park_name	VARCHAR(35) NOT NULL,
park_city	VARCHAR(50) NOT NULL,
park_country	CHAR(2) NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

CREATE TABLE IF NOT EXISTS employee (
emp_num		INT AUTO_INCREMENT PRIMARY KEY,
emp_title	VARCHAR(4),
emp_lname	VARCHAR(15) NOT NULL,
emp_fname	VARCHAR(15) NOT NULL,
emp_dob		DATE NOT NULL,
emp_hire_date	DATE,
emp_area_code	VARCHAR(4) NOT NULL,
emp_phone	VARCHAR(12) NOT NULL)
ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

CREATE TABLE IF NOT EXISTS ticket (
ticket_no 	INT AUTO_INCREMENT PRIMARY KEY,
ticket_price 	FLOAT DEFAULT 0.00 NOT NULL,
ticket_type	VARCHAR(10),
park_code	VARCHAR(10),
CONSTRAINT 	FK_ticket_park FOREIGN KEY(park_code) REFERENCES themepark(park_code))
ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

CREATE TABLE IF NOT EXISTS attraction (
attract_no 	INT AUTO_INCREMENT PRIMARY KEY,
attract_name	VARCHAR(35),
attract_age	INT DEFAULT 0 NOT NULL,
attract_capacity INT NOT NULL,
park_code	VARCHAR(10),
CONSTRAINT 	FK_attract_park FOREIGN KEY(park_code) REFERENCES themepark(park_code))
ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

CREATE TABLE IF NOT EXISTS hours (
emp_num		INT,
attract_no 	INT,
hours_per_attract	INT NOT NULL,
hour_rate	FLOAT NOT NULL,
date_worked	DATE NOT NULL,
CONSTRAINT	PK_hours PRIMARY KEY(emp_num, attract_no, date_worked),
CONSTRAINT 	FK_hours_emp  FOREIGN KEY   (emp_num) REFERENCES employee(emp_num),
CONSTRAINT	FK_hours_attract FOREIGN KEY (attract_no) REFERENCES attraction(attract_no))
ENGINE=InnoDB DEFAULT CHARSET=utf32 COLLATE=utf32_bin;

-- Loading data rows
-- Default escape character "\"
-- Used to enter special characters (&)


-- themepark rows
INSERT INTO themepark VALUES ('FR1001','FairyLand','PARIS','FR');
INSERT INTO themepark VALUES ('NL1202','Efling','NOORD','NL');
INSERT INTO themepark VALUES ('SP4533','AdventurePort','BARCELONA','SP');
INSERT INTO themepark VALUES ('SW2323','Labyrinthe','LAUSANNE','SW');
INSERT INTO themepark VALUES ('UK2622','MiniLand','WINDSOR','UK');
INSERT INTO themepark VALUES ('UK3452','PleasureLand','STOKE','UK');
INSERT INTO themepark VALUES ('ZA1342','GoldTown','JOHANNESBURG','ZA');

-- employee rows
INSERT INTO employee VALUES (100,'Ms','Calderdale','Emma',STR_TO_DATE('15-Jun-72','%d-%b-%Y'),STR_TO_DATE('15-Mar-92','%d-%b-%Y'),'0181','324-9134');
INSERT INTO employee VALUES (101,'Ms','Ricardo','Marshel',STR_TO_DATE('19-Mar-78','%d-%b-%Y'),STR_TO_DATE('25-Apr-96','%d-%b-%Y'),'0181','324-4472');
INSERT INTO employee VALUES (102,'Mr','Arshad','Arif',STR_TO_DATE('14-Nov-69','%d-%b-%Y'),STR_TO_DATE('20-Dec-90','%d-%b-%Y'),'7253','675-8993');
INSERT INTO employee VALUES (103,'Ms','Roberts','Anne',STR_TO_DATE('16-Oct-74','%d-%b-%Y'),STR_TO_DATE('16-Aug-94','%d-%b-%Y'),'0181','898-3456');
INSERT INTO employee VALUES (104,'Mr','Denver','Enrica',STR_TO_DATE('08-Nov-80','%d-%b-%Y'),STR_TO_DATE('20-Oct-01','%d-%b-%Y'),'7253','504-4434');
INSERT INTO employee VALUES (105,'Ms','Namowa','Mirrelle',STR_TO_DATE('14-Mar-90','%d-%b-%Y'),STR_TO_DATE('08-Nov-06','%d-%b-%Y'),'0181','890-3243');
INSERT INTO employee VALUES (106,'Mrs','Smith','Gemma',STR_TO_DATE('12-Feb-68','%d-%b-%Y'),STR_TO_DATE('05-Jan-89','%d-%b-%Y'),'0181','324-7845');


-- ticket rows
INSERT INTO ticket VALUES (4668,24.99,'Adult','SP4533');
INSERT INTO ticket VALUES (13001,14.99,'Child','FR1001');
INSERT INTO ticket VALUES (13002,34.99,'Adult','FR1001');
INSERT INTO ticket VALUES (13003,34.99,'Adult','FR1001');
INSERT INTO ticket VALUES (18721,14.99,'Child','FR1001');
INSERT INTO ticket VALUES (18722,14.99,'Child','FR1001');
INSERT INTO ticket VALUES (18723,20.99,'Senior','FR1001');
INSERT INTO ticket VALUES (18724,34.99,'Adult','FR1001');
INSERT INTO ticket VALUES (32450,24.99,'Adult','SP4533');
INSERT INTO ticket VALUES (45767,24.99,'Adult','SP4533');
INSERT INTO ticket VALUES (67832,18.56,'Child','ZA1342');
INSERT INTO ticket VALUES (67833,28.67,'Adult','ZA1342');
INSERT INTO ticket VALUES (67855,18.56,'Child','ZA1342');
INSERT INTO ticket VALUES (88567,22.50,'Child','UK3452');
INSERT INTO ticket VALUES (88568,42.10,'Adult','UK3452');
INSERT INTO ticket VALUES (89720,22.50,'Child','UK3452');
INSERT INTO ticket VALUES (89723,22.50,'Child','UK3452');
INSERT INTO ticket VALUES (89725,22.50,'Child','UK3452');
INSERT INTO ticket VALUES (89728,42.10,'Adult','UK3452');

-- attraction rows

INSERT INTO attraction VALUES (10034,'ThunderCoaster',11,34,'FR1001');
INSERT INTO attraction VALUES (10056,'SpinningTeacups',4,62,'FR1001');
INSERT INTO attraction VALUES (10067,'FlightToStars',11,24,'FR1001');
INSERT INTO attraction VALUES (10078,'Ant-Trap',23,30,'FR1001');
INSERT INTO attraction VALUES (10098,'Carnival',3,120,'FR1001');
INSERT INTO attraction VALUES (20056,'3D-Lego_Show',3,200,'UK2622');
INSERT INTO attraction VALUES (30011,'BlackHole2',12,34,'UK3452');
INSERT INTO attraction VALUES (30012,'Pirates',10,42,'UK3452');
INSERT INTO attraction VALUES (30044,'UnderSeaWord',4,80,'UK3452');
INSERT INTO attraction VALUES (98764,'GoldRush',5,80,'ZA1342');


-- hours rows

INSERT INTO hours VALUES (100,10034,6,6.5,STR_TO_DATE('18-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (100,10034,6,6.5,STR_TO_DATE('20-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (101,10034,6,6.5,STR_TO_DATE('18-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (102,30012,3,5.99,STR_TO_DATE('23-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (102,30044,6,5.99,STR_TO_DATE('22-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (102,30044,3,5.99,STR_TO_DATE('23-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (104,30011,6,7.2,STR_TO_DATE('21-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (104,30012,6,7.2,STR_TO_DATE('22-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (105,10078,3,8.5,STR_TO_DATE('18-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (105,10098,3,8.5,STR_TO_DATE('18-May-2007','%d-%b-%Y'));
INSERT INTO hours VALUES (105,10098,6,8.5,STR_TO_DATE('19-May-2007','%d-%b-%Y'));

