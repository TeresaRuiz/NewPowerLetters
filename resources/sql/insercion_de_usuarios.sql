USE powerletters;

INSERT INTO tb_usuarios (nombre_usuario, apellido_usuario, dui_usuario, correo_usuario, telefono_usuario, direccion_usuario, nacimiento_usuario, clave_usuario, imagen)
VALUES
('Frenkie', 'De Jong', '00000001', 'frenkie@barca.com', '123456789', 'Calle Barça, 1', '1997-05-12', 'contraseña123', 'frenkie.jpg'),
('Lionel', 'Messi', '00000002', 'messi@barca.com', '123456780', 'Calle Barça, 10', '1987-06-24', 'contraseña456', 'messi.jpg'),
('Jordi', 'Alba', '00000003', 'alba@barca.com', '123456781', 'Calle Barça, 11', '1989-03-21', 'contraseña789', 'alba.jpg'),
('Sergio', 'Busquets', '00000004', 'busquets@barca.com', '123456782', 'Calle Barça, 12', '1988-07-16', 'contraseña012', 'busquets.jpg'),
('Jordi', 'Alba', '00000005', 'alba@barca.com', '123456783', 'Calle Barça, 13', '1989-03-21', 'contraseña345', 'alba.jpg'),
('Sergio', 'Busquets', '00000006', 'busquets@barca.com', '123456784', 'Calle Barça, 14', '1988-07-16', 'contraseña678', 'busquets.jpg'),
('Sergio', 'Aguero', '00000008', 'aguero@barca.com', '123456786', 'Calle Barça, 16', '1988-06-02', 'contraseña234', 'aguero.jpg'),
('Pedri', 'González', '00000009', 'pedri@barca.com', '123456787', 'Calle Barça, 17', '2002-11-25', 'contraseña567', 'pedri.jpg'),
('Ansu', 'Fati', '00000010', 'fati@barca.com', '123456788', 'Calle Barça, 18', '2002-10-31', 'contraseña890', 'fati.jpg');

SELECT*FROM tb_usuarios;

INSERT INTO administrador (nombre_administrador, apellido_administrador, correo_administrador, alias_administrador, clave_administrador)
VALUES
('Taylor', 'Swift', 'lover@music.com', 'Lover', 'contraseña123'),
('Allison', 'Swift', '1989@music.com', '1989', 'contraseña456'),
('Lisandro', 'Sánchez', 'red@music.com', 'Red', 'abejitass'),
('Andrea', 'Ruiz', 'speaknow@music.com', 'SpeakNow', 'contraseña012'),
('Yancy', 'González', 'fearless@music.com', 'Fearless', 'contraseña345'),
('Maria', 'Rivera', 'reputation@music.com', 'Reputation', 'contraseña678'),
('Manuel', 'Palacios', '1989tv@music.com', '1989TaylorVersion', 'contraseña901');

SELECT*FROM administrador;
