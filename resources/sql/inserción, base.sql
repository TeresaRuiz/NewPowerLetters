USE powerletters;

INSERT INTO tb_usuarios (nombre_usuario, apellido_usuario, dui_usuario, correo_usuario, telefono_usuario, direccion_usuario, nacimiento_usuario, clave_usuario, imagen, estado_cliente, fecha_registro)
VALUES 
('Juan', 'Pérez', '01234567-8', 'jperez@gmail.com', '5551234', 'Calle Principal 123', '1980-01-15', 'clave123', 'imagen1.jpg', 1, CURRENT_TIMESTAMP),
('María', 'García', '12345678-9', 'mgarcia@gmail.com', '5555678', 'Avenida Central 456', '1985-05-23', 'password456', 'imagen2.jpg', 0, CURRENT_TIMESTAMP),
('Luis', 'Rodríguez', '23456789-0', 'lrodriguez@gmail.com', '5559012', 'Plaza Mayor 789', '1990-09-12', 'contraseña789', 'imagen3.jpg', 0, CURRENT_TIMESTAMP),
('Ana', 'Martínez', '34567890-1', 'amartinez@gmail.com', '5553456', 'Calle Secundaria 456', '1992-03-11', 'clave456', 'imagen4.jpg', 1, CURRENT_TIMESTAMP),
('Pedro', 'López', '45678901-2', 'plopez@gmail.com', '5556789', 'Avenida Principal 789', '1978-07-27', 'password789', 'imagen5.jpg', 0, CURRENT_TIMESTAMP),
('Laura', 'Sánchez', '56789012-3', 'lsanchez@gmail.com', '5552345', 'Calle Central 789', '1983-12-14', 'clave789', 'imagen6.jpg', 1, CURRENT_TIMESTAMP),
('Carlos', 'Ramírez', '67890123-4', 'cramirez@gmail.com', '5554567', 'Avenida Secundaria 123', '1981-06-08', 'contraseña123', 'imagen7.jpg', 1, CURRENT_TIMESTAMP),
('Sofía', 'Torres', '78901234-5', 'storres@gmail.com', '5557890', 'Calle Mayor 234', '1995-04-22', 'password1234', 'imagen8.jpg', 1, CURRENT_TIMESTAMP),
('Javier', 'Gómez', '89012345-6', 'jgomez@gmail.com', '5551234', 'Plaza Central 5678', '1987-11-30', 'clave5678', 'imagen9.jpg', 1, CURRENT_TIMESTAMP),
('Marcela', 'López', '90123456-7', 'mlopez@gmail.com', '5555678', 'Calle Principal 234', '1990-02-25', 'password234', 'imagen10.jpg', 1, CURRENT_TIMESTAMP),
('Ricardo', 'Martínez', '01234567-8', 'rmartinez@gmail.com', '5559012', 'Avenida Central 7890', '1982-08-19', 'clave7890', 'imagen11.jpg', 1, CURRENT_TIMESTAMP),
('Isabel', 'Fernández', '12345678-9', 'ifernandez@gmail.com', '5553456', 'Plaza Secundaria 5678', '1984-10-05', 'password5678', 'imagen12.jpg', 1, CURRENT_TIMESTAMP),
('Diego', 'Soto', '23456789-0', 'dsoto@gmail.com', '5556789', 'Calle Nueva 78901', '1986-07-17', 'clave78901', 'imagen13.jpg', 1, CURRENT_TIMESTAMP),
('Carolina', 'Ramírez', '34567890-1', 'cramirez2@gmail.com', '5552345', 'Avenida Nueva 3456', '1989-05-09', 'password3456', 'imagen14.jpg', 1, CURRENT_TIMESTAMP),
('Roberto', 'Torres', '45678901-2', 'rtorres2@gmail.com', '5554567', 'Calle Vieja 1234', '1993-01-22', 'clave1234', 'imagen15.jpg', 1, CURRENT_TIMESTAMP),
('Elena', 'Gutiérrez', '56789012-3', 'egutierrez@gmail.com', '5557890', 'Avenida Vieja 6789', '1980-09-09', 'password6789', 'imagen16.jpg', 1, CURRENT_TIMESTAMP),
('Francisco', 'Silva', '67890123-4', 'fsilva@gmail.com', '5551234', 'Plaza Nueva 5678', '1991-06-26', 'clave5678', 'imagen17.jpg', 1, CURRENT_TIMESTAMP),
('Carmen', 'Morales', '78901234-5', 'cmorales@gmail.com', '5555678', 'Calle Antigua 9012', '1979-10-14', 'password9012', 'imagen18.jpg', 1, CURRENT_TIMESTAMP),
('Alejandro', 'Pérez', '89012345-6', 'aperez2@gmail.com', '5559012', 'Avenida Antigua 2345', '1985-02-18', 'clave2345', 'imagen19.jpg', 1, CURRENT_TIMESTAMP),
('Silvia', 'Navarro', '90123456-7', 'snavarro@gmail.com', '5553456', 'Plaza Vieja 6789', '1994-07-13', 'password6789', 'imagen20.jpg', 1, CURRENT_TIMESTAMP),
('Jorge', 'Vargas', '01234567-8', 'jvargas2@gmail.com', '5556789', 'Calle Moderna 4567', '1983-11-21', 'clave4567', 'imagen21.jpg', 1, CURRENT_TIMESTAMP),
('Andrea', 'Jiménez', '12345678-9', 'ajimenez@gmail.com', '5552345', 'Avenida Moderna 3456', '1988-03-28', 'password3456', 'imagen22.jpg', 1, CURRENT_TIMESTAMP),
('Martín', 'Castro', '23456789-0', 'mcastro@gmail.com', '5554567', 'Calle Futura 7890', '1990-12-02', 'clave7890', 'imagen23.jpg', 1, CURRENT_TIMESTAMP),
('Lucía', 'Herrera', '34567890-1', 'lherrera@gmail.com', '5556789', 'Plaza Moderna 1234', '1986-04-15', 'password1234', 'imagen24.jpg', 1, CURRENT_TIMESTAMP),
('Pablo', 'Ortega', '45678901-2', 'portega@gmail.com', '5559012', 'Avenida Futura 5678', '1977-09-01', 'clave5678', 'imagen25.jpg', 1, CURRENT_TIMESTAMP);

SELECT*FROM tb_usuarios;

INSERT INTO administrador (
    nombre_administrador,
    apellido_administrador,
    correo_administrador,
    alias_administrador,
    clave_administrador
) VALUES (
    'Juan',
    'Pérez',
    'juan.perez@example.com',
    'juanp',
    'clave123'
);

INSERT INTO administrador (
    nombre_administrador,
    apellido_administrador,
    correo_administrador,
    alias_administrador,
    clave_administrador
) VALUES (
    'Ana',
    'García',
    'ana.garcia@example.com',
    'anag',
    'clave456'
);

INSERT INTO administrador (
    nombre_administrador,
    apellido_administrador,
    correo_administrador,
    alias_administrador,
    clave_administrador
) VALUES (
    'Luis',
    'Martínez',
    'luis.martinez@example.com',
    'luism',
    'clave789'
);

SELECT * FROM administrador;


INSERT INTO tb_generos (nombre)
VALUES ('Ficción'), 
('Ciencia Ficción'),
('Fantasía'), 
('Misterio'), 
('Terror'), 
('Biografía'), 
('Historia'), 
('Novela'), 
('Poesía'), 
('Infantil'), 
('Juvenil'), 
('Ciencia'), 
('Tecnología'), 
('Economía'), 
('Negocios'), 
('Salud'), 
('Cocina'), 
('Arte'), 
('Deportes'), 
('Musica'), 
('Cine'), 
('Teatro'), 
('Música'), 
('Tecnología'), 
('Videojuegos'), 
('Juegos de mesa'), 
('Colección');

SELECT*FROM tb_generos;

INSERT INTO tb_clasificaciones (nombre, descripcion)
VALUES ('Best Seller', 'Libros más vendidos y populares del momento'),
('Clásico', 'Obras literarias reconocidas por su relevancia histórica y cultural'),
('Romántico', 'Historias de amor y relaciones sentimentales'),
('Suspenso', 'Narrativas que mantienen al lector en tensión y expectativa'),
('Aventura', 'Relatos emocionantes llenos de acción y riesgo'),
('Histórico', 'Novelas basadas en eventos históricos o ambientadas en épocas pasadas'),
('Fantástico', 'Mundos imaginarios, seres mágicos y elementos sobrenaturales'),
('Autoayuda', 'Libros que buscan el desarrollo personal y el bienestar emocional'),
('Ciencia Ficción', 'Exploración de futuros posibles, tecnología avanzada y realidades alternativas'),
('Policiaco', 'Tramas de crimen, detectives y misterios por resolver'),
('Humor', 'Obras que buscan entretener y provocar risas'),
('Drama', 'Narrativas intensas y emotivas que exploran conflictos humanos'),
('Fantasía Épica', 'Mundos épicos, batallas y magia en historias de gran escala'),
('Thriller Psicológico', 'Suspense centrado en la mente y emociones de los personajes'),
('Novela Negra', 'Historias de crimen, intriga y corrupción'),
('Ciencia', 'Divulgación científica y exploración de conceptos científicos'),
('Terror', 'Narrativas que provocan miedo y tensión en el lector'),
('Romance', 'Relatos de amor y relaciones sentimentales'),
('Biografía', 'Historias reales de la vida de personas destacadas'),
('Viajes', 'Relatos de aventuras y descubrimientos en diferentes lugares del mundo'),
('Ciencia y Tecnología', 'Libros que abordan temas científicos y avances tecnológicos'),
('Novela Gráfica', 'Narrativas ilustradas que combinan texto e imágenes de forma creativa'),
('Autores Clásicos', 'Obras de escritores reconocidos por su influencia en la literatura'),
('Crecimiento Personal', 'Libros enfocados en el desarrollo personal y profesional'),
('Arte y Diseño', 'Exploración de expresiones artísticas y conceptos de diseño'),
('Cocina y Gastronomía', 'Recetas, técnicas culinarias y exploración de la gastronomía'),
('Historia Mundial', 'Relatos históricos que abarcan diferentes épocas y culturas'),
('Religión y Espiritualidad', 'Textos sobre creencias religiosas y prácticas espirituales'),
('Ciencias Sociales', 'Estudios sobre la sociedad, la política y las relaciones humanas'),
('Literatura Infantil', 'Cuentos y libros para niños que fomentan la imaginación y el aprendizaje');

SELECT*FROM tb_clasificaciones;

INSERT INTO tb_autores (nombre, biografia)
VALUES ('Gabriel García Márquez', 'Escritor colombiano, premio Nobel de Literatura conocido por "Cien años de soledad"'),
('Jane Austen', 'Escritora británica del siglo XIX, autora de "Orgullo y Prejuicio"'),
('Haruki Murakami', 'Escritor japonés contemporáneo, autor de "Tokio Blues"'),
('Agatha Christie', 'Escritora británica de novelas policíacas, creadora de Hercule Poirot'),
('J.K. Rowling', 'Escritora británica creadora de la saga de Harry Potter'),
('Mario Vargas Llosa', 'Escritor peruano, premio Nobel de Literatura por su obra narrativa'),
('Virginia Woolf', 'Escritora británica modernista, autora de "La señora Dalloway"'),
('Albert Camus', 'Escritor francés y filósofo existencialista, autor de "El extranjero"'),
('Emily Dickinson', 'Poetisa estadounidense del siglo XIX conocida por su estilo único'),
('Gabriela Mistral', 'Poetisa chilena y premio Nobel de Literatura por su obra poética'),
('Julio Cortázar', 'Escritor argentino conocido por su obra "Rayuela" y su estilo innovador'),
('Margaret Atwood', 'Escritora canadiense autora de "El cuento de la criada"'),
('Pablo Neruda', 'Poeta chileno y premio Nobel de Literatura por su poesía lírica'),
('George Orwell', 'Escritor británico conocido por "1984" y "Rebelión en la granja"'),
('Isabel Allende', 'Escritora chilena reconocida por novelas como "La casa de los espíritus"'),
('Fyodor Dostoevsky', 'Escritor ruso del siglo XIX, autor de "Crimen y castigo"'),
('Marguerite Duras', 'Escritora francesa conocida por "El amante" y su estilo intimista'),
('Ernest Hemingway', 'Escritor estadounidense ganador del premio Nobel, autor de "El viejo y el mar"'),
('Toni Morrison', 'Escritora afroamericana ganadora del premio Nobel por sus novelas sobre la experiencia negra en América'),
('Italo Calvino', 'Escritor italiano conocido por obras como "Las ciudades invisibles" y "El barón rampante"'),
('Sylvia Plath', 'Poetisa estadounidense y novelista, autora de "La campana de cristal"'),
('José Saramago', 'Escritor portugués ganador del premio Nobel, autor de "Ensayo sobre la ceguera"'),
('Clarice Lispector', 'Escritora brasileña conocida por su estilo introspectivo y experimental en obras como "La hora de la estrella"'),
('Octavio Paz', 'Poeta mexicano y premio Nobel de Literatura reconocido por su poesía vanguardista y ensayos literarios'),
('Hermann Hesse', 'Escritor alemán autor de obras como "El lobo estepario" y "Siddhartha"');

INSERT INTO tb_editoriales (nombre)
VALUES ('Penguin Random House'),
('HarperCollins'),
('Simon & Schuster'),
('Hachette Livre'),
('Macmillan Publishers'),
('Scholastic Corporation'),
('Pearson Education'),
('Oxford University Press'),
('Cambridge University Press'),
('Bloomsbury Publishing'),
('Penguin Books'),
('Vintage Books'),
('Pantheon Books'),
('Farrar, Straus and Giroux'),
('Knopf Doubleday Publishing Group'),
('Houghton Mifflin Harcourt'),
('Wiley Publishing'),
('Elsevier'),
('Springer Nature'),
('Taylor & Francis Group'),
('John Wiley & Sons'),
('McGraw-Hill Education'),
('Cengage Learning'),
('Pearson Longman'),
('Routledge');

SELECT*FROM tb_editoriales;

INSERT INTO tb_libros (titulo, id_autor, precio, descripcion, imagen, id_clasificacion, id_editorial, existencias, id_genero)
VALUES 
  ('Cien años de soledad', 1, 15.99, 'Una saga familiar en Macondo', 'imagen1.jpg', 1, 1, 50, 1),
  ('Orgullo y Prejuicio', 2, 12.99, 'Amor y prejuicios en la Inglaterra del siglo XIX', 'imagen2.jpg', 2, 2,30, 2),
  ('Tokio Blues', 3, 14.50, 'Juventud y melancolía en Tokio', 'imagen3.jpg', 3, 3, 40, 3),
  ('Asesinato en el Orient Express', 4, 11.75, 'Hercule Poirot resuelve un misterio a bordo del tren', 'imagen4.jpg', 4, 4, 25, 4),
  ('Harry Potter y la piedra filosofal', 5, 18.25, 'El inicio de las aventuras de Harry Potter en Hogwarts', 'imagen5.jpg', 5, 5, 60, 5),
  ('La ciudad y los perros', 6, 13.99, 'Vida y violencia en un colegio militar peruano', 'imagen6.jpg', 6,6 ,35 ,6),
  ('Mrs. Dalloway',7 ,16.50 ,'Un día en la vida de Clarissa Dalloway en Londres','imagen7.jpg' ,7 ,7,45 ,7),
  ('El extranjero' ,8 ,14.75 ,'La indiferencia y absurdo de la existencia','imagen8.jpg' ,8 ,8,20 ,8),
  ('Poemas' ,9 ,9.99 ,'Colección de poemas de Emily Dickinson','imagen9.jpg' ,9 ,9,50 ,9),
  ('Desolación' ,10 ,12.25 ,'Poesía íntima y emotiva de Gabriela Mistral','imagen10.jpg' ,10 ,10,30 ,10),
  ('Rayuela' ,11 ,17.99 ,'Novela experimental y desestructurada','imagen11.jpg' ,11 ,11,40 ,11),
  ('El cuento de la criada' ,12 ,14.50 ,'Distopía feminista en Gilead','imagen12.jpg' ,12 ,12,55 ,12),
  ('Veinte poemas de amor y una canción desesperada' ,13 ,11.75 ,'Poesía apasionada de Pablo Neruda','imagen13.jpg' ,13,13 ,25 ,13),
  ('1984' ,14 ,16.99 ,'Distopía totalitaria y vigilancia extrema','imagen14.jpg' ,14 ,14,60 ,14),
  ('La casa de los espíritus' ,15 ,18.25 ,'Saga familiar y realismo mágico en Chile','imagen15.jpg' ,15 ,15,40 ,15),
  ('Crimen y castigo',16,13.99,'Crimen moral y castigo psicológico en San Petersburgo','imagen16.jpg',16,16,30,16),
  ('El amante',17,15.50,'Relato autobiográfico de amor y pasión en Saigón','imagen17.jpg',17,17,35,17),
  ('El viejo y el mar',18,12.75,'Lucha contra la naturaleza y la vejez en el mar Caribe','imagen18.jpg',18,18,20,18),
  ('Beloved',19,14.99,'Exploración del legado del esclavismo en América','imagen19.jpg',19,19,45,19),
  ('Las ciudades invisibles',20,17.25,'Diálogos entre Marco Polo y Kublai Khan sobre ciudades imaginarias','imagen20.jpg',20,20,55,20),
  ('La campana de cristal',21,13.50,'Novela semi-autobiográfica sobre depresión y feminidad','imagen21.jpg',21,21,30,21),
  ('Ensayo sobre la ceguera',22,16.75,'Distopía sobre una epidemia de ceguera repentina','imagen22.jpg',22,22,40,22),
  ('La hora de la estrella',23,11.99,'Historia de Macabéa en Río de Janeiro','imagen23.jpg',23,23,25,23),
  ('Siddhartha',24,15.50,'Búsqueda espiritual y despertar interior en la India','imagen24.jpg',24,24,35,24),
  ('Demian',25,14.75,'Desarrollo personal y dualidad interna del protagonista Emil Sinclair','imagen25.jpg',25,25,30,25);
  
  SELECT*FROM tb_libros;
  
INSERT INTO tb_pedidos (id_usuario, direccion_pedido, estado, fecha_pedido) VALUES 
    (1, 'Calle Principal 123', 'PENDIENTE', NOW()),
    (2, 'Avenida Central 456', 'ENTREGADO', NOW()),
    (3, 'Plaza Mayor 789', 'FINALIZADO', NOW()),
    (4, 'Calle Secundaria 456', 'CANCELADO', NOW()),
    (5, 'Avenida Principal 789', 'PENDIENTE', NOW());

-- Insertar datos en la tabla tb_detalle_pedidos
INSERT INTO tb_detalle_pedidos (id_libro, cantidad, id_pedido, precio) VALUES 
    (1, 2, 1, 19.99),
    (2, 1, 2, 24.99),
    (3, 3, 3, 14.99),
    (4, 1, 4, 29.99),
    (5, 2, 5, 12.99);

-- Insertar datos en la tabla tb_comentarios
INSERT INTO tb_comentarios (comentario, calificacion, estado_comentario, id_detalle) VALUES 
    ('Me encanto', 4, 'ACTIVO', 1),
    ('Muy bueno', 4, 'ACTIVO', 2),
    ('Un poco alto el precio pero estuvo bien', 3, 'ACTIVO', 3),
    ('Lo adore', 5, 'ACTIVO', 4),
    ('No me gusto', 2, 'ACTIVO', 5);
    
    
SELECT*FROM tb_pedidos;
SELECT*FROM tb_detalle_pedidos;
SELECT*FROM tb_comentarios;
