-- Base de datos solo para tenerla a la mano --
DROP DATABASE IF EXISTS powerletters;
CREATE DATABASE powerletters;
USE powerletters;
 
CREATE TABLE tb_usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre_usuario varchar(50) NOT NULL,
  apellido_usuario varchar(50) NOT NULL,
  dui_usuario varchar(10) NOT NULL,
  correo_usuario varchar(100) NOT NULL,
  telefono_usuario varchar(9) NOT NULL,
  direccion_usuario varchar(250) NOT NULL,
  nacimiento_usuario date NOT NULL,
  clave_usuario varchar(100) NOT NULL,
  imagen VARCHAR(25),
  estado_cliente tinyint(1) NOT NULL DEFAULT 1,
  fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP
);


CREATE TABLE administrador (
	id_administrador INT(10) UNSIGNED NOT NULL AUTO_INCREMENT,
	nombre_administrador VARCHAR(50) NOT NULL,
 	apellido_administrador VARCHAR(50) NOT NULL,
	correo_administrador VARCHAR(100) NOT NULL,
	alias_administrador VARCHAR(25) NOT NULL,
	clave_administrador VARCHAR(100) NOT NULL,
	fecha_registro DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (id_administrador)
);

CREATE TABLE tb_generos (
    id_genero INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100)
);

 
CREATE TABLE tb_clasificaciones (
    id_clasificacion INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    descripcion VARCHAR(100)
);
 
CREATE TABLE tb_autores (
    id_autor INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(1000),
    biografia VARCHAR(1000)
);
 
CREATE TABLE tb_editoriales (
    id_editorial INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100)
);
 
CREATE TABLE tb_libros (
    id_libro INT PRIMARY KEY AUTO_INCREMENT,
    titulo VARCHAR(100),
    id_autor INT,
    precio DECIMAL(10, 2),
    descripcion VARCHAR(200),
    imagen VARCHAR(25),
    id_clasificacion INT,
    id_editorial INT,
    existencias INT,
    id_genero INT,
    CONSTRAINT fk_generolibro FOREIGN KEY (id_genero) REFERENCES tb_generos(id_genero),
    CONSTRAINT fk_autor FOREIGN KEY (id_autor) REFERENCES tb_autores(id_autor),
    CONSTRAINT fk_clasificacion FOREIGN KEY (id_clasificacion) REFERENCES tb_clasificaciones(id_clasificacion),
    CONSTRAINT fk_editorial FOREIGN KEY (id_editorial) REFERENCES tb_editoriales(id_editorial)
);

CREATE TABLE tb_pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    direccion_pedido varchar(250) NOT NULL,
    estado ENUM('FINALIZADO', 'PENDIENTE', 'ENTREGADO', 'CANCELADO') NULL DEFAULT 'PENDIENTE',
    fecha_pedido DATETIME DEFAULT NOW(),
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(id_usuario)
);

CREATE TABLE tb_detalle_pedidos (
    id_detalle INT PRIMARY KEY AUTO_INCREMENT,
    id_libro INT,
    cantidad INT,
    id_pedido INT,
    precio DECIMAL(10, 2),
    CONSTRAINT fk_libro FOREIGN KEY (id_libro) REFERENCES tb_libros(id_libro),
    CONSTRAINT fk_pedido FOREIGN KEY (id_pedido) REFERENCES tb_pedidos(id_pedido)
);

CREATE TABLE tb_comentarios (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(250),
    calificacion INT,
    estado_comentario ENUM('ACTIVO', 'BLOQUEADO') NULL DEFAULT 'ACTIVO', 
    id_detalle INT,
    CONSTRAINT fk_comentario_detalle FOREIGN KEY (id_detalle) REFERENCES tb_detalle_pedidos(id_detalle)
);

SELECT
 c.id_comentario,
 c.comentario,
 c.calificacion,
 c.estado_comentario,
 u.nombre_usuario,
 dp.id_detalle,
 dp.id_libro,
 dp.cantidad,
 dp.precio,
 l.titulo,
 l.imagen, CASE WHEN c.estado_comentario = 1 THEN "ACTIVO" WHEN c.estado_comentario = 0 THEN "BLOQUEADO" END AS "ESTADO"
FROM 
tb_comentarios AS c
INNER JOIN 
tb_detalle_pedidos AS dp ON c.id_detalle = dp.id_detalle
INNER JOIN 
tb_pedidos AS p ON dp.id_pedido = p.id_pedido
INNER JOIN 
tb_usuarios AS u ON p.id_usuario = u.id_usuario
INNER JOIN 
tb_libros AS l ON dp.id_libro = l.id_libro
WHERE c.estado_comentario ="ACTIVO";

DELIMITER //

CREATE TRIGGER before_insert_tb_usuarios
BEFORE INSERT ON tb_usuarios
FOR EACH ROW
BEGIN
  SET NEW.fecha_registro = CURDATE();
END//

DELIMITER ;