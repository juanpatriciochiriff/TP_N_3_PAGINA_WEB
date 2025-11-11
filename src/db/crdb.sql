CREATE DATABASE IF NOT EXISTS crdb;
USE crdb;

CREATE TABLE usuario (
  id_usuario INT(11) NOT NULL AUTO_INCREMENT,
  nombre_usuario VARCHAR(255) NOT NULL,
  usuario_email VARCHAR(255) UNIQUE,
  codigo_postal_usuario INT(11),
  contrasena_usuario VARCHAR(255) NOT NULL,
  PRIMARY KEY (id_usuario)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

