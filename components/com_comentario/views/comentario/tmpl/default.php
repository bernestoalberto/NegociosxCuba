
<?php
$componentbase =  $this->_basePath;         ?>
<html xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Gestionar Comentarios </title>
	<script type="text/x-kendo-template" id="template_comentario">
		<div class="tabstrip">

			<div>
				<div class="orders"></div>
			</div>
			<div>
				<div class='employee-details'>
					<ul>
						<label>Comentario:</label>#= comentario #

					</ul>
				</div>
			</div>
		</div>
	</script>

</head>
<body class="skin-blue sidebar-mini">


			<section class="content-header">
				<h1>
					Gestionar Comentarios
				</h1>
				<ol class="breadcrumb">
					<div class="btn-group">
						<button class="btn bg-red  btn-action" id="deletebutton_soliciud" data-toggle='tooltip' title='comentario_delete' >
							<i class="fa fa-trash"></i> Eliminar
						</button>
					</div>
				</ol>
			</section>
			</br>
			<div class="content box box-primary" id ="este">
				<div id="gridselection_comentario"  style="width:100%"></div>
			</div>

			<div id="comentario_window" style="display: none;" >



				<div class="box-gestionando box-primary">


					<form role="form" method="post" id="comentario_form" class="form-validate">
						<div class="form-group">
							<div class="row">
								<div class="col-md-4">
									<div class="input-group margin" id= "div_usuario">
                          	<span class="input-group-btn" title=" se define lusuario">
                			<label for="id_user" class="btn-addons " style="padding-right: 5px;">Usuario</label></span>
										<input  id="id_user" required  readonly name="comentario[id_user]"  placeholder="Inserte  usuario" type="text" />
										<div class="k-invalid-msg" data-for="id_user"></div>
									</div>
								</div>
								<div class="col-md-4">
									<div class="input-group margin" id= "div_categoria">
                          	<span class="input-group-btn" title=" se define el categoria">
                			<label for="id_categoria" class="btn-addons " style="padding-right: 5px;">Categoria</label></span>
										<input   value="" id="id_categoria" required readonly name="comentario[id_categoria]"  placeholder="Escriba el categoria" type="text"/>
										<div class="k-invalid-msg" data-for="id_categoria"></div>
									</div>
								</div>

							</div>
						</div>

							<div class="row">
								<div class="col-md-4">
									<div class="input-group margin" id= "div_titulo">
                          	<span class="input-group-btn" title=" se define ltitulo">
                			<label for="titulo" class="btn-addons " style="padding-right: 5px;">Titulo</label></span>
										<input value="" id="titulo" required readonly name="comentario[titulo]"  placeholder="Inserte  titulo" type="text" />
										<div class="k-invalid-msg" data-for="titulo"></div>
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
									<div class="input-group margin" id= "div_comentario">
                          	<span class="input-group-btn" title=" se define lcomentario">
                			<label for="comentario" class="btn-addons " style="padding-right: 5px;">Comentario</label></span>
										<textarea value="" id="comentario" required readonly name="comentario[comentario]"  placeholder="Inserte  comentario" type="text" ></textarea>
										<div class="k-invalid-msg" data-for="comentario"></div>
									</div>
								</div>
							</div>



							<input class="text-input"  value="" type="hidden" id="taskcomentario">
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