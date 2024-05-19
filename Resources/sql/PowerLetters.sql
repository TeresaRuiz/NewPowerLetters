DROP DATABASE IF EXISTS powerletters;
CREATE DATABASE powerletters;
USE powerletters;
 
CREATE TABLE tb_usuarios (
    id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nombre VARCHAR(100),
    nombre_usuario VARCHAR(100),
    correo VARCHAR(100),
    clave VARCHAR(100),
    direccion VARCHAR(100),
    telefono VARCHAR(20),
    imagen VARCHAR(25)
);
 
CREATE TABLE tb_administradores (
    id_administrador INT PRIMARY KEY AUTO_INCREMENT,
    nombre_administrador VARCHAR(50),
    user_administrador VARCHAR(50),
    correo_administrador VARCHAR(50),
    clave_administrador VARCHAR(50),
    telefono_adm VARCHAR(20),
    fecha_registro DATETIME,
    imagen VARCHAR(25)
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

CREATE TABLE tb_comentarios (
    id_comentario INT PRIMARY KEY AUTO_INCREMENT,
    comentario VARCHAR(250),
    calificacion INT,
    estado_comentario ENUM('ACTIVO', 'BLOQUEADO')
);

CREATE TABLE tb_detalle_pedidos (
    id_detalle INT PRIMARY KEY AUTO_INCREMENT,
    id_libro INT,
    cantidad INT,
    id_comentario INT,
    CONSTRAINT fk_libro FOREIGN KEY (id_libro) REFERENCES tb_libros(id_libro),
    CONSTRAINT fk_comentario FOREIGN KEY (id_comentario) REFERENCES tb_comentarios(id_comentario)
);

CREATE TABLE tb_pedidos (
    id_pedido INT PRIMARY KEY AUTO_INCREMENT,
    id_usuario INT,
    direccion_pedido varchar(250) NOT NULL,
    estado ENUM('FINALIZADO', 'PENDIENTE', 'ENTREGADO', 'CANCELADO'),
    fecha_pedido DATETIME,
    id_detalle INT, 
    CONSTRAINT fk_usuario FOREIGN KEY (id_usuario) REFERENCES tb_usuarios(id_usuario),
    CONSTRAINT fk_pedido FOREIGN KEY (id_detalle) REFERENCES tb_detalle_pedidos(id_detalle)
);
 
