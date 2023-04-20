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
(6, 'Otros'),
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
(2, 'Alfredo', 'Martinez-Almeida Pérez', 'cuidador@gmail.com', NULL, '684847324', 'Argüelles', 'Primer grado', 'Diseñador', '$2y$10$2/113pihjADGFxmGwLyJlOlY/slcCfJyON8ygkiSqWTxS7ZbR1GAi', 2, NULL, NULL, '2023-03-31 15:41:01', NULL),
(3, 'María', 'Montserrat Plaza', 'cuidador2@gmail.com', NULL, '656789234', 'Nuevos ministerios', 'Segundo grado', 'Profesora', '$2y$10$AbFs3T5xTA9LK8KKdK2oH.b9oimRBSsadUVCNTH4vAmE0UFf.bN1m', 2, NULL, NULL, NULL, NULL),
(4, 'Sofía', 'Méndez Alvaro', 'terapeuta2@gmail.com', NULL, NULL, NULL, NULL, NULL, '$2y$10$DWMFxY54JeWKrE9yXKsQmOeDNdNhbrk66SM/kTvJEAQZsj76whI.O', 1, NULL, NULL, NULL, NULL);


INSERT INTO pacientes (id, nombre, apellidos, fecha_nacimiento, lugar_nacimiento, nacionalidad, ocupacion, residencia_actual, fecha_inscripcion, residencia_custom, residencia_id, situacion_id, estudio_id, genero_id, deleted_at) VALUES
(1, 'María Concepción', 'Martinez-Almeida García', '1950-07-30', 'Madrid', 'Española', 'Confeccionista', 'C/Toledo 49, Ático 9E', '2021-07-07', NULL, 1, 1, 4, 2, NULL),
(2, 'Cristina', 'Montserrat Plaza', '1969-01-21', 'Madrid', 'Española', 'Enfermera', 'P.º de la Castellana, 261, 28046 Madrid', '2019-04-07', NULL, 2, 1, 4, 2, NULL);


INSERT INTO personarelacionadas (id, nombre, apellidos, telefono, ocupacion, email, localidad, contacto, observaciones, tiporelacion_id, tipo_custom, paciente_id, deleted_at) VALUES
(1, 'Ignacio', 'González García', '678765456', 'Desconocido', 'igGar@gmail.com', 'C/ Toledo 49, Ático 9E', 0, 'Ignacio es el difunto marido de María Concepción.\r\nDependiendo del día, es posible que María se ponga triste al recordar sus días con él ya que murió trágicamente.', 7, 'Difunto marido', 1, NULL),
(2, 'Alfredo', 'Martínez-Almeida González', '684847324', 'Diseñador', 'cuidador@gmail.com', 'C/ Toledo 7, 4ºB', 1, 'Es el hijo de Concepción. Tiene 62 años y no tiene hijos. Su madre le inculcó una enorme pasión por la moda', 3, NULL, 1, NULL),
(3, 'Eros', 'Guerrero Sosa', '666666666', 'Informático', 'erGuer@gmail.com', 'C/Toledo 49, Ático 9D', 0, 'Es el vecino de Concepción. Tiene 62 años y muchas mascotas. Concepción en ocasiones se queja del ruido, pero le gusta tomar el café en su casa acompañada de los animales.', 6, NULL, 1, '2023-03-31 10:24:41'),
(4, 'Adrián', 'Prieto Campo', '600000001', 'Carpintero', 'adrPri@gmail.com', 'Leon o Madrid', 0, 'Amigo de la infancia de Concepción. En ocasiones viene a visitarla, se ponen al día y discuten sobre temas políticos.', 6, NULL, 1, '2023-03-31 10:24:36'),
(5, 'Samuel', 'Rodríguez Romero', '687773283', 'Estudiante', 'saRoRo@gmail.com', 'P.º de la Castellana, 261, 28046 Madrid', 0, 'Es el hijo de Cristina. Estudia cerca de casa y quiere ser matemático.', 3, NULL, 2, NULL),
(6, 'Andrés', 'Alba Izar', '675000000', 'Profesor', 'adrPri@gmail.com', 'Madrid', 0, 'Profesor de autoescuela de su hijo y amigo de Cristina. Toman té todas las tardes.', 6, NULL, 2, NULL),
(7, 'Camino', 'Martínez-Almeida González', NULL, 'Ingeniera industrial', 'CamiMart@gmail.com', 'Pº de la Castellana 12, 2ºB', 0, NULL, 3, NULL, 1, NULL),
(8, 'Gustavo', 'Merino Reverte', NULL, 'Jubilado', 'GusMer@gmail.com', 'C/ Toledo 49, Ático 9D', 0, 'Es su vecino de toda la vida. La familia mantiene una gran amistad con él y siempre está dispuesto a ayudar. Suele pasar largos ratos con María Concepción, haciéndose compañía el uno al otro', 7, 'Vecino', 1, NULL),
(9, 'Mariano', 'Menéndez González', NULL, 'Amo de casa', 'MarMen@gmail.com', 'C/ Toledo 7, 4ºB', 0, 'Es el marido de su hijo Alfredo. a María Concepción le costó aceptarle en la familia porque creía que solo buscaba dinero, pero ahora le quiere como a un hijo más.', 7, 'Yerno', 1, NULL),
(10, 'Gregoria', 'Díez Gutiérrez', NULL, 'Ama de casa', 'GreDiez@gmail.com', 'C/ La Rozadura, 2', 0, 'La mejor amiga de María Concepción desde que eran pequeñas.', 6, NULL, 1, NULL);


INSERT INTO actividads (id, start, title, description, color, paciente_id, finished, deleted_at) VALUES
(1, '2023-03-30', 'Primera actividad', 'Primera actividad a la paciente María Concepción', '#20809d', 1, NULL, '2023-03-31 12:33:45'),
(2, '2023-03-30', 'Primera actividad', 'Primera actividad a la paciente Cristina', '#20809d', 2, NULL, NULL),
(3, '2023-03-02', 'Música clásica', 'Pasar de 15 a 30 minutos escuchando y hablando se sus canciones favoritas o de clásicos de su infancia/adolescencia', '#ff00c8', 1, NULL, NULL),
(4, '2023-03-03', 'Mostrarle sus creaciones', 'Escoger de 5 a 10 piezas de ropa que haya creado para su familia o amigos, preferentemente de las que más orgullosa esté, e intentar que recuerde por qué las hizo (si hay un motivo especial) y momentos especiales con las mismas. Hablar de su creación.', '#ff00c8', 1, NULL, NULL),
(5, '2023-03-10', 'Recordar a sus hermanos', 'Recopilar fotos de su infancia, con sus padres y hermanos, para enseñárselas e intentar recordar. También hacerles una copia y traerla a consulta el próximo día para poder trabajar mejor esta etapa.', '#ff00c8', 1, NULL, NULL),
(6, '2023-03-29', 'Hijos', 'Buscar elementos que puedan recordarle al nacimiento de sus dos hijos e intentar que recuerde momentos de su infancia. Como vacaciones familiares, fiestas de cumpleaños...', '#ff00c8', 1, NULL, NULL);


INSERT INTO diagnosticos (id, paciente_id, fecha, enfermedad, antecedentes, gds, gds_fecha, mental, mental_fecha, cdr, cdr_fecha, nombre_escala, escala, fecha_escala, observaciones, multimedia_gds_id, multimedia_mec_id, multimedia_cdr_id, multimedia_custom_id, deleted_at) VALUES
(1, 1, '2023-03-01', 'Alzheimer', 'Su familia se dio cuenta de que se olvidaba de algunas cosas con excesiva facilidad, así que decidieron pedir un estudio.', 2, '2023-03-01', 24, '2023-03-01', 1, '2023-03-01', 'Mi escala', 8, '2023-03-01', NULL, NULL, NULL, NULL, NULL, NULL);


INSERT INTO evaluacions (id, paciente_id, fecha, diagnostico, gds, gds_fecha, mental, mental_fecha, cdr, cdr_fecha, nombre_escala, escala, fecha_escala, observaciones, multimedia_gds_id, multimedia_mec_id, multimedia_cdr_id, multimedia_custom_id, deleted_at) VALUES
(1, 1, '2023-03-05', 'Empeora poco a poco.', 3, '2023-03-05', 22, '2023-03-05', 1, '2023-03-05', 'Mi escala', 7, '2023-03-05', 'Ninguna', NULL, NULL, NULL, NULL, NULL),
(2, 1, '2023-03-28', 'Ha empeorado gravemente.', 5, '2023-03-18', 12, '2023-03-18', 2, '2023-03-18', 'Mi escala', 3, '2023-03-18', 'Se detuvieron las terapias porque se llevaron a María de viaje a la ciudad de su Padre, donde pasó gran parte de su adolescencia.', NULL, NULL, NULL, NULL, NULL),
(3, 1, '2023-03-10', 'Parece mantenerse estable.', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 2, '2023-03-02', 'Se encuentra en las primeras etapas.', 5, '2023-03-02', 5, '2023-03-02', 5, '2023-03-02', 'escala custom', 5, '2023-03-02', NULL, NULL, NULL, NULL, NULL, NULL);

INSERT INTO sesions (id, titulo, objetivo, descripcion, acciones, paciente_id, user_id, etapa_id, deleted_at) VALUES
(1, 'Trabajar infancia', 'Trabajar los recuerdos de su infancia como toma de contacto.', NULL, '- Presentarse a María Concepción.\n-Realizar CDR, Mental y GDS para el diagnóstico.\n- Hacer preguntas para evocar recuerdos y emociones.\n- Mostrarle fotos de los recuerdos.\n- Intentar profundizar.', 1, 1, 1, NULL),
(2, 'Trabajar recuerdos actuales', 'Intentar recordar sucesos recientes para ver si es capaz de retenerlos', NULL, '- Hablar de lo sucedido en la última semana\r\n- Mostrarle los recuerdos desde inicio de año\r\n- Profundizar en aquellos que más emociones generen.', 1, 1, 5, NULL),
(3, 'Inicio terapia', 'Pruebas iniciales', 'Iniciaremos las sesiones de terapia con un repaso general', NULL, 2, 4, 2, NULL),
(4, 'Tratar su entrada en la universidad', 'Recordar su primer día en la universidad', NULL, NULL, 1, 1, 3, NULL);

INSERT INTO informesesions (id, fecha_finalizada, respuesta, barreras, facilitadores, observaciones, duracion, propuestas, paciente_id, user_id, participacion_id, complejidad_id, sesion_id, deleted_at) VALUES
(1,'2023-03-05 12:00:00', 'Gestiona las emociones correctamente.', 'Ha olvidado completamente algunos de los recuerdos.', 'El recuerdo con sus amigos', 'ninguna observacion', '01:30', NULL, 1, 1, 1, 1, 1, NULL),
(2,'2023-03-09 11:10:00', 'Se mostraba bastante participativa, aunque le costase recordar algunas cosas.', NULL, 'Volver a ver la ecografía hizo que se le saltasen las lágrimas de alegría y empezase a hablar más', 'Sería conveniente reevaluar su estado en el próximo informe de seguimiento', '02:30', NULL, 1, 1, 2, 3, 2, NULL);

INSERT INTO recuerdos (id, fecha, nombre, descripcion, localizacion, puntuacion, paciente_id, etapa_id, categoria_id, emocion_id, estado_id, etiqueta_id, apto, tipo_custom, deleted_at) VALUES
(1, NULL, 'Entrada a la universidad', 'Inició su formación en el Grado en Diseño de Moda en la Universidad Complutense de Madrid. Lo recuerda como una de las etapas más felices de su vida y de mayor cambio.\r\nFue al acto de presentación con su difunto marido, por lo que también le causa algo de tristeza recordar este momento', 'Facultad de Comercio y Turismo UCM', 9, 1, 3, 6, 1, 2, NULL, 1, NULL, NULL),
(2, '2022-10-13', 'Cena con amigos y familia', 'Cenó en Bell Mondo Italia con su hijo Alfredo,  su vecino Ignacio y su mejor amiga Gregoria. Se rieron mucho mientras ayudaban a María a recordar viejos tiempo. También pasaron algo de frío en la terraza, y disfrutaron bastante de la comida.\r\nSacaron fotos de algunos platos del menú degustación.', 'Bell Mondo, Moncloa', 10, 1, 5, 3, 2, 1, NULL, 1, NULL, NULL),
(3, '2022-10-15', 'Fiesta en La Sierra', 'Asistió a la casa de campo de unos amigos en la Sierra y la recuerda con sentimientos de felicidad y ternura. Cuenta historias del momento y destaca haber ganado dinero en un bingo casero.', 'Discoteca Recuer-Dame, La Sierra', 7, 2, 3, 7, 1, 2, 2, 1, NULL, NULL),
(4, '2023-01-18', 'Visita al ginecólogo con su hija', 'Hizo una visita al ginecólogo con su hija Camino, para hacer un seguimiento de su embarazo. El ginecólogo les reveló el sexo del bebé (niña) y regaló una foto de la ecografía.', 'Hospital HLA Universitario Moncloa', 10, 1, 5, 1, 1, 1, NULL, 1, NULL, NULL),
(5, NULL, 'Aprender a montar en bici', 'Sus hermanos le enseñaros a montar en la nueva bici que le regalaron por su cumpleaños.', 'Su finca en Las Rozas, Madrid', 6, 1, 1, 1, 2, 2, NULL, 1, NULL, NULL),
(6, NULL, 'Juegos con sus amigos', 'Durante su infancia jugaba y bailaba con su grupo de amigos. Siempre conseguía sacarles una sonrisa a todos', NULL, 7, 1, 1, 2, 2, 3, NULL, 0, NULL, NULL);


INSERT INTO multimedias (id, nombre, fichero, personarelacionada_id, paciente_id, user_id) VALUES
(1, 'multimedia 1', '/img/avatar_hombre.png', NULL, NULL, NULL),
(2, 'multimedia 2', '/img/avatar_mujer.png', NULL, NULL, NULL),
(4, 'Alfredo.jpg', '/storage/img/6426d063320fe1680265315.jpg', NULL, NULL, 2),
(5, 'Maria concepcion.jpg', '/storage/img/6426d0d56bb6a1680265429.jpg', NULL, 1, NULL),
(6, 'Ignacio.jpg', '/storage/img/6426d1c57d85b1680265669.jpg', 1, NULL, NULL),
(7, 'Camino.jpg', '/storage/img/6426d582ba02d1680266626.jpg', 7, NULL, NULL),
(8, 'Gustavo.jpg', '/storage/img/6426d6b47e1001680266932.jpg', 8, NULL, NULL),
(9, 'Mariano.jpg', '/storage/img/6426d7fe804811680267262.jpg', 9, NULL, NULL),
(10, 'Alfredo.jpg', '/storage/img/6426d81a9cb951680267290.jpg', 2, NULL, NULL),
(11, 'Gregoria.jpg', '/storage/img/6426d93f510181680267583.jpg', 10, NULL, NULL),
(12, 'Cena Bell Mondo 1.jpg', '/storage/img/6426da7c6ed191680267900.jpg', NULL, NULL, NULL),
(13, 'Cena Bell Mondo 2.jpg', '/storage/img/6426da7c768551680267900.jpg', NULL, NULL, NULL),
(14, 'Facultad de Comercio y Turismo.jpg', '/storage/img/6426dbf965ea11680268281.jpg', NULL, NULL, NULL),
(15, 'ecografía.jpg', '/storage/img/6426e0a7b67bb1680269479.jpg', NULL, NULL, NULL),
(16, 'Maria_hermanos.jpeg', '/storage/img/6426e2f5f157b1680270069.jpeg', NULL, NULL, NULL),
(17, 'bicicleta.jpeg', '/storage/img/6426e2f601b7e1680270070.jpeg', NULL, NULL, NULL),
(18, 'baile_amigos.jpeg', '/storage/img/6426e35b6434d1680270171.jpeg', NULL, NULL, NULL);


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
(15, 6, 10);


INSERT INTO recuerdo_sesion (id, recuerdo_id, sesion_id) VALUES
(8, 5, 1),
(9, 6, 1),
(10, 2, 2),
(11, 4, 2),
(5, 3, 3),
(12, 1, 4);


INSERT INTO multimedia_recuerdo (id, multimedia_id, recuerdo_id) VALUES
(5, 1, 3),
(13, 12, 2),
(14, 13, 2),
(8, 14, 1),
(9, 15, 4),
(10, 16, 5),
(11, 17, 5),
(12, 18, 6);



INSERT INTO paciente_user (id, paciente_id, user_id) VALUES
(1, 1, 1),
(4, 1, 2),
(2, 1, 4),
(5, 2, 3),
(3, 2, 4);

INSERT INTO resumens (id, titulo, fecha, resumen, paciente_id, created_at, updated_at) VALUES
(1, "Primer resumen", "2023-03-13", "Iniciaste tu formación en Diseño de Moda en la Universidad Complutense de Madrid, momento que recuerdas como una de las etapas más felices y de mayor cambio. Fuiste al acto de presentación con tu difunto marido, lo que también te causa cierta tristeza recordar. Cenaste en Bell Mondo Italia con tu hijo, vecino y mejor amiga el 13 de octubre del 2022; se rieron mucho mientras ayudaban a María a recordar viejos tiempos y sacaron fotos de algunos platos del menú degustación. Visistaste al ginecólogo con tu hija Camino el 18 de enero del 2023 para hacer un seguimiento del embarazo y les revelaron el sexo del bebé (niña) y además regalaron una foto de la ecografía. Tus hermanos te enseñaron a montar en la nueva bici que te regalaron por tu cumpleaños, mientras durante tu infancia jugabas y bailabas con tus amigos logrando siempre sacarles una sonrisa a todos.", 1, NULL, NULL),
(2, "Segundo resumen", "2023-03-20", "Cuando iniciaste el Grado en Diseño de Moda en la Universidad Complutense de Madrid, recuerdas haber experimentado una gran felicidad y cambio. Asististe al acto de presentación en compañía de tu difunto marido, aunque esto te provoca cierta tristeza al recordarlo. Hace poco cenaste con tu hijo Alfredo, Ignacio y Gregoria en Bell Mondo Italia, donde se rieron mucho recordando viejos tiempos aunque pasaron algo de frío. También visitaste al ginecólogo con tu hija Camino para hacer un seguimiento del embarazo y descubrieron que iba a tener una niña. Tus hermanos te enseñaron a montar en la bici que te regalaron por tu cumpleaños y durante tu infancia disfrutabas jugando y bailando con tus amigos mientras les sacabas sonrisas.", 1, NULL, NULL),
(3, "Tercer resumen", "2023-03-28", "Cuando iniciaste tu formación en el Grado en Diseño de Moda en la Universidad Complutense de Madrid, fue una de las etapas más felices y de mayor cambio para ti. Recuerdas que fuiste con tu difunto marido al acto de presentación, lo que también te causa cierta tristeza. En una cena en Bell Mondo Italia con tu hijo Alfredo, tu vecino Ignacio y Gregoria, tu mejor amiga, disfrutaron mucho recordando viejos tiempos aunque pasaron algo de frío en la terraza. Tomaron fotos de algunos platos del menú degustación. En una visita al ginecólogo con tu hija Camino durante su embarazo, el médico les reveló el sexo del bebé (niña) y regaló una foto de la ecografía. Durante tu infancia jugabas y bailabas con tus amigos, siempre consiguiendo sacarles una sonrisa a todos. También recuerdas cuando tus hermanos te enseñaron a montar en la nueva bici que te regalaron por tu cumpleaños.", 1, NULL, NULL),
(4, "Cuarto resumen", "2023-04-18", "Iniciaste tu formación en Diseño de Moda en la Universidad Complutense de Madrid, una etapa feliz y de cambio en tu vida. Fuiste al acto de presentación con tu difunto marido, lo que te causa tristeza pensar. El 13 de octubre del 2022 cenaste en Bell Mondo Italia con Alfredo, Ignacio y Gregoria, se rieron mucho mientras recordaban viejos tiempos y sacaron fotos de los platos. En el 2023-01-18 visitaste al ginecólogo con Camino para saber el sexo del bebé (una niña) y te dieron una foto de la ecografía. Tus hermanos te enseñaron a montar en tu nueva bici por tu cumpleaños. Durante tu infancia jugabas y bailabas con tus amigos siempre sacándoles sonrisas.", 1, NULL, NULL);

COMMIT;