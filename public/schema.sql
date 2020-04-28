-- DROP TABLE IF EXISTS chal.question;
-- DROP TABLE IF EXISTS chal.answer;
-- DROP DATABASE IF EXISTS chal;

CREATE DATABASE chal;
use chal;

CREATE TABLE question (
  id int NOT NULL AUTO_INCREMENT,
  text varchar(100) NOT NULL,
  PRIMARY KEY (id)
);

CREATE TABLE answer (
  id int NOT NULL AUTO_INCREMENT,
  text varchar(100) NOT NULL,
  qid int,
  PRIMARY KEY (id),
  FOREIGN KEY (qid) REFERENCES question(id)
);