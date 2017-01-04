<?php

defined('_JEXEC') or die('acceso no autorizado');
JHtml::_('behavior.formvalidation');


if (!JFactory::getUser()->authorise('core.admin', 'com_users'))
{
    return JError::raiseWarning(404, JText::_('acceso no autorizado'));

}
$componentbase = $this->_basePath;

?>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <title>Usuario  Grid</title>
    <script type="text/x-kendo-template" id="template_persona">
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
                <!---  <div class='employee-details'>
              <ul>
                      <li><label>Nombre:</label>#= name #</li>
                      <li><label>Rol:</label>#= rollon #</li>
                      <li><label>Fijo:</label>#= telefono_fijo #</li>
                      <li><label>Movil:</label>#= telefono_movil #</li>
                      <li><label>Dirección:</label>#= calle_principal_address # / #= primera_entrecalle_address # y #= segundo_entrecalle_address #</li>
                      <li><label>Provincia:</label>#= provincia #</li>
                      <li><label>Municipio:</label>#= municipio #</li>
                  </ul>
                </div>---->
            </div>
        </div>

    </script>
    <script type="text/x-kendo-template" id="template_negocio">
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
             <!---   <div class='employee-details'>
                    <ul>
                        <li><label>Foto :</label>#= foto1 #</li>
                        <li><label>Foto:</label>#= foto2 #</li>
                        <li><label>Url:</label>#= url #</li>
                        <li><label>Teléfono:</label>#= telefono_fijo #</li>
                        <li><label>Otro teléfono:</label>#= otro_telefono #</li>
                        <li><label>Correo:</label>#= correo #</li>
                        <li><label>Dirección:</label>#= direccion_negocio#</li>
                        <li><label>Reseña:</label>#= resenya_negocio#</li>
                        <li><label>Cliente:</label>#= tipo_cliente#</li>
                    </ul>
                </div>-->
            </div>
        </div>

    </script>

</head>
<body class="skin-blue sidebar-mini">
<div class="nav-tabs-custom">
    <ul class="nav nav-tabs">
        <li class="active" ><a data-toggle="tab" href="#freelance">Usuario</a></li>
        <li  ><a data-toggle="tab" href="#bussines">Negocio</a></li>

    </ul>

    <div class="tab-content">
        <div id="freelance" class="tab-pane active">
            <div>
                <section class="content-header">
                    <h1>
                        Gestionar Usuario
                    </h1>
                    <ol class="breadcrumb">
                        <div class="btn-group">
                            <button class="btn btn-action" id="addbutton_rrhh" data-toggle='tooltip' title='user_add' >
                                <i class="fa fa-edit"></i> Nuevo
                            </button>
                            <button class="btn bg-red  btn-action" id="deletebutton_rrhh" data-toggle='tooltip' title='user_delete' >
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </ol>
                </section>
                </br>
                <div class="content box box-primary">


                    <div id="gridselection_persona"  style="width:100%"></div>
                </div>

                <div id="rrhh_window" style="display: none;" >

                    <div class="box-gestionando box-primary">

                        <div class="box-header">
                            <button type="button" id="accionbtn_rrhhsave_exit" class="btn btn-primary">Guardar y Salir</button>
                            <button type="button" id="accionbtn_rrhhsave_new" class="btn btn-primary">Guardar y Crear</button>
                        </div>

                        <form  method="post" id="rrhh_form"  >
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_rol">
                          	<span class="input-group-btn" title=" se define el nombre del rrhh">
                			<label for="rol" class="btn-addons " style="padding-right: 5px;">Rol*</label></span>
                                            <input   id="rol"  required value="" type="text" name="emprendedor[rol]" />
                                            <div class="k-invalid-msg" data-for="rol"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_userpic">
                                            <img id="userpic"   class="user-image img-circle" width="50px" height="50px"  src=""  alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_name">
                          	<span class="input-group-btn" title=" se define el nombre del usuario">
                			<label for="name" class="btn-addons " style="padding-right: 5px;">Nombre*</label></span>
                                            <input   id="name"  required value="" type="text" name="emprendedor[name]" />
                                            <div class="k-invalid-msg" data-for="name"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_foto_e">
                          	<span class="input-group-btn" title=" se define lfoto">
                			<label for="foto_e" class="btn-addons " style="padding-right: 5px;">Foto</label></span>

                                            <input  value="" id="foto_e"  type="file" name="emprendedor[foto_e]"
                                                    placeholder="Inserte  `"/>
                                            <div class="k-invalid-msg" data-for="foto_e"></div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-4">

                                        <div class="input-group margin" id= "div_username">
                          	<span class="input-group-btn" title=" se define el username">
                			<label for="username" class="btn-addons " style="padding-right: 5px;">Usuario*</label></span>
                                            <input   id="username"  required value="" type="text" name="emprendedor[username]" />
                                            <div class="k-invalid-msg" data-for="username"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group margin" id= "div_identificacion">
                          	<span class="input-group-btn" title=" se define la identificacion">
                			<label for="identificacion" class="btn-addons " style="padding-right: 5px;">Identificación</label></span>
                                            <input   id="identificacion"   value="" type="text" name="emprendedor[identificacion]" />
                                            <div class="k-invalid-msg" data-for="identificacion"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">

                                        <div class="input-group margin" id= "div_password">
                          	<span class="input-group-btn" title=" se define l password">
                			<label for="password" class="btn-addons " style="padding-right: 5px;">Contraseña</label></span>
                                            <input   id="password"   value="" type="password" name="emprendedor[password]" />
                                            <div class="k-invalid-msg" data-for="password"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_land_phone_rh">
                          	<span class="input-group-btn" title=" se define l_telefono">
                			<label for="land_phone_rh" class="btn-addons " style="padding-right: 5px;">Teléfono</label></span>
                                            <input  value="" id="land_phone_rh"   name="emprendedor[land_phone_rh]"  placeholder="Inserte  telefono" />
                                            <div class="k-invalid-msg" data-for="land_phone_rh"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group margin" id= "div_password2">
                          	<span class="input-group-btn" title=" se define l password">
                			<label for="password2" class="btn-addons " style="padding-right: 5px;">Confirmar Contraseña</label></span>
                                            <input   id="password2"   value="" type="password" name="emprendedor[password2]" />
                                            <div class="k-invalid-msg" data-for="password2"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_telefono_movil">
                          	<span class="input-group-btn" title=" se define l_telefono">
                			<label for="telefono_movil" class="btn-addons " style="padding-right: 5px;">Movil</label></span>
                                            <input  value="" id="telefono_movil"   name="emprendedor[telefono_movil]"  placeholder="Inserte  telefono" />
                                            <div class="k-invalid-msg" data-for="telefono_movil"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_email">
                          	<span class="input-group-btn" title=" se define l email">
                			<label for="email" class="btn-addons " style="padding-right: 5px;">Correo*</label></span>
                                            <input  value="" id="email" type="email" required name="emprendedor[email]"  placeholder="Inserte  email" />
                                            <div class="k-invalid-msg" data-for="email"></div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_principal">
                          	<span class="input-group-btn" title=" se define l calle principal">
                			<label for="calle_principal" class="btn-addons " style="padding-right: 5px;">Principal*</label></span>
                                            <input  value="" id="calle_principal" required type="text" name="emprendedor[calle_principal]"  placeholder="Inserte  calle_principal" />
                                            <div class="k-invalid-msg" data-for="calle_principal"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_provincia">
                          	<span class="input-group-btn" title=" se define l provincia">
                			<label for="provincia" class="btn-addons " style="padding-right: 5px;">Provincia*</label></span>
                                            <input  value="" id="provincia" required  name="emprendedor[provincia]"  placeholder="Escoja  la provincia" />
                                            <div class="k-invalid-msg" data-for="provincia"></div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_primera_calle">
                          	<span class="input-group-btn" title=" se define l calle principal">
                			<label for="primera_entrecalle" class="btn-addons " style="padding-right: 5px;">Calle 1*</label></span>
                                            <input  value="" id="primera_entrecalle" required  name="emprendedor[primera_entrecalle]" type="text" placeholder="Inserte  primera entre calle" />
                                            <div class="k-invalid-msg" data-for="primera_entrecalle"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_municpio">
                          	<span class="input-group-btn" title=" se define l municipio">
                			<label for="municipio" class="btn-addons " style="padding-right: 5px;">Municipio*</label></span>
                                            <input  value="" id="municipio" required disabled="disabled" name="emprendedor[municipio]"  placeholder="Escoja  el municipio" />
                                            <div class="k-invalid-msg" data-for="municipio"></div>
                                        </div>
                                    </div>

                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="input-group margin" id= "div_segunda_calle">
                          	<span class="input-group-btn" title=" se define l segunda calle">
                			<label for="segunda_entrecalle" class="btn-addons " style="padding-right: 5px;">Calle 2*</label></span>
                                            <input  value="" id="segunda_entrecalle" required type="text" name="emprendedor[segunda_entrecalle]"  placeholder="Inserte  calle_principal" />
                                            <div class="k-invalid-msg" data-for="segunda_entrecalle"></div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <input class="input-group margin" class="form-control" value="" type="hidden" id="taskrrhh"/>
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
        </div>
        <div id="bussines" class="tab-pane ">
            <div >

                <section class="content-header">
                    <h1>
                        Gestionar Negocio
                    </h1>
                    <ol class="breadcrumb">
                        <div class="btn-group">
                            <button class="btn btn-action" id="addbutton_negocio" data-toggle='tooltip' title='negocio_add' >
                                <i class="fa fa-edit"></i> Nuevo
                            </button>
                            <button class="btn bg-red  btn-action" id="deletebutton_negocio" data-toggle='tooltip' title='negocio_delete' >
                                <i class="fa fa-trash"></i> Eliminar
                            </button>
                        </div>
                    </ol>
                </section>
                </br>
                <div class="content box box-primary">
                    <div id="gridselection_negocio"  style="width:100%"></div>
                </div>

                <div id="negocio_window" style="display: none;" >

                    <div class="box-gestionando box-primary">

                        <div class="box-header">
                            <button type="button" id="accionbtn_negociosave_exit" class="btn btn-primary">Guardar y Salir</button>
                            <button type="button" id="accionbtn_negociosave_new" class="btn btn-primary">Guardar y Crear</button>
                        </div>

                        <form  method="post" id="negocio_form"  >
                            <div class="form-group">
                                <div class="row" hidden id="row_pics">
                                    <div class="col-md-3">
                                        <div class="input-group margin" id= "div_bussinespic">
                                            <img id="bussinespic"   class="user-image img-circle" width="50px" height="50px"  src=""  alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-3" id="row_pic_1" hidden>
                                        <div class="input-group margin" id= "div_bussinespic1">
                                            <img id="bussinespic1"   class="user-image img-circle" width="50px" height="50px"  src=""  alt="" />
                                        </div>
                                    </div>
                                    <div class="col-md-4" id="row_pic_2" hidden>
                                        <div class="input-group margin" id= "div_bussinespic2">
                                            <img id="bussinespic2"   class="user-image img-circle" width="50px" height="50px"  src=""  alt="" />
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_categoria">
                          	<span class="input-group-btn" title=" se define la categoria">
                			<label for="categoria" class="btn-addons " style="padding-right: 5px;">Categoria*</label></span>
                                            <input   id="categoria"  required value="" type="text" name="negocio[categoria]" />
                                            <div class="k-invalid-msg" data-for="categoria"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group margin" id= "div_foto">
                          	<span class="input-group-btn" title=" se define lfoto">
                			<label for="foto" class="btn-addons " style="padding-right: 5px;">Foto*</label></span>

                                            <input  value="" id="foto"  type="file" name="negocio[foto]"
                                                    required	   placeholder="Inserte  foto"/>
                                            <div class="k-invalid-msg" data-for="foto"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_id_usuario">
                          	<span class="input-group-btn" title=" se define el usuario">
                			<label for="id_usuario" class="btn-addons " style="padding-right: 5px;">Usuario*</label></span>
                                            <input   id="id_usuario"  required value="" type="text" name="negocio[id_usuario]" />
                                            <div class="k-invalid-msg" data-for="id_usuario"></div>
                                        </div>
                                    </div>

                                    <div class="col-md-4">

                                        <div class="input-group margin" id= "div_foto1">
                          	<span class="input-group-btn" title=" se define lfoto">
                			<label for="foto1" class="btn-addons " style="padding-right: 5px;">Foto1</label></span>

                                            <input  value="" id="foto1"  type="file" name="negocio[foto1]"
                                                    placeholder="Inserte  foto"/>
                                            <div class="k-invalid-msg" data-for="foto1"></div>
                                        </div>
                                    </div>


                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_nombre_negocio">
                          	<span class="input-group-btn" title=" se define el nombre del negocio">
                			<label for="nombre_negocio" class="btn-addons " style="padding-right: 5px;">Negocio*</label></span>
                                            <input   id="nombre_negocio"  required value="" type="text" name="negocio[nombre_negocio]" />
                                            <div class="k-invalid-msg" data-for="nombre_negocio"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">

                                        <div class="input-group margin" id= "div_foto2">
                          	<span class="input-group-btn" title=" se define lfoto">
                			<label for="foto2" class="btn-addons " style="padding-right: 5px;">Foto2</label></span>

                                            <input  value="" id="foto2"  type="file" name="negocio[foto2]"
                                                    placeholder="Inserte  foto"/>
                                            <div class="k-invalid-msg" data-for="foto2"></div>
                                        </div>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_telefono">
                          	<span class="input-group-btn" title=" se define ltelefono">
                			<label for="telefono" class="btn-addons " style="padding-right: 5px;">Teléfono</label></span>
                                            <input  value="" id="telefono_fijo"    name="negocio[telefono_fijo]"  placeholder="Inserte  telefono" />
                                            <div class="k-invalid-msg" data-for="telefono"></div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_otro_telefono">
                          	<span class="input-group-btn" title=" se define lotro_telefono">
                			<label for="otro_telefono" class="btn-addons " style="padding-right: 5px;">Otro Teléfono</label></span>
                                            <input  value="" id="otro_telefono"   name="negocio[otro_telefono]"  placeholder="Inserte  otro_telefono" />
                                            <div class="k-invalid-msg" data-for="otro_telefono"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div  class="input-group margin">
                          	<span class="input-group-btn" title="Donde se define si el cliente es premium o no">
                			<label for="cliente_premium" class="btn-addons" style="padding-right: 5px;">Cliente Premium</label></span>

                                            <ul class="fieldlist">

                                                <input type="radio" value="0" name="negocio[cliente_premium]" id="cliente_premium1" class="k-radio"  checked="checked">
                                                <label class="k-radio-label" for="cliente_premium1">Los primeros 5</label>
                                                <br>

                                                <input type="radio"  value="1" name="negocio[cliente_premium]" id="cliente_premium2" class="k-radio">
                                                <label class="k-radio-label" for="cliente_premium2">Del 5 al 10</label>
                                                <br>

                                                <input type="radio"  value="2" name="negocio[cliente_premium]" id="cliente_premium3" class="k-radio">
                                                <label class="k-radio-label" for="cliente_premium3">Del 10 en adelante</label>


                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_url">
                          	<span class="input-group-btn" title=" se define la url">
                			<label for="url" class="btn-addons " style="padding-right: 5px;">Url</label></span>
                                            <input  value="" id="url" type="url"  name="negocio[url]"  placeholder="Inserte  url" />
                                            <div class="k-invalid-msg" data-for="url"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">

                                    </div>

                                    <div class="col-md-4">
                                        <div class="input-group margin" id= "div_correo">
                          	<span class="input-group-btn" title=" se define l correo">
                			<label for="email" class="btn-addons " style="padding-right: 5px;">Correo</label></span>
                                            <input  value="" id="correo" type="email"  name="negocio[correo]"  placeholder="Inserte  email" />
                                            <div class="k-invalid-msg" data-for="correo"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group margin" id= "div_direccion_negocio">
                          	<span class="input-group-btn" title=" se define ldireccion_negocio">
                			<label for="direccion_negocio" class="btn-addons " style="padding-right: 5px;">Dirección*</label></span>
                                            <textarea class="form-control" value="" id="direccion_negocio" required  name="negocio[direccion_negocio]"  placeholder="Inserte  direccion_negocio" ></textarea
                                            <div class="k-invalid-msg" data-for="direccion_negocio"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-8">
                                        <div class="input-group margin" id= "div_resenya_negocio">
                          	<span class="input-group-btn" title=" se define lresenya_negocio">
                			<label for="resenya_negocio" class="btn-addons " style="padding-right: 5px;">Descripción*</label></span>
                                            <textarea class="form-control" value="" id="resenya_negocio" required  name="negocio[resenya_negocio]"  placeholder="Inserte  resenya_negocio"></textarea>
                                            <div class="k-invalid-msg" data-for="resenya_negocio"></div>
                                        </div>
                                    </div>
                                </div>
                                <input class="input-group margin" class="form-control" value="" type="hidden" id="tasknegocio"/>
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
        </div>
    </div>

</div>
</div>
</div>
</body>