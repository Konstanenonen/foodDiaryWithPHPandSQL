CREATE DATABASE fooddiary_db;

-- Table structure for table user
CREATE TABLE users (
  userid int NOT NULL AUTO_INCREMENT,
  username varchar(16) NOT NULL,
  password varchar(255) NOT NULL,
  PRIMARY KEY (userid)
);
CREATE TABLE breakfast (
  bDate varchar(32) NOT NULL,
  bTime varchar(32) NOT NULL,
  bDish varchar(32) NOT NULL,
  bDrink varchar(32) NOT NULL,
  userid int NOT NULL,
  CONSTRAINT PK_breakfast PRIMARY KEY (bDate,bTime,userid)
);
CREATE TABLE lunch (
  lunchDate varchar(32) NOT NULL,
  lunchTime varchar(32) NOT NULL,
  lunchDish varchar(32) NOT NULL,
  lunchDrink varchar(32) NOT NULL,
  userid int NOT NULL,
  CONSTRAINT PK_lunch PRIMARY KEY (lunchDate,lunchTime,userid)
);
CREATE TABLE dinner (
  dinnerDate varchar(32) NOT NULL,
  dinnerTime varchar(32) NOT NULL,
  dinnerDish varchar(32) NOT NULL,
  dinnerDrink varchar(32) NOT NULL,
  userid int NOT NULL,
  CONSTRAINT PK_dinner PRIMARY KEY (dinnerDate,dinnerTime,userid)
);

INSERT INTO users VALUES (1, 'Ben', '02360');
INSERT INTO users VALUES (2, 'Alex', '01600');
INSERT INTO users VALUES (3, 'Li', '03573');
INSERT INTO users VALUES (4, 'Andreas', '04260');
INSERT INTO users VALUES (5, 'Charlotte', '03920');

INSERT INTO breakfast VALUES ('21.2.2021', '7.15', 'Bread', 'cocacola', 1);
INSERT INTO breakfast VALUES ('22.2.2021', '7.12', 'Eggs', 'pepsi', 2);
INSERT INTO breakfast VALUES ('23.2.2021', '7.20', 'Cereals', 'juice', 3);
INSERT INTO breakfast VALUES ('24.2.2021', '7.30', 'Pies', 'pepsimax', 4);
INSERT INTO breakfast VALUES ('25.2.2021', '7.40', 'Chicken', 'whiskey', 5);

INSERT INTO lunch VALUES ('21.2.2021', '12.15', 'Bread', 'cocacola', 1);
INSERT INTO lunch VALUES ('22.2.2021', '11.12', 'Eggs', 'pepsi', 2);
INSERT INTO lunch VALUES ('23.2.2021', '10.20', 'Cereals', 'juice', 3);
INSERT INTO lunch VALUES ('24.2.2021', '11.30', 'Pies', 'pepsimax', 4);
INSERT INTO lunch VALUES ('25.2.2021', '11.40', 'Chicken', 'whiskey', 5);

INSERT INTO dinner VALUES ('21.2.2021', '16.15', 'Bread', 'cocacola', 1);
INSERT INTO dinner VALUES ('22.2.2021', '17.12', 'Eggs', 'pepsi', 2);
INSERT INTO dinner VALUES ('23.2.2021', '16.20', 'Cereals', 'juice', 3);
INSERT INTO dinner VALUES ('24.2.2021', '18.30', 'Pies', 'pepsimax', 4);
INSERT INTO dinner VALUES ('25.2.2021', '19.40', 'Chicken', 'whiskey', 5);