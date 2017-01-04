
		<?php                                                   
				defined('_JEXEC') or die('acceso no autorizado');  
				JHtml::_('behavior.formvalidation');
				$componentbase = $this->_basePath;      ?>
				<html xmlns="http://www.w3.org/1999/html"+>                                  
				<head>

				    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">               
				    <title>Banners </title>
					<script type="text/x-kendo-template" id="template_banners">
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
								<!--<div class='employee-details'>
									<ul>
										<li><label>Descripción:</label>#= description #</li>
										<li><label>Estado:</label>#= estado #</li>
										<li><label>Creado:</label>#= publish_up #</li>

									</ul>-->
								</div>
							</div>
						</div>

					</script>
				</head>                                                                                                      
				<body>                                                                                                         
				<div >



<section class="content-header">
    <h1>
		Listado de  Banners
    </h1>
</section> 
  </br>
    <div class="content box box-primary">
        <div id="gridselection_banner"  style="width:100%"></div>
</div>

<div id="banner_window" style="display: none;" >


<section class="content-header">
    <h1>
    Listado de  Banners
    </h1>
</section>
	<div class="box-gestionando box-primary">



	 </div>                                         
	 </div>

	 </div>                                           

