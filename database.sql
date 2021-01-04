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
    image_user VARCHAR(255),
    role_user VARCHAR(100),

    CONSTRAINT pk_user PRIMARY KEY (id_user)
)ENGINE=InnoDB;

CREATE TABLE IF NOT EXISTS extra(
    id_extra INT(255),
    name_extra VARCHAR(150),

    CONSTRAINT pk_extra PRIMARY KEY (id_extra)
)ENGINE=InnoDB;


CREATE TABLE IF NOT EXISTS room(
    id_room INT(255) AUTO_INCREMENT,
    name_room VARCHAR(150) NOT NULL,
    description_room TEXT,
    size_room INT(50),
    price_room FLOAT(50, 2),
    extra_room VARCHAR(255),
    image_room VARCHAR(255),

    CONSTRAINT pk_room PRIMARY KEY (id_room)
)ENGINE=InnoDB;



CREATE TABLE IF NOT EXISTS payment(
    id_payment INT(255) AUTO_INCREMENT,
    card_number VARCHAR(255) NOT NULL,
    expiration_date VARCHAR(50) NOT NULL,
    cvv_number VARCHAR(3) NOT NULL,
    user_id INT(255) NOT NULL,

    CONSTRAINT pk_payment PRIMARY KEY (id_payment),
    CONSTRAINT fk_user FOREIGN KEY (user_id) REFERENCES user(id_user)
);

CREATE TABLE IF NOT EXISTS reservation(
    id_reservation INT(255) AUTO_INCREMENT,
    room_id INT(255) NOT NULL,
    payment_id INT(255) NOT NULL,

    CONSTRAINT pk_reservation PRIMARY KEY (id_reservation),
    CONSTRAINT fk_room FOREIGN KEY (room_id) REFERENCES room(id_room),
    CONSTRAINT fk_payment FOREIGN KEY (payment_id) REFERENCES pay(id_payment)
);