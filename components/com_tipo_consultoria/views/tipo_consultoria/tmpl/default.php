
<?php
$componentbase =  $this->_basePath;         ?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Solicitud </title>

</head>
<body class="skin-blue sidebar-mini">


			<section class="content-header">
				<h1>
					Tipos de Consultoria
				</h1>
				<ol class="breadcrumb">
					<div class="btn-group">
						<button class="btn btn-action" id="addbutton_type_consulting" data-toggle='tooltip' title='type_consulting_add' >
							<i class="fa fa-edit"></i> Nuevo
						</button>
						<button class="btn bg-red  btn-action" id="delete_element_tipo_consultoria" data-toggle='tooltip' title='type_consulting_delete' >
							<i class="fa fa-trash"></i> Eliminar
						</button>
					</div>
				</ol>
			</section>
			</br>
			<div class="content box box-primary" id ="este">
				<div id="gridselection_tipo_consultoria"  style="width:100%"></div>
			</div>

			<div id="type_consulting_window" style="display: none;" >



				<div class="box-gestionando box-primary">

					<div class="box-header">
						<button type="button" id="accionbtn_type_consultingsave_exit" class="btn btn-primary">Guardar y Salir</button>
						<button type="button" id="accionbtn_type_consultingsave_new" class="btn  btn-primary">Guardar y Crear</button>
					</div>

					<form role="form" method="post" id="type_consulting_form" class="form-validate">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="input-group margin" id= "div_consultoria">
                          	<span class="input-group-btn" title=" se define el consultoria">
                			<label for="consultoria" class="btn-addons " style="padding-right: 5px;">Consultoria*</label></span>
										<input   value="" id="consultoria" required  name="type_consulting[consultoria]"  placeholder="Escriba el consultoria" type="text"/>
										<div class="k-invalid-msg" data-for="consultoria"></div>
									</div>
								</div>

						</div>
										<input class="text-input"  value="" type="hidden" id="tasktype_consulting">
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
			</div>
		</body>