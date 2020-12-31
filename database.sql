CREATE DATABASE IF NOT EXISTS hotel;

USE hotel;

CREATE TABLE user(
    id_user INT(255),
    name_user VARCHAR(100) NOT NULL,
    lastname_user VARCHAR(150) NOT NULL,
    gender_user VARCHAR(50) NOT NULL,
    birthdate DATE NOT NULL,
    email_user VARCHAR(255) NOT NULL,
    password_user VARCHAR(255) NOT NULL,

    CONSTRAINT pk_user PRIMARY KEY (id_user)
)ENGINE=InnoDB;