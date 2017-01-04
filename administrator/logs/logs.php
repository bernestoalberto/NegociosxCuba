#
#<?php die('Forbidden.'); ?>
#Date: 2016-09-27 00:44:49 UTC
#Software: Joomla Platform 13.1.0 Stable [ Curiosity ] 24-Apr-2013 00:00 GMT

#Fields: datetime	priority clientip	category	message
2016-09-27T00:44:48+00:00	ERROR 127.0.0.1	com_publicidad	ERROR:  el valor null para la columna «fecha» viola la restricción not null
DETAIL:  La fila que falla contiene (10, 33, null, 11, 33, null, null, soy yo pin.., 2016-09-27, 1).SQL=INSERT INTO "#__publicidad"
("id_user","fecha_modificacion","estado","id_persona","descripcion_asig_publicidad") VALUES 
(33,'2016-09-27 00:44:38',1,33,'soy yo pin..')
RETURNING id_publicidad
2016-10-06T17:28:58+00:00	ERROR 127.0.0.1	com_negocio	Null primary key not allowed.
2016-10-06T17:29:18+00:00	ERROR 127.0.0.1	com_negocio	Null primary key not allowed.
2016-10-16T06:32:23+00:00	ERROR 127.0.0.1	com_negocio	Null primary key not allowed.
2016-10-16T06:36:56+00:00	ERROR 127.0.0.1	com_negocio	Null primary key not allowed.
