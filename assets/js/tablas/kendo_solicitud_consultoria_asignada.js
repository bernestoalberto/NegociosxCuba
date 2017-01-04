/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Consulting_Asignada={};
var message=""


//Creando los windows Dialogs
wnd_consultoria_asignad_t = $("#solicitud_procesada_consulting_window").kendoWindow({
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
		if(Consulting_Asignada.oldElement!=null) {

			if(Consulting_Asignada.oldElement.foto_perfil!=null){
				document.getElementById('foto_perfil_procesada').src = ".."+path_profile+Consulting_Asignada.oldElement.foto_perfil ;
			}
			else{
				document.getElementById('foto_perfil_procesada').src = ".."+path_img+thumb;
			}
			$('#asunto_procesado').val(Consulting_Asignada.oldElement.asunto);
			$('#fecha_sol_consulting').data("kendoDatePicker").value(Consulting_Asignada.oldElement.fecha);
			$('#fecha_asignacion').data("kendoDatePicker").value(Consulting_Asignada.oldElement.fecha_asignacion);
			$('#descripcion_consulting').val(Consulting_Asignada.oldElement.descripcion);
			$('#descripcion_consulting_asing').val(Consulting_Asignada.oldElement.descripcion_denial_acceptance);
			$('#nombre_emprendedor').val(Consulting_Asignada.oldElement.nombre_usuario);
			$('#tipo_consultoria_asingada').data("kendoDropDownList").value(Consulting_Asignada.oldElement.tipo_consultoria);
			$('#id_consultor_procesado').data("kendoDropDownList").value(Consulting_Asignada.oldElement.id_consultor);

		}

		else
		{
			$('#fecha_sol_consulting').data("kendoDatePicker").value('');
			$('#fecha_asignacion').data("kendoDatePicker").value('');
			$('#tipo_consultoria_asingada').data("kendoDropDownList").value('');
			$('#id_consultor_procesado').data("kendoDropDownList").value('');

		}
	}}).data("kendoWindow");



//Definir controladora
Consulting_Asignada.oldElement=null;

Consulting_Asignada.change = function onChange(arg) {
};
Consulting_Asignada.dataBind = function onDataBinding(arg) {
};
Consulting_Asignada.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Consulting_Asignada.kgrid=this;
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



var type_consultingtasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url: "?option=com_tipo_consultoria&task=tipo_json_list",
			dataType: "json"
		}
	}
});


$("#tipo_consultoria_asingada").kendoDropDownList ({
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



$("#fecha_sol_consulting").kendoDatePicker({
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

$("#fecha_asignacion").kendoDatePicker({
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

$("#id_consultor_procesado").kendoDropDownList ({
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
function showUpdate_solicitud_consulting(e) {
//	validator_consulting_asignada.hideMessages();
	$('#taskprocesadas_consulting').val('update');
	$('#solicitud_procesadas_consulting_form')[0].reset();
	var dataItem=Consulting_Asignada.finditem(e.id);
	Consulting_Asignada.oldElement= dataItem;
	wnd_consultoria_asignad_t.title("Datos de la Solicitud de Consultoria");
	wnd_consultoria_asignad_t.center().open();
}


//On load
$(function() {
	validator_consulting_asignada=$("#solicitud_procesadas_consulting_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						//var value = input.val();
						//var i = 0;
						 if($('#taskprocesadas_consulting').val()=='update'){

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
	Consulting_Asignada.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_solicitud_consultoria&task=consultoria_asiganda_json_list",
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
		pageSize: 12
	});
	$("#gridselection_solicitud_consultoria_asiganda").kendoGrid({
		dataSource: Consulting_Asignada.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		groupable:true,
		sortable: true,
		change: Consulting_Asignada.change,
		resizable: true,
		dataBound: Consulting_Asignada.dataBound,
		dataBinding: Consulting_Asignada.dataBinding,
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
				title: "Consultoria",
				template:'<div id="item" data-text="#: consultoria#">#: consultoria#</div>',
				width: '15%',
				type:"string"
			}
		,
			{
				field: "consultor",
				title: "Consultor",
				template:'<div id="item" data-text="#: consultor#">#: consultor#</div>',
				width: '15%',
				type:"string"
			}
		,
			{
				field: "leer",
				title: "Leido",
				width: '10%',
				template:'<div id="item" data-text="#: leer#">#: leer#</div>',
				type:"string"
			}

		,
			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_solicitud_consulting(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='ion-ios-search'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});

});
