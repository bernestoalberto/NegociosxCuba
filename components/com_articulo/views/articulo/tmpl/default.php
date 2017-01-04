<?php

defined('_JEXEC') or die('acceso no autorizado');
JHtml::_('behavior.formvalidation');

$componentbase = $this->_basePath;

?>
<html xmlns="http://www.w3.org/1999/html">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Gestionar Articulo</title>

	<script type="text/x-kendo-template" id="template_articulo">
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
			<!---	<div class='articulo-details'>
					<ul>
						<li><label>Inicio Publicación:</label>#= inicio_publicacion #</li>
						<li><label>Fin Publicación:</label>#= fin_publicacion #</li>
						<li><label>Palabras Claves:</label>#= palabras_claves #</li>
						<li><label>Página Principal:</label>#= pagina_principal #</li>
						<li><label>Fotógrafo:</label>#= fotograph #</li>

					</ul>
				</div>-->
			</div>
		</div>

	</script>



</head>
<body class="skin-blue sidebar-mini">


<div>
	<section class="content-header">
		<h1>
			Gestionar Articulos
		</h1>
		<ol class="breadcrumb">
			<div class="btn-group">
				<button class="btn btn-action" id="addbutton_articulo" data-toggle='tooltip' title='articulo_add' >
					<i class="fa fa-edit"></i> Nuevo
				</button>
				<button class="btn bg-red  btn-action" id="deletebutton_articulo" data-toggle='tooltip' title='articulo_delete' >
					<i class="fa fa-trash"></i> Eliminar
				</button>
			</div>
		</ol>
	</section>
	</br>
	<div class="content box box-primary">

		<div id="gridselection_articulo"  style="width:100%"></div>
	</div>

	<div id="articulo_window" style="display: none;" >

		<div class="box-gestionando box-primary">

			<div class="box-header">
				<button type="button" id="accionbtn_articulosave_exit" class="btn btn-primary">Guardar y Salir</button>
				<button type="button" id="accionbtn_articulosave_new" class="btn btn-primary">Guardar y Crear</button>
			</div>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#overall">Datos Generales</a></li>
					<li><a data-toggle="tab" href="#info">Artículo</a></li>

				</ul>
				<form  method="post" id="articulo_form"  >
					<div class="tab-content">
						<div id="overall" class="tab-pane active">

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_id_categoria">
                          	<span class="input-group-btn" title=" se define el nombre d l categoria">
                			<label for="id_categoria" class="btn-addons " style="padding-right: 5px;">Categoria*</label></span>
											<input   id="id_categoria"  required value="" type="text" name="articulo[id_categoria]" />
											<div class="k-invalid-msg" data-for="id_categoria"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_autor">
                          	<span class="input-group-btn" title=" se define l autor">
                			<label for="autor" class="btn-addons " style="padding-right: 5px;">Autor*</label></span>

											<input  value="" id="autor" required type="text" name="articulo[autor]"
													placeholder="Inserte  autor"/>
											<div class="k-invalid-msg" data-for="autor"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_fotografo">
                          	<span class="input-group-btn" title=" se define el fotografo">
                			<label for="fotografo" class="btn-addons " style="padding-right: 5px;">Fotógrafo</label></span>
											<input   id="fotografo"   value="" type="text" name="articulo[fotografo]" />
											<div class="k-invalid-msg" data-for="fotografo"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_ley_asociada">
                          	<span class="input-group-btn" title=" se define lley_asociada">
                			<label for="ley_asociada" class="btn-addons " style="padding-right: 5px;">Ley Asociada</label></span>

											<input  value="" id="ley_asociada"  type="text" name="articulo[ley_asociada]"
													placeholder="Inserte  ley_asociada"/>
											<div class="k-invalid-msg" data-for="ley_asociada"></div>
										</div>
									</div>
								</div>


								<div class="row">
									<div class="col-md-4">

										<div class="input-group margin" id= "div_acceso">
                          	<span class="input-group-btn" title=" se define l acceso">
                			<label for="acceso" class="btn-addons " style="padding-right: 5px;">Acceso*</label></span>
											<input   id="acceso"  required value="" type="text" name="articulo[acceso]" />
											<div class="k-invalid-msg" data-for="acceso"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_inicio_publicacion">
                          	<span class="input-group-btn" title=" se define l inicio_publicacion">
                			<label for="inicio_publicacion" class="btn-addons " style="padding-right: 5px;">Inicio Publicación</label></span>
											<input  value="" id="inicio_publicacion" type="text"  name="articulo[inicio_publicacion]"  placeholder="Inserte  inicio_publicacion" />
											<div class="k-invalid-msg" data-for="inicio_publicacion"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										</div>
										<div class="col-md-4">
										<div class="input-group margin" id= "div_fin_publicacion">
                          	<span class="input-group-btn" title=" se define l fin_publicacion">
                			<label for="fin_publicacion" class="btn-addons " style="padding-right: 5px;">Fin Publicación</label></span>
											<input   id="fin_publicacion" type="text"  name="articulo[fin_publicacion]"  placeholder="Inserte  fin_publicacion" />
											<div class="k-invalid-msg" data-for="fin_publicacion"></div>
										</div>
									</div>


								</div>

								<div class="row">
									<div class="col-md-6">
										<div class="input-group margin" id= "div_state">
                          	<span class="input-group-btn" title=" se define l  state">
                			<label for="state" class="btn-addons" style="padding-right: 5px;">Estado</label></span>
											<input  type="text"  id="state"  type="text" name="articulo[state]"  placeholder="Inserte  state" />
											<div class="k-invalid-msg" data-for="state"></div>
										</div>
									</div>
									</div>
								<div class="row">

									<div class="col-md-6">
										<div class="input-group margin" id= "div_pagina_principal">
                          	<span class="input-group-btn" title=" se define l  pagina_principal">
                			<label for="pagina_principal"  style="padding-right: 5px;">Incluir el Articulo en la Página Principal</label></span>
											<input  type="checkbox" id="pagina_principal" class="k-checkbox" 
													type="text" name="articulo[pagina_principal]"  placeholder="Inserte  pagina_principal" />
											<div class="k-invalid-msg" data-for="pagina_principal"></div>
										</div>
									</div>


								</div>


							</div>

						</div>


						<div id="info" class="tab-pane ">

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_titulo">
                          	<span class="input-group-btn" title=" se define el titulo">
                			<label for="titulo" class="btn-addons " style="padding-right: 5px;">Titulo*</label></span>
											<input   id="titulo_articulo"  required value="" type="text" name="articulo[titulo_articulo]" />
											<div class="k-invalid-msg" data-for="titulo"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_epigrafe">
                          	<span class="input-group-btn" title=" se define el nombre del articulo">
                			<label for="epigrafe" class="btn-addons " style="padding-right: 5px;">Epígrafe</label></span>
											<input   id="epigrafe"   value="" type="text" name="articulo[epigrafe]" />
											<div class="k-invalid-msg" data-for="epigrafe"></div>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-4">

										<div class="input-group margin" id= "div_palabras_claves">
                          	<span class="input-group-btn" title=" se define el palabras_claves">
                			<label for="palabras_claves" class="btn-addons " style="padding-right: 5px;">Palabras Claves*</label></span>
											<input   id="palabras_claves"  required value="" type="text" name="articulo[palabras_claves]" />
											<div class="k-invalid-msg" data-for="palabras_claves"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_bajante">
                          	<span class="input-group-btn" title=" se define el nombre del bajante">
                			<label for="bajante" class="btn-addons " style="padding-right: 5px;">Bajante</label></span>
											<textarea   id="bajante"   value="" type="text" name="articulo[bajante]" ></textarea>
											<div class="k-invalid-msg" data-for="bajante"></div>
										</div>
									</div>


								</div>

								<div class="row">
									<div class="col-md-6">

										<div class="input-group margin" id= "div_anuncio">
                          	<span class="input-group-btn" title=" se define l anuncio">
                			<label for="anuncio" class="btn-addons " style="padding-right: 5px;">Anuncio</label></span>
											<textarea   id="anuncio"   value="" type="anuncio" name="articulo[anuncio]" ></textarea>
											<div class="k-invalid-msg" data-for="anuncio"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-8">

										<div class="input-group margin" id= "div_editor">
                         					<textarea   id="editor"   rows="10" cols="20"  name="articulo[editor]" ></textarea>
											<div class="k-invalid-msg" data-for="editor"></div>
										</div>
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
						<input class="input-group margin" class="form-control" value="" type="hidden" id="taskarticulo"/>
					</div>

					<?php echo JHtml::_('form.token');  ?>


			</form>
			</div>
		</div>
	</div>


</div>
</div>

</body>