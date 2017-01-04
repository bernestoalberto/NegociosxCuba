<?php

defined('_JEXEC') or die('acceso no autorizado');
JHtml::_('behavior.formvalidation');

$componentbase = $this->_basePath;

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<title>Gestionar Ley</title>

	<script type="text/x-kendo-template" id="template_ley">
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
						<li><label>Inicio Publicación:</label>#= inicio_publicacion #</li>
						<li><label>Fin Publicación:</label>#= fin_publicacion #</li>
						<li><label>Autor:</label>#= author #</li>
						<li><label>Estado:</label>#= state #</li>
						<li><label>Epigrafe:</label>#= epigrafe #</li>
						<li><label>Organismo:</label>#= organism #</li>
						<li><label>Palabras Claves:</label>#= palabras_claves_general #</li>

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
			Gestionar Leyes
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
	<div class="content box box-primary">

		<div id="gridselection_ley"  style="width:100%"></div>
	</div>

	<div id="ley_window" style="display: none;" >

		<div class="box-gestionando box-primary">

			<div class="box-header">
				<button type="button" id="accionbtn_leysave_exit" class="btn btn-primary">Guardar y Salir</button>
				<button type="button" id="accionbtn_leysave_new" class="btn btn-primary">Guardar y Crear</button>
			</div>
			<div class="nav-tabs-custom">
				<ul class="nav nav-tabs">
					<li ><a data-toggle="tab" href="#overall">Datos Generales</a></li>
					<li><a data-toggle="tab" href="#info">Info Asociada</a></li>

				</ul>
				<form  method="post" id="ley_form"  >
				<div class="tab-content">
					<div id="overall" class="tab-pane active">

							<div class="form-group">
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_numero_gaceta">
                          	<span class="input-group-btn" title=" se define el nombre el numero_gaceta">
                			<label for="numero_gaceta" class="btn-addons " style="padding-right: 5px;">Numero Gaceta*</label></span>
											<input   id="numero_gaceta"  required value="" type="text" name="ley[numero_gaceta]" />
											<div class="k-invalid-msg" data-for="numero_gaceta"></div>
										</div>
									</div>
									<div class="col-md-4">

										<div class="input-group margin" id= "div_anyo_gaceta">
                          	<span class="input-group-btn" title=" se define l anyo_gaceta">
                			<label for="anyo_gaceta" class="btn-addons " style="padding-right: 5px;">Año Gaceta*</label></span>
											<input   id="anyo_gaceta"  required value="" type="text" name="ley[anyo_gaceta]" />
											<div class="k-invalid-msg" data-for="anyo_gaceta"></div>
										</div>
									</div>

								<div class="row">

									<div class="col-md-4">e
										<div class="input-group margin" id= "div_documento">
                          	<span class="input-group-btn" title=" se define ldocumento">
                			<label for="documento" class="btn-addons " style="padding-right: 5px;">Documento*</label></span>

											<input  value="" id="documento" required type="file" name="ley[documento]"
													placeholder="Inserte  documento"/>
											<div class="k-invalid-msg" data-for="documento"></div>
										</div>
									</div>
									<div class="col-md-4">
										<a href="" class="list bg-encabezado fg-white" id="referecia_doc">
											<div class="list-content" id="image_contenedor_1" hidden>
												<img src="" class="icon" id="documento_ley"  />
												<div class="data">
													<span class="list-title">

														<script type="text/x-kendo-template" id="doc_ley">
															#= documento#

														</script>
													</span>
												</div>
											</div>
										</a>
										</div>
									<div class="col-md-2" id="image_contenedor_2" hidden>
									<img src="" id="img_ley" alt="" height="75px" width="50px"/>
									</div>

								</div>

								</div>

								<div class="row">
									<div class="col-md-4">

										<div class="input-group margin" id= "div_palabras_claves_general">
                          	<span class="input-group-btn" title=" se define el palabras_claves_general">
                			<label for="palabras_claves_general" class="btn-addons " style="padding-right: 5px;">Tipo Ley*</label></span>
											<ul class="fieldlist">


												<input type="radio" value="0" name="ley[tipo_ley]" id="tipo_ley1" class="k-radio"  checked="checked" >
												<label class="k-radio-label" for="tipo_ley1">Ley</label>

												<input type="radio"  value="1" name="ley[tipo_ley]" id="tipo_ley2" class="k-radio">
												<label class="k-radio-label" for="tipo_ley2">Decreto Ley</label>

												<input type="radio"  value="2" name="ley[tipo_ley]" id="tipo_ley3" class="k-radio">
												<label class="k-radio-label" for="tipo_ley3">Decreto</label>

												<input type="radio"  value="3" name="ley[tipo_ley]" id="tipo_ley4" class="k-radio" >
												<label class="k-radio-label" for="tipo_ley4">Resolución</label>

											</ul>
											<div class="k-invalid-msg" data-for="tipo_ley"></div>
										</div>
									</div>

									<div class="col-md-4">
										<div class="input-group margin" id= "div_imagen">
                          	<span class="input-group-btn" title=" se define limagen">
                			<label for="imagen" class="btn-addons " style="padding-right: 5px;">Imagen</label></span>

											<input  value="" id="imagen"  type="file" name="ley[imagen]"
													placeholder="Inserte  imagen"/>
											<div class="k-invalid-msg" data-for="imagen"></div>
										</div>
									</div>



								</div>
								<div class="row">
									<div class="col-md-4">

										<div class="input-group margin" id= "div_numero_ley">
                          	<span class="input-group-btn" title=" se define l numero_ley">
                			<label for="numero_ley" class="btn-addons " style="padding-right: 5px;">Numero Ley*</label></span>
											<input   id="numero_ley"  required value="" type="text" name="ley[numero_ley]" />
											<div class="k-invalid-msg" data-for="numero_ley"></div>
										</div>
									</div>

									<div class="col-md-4">


										<div class="input-group margin" id= "div_palabras_claves_general">
                          	<span class="input-group-btn" title=" se define el palabras_claves_general">
                			<label for="palabras_claves_general" class="btn-addons " style="padding-right: 5px;">Palabras Claves*</label></span>
											<input   id="palabras_claves_general"  required value="" type="text" name="ley[palabras_claves_general]" />
											<div class="k-invalid-msg" data-for="palabras_claves_general"></div>
										</div>
									</div>


									</div>
								<div class="row">
									<div class="col-md-4">

										<div class="input-group margin" id= "div_anyo_ley">
                          	<span class="input-group-btn" title=" se define l anyo_ley">
                			<label for="anyo_ley" class="btn-addons " style="padding-right: 5px;">Año Ley*</label></span>
											<input   id="anyo_ley"  required value="" type="text" name="ley[anyo_ley]" />
											<div class="k-invalid-msg" data-for="anyo_ley"></div>
										</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_id_estado_ley">
                          	<span class="input-group-btn" title=" se define  el estado de la ley">
                			<label for="id_estado_ley" class="btn-addons " style="padding-right: 5px;">Estado Ley</label></span>
											<input  value="" id="id_estado_ley" type="text"  name="ley[id_estado_ley]"  placeholder="Inserte  el estado de la ley" />
											<div class="k-invalid-msg" data-for="id_estado_ley"></div>
										</div>
									</div>



								</div>
								<div class="row">

										<div class="col-md-4">
											<div class="input-group margin" id= "div_organismo">
                          	<span class="input-group-btn" title=" se define  el orrganismo asociado a una resolución">
                			<label for="organismo" class="btn-addons " style="padding-right: 5px;">Organismo</label></span>
												<input  value="" id="organismo" type="text" required name="ley[organismo]" disabled="disabled" placeholder="Inserte  el estado de la ley" />
												<div class="k-invalid-msg" data-for="organismo"></div>
											</div>
										</div>


									<div class="col-md-4">
										<div class="input-group margin" id= "div_inicio_publicacion">
                          	<span class="input-group-btn" title=" se define l inicio_publicacion">
                			<label for="inicio_publicacion" class="btn-addons " style="padding-right: 5px;">Inicio Publicación</label></span>
											<input  value="" id="inicio_publicacion" type="text"  name="ley[inicio_publicacion]"  placeholder="Inserte  inicio_publicacion" />
											<div class="k-invalid-msg" data-for="inicio_publicacion"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
									<div class="input-group margin" id= "div_acceso">
                          	<span class="input-group-btn" title=" se define l acceso">
                			<label for="acceso" class="btn-addons " style="padding-right: 5px;">Acceso*</label></span>
										<input   id="acceso"  required value="" type="text" name="ley[acceso]" />
										<div class="k-invalid-msg" data-for="acceso"></div>
									</div>
									</div>
									<div class="col-md-4">
										<div class="input-group margin" id= "div_fin_publicacion">
                          	<span class="input-group-btn" title=" se define l fin_publicacion">
                			<label for="fin_publicacion" class="btn-addons " style="padding-right: 5px;">Fin Publicación</label></span>
											<input   id="fin_publicacion" type="text"  name="ley[fin_publicacion]"  placeholder="Inserte  fin_publicacion" />
											<div class="k-invalid-msg" data-for="fin_publicacion"></div>
										</div>
									</div>

								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_incluir_pagina_principal">
                          	<span class="input-group-btn" title=" se define l  incluir_pagina_principal">
                			<label for="incluir_pagina_principal"  style="padding-right: 5px;">Principal</label></span>
											<input  type="checkbox" id="incluir_pagina_principal" class="k-checkbox" type="text" 
													name="ley[incluir_pagina_principal]"  placeholder="Inserte  incluir_pagina_principal" />
											<div class="k-invalid-msg" data-for="incluir_pagina_principal"></div>
										</div>
									</div>
								</div>

							</div>

					</div>


					<div id="info" class="tab-pane ">

							<div class="form-group">
								<div class="row">
									<div class="col-md-6">

										<div class="input-group margin" id= "div_epigrafe">
                          	<span class="input-group-btn" title=" se define el epigrafe">
                			<label for="epigrafe" class="btn-addons " style="padding-right: 5px;">Epigrafe</label></span>
											<input   id="epigrafe"   value="" type="text" name="ley[epigrafe]" />
											<div class="k-invalid-msg" data-for="epigrafe"></div>
										</div>
									</div>


								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_autor">
                          	<span class="input-group-btn" title=" se define el nombre del ley">
                			<label for="autor" class="btn-addons " style="padding-right: 5px;">Autor*</label></span>
											<input   id="autor"  required value="" type="text" name="ley[autor]" />
											<div class="k-invalid-msg" data-for="autor"></div>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4">
										<div class="input-group margin" id= "div_bajante">
                          	<span class="input-group-btn" title=" se define el nombre del bajante">
                			<label for="bajante" class="btn-addons " style="padding-right: 5px;">Bajante</label></span>
											<textarea   id="bajante"   value="" type="text" name="ley[bajante]" ></textarea>
											<div class="k-invalid-msg" data-for="bajante"></div>
										</div>
									</div>

								</div>

								<div class="row">
									<div class="col-md-6">

										<div class="input-group margin" id= "div_palabras_claves">
                          	<span class="input-group-btn" title=" se define el palabras_claves">
                			<label for="palabras_claves_info" class="btn-addons " style="padding-right: 5px;">Palabras Claves*</label></span>
											<input   id="palabras_claves_info"  required value="" type="text" name="ley[palabras_claves_info]" />
											<div class="k-invalid-msg" data-for="palabras_claves_info"></div>
										</div>
									</div>


								</div>
								<div class="row">
									<div class="col-md-6">

										<div class="input-group margin" id= "div_anuncio">
                          	<span class="input-group-btn" title=" se define l anuncio">
                			<label for="anuncio" class="btn-addons " style="padding-right: 5px;">Anuncio</label></span>
											<textarea   id="anuncio"   value="" type="anuncio" name="ley[anuncio]" ></textarea>
											<div class="k-invalid-msg" data-for="anuncio"></div>
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
					<input class="input-group margin" class="form-control" value="" type="hidden" id="taskley"/>
						</div>

					<?php echo JHtml::_('form.token');  ?>
						</div>

			</form>

		</div>
						</div>


</div>
</div>

</body>