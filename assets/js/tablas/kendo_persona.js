
var validator_persona;
var Persona={};
var message="";
var path_profile = "/images/perfil/";
//var path_profile_phys = "C:/wamp64/www/NXC/images/perfil/";



//Definir controladora
Persona.oldElement=null;
function delete_element_rrhh(e)
{
	var dataItem=Persona.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Persona?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_persona&task=persona_delete_one",
				data:{
					array:JSON.stringify(array)
				},
				success:function(response){
					if(response.success==true) {
						var message='El elemento fue eliminado con exito';
						$.smallBox({
							title: '',
							content: $('#message-ok').html(),
							color: "#00A65A",
							timeout: 6000
						});
					}
					else{
						$('#text-error').html(response.message);
						$.smallBox({
							title: '',
							content:$('#message-error').html(),
							color: "#BA0916",
							timeout: 6000
						});
					}
					Persona.gridDataSource.read();
				}
				//error:problemas
			});
		}
		else
			close();
	})
}
Persona.change = function onChange(arg) {

};
Persona.dataBind = function onDataBinding(arg) {

};
Persona.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
/*	$('#all_check_persona').prop('checked',false);
	$('#all_check_persona').iCheck('uncheck');
	$('.check_row').iCheck({
		checkboxClass: 'icheckbox_polaris',
		increaseArea: '20%'
	});*/
Persona.kgrid=this;

}
Persona.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Persona.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}

function showUpdate_rrhh(e) {
	validator_persona.hideMessages();
	$('#rrhh_form')[0].reset();
	var dataItem=Persona.finditem(e.id);
	Persona.oldElement= dataItem;
	$('#taskrrhh').val('update');
	document.getElementById("div_userpic").hidden=false;
	$('#municipio').data("kendoDropDownList").enable();
	wnd_rrhh.title("Editar Usuario");
	$('#accionbtn_rrhhsave_exit').text('Actualizar');
	$('#accionbtn_rrhhsave_new').hide();
	wnd_rrhh.center().open();
}

//On load
$(function() {

	$("#land_phone_rh").kendoNumericTextBox({
		max:9999999,
		min:1111111,
		decimals:0,
		spinners:false
	});
	$("#telefono_movil").kendoNumericTextBox({
		max:9999999,
		format:"535-0-00-00",
		min:1111111,
		decimals:0,
		spinners:false
	});
	$("#identificacion").kendoNumericTextBox({
		max:99999999999,
		min:11111111111,
		decimals:0,
		spinners:false
	});

	var roldatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_persona&task=rol_json_list",
				dataType: "json"
			}
		}
	});

	/*ComboBox  Prioridad*/
	$("#rol").kendoDropDownList ({
		dataTextField: "title",
		dataValueField: "id",
		dataSource: roldatasource,
		editable:'false',
		filter: "contains",
		open: function(e) {
			valid = true;
		},
		change:function(e){

			//  if (!valid) this.value('');
		},
		select: function(e){
			valid = true;
		},
		close: function(e){
			// if no valid selection - clear input
			//    if (!valid) this.value('');
		},
		suggest: true,
		index: 3
	});
	var personadatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_negocio&task=usuario_json_list",
				dataType: "json"
			}
		}
	});

	/*ComboBox  Prioridad*/
	$("#id_usuario").kendoDropDownList ({
		dataTextField: "username",
		dataValueField: "id_user",
		dataSource: personadatasource,
		editable:'false',
		filter: "contains",
		open: function(e) {
			valid = true;
		},
		change:function(e){

			//  if (!valid) this.value('');
		},
		select: function(e){
			valid = true;
		},
		close: function(e){
			// if no valid selection - clear input
			//    if (!valid) this.value('');
		},
		suggest: true,
		index: 3
	});


	var municipiodatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_persona&task=municipio_json_list",
				dataType: "json"
			}
		}
	});

	/*ComboBox  Prioridad*/
	$("#municipio").kendoDropDownList ({
		dataTextField: "nombre_municipio",
		dataValueField: "id_municipio",
		dataSource: municipiodatasource,
		filter: "contains",
		open: function(e) {
			valid = true;
		},
		change:function(e){

			//  if (!valid) this.value('');
		},
		select: function(e){
			valid = true;
		},
		close: function(e){
			// if no valid selection - clear input
			//    if (!valid) this.value('');
		},
		suggest: true,
		index: 3
	});

var provinciadatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_persona&task=provincia_json_list",
				dataType: "json"
			}
		}
	});
	$("#provincia").kendoDropDownList ({
		dataTextField: "nombre_provincia",
		dataValueField: "id_provincia",
		dataSource: provinciadatasource,
		editable:'false',
		filter: "contains",
			open: function(e) {
				$("#municipio").data("kendoDropDownList").enable();
			},
			change:function(e){
				var id = $("#provincia").data("kendoDropDownList").value();

				$("#municipio").data("kendoDropDownList").value(id);




		},
		select: function(e){
			valid = true;
		},
		close: function(e){
			// if no valid selection - clear input
			//    if (!valid) this.value('');
		},
		suggest: true,
		index: 3
	});


	function showInsert_rrhh() {
		Persona.oldElement=null;
		validator_persona.hideMessages();
		$('#rrhh_form')[0].reset();
		$('#taskrrhh').val('insert');
		$('#accionbtn_rrhhsave_exit').text('Guardar y Salir');
		$('#municipio').data("kendoDropDownList").enable(false);
		wnd_rrhh.title("Nuevo Usuario");
		document.getElementById("div_userpic").hidden=true;
		document.getElementById("userpic").src="";
		$('#accionbtnrrhh_save_new').show();
		wnd_rrhh.center().open();
	}

//Creando los windows Dialogs
	wnd_rrhh = $("#rrhh_window").kendoWindow({
		modal: true,
		visible: false,
		resizable: false,
		width: '75%',
		heigth:400,
		animation : {
			open: {
				effects: 'expand:vertical'
			},
			close: {
				effects:'expand:vertical',
				reverse: true
			}
		},
		activate:function(e){
			if(Persona.oldElement!=null) {

				$('#name').val(Persona.oldElement.name);
				$('#username').val(Persona.oldElement.username);
				$('#municipio').data("kendoDropDownList").value(Persona.oldElement.id_municipio);
				$('#provincia').data("kendoDropDownList").value(Persona.oldElement.id_provincia);
				$('#calle_principal').val(Persona.oldElement.calle_principal_address);
				$('#primera_entrecalle').val(Persona.oldElement.primera_entrecalle_address);
				$('#segunda_entrecalle').val(Persona.oldElement.segundo_entrecalle_address);
				$('#identificacion').data("kendoNumericTextBox").value(Persona.oldElement.identificacion);
				$('#land_phone_rh').data("kendoNumericTextBox").value(Persona.oldElement.telefono_fijo);
				$('#telefono_movil').data("kendoNumericTextBox").value(Persona.oldElement.telefono_movil);
				$('#rol').data("kendoDropDownList").value(Persona.oldElement.rol);
				$('#email').val(Persona.oldElement.email);


				document.getElementById('userpic').src=".."+path_profile+Persona.oldElement.foto;



			}

			else
			{
				$('#rol').data("kendoDropDownList").value('');
				$('#municipio').data("kendoDropDownList").value('');
				$('#provincia').data("kendoDropDownList").value('');
				$('#identificacion').data("kendoNumericTextBox").value('');

			}
		}}).data("kendoWindow");

	validator_persona=$("#rrhh_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found=false;
						var value=input.val();
						var size = value.length;
						var i=0;
						if(Persona.oldElement==null)
						{

							if (input.is("[id=name]")) {

							 size = value.length;

								if (size > 30) {
									found = true;
									message = "El nombre del emprendedor es mas largo de lo permitido";
									return $('#name').val('');
								}
							}
								if (input.is("[id=username]")) {

										if (size > 30) {
										found = true;
										message = "El username es mas largo de lo permitido";
										return $('#username').val('');
									}

									while (i < Persona.gridDataSource._data.length) {
										var elem = Persona.gridDataSource._data[i];
										if (elem.username == value) {
											found = true;
											message = "El username  está actualmente en uso";
											i = Persona.gridDataSource._data.length;
											return $('#username').val('');
										}
										i++;
									}

								}
							if (input.is("[id=password]")) {



								if (size < 8 || size > 16 ) {
									found = true;
									message = "El password no tiene la longitud permitida";
									alert("La contraseña debe poseer entre 8 y 16 caracteres");
									return $('#password').val('');

								}
							}
							if (input.is("[id=password2]")) {
								var valuepass = $('#password').val();


								if (size < 8 || size > 16) {
									found = true;
									message = "El password no tiene la longitud permitida";
									alert("La contraseña debe poseer entre 8 y 16 caracteres");
									return $('#password2').val('');

								}
								if(value != valuepass){
									found = true;
									message = "Las contraseñas no coincide";
									alert("Las contraseñas deben coincidir");
									return $('#password2').val('');

								}
							}
							if (input.is("[id=email]")) {



								if (size > 30) {
									found = true;
									message = "El correo es mas largo de lo permitido";
									return $('#email').val('');
								}
							}
							if (input.is("[id=calle_principal]")) {

								if (size > 50) {
									found = true;
									message = "La calle_principal es mas largo de lo permitido";
									return $('#calle_principal').val('');
								}
							}
							if (input.is("[id=primera_entrecalle]")) {

								if (size > 50) {
									found = true;
									message = "La primera_entrecalle es mas largo de lo permitido";
									return $('#primera_entrecalle').val('');
								}
							}
							if (input.is("[id=segunda_entrecalle]")) {

								if (size > 50) {
									found = true;
									message = "La segunda_entrecalle es mas largo de lo permitido";
									return $('#segunda_entrecalle').val('');
								}
							}
							if (input.is("[id=foto_e]")) {
								if($('#foto_e').val()!="") {
									var file = document.getElementById('foto_e').files[0];
									var ext = file.type;
									var overall = file.size;
									document.getElementById('userpic').src=$('#foto_e').val();
								}
								if(ext !="image/jpeg" && $('#foto_e').val()!="" ){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									alert("El archivo adjuntado solo admite extensiones en formato jpg");
									 $('#foto_e').val('');
								}
								else if(overall > 9992132){
									 $('#foto_e').val('');
									alert("El archivo adjuntado no debe exceder los  9 Mb");
								}


							}


							return !found;
						}
						else if($('#taskrrhh').val()=='update'){

							if (input.is("[id=name]")) {

								size = value.length;

								if (size > 30) {
									found = true;
									message = "El nombre del emprendedor es mas largo de lo permitido";
									return $('#name').val('');
								}
							}
							if (input.is("[id=username]")) {

								if (size > 30) {
									found = true;
									message = "El username es mas largo de lo permitido";
									return $('#username').val('');
								}

								while (i < Persona.gridDataSource._data.length) {
									var elem = Persona.gridDataSource._data[i];
									if (elem.username == value) {
										found = true;
										message = "El username  está actualmente en uso";
										i = Persona.gridDataSource._data.length;
										return $('#username').val('');
									}
									i++;
								}

							}
							if (input.is("[id=password]")) {



								if (size < 8 || size > 16 ) {
									found = true;
									message = "El password no tiene la longitud permitida";
									alert("La contraseña debe poseer entre 8 y 16 caracteres");
									return $('#password').val('');

								}
							}
							if (input.is("[id=password2]")) {
								var valuepass = $('#password').val();


								if (size < 8 || size > 16) {
									found = true;
									message = "El password no tiene la longitud permitida";
									alert("La contraseña debe poseer entre 8 y 16 caracteres");
									return $('#password2').val('');

								}
								if(value != valuepass){
									found = true;
									message = "Las contraseñas no coincide";
									alert("Las contraseñas deben coincidir");
									return $('#password2').val('');

								}
							}
							if (input.is("[id=email]")) {



								if (size > 30) {
									found = true;
									message = "El correo es mas largo de lo permitido";
									return $('#email').val('');
								}
							}
							if (input.is("[id=calle_principal]")) {



								if (size > 50) {
									found = true;
									message = "La calle_principal es mas largo de lo permitido";
									return $('#calle_principal').val('');
								}
							}
							if (input.is("[id=primera_entrecalle]")) {


								if (size > 50) {
									found = true;
									message = "La primera_entrecalle es mas largo de lo permitido";
									return $('#primera_entrecalle').val('');
								}
							}
							if (input.is("[id=segunda_entrecalle]")) {



								if (size > 50) {
									found = true;
									message = "La segunda_entrecalle es mas largo de lo permitido";
									return $('#segunda_entrecalle').val('');
								}
							}
							if (input.is("[id=foto_e]")) {
								if($('#foto_e').val()!="") {
									var file = document.getElementById('foto_e').files[0];
									var ext = file.type;
									var overall = file.size;
									document.getElementById('userpic').src=$('#foto_e').val();
								}
								if(ext !="image/jpeg" && $('#foto_e').val()!="" ){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									alert("El archivo adjuntado solo admite extensiones en formato jpg");
									$('#foto_e').val('');
								}
								else if(overall > 9992132){
									$('#foto_e').val('');
									alert("El archivo adjuntado no debe exceder los  9 Mb");
								}


							}


							return !found;
						}
						else
						{
							return !found;
						}
						return true;
					}
				},
				messages: {
					unique: function(input) {
						return message;
					},
					required:"Este campo necesita un valor"
				}
			}
	).data("kendoValidator");

	Persona.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_persona&task=persona_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			console.clear();
		},
		schema:{
			model:{
				fields:{
					id_recurso_humano:{type:"number"},
					id_user:{type:"number"},
					username:{type:"string"},
					name:{type:"string"},
					identificacion:{type:"number"},
					telefono_fijo_rh:{type:"number"},
					telefono_movil:{type:"number"},
					foto:{type:"string"},
					calle_principal_address:{type:"string"},
					primera_entrecalle_address:{type:"string"},
					segundo_entrecalle_address:{type:"string"},
					id_municipio:{type:"number"},
					municipio:{type:"string"},
					id_provincia:{type:"number"},
					provincia:{type:"string"},
					rol:{type:"number"},
					rollon:{type:"string"},
					email:{type:"string"},
					password:{type:"string"}
				}

			}
		},
		pageSize: 12
	});
	$("#gridselection_persona").kendoGrid({
		dataSource: Persona.gridDataSource,
		height: 490,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_persona").html()),
		sortable: true,
		change: Persona.change,
		resizable: true,
		detailInit: detailInit,
		dataBound: Persona.dataBound,
		dataBinding: Persona.dataBinding,
		pageable: {
			buttonCount: 5,
			refresh: true,
			pageSizes: [2,10,20,30,50,100]
		},
		columns: [
			{
				field: "",
				title: "",
				width: '3%',
				headerTemplate: "<input class='' id='all_check_persona' type='checkbox'/>",
				template: "<input class='.check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,

			{
				field: "id_recurso_humano",
				template:'<div id="item" data-text="#: id_recurso_humano#">#: id_recurso_humano#</div>',
				title: "Id",
				width: '5%',
				type:"number",
				hidden:true
			}
			,

			{
				field: "id_user",
				template:'<div id="item" data-text="#: id_user#">#: id_user#</div>',
				title: "id_user",
				width: '9%',
				type:"number",
				hidden:true
			}
			,
			{
				field: "username",
				template:'<div id="item" data-text="#: username#">#: username#</div>',
				title: "Usuario",
				width: '9%',
				type:"string"
			}
			,

			{
				field: "email",
				template:'<div id="item" data-text="#: email#">#: email#</div>',
				title: "Correo",
				width: '9%',
				type:"string"
			}
			,
			{
				field: "rollon",
				template:'<div id="item" data-text="#: rollon#">#: rollon#</div>',
				title: "Rol",
				width: '9%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "telefono_fijo_rh",
				template:'<div id="item" data-text="#: telefono_fijo_rh#">#: telefono_fijo_rh#</div>',
				title: "Telefono Fijo",
				width: '9%',
				type:"number",
				hidden:true
			}
			,

			{
				field: "telefono_movil",
				template:'<div id="item" data-text="#: telefono_movil#">#: telefono_movil#</div>',
				title: "Movil",
				width: '9%',
				type:"number",
				hidden:true
			}
			,
			{
				field: "foto",
				template:'<div id="item" data-text="#: foto#"><img class="user-image img-circle" data-image="#: foto#" data-nombre="#: foto#" width="25px" height="25px" src="../personaxCuba/../images/perfil/#:foto#"></div>',
				title: "Foto",
				width: '6%',
				type:"string"
			},
			{
				field: "calle_principal_address",
				template:'<div id="item" data-text="#: calle_principal_address#">#: calle_principal_address#</div>',
				title: "Principal",
				width: '9%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "primera_entrecalle_address",
				template:'<div id="item" data-text="#: primera_entrecalle_address#">#: primera_entrecalle_address#</div>',
				title: "Primera Calle",
				width: '9%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "segundo_entrecalle_address",
				template:'<div id="item" data-text="#: segundo_entrecalle_address#">#: segundo_entrecalle_address#</div>',
				title: "Segunda Calle",
				width: '9%',
				type:"string",
				hidden:true
			}	,
			{
				field: "provincia",
				template:'<div id="item" data-text="#: provincia#">#: provincia#</div>',
				title: "Provincia",
				width: '9%',
				type:"string",
				hidden:true
			},
			{
				field: "municipio",
				template:'<div id="item" data-text="#: municipio#">#: municipio#</div>',
				title: "Municipio",
				width: '9%',
				type:"string",
				hidden:true
			}
			,


			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_rrhh(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='fa fa-edit'></i></div>" +
				"<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='delete_element_rrhh(this)' data-toggle='tooltip' data-original-title='Eliminar|Eliminar elemento'><i class='fa fa-trash-o'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}


		]
	});

	$('#all_check_persona').click(function () {
		var c = this.checked;
		$('#gridselection_persona :checkbox').prop('checked',c);
	});
	function detailInit(e) {
		var detailRow = e.detailRow;

		var datos = [{name:e.data.name,rolllon:e.data.rollon,telefono_fijo:e.data.telefono_fijo,telefono_movil:e.data.telefono_movil,calle_principal_address:e.data.calle_principal_address,
			primera_entrecalle_address:e.data.primera_entrecalle_address,segundo_entrecalle_address:e.data.segundo_entrecalle_address,provincia:e.data.provincia, municipio:e.data.municipio}];

		detailRow.find(".tabstrip").kendoTabStrip({
			animation: {
				open: { effects: "fadeIn" }
			}
		});

		detailRow.find(".orders").kendoGrid({
	       dataSource:datos,
			scrollable: false,
			sortable: true,
			resizable: true,
			pageable: true,
			columns: [
				{ field: "name", title:"Nombre", width: "80px" },
				{ field: "rolllon", title:"Rol", width: "70px" },
				{ field: "telefono_fijo", title:"Fijo" },
				{ field: "telefono_movil", title: "Movil", width: "70px" },
				{ field: "calle_principal_address", title: "Calle", width: "70px" },
				{ field: "primera_entrecalle_address", title: "Entre", width: "70px" },
				{ field: "segundo_entrecalle_address", title: "y", width: "70px" },
				{ field: "provincia", title: "Provincia", width: "70px" },
				{ field: "municipio", title: "Municipio", width: "70px" }

			]
		});
	}

/* $('#all_check_persona').iCheck({
 checkboxClass: 'icheckbox_polaris',
 increaseArea: '20%' // optional


 });*/

/*
$('#all_check_persona').on('ifChecked', function (event) {
		$('.check_row').iCheck('check');
	});
	$('#all_check_persona').on('ifUnchecked', function (event) {
		$('.check_row').iCheck('uncheck');
	});*/


	$('#addbutton_rrhh').click(function(){
		showInsert_rrhh();
	});
	$('#cancelbtn_rrhh').click(function(){
		$('#rrhh_form')[0].reset();
		Persona.gridDataSource.read();
		wnd_rrhh.close();
	});
	$('#accionbtn_rrhhsave_exit').click(function()
	{
		var x =0;
		if (/*validator_persona.validate()*/ x==0)
		{

			var fd = new FormData(document.querySelector("#rrhh_form"));
			var  url="?option=com_persona&task=persona_add";

			if($('#taskrrhh').val()=="update")
			{
				var olditem=JSON.stringify(Persona.oldElement);
				fd.append('olditem',olditem);
				  url="?option=com_persona&task=persona_update";
			}
			$.ajax({
				type: "POST",
				url:url,
				data:fd,
				cache: false,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success==true)
					{
						var message='El elemento fue insertado con exito'
						if($('#taskusuario').val()=='update')
							message='El elemento fue actualizado con exito'
						$.smallBox({
							title: '',
							content: $('#message-ok').html(),
							color: "#00A65A",
							timeout: 6000
						})
					}
					else
					{
						$('#text-error').html(response.message);
						$.smallBox({
							title: '',
							content:$('#message-error').html(),
							color: "#BA0916",
							timeout: 6000
						})
					}
					Persona.gridDataSource.read();
					personadatasource.read();
					$('#rrhh_form')[0].reset();
					wnd_rrhh.close();
				}
			});
		}
		else {
			$.smallBox({
				title: "Error",
				content:"<p class='fg-white'>Por favor llene todos los campos</p>" ,
				color: "9162E",
				timeout: 4000
			});
		}
	});
	$('#accionbtn_rrhhsave_new').click(function()
	{
		var x =0;
		if (/*validator_persona.validate()*/ x==0)
		{

			var fd = new FormData(document.querySelector("#rrhh_form"));
			var url="?option=com_persona&task=persona_add";
			$.ajax({
				type: "POST",
				url:url,
				data:fd,
				cache: false,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success==true)
					{
						var message='El elemento fue insertado con exito'
						if($('#taskusuario').val()=='update')
							message='El elemento fue actualizado con exito'
						$.smallBox({
							title: '',
							content: $('#message-ok').html(),
							color: "#00A65A",
							timeout: 6000
						})
					}
					else
					{
						$('#text-error').html(response.message);
						$.smallBox({
							title: '',
							content:$('#message-error').html(),
							color: "#BA0916",
							timeout: 6000
						})
					}
					showInsert_rrhh();
					personadatasource.read();
				}
			});
		}   else {
			$.smallBox({
				title: "Error",
				content:"<p class='fg-white'>Por favor llene todos los campos</p>" ,
				color: "#9162E",
				timeout: 4000
			});
		}
	});
	$('#deletebutton_rrhh').click(function(){
		var checkbox_checked=$('#gridselection_persona.check_row:checked');

		if(checkbox_checked.length==0)
		{

			$.smallBox({
				title: "<span class='fa fa-trash-o'></span>     Eliminar Elemento ",
				content: "<p>Debe seleccionar al menos un elemento a eliminar</p>",
				color: "#F2092A",
				timeout: 1000,
				top:10
			})
		}
		else {
			var array=[];
			checkbox_checked.each(function(){
						var dataItem=Persona.finditem($(this).attr('id'));
						array.push(dataItem);
					}
			);
			$.MetroMessageBox({
				title: "<span class='fa fa-trash-o'></span> Eliminar ",
				content: "<p class='fg-white'>Desea eliminar los elementos seleccionados?</p> ",
				NormalButton: "#232323",
				ActiveButton: "#008a00 ",
				buttons: " [Cancelar][Aceptar]"
			}, function (a) {
				if (a == "Aceptar") {
					$.ajax({
						type: "POST",
						url: "?option=com_persona&task=persona_delete_one",
						data: {
							array: JSON.stringify(array)
						},
						success: function (response) {
							if (response.success == true) {
								var message = 'El elemento fue eliminado con exito';
								$.smallBox({
									title: '',
									content: $('#message-ok').html(),
									color: "#00A65A",
									timeout: 6000
								});
							}
							else {
								$('#text-error').html(response.message);
								$.smallBox({
									title: '',
									content: $('#message-error').html(),
									color: "#BA0916",
									timeout: 6000
								});
							}
							Persona.gridDataSource.read();
						}
						//error:problemas
					});
				}
				else
					close();

			})
		}
	});


});