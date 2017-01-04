/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Consultoria={};
var Consulting_Asignada={};
var message="";
var path_profile = "/images/perfil/";
var path_img = "/images/negocio/";
var thumb = "aint.jpg";

//Definir controladora
Consultoria.oldElement=null;

Consultoria.change = function onChange(arg) {
};
Consultoria.dataBind = function onDataBinding(arg) {
};
Consultoria.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Consultoria.kgrid=this;
}
Consultoria.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Consultoria.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}

Consulting_Asignada.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Consulting_Asignada.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}
Consulting_Asignada.gridDataSource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_solicitud_consultoria&task=consultoria_asiganda_json_list",
			dataType: "json"
		}
	},
	change: function(e){
		console.clear();
	},

	schema:{
		model:{
			fields:{
				id_consultoria:{type:"number"},
				asunto:{type:"string"},
				fecha:{type:"date"},
				fecha_asignacion:{type:"date"},
				tipo_consultoria:{type:"number"},
				consultoria:{type:"string"},
				leido:{type:"number"},
				leer:{type:"string"},
				estado:{type:"number"},
				descripcion:{type:"string"},
				id_consultor:{type:"number"},
				consultor:{type:"string"},
				foto_perfil:{type:"string"},
				id_usuario:{type:"string"},
				nombre_usuario:{type:"string"},
				descripcion_denial_acceptance:{type:"string"}

			}
		}
	},
});
Consulting_Asignada.change = function onChange(arg) {
	$.map(this.select(), function(item) {
		return $(item).text();
	});

}


var type_consultingtasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_tipo_consultoria&task=tipo_json_list",
			dataType: "json"
		}
	}
});
$("#tipo_consultoria").kendoDropDownList ({
	dataTextField: "consultoria",
	dataValueField: "id_tipo_consultoria",
	dataSource: type_consultingtasource,
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
})

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

var consultortasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_persona&task=consultor_json_list",
			dataType: "json"
		}
	}
});
$("#id_consultor_asig").kendoDropDownList ({
	dataTextField: "username",
	dataValueField: "id",
	dataSource: consultortasource,
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




//Mostrar Ventanas
function showSolicitud_consult(e) {
	//validator_consulting_wth.hideMessages();
	$('#solicitud_consulting_wth_form')[0].reset();
	var dataItem=Consultoria.finditem(e.id);
	Consultoria.oldElement= dataItem;
	$('#taskconsultoria_wth').val('update');
	wnd_consulting_wth.title(" Solicitud  de Consultoria a Asignar");
	//$('#accionbtn_consultoriasave_exit').text('Actualizar');

	wnd_consulting_wth.center().open();
}
function showDenial_consult() {
	//validator_denial_consulting.hideMessages();
	$('#denial_form')[0].reset();
 //   var dataItem=Consultoria.finditem(Consultoria.oldElement.id_consultoria);
	//Consultoria.oldElement= dataItem;
	$('#taskdenial').val('update');
	wnd_consulting_dn.title(" Confirmación de la Denegación de la Consultoría");
	wnd_consulting_dn.center().open();
}


//On load
$(function() {
	validator_consulting_wth=$("#solicitud_consulting_wth_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var size = value.length;

						if($('#taskconsultoria').val()=='update'){

							if (input.is("[id=descripcion_write]")) {



								if(size > 250){
									found=true;
									message="La comentario ingresada no debe exceder los 250 caracteres";
									return $('#descripcion_write').val('');
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

	validator_denial_consulting=$("#denial_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var size = value.length;

						if($('#taskconsultoria').val()=='update'){

							if (input.is("[id=descripcion_denial_acceptance]")) {



								if(size > 250){
									found=true;
									message="La comentario ingresada no debe exceder los 250 caracteres";
									return $('#descripcion_denial_acceptance').val('');
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

//Creando los windows Dialogs
	wnd_consulting_wth = $("#consulting_sin_procesar_window").kendoWindow({
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
			if(Consultoria.oldElement!=null) {

				$('#descripcion_read').val(Consultoria.oldElement.descripcion);
				$('#nombre').val(Consultoria.oldElement.nombre_usuario);
				$('#fecha').data("kendoDatePicker").value(Consultoria.oldElement.fecha);
				$('#asunto_consulting').val(Consultoria.oldElement.asunto);
				$('#tipo_consultoria').data("kendoDropDownList").value(Consultoria.oldElement.tipo_consultoria);
				$('#id_consultor_asig').data("kendoDropDownList").value(Consultoria.oldElement.id_consultor);
				if(Consultoria.oldElement.foto_perfil!=null){
					document.getElementById('foto_perfil_consulting').src = ".."+path_profile+Consultoria.oldElement.foto_perfil ;
				}
				else{
					document.getElementById('foto_perfil_consulting').src = ".."+path_img+thumb;
				}

			}

			else
			{
				$('#fecha').data("kendoDatePicker").value('');
				$('#tipo_consultoria').data("kendoDropDownList").value('');
				$('#id_consultor_asig').data("kendoDropDownList").value('');

			}
		}}).data("kendoWindow");

	wnd_consulting_dn = $("#consultoria_denegada_window").kendoWindow({
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
			if(Consultoria.oldElement!=null) {

				$('#asunto_consultoria_denial').val(Consultoria.oldElement.asunto);


			}

			else
			{

			}
		}}).data("kendoWindow");


	Consultoria.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_solicitud_consultoria&task=consultoria_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
		},
		schema:{
			model:{
				fields:{
					id_consultoria:{type:"number"},
					asunto:{type:"string"},
					fecha:{type:"date"},
					tipo_consultoria:{type:"number"},
					consultoria:{type:"string"},
					leido:{type:"number"},
					leer:{type:"string"},
					estado:{type:"number"},
					descripcion:{type:"string"},
					id_consultor:{type:"number"},
					consultor:{type:"string"},
					foto_perfil:{type:"string"},
					id_usuario:{type:"string"},
					nombre_usuario:{type:"string"}


				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_solicitud_consultoria").kendoGrid({
		dataSource: Consultoria.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		groupable:true,
		sortable: true,
		change: Consultoria.change,
		resizable: true,
		dataBound: Consultoria.dataBound,
		dataBinding: Consultoria.dataBinding,
		pageable: {
			buttonCount: 5,
			refresh: true,
			pageSizes: [2,10,20,30,50,100]
		},
		columns: [


			{
				field: "asunto",
				template:'<div id="item" data-text="#: asunto#">#: asunto#</div>',
				title: "Asunto",
				width: '10%',
				type:"string"
			}
			,

			{
				field: "fecha",
				title: "Fecha",
				width: '10%',
				format:"{0:dd-MM-yyyy}"	,
				type:"date"
			}
			,
			{
				field: "consultoria",
				title: "Tipo Consultoria",
				template:'<div id="item" data-text="#: consultoria#">#: consultoria#</div>',
				width: '15%',
				type:"string"
			}
		,

			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showSolicitud_consult(this)' data-toggle='tooltip' data-original-title='Mostrar|Mostrar elemento'><i class='ion-ios-search'></i></div>",
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});

	/*Acciones de los botones*/

	$('#aceptar_consultoria').click(function()
	{
		if (validator_consulting_wth.validate())
		{

			var fd = new FormData(document.querySelector("#solicitud_consulting_wth_form"));

			var  url="?option=com_solicitud_consultoria&task=consulting_aceptar";
				var olditem=JSON.stringify(Consultoria.oldElement);
				fd.append('olditem',olditem);

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
					Consultoria.gridDataSource.read();
					Consulting_Asignada.gridDataSource.read();
					$('#solicitud_consulting_wth_form')[0].reset();
					wnd_consulting_wth.close();
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
	$('#accionbtn_denegar').click(function()
	{
		if (validator_denial_consulting.validate())
		{

			var fd = new FormData(document.querySelector("#denial_form"));
			var url="?option=com_solicitud_consultoria&task=consulting_denegar";
			var olditem=JSON.stringify(Consultoria.oldElement);
			fd.append('olditem',olditem);
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
					//falta cerrar un formulario

					Consultoria.gridDataSource.read();
					Consulting_Asignada.gridDataSource.read();
					$('#solicitud_consulting_wth_form')[0].reset();
					$('#denial_form')[0].reset();
					wnd_consulting_wth.close();
					wnd_consulting_dn.close();
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

	$('#cancel_consultoria_s').click(function(){
		$('#denial_form')[0].reset();
		Consultoria.gridDataSource.read();
		wnd_consulting_dn.close();
	});

	$('#denegar_consultoria_s').click(function(){

		showDenial_consult();
	});

});
