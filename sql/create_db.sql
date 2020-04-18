/* Drop tables if exists */
DROP TABLE IF EXISTS Titulo;
DROP TABLE IF EXISTS Fita;
DROP TABLE IF EXISTS Examen;
DROP TABLE IF EXISTS Respuesta;
DROP TABLE IF EXISTS Pregunta;
DROP TABLE IF EXISTS Test;
DROP TABLE IF EXISTS Resumen;
DROP TABLE IF EXISTS Compartido;
DROP TABLE IF EXISTS Documento;
DROP TABLE IF EXISTS Tema;
DROP TABLE IF EXISTS Asignatura;
DROP TABLE IF EXISTS Usuario;

/* Create tables */
CREATE TABLE Titulo (
	id int AUTO_INCREMENT NOT NULL,
	puntuacion_minima int NOT NULL,
	titulo varchar(50) NOT NULL,
	PRIMARY KEY(id)
);

CREATE TABLE Usuario (
	id int AUTO_INCREMENT NOT NULL,
	email varchar(50) UNIQUE NOT NULL,
	nombre varchar(25) NOT NULL,
	username varchar(25) NOT NULL,
	password varchar(32) NOT NULL,
	karma int NOT NULL DEFAULT 0,
	PRIMARY KEY(id)
);

CREATE TABLE Fita (
	id int AUTO_INCREMENT NOT NULL,
	id_usuario int NOT NULL,
	nombre varchar(50) NOT NULL,
	descripcion varchar(150),
	hecho int(1) DEFAULT 0 NOT NULL,
	fecha_limite date NOT NULL,
	tipo_recordatorio int(1) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_usuario) REFERENCES Usuario(id)
);

CREATE TABLE Asignatura (
	id int AUTO_INCREMENT NOT NULL,
	nombre varchar(50) NOT NULL,
	id_usuario int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_usuario) REFERENCES Usuario(id)
);

CREATE TABLE Tema (
	id int AUTO_INCREMENT NOT NULL,
	nombre varchar(50) NOT NULL,
	id_asignatura int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_asignatura) REFERENCES Asignatura(id)
);

CREATE TABLE Examen (
	id int AUTO_INCREMENT NOT NULL,
	id_asignatura int NOT NULL,
	nombre varchar(50) NOT NULL,
	fecha date NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_asignatura) REFERENCES Asignatura(id)
);

CREATE TABLE Documento (
	id int AUTO_INCREMENT NOT NULL,
	id_tema int NOT NULL,
	nombre varchar(50) NOT NULL,
	ruta varchar(100),
	PRIMARY KEY(id),
	FOREIGN KEY(id_tema) REFERENCES Tema(id)
);

CREATE TABLE Resumen (
	id int AUTO_INCREMENT NOT NULL,
	id_documento int NOT NULL,
	texto longtext NOT NULL,
	tipo int(1) NOT NULL DEFAULT 0,
	PRIMARY KEY(id),
	FOREIGN KEY(id_documento) REFERENCES Documento(id)
);

CREATE TABLE Compartido (
	id_usuario int NOT NULL,
	id_documento int NOT NULL,
	codigo varchar(6) NOT NULL,
	CONSTRAINT pk PRIMARY KEY(id_documento, id_usuario),
	FOREIGN KEY(id_usuario) REFERENCES Usuario(id),
	FOREIGN KEY(id_documento) REFERENCES Documento(id)
);

CREATE TABLE Test (
	id int AUTO_INCREMENT NOT NULL,
	nombre varchar(100) NOT NULL,
	id_documento int NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_documento) REFERENCES Documento(id)
);

CREATE TABLE Pregunta (
	id int AUTO_INCREMENT NOT NULL,
	id_test int NOT NULL,
	texto varchar(100) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_test) REFERENCES Test(id)
);

CREATE TABLE Respuesta (
	id int AUTO_INCREMENT NOT NULL,
	id_pregunta int NOT NULL,
	texto varchar(200) NOT NULL,
	PRIMARY KEY(id),
	FOREIGN KEY(id_pregunta) REFERENCES Pregunta(id)
);