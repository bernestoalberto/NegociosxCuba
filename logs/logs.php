#
#<?php die('Forbidden.'); ?>
#Date: 2016-08-16 22:20:32 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2016-08-16T22:20:32+00:00	ERROR 127.0.0.1	com_negocio	ERROR:  el valor null para la columna «usuario» viola la restricción not null
DETAIL:  La fila que falla contiene (16, null, Creó el(la) negocio , com_negocio, 2016-08-16 22:20:32).SQL=INSERT INTO "#__traza"
("accion","componente","fecha") VALUES 
('Creó el(la) negocio ','com_negocio','2016-08-16 22:20:32')
RETURNING id_traza
2016-08-22T07:24:37+00:00	ERROR 127.0.0.1	com_tipo_solicitud	ERROR:  error de sintaxis en o cerca de «)»
LINE 2: () VALUES 
         ^SQL=INSERT INTO "#__consultoria"
() VALUES 
()
RETURNING id_consultoria
2016-08-22T07:25:43+00:00	ERROR 127.0.0.1	com_tipo_solicitud	ERROR:  error de sintaxis en o cerca de «)»
LINE 2: () VALUES 
         ^SQL=INSERT INTO "#__consultoria"
() VALUES 
()
RETURNING id_consultoria
2016-08-22T07:36:36+00:00	ERROR 127.0.0.1	com_solicitud	Null primary key not allowed.
2016-08-22T17:20:15+00:00	ERROR 127.0.0.1	com_solicitud	Null primary key not allowed.
2016-08-22T17:22:53+00:00	ERROR 127.0.0.1	com_solicitud	Null primary key not allowed.
2016-08-22T17:23:21+00:00	ERROR 127.0.0.1	com_solicitud	Null primary key not allowed.
2016-08-22T17:23:36+00:00	ERROR 127.0.0.1	com_solicitud	Null primary key not allowed.
2016-08-23T17:56:36+00:00	ERROR 127.0.0.1	com_comentario	ERROR:  no existe la columna «categoria» en la relación «#__comentarios»
LINE 2: ("fecha","categoria","usuario","comentario","titulo") VALUES...
                 ^SQL=INSERT INTO "#__comentarios"
("fecha","categoria","usuario","comentario","titulo") VALUES 
('2016-08-23 17:56:34','37','29','nmfdtt','yu')
RETURNING id_comentario
2016-08-23T18:10:48+00:00	ERROR 127.0.0.1	com_comentario	ERROR:  el valor null para la columna «id_comentario» viola la restricción not null
DETAIL:  La fila que falla contiene (null, kl, 29, 35, 2016-08-23, lkmjh).SQL=INSERT INTO "#__comentarios"
("fecha","id_categoria","id_user","comentario","titulo") VALUES 
('2016-08-23 18:10:47',35,29,'lkmjh','kl')
RETURNING id_comentario
2016-08-23T19:11:16+00:00	ERROR 127.0.0.1	com_estado_ley	ERROR:  el valor null para la columna «id_estado_ley» viola la restricción not null
DETAIL:  La fila que falla contiene (null, yoooo).SQL=INSERT INTO "#__estado_ley"
("estado") VALUES 
('yoooo')
RETURNING id_estado_ley
2016-08-24T00:57:09+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  el valor null para la columna «id_publicidad» viola la restricción not null
DETAIL:  La fila que falla contiene (null, null, 16, 2016-08-24, lol, null, 0).SQL=INSERT INTO "#__publicidad"
("asunto","fecha","descripcion","leido") VALUES 
('16','2016-08-24 00:57:08','lol',0)
RETURNING id_publicidad
2016-08-24T00:59:43+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  el valor null para la columna «id_persona» viola la restricción not null
DETAIL:  La fila que falla contiene (1, 15, 16, 2016-08-24, lol, null, 0).SQL=INSERT INTO "#__publicidad"
("id_user","asunto","fecha","descripcion","leido") VALUES 
(15,'16','2016-08-24 00:59:42','lol',0)
RETURNING id_publicidad
2016-08-24T01:03:01+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  no existe la columna «ru»
LINE 3: (15,'16','2016-08-24 01:03:00','lol',ru,0)
                                             ^SQL=INSERT INTO "#__publicidad"
("id_user","asunto","fecha","descripcion","id_persona","leido") VALUES 
(15,'16','2016-08-24 01:03:00','lol',ru,0)
RETURNING id_publicidad
2016-08-31T01:17:39+00:00	ERROR 127.0.0.1	com_solicitud_consultoria	ERROR:  el valor es demasiado largo para el tipo character varying(20)SQL=INSERT INTO "#__traza"
("usuario","accion","componente","fecha") VALUES 
('ernesto','Creó el(la) solicitud_consultoria ','com_solicitud_consultoria','2016-08-31 01:17:38')
RETURNING id_traza
2016-08-31T02:40:40+00:00	ERROR 127.0.0.1	com_solicitud_consultoria	ERROR:  no existe la columna «ru»
LINE 3: (19,'2016-08-31 02:40:39',13,0,ru,'',1)
                                       ^SQL=INSERT INTO "#__consultoria"
("asunto","fecha","tipo_consultoria","leido","id_consultor","descripcion","estado") VALUES 
(19,'2016-08-31 02:40:39',13,0,ru,'',1)
RETURNING id_consultoria
2016-08-31T02:41:36+00:00	ERROR 127.0.0.1	com_solicitud_consultoria	ERROR:  no existe la columna «ru»
LINE 3: (19,'2016-08-31 02:41:35',14,0,ru,'',1)
                                       ^SQL=INSERT INTO "#__consultoria"
("asunto","fecha","tipo_consultoria","leido","id_consultor","descripcion","estado") VALUES 
(19,'2016-08-31 02:41:35',14,0,ru,'',1)
RETURNING id_consultoria
2016-08-31T03:58:55+00:00	ERROR 127.0.0.1	com_solicitud_consultoria	ERROR:  no existe la columna «ru»
LINE 3: (19,'2016-08-31 02:42:00',13,0,ru,'',1)
                                       ^SQL=INSERT INTO "#__consultoria"
("asunto","fecha","tipo_consultoria","leido","id_consultor","descripcion","estado") VALUES 
(19,'2016-08-31 02:42:00',13,0,ru,'',1)
RETURNING id_consultoria
2016-08-31T04:02:48+00:00	ERROR 127.0.0.1	com_solicitud_consultoria	ERROR:  no existe la columna «ru»
LINE 3: ('2016-08-31 04:02:47',12,0,ru,'',1,19)
                                    ^SQL=INSERT INTO "#__consultoria"
("fecha","tipo_consultoria","leido","id_consultor","descripcion","estado","asunto") VALUES 
('2016-08-31 04:02:47',12,0,ru,'',1,19)
RETURNING id_consultoria
2016-08-31T04:09:50+00:00	ERROR 127.0.0.1	com_solicitud_consultoria	ERROR:  no existe la columna «ru»
LINE 3: ('2016-08-31 04:09:49',13,0,ru,'',1,19)
                                    ^SQL=INSERT INTO "#__consultoria"
("fecha","tipo_consultoria","leido","id_consultor","descripcion","estado","asunto") VALUES 
('2016-08-31 04:09:49',13,0,ru,'',1,19)
RETURNING id_consultoria
2016-09-14T22:51:30+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  el valor null para la columna «fecha» viola la restricción not null
DETAIL:  La fila que falla contiene (4, 28, null, null, 5, 28, null, null, lol, null, 2016-09-14, 1).SQL=INSERT INTO "#__publicidad"
("id_user","fecha_modificacion","estado","id_persona","descripcion_asig_publicidad") VALUES 
(28,'2016-09-14 22:51:24',1,28,'lol')
RETURNING id_publicidad
2016-09-14T22:51:35+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  el valor null para la columna «fecha» viola la restricción not null
DETAIL:  La fila que falla contiene (6, 28, null, null, 7, 28, null, null, lol, null, 2016-09-14, 1).SQL=INSERT INTO "#__publicidad"
("id_user","fecha_modificacion","estado","id_persona","descripcion_asig_publicidad") VALUES 
(28,'2016-09-14 22:51:31',1,28,'lol')
RETURNING id_publicidad
2016-09-17T22:33:46+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  el valor null para la columna «fecha» viola la restricción not null
DETAIL:  La fila que falla contiene (8, 27, null, null, 9, 27, null, null, moi, null, 2016-09-17, 1).SQL=INSERT INTO "#__publicidad"
("id_user","fecha_modificacion","estado","id_persona","descripcion_asig_publicidad") VALUES 
(27,'2016-09-17 22:33:43',1,27,'moi')
RETURNING id_publicidad
