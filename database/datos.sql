INSERT INTO rols (id, nombre) VALUES
(1, 'Terapeuta'),
(2, 'Cuidador');


INSERT INTO generos (id, nombre) VALUES
(1, 'Hombre'),
(2, 'Mujer'),
(3, 'Otro');

INSERT INTO etapas (id, nombre) VALUES
(2, 'Adolescencia'),
(4, 'Adulto'),
(3, 'Adulto joven'),
(5, 'Adulto Mayor'),
(1, 'Infancia');


INSERT INTO participacions (id, nombre) VALUES
(2, 'Bueno'),
(4, 'Malo'),
(1, 'Muy bueno'),
(5, 'Muy malo'),
(3, 'Normal');


INSERT INTO complejidads (id, nombre) VALUES
(3, 'Adecuada'),
(2, 'Bastante decuada'),
(1, 'Muy adecuada'),
(5, 'Nada adecuada'),
(4, 'Poco adecuada');


INSERT INTO estados (id, nombre) VALUES
(1, 'Conservado'),
(2, 'En riesgo'),
(3, 'Perdido');


INSERT INTO emocions (id, nombre) VALUES
(1, 'Alegría'),
(4, 'Enfado'),
(3, 'Ira'),
(2, 'Nostalgia'),
(5, 'Tristeza');


INSERT INTO estudios (id, nombre) VALUES
(4, 'Bachillerato'),
(6, 'Carrera universitaria'),
(8, 'Doctorado'),
(1, 'Educación infantil'),
(2, 'Educación primaria'),
(3, 'ESO'),
(5, 'Formación profesional'),
(7, 'Másteres o postgrados'),
(9, 'Sin estudios');


INSERT INTO etiquetas (id, nombre) VALUES
(3, 'Negativo'),
(2, 'Neutro'),
(1, 'Positivo');


INSERT INTO categorias (id, nombre) VALUES
(2, 'Amistad'),
(6, 'Estudios'),
(1, 'Familia'),
(3, 'Hobbies'),
(7, 'Otro'),
(5, 'Política'),
(4, 'Trabajo');


INSERT INTO situacions (id, nombre) VALUES
(2, 'Casado/a'),
(5, 'Divorciado/a'),
(4, 'Separado/a'),
(1, 'Soltero/a'),
(3, 'Unión de hecho'),
(6, 'Viudo/a');


INSERT INTO residencias (id, nombre) VALUES
(2, 'Casa'),
(3, 'Centro de día'),
(6, 'Otro'),
(1, 'Piso'),
(5, 'Residencia para mayores'),
(4, 'Vivienda unifamiliar');


INSERT INTO tiporelacions (id, nombre) VALUES
(6, 'Amigo / Amiga'),
(2, 'Hermano / Hermana'),
(3, 'Hijo / Hija'),
(7, 'Otro'),
(1, 'Padre / Madre'),
(4, 'Primo / Prima'),
(5, 'Tío / Tía');


INSERT INTO users (id, nombre, apellidos, email, email_verified_at, telefono, localidad, parentesco, ocupacion, password, rol_id, remember_token, created_at, updated_at, deleted_at) VALUES
(1, 'Manuel', 'López Jordan', 'terapeuta@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$6Ba06/Z5GOLHAX7/U1aPuOt3Vnxyww1qqs7jKXun2gLU8oYg0jone', 1, NULL, NULL, NULL, NULL),
(2, 'Alfredo', 'Martinez-Almeida Pérez', 'cuidador@gmail.com', NULL, '684847324', 'Argüelles', 'Primer grado', 'Diseñador', '$2y$10$2/113pihjADGFxmGwLyJlOlY/slcCfJyON8ygkiSqWTxS7ZbR1GAi', 2, NULL, NULL, '2023-03-31 13:41:01', NULL),
(3, 'María', 'Montserrat Plaza', 'cuidador2@gmail.com', NULL, '656789234', 'Nuevos ministerios', 'Segundo grado', 'Profesora', '$2y$10$AbFs3T5xTA9LK8KKdK2oH.b9oimRBSsadUVCNTH4vAmE0UFf.bN1m', 2, NULL, NULL, NULL, NULL),
(4, 'Sofía', 'Méndez Alvaro', 'terapeuta2@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$DWMFxY54JeWKrE9yXKsQmOeDNdNhbrk66SM/kTvJEAQZsj76whI.O', 1, NULL, NULL, NULL, NULL),
(5, 'Adriana', 'Ávila Álvarez', 'correo.terapeuta@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$6Ba06/Z5GOLHAX7/U1aPuOt3Vnxyww1qqs7jKXun2gLU8oYg0jone', 1, NULL, '2023-05-11 15:17:11', '2023-05-11 15:17:11', NULL);


INSERT INTO pacientes (id, nombre, apellidos, fecha_nacimiento, lugar_nacimiento, nacionalidad, ocupacion, residencia_actual, fecha_inscripcion, residencia_custom, residencia_id, situacion_id, estudio_id, genero_id,genero_custom, deleted_at) VALUES
(1, 'María Concepción', 'Martinez-Almeida García', '1950-07-30', 'Madrid', 'Española', 'Confeccionista', 'C/Toledo 49, Ático 9E', '2021-07-07', NULL, 1, 1, 4, 2, NULL, NULL),
(2, 'Cristina', 'Montserrat Plaza', '1969-01-21', 'Madrid', 'Española', 'Enfermera', 'P.º de la Castellana, 261, 28046 Madrid', '2019-04-07', NULL, 2, 1, 4, 2, NULL, NULL),
(3, 'Antonio', 'Sagunto de la Torre', '1940-02-28', 'Madrid', 'Española', 'Economista', 'C/ de Nuestra Señora del Perpetuo Socorro 11, 4ºD, 28053 Madrid', '2022-12-14', NULL, 3, 6, 5, 1, NULL, NULL),
(4, 'Juan José', 'Valcárcel Ruiz', '1951-11-13', 'España', 'España', 'Mecánico', 'C/ Emilia Pardo Bazán 11, 1ºA, 28903, Getafe, Madrid', NULL, NULL, 1, 6, 5, 1, NULL, NULL);


INSERT INTO personarelacionadas (id, nombre, apellidos, telefono, ocupacion, email, localidad, contacto, observaciones, tiporelacion_id, tipo_custom, paciente_id, deleted_at) VALUES
(1, 'Ignacio', 'González García', '678765456', 'Desconocido', 'igGar@gmail.com', 'C/ Toledo 49, Ático 9E', 0, 'Ignacio es el difunto marido de María Concepción.\r\nDependiendo del día, es posible que María se ponga triste al recordar sus días con él ya que murió trágicamente.', 7, 'Difunto marido', 1, NULL),
(2, 'Alfredo', 'Martínez-Almeida González', '684847324', 'Diseñador', 'cuidador@gmail.com', 'C/ Toledo 7, 4ºB', 0, 'Es el hijo de Concepción. Tiene 62 años y no tiene hijos. Su madre le inculcó una enorme pasión por la moda', 3, NULL, 1, NULL),
(3, 'Eros', 'Guerrero Sosa', '666666666', 'Informático', 'erGuer@gmail.com', 'C/Toledo 49, Ático 9D', 0, 'Es el vecino de Concepción. Tiene 62 años y muchas mascotas. Concepción en ocasiones se queja del ruido, pero le gusta tomar el café en su casa acompañada de los animales.', 6, NULL, 1, '2023-03-31 08:24:41'),
(4, 'Adrián', 'Prieto Campo', '600000001', 'Carpintero', 'adrPri@gmail.com', 'Leon o Madrid', 0, 'Amigo de la infancia de Concepción. En ocasiones viene a visitarla, se ponen al día y discuten sobre temas políticos.', 6, NULL, 1, '2023-03-31 08:24:36'),
(5, 'Samuel', 'Rodríguez Romero', '687773283', 'Estudiante', 'saRoRo@gmail.com', 'P.º de la Castellana, 261, 28046 Madrid', 0, 'Es el hijo de Cristina. Estudia cerca de casa y quiere ser matemático.', 3, NULL, 2, NULL),
(6, 'Andrés', 'Alba Izar', '675000000', 'Profesor', 'adrPri@gmail.com', 'Madrid', 0, 'Profesor de autoescuela de su hijo y amigo de Cristina. Toman té todas las tardes.', 6, NULL, 2, NULL),
(7, 'Camino', 'Martínez-Almeida González', NULL, 'Ingeniera industrial', 'CamiMart@gmail.com', 'Pº de la Castellana 12, 2ºB', 0, NULL, 3, NULL, 1, NULL),
(8, 'Gustavo', 'Merino Reverte', NULL, 'Jubilado', 'GusMer@gmail.com', 'C/ Toledo 49, Ático 9D', 0, 'Es su vecino de toda la vida. La familia mantiene una gran amistad con él y siempre está dispuesto a ayudar. Suele pasar largos ratos con María Concepción, haciéndose compañía el uno al otro', 7, 'Vecino', 1, NULL),
(9, 'Mariano', 'Menéndez González', NULL, 'Amo de casa', 'MarMen@gmail.com', 'C/ Toledo 7, 4ºB', 0, 'Es el marido de su hijo Alfredo. a María Concepción le costó aceptarle en la familia porque creía que solo buscaba dinero, pero ahora le quiere como a un hijo más.', 7, 'Yerno', 1, NULL),
(10, 'Gregoria', 'Díez Gutiérrez', NULL, 'Ama de casa', 'GreDiez@gmail.com', 'C/ La Rozadura, 2', 0, 'La mejor amiga de María Concepción desde que eran pequeñas.', 6, NULL, 1, NULL),
(11, 'Antonio', 'Sagunto Rosas', '674444789', 'Periodista', 'c.sagunto.rosas@gmail.com', 'C/ de Medina Sidonia 11, 1ºA', 0, 'Hijo mayor de Antonio. A día de hoy, es quien se encarga de llevarle y traerle al centro de día', 3, NULL, 3, NULL),
(12, 'Inés', 'Sagunto Rosas', '674444789', 'Actriz', 'i.sagunto.rosas@gmail.com', 'Av. Infante Don Luis 27', 0, 'Hijoamayor de Antonio. Debido a su trabajo, se ven poco', 3, NULL, 3, NULL),
(13, 'Carlos', 'Sagunto Rosas', '674444789', 'Escritor', 'i.sagunto.rosas@gmail.com', 'C/ del Calvario 34, BºA', 0, 'Benjamín de los Sagunto Rosas. Nunca han tenido muy buena relación, pero se ven una vez por semana', 3, NULL, 3, NULL),
(14, 'Carlos', 'Valcárcel Ruiz', '666666666', 'Profesor de Educación Primaria', 'carlos.val.ruiz@gmail.com', 'C/ Emilia Pardo Bazán 11, 1ºA, 28903, Getafe, Madrid', 1, 'Conviven en el mismo piso, por lo que es quien se encarga de él las 24 horas del día', 3, NULL, 4, NULL),
(15, 'Lucas', 'Soto Valcárcel', '611111111', 'Catedrático de Matemáticas Aplicadas', 'lucas.soto@gmail.com', 'C/ Calvario, 11, 2ºA, 28260, Galapagar, Madrid', 0, 'Desde que Lucas era niño han tenido muy buena relación', 7, NULL, 4, NULL);


INSERT INTO actividads (id, start, title, description, color, paciente_id, finished, deleted_at) VALUES
(1, '2023-03-30', 'Primera actividad', 'Primera actividad a la paciente María Concepción', '#20809d', 1, NULL, '2023-03-31 10:33:45'),
(2, '2023-03-30', 'Primera actividad', 'Primera actividad a la paciente Cristina', '#20809d', 2, NULL, NULL),
(3, '2023-03-02', 'Música clásica', 'Pasar de 15 a 30 minutos escuchando y hablando se sus canciones favoritas o de clásicos de su infancia/adolescencia', '#ff00c8', 1, NULL, NULL),
(4, '2023-03-03', 'Mostrarle sus creaciones', 'Escoger de 5 a 10 piezas de ropa que haya creado para su familia o amigos, preferentemente de las que más orgullosa esté, e intentar que recuerde por qué las hizo (si hay un motivo especial) y momentos especiales con las mismas. Hablar de su creación.', '#ff00c8', 1, NULL, NULL),
(5, '2023-03-10', 'Recordar a sus hermanos', 'Recopilar fotos de su infancia, con sus padres y hermanos, para enseñárselas e intentar recordar. También hacerles una copia y traerla a consulta el próximo día para poder trabajar mejor esta etapa.', '#ff00c8', 1, NULL, NULL),
(6, '2023-03-29', 'Hijos', 'Buscar elementos que puedan recordarle al nacimiento de sus dos hijos e intentar que recuerde momentos de su infancia. Como vacaciones familiares, fiestas de cumpleaños...', '#ff00c8', 1, NULL, NULL),
(7, '2023-05-02', 'Trabajar recuerdos de su etapa de Adulto Mayor', 'Utilizar las imágenes que a continuación se muestran para trabajar con Juanjo sus recuerdos de Adulto Mayor', '#20809d', 4, 'Sorprendetemente, Juanjo ha sido capaz de recordar casi todos los momentos que reflejaban las fotos', NULL),
(8, '2023-05-11', 'Trabajar personas de su entorno', 'Apoyándote en fotografías que tengas por casa de su entorno más cercano, intentar que identifique al mayor número de personas', '#20809d', 4, NULL, NULL);


INSERT INTO diagnosticos (id, paciente_id, fecha, enfermedad, antecedentes, gds, gds_fecha, mental, mental_fecha, cdr, cdr_fecha, nombre_escala, escala, fecha_escala, observaciones, multimedia_gds_id, multimedia_mec_id, multimedia_cdr_id, multimedia_custom_id, deleted_at) VALUES
(1, 1, '2023-03-01', 'Alzheimer', 'Su familia se dio cuenta de que se olvidaba de algunas cosas con excesiva facilidad, así que decidieron pedir un estudio.', 2, '2023-03-01', 24, '2023-03-01', 1, '2023-03-01', 'Mi escala', 8, '2023-03-01', NULL, NULL, NULL, NULL, NULL, NULL),
(2, 4, '2021-04-21', 'Alzheimer', 'Su hijo nos cuenta que dede hace unos meses Juanjo sufre pérdidas de memoria que han aumentado con el tiempo', 2, '2021-04-21', 24, '2021-04-21', 1, '2021-04-21', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


INSERT INTO evaluacions (id, paciente_id, fecha, diagnostico, gds, gds_fecha, mental, mental_fecha, cdr, cdr_fecha, nombre_escala, escala, fecha_escala, observaciones, multimedia_gds_id, multimedia_mec_id, multimedia_cdr_id, multimedia_custom_id, deleted_at) VALUES
(1, 1, '2023-03-05', 'Empeora poco a poco.', 3, '2023-03-05', 22, '2023-03-05', 1, '2023-03-05', 'Mi escala', 7, '2023-03-05', 'Ninguna', NULL, NULL, NULL, NULL, NULL),
(2, 1, '2023-03-28', 'Ha empeorado gravemente.', 5, '2023-03-18', 12, '2023-03-18', 2, '2023-03-18', 'Mi escala', 3, '2023-03-18', 'Se detuvieron las terapias porque se llevaron a María de viaje a la ciudad de su Padre, donde pasó gran parte de su adolescencia.', NULL, NULL, NULL, NULL, NULL),
(3, 1, '2023-03-10', 'Parece mantenerse estable.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, '2023-03-02', 'Se encuentra en las primeras etapas.', 5, '2023-03-02', 5, '2023-03-02', 5, '2023-03-02', 'escala custom', 5, '2023-03-02', NULL, NULL, NULL, NULL, NULL, NULL),
(5, 4, '2023-04-28', 'El usuario se mantiene en los mismos valores', 2, '2023-04-28', 24, '2023-04-28', 1, '2023-04-28', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(6, 4, '2023-05-05', 'El usuario sufre un leve empeoramiento', 4, '2023-05-05', 21, '2023-05-05', 1, '2023-05-05', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(7, 4, '2023-05-12', 'El usuario se mantiene en los mismos valores', 4, '2023-05-12', 21, '2023-05-12', 1, '2023-05-12', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);


INSERT INTO sesions (id, titulo, fecha, objetivo, descripcion, acciones, paciente_id, user_id, etapa_id, deleted_at) VALUES
(1, 'Trabajar infancia', '2023-03-03 00:00:00', 'Trabajar los recuerdos de su infancia como toma de contacto.', NULL, '- Presentarse a María Concepción.\n-Realizar CDR, Mental y GDS para el diagnóstico.\n- Hacer preguntas para evocar recuerdos y emociones.\n- Mostrarle fotos de los recuerdos.\n- Intentar profundizar.', 1, 1, 1, NULL),
(2, 'Trabajar recuerdos actuales', '2023-03-05 00:00:00', 'Intentar recordar sucesos recientes para ver si es capaz de retenerlos', NULL, '- Hablar de lo sucedido en la última semana\r\n- Mostrarle los recuerdos desde inicio de año\r\n- Profundizar en aquellos que más emociones generen.', 1, 1, 5, NULL),
(3, 'Inicio terapia', '2023-03-01 00:00:00', 'Pruebas iniciales', 'Iniciaremos las sesiones de terapia con un repaso general', NULL, 2, 4, 2, NULL),
(4, 'Tratar su entrada en la universidad', '2023-03-12 00:00:00', 'Recordar su primer día en la universidad', NULL, NULL, 1, 1, 3, NULL),
(5, 'Sesión de prueba', '2023-05-11 20:29:00', 'Objetivo de sesión de prueba', NULL, NULL, 4, 5, 1, '2023-05-13 18:09:32'),
(6, 'Sesión Etapa Infancia', '2023-03-17 09:00:00', 'Trabajar los recuerdos relacionados con su infancia', 'Se utilizarán vídeos y resúmenes de su historia de vida para trabajar sus recuerdos de la infancia', NULL, 4, 5, 1, NULL),
(7, 'Sesión Etapa Adulto Mayor', '2023-04-15 11:30:00', 'Trabajar los recuerdos relacionados con sus años de adulto mayor', 'Se utilizarán vídeos y resúmenes de su historia de vida para trabajar sus recuerdos de sus años de adulto mayor', NULL, 4, 5, 4, NULL),
(8, 'Sesión Etapa Adulto', '2023-05-11 09:00:00', 'Trabajar los recuerdos relacionados con su adultez', 'Se utilizarán vídeos y resúmenes de su historia de vida para trabajar sus recuerdos de la adultez', NULL, 4, 5, 4, NULL);


INSERT INTO informesesions (id, fecha_finalizada, duracion, respuesta, observaciones, barreras, facilitadores, propuestas, paciente_id, user_id, sesion_id, participacion_id, complejidad_id, deleted_at) VALUES
(1, '2023-03-05 11:00:00', '01:30', 'Gestiona las emociones correctamente.', 'ninguna observacion', 'Ha olvidado completamente algunos de los recuerdos.', 'El recuerdo con sus amigos', NULL, 1, 1, 1, 1, 1, NULL),
(2, '2023-03-09 10:10:00', '02:30', 'Se mostraba bastante participativa, aunque le costase recordar algunas cosas.', 'Sería conveniente reevaluar su estado en el próximo informe de seguimiento', NULL, 'Volver a ver la ecografía hizo que se le saltasen las lágrimas de alegría y empezase a hablar más', NULL, 1, 1, 2, 2, 3, NULL),
(3, '2023-05-11 18:35:00', '01:00', 'Buena', 'Ninguna', NULL, NULL, NULL, 4, 5, 5, NULL, NULL, NULL);


INSERT INTO recuerdos (id, fecha, nombre, descripcion, localizacion, puntuacion, paciente_id, etapa_id, categoria_id, emocion_id, estado_id, etiqueta_id, apto, tipo_custom, deleted_at) VALUES
(1, NULL, 'Entrada a la universidad', 'Inició su formación en el Grado en Diseño de Moda en la Universidad Complutense de Madrid. Lo recuerda como una de las etapas más felices de su vida y de mayor cambio.\r\nFue al acto de presentación con su difunto marido, por lo que también le causa algo de tristeza recordar este momento', 'Facultad de Comercio y Turismo UCM', 9, 1, 3, 6, 1, 2, NULL, 1, NULL, NULL),
(2, '2022-10-13', 'Cena con amigos y familia', 'Cenó en Bell Mondo Italia con su hijo Alfredo,  su vecino Ignacio y su mejor amiga Gregoria. Se rieron mucho mientras ayudaban a María a recordar viejos tiempo. También pasaron algo de frío en la terraza, y disfrutaron bastante de la comida.\r\nSacaron fotos de algunos platos del menú degustación.', 'Bell Mondo, Moncloa', 10, 1, 5, 3, 2, 1, NULL, 1, NULL, NULL),
(3, '2022-10-15', 'Fiesta en La Sierra', 'Asistió a la casa de campo de unos amigos en la Sierra y la recuerda con sentimientos de felicidad y ternura. Cuenta historias del momento y destaca haber ganado dinero en un bingo casero.', 'Discoteca Recuer-Dame, La Sierra', 7, 2, 3, 7, 1, 2, 2, 1, NULL, NULL),
(4, '2023-01-18', 'Visita al ginecólogo con su hija', 'Hizo una visita al ginecólogo con su hija Camino, para hacer un seguimiento de su embarazo. El ginecólogo les reveló el sexo del bebé (niña) y regaló una foto de la ecografía.', 'Hospital HLA Universitario Moncloa', 10, 1, 5, 1, 1, 1, NULL, 1, NULL, NULL),
(5, NULL, 'Aprender a montar en bici', 'Sus hermanos le enseñaros a montar en la nueva bici que le regalaron por su cumpleaños.', 'Su finca en Las Rozas, Madrid', 6, 1, 1, 1, 2, 2, NULL, 1, NULL, NULL),
(6, NULL, 'Juegos con sus amigos', 'Durante su infancia jugaba y bailaba con su grupo de amigos. Siempre conseguía sacarles una sonrisa a todos', NULL, 7, 1, 1, 2, 2, 3, NULL, 0, NULL, NULL),
(7, '1975-03-15', 'Nacimiento de su hermana pequeña', 'Su hermana pequeña nació el el Hospital Clínico, y fue un día muy feliz para ella. Siempre han estado muy unidas, y han hecho juntas prácticamente todo. Sin embargo, recordar a su hermana pone a Cristina muy triste, puesto que falleció en un accidente de tráfico hace algunos años', 'Hospital Clínico', 3, 2, 2, 1, 5, 2, NULL, 0, NULL, NULL),
(8, '1977-10-02', 'Entrada a la universidad', 'Comienza sus estudios de enfermería en la Universidad Complutense de Madrid. Para ella fueron unos años muy felices, donde hizo todo tipo de amigos y conoció al que fue el padre de sus hijos', 'Facultad de Medicina UCM', 10, 2, 3, 6, 1, 1, NULL, 1, NULL, NULL),
(9, '1982-12-25', 'Primer viaje en avión', 'Montó por primera vez en avión para cruzar el charco y llegar a Argentina. Allí vivía desde hacía muchos años su prima favorita, que tuvo que exiliarse en 1972', 'Madrid-Argentina', 7, 2, 4, 7, 1, 2, 2, 1, NULL, NULL),
(10, '1968-09-26', 'Entrada a la universidad', 'Inició su formación en el Grado en Económicas en la Universidad Complutense de Madrid. Lo recuerda como una de las etapas más felices de su vida y de mayor cambio', 'Facultad de Eonómicas UCM', 9, 3, 3, 6, 1, 2, NULL, 1, NULL, NULL),
(11, '1970-05-15', 'Nacimiento de su hija Inés', 'Nació su hija Inés, en el Hospital Universitario La Paz', 'Hospital Universitario La Paz', 10, 3, 5, 3, 2, 1, NULL, 1, NULL, NULL),
(12, '1972-08-12', 'Nacimiento de su hija Antonio', 'Nació su hijo Antonio, en el Hospital Universitario La Paz', 'Hospital Universitario La Paz', 7, 3, 3, 7, 1, 2, 2, 1, NULL, NULL),
(13, '1978-12-01', 'Nacimiento de su hijo Carlos', 'Nació su hija Carlos, en el Hospital Universitario La Paz', 'Hospital Universitario La Paz', 10, 3, 5, 1, 1, 1, NULL, 1, NULL, NULL),
(14, '1980-03-17', 'Nombramiento como Director General de Producción Agraria', 'Fue nombrado Director General de Producción Agraria, convirtiéndose así en lo que se denominó como Un Hombre de Suárez', 'Ministerio de Agricultura', 8, 3, 4, 4, 2, 1, NULL, 1, NULL, NULL),
(15, '2023-05-05', 'Cata de Vinos Profesional', 'Tu hijo te llevó a una cata de vinos profesional. Pasasteis el día rodeado de los enólogos más reputados y probando los mejores caldos del país.', NULL, 7, 4, 5, 1, NULL, 2, NULL, 1, NULL, NULL),
(16, '2019-06-07', 'Visita al Circuito de Madrid Jarama', 'Fuiste al Circuito de Madrid Jarama, para ver las carreras de coches que tanto te gustan. Como competía uno de los amigos de tu hijo, pudiste incluso subirte a uno de los coches.', 'Circuito de Madrid Jarama', 5, 4, 5, 3, 1, 1, NULL, 1, NULL, NULL),
(17, '2019-06-07', 'Visita al Circuito de Madrid Jarama', 'Fuiste al Circuito de Madrid Jarama, para ver las carreras de coches que tanto te gustan. Como competía uno de los amigos de tu hijo, pudiste incluso subirte a uno de los coches.', 'Circuito de Madrid Jarama', 5, 4, 5, 3, 1, 1, NULL, 1, NULL, '2023-05-11 15:44:18'),
(18, '2017-05-20', 'Puesta a Punto de tu Coche', 'Como todos los años, pusiste a punto tu querido coche. Siempre lo mimaste mucho, y nunca dejaste que tuviese el más mínimo problema', NULL, 5, 4, 5, 3, 2, 2, NULL, 1, NULL, '2023-05-11 16:50:50'),
(19, '2017-05-20', 'Puesta a Punto de tu Coche', 'Como todos los años, pusiste a punto tu querido coche. Siempre lo mimaste mucho, y nunca dejaste que tuviese el más mínimo problema', NULL, 5, 4, 5, 3, 2, 2, NULL, 1, NULL, NULL),
(20, '2010-10-21', 'Boda de tu Sobrino Lucas', 'Acudiste a la boda de tu sobrino Lucas, que se casaba con su novia de toda la vida. Bailasteis, reísteis y lo pasasteis en grande', NULL, 6, 4, 4, 1, 2, 2, NULL, 1, NULL, NULL),
(21, '2003-01-11', 'Adopción de Nana', 'Adoptasteis a Nana, tu perro fiel que estuvo junto a ti 11 años.', NULL, 4, 4, 4, 1, 2, 3, NULL, 0, NULL, NULL),
(22, '2000-10-10', 'Visitas al Cementerio con Mamá', 'Acompañabas a tu madre al cementerio de vuestro pueblo para poner flores a las tumbas de tus abuelos', NULL, 6, 4, 4, 1, 1, 3, NULL, 1, NULL, NULL),
(23, '1958-09-19', 'Primer Día de Colegio', 'Asististe a tu primer día de colegio en el pueblo, rodeado de compañeros de tu misma edad', NULL, 5, 4, 1, 6, 2, 2, NULL, 1, NULL, NULL),
(24, '1968-11-11', 'Boda con tu Mujer', 'Te casaste con tu difunta esposa, la que siempre fue el amor de tu vida', NULL, 3, 4, 3, 1, 5, 2, NULL, 0, NULL, NULL),
(25, '1946-05-15', 'Fiesta de San Isidro', 'En la fiesta de San Isidro bailabas, comías barquillos y disfrutabas mucho con todos tus amigos', NULL, 7, 4, 1, 3, 1, 3, NULL, 1, NULL, NULL),
(26, '1957-10-11', 'Inicio del Servicio Militar', 'Con 17 años te alistaste en el Servicio Militar Obligatorio. Lo hiciste obligado y no te gustó nada la experiencia', NULL, 1, 4, 2, 5, 3, 2, NULL, 0, NULL, NULL);


INSERT INTO multimedias (id, nombre, fichero, descripcion, personarelacionada_id, paciente_id, user_id) VALUES
(1, 'multimedia 1', '/img/avatar_hombre.png', NULL, NULL, NULL, NULL),
(2, 'multimedia 2', '/img/avatar_mujer.png', NULL, NULL, NULL, NULL),
(4, 'Alfredo.jpg', '/storage/img/6426d81a9cb951680267290.jpg', NULL, NULL, NULL, 2),
(5, 'Maria concepcion.jpg', '/storage/img/6426d0d56bb6a1680265429.jpg', NULL, NULL, 1, NULL),
(6, 'Ignacio.jpg', '/storage/img/6426d1c57d85b1680265669.jpg', NULL, 1, NULL, NULL),
(7, 'Camino.jpg', '/storage/img/6426d582ba02d1680266626.jpg', NULL, 7, NULL, NULL),
(8, 'Gustavo.jpg', '/storage/img/6426d6b47e1001680266932.jpg', NULL, 8, NULL, NULL),
(9, 'Mariano.jpg', '/storage/img/6426d7fe804811680267262.jpg', NULL, 9, NULL, NULL),
(10, 'Alfredo.jpg', '/storage/img/6426d81a9cb951680267290.jpg', NULL, 2, NULL, NULL),
(11, 'Gregoria.jpg', '/storage/img/6426d93f510181680267583.jpg', NULL, 10, NULL, NULL),
(12, 'Cena Bell Mondo 1.jpg', '/storage/img/6426da7c6ed191680267900.jpg', NULL, NULL, NULL, NULL),
(13, 'Cena Bell Mondo 2.jpg', '/storage/img/6426da7c768551680267900.jpg', NULL, NULL, NULL, NULL),
(14, 'Facultad de Comercio y Turismo.jpg', '/storage/img/6426dbf965ea11680268281.jpg', NULL, NULL, NULL, NULL),
(15, 'ecografía.jpg', '/storage/img/6426e0a7b67bb1680269479.jpg', NULL, NULL, NULL, NULL),
(16, 'Maria_hermanos.jpeg', '/storage/img/6426e2f5f157b1680270069.jpeg', NULL, NULL, NULL, NULL),
(17, 'bicicleta.jpeg', '/storage/img/6426e2f601b7e1680270070.jpeg', NULL, NULL, NULL, NULL),
(18, 'baile_amigos.jpeg', '/storage/img/6426e35b6434d1680270171.jpeg', NULL, NULL, NULL, NULL),
(19, 'Captura de Pantalla 2023-05-11 a las 17.21.40.png', '/storage/img/645d080fc1de81683818511.png', NULL, NULL, 4, NULL),
(20, 'pexels-jules-am‚-13244997-min.jpg', '/storage/img/645d0dda62af41683819994.jpg', NULL, NULL, NULL, NULL),
(21, 'pexels-jules-am‚-13245001-min.jpg', '/storage/img/645d0deaea89c1683820010.jpg', NULL, NULL, NULL, NULL),
(22, 'pexels-jules-am‚-15063437-min.jpg', '/storage/img/645d0e13214631683820051.jpg', NULL, NULL, NULL, NULL),
(23, 'pexels-jules-am‚-15063437-min.jpg', '/storage/img/645d0e2b1dcca1683820075.jpg', NULL, NULL, NULL, NULL),
(24, 'pexels-jules-am‚-15072922-min.jpg', '/storage/img/645d0f7a617cc1683820410.jpg', NULL, NULL, NULL, NULL),
(25, 'pexels-jules-am‚-12417601-min.jpg', '/storage/img/645d10eeaad3d1683820782.jpg', NULL, NULL, NULL, NULL),
(26, 'pexels-jules-am‚-12417610-min.jpg', '/storage/img/645d10eeab51a1683820782.jpg', NULL, NULL, NULL, NULL),
(27, 'pexels-jules-am‚-10136238-min.jpg', '/storage/img/645d116eec1761683820910.jpg', NULL, NULL, NULL, NULL),
(28, 'pexels-jules-am‚-10136241-min.jpg', '/storage/img/645d116eec8471683820910.jpg', NULL, NULL, NULL, NULL),
(29, 'pexels-jules-am‚-12312443-min.jpg', '/storage/img/645d12dfa28381683821279.jpg', NULL, NULL, NULL, NULL),
(30, 'pexels-jules-am‚-10136238-min.jpg', '/storage/img/645d14390fda81683821625.jpg', NULL, NULL, NULL, NULL),
(31, 'pexels-jules-am‚-15072922-min.jpg', '/storage/img/645d143910ee41683821625.jpg', NULL, NULL, NULL, NULL),
(32, 'pexels-jules-am‚-13244997 (1)-min.jpg', '/storage/img/645d1439113871683821625.jpg', NULL, NULL, NULL, NULL),
(33, 'pexels-jules-am‚-15063437-min.jpg', '/storage/img/645d143911bb41683821625.jpg', NULL, NULL, NULL, NULL);


INSERT INTO multimedia_sesion (id, multimedia_id, sesion_id) VALUES
(4, 1, 3);


INSERT INTO personarelacionada_recuerdo (id, recuerdo_id, personarelacionada_id) VALUES
(13, 1, 1),
(18, 2, 1),
(16, 2, 2),
(17, 2, 10),
(7, 3, 2),
(8, 3, 3),
(9, 3, 4),
(14, 4, 7),
(15, 6, 10),
(25, 15, 14),
(24, 16, 14),
(21, 17, 14),
(27, 20, 15);


INSERT INTO recuerdo_sesion (id, recuerdo_id, sesion_id) VALUES
(8, 5, 1),
(9, 6, 1),
(10, 2, 2),
(11, 4, 2),
(5, 3, 3),
(12, 1, 4),
(14, 23, 6),
(13, 25, 6),
(15, 15, 7),
(17, 16, 7),
(16, 19, 7),
(19, 20, 8),
(18, 21, 8),
(20, 22, 8);


INSERT INTO multimedia_recuerdo (id, multimedia_id, recuerdo_id) VALUES
(5, 1, 3),
(13, 12, 2),
(14, 13, 2),
(8, 14, 1),
(9, 15, 4),
(10, 16, 5),
(11, 17, 5),
(12, 18, 6),
(16, 20, 16),
(17, 21, 16),
(20, 23, 15),
(21, 24, 19),
(22, 25, 20),
(23, 26, 20),
(31, 27, 21),
(32, 28, 21),
(26, 29, 22);


INSERT INTO paciente_user (id, paciente_id, user_id) VALUES
(1, 1, 1),
(4, 1, 2),
(2, 1, 4),
(5, 2, 3),
(3, 2, 4),
(6, 3, 1),
(8, 4, 2),
(7, 4, 5);


INSERT INTO actividad_multimedia (id, multimedia_id, actividad_id) VALUES
(1, 30, 7),
(2, 31, 7),
(3, 32, 7),
(4, 33, 7);


INSERT INTO resumens (id, titulo, fecha, paciente_id, resumen, created_at, updated_at) VALUES
(1, 'Resumen Infancia - Adolescencia - Adulto joven - Adulto - Adulto Mayor', '2023-05-11', 4, 'En 1958, asististe a tu primer día de colegio en el pueblo y te sentías emocionado rodeado de compañeros de tu misma edad. En el año 2000, acompañaste a tu madre al cementerio para poner flores en las tumbas de tus abuelos. En 2010, acudiste a la boda de tu sobrino Lucas y pasasteis un gran momento bailando y riendo. En 2017, pusiste a punto tu coche como hacías cada año y lo mimabas mucho. En 2019, fuiste al Circuito de Madrid Jarama para ver carreras de coches que tanto te apasionaban incluso pudiste subirte a uno. Y en el año 2023, tu hijo te llevó a una cata profesional de vinos donde probaste los mejores caldos y pasasteis un día rodeados de los enólogos más reputados.', '2023-05-11 18:24:57', '2023-05-13 18:10:45'),
(2, 'Resumen Infancia - Adolescencia - Adulto joven - Adulto - Adulto Mayor', '2023-05-13', 4, 'En el año 1946, bailabas, comías barquillos y disfrutabas mucho con tus amigos en la fiesta de San Isidro. En el año 1958, asististe a tu primer día de colegio rodeado de compañeros de tu misma edad. En el año 1957, te alistaste en el Servicio Militar Obligatorio y no te gustó nada la experiencia. En el año 1968, te casaste con tu difunta esposa, el amor de tu vida. En el año 2000, acompañaste a tu madre al cementerio para poner flores a las tumbas de tus abuelos. En el año 2003, adoptasteis a Nana, tu perro fiel que estuvo junto a ti 11 años. En el año 2017, pusiste a punto tu querido coche que tanto mimaste siempre. En el año 2019, fuiste al Circuito de Madrid Jarama para ver carreras de coches y pudiste incluso subirte a uno gracias a que competía uno de los amigos de tu hijo. Finalmente en el año 2023, tu hijo te llevó a una cata profesional donde pasaron todo un día probando los mejores caldos del país con los enólogos más reputados.', '2023-05-13 18:10:36', '2023-05-13 18:10:36'),
(3, 'Resumen Adulto Joven - Adulto - Adulto Mayor', '2023-05-13', 4, 'En el año 2000, acompañaste a tu madre al cementerio para poner flores en la tumba de tus abuelos. En el 2010, asististe a la boda de tu sobrino Lucas, bailando y disfrutando mucho. En el 2017, arreglaste tu coche con mucho cuidado como siempre. En el 2019, fuiste al Circuito de Madrid Jarama para ver las carreras y hasta pudiste subirte a uno de los coches gracias al amigo de tu hijo. Finalmente, en el año 2023, tu hijo te llevó a una cata profesional de vinos donde probasteis los mejores caldos del país rodeados de enólogos reputados.', '2023-05-13 18:11:06', '2023-05-13 18:13:21'),
(4, 'Resumen Infancia - Adolescencia', '2023-05-13', 4, 'En el año 1946, bailabas en la fiesta de San Isidro y compartías barquillos con tus amigos. Te sentías muy feliz y disfrutabas de la celebración. En el año 1958, asististe a tu primer día de colegio en el pueblo rodeado de compañeros de tu misma edad. Experimentaste una gran emoción al comenzar esta nueva etapa en tu vida.', '2023-05-13 18:11:22', '2023-05-13 18:11:22'),
(5, 'Resumen Infancia', '2023-05-13', 4, 'En el año 2000, fuiste con tu madre al cementerio de vuestro pueblo para poner flores a las tumbas de tus abuelos. Caminasteis por los pasillos del cementerio y colocasteis cuidadosamente cada flor en su lugar. En el año 2010, asististe a la boda de tu sobrino Lucas y su novia de toda la vida. Bailasteis juntos en la pista de baile y te divertiste mucho con los demás invitados.', '2023-05-13 18:11:37', '2023-05-13 18:12:23'),
(6, 'Resumen Adulto', '2023-05-13', 4, 'En 2000, ibas al cementerio del pueblo con tu madre para poner flores en la tumba de tus abuelos. En 2010, fuiste a la boda de tu sobrino Lucas y su novia. Bailasteis, os reísteis y lo pasasteis muy bien juntos.', '2023-05-13 18:12:17', '2023-05-13 18:12:17'),
(7, 'Resumen Adulto Mayor', '2023-05-13', 4, 'En el año 2017, pusiste a punto tu coche con todo el cuidado del mundo. En el año 2019, fuiste al Circuito de Madrid Jarama para ver carreras de coches y te emocionaste hasta subirte a uno. Finalmente, en el año 2023, tu hijo te llevó a una cata profesional de vinos y disfrutaste rodeado de los expertos y probando los mejores sabores del país.', '2023-05-13 18:12:50', '2023-05-13 18:12:50');

COMMIT;