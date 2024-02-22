DROP DATABASE IF EXISTS student_db;

CREATE DATABASE student_db;

USE student_db;

CREATE TABLE student (
     id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
     student_name VARCHAR(240),
     student_number INT,
     student_age INT
     );

INSERT INTO student (student_name, student_number, student_age) VALUES
('John Doe', 1001, 20),
('Jane Smith', 1002, 22),
('Mike Johnson', 1003, 19),
('Emily Davis', 1004, 21),
('David Wilson', 1005, 23);