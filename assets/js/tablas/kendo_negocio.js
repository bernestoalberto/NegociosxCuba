/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator_negocio;
var Negocio={};
var path_bussines = "/images/negocio/";
var message="";



//Definir controladora
Negocio.oldElement=null;

//Mostrar Ventanas

//Eliminar elemento
function delete_element_negocio(e)
{
	var dataItem=Negocio.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Negocio?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_negocio&task=negocio_delete_one",
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
					Negocio.gridDataSource.read();
				}
				//error:problemas
			});
		}
		else
			close();
	})
}
Negocio.change = function onChange(arg) {
};
Negocio.change = function onDataBinding(arg) {
};
Negocio.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
/*
	$('.check_row').iCheck({
		checkboxClass: 'icheckbox_polaris',
		increaseArea: '20%'
	});
*/

	Negocio.kgrid=this;
}
Negocio.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Negocio.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}
function showUpdate_negocio(e) {
	validator_negocio.hideMessages();
	$('#negocio_form')[0].reset();
	var dataItem=Negocio.finditem(e.id);
	Negocio.oldElement= dataItem;
	$('#tasknegocio').val('update');
	document.getElementById("foto").required=false;
	wnd_negocio.title("Actualizar Negocio");
	$('#accionbtn_negociosave_exit').text('Actualizar');
	$('#accionbtn_negociosave_new').hide();
	document.getElementById('row_pic_1').hidden=true;
	document.getElementById('row_pic_2').hidden=true;
	document.getElementById('bussinespic1').src="";
	document.getElementById('bussinespic2').src="";
	wnd_negocio.center().open();
}
//On load
$(function() {
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
	var categorytasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_negocio&task=categoria_json_list",
				dataType: "json"
			}
		}
	});

	/*ComboBox  Prioridad*/
	$("#categoria").kendoDropDownList ({
		dataTextField: "title",
		dataValueField: "id",
		dataSource: categorytasource,
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
	$("#telefono_fijo").kendoNumericTextBox({
		max:99999999999,
		format: "537-000-00",
		decimals:0,
		min:1111111,
		spinners:false
	});
	$("#otro_telefono").kendoNumericTextBox({
		max:99999999999,
		format: "537-000-00",
		decimals:0,
		min:1111111,
		spinners:false
	});
	function showInsert_negocio() {
		Negocio.oldElement=null;
		validator_negocio.hideMessages();
		$('#negocio_form')[0].reset();
		$('#tasknegocio').val('insert');
		$('#accionbtn_negociosave_exit').text('Guardar y Salir');
		wnd_negocio.title("Crear Negocio");
		$('#accionbtnnegocio_save_new').show();
		document.getElementById("foto").required= true;
		document.getElementById('row_pic_1').hidden=true;
		document.getElementById('row_pic_2').hidden=true;
		document.getElementById('bussinespic').src="";
		document.getElementById('bussinespic1').src="";
		document.getElementById('bussinespic2').src="";
		wnd_negocio.center().open();
	}
//Creando los windows Dialogs
	wnd_negocio = $("#negocio_window").kendoWindow({
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
			if(Negocio.oldElement!=null) {
				$('#nombre_negocio').val(Negocio.oldElement.nombre_negocio);
				$('#id_usuario').data("kendoDropDownList").value(Negocio.oldElement.id);
				$('#categoria').data("kendoDropDownList").value(Negocio.oldElement.categoria);
				$('#direccion_negocio').val(Negocio.oldElement.direccion_negocio);
				$('#resenya_negocio').val(Negocio.oldElement.resenya_negocio);
				$('#telefono_fijo').data("kendoNumericTextBox").value(Negocio.oldElement.telefono_fijo);
				$('#otro_telefono').data("kendoNumericTextBox").value(Negocio.oldElement.otro_telefono);
				$('#id_negocio').val(Negocio.oldElement.id_negocio);
				$('#correo').val(Negocio.oldElement.correo);
				$('#url').val(Negocio.oldElement.url);


				document.getElementById('row_pics').hidden=false;
				document.getElementById('bussinespic').src=".."+path_bussines+Negocio.oldElement.foto;
				if(Negocio.oldElement.foto1 != "no tiene"){
					document.getElementById('row_pic_1').hidden=false;
					document.getElementById('bussinespic1').src=".."+path_bussines+Negocio.oldElement.foto1;
				}

				if(Negocio.oldElement.foto2 !="no tiene"){
					document.getElementById('row_pic_2').hidden=false;
					document.getElementById('bussinespic2').src=".."+path_bussines+Negocio.oldElement.foto2;
				}
				switch (Negocio.oldElement.cliente_premium){

					case 1:
						$("#cliente_premium2").prop("checked",true);
						break;
					case 2:
						$("#cliente_premium3").prop("checked",true);
						break;
				}
			}
			else
			{
				$('#id_usuario').data("kendoDropDownList").value('');
				$('#categoria').data("kendoDropDownList").value('');

			}

		}}).data("kendoWindow");
	validator_negocio=$("#negocio_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var size = value.length;

						if (Negocio.oldElement == null) {

							if (input.is("[id=nombre_negocio]")) {



								if (size > 30  ) {
									found = true;
									message = "El nombre del negocio es mas largo de lo permitido";
									return $('#nombre_negocio').val('');
								}



							}
							if (input.is("[id=direccion_negocio]")) {



								if (size > 100  ) {
									found = true;
									message = "La dirección del negocio es mas largo de lo permitido";
									return $('#direccion_negocio').val('');
								}



							}
							if (input.is("[id=correo]")) {

								if (size > 50  ) {
									found = true;
									message = "El correo del negocio es mas largo de lo permitido";
									return $('#correo').val('');
								}



							}
							if (input.is("[id=resenya_negocio]")) {



								if (size > 150  ) {
									found = true;
									message = "La reseña del negocio es mas largo de lo permitido";
									return $('#resenya_negocio').val('');
								}



							}
							if (input.is("[id=foto]")) {
								var file = document.getElementById('foto').files[0];
								var ext = file.type;
								var overall =  file.size;
								document.getElementById('bussinespic').src=$('#foto').val();
								if($("#foto1").val() != ""){
									var file1 = document.getElementById('foto1').files[0];
									var sizefile1 =  file1.size;

									overall = sizefile1 + overall;

								}
								if($("#foto2").val() != ""){
									var file2 = document.getElementById('foto2').files[0];
									var sizefile2 =  file2.size;

									overall = sizefile2 + overall;
								}

								if(ext !="image/jpeg" || ext !="image/png"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#foto').val('');
								}
								else if(overall > 9992132){
									$("#foto1").val('');
									$("#foto2").val('');
									return $('#foto').val('');
								}



							}
							if (input.is("[id=foto1]")) {
								if($("#foto1").val() != "") {
									var file1 = document.getElementById('foto1').files[0];
									var ext1 = file1.type;
									var overall = file1.size;
								}

								if($("#foto").val() != ""){
									var file = document.getElementById('foto').files[0];
									var sizefile =  file.size;

									overall = sizefile + overall;
								}
								if($("#foto2").val() != ""){
									var file2 = document.getElementById('foto2').files[0];
									var sizefile2 =  file2.size;

									overall = sizefile2 + overall;
								}

								if(ext1 !="image/jpeg" || ext !="image/png"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#foto1').val('');
								}
								else if(overall > 9992132){
									$("#foto1").val('');
									$("#foto2").val('');
									return $('#foto').val('');
								}



							}
							if (input.is("[id=foto2]")) {
								if($("#foto2").val() != "") {
									var file2 = document.getElementById('foto2').files[0];
									var ext2 = file2.type;
									var overall = file2.size;
								}
								if($("#foto").val() != ""){
									var file = document.getElementById('foto').files[0];
									var sizefile =  file.size;

									overall = sizefile + overall;
								}
								if($("#foto1").val() != ""){
									var file1 = document.getElementById('foto1').files[0];
									var sizefile1 =  file1.size;

									overall = sizefile1 + overall;
								}

								if(ext2 !="image/jpeg" || ext !="image/png"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#foto2').val('');
								}
								else if(overall > 9992132){
									$("#foto1").val('');
									$("#foto2").val('');
									return $('#foto').val('');
								}



							}
							return !found;
						}

						else if($('#tasknegocio').val()=='update'){

							if (input.is("[id=nombre_negocio]")) {



								if (size > 30  ) {
									found = true;
									message = "El nombre del negocio es mas largo de lo permitido";
									return $('#nombre_negocio').val('');
								}



							}
							if (input.is("[id=direccion_negocio]")) {


								if (size > 100  ) {
									found = true;
									message = "La dirección del negocio es mas largo de lo permitido";
									return $('#direccion_negocio').val('');
								}



							}
							if (input.is("[id=resenya_negocio]")) {



								if (size > 150  ) {
									found = true;
									message = "La reseña del negocio es mas largo de lo permitido";
									return $('#resenya_negocio').val('');
								}



							}
							if (input.is("[id=foto]")) {
								var file = document.getElementById('foto').files[0];
								if(file!=null){
									var ext = file.type;
									var overall =  file.size;
								}


								if($("#foto1").val() != ""){
									var file1 = document.getElementById('foto1').files[0];
									var sizefile1 =  file1.size;

									overall = sizefile1 + overall;
								}
								if($("#foto2").val() != ""){
									var file2 = document.getElementById('foto2').files[0];
									var sizefile2 =  file2.size;

									overall = sizefile2 + overall;
								}

								if(ext !="image/jpeg" || ext !="image/png"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#foto').val('');
								}
								else if(overall > 9992132){
									$("#foto1").val('');
									$("#foto2").val('');
									return $('#foto').val('');
								}



							}
							if (input.is("[id=foto1]")) {
								if($("#foto1").val() != "") {
									var file1 = document.getElementById('foto1').files[0];
									var ext1 = file1.type;
									var overall = file1.size;
								}
								if($("#foto").val() != ""){
									var file = document.getElementById('foto').files[0];
									var sizefile =  file.size;

									overall = sizefile + overall;
								}
								if($("#foto2").val() != ""){
									var file2 = document.getElementById('foto2').files[0];
									var sizefile2 =  file2.size;

									overall = sizefile2 + overall;
								}

								if(ext1 !="image/jpeg" || ext !="image/png"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#foto1').val('');
								}
								else if(overall > 9992132){
									$("#foto1").val('');
									$("#foto2").val('');
									return $('#foto').val('');
								}



							}
							if (input.is("[id=foto2]")) {
								if($("#foto2").val() != "") {
									var file2 = document.getElementById('foto2').files[0];
									var ext2 = file2.type;
									var overall = file2.size;
								}
								if($("#foto").val() != ""){
									var file = document.getElementById('foto').files[0];
									var sizefile =  file.size;

									overall = sizefile + overall;
								}
								if($("#foto1").val() != ""){
									var file1 = document.getElementById('foto1').files[0];
									var sizefile1 =  file1.size;

									overall = sizefile1 + overall;
								}

								if(ext2 !="image/jpeg" || ext !="image/png"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#foto2').val('');
								}
								else if(overall > 9992132){
									$("#foto1").val('');
									$("#foto2").val('');
									return $('#foto').val('');
								}



							}
							if (input.is("[id=correo]")) {

								if (size > 50  ) {
									found = true;
									message = "El correo del negocio es mas largo de lo permitido";
									return $('#correo').val('');
								}



							}
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
	Negocio.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_negocio&task=negocio_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
		},
		schema:{
			model:{
				fields:{
					id_negocio:{type:"number"},
					nombre_negocio:{type:"string"},
					direccion_negocio:{type:"string"},
					resenya_negocio:{type:"string"},
					foto:{type:"string"},
					otro_telefono:{type:"number"},
					telefono_fijo:{type:"number"},
					correo:{type:"string"},
					id:{type:"number"},
					foto1:{type:"string"},
					foto2:{type:"string"},
					url:{type:"string"},
					usuario:{type:"string"},
					categoria:{type:"number"},
					category:{type:"string"},
					cliente_premium:{type:"number"},
					tipo_cliente:{type:"string"}



				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_negocio").kendoGrid({
		dataSource: Negocio.gridDataSource,
		height: 550,
		width: 900,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_negocio").html()),
		detailInit: detailInit,
		groupable:true,
		sortable: true,
		change: Negocio.change,
		resizable: true,
		dataBound: Negocio.dataBound,
		dataBinding: Negocio.dataBinding,
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
				headerTemplate: "<input class='' id='all_check_negocio' type='checkbox'/>",
				template: "<input class='check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,

			{
				field: "id_negocio",
				template:'<div id="item" data-text="#: id_negocio#">#: id_negocio#</div>',
				title: "Id",
				width: '5%',
				type:"number",
				hidden:true
			}
			,

			{
				field: "category",
				template:'<div id="item" data-text="#: category#">#: category#</div>',
				title: "Categoria",
				width: '10%',
				type:"string"
			}
			,
			{
				field: "nombre_negocio",
				template:'<div id="item" data-text="#: nombre_negocio#">#: nombre_negocio#</div>',
				title: "Negocio",
				width: '10%',
				type:"string"
			}
			,

			{
				field: "direccion_negocio",
				title: "Dirección",
				template:'<div id="item" data-text="#: direccion_negocio#">#: direccion_negocio#</div>',
				width: '10%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "resenya_negocio",
				title: "Reseña",
				template:'<div id="item" data-text="#: resenya_negocio#">#: resenya_negocio#</div>',
				width: '10%',
				type:"string",
				hidden:true
			}
			,

			{
				field: "foto",
				template:'<div id="item" data-text="#: foto#"><img class="user-image img-circle" data-image="#: foto#" data-nombre="#: foto#" width="25px" height="25px" src="../negocioxCuba/../images/negocio/#:foto#"></div>',
				title: "Foto",
				width: '6%',
				type:"string"
			}
			,
			{
				field: "otro_telefono",
				title: "Otro Telefono",
				template:'<div id="item" data-text="#: otro_telefono#">#: otro_telefono#</div>',
				width: '10%',
				type:"number",
				hidden:true
			}
			,

			{
				field: "telefono_fijo",
				template:'<div id="item" data-text="#: telefono_fijo#">#: telefono_fijo#</div>',
				title: "Telefono",
				width: '8%',
				type:"number",
				hidden:true
			},
			{
				field: "correo",
				template:'<div id="item" data-text="#: correo#">#: correo#</div>',
				title: "correo",
				width: '8%',
				type:"string",
				hidden:true
			}
			,

			{
				field: "id",
				title: "id",
				template:'<div id="item" data-text="#: id#">#: id#</div>',
				width: '3%',
				type:"number",
				hidden:true
			}
			,
			{
				field: "usuario",
				title: "Usuario",
				template:'<div id="item" data-text="#: usuario#">#: usuario#</div>',
				width: '8%',
				type:"string"
			}
			,


			{
				field: "foto1",
				template:'<div id="item" data-text="#: foto1#"><img class="user-image img-circle" data-image="#: foto1#" data-nombre="#: foto1#" width="25px" height="25px" src="../negocioxCuba/../images/negocio/#:foto1#"></div>',
				title: "Foto",
				width: '6%',
				type:"string",
				hidden:true
			},

			{
				field: "foto2",
				template:'<div id="item" data-text="#: foto2#"><img class="user-image img-circle" data-image="#: foto2#" data-nombre="#: foto2#" width="25px" height="25px" src="../negocioxCuba/../images/negocio/#:foto2#"></div>',
				title: "Foto",
				width: '6%',
				type:"string",
				hidden:true
			},

			{
				field: "url",
				template:'<div id="item" data-text="#: url#">#: url#</div>',
				title: "Url",
				width: '15%',
				type:"string",
				hidden:true
			}
			,


			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_negocio(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='fa fa-edit'></i></div>" +
				"<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='delete_element_negocio(this)' data-toggle='tooltip' data-original-title='Eliminar|Eliminar elemento'><i class='fa fa-trash-o'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});
	function detailInit(e) {
		var detailRow = e.detailRow;

		var datos = [{foto1:e.data.foto1,foto2:e.data.foto2,url:e.data.url,telefono_fijo:e.data.telefono_fijo,otro_telefono:e.data.otro_telefono,
			correo:e.data.correo,direccion_negocio:e.data.direccion_negocio,resenya_negocio:e.data.resenya_negocio, tipo_cliente:e.data.tipo_cliente}];

		detailRow.find(".tabstrip").kendoTabStrip({
			animation: {
				open: { effects: "fadeIn" }
			}
		});

		detailRow.find(".orders").kendoGrid({
			dataSource:datos,
			scrollable: false,
			resizable: true,
			sortable: true,
			pageable: true,
			columns: [
				{ field: "foto1",template:'<div id="item" data-text="#: foto1#"><img class="user-image img-circle" data-image="#: foto1#" data-nombre="#: foto1#" width="25px" height="25px" src="../negocioxCuba/../images/negocio/#:foto1#"></div>', title:"Foto", width: "80px" },
				{ field: "foto2",template:'<div id="item" data-text="#: foto2#"><img class="user-image img-circle" data-image="#: foto2#" data-nombre="#: foto2#" width="25px" height="25px" src="../negocioxCuba/../images/negocio/#:foto2#"></div>', title:"Foto", width: "70px" },
				{ field: "url", title:"URL" },
				{ field: "telefono_fijo", title:"Teléfono" },
				{ field: "otro_telefono", title: "Otro Telefono", width: "70px" },
				{ field: "correo", title: "Correo", width: "70px" },
				{ field: "direccion_negocio", title: "Dirección", width: "70px" },
				{ field: "resenya_negocio", title: "Reseña", width: "70px" },
				{ field: "tipo_cliente", title: "Cliente", width: "70px" }

			]
		});

	}

	/*Acciones de los botones*/

/*
	$('#all_check_negocio').iCheck({
		checkboxClass: 'icheckbox_polaris',
		increaseArea: '20%' // optional


	});*/
	$('#all_check_negocio').click(function () {
		var c = this.checked;
		$('#gridselection_negocio :checkbox').prop('checked',c);
	});
	$('#accionbtn_negociosave_exit').click(function()
	{
		if (validator_negocio.validate())
		{

			var fd = new FormData(document.querySelector("#negocio_form"));
			var  url="?option=com_negocio&task=negocio_add";

			if($('#tasknegocio').val()=="update")
			{
				var olditem=JSON.stringify(Negocio.oldElement);
				fd.append('olditem',olditem);
				url="?option=com_negocio&task=negocio_update";
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
					Negocio.gridDataSource.read();
					$('#negocio_form')[0].reset();
					wnd_negocio.close();
				}
			});
		}   else {
			$.smallBox({
				title: "Error",
				content:"<p class='fg-white'>Por favor llene todos los campos</p>" ,
				color: "9162E",
				timeout: 4000
			});
		}
	});
	$('#accionbtn_negociosave_new').click(function()
	{
		if (validator_negocio.validate())
		{

			var fd = new FormData(document.querySelector("#negocio_form"));
			var url="?option=com_negocio&task=negocio_add";
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
					showInsert_negocio();
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

	$('#cancelbtn_negocio').click(function(){
		$('#negocio_form')[0].reset();
		Negocio.gridDataSource.read();
		wnd_negocio.close();
	});

	$('#addbutton_negocio').click(function(){
		showInsert_negocio();
	});
	$('#deletebutton_negocio').click(function(){
		var checkbox_checked=$('#gridselection_negocio .check_row:checked');

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
						var dataItem=Negocio.finditem($(this).attr('id'));
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
				if(a=="Aceptar")
				{
					$.ajax({
						type: "POST",
						url:"?option=com_negocio&task=negocio_delete_one",
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
							Negocio.gridDataSource.read();
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


$('#all_check_negocio').click(function(){
	alert('dfgd')
	var c= this.checked;
	$("#gridselection_negocio :checkbox").prop('checked',c);
});