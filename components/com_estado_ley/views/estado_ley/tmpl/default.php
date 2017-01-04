
<?php
$componentbase =  $this->_basePath;         ?>
<html xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html" xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Estado Ley </title>

</head>
<body class="skin-blue sidebar-mini">


			<section class="content-header">
				<h1>
					Gestionar Estados de Ley
				</h1>
				<ol class="breadcrumb">
					<div class="btn-group">
						<button class="btn btn-action" id="addbutton_ley" data-toggle='tooltip' title='ley_add' >
							<i class="fa fa-edit"></i> Nuevo
						</button>
						<button class="btn bg-red  btn-action" id="deletebutton_ley" data-toggle='tooltip' title='ley_delete' >
							<i class="fa fa-trash"></i> Eliminar
						</button>
					</div>
				</ol>
			</section>
			</br>
			<div class="content box box-primary" id ="este">
				<div id="gridselection_estado_ley"  style="width:100%"></div>
			</div>

			<div id="ley_window" style="display: none;" >



				<div class="box-gestionando box-primary">

					<div class="box-header">
						<button type="button" id="accionbtn_leysave_exit" class="btn btn-primary">Guardar y Salir</button>
						<button type="button" id="accionbtn_leysave_new" class="btn  btn-primary">Guardar y Crear</button>
					</div>

					<form role="form" method="post" id="ley_form" class="form-validate">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="input-group margin" id= "div_estado">
                          	<span class="input-group-btn" title=" se define el estado">
                			<label for="estado" class="btn-addons " style="padding-right: 5px;">Estado*</label></span>
										<input   value="" id="estado" required  name="ley[estado]"  placeholder="Escriba el estado" type="text"/>
										<div class="k-invalid-msg" data-for="estado"></div>
									</div>
								</div>

							</div>
						</div>


							<input class="text-input"  value="" type="hidden" id="taskley">
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