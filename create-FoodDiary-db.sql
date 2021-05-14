CREATE DATABASE fooddiary7_db;

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
CREATE TABLE Dinner (
  dinnerDate varchar(32) NOT NULL,
  dinnerTime varchar(32) NOT NULL,
  dinnerDish varchar(32) NOT NULL,
  dinnerDrink varchar(32) NOT NULL,
  userid int NOT NULL,
  CONSTRAINT PK_dinner PRIMARY KEY (dinnerDate,dinnerTime,userid)
);

