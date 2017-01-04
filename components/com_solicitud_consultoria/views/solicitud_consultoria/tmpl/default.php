
<?php
$componentbase =  $this->_basePath;         ?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Solicitud de Consultoria </title>

</head>
<body class="skin-blue sidebar-mini">
<h3>   Procesar Solicitudes de Consultoria</h3>
<div class="nav-tabs-custom">
	<ul class="nav nav-tabs">
		<li class="active"><a data-toggle="tab" href="#sinprocesar">Solcitudes Sin Procesar</a></li>
		<li><a data-toggle="tab" href="#procesadas">Consultorías Asignadas</a></li>

	</ul>

	<div class="tab-content">
		<div id="sinprocesar" class="tab-pane active">
			<div>
				<div class="content box box-primary" id="este">
					<h3> Solicitudes Sin Procesar</h3>

					<div id="gridselection_solicitud_consultoria" style="width:100%"></div>
				</div>

				<div id="consulting_sin_procesar_window" style="display: none;">

					<div class="box-gestionando box-primary">

						<form role="form" method="post" id="solicitud_consulting_wth_form" class="form-validate">
							<fieldset>
							<div class="form-group">

								<div class="row">
									<div class="col-md-4">
										<img class="user-image img-circle"  id="foto_perfil_consulting" width="70px" height="70px" src="">
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_nombre">
                          	<span class="input-group-btn" title=" se define el nombre">
                			<label for="nombre" class="btn-addons " style="padding-right: 5px;">Nombre</label></span>
											<input value="" id="nombre"  name="solicitud_consulting[nombre]" readonly
												   placeholder="Inserte  nombre" type="text"/>

											<div class="k-invalid-msg" data-for="descripcion"></div>
										</div>
									</div>
									</div>
								<div class="row">

									<div class="col-md-4">
										<div class="input-group margin" id="div_tipo_consultoria">
                          	<span class="input-group-btn" title=" se define l tipo_consultoria">
                			<label for="tipo_consultoria" class="btn-addons " style="padding-right: 5px;">Tipo de Consultoria</label></span>
											<input value="" id="tipo_consultoria"  name="solicitud_consulting[tipo_consultoria]" readonly
												   placeholder="Inserte  tipo_consultoria" type="text"/>

											<div class="k-invalid-msg" data-for="tipo_consultoria"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_fecha">
                          	<span class="input-group-btn" title=" se define el fecha">
                			<label for="fecha" class="btn-addons " style="padding-right: 5px;">Fecha</label></span>
											<input value="" id="fecha"  name="solicitud_consulting[fecha]" readonly
												   placeholder="Inserte  fecha" type="text"/>

											<div class="k-invalid-msg" data-for="descripcion"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_asunto">
                          	<span class="input-group-btn" title=" se define el asunto">
                			<label for="asunto" class="btn-addons " style="padding-right: 5px;">Asunto</label></span>
											<input value="" id="asunto_consulting" required name="solicitud_consulting[asunto_consulting]" readonly
												   placeholder="Escriba el asunto" type="text"/>

											<div class="k-invalid-msg" data-for="asunto"></div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_descripcion">
                          	<span class="input-group-btn" title=" se define l descripcion">
                			<label for="descripcion" class="btn-addons " style="padding-right: 5px;">Descripción</label></span>
											<textarea value="" id="descripcion_read"  name="solicitud_consulting[descripcion_read]"readonly
													  placeholder="Inserte  descripcion" type="text"></textarea>

											<div class="k-invalid-msg" data-for="descripcion"></div>
										</div>
									</div>
								</div>
                             <h3>Asignacion de Solicitud de Consultoria</h3>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_id_consultor">
                          	<span class="input-group-btn" title=" se define el id_consultor">
                			<label for="id_consultor" class="btn-addons " style="padding-right: 5px;">Asignar a*</label></span>
											<input value="" id="id_consultor_asig" required name="solicitud_consulting[id_consultor_asig]"
												   placeholder="Escriba el id_consultor" type="text"/>

											<div class="k-invalid-msg" data-for="id_consultor"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_descripcion_w">

                			<label for="descripcion_write" class="btn-addons " style="padding-right: 5px;">Descripción de la Asignación de la Solicitud*</label>
											<textarea value="" id="descripcion_write" required name="solicitud_consulting[descripcion_write]"
													  placeholder="Inserte  descripcion_write" type="text"></textarea>

											<div class="k-invalid-msg" data-for="descripción"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<h4>Nota: La descripción se enviara al consultor.</h4>
								</div>
								<div class="box-header">
									<button type="button" id="aceptar_consultoria" class="btn btn-primary">Aceptar </button>
									<button type="button" id="denegar_consultoria_s" class="btn btn-primary">Denegar</button>
									<button type="button" id="cancel_consultoria_s" class="btn btn-primary">Cancelar</button>
								</div>
								<input class="text-input" value="" type="hidden" id="taskconsultoria_wth">

							</div>
							<?php echo JHtml::_('form.token'); ?>
							</fieldset>
						</form>

					</div>
				</div>
			</div>
		</div>

		<div id="procesadas" class="tab-pane">

			<div class="content box box-primary">
				<h3>Consultorías Asignadas</h3>

				<div id="gridselection_solicitud_consultoria_asiganda" style="width:100%"></div>
				<div id="solicitud_procesada_consulting_window" style="display: none;">

					<div class="box-gestionando box-primary">

						<form method="post" id="solicitud_procesadas_consulting_form">
							<fieldset>
							<div class="form-group">
								<div class="row">
								<div class="col-md-4">
									<img class="user-image img-circle"  id="foto_perfil_procesada" width="70px" height="70px" src="">
								</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_fecha_sol_consulting">
                          	<span class="input-group-btn" title=" se define la consultoria">
                			<label for="fecha_sol_consulting" class="btn-addons "
								   style="padding-right: 5px;">Fecha</label></span>
											<input id="fecha_sol_consulting"  value="" type="text" disabled="disabled"  name="solicitud_procesada[fecha_sol_consulting]"/>

											<div class="k-invalid-msg" data-for="fecha_sol_consulting"></div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_name_emprendedor">
                          	<span class="input-group-btn" title=" se define el Usuario">
                			<label for="nombre_emprendedor" class="btn-addons "
								   style="padding-right: 5px;">Nombre</label></span>
											<input id="nombre_emprendedor" required value="" type="text" disabled="disabled"  name="solicitud_procesada[nombre_emprendedor]"/>

											<div class="k-invalid-msg" data-for="nombre_emprendedor"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_tipo_consultoria_asingada">
                          	<span class="input-group-btn" title=" se define l tipo_consultoria_asingada">
                			<label for="tipo_consultoria_asingada" class="btn-addons "
								   style="padding-right: 5px;">Tipo de Consultoria</label></span>
											<input value="" id="tipo_consultoria_asingada" name="solicitud_procesada[tipo_consultoria_asingada]" disabled="disabled"
												   placeholder="Inserte  tipo_consultoria_asingada"/>

											<div class="k-invalid-msg" data-for="tipo_consultoria_asingada"></div>
										</div>
									</div>


								</div>
								<div class="row">
									<div class="col-md-6">
										<div class="input-group margin" id="div_nombre_asunto">
                          	<span class="input-group-btn" title=" se define el asunto">
                			<label for="asunto_procesado" class="btn-addons " style="padding-right: 5px;">Asunto</label></span>
											<input id="asunto_procesado" required value="" type="text" disabled="disabled"
												   name="solicitud_procesada[asunto_procesado]"/>

											<div class="k-invalid-msg" data-for="asunto_procesado"></div>
										</div>
									</div>


								</div>

								<div class="row">
									<div class="col-md-8">
										<div class="input-group margin" id="div_descripcion_consulting">
                          	<span class="input-group-btn" title=" se define l descripcion_consulting">
                			<label for="descripcion_consulting" class="btn-addons "
								   style="padding-right: 5px;">Descripción</label></span>
											<textarea class="form-control" value="" id="descripcion_consulting" disabled="disabled"
													  name="solicitud_procesada[descripcion_consulting]"
													  placeholder="Inserte  descripcion_consulting"></textarea

											<div class="k-invalid-msg" data-for="descripcion_consulting"></div>
										</div>
									</div>
								</div>

								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id="div_id_consultor_procesado">
                          	<span class="input-group-btn" title=" se define l id_consultor_procesado">
                			<label for="id_consultor_procesado" class="btn-addons "
								   style="padding-right: 5px;">Asignado a</label></span>
											<input class="form-control" value="" id="id_consultor_procesado" disabled="disabled"
													  name="solicitud_procesada[id_consultor_procesado]"
													  placeholder="Inserte  id_consultor_procesado"/>

											<div class="k-invalid-msg" data-for="id_consultor_procesado"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id="div_resenya_negocio">
                          	<span class="input-group-btn" title=" se define l fecha_asignacion">
                			<label for="fecha_asignacion" class="btn-addons "
								   style="padding-right: 5px;">Fecha de Asignación</label></span>
											<input class="form-control" value="" id="fecha_asignacion" disabled="disabled"
													  name="solicitud_procesada[fecha_asignacion]"
													  placeholder="Inserte  fecha_asignacion"/>

											<div class="k-invalid-msg" data-for="fecha_asignacion"></div>
										</div>
									</div>
								</div>

								<div class="row">


									<div class="col-md-8">
										 	<span class="input-group-btn" >
									<label for="descripcion_consulting_asing" class="btn-addons "
										   style="padding-right: 5px;"><b>Descripción de la Asignación de la Solicitud:</b></label></span>
										<div class="input-group margin" id="div_descripcion_consulting_asing">
											<textarea class="form-control" value="" id="descripcion_consulting_asing" disabled="disabled"
													  name="solicitud_procesada[descripcion_consulting_asing]"
													  placeholder="Inserte  descripcion_consulting_asing"></textarea

											<div class="k-invalid-msg" data-for="descripcion_consulting_asing"></div>
										</div>
									</div>
								</div>
								<input value="" type="hidden" id="taskprocesadas_consulting"/>
							</div>

							<?php echo JHtml::_('form.token'); ?>
							</fieldset>
						</form>

					</div>

				</div>


			</div>
		</div>


	</div>


</div>

<div id="consultoria_denegada_window" style="display: none;" >

	<div class="box-gestionando box-primary">
		<div class="box-header">
			<button type="button" id="accionbtn_denegar" class="btn btn-primary">Denegar</button>
			<button type="button" id="accionbtn_consultoria_denegar" class="btn  btn-primary">Cancelar</button>
		</div>
		<form role="form" method="post" id="denial_form" class="form-validate">
			<div class="form-group">
				<h5> La denegación implica el  rechazo de la siguiente solicitud de auditoria: </h5>
				<div class="row">
					<div class="col-md-8">
						<div class="input-group margin" id= "div_asunto_consultoria_denial">
                          	<span class="input-group-btn" title=" se define el asunto">
                			<label for="asunto_consultoria_denial" class="btn-addons " style="padding-right: 5px;">Asunto                                            </label></span>
							<textarea   value="" id="asunto_consultoria_denial" required  name="solcitud_denial[asunto_consultoria_denial]"
										disabled="disabled" placeholder="Escriba el asunto" type="text"></textarea>
							<div class="k-invalid-msg" data-for="asunto_consultoria_denial"></div>
						</div>
					</div>

				</div>
				<div class="row">
					<div class="col-md-8">
						<div class="input-group margin" id= "div_descripcion_consultoria">
                          	<span class="input-group-btn" title=" se define ldescripcion">
                			<label for="descripcion_denial_acceptance" class="btn-addons " style="padding-right: 5px;">Descripción de la denegación de la solicitud*</label></span>
							<textarea value="" id="descripcion_denial_acceptance"  required name="solcitud_denial[descripcion_denial_acceptance]" placeholder="Inserte la  descripción" ></textarea>
							<div class="k-invalid-msg" data-for="descripcion_denial_acceptance"></div>
						</div>
					</div>
					<div class="col-md-6">
						<h5>Nota: La descripción se enviará al solicitante </h5>
					</div>

				</div>

			</div>

			<input class="text-input"  value="" type="hidden" id="taskdenial">
	</div>
	<?php echo JHtml::_('form.token');  ?>
	</form>

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