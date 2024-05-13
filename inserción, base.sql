USE powerletters;

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Juan Pérez', 'jperez', 'jperez@gmail.com', 'clave123', 'Calle Principal 123', '555-1234', 'imagen1.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('María García', 'mgarcia', 'mgarcia@gmail.com', 'password456', 'Avenida Central 456', '555-5678', 'imagen2.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Luis Rodríguez', 'lrodriguez', 'lrodriguez@gmail.com', 'contraseña789', 'Plaza Mayor 789', '555-9012', 'imagen3.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Ana Martínez', 'amartinez', 'amartinez@gmail.com', 'clave456', 'Calle Secundaria 456', '555-3456', 'imagen4.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Pedro López', 'plopez', 'plopez@gmail.com', 'password789', 'Avenida Principal 789', '555-6789', 'imagen5.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Laura Sánchez', 'lsanchez', 'lsanchez@gmail.com', 'clave789', 'Calle Central 789', '555-2345','imagen6.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Carlos Ramírez', 'cramirez', 'cramirez@gmail.com', 'contraseña123', 'Avenida Secundaria 123', '555-4567','imagen7.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Sofía Torres', 'storres', 'storres@gmail.com', 'password1234', 'Calle Mayor 234', '555-7890','imagen8.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Javier Gómez', 'jgomez', 'jgomez@gmail.com', 'clave5678', 'Plaza Central 5678','555-1234','imagen9.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Marcela López', 'mlopez', 'mlopez@gmail.com', 'password234', 'Calle Principal 234', '555-5678', 'imagen10.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Ricardo Martínez', 'rmartinez', 'rmartinez@gmail.com', 'clave7890', 'Avenida Central 7890', '555-9012', 'imagen11.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Isabel Fernández', 'ifernandez', 'ifernandez@gmail.com', 'password5678', 'Plaza Secundaria 5678', '555-3456','imagen12.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Diego Soto', 'dsoto', 'dsoto@gmail.com', 'clave78901', 'Calle Nueva 78901', '555-6789','imagen13.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Carolina Ramírez', 'cramirez2', 'cramirez2@gmail.com', 'password3456', 'Avenida Nueva 3456','555-2345','imagen14.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Roberto Torres', 'rtorres2', 'rtorres2@gmail.com', 'clave1234', 'Calle Vieja 1234','555-4567','imagen15.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Elena Gutiérrez', 'egutierrez', 'egutierrez@gmail.com', 'password6789', 'Avenida Vieja 6789', '555-7890','imagen16.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Francisco Silva', 'fsilva', 'fsilva@gmail.com', 'clave5678', 'Plaza Nueva 5678','555-1234','imagen17.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Carmen Morales', 'cmorales', 'cmorales@gmail.com', 'password9012', 'Calle Antigua 9012','555-5678','imagen18.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Alejandro Pérez', 'aperez2', 'aperez2@gmail.com', 'clave2345', 'Avenida Antigua 2345','555-9012','imagen19.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Silvia Navarro', 'snavarro', 'snavarro@gmail.com', 'password6789', 'Plaza Vieja 6789','555-3456','imagen20.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Jorge Vargas', 'jvargas2', 'jvargas2@gmail.com', 'clave4567', 'Calle Moderna 4567','555-6789','imagen21.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Andrea Jiménez', 'ajimenez', 'ajimenez@gmail.com', 'password3456', 'Avenida Moderna 3456', '555-2345','imagen22.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Martín Castro', 'mcastro', 'mcastro@gmail.com', 'clave7890', 'Calle Futura 7890', '555-4567','imagen23.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Lucía Herrera', 'lherrera', 'lherrera@gmail.com', 'password1234', 'Plaza Moderna 1234','555-6789','imagen24.jpg');

INSERT INTO tb_usuarios (nombre, nombre_usuario, correo, clave, direccion, telefono, imagen)
VALUES ('Pablo Ortega', 'portega', 'portega@gmail.com', 'clave5678', 'Avenida Futura 5678','555-9012','imagen25.jpg');

SELECT * FROM tb_usuarios;
INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Lionel Messi', 'lmessi', 'lmessi@gmail.com', 'messi123', '555-1234', '2024-03-06 10:00:00', 'imagen1.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Gerard Piqué', 'gpique', 'gpique@gmail.com', 'pique456', '555-5678', '2024-03-06 10:15:00', 'imagen2.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Sergio Busquets', 'sbusquets', 'sbusquets@gmail.com', 'busquets789', '555-9012', '2024-03-06 10:30:00', 'imagen3.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Jordi Alba', 'jalba', 'jalba@gmail.com', 'alba234', '555-3456', '2024-03-06 10:45:00', 'imagen4.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Ansu Fati', 'afati', 'afati@gmail.com', 'fati5678', '555-6789', '2024-03-06 11:00:00','imagen5.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Frenkie de Jong', 'fdejong', 'fdejong@gmail.com', 'dejong890', '555-7890', '2024-03-06 11:15:00', 'imagen6.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Ousmane Dembélé', 'odembele', 'odembele@gmail.com', 'dembele456', '555-2345', '2024-03-06 11:30:00', 'imagen7.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Ronald Araújo', 'raraujo', 'raraujo@gmail.com', 'araujo789', '555-9012', '2024-03-06 11:45:00', 'imagen8.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Pedri González', 'pgonzalez', 'pgonzalez@gmail.com', 'pedri123', '555-6789', '2024-03-06 12:00:00', 'imagen9.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Memphis Depay', 'mdepay', 'mdepay@gmail.com', 'depay456', '555-3456', '2024-03-06 12:15:00', 'imagen10.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Eric García', 'egarcia', 'egarcia@gmail.com', 'garcia789', '555-9012', '2024-03-06 12:30:00', 'imagen11.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Sergi Roberto', 'sroberto', 'sroberto@gmail.com', 'roberto123', '555-1234', '2024-03-06 12:45:00', 'imagen12.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Riqui Puig', 'rpuig', 'rpuig@gmail.com', 'puig456', '555-5678', '2024-03-06 13:00:00', 'imagen13.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Samuel Umtiti', 'sumtiti', 'sumtiti@gmail.com', 'umtiti789', '555-9012', '2024-03-06 13:15:00', 'imagen14.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Oscar Mingueza', 'omingueza', 'omingueza@gmail.com', 'mingueza234', '555-3456', '2024-03-06 13:30:00', 'imagen15.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Alex Collado', 'acollado', 'acollado@gmail.com', 'collado5678', '555-6789', '2024-03-06 13:45:00','imagen16.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Ilaix Moriba', 'imoriba', 'imoriba@gmail.com', 'moriba123', '555-2345', '2024-03-06 14:00:00', 'imagen17.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Konrad de la Fuente', 'kdelafuente', 'kdelafuente@gmail.com', 'fuente456', '555-5678', '2024-03-06 14:15:00', 'imagen18.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Matheus Fernandes', 'mfernandes', 'mfernandes@gmail.com', 'fernandes789', '555-9012', '2024-03-06 14:30:00', 'imagen19.jpg');

-- Continúa agregando los datos restantes de manera similar
INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Ricard Puig Martí', 'rpuigmarti', 'rpuigmarti@gmail.com', 'puigmarti234', '555-3456', '2024-03-06 14:45:00', 'imagen20.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Arnau Tenas Ureña', 'atenasurena', 'atenasurena@gmail.com', 'tenasurena5678', '555-6789','2024-03-06 15:00:00','imagen21.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Iñaki Peña', 'ipena', 'ipena@gmail.com', 'pena123', '555-7890', '2024-03-06 15:15:00', 'imagen22.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Álex Balde', 'abalde', 'abalde@gmail.com', 'balde456', '555-2345', '2024-03-06 15:30:00', 'imagen23.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Sergiño Dest', 'sdest', 'sdest@gmail.com', 'dest789', '555-9012', '2024-03-06 15:45:00', 'imagen24.jpg');

INSERT INTO tb_administradores (nombre_administrador, user_administrador, correo_administrador, clave_administrador, telefono_adm, fecha_registro, imagen)
VALUES ('Rafinha Alcántara', 'ralcantara', 'ralcantara@gmail.com', 'alcantara234', '555-3456', '2024-03-06 16:00:00','imagen25.jpg');

SELECT*FROM tb_administradores;


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

INSERT INTO tb_pedidos (fecha_pedido, id_usuario, estado)
VALUES ('2024-03-06 10:00:00', 1, 'PENDIENTE'),
('2024-03-06 11:30:00', 2, 'ENTREGADO'),
('2024-03-06 12:45:00', 3, 'FINALIZADO'),
('2024-03-06 14:20:00', 4, 'CANCELADO'),
('2024-03-06 15:10:00', 5, 'PENDIENTE'),
('2024-03-06 16:00:00', 6, 'PENDIENTE'),
('2024-03-06 17:30:00', 7, 'ENTREGADO'),
('2024-03-06 18:45:00', 8, 'FINALIZADO'),
('2024-03-06 20:20:00', 9, 'CANCELADO'),
('2024-03-06 21:10:00', 10, 'PENDIENTE'),
('2024-03-06 22:00:00', 11, 'PENDIENTE'),
('2024-03-07 09:30:00', 12, 'ENTREGADO'),
('2024-03-07 10:45:00', 13, 'FINALIZADO'),
('2024-03-07 12:20:00', 14, 'CANCELADO'),
('2024-03-07 13:10:00', 15, 'PENDIENTE'),
('2024-03-07 14:00:00', 16, 'PENDIENTE'),
('2024-03-07 15:30:00', 17, 'ENTREGADO'),
('2024-03-07 16:45:00', 18, 'FINALIZADO'),
('2024-03-07 18:20:00', 19, 'CANCELADO'),
('2024-03-07 19:10:00', 20, 'PENDIENTE'),
('2024-03-07 20:00:00', 21, 'PENDIENTE'),
('2024-03-07 21:30:00', 22, 'ENTREGADO'),
('2024-03-07 22:45:00', 23, 'FINALIZADO'),
('2024-03-08 09:20:00', 24, 'CANCELADO'),
('2024-03-08 10:10:00', 25, 'PENDIENTE');

SELECT*FROM tb_pedidos;

INSERT INTO tb_resenias (comentario)
values ('Me encanto'), ('Muy bueno'), ('Un poco alto el precio pero estubo bien'), ('lo adore'), ('No me gusto'), ('Compre dos me encanto'),
('Muy caro el precio'), ('Mucho texto xd'), ('Un clasico'), ('me divirtio lo recomiendo'), ('El autor no me gusta'), ('Muy bueno lo recomiendo'), ('El nombre me encanto'), ('Muy interesante'), ('Me encanto el final'), ('Saquen una peli de este libro'),
('Era mejor el anterior'), ('Mas texto xd'), ('la trilogia me encanto'), ('me emociono la gran batalla'),('Se me daño'), ('Mas bonito mejor'), ('Mas texto xd'), ('facinante'), ('final hermoso <3');

SELECT*FROM tb_resenias;

INSERT INTO tb_detalle_pedidos (id_pedido, id_libro, cantidad, id_resena)
VALUES 
  (1, 1, 2, 1),
  (2, 2, 1, 2),
  (3, 3, 3, 3),
  (4, 4, 1, 4),
  (5, 5, 2, 5),
  (6, 6, 1, 6),
  (7, 7, 4, 7),
  (8, 8, 2, 8),
  (9, 9, 1, 9),
  (10, 10, 3, 10),
  (11, 11, 2, 11),
  (12, 12, 1, 12),
  (13, 13, 4, NULL), -- Sin reseña
  (14, 2, 3, 13),
  (15, 4, 2, 14),
  (16, 6, 1, 15),
  (17, 8, 3, 16),
  (18, 10, 2, 17),
  (19, 12, 1, 18),
  (20, 14, 4, 19),
  (21, 16, 2, 20),
  (22, 18, 1, 21),
  (23, 20, 3, 22),
  (24, 22, 2, 23),
  (25, 24, 1, NULL); -- Sin reseña
  
SELECT*FROM tb_detalle_pedidos;

SELECT
    l.id_libro,
    l.titulo AS titulo_libro,
    l.descripcion AS descripcion_libro,
    l.precio,
    l.imagen,
    a.id_autor,
    a.nombre AS nombre_autor,
    c.id_clasificacion,
    c.nombre AS nombre_clasificacion,
    e.id_editorial,
    e.nombre AS nombre_editorial,
    g.id_genero,
    g.nombre AS nombre_genero,
    l.existencias
FROM
    tb_libros AS l
INNER JOIN
    tb_autores AS a ON l.id_autor = a.id_autor
INNER JOIN
    tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
INNER JOIN
    tb_editoriales AS e ON l.id_editorial = e.id_editorial
INNER JOIN
    tb_generos AS g ON l.id_genero = g.id_genero
ORDER BY
    l.titulo;


SELECT
    l.id_libro,
    l.titulo,
    l.descripcion AS descripcion_libro,
    l.precio,
    l.imagen,
    a.nombre AS nombre_autor,
    c.nombre AS nombre_clasificacion,
    e.nombre AS nombre_editorial,
    g.nombre AS nombre_genero,
    l.existencias
FROM
    tb_libros AS l
INNER JOIN
    tb_autores AS a ON l.id_autor = a.id_autor
INNER JOIN
    tb_clasificaciones AS c ON l.id_clasificacion = c.id_clasificacion
INNER JOIN
    tb_editoriales AS e ON l.id_editorial = e.id_editorial
INNER JOIN
    tb_generos AS g ON l.id_genero = g.id_genero
WHERE
    l.titulo LIKE '%buscar%'
ORDER BY
    l.titulo;
    
