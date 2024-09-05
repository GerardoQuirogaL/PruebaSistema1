CREATE DATABASE control_vehiculos;

USE control_vehiculos;

CREATE TABLE vehiculos (
    id INT AUTO_INCREMENT PRIMARY KEY,
    placa VARCHAR(10) NOT NULL,
    qr_code VARCHAR(255) NOT NULL,
    fecha_entrada DATETIME,
    fecha_salida DATETIME
);
