/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Solicitud={};
var Solicitud_Negocio={};
var message="";
var path_profile = "/images/perfil/";
var path_img = "/images/negocio/";
var thumb = "aint.jpg";





Solicitud_Negocio.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Solicitud_Negocio.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}
Solicitud_Negocio.gridDataSource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_solicitud&task=negocios_by_user_solicitud_json_list",
			dataType: "json"
		}

	},
	change: function(e){
		console.clear();
	},

	schema:{
		model:{
			fields:{
				id_solicitud:{type:"number"},
				asunto:{type:"string"},
				fecha:{type:"date"},
				estado:{type:"number"},
				descripcion:{type:"string"},
				id_usuario:{type:"number"},
				nombre:{type:"string"},
				identificacion:{type:"number"},
				telefono:{type:"number"},
				correo:{type:"string"},
				direccion:{type:"string"},
				foto_perfil:{type:"string"},
				negocios:{type:"string"}

			}
		}
	},
});
Solicitud_Negocio.change = function onChange(arg) {
	$.map(this.select(), function(item) {
		return $(item).text();
	});

}





//Creando los windows Dialogs
wnd_solicitud = $("#solicitud_sin_procesar_window").kendoWindow({
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
		if(Solicitud.oldElement!=null) {
			$('#asunto').val(Solicitud.oldElement.asunto);
			$('#direccion').val(Solicitud.oldElement.direccion);
			$('#correo_solicitud').val(Solicitud.oldElement.correo);
			$('#nombre').val(Solicitud.oldElement.nombre);
			$('#identificacion').data("kendoNumericTextBox").value(Solicitud.oldElement.identificacion);
			$('#telefono').data("kendoNumericTextBox").value(Solicitud.oldElement.telefono);


			if(Solicitud.oldElement.foto_perfil!=null){
				document.getElementById('foto_perfil').src = ".."+path_profile+Solicitud.oldElement.foto_perfil ;
			}
			else{
				document.getElementById('foto_perfil').src = ".."+path_img+thumb;
			}
			$('#estado').val(Solicitud.oldElement.estado);
		}

		else
		{
			$('#identificacion').data("kendoNumericTextBox").value('');
			$('#telefono').data("kendoNumericTextBox").value('');


		}
		document.getElementById("panel_pic").hidden=true;
	}}).data("kendoWindow");

Solicitud.change = function onChange(arg) {
	$.map(this.select(), function(item) {
		return $(item).text();
	});

};
Solicitud.dataBind = function onDataBinding(arg) {


};
Solicitud.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Solicitud.kgrid=this;


}
Solicitud.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Solicitud.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}

$("#telefono").kendoNumericTextBox({
	max:9999999,
	format: "537-000-00",
	min:1111111,
	spinners:false,
	decimals:0
});
$("#identificacion").kendoNumericTextBox({
	max:99999999999,
	min:11111111111,
	spinners:false,
	decimals:0
});

//Definir controladora
Solicitud.oldElement=null;





//Mostrar Ventanas
function showSolicitud_Sin_Procesar(e) {
	validator_solicitud.hideMessages();
	$('#solicitud_form')[0].reset();
	var dataItem=Solicitud.finditem(e.id);
	var user = dataItem.id_usuario;
	Solicitud_Negocio.gridDataSource.read({user:user});
	Solicitud.oldElement= dataItem;
	$('#tasksolicitud').val('update');
	wnd_solicitud.title("Datos de  Solicitud de Inscripción del Negocio");
	//$('#accionbtn_solicitudsave_exit').text('Actualizar');
	wnd_solicitud.center().open();
}


//On load
$(function() {



	validator_solicitud=$("#solicitud_sin_procesar_window").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var i = 0;
						if($('#tasksolicitud').val()=='update'){

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

	validator_confirm=$("#confirmar_solicitud_window").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var i = 0;
						if($('#tasksolicitud').val()=='update'){

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
	Solicitud.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_solicitud&task=solicitud_json_list",
				dataType: "json"
			}
		},
		change: function(e){

			console.clear();
		},
		schema:{
			model:{
				fields:{
					id_solicitud:{type:"number"},
					asunto:{type:"string"},
					fecha:{type:"date"},
					estado:{type:"number"},
					descripcion:{type:"string"},
					id_usuario:{type:"number"},
					nombre:{type:"string"},
					identificacion:{type:"number"},
					telefono:{type:"number"},
					correo:{type:"string"},
					direccion:{type:"string"},
					foto_perfil:{type:"string"}


				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_solicitud").kendoGrid({
		dataSource: Solicitud.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		sortable: true,
		change: Solicitud.change,
		resizable: true,
		dataBound: Solicitud.dataBound,
		dataBinding: Solicitud.dataBinding,
		pageable: {
			buttonCount: 5,
			refresh: true,
			pageSizes: [2,10,20,30,50,100]
		},
		columns: [


			{
				field: "nombre",
				template:'<div id="item" data-text="#: nombre#">#: nombre#</div>',
				title: "Usuario",
				width: '10%',
				type:"string"
			}
			,

			{
				field: "fecha",
				title: "Fecha",
				width: '10%',
				format:"{0:dd-MM-yyyy}"	,
				type:"date",
				hidden:true
			}
			,
			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default'  id='#: uid#' onclick='showSolicitud_Sin_Procesar(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='ion-ios-search'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '5%'
			}
		]
	});

	/*Acciones de los botones*/

	$('#all_check_solicitud').click(function () {
		var c = this.checked;
		$('#gridselection_solicitud :checkbox').prop('checked',c);
	});
	$('#accionbtn_solicitudsave_exit').click(function()
	{
		if (validator_solicitud.validate())
		{

			var fd = new FormData(document.querySelector("#solicitud_form"));

			var  url="?option=com_solicitud&task=solicitud_add";

			if($('#tasksolicitud').val()=="update")
			{
				var olditem=JSON.stringify(Solicitud.oldElement);
				fd.append('olditem',olditem);
				var  url="?option=com_solicitud&task=solicitud_update";
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
					Solicitud.gridDataSource.read();
					$('#solicitud_form')[0].reset();
					wnd_solicitud.close();
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

	$('#cancel_btn').click(function(){
		$('#solicitud_form')[0].reset();
		Solicitud.gridDataSource.read();
		wnd_solicitud.close();
	});

	$('#accionbtn_aceptar_solicitudsave_exit').click(function(){
		var checkbox_checked=$('#gridselection_negocio_list .check_row:checked');

		if(checkbox_checked.length==0)
		{

			$.smallBox({
				title: "<span class='fa fa-trash-o'></span>     Aceptar Negocio ",
				content: "<p>Debe seleccionar al menos un elemento a aceptar</p>",
				color: "#F2092A",
				timeout: 1000,
				top:10
			})
		}
		else{
			showConfirm_solicitud();
		}

	});
	$('#deletebutton_solicitud').click(function(){
		var checkbox_checked=$('#gridselection_solicitud .check_row:checked');

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
						var dataItem=Solicitud.finditem($(this).attr('id'));
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
						url:"?option=com_solicitud&task=solicitud_delete_one",
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
							Solicitud.gridDataSource.read();
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
