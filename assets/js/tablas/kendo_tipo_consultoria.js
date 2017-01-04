/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Tipo={};
var message=""


//Creando los windows Dialogs
wnd_tipo = $("#type_consulting_window").kendoWindow({
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
		if(Tipo.oldElement!=null) {


			$('#consultoria').val(Tipo.oldElement.consultoria);

		}

		else
		{


		}
	}}).data("kendoWindow");



//Definir controladora
Tipo.oldElement=null;

Tipo.change = function onChange(arg) {
};
Tipo.change = function onDataBinding(arg) {
};
Tipo.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Tipo.kgrid=this;
}
Tipo.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Tipo.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}




function showInsert_tipo_consulting() {
	Tipo.oldElement=null;
	validator_tipo_consultoria.hideMessages();
	$('#type_consulting_form')[0].reset();
	$('#tasktype_consulting').val('insert');
	$('#accionbtn_type_consultingsave_exit').text('Guardar y Salir');
	wnd_tipo.title("Registrar Tipo de Consultoria");
	$('#accionbtn_type_consultingsave_new').show();
	wnd_tipo.center().open();
}

//Mostrar Ventanas
function showUpdate_tipo_consulting(e) {
	validator_tipo_consultoria.hideMessages();
	$('#type_consulting_form')[0].reset();
	var dataItem=Tipo.finditem(e.id);
	Tipo.oldElement= dataItem;
	$('#tasktype_consulting').val('update');
	wnd_tipo.title("Actualizar Tipo  de Consultoria");
	$('#accionbtn_solicitudsave_exit').text('Actualizar');
	$('#accionbtn_solicitudsave_new').hide();
	wnd_tipo.center().open();
}

//Eliminar elemento
function delete_element_tipo_consultoria(e)
{
	var dataItem=Tipo.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Tipo?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_tipo_consultoria&task=tipo_delete_one",
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
					Tipo.gridDataSource.read();
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
	validator_tipo_consultoria=$("#type_consulting_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var i = 0;
						if (Tipo.oldElement == null) {


							if (input.is("[id=consultoria]")) {
								var value = $('#consultoria').val();
								var size = value.length;

								if(size > 30){
									found=true;
									message="La consultoria ingresada no debe exceder los 30 caracteres";
									return $('#leido').val('');
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
	Tipo.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_tipo_consultoria&task=tipo_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			console.clear();
		},
		schema:{
			model:{
				fields:{
					id_tipo_consultoria:{type:"number"},
					consultoria:{type:"string"}



				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_tipo_consultoria").kendoGrid({
		dataSource: Tipo.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		groupable:true,
		sortable: true,
		change: Tipo.change,
		resizable: true,
		dataBound: Tipo.dataBound,
		dataBinding: Tipo.dataBinding,
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
				headerTemplate: "<input class='' id='all_check_solicitud' type='checkbox'/>",
				template: "<input class='check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,


			{
				field: "consultoria",
				title: "Consultoria",
				template:'<div id="item" data-text="#: consultoria#">#: consultoria#</div>',
				width: '15%',
				type:"string"
			}
		,
			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_tipo_consulting(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='fa fa-edit'></i></div>" +
				"<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='delete_element_tipo_consultoria(this)' data-toggle='tooltip' data-original-title='Eliminar|Eliminar elemento'><i class='fa fa-trash-o'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});

	/*Acciones de los botones*/

	$('#all_check_solicitud').click(function () {
		var c = this.checked;
		$('#gridselection_tipo_consultoria :checkbox').prop('checked',c);
	});

	$('#accionbtn_type_consultingsave_exit').click(function()
	{
		if (validator_tipo_consultoria.validate())
		{

			var fd = new FormData(document.querySelector("#type_consulting_form"));

			var  url="?option=com_tipo_consultoria&task=tipo_add";

			if($('#tasktype_consulting').val()=="update")
			{
				var olditem=JSON.stringify(Tipo.oldElement);
				fd.append('olditem',olditem);
				  url="?option=com_tipo_consultoria&task=tipo_update";
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
					Tipo.gridDataSource.read();
					$('#type_consulting_form')[0].reset();
					wnd_tipo.close();
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
	$('#accionbtn_type_consultingsave_new').click(function()
	{
		if (validator_tipo_consultoria.validate())
		{

			var fd = new FormData(document.querySelector("#type_consulting_form"));
			var url="?option=com_tipo_consultoria&task=tipo_add";
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
					showInsert_tipo_consulting();
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

	$('#cancelbtn_tipo_consultoria').click(function(){
		$('#type_consulting_form')[0].reset();
		Tipo.gridDataSource.read();
		wnd_tipo.close();
	});

	$('#addbutton_type_consulting').click(function(){
		showInsert_tipo_consulting();
	});
	$('#delete_element_tipo_consultoria').click(function(){
		var checkbox_checked=$('#gridselection_tipo_consultoria .check_row:checked');

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
						var dataItem=Tipo.finditem($(this).attr('id'));
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
						url:"?option=com_tipo_consultoria&task=tipo_delete_one",
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
							Tipo.gridDataSource.read();
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
