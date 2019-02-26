DROP DATABASE IF EXISTS todo;
CREATE DATABASE todo;

USE todo;

DROP TABLE IF EXISTS project;

CREATE TABLE project (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  PRIMARY KEY(id)
);

DROP TABLE IF EXISTS task;

CREATE TABLE task (
  id int NOT NULL AUTO_INCREMENT,
  name varchar(255) NOT NULL,
  todo_at datetime,
  id_project int NOT NULL,
  PRIMARY KEY(id),
  FOREIGN KEY (id_project) REFERENCES project (id)
    ON UPDATE CASCADE ON DELETE CASCADE
);


DROP TABLE IF EXISTS noticia;

CREATE TABLE noticia (
  id int NOT NULL AUTO_INCREMENT,
  titulo varchar(255) NOT NULL,
  texto varchar(255) NOT NULL,
  fecha date NOT NULL,
  PRIMARY KEY(id)
);
