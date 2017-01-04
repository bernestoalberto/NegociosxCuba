
<?php
$componentbase =  $this->_basePath;         ?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html"
	  xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Publicidad </title>
	<script type="text/x-kendo-template" id="template_publicidad">
		<div class="tabstrip">
			<ul>
				<li class="k-state-active">
					<b style="background: rgb(0,0,0);">Detalles </b>
				</li>
				<!---    <li>
                       Detalles adicionales del usuario
                    </li>-->
			</ul>
			<div>
				<div class="orders"></div>
			</div>
			<div>
			<!---	<div class='employee-details'>
					<ul>
						<li> <label>Asunto:</label>#= asunto #</li>
						<li> <label>Descripción:</label>#= descripcion #</li>
						<li> <label>Asisgnado a:</label>#= persona #</li>

					</ul>
				</div>-->
			</div>
		</div>

	</script>
</head>
<body class="skin-blue sidebar-mini">


			<section class="content-header">
				<h1>
					Solicitudes de Publicidad
				</h1>

			</section>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li class="active"><a data-toggle="tab" href="#sin_procesar">Solcitudes Sin Procesar</a></li>
					<li><a data-toggle="tab" href="#sol_atendidas">Solcitudes Atendidas</a></li>

				</ul>

				<div class="tab-content">
					<div id="sin_procesar" class="tab-pane active">
			<div class="content box box-primary" id ="este">
				<div id="gridselection_publicidad"  style="width:100%"></div>
			</div>

			<div id="publicidad_window" style="display: none;" >



				<div class="box-gestionando box-primary">

					<form role="form" method="post" id="publicidad_form" class="form-validate">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="input-group margin" id= "div_usuario">
                          	<span class="input-group-btn" title=" se define lusuario">
                			<label for="id_user" class="btn-addons " style="padding-right: 5px;">Usuario</label></span>
											<input  id="id_user"   readonly name="comentario[id_user]"  placeholder="Inserte  usuario" type="text" />
										<div class="k-invalid-msg" data-for="id_user"></div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group margin" id= "div_fecha">
                          	<span class="input-group-btn" title=" se define fecha">
                			<label for="fecha" class="btn-addons " style="padding-right: 5px;">Fecha</label></span>
										<input value="" id="fecha"  readonly name="comentario[fecha]"  placeholder="Inserte  fecha" type="text" />
										<div class="k-invalid-msg" data-for="fecha"></div>
									</div>
								</div>

								</div>
							<div class="row">
								<div class="col-md-8">
									<div class="input-group margin" id= "div_asunto">
                          	<span class="input-group-btn" title=" se define el asunto">
                			<label for="asunto" class="btn-addons " style="padding-right: 5px;">Asunto</label></span>
										<input   value="" id="asunto"  readonly name="publicidad[asunto]"  placeholder="Escriba el asunto" type="text"/>
										<div class="k-invalid-msg" data-for="asunto"></div>
									</div>
								</div>


							</div>
							<div class="row">
								<div class="col-md-8">
									<div class="input-group margin" id= "div_descripcion">
                          	<span class="input-group-btn" title=" se define ldescripcion">
                			<label for="descripcion" class="btn-addons " style="padding-right: 5px;">Descripción</label></span>
										<textarea value="" id="descripcion"  readonly name="publicidad[descripcion]"  placeholder="Inserte  descripcion" type="text" ></textarea>
										<div class="k-invalid-msg" data-for="descripcion"></div>
									</div>
								</div>
							</div>

						</div>

							<input class="text-input"  value="" type="hidden" id="taskpublicidad">
						</div>
						<?php echo JHtml::_('form.token');  ?>
					</form>
				</div>
</div>

			<div id="asignar_publicidad_window" style="display: none;" >

				<div class="box-header">
					<button type="button" id="aceptar" class="btn btn-primary">Asignar</button>
					<button type="button" id="rechazar" class="btn btn-primary">Rechazar</button>
				</div>
				<div class="box-gestionando box-primary">
				<form role="form" method="post" id="publicidad_asiganda_form" class="form-validate">
					<div class="form-group">
						<div class="row">
							<div class="col-md-4">
								<div class="input-group margin" id= "div_asignado">
                          	<span class="input-group-btn" title=" se define lasignado">
                			<label for="id_persona" class="btn-addons " style="padding-right: 5px;">Asignado*</label></span>
									<input value="" id="id_persona" required   name="asignar_publicidad[id_persona]"  placeholder="Inserte  asignado" type="text" />
									<div class="k-invalid-msg" data-for="id_persona"></div>
								</div>
							</div>


						</div>
						<div class="row">
							<div class="col-md-4">
								<div class="demo-section k-content" id= "div_estado">
									<input class="text-input"  value="" name="asignar_publicidad[stato]" type="hidden" id="stato"/>
								</div>
							</div>
						</div>

						<div class="row">
							<div class="col-md-8">
								<div class="input-group margin" id= "div_descripcion_asig_publicidad">
                          	<span class="input-group-btn" title=" se define l descripcion">
                			<label for="descripcion_asig_publicidad" class="btn-addons " style="padding-right: 5px;">Descripción*</label></span>
									<textarea value="" id="descripcion_asig_publicidad"  required  name="asignar_publicidad[descripcion_asig_publicidad]"  placeholder="Inserte  descripcion" type="text" ></textarea>
									<div class="k-invalid-msg" data-for="descripcion_asig_publicidad"></div>
								</div>
							</div>
							</div>
						</div>
					<input class="text-input"  value="" type="hidden" id="taskpublicidadasignada">
					</div>
					<?php echo JHtml::_('form.token');  ?>
					</form>

				</div>
					<div id="sol_atendidas" class="tab-pane">
						<div class="content box box-primary" id ="aquel">
							<div id="gridselection_publicidad_atendida"  style="width:100%"></div>
						</div>
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
			</div>
		</body>