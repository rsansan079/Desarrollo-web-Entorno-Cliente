-- Creación de la base de datos
CREATE DATABASE IF NOT EXISTS futbol DEFAULT CHARACTER SET utf8 COLLATE utf8_spanish_ci;
USE futbol;

-- Tabla para equipos
CREATE TABLE equipos (
  id_equipo INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  ciudad VARCHAR(100) NOT NULL,
  fundado YEAR NOT NULL,
  presidente VARCHAR(100),
  PRIMARY KEY (id_equipo)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla para jugadores
CREATE TABLE jugadores (
  id_jugador INT(11) NOT NULL AUTO_INCREMENT,
  nombre VARCHAR(100) NOT NULL,
  apellidos VARCHAR(100) NOT NULL,
  edad INT(3),
  posicion VARCHAR(50) NOT NULL,
  nacionalidad VARCHAR(100),
  id_equipo INT(11) NOT NULL,
  PRIMARY KEY (id_jugador),
  FOREIGN KEY (id_equipo) REFERENCES equipos(id_equipo) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Tabla para estadísticas de jugadores
CREATE TABLE estadisticas (
  id_estadistica INT(11) NOT NULL AUTO_INCREMENT,
  id_jugador INT(11) NOT NULL,
  partidos_jugados INT(11) NOT NULL,
  goles INT(11) NOT NULL,
  asistencias INT(11),
  tarjetas_amarillas INT(11),
  tarjetas_rojas INT(11),
  PRIMARY KEY (id_estadistica),
  FOREIGN KEY (id_jugador) REFERENCES jugadores(id_jugador) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_spanish_ci;

-- Ejemplo de inserción de datos en equipos
INSERT INTO equipos (nombre, ciudad, fundado, presidente) VALUES
('FC Barcelona', 'Barcelona', 1899, 'Joan Laporta'),
('Real Madrid', 'Madrid', 1902, 'Florentino Pérez'),
('Manchester United', 'Manchester', 1878, 'Joel Glazer');

-- Ejemplo de inserción de datos en jugadores
INSERT INTO jugadores (nombre, apellidos, edad, posicion, nacionalidad, id_equipo) VALUES
('Lionel', 'Messi', 36, 'Delantero', 'Argentina', 1),
('Sergio', 'Ramos', 37, 'Defensa', 'España', 2),
('Marcus', 'Rashford', 26, 'Delantero', 'Inglaterra', 3);

-- Ejemplo de inserción de datos en estadísticas
INSERT INTO estadisticas (id_jugador, partidos_jugados, goles, asistencias, tarjetas_amarillas, tarjetas_rojas) VALUES
(1, 750, 700, 300, 20, 1),
(2, 650, 50, 40, 150, 10),
(3, 350, 120, 80, 15, 0);