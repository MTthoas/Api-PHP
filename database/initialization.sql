DROP DATABASE IF EXISTS `TP-Sujet`;

CREATE DATABASE `TP-Sujet` CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;

CREATE TABLE users(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    email VARCHAR(50) NOT NULL UNIQUE,
    role VARCHAR(20) NOT NULL,
    password VARCHAR(255) NOT NULL,
    token CHAR(32) NULL DEFAULT, 
);

CREATE TABLE rooms(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    name VARCHAR(50) NOT NULL,
    description TEXT NOT NULL
);

CREATE TABLE messages(
    id INT NOT NULL PRIMARY KEY AUTO_INCREMENT,
    body TEXT NOT NULL,
    timestamp TIMESTAMP NOT NULL,
    userId INT NOT NULL REFERENCES users(id),
    roomId INT NOT NULL REFERENCES rooms(id)
);

INSERT INTO users(role, email, password) VALUES('USER','john@doe.com', 'password');
INSERT INTO users(role, email, password) VALUES('ADMINISTRATOR','sananes@doe.com', 'password');

INSERT INTO room()