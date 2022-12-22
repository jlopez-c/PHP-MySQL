CREATE DATABASE inmobiliaria;

USE inmobiliaria;

CREATE TABLE usuario (
 usuario_id int(5) NOT NULL PRIMARY KEY AUTO_INCREMENT,
 nombres varchar(35) NOT NULL,
 correo varchar(100) NOT NULL UNIQUE,
 clave varchar(80) NOT NULL);


CREATE TABLE piso (
codigo_piso int PRIMARY KEY AUTO_INCREMENT,
calle VARCHAR(40) NOT NULL,
numero INT NOT NULL,
piso INT NOT NULL,
puerta VARCHAR(5) NOT NULL,
cp INT NOT NULL,
metros INT NOT NULL,
zona VARCHAR (15),
precio float NOT NULL,
imagen varchar(100) NOT NULL,
usuario_id int(5)references usuario
);

INSERT INTO usuario(usuario_id, nombres, correo, clave) VALUES
(NULL, "Jesus Lopez", "jesuslopez@gmail.com", "12345"),
(NULL, "Miguel Ciordia", "miguelciordia@gmail.com", "12345"),
(NULL, "Charo Galera", "charogalera@gmail.com", "12345"),
(NULL, "Juan Martinez", "juanmartinez@gmail.com", "12345"),
(NULL, "Jesus Barrio", "jesusbarrio@gmail.com", "12345"),
(NULL, "Javier Rodriguez", "javierrodriguez@gmail.com", "12345"),
(NULL, "Laura Berenguer", "lauraberenguer@gmail.com", "12345"),
(NULL, "Jesus Padilla", "jesuspadilla@gmail.com", "12345");

INSERT INTO piso (codigo_piso, calle, numero, piso, puerta, cp, metros, zona, precio, imagen, usuario_id) VALUES
(NULL, "Francia", 7, 4, "B", 28943, 100, "Fuenlabrada", 250000, "./img/piso1.jpg", 1),
(NULL, "Pez", 12, 9, "A", 28876, 150, "Madrid", 550000, "./img/piso2.jpg", 1),
(NULL, "Atocha", 23, 1, "C", 28964, 120, "Alcobendas", 330000, "./img/piso3.jpg", 3),
(NULL, "Hungría", 14, 7, "D", 28944, 180, "Fuenlabrada", 275000.99, "./img/piso4.jpg", 6),
(NULL, "Hispanidad", 5, 8, "C", 28998, 175, "Madrid", 400000, "./img/piso5.jpg", 4),
(NULL, "Goya", 56, 1, "A", 28915, 230, "Madrid", 605000, "./img/piso6.jpg", 8),
(NULL, "Hispanidad", 5, 8, "A", 28998, 125, "Madrid", 388000.99, "./img/piso7.jpg", 5),
(NULL, "Calzada", 1, 1, "A", 28936, 83, "Loranca", 150000, "./img/piso8.jpg", 1),
(NULL, "Maracas", 3, 1, "F", 28683, 55, "Villaverde", 320000, "./img/piso9.jpg", NULL),
(NULL, "Alemania", 20, 9, "C", 28949, 115, "Fuenlabrada", 320300, "./img/piso10.jpg", NULL),
(NULL, "Palacios", 1, 8, "H", 28932, 123, "Getafe", 360000, "./img/piso11.jpg", 5),
(NULL, "Calipo", 65, 1, "C", 27563, 230, "Villamantilla", 60000, "./img/piso12.jpg", NULL);

--- Debido a un problema moldificamos la tabla usuario para que no pueda haber email duplicados.
ALTER TABLE usuario
MODIFY correo varchar(100) NOT NULL UNIQUE;