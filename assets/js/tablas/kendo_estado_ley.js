/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Estado_Ley={};
var message=""


//Creando los windows Dialogs
wnd_ley = $("#ley_window").kendoWindow({
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
		if(Estado_Ley.oldElement!=null) {


			$('#estado').val(Estado_Ley.oldElement.estado);

		}

		else
		{


		}
	}}).data("kendoWindow");



//Definir controladora
Estado_Ley.oldElement=null;

Estado_Ley.change = function onChange(arg) {
};
Estado_Ley.change = function onDataBinding(arg) {
};
Estado_Ley.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Estado_Ley.kgrid=this;
}
Estado_Ley.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Estado_Ley.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}




function showInsert_ley() {
	Estado_Ley.oldElement=null;
	validator_ley.hideMessages();
	$('#ley_form')[0].reset();
	$('#taskley').val('insert');
	$('#accionbtn_leysave_exit').text('Guardar y Salir');
	wnd_ley.title("Registrar Estado_Ley");
	$('#accionbtn_leysave_new').show();
	wnd_ley.center().open();
}

//Mostrar Ventanas
function showUpdate_ley(e) {
	validator_ley.hideMessages();
	$('#ley_form')[0].reset();
	var dataItem=Estado_Ley.finditem(e.id);
	Estado_Ley.oldElement= dataItem;
	$('#taskley').val('update');
	wnd_ley.title("Actualizar Estado_Ley");
	$('#accionbtn_leysave_exit').text('Actualizar');
	$('#accionbtn_leysave_new').hide();
	wnd_ley.center().open();
}

//Eliminar elemento
function delete_element_ley(e)
{
	var dataItem=Estado_Ley.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Estado_Ley?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_estado_ley&task=ley_delete_one",
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
					Estado_Ley.gridDataSource.read();
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
	validator_ley=$("#ley_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var i = 0;
						if (Estado_Ley.oldElement == null) {


							if (input.is("[id=estado]")) {
								var value = $('#estado').val();
								var size = value.length;

								if(size > 30){
									found=true;
									message="El estado ingresado no debe exceder los 30 caracteres";
									return $('#estado').val('');
								}
							}
							return !found;


						}
						else if($('#taskley').val()=='update'){
							if (input.is("[id=estado]")) {
								var value = $('#estado').val();
								var size = value.length;

								if(size > 30){
									found=true;
									message="El estado ingresado no debe exceder los 30 caracteres";
									return $('#estado').val('');
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
	Estado_Ley.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_estado_ley&task=ley_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
		},
		schema:{
			model:{
				fields:{
					id_estado_ley:{type:"number"},
					estado:{type:"string"}



				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_estado_ley").kendoGrid({
		dataSource: Estado_Ley.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		groupable:true,
		sortable: true,
		change: Estado_Ley.change,
		resizable: true,
		dataBound: Estado_Ley.dataBound,
		dataBinding: Estado_Ley.dataBinding,
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
				headerTemplate: "<input class='' id='all_check_ley' type='checkbox'/>",
				template: "<input class='check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,


			{
				field: "estado",
				title: "Estado",
				template:'<div id="item" data-text="#: estado#">#: estado#</div>',
				width: '15%',
				type:"string"
			}
		,
			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_ley(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='fa fa-edit'></i></div>" +
				"<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='delete_element_ley(this)' data-toggle='tooltip' data-original-title='Eliminar|Eliminar elemento'><i class='fa fa-trash-o'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});

	/*Acciones de los botones*/

	$('#all_check_ley').click(function () {
		var c = this.checked;
		$('#gridselection_ley :checkbox').prop('checked',c);
	});

	$('#accionbtn_leysave_exit').click(function()
	{
		if (validator_ley.validate())
		{

			var fd = new FormData(document.querySelector("#ley_form"));

			var  url="?option=com_estado_ley&task=ley_add";

			if($('#taskley').val()=="update")
			{
				var olditem=JSON.stringify(Estado_Ley.oldElement);
				fd.append('olditem',olditem);
				var  url="?option=com_estado_ley&task=ley_update";
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
					Estado_Ley.gridDataSource.read();
					$('#ley_form')[0].reset();
					wnd_ley.close();
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
	$('#accionbtn_leysave_new').click(function()
	{
		if (validator_ley.validate())
		{

			var fd = new FormData(document.querySelector("#ley_form"));
			var url="?option=com_estado_ley&task=ley_add";
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
					showInsert_ley();
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

	$('#cancelbtn_ley').click(function(){
		$('#ley_form')[0].reset();
		Estado_Ley.gridDataSource.read();
		wnd_ley.close();
	});

	$('#addbutton_ley').click(function(){
		showInsert_ley();
	});
	$('#deletebutton_ley').click(function(){
		var checkbox_checked=$('#gridselection_ley .check_row:checked');

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
						var dataItem=Estado_Ley.finditem($(this).attr('id'));
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
						url:"?option=com_estado_ley&task=ley_delete_one",
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
							Estado_Ley.gridDataSource.read();
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
