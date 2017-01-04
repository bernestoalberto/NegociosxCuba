
<?php
defined('_JEXEC') or die('acceso no autorizado');
JHtml::_('behavior.formvalidation');
$componentbase =  $this->_basePath;

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Solicitud </title>
</head>
<body class="skin-blue sidebar-mini">
<h3>   Procesar Solicitudes de Inscripción</h3>
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sinprocesar">Sin Procesar</a></li>
		<li><a data-toggle="tab" href="#procesadas">Procesadas</a></li>

	</ul>

	<div class="tab-content">
		<div id="sinprocesar" class="tab-pane active">

				<div class="content box box-primary" id="este">
					<h3> Solicitudes Sin Procesar</h3>

					<div id="gridselection_solicitud" style="width:100%"></div>
				</div>

				<div id="solicitud_sin_procesar_window" style="display: none;">

					<div class="box-gestionando box-primary">

						<form role="form" method="post" id="solicitud_form" class="form-validate">

							<div class="form-group">
								<fieldset>
								<div class="row">
									<div class="col-md-4">
										<img class="user-image img-circle"  id="foto_perfil" width="70px" height="70px" src="">
									</div>
									<div class="col-md-4">
								<!---		<div class="input-group margin" id="div_asunto">
                          	<span class="input-group-btn" title=" se define el asunto">
                			<label for="asunto" class="btn-addons " style="padding-right: 5px;">Asunto</label></span>
											<input value="" id="asunto" required name="solicitud[asunto]" readonly
												   placeholder="Escriba el asunto" type="text"/>

											<div class="k-invalid-msg" data-for="asunto"></div>
										</div>--->
									</div>
									</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_nombre">
                          	<span class="input-group-btn" title=" se define ldescripcion">
                			<label for="nombre" class="btn-addons " style="padding-right: 5px;">Nombre</label></span>
											<input value="" id="nombre"  name="solicitud[nombre]" readonly
												   placeholder="Inserte  nombre" type="text"/>

											<div class="k-invalid-msg" data-for="descripcion"></div>
										</div>
										</div>

									<div class="col-md-4">
										<div class="input-group margin" id="div_identificacion">
                          	<span class="input-group-btn" title=" se define l identificacion">
                			<label for="identificacion" class="btn-addons " style="padding-right: 5px;">Identificación</label></span>
											<input value="" id="identificacion"  name="solicitud[identificacion]" readonly
												   placeholder="Inserte  identificacion" type="text"/>

											<div class="k-invalid-msg" data-for="identificacion"></div>
										</div>
									</div>
									</div>

								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_telefono">
                          	<span class="input-group-btn" title=" se define telefono">
                			<label for="telefono" class="btn-addons " style="padding-right: 5px;">Teléfono</label></span>
											<input value="" id="telefono"  name="solicitud[telefono]" readonly
													  placeholder="Inserte  telefono" type="text"/>

											<div class="k-invalid-msg" data-for="telefono"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_email">
                          	<span class="input-group-btn" title=" se define email">
                			<label for="email" class="btn-addons " style="padding-right: 5px;">Correo</label></span>
											<input value="" id="correo_solicitud"  name="solicitud[correo_solicitud]" readonly
												   placeholder="Inserte  email" type="text"/>

											<div class="k-invalid-msg" data-for="descripcion"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_direccion">
                          	<span class="input-group-btn" title=" se define l direccion">
                			<label for="direccion" class="btn-addons " style="padding-right: 5px;">Dirección</label></span>
											<textarea value="" id="direccion"  name="solicitud[direccion]" readonly
													  placeholder="Inserte  direccion" type="text"></textarea>

											<div class="k-invalid-msg" data-for="descripcion"></div>
										</div>
									</div>
									<div class="col-md-5">

									</div>
									<div class="col-md-1" id="panel_pic">
										<img  src="" alt="" id="img_negocio_detail"/>
									</div>
								</div>
								</fieldset>
								<div class="row">
									<div class="col-md-4">
										<h5> Listado de Negocios</h5>

										   <div id="gridselection_negocio_list" style="width:100%"></div>


									</div>

									<div class="col-md-6">
										<div class="box-header">
										<button type="button" id="accionbtn_aceptar_bussines_save_exit" class="btn btn-primary bg-green">Agregar</button>

											<button type="button" id="cancel_bussines_btn" class="btn btn-primary">Eliminar</button>


											<button type="button" id="accionbtn_finalizar_save_exit" class="btn btn-primary bg-red">Confirmar</button>


										</div>
										<div class="box wide">
											<h4>Procesar Solcitudes de Inscripción de Negocio</h4>
											<div id ="consolita" class="console"></div>
										</div>


									</div>
								</div>
								<div class="row">
									<div class="col-md-4">

									</div>
									<div class="col-md-6">

									</div>
								</div>
					</div>

					</form>

				</div>
			</div>

		</div>
		<div id="procesadas" class="tab-pane">

			<div class="content box box-primary">
				<h3>Solicitudes Procesadas</h3>

				<div id="gridselection_solicitud_negocio_procesadas" style="width:100%"></div>
				<div id="solicitud_procesada_window" style="display: none;">

					<div class="box-gestionando box-primary">
						<form method="post" id="solicitud_procesadas_form">
							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_categoria">
                          	<span class="input-group-btn" title=" se define la categoria">
                			<label for="categoria" class="btn-addons "
								   style="padding-right: 5px;">Categoría</label></span>
											<input id="categoria" required value="" type="text" readonly  name="solicitud_procesada[categoria]"/>

											<div class="k-invalid-msg" data-for="categoria"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_telefono">
                          	<span class="input-group-btn" title=" se define ltelefono">
                			<label for="telefono" class="btn-addons "
								   style="padding-right: 5px;">Teléfono</label></span>
											<input value="" id="telefono_fijo" name="solicitud_procesada[telefono_fijo]" readonly
												   placeholder="Inserte  telefono"/>

											<div class="k-invalid-msg" data-for="telefono"></div>
										</div>
									</div>


								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_nombre_negocio">
                          	<span class="input-group-btn" title=" se define el nombre del solicitud_procesada">
                			<label for="nombre_negocio" class="btn-addons " style="padding-right: 5px;">Negocio</label></span>
											<input id="nombre_negocio" required value="" type="text" readonly
												   name="solicitud_procesada[nombre_negocio]"/>

											<div class="k-invalid-msg" data-for="nombre_negocio"></div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="input-group margin" id="div_correo">
                          	<span class="input-group-btn" title=" se define l correo">
                			<label for="email" class="btn-addons " style="padding-right: 5px;">Correo</label></span>
											<input value="" id="correo" type="email" name="solicitud_procesada[correo]" readonly
												   placeholder="Inserte  email"/>

											<div class="k-invalid-msg" data-for="correo"></div>
										</div>
									</div>


								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="input-group margin" id="div_direccion_negocio">
                          	<span class="input-group-btn" title=" se define ldireccion_negocio">
                			<label for="direccion_negocio" class="btn-addons "
								   style="padding-right: 5px;">Dirección</label></span>
											<textarea class="form-control" value="" id="direccion_negocio" readonly
													  name="solicitud_procesada[direccion_negocio]"
													  placeholder="Inserte  direccion_negocio"></textarea

											<div class="k-invalid-msg" data-for="direccion_negocio"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">
										<div class="input-group margin" id="div_resenya_negocio">
                          	<span class="input-group-btn" title=" se define lresenya_negocio">
                			<label for="resenya_negocio" class="btn-addons "
								   style="padding-right: 5px;">Descripción</label></span>
											<textarea class="form-control" value="" id="resenya_negocio" readonly
													  name="solicitud_procesada[resenya_negocio]"
													  placeholder="Inserte  resenya_negocio"></textarea>

											<div class="k-invalid-msg" data-for="resenya_negocio"></div>
										</div>
									</div>
								</div>
								<div class="row">
									 	<span class="input-group-btn" >
									<label for="imagenes" class="btn-addons "
										   style="padding-right: 5px;"><b>Imágenes:</b></label></span>
									<div class="col-md-3">
										<img class="user-image img-circle"  id="foto" width="70px" height="70px" src="">
								</div>
									<div class="col-md-3">

										<img class="user-image img-circle"  id="foto1"  width="70px" height="70px" src="">
								</div>
									<div class="col-md-3">
										<img class="user-image img-circle"  id="foto2"  width="70px" height="70px" src="">

								</div>

								</div>
							</div>
						</form>
					</div>

				</div>


			</div>
		</div>
	</div>
	<div id="solicitud_confirmacion_window" >
		<div class="content box box-primary">
			<div class="box-header">
				<button type="button" id="accionbtn_procesar_solicitud" class="btn btn-primary">Aceptar</button>
				<button type="button" id="accionbtn_cancelar_pro_solicitud" class="btn  btn-primary">Cancelar</button>
			</div>
			<form  method="post" id="confirm_solicitud_form">
				<div class="form-group">
					<h5> La aceptación de la solicitud de inscripción implica el rechazo de los siguientes negocios: </h5>
					<div class="row">
						<div class="col-md-8">
							<div class="input-group margin" id= "div_asunto_solicitudes_rechazada">
                          	<span class="input-group-btn" title=" se define el asunto">
                			<label for="asunto_solicitudes_rechazada" class="btn-addons" style="padding-right: 5px;">Asunto </label></span>
							<textarea    id="asunto_solicitudes_rechazada"   name="solcitud_procesar[asunto_solicitudes_rechazada]"
										 readonly placeholder="Escriba el asunto"></textarea>
								<div class="k-invalid-msg" data-for="asunto_solicitudes_rechazada"></div>
							</div>
						</div>

					</div>
					<div class="row">
						<div class="col-md-6">
							<div class="input-group margin" id= "div_descripcion_solicitudes_rechazada">
                          	<span class="input-group-btn" title="se define l descripcion">
						<label for="descripcion_solicitudes_rechazada" class="btn-addons" style="padding-right: 5px;">Descripción de la denegación de la solicitud*</label></span>
							<textarea id="descripcion_solicitudes_rechazada"  required name="solcitud_procesar[descripcion_solicitudes_rechazada]"
									  placeholder="Inserte la  descripción" ></textarea>
								<div class="k-invalid-msg" data-for="descripcion_solicitudes_rechazada"></div>
							</div>

							<div class="col-md-4">
								<h5>Nota: La descripción se enviará al solicitante </h5>
							</div>

						</div>

					</div>

					<input class="form-control" value=" " type="hidden" id="taskconfirm"/>
				</div>
				<?php echo JHtml::_('form.token');  ?>
			</form>
		</div>
	</div>
	</div>


<div class="info-box bg-green" style="display: none" id="message-ok">
	<span class="info-box-icon"><i class="fa fa-thumbs-o-up" style="font-size: 50px"></i></span>

	<div class="info-box-content">
		<span class="info-box-text">Acción realizada </br> correctamente </span>
	</div><!-- /.info-box-content -->
</div>
<div class="info-box bg-red" style="display: none" id="message-error">
	<span class="info-box-icon"><i class="fa fa-frown-o" style="font-size: 50px"></i></span>

	<div class="info-box-content">
		<span class="info-box-text" style="font-size: 10px" id="text-error"> </span>
	</div><!-- /.info-box-content -->
</div>

</body>