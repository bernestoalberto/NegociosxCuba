/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator_publicidad_atendida;
var Publicidad_Atendida={};

var message=""



//Definir controladora
Publicidad_Atendida.oldElement=null;

Publicidad_Atendida.change = function onChange(arg) {
};
Publicidad_Atendida.dataBind = function onDataBinding(arg) {
};
Publicidad_Atendida.dataBound=function onDataBound(arg) {
	//var dataarray=this._data;
//	var i=0;
	$('#all_check').prop('checked',false);
	Publicidad_Atendida.kgrid=this;
}
Publicidad_Atendida.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Publicidad_Atendida.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}

function ver_element_publicidad_atendida(e) {
	$('#publicidad_form')[0].reset();
	var dataItem=Publicidad_Atendida.finditem(e.id);
	Publicidad_Atendida.oldElement= dataItem;
	$('#taskpublicidad').val('update');
	wnd_publicidad_atendida.title("Ver Publicidad_Atendida");
	wnd_publicidad_atendida.center().open();
}
/*
function asiganr_element_publicidad(e) {
	Publicidad_Atendida.oldElement=null;
	validator_publicidad_atendida.hideMessages();
	$('#publicidad_asiganda_form')[0].reset();
	var dataItem=Publicidad_Atendida.finditem(e.id);
	Publicidad_Atendida.oldElement= dataItem;
	$('#taskpublicidadasignada').val('update');
	wnd_publicidad_asiganada.title("Asiganr Publicidad_Atendida");
	wnd_publicidad_asiganada.center().open();
}
*/

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
	$("#id_persona").kendoDropDownList ({
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
	$("#id_user").kendoDropDownList ({
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
//Creando los windows Dialogs
	wnd_publicidad_atendida = $("#publicidad_window").kendoWindow({
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
			if(Publicidad_Atendida.oldElement!=null) {
				 $('#asunto').val(Publicidad_Atendida.oldElement.asunto);

				 $('#fecha').data("kendoDatePicker").value(Publicidad_Atendida.oldElement.fecha);
				 $('#descripcion').val(Publicidad_Atendida.oldElement.descripcion);
				$('#id_user').data("kendoDropDownList").value(Publicidad_Atendida.oldElement.id_user);
			}

			else
			{
				$('#fecha').data("kendoDatePicker").value('');
				$('#id_persona').data("kendoDropDownList").value('');

			}
		}}).data("kendoWindow");

/*	wnd_publicidad_asiganada = $("#asignar_publicidad_window").kendoWindow({
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
			if(Publicidad_Atendida.oldElement!=null) {
				 $('#asunto').val(Publicidad_Atendida.oldElement.asunto);

				 $('#fecha').data("kendoDatePicker").value(Publicidad_Atendida.oldElement.fecha);
				 $('#descripcion').val(Publicidad_Atendida.oldElement.descripcion);
				$('#id_user').data("kendoDropDownList").value(Publicidad_Atendida.oldElement.id_user);
			}

			else
			{
				$('#fecha').data("kendoDatePicker").value('');
				$('#id_user').data("kendoDropDownList").value('');

			}
		}}).data("kendoWindow");*/

	validator_publicidad_atendida=$("#publicidad_asiganda_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;



						if (Publicidad_Atendida.oldElement == null) {
					/*		if (input.is("[id=estado1]")) {
								if ($('#estado1').prop("checked")) {
									$('#descripcion_asig_publicidad').val('');
									$("#descripcion_asig_publicidad").prop( "disabled", true );



								}
							}*/
							if (input.is("[id=estado2]")) {
								if ($('#estado2').prop("checked")) {
									$('#descripcion_asig_publicidad').val('');
									$("#descripcion_asig_publicidad").prop( "disabled", true );

								}
							}
							if (input.is("[id=estado3]")) {
								if ($('#estado3').prop("checked")) {
									$("#descripcion_asig_publicidad").prop( "disabled", false );

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


	Publicidad_Atendida.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_publicidad&task=publicidad_atendida_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
		},
		schema:{
			model:{
				fields:{
					id_user:{type:"number"},
					usuario:{type:"string"},
					asunto:{type:"string"},
					subject:{type:"string"},
					id_persona:{type:"number"},
					persona:{type:"string"},
					leido:{type:"number"},
					leer:{type:"string"},
					descripcion:{type:"string"},
					estado:{type:"number"},
					state:{type:"string"},
					fecha:{type:"date"}

				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_publicidad_atendida").kendoGrid({
		dataSource: Publicidad_Atendida.gridDataSource,
		height: 550,
		width: 900,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_publicidad").html()),
		detailInit:detailInit,
		groupable:true,
		sortable: true,
		change: Publicidad_Atendida.change,
		resizable: true,
		dataBound: Publicidad_Atendida.dataBound,
		dataBinding: Publicidad_Atendida.dataBinding,
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
				headerTemplate: "<input class='' id='all_check_publicidad' type='checkbox'/>",
				template: "<input class='check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,

			{
				field: "usuario",
				title: "Usuario",
				template:'<div id="item" data-text="#: usuario#">#: usuario#</div>',
				width: '8%',
				type:"string"
			},
			{
				field: "persona",
				template:'<div id="item" data-text="#: persona#">#: persona#</div>',
				title: "Asignado",
				width: '10%',
				type:"string",
				hidden:true
			}
			,

			{
				field: "asunto",
				template:'<div id="item" data-text="#: asunto#">#: asunto#</div>',
				title: "Asunto",
				width: '8%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "fecha",
				format:"{0:dd-MM-yyyy}"	,
				title: "Fecha",
				title: "Fecha",
				width: '8%',
				type:"date"
			}
			,

			{
				field: "state",
				template:'<div id="item" data-text="#: state#">#: state#</div>',
				title: "Estado",
				width: '10%',
				type:"string"
			}
			,


			{
				field: "leer",
				title: "Leido",
				template:'<div id="item" data-text="#: leer#">#: leer#</div>',
				width: '10%',
				type:"string"
			}
			,

			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='ver_element_publicidad_atendida(this)' data-toggle='tooltip' data-original-title='Ver|Ver elemento'><i class='ion-ios-search'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});
	function detailInit(e) {
		var detailRow = e.detailRow;

		var datos = [{asunto:e.data.asunto,descripcion:e.data.descripcion,persona:e.data.persona}];

		detailRow.find(".tabstrip").kendoTabStrip({
			animation: {
				open: { effects: "fadeIn" }
			}
		});

		detailRow.find(".orders").kendoGrid({
			dataSource:datos,
			scrollable: false,
			sortable: true,
			pageable: true,
			columns: [
				{ field: "asunto"	, title:"Asunto", width: "80px" },
				{ field: "persona", title:"Asisgnado a" , width: "100px"},
				{ field: "descripcion",title:"Descripción" }


			]
		});

	}
	/*Acciones de los botones*/

	$('#all_check_publicidad').click(function () {
		var c = this.checked;
		$('#gridselection_publicidad :checkbox').prop('checked',c);
	});
	$('#aceptar').click(function()
	{
		if (validator_publicidad_atendida.validate())
		{
			var stato = $("#stato").val('1');
			var fd = new FormData(document.querySelector("#publicidad_asiganda_form"));
			var  url="?option=com_publicidad&task=publicidad_update";
				var olditem=JSON.stringify(Publicidad_Atendida.oldElement);
				fd.append('olditem',olditem);


			$.ajax({
				type: "POST",
				url:url,
				data:fd,
				stato:stato,
				cache: false,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success==true)
					{
						var message='El elemento fue insertado con exito'
						if($('#taskpublicidadasignada').val()=='update')
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
					Publicidad_Atendida.gridDataSource.read();
					$('#publicidad_asiganda_form')[0].reset();
					wnd_publicidad_asiganada.close();
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
$('#rechazar').click(function()
	{
		if (validator_publicidad_atendida.validate())
		{
            var stato = $("#stato").val('2');
			var fd = new FormData(document.querySelector("#publicidad_asiganda_form"));
			var  url="?option=com_publicidad&task=publicidad_update";
				var olditem=JSON.stringify(Publicidad_Atendida.oldElement);
				fd.append('olditem',olditem);


			$.ajax({
				type: "POST",
				url:url,
				data:fd,
				stato:stato,
				cache: false,
				processData: false,
				contentType: false,
				success:function(response){
					if(response.success==true)
					{
						var message='El elemento fue insertado con exito'
						if($('#taskpublicidadasignada').val()=='update')
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
					Publicidad_Atendida.gridDataSource.read();
					$('#publicidad_asiganda_form')[0].reset();
					wnd_publicidad_asiganada.close();
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


	$('#addbutton_publicidad').click(function(){
		asignar_publicidad();
	});

});
