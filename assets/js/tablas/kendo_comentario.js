/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Comentario={};
var message=""


//Creando los windows Dialogs
wnd_comentario = $("#comentario_window").kendoWindow({
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
		if(Comentario.oldElement!=null) {

			$('#comentario').val(Comentario.oldElement.comentario);
			$('#titulo').val(Comentario.oldElement.titulo);
			$('#fecha').data("kendoDatePicker").value(Comentario.oldElement.fecha);
			$('#id_categoria').data("kendoDropDownList").value(Comentario.oldElement.id_categoria);
			$('#id_user').data("kendoDropDownList").value(Comentario.oldElement.id_user);

		}

		else
		{
			$('#id_categoria').data("kendoDropDownList").value('');
			$('#id_user').data("kendoDropDownList").value('');
			$('#fecha').data("kendoDropDownList").value('');

		}
	}}).data("kendoWindow");



//Definir controladora
Comentario.oldElement=null;


Comentario.change = function onChange(arg) {
};
Comentario.change = function onDataBinding(arg) {
};
Comentario.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Comentario.kgrid=this;
}
Comentario.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Comentario.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}


$("#fecha").kendoDatePicker({
	value: kendo.date.today(),
	parseFormats: ["yyyy/MM/dd"],
	singleDatePicker:true,
	format: 'yyyy/MM/dd',
	showDropdowns:true,
	open:function(e){
	},
	change:function(e){
	},
	close:function(e){
	}
});

var negociodatasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_negocio&task=categoria_json_list",
			dataType: "json"
		}
	}
});

/*ComboBox  Prioridad*/
$("#id_categoria").kendoDropDownList ({
	dataTextField: "title",
	dataValueField: "id",
	dataSource: negociodatasource,
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
var usuariodatasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_negocio&task=usuario_json_list",
			dataType: "json"
		}
	}
});


$("#id_user").kendoDropDownList ({
	dataTextField: "username",
	dataValueField: "id_user",
	dataSource: usuariodatasource,
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

function showInsert_comentario() {
	Comentario.oldElement=null;
	validator_comentario.hideMessages();
	$('#comentario_form')[0].reset();
	$('#taskcomentario').val('insert');
	$('#accionbtn_comentariosave_exit').text('Guardar y Salir');
	wnd_comentario.title("Registrar Comentario");
	$('#accionbtncomentario_save_new').show();
	wnd_comentario.center().open();
}

//Mostrar Ventanas
function showUpdate_comentario(e) {
	validator_comentario.hideMessages();
	$('#comentario_form')[0].reset();
	var dataItem=Comentario.finditem(e.id);
	Comentario.oldElement= dataItem;
	$('#taskcomentario').val('update');
	wnd_comentario.title("Ver Comentario");
	wnd_comentario.center().open();
}

//Eliminar elemento
function delete_element_comentario(e)
{
	var dataItem=Comentario.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Comentario?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_comentario&task=comentario_delete_one",
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
					Comentario.gridDataSource.read();
				}
				//error:problemas
			});
		}
		else
			close();
	})
}
//On load
$(function() {

	validator_comentario=$("#comentario_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var i = 0;
						if (Comentario.oldElement == null) {
							if (input.is("[id=titulo]")) {
								 value = $('#titulo').val();
								var size = value.length;

								if(size > 50){
									found=true;
									message="El titulo ingresado no debe exceder los 50 caracteres";
									return $('#titulo').val('');
								}
							}
							if (input.is("[id=comentario]")) {
								 value = $('#comentario').val();
								var size = value.length;

								if(size > 250){
									found=true;
									message="La comentario ingresada no debe exceder los 250 caracteres";
									return $('#comentario').val('');
								}
							}
							return !found;
						}
						else if($('#taskcomentario').val()=='update'){
							if (input.is("[id=titulo]")) {
								value = $('#titulo').val();
								var size = value.length;

								if(size > 50){
									found=true;
									message="El titulo ingresado no debe exceder los 50 caracteres";
									return $('#titulo').val('');
								}
							}
							if (input.is("[id=comentario]")) {
								value = $('#comentario').val();
								var size = value.length;

								if(size > 250){
									found=true;
									message="La comentario ingresada no debe exceder los 250 caracteres";
									return $('#comentario').val('');
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
	Comentario.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_comentario&task=comentario_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
		},
		schema:{
			model:{
				fields:{
					id_comentario:{type:"number"},
					titulo:{type:"string"},
					id_user:{type:"number"},
					usuario:{type:"string"},
					fecha:{type:"date"},
					id_articulo:{type:"number"},
					categoria:{type:"string"},
					comentario:{type:"string"}


				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_comentario").kendoGrid({
		dataSource: Comentario.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_comentario").html()),
		groupable:true,
		sortable: true,
		change: Comentario.change,
		resizable: true,
		dataBound: Comentario.dataBound,
		dataBinding: Comentario.dataBinding,
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
				headerTemplate: "<input class='' id='all_check_comentario' type='checkbox'/>",
				template: "<input class='check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,
			{
				field: "categoria",
				title: "Categoria",
				template:'<div id="item" data-text="#: categoria#">#: categoria#</div>',
				width: '10%',
				type:"string"
			}
			,
			{
				field: "titulo",
				template:'<div id="item" data-text="#: titulo#">#: titulo#</div>',
				title: "Titulo",
				width: '10%',
				type:"string"
			}
			,

			{
				field: "usuario",
				template:'<div id="item" data-text="#: usuario#">#: usuario#</div>',
				title: "Usuario",
				width: '10%',
				type:"string"
			}
			,
			{
				field: "foto_profile",
				template:'<div id="item" data-text="#: foto_profile#"><img class="user-image img-circle" data-image="#: foto_profile#" data-nombre="#: foto_profile#" width="25px" height="25px" src="../personaxCuba/../images/perfil/#:foto_profile#"></div>',
				title: "Foto",
				width: '5%',
				type:"string"
			}
			,


			{
				field: "fecha",
				title: "Fecha",
				width: '10%',
				format:"{0:dd-MM-yyyy}"	,
				type:"date",

			}
			,
			{
				field: "comentario",
				title: "Comentario",
				template:'<div id="item" data-text="#: comentario#">#: comentario#</div>',
				width: '10%',
				type:"string",
				hidden:true
			}
		,
			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_comentario(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='ion-ios-search'></i></div>" +
				"<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='delete_element_comentario(this)' data-toggle='tooltip' data-original-title='Eliminar|Eliminar elemento'><i class='fa fa-trash-o'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});

	/*Acciones de los botones*/

	$('#all_check_comentario').click(function () {
		var c = this.checked;
		$('#gridselection_comentario :checkbox').prop('checked',c);
	});
	$('#accionbtn_comentariosave_exit').click(function()
	{
		if (validator_comentario.validate())
		{

			var fd = new FormData(document.querySelector("#comentario_form"));

			var  url="?option=com_comentario&task=comentario_add";

			if($('#taskcomentario').val()=="update")
			{
				var olditem=JSON.stringify(Comentario.oldElement);
				fd.append('olditem',olditem);
				  url="?option=com_comentario&task=comentario_update";
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
					Comentario.gridDataSource.read();
					$('#comentario_form')[0].reset();
					wnd_comentario.close();
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
	$('#accionbtn_comentariosave_new').click(function()
	{
		if (validator_comentario.validate())
		{

			var fd = new FormData(document.querySelector("#comentario_form"));
			var url="?option=com_comentario&task=comentario_add";
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
					showInsert_comentario();
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

	$('#cancelbtn_comentario').click(function(){
		$('#comentario_form')[0].reset();
		Comentario.gridDataSource.read();
		wnd_comentario.close();
	});

	$('#addbutton_comentario').click(function(){
		showInsert_comentario();
	});
	$('#deletebutton_comentario').click(function(){
		var checkbox_checked=$('#gridselection_comentario .check_row:checked');

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
						var dataItem=Comentario.finditem($(this).attr('id'));
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
						url:"?option=com_comentario&task=comentario_delete_one",
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
							Comentario.gridDataSource.read();
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
