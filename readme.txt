/////////// Создать базу данных 
CREATE DATABASE RENTGEN

/////////// создаем пользователя с паролем и даём доступ к базе
GRANT ALL PRIVILEGES ON `RENTGEN`.* TO `rentgen_user`@`localhost` IDENTIFIED BY '!2Htynuty3!';

или

CREATE USER 'rentgen_user'@'localhost' IDENTIFIED BY 'YfhrjLbcgfycth39!';
GRANT ALL PRIVILEGES ON 'RENTGEN'.* TO 'rentgen_user'@'localhost'


/////////////////  Таблица пользователей
CREATE TABLE users(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
	login VARCHAR(255) NOT NULL,
     	SURNAME VARCHAR(255) NOT NULL,LASTNAME VARCHAR(255) NOT NULL,FIRSTNAME VARCHAR(255) NOT NULL,BIRTHDATE DATE NOT NULL,
	ADRES  VARCHAR(255),
	AGENT_ID INT(22),
	PID INT(22),
	Password varchar(255),
	enable tinyint(1) not null,
	group_id int(11) not null,
     PRIMARY KEY (id)
);

/////////////////  Таблица врачей
CREATE TABLE employers(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     SURNAME VARCHAR(255) NOT NULL,LASTNAME VARCHAR(255) NOT NULL,FIRSTNAME VARCHAR(255) NOT NULL,BIRTHDATE DATE NOT NULL,
	AGENT_ID INT(22),PID INT(22),enable tinyint(1) not null,
     PRIMARY KEY (id)
);

/////////////////  Таблица групп пользователей
CREATE TABLE groups(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
     name VARCHAR(255) NOT NULL,
	level tinyint(1)not null,enable tinyint(1) not null,
     PRIMARY KEY (id)
);

/////////////////  Таблица журнал рентген
CREATE TABLE jurnal(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
	regdate datetime not null,
	PID INT(22)not null,
	EMP_ID INT(22)not null,
	EMP INT(22)not null,
	comm VARCHAR(255) NOT NULL,
	dop text NOT NULL,
	enable tinyint(1) not null,
	cnt_ph INT(22)not null,
	spr_id INT(22)not null,
	spr_id2 INT(22)not null,
     PRIMARY KEY (id)
);

/////////////////  Таблица СНИМКОВ К журналу рентгена
CREATE TABLE ph_files(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
	mid INT(22)not null,
	name VARCHAR(255) NOT NULL,
	path VARCHAR(255) NOT NULL,
        PID INT(22)not null,
	enable tinyint(1) not null,
     PRIMARY KEY (id)
);



/////////////////  Таблица журнал физио
CREATE TABLE jurnal_fizio(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
	regdate datetime not null,
	PID INT(22)not null,
	EMP_ID INT(22)not null,
	EMP INT(22)not null,
	comm VARCHAR(255) NOT NULL,
	dop text NOT NULL,
	enable tinyint(1) not null,
     PRIMARY KEY (id)
);

/////////////////  Таблица справочник
CREATE TABLE spr(
     id MEDIUMINT NOT NULL AUTO_INCREMENT,
	name VARCHAR(255) NOT NULL,
	cat_id int(22)not null,
	enable tinyint(1) not null,
	dop text NOT NULL,
     PRIMARY KEY (id)
);
