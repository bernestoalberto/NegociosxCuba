/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales

var validator;
var Solicitud_Negocio={};
var Solicitud={};
var Solicitud_Procesadas={};
var message=""
var arrayAceptedBussines=[];
var arrayRejectedBussines=[];
var arraySelectedBussines=[];
var arrayUnselectedBussines=[];
var path_negocio = "../images/negocio/";

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
Solicitud.gridDataSource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_solicitud&task=solicitud_json_list",
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
Solicitud.change = function onChange(arg) {
	$.map(this.select(), function(item) {
		return $(item).text();
	});

}

Solicitud_Procesadas.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Solicitud_Procesadas.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}
Solicitud_Procesadas.gridDataSource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_solicitud&task=solicitud_procesadas_json_list",
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
				category:{type:"number"},
				categoria:{type:"string"},
				nombre:{type:"string"},
				direccion:{type:"string"},
				correo:{type:"string"},
				telefono:{type:"number"},
				foto:{type:"string"},
				foto1:{type:"string"},
				foto2:{type:"string"}

			}
		}
	},
});
Solicitud_Procesadas.change = function onChange(arg) {
	$.map(this.select(), function(item) {
		return $(item).text();
	});

}
//Definir controladora
Solicitud_Negocio.oldElement=null;

Solicitud_Negocio.change = function onChange(arg) {
	arraySelectedBussines =[];
	arrayUnselectedBussines=[];
	var selected = $.map(this.select(), function(item) {
		return $(item).text();
	});
	var i;
	var j=0;
	var found = false;
	var longseleccionado = selected.length;
	var longdatabuscar = this._data.length;
	var current = null;
	if(longseleccionado >0){
	for(i=0;i <= longdatabuscar-1;i++){
		found = false;
    current = this._data[i].nombre_negocio ;
	while (j <= longseleccionado && found==false){
		if(selected[j] == current){
			this._data[i].index  = i;
			arraySelectedBussines.push(this._data[i]);
			kendoConsole.clear();
			kendoConsole.log("---------------------------------");
			kendoConsole.log("Seleccionado: " + longseleccionado+ " elemento(s)");
			kendoConsole.log("---------------------------------");
			kendoConsole.log("Categoria: " + this._data[i].category);
			kendoConsole.log("Direccion: " + this._data[i].direccion_negocio);
			kendoConsole.log("Telefono: " + this._data[i].telefono_fijo);
			kendoConsole.log("Correo: " + this._data[i].correo);
			kendoConsole.log("Fecha: " + this._data[i].fecha);
			kendoConsole.log("Descripción: " + this._data[i].resenya_negocio);
			kendoConsole.log("Negocio:" + this._data[i].asunto);
			document.getElementById("panel_pic").hidden=false;
			document.getElementById("img_negocio_detail").src=path_negocio+this._data[i].foto;

          found = true;
		}
		else if(longseleccionado == j){
				arrayUnselectedBussines.push(this._data[i]);
		}

		j++;
	    }
		j=0;
	}
	}
};
Solicitud_Negocio.databind = function onDataBinding(arg) {

};
Solicitud_Negocio.dataBound=function onDataBound(arg) {

}
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


function showCuestionario() {
	$('#taskconfirm').val('insert');
	wnd_confirm_solicitud.title('Enviar Negocios aceptados y rechazados al emprendedor');
	wnd_confirm_solicitud.center().open();
}
window.kendoConsole = {
	log: function(message, isError, container) {
		var lastContainer = $(".console div:first", container),
				counter = lastContainer.find(".count").detach(),
				lastMessage = lastContainer.text(),
				count = 1 * (counter.text() || 1);

		lastContainer.append(counter);

		if (!lastContainer.length || message !== lastMessage) {
			$("<div" + (isError ? " class='error'" : "") + "/>")
					.css({
						marginTop: -24,
						backgroundColor: isError ? "#ffbbbb" : "#b2ebf2"
					})
					.html(message)
					.prependTo($(".console", container))
					.animate({ marginTop: 0 }, 300)
					.animate({ backgroundColor: isError ? "#ffdddd" : "#ffffff" }, 800);
		}
		else
		{
			count++;

			if (counter.length) {
				counter.html(count);
			} else {
				lastContainer.html(lastMessage)
						.append("<span class='count'>" + count + "</span>");
			}
		}
	},

	error: function(message) {
		this.log(message, true);
	},
	clear: function () {
		document.getElementById('consolita').empty();
	}
};
//On load
$(function() {
	wnd_confirm_solicitud = $("#solicitud_confirmacion_window").kendoWindow({
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

				var k;
				var elementos;
				for(k=0;k<arrayRejectedBussines.length;k++){
					if(k==0){
						elementos = arrayRejectedBussines[k].nombre_negocio + "  ";
					}
					else{
						elementos += arrayRejectedBussines[k].nombre_negocio + "  ";
					}
				}
			    if(elementos== null){
					$("#asunto_solicitudes_rechazada").val('No tiene solicitudes a rechazar');
				}
			else{
					$("#asunto_solicitudes_rechazada").val(elementos);
				}

                    if(arrayRejectedBussines.length==0){
						$("#descripcion_solicitudes_rechazada").val("No necesita descripción");
						$("#descripcion_solicitudes_rechazada").readonly;
					}




		}}).data("kendoWindow");
//Creando los windows Dialogs
	wnd_negocio_solicitud = $("#solicitud_sin_procesar_window").kendoWindow({
		modal: true,
		visible: false,
		resizable: true,
		width: '85%',
		heigth:600,
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
			if(Solicitud_Negocio.oldElement!=null) {
				$('#nombre_negocio').val(Solicitud_Negocio.oldElement.nombre_negocio);
				$('#id_usuario').data("kendoDropDownList").value(Solicitud_Negocio.oldElement.id);
				$('#categoria').data("kendoDropDownList").value(Solicitud_Negocio.oldElement.category);
				$('#direccion_negocio').val(Solicitud_Negocio.oldElement.direccion_negocio);
				$('#resenya_negocio').val(Solicitud_Negocio.oldElement.resenya_negocio);
				$('#telefono_fijo').val(Solicitud_Negocio.oldElement.telefono_fijo);
				$('#otro_telefono').val(Solicitud_Negocio.oldElement.otro_telefono);
				$('#id_negocio').val(Solicitud_Negocio.oldElement.id_negocio);
				$('#correo').val(Solicitud_Negocio.oldElement.correo);
				$('#url').val(Solicitud_Negocio.oldElement.url);
				$('#foto').val(Solicitud_Negocio.oldElement.foto);
				$('#foto1').val(Solicitud_Negocio.oldElement.foto1);
				$('#foto2').val(Solicitud_Negocio.oldElement.foto2);
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
						if($('#tasknegocio').val()=='update'){


							if (input.is("[id=descripcion_consultoria]")) {



								if (size > 250  ) {
									found = true;
									message = "La reseña del negocio es mas largo de lo permitido";
									return $('#resenya_negocio').val('');
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
	validator_procesar_solicitud=$("#confirm_solicitud_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var size = value.length;
						if(Solicitud_Negocio.oldElement !=null){

							if (input.is("[id=descripcion_solicitudes_rechazada]")) {



								if (size > 250  ) {
									found = true;
									message = "La descripcion_solicitudes_rechazada del negocio es mas largo de lo permitido";
									return $('#descripcion_solicitudes_rechazada').val('');
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


	Solicitud_Negocio.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_solicitud&task=negocios_by_user_solicitud_json_list",
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
					category:{type:"string"},
					categoria:{type:"number"},
					nombre:{type:"string"},
					direccion:{type:"string"},
					correo:{type:"string"},
					telefono:{type:"number"},
					foto:{type:"string"},
					foto1:{type:"string"},
					foto2:{type:"string"}

				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_negocio_list").kendoGrid({
		dataSource: Solicitud_Negocio.gridDataSource,
		height: 250,
		width: 700,
		selectable: "multiple cell",
		groupable:false,
		filterable: {
			mode: "row"
		},
		sortable: true,
		change: Solicitud_Negocio.change,
		resizable: true,
		dataBound: Solicitud_Negocio.dataBound,
		dataBinding: Solicitud_Negocio.databind,
		pageable: {
			buttonCount: 5,
			refresh: true,
			pageSizes: [2,10,20,30,50,100]
		},
		columns: [


			{
				field: "asunto",
				template:'<div id="item" data-text="#: asunto#">#: asunto#</div>',
				title: "Negocio",
				width: '8%',
				type:"string"
			}

		]
	});
	/*Acciones de los botones*/

	$('#accionbtn_aceptar_bussines_save_exit').click(function()
	{

			if( arraySelectedBussines.length==0) {
				$.smallBox({
					title: "<span class='fa fa-trash-o'></span>     Aceptar Solicitud_Negocio ",
					content: "<p>Debe seleccionar al menos un elemento para añadirlo</p>",
					color: "#F2092A",
					timeout: 1000,
					top: 10
				})
			}
			else {
				kendoConsole.clear();
				arrayAceptedBussines = arraySelectedBussines;


				arrayRejectedBussines = arrayUnselectedBussines;


				var t;
				for (t = 0; t < arrayAceptedBussines.length; t++) {
					Solicitud_Negocio.gridDataSource._data.splice(arrayAceptedBussines[t].index, 1);
				}

			}


		arraySelectedBussines = [];
		arrayUnselectedBussines = [];
	});
	$('#accionbtn_finalizar_save_exit').click(function()
	{

			if( arrayAceptedBussines.length>0) {
				wnd_negocio_solicitud.close();
				showCuestionario();
			}
			else{

				$.smallBox({
					title: "<span class='fa fa-trash-o'></span>     Aceptar Solicitud_Negocio ",
					content: "<p>Debe añadir al menos un elemento</p>",
					color: "#F2092A",
					timeout: 1000,
					top:10
				})
			}

	});

	$('#accionbtn_procesar_solicitud').click(function()
	{
		if (validator_procesar_solicitud.validate())
		{
			//var formdata =  new FormData(document.querySelector("#confirm_solicitud_form"));
			var asunto = document.querySelector("#confirm_solicitud_form")[0].value;
			var descripcion = document.querySelector("#confirm_solicitud_form")[1].value;

		    var	fd = {
				asunto: asunto,
				descripcion:descripcion,
			    user :	Solicitud.oldElement,
				acepted:arrayAceptedBussines,
				canceled:arrayRejectedBussines

		};
			 fd =JSON.stringify(fd);
			var  url="?option=com_solicitud&task=procesar_solicitud";
			$.ajax({
				type: "GET",
				data:{
					fd:fd,
				},
				url:url,
				/*cache: false,
				processData: false,
				contentType: false,*/
				success:function(response){
					if(response.success==true)
					{
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
					$('#confirm_solicitud_form')[0].reset();
					$('#solicitud_form')[0].reset();
					wnd_confirm_solicitud.close();
					wnd_negocio_solicitud.close();
					Solicitud.gridDataSource.read();
					Solicitud_Procesadas.gridDataSource.read();
				}
			});
		}
		else
		{
			$.smallBox({
				title: "Error",
				content:"<p class='fg-white'>Por favor llene todos los campos</p>" ,
				color: "9162E",
				timeout: 4000
			});
		}
	});

	$('#accionbtn_solicitud_confirmacioncancel').click(function(){

			$('#confirm_form')[0].reset();
			Solicitud.gridDataSource.read();
			wnd_confirm_solicitud.close();
			wnd_negocio_solicitud.close();



	});

	$('#accionbtn_cancelar_pro_solicitud').click(function(){

		wnd_confirm_solicitud.close();
	});
	$('#cancel_bussines_btn').click(function(){
		if( arrayAceptedBussines.length>0) {
			$("#gridselection_negocio_list").data("kendoGrid").clearSelection();
			var t;
			var r;
			for (t = 0; t < arrayAceptedBussines.length; t++) {
				Solicitud_Negocio.gridDataSource._data.splice(0, t, arrayAceptedBussines[t]);
			}
			for (r = 0; r < arrayRejectedBussines.length; r++) {
				Solicitud_Negocio.gridDataSource._data.splice(0, t, arrayRejectedBussines[r]);
				t++;
			}


			Solicitud_Negocio.gridDataSource.read();
			kendoConsole.clear();
			arrayAceptedBussines = [];
			arrayRejectedBussines = [];
		}
		else{

			$.smallBox({
				title: "<span class='fa fa-trash-o'></span>     Cancelar Solicitud de Negocio ",
				content: "<p>Debe seleccionar al menos un elemento</p>",
				color: "#F2092A",
				timeout: 1000,
				top:10
			})
		}
	});

});
