/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Solicitud_Procesadas={};
var message="";
var pathimages = "/images/negocio/"
var thumb = "aint.jpg"


//Creando los windows Dialogs
wnd_solicitud_procesadas = $("#solicitud_procesada_window").kendoWindow({
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
		if(Solicitud_Procesadas.oldElement!=null) {

			$('#resenya_negocio').val(Solicitud_Procesadas.oldElement.descripcion);
			$('#asunto').val(Solicitud_Procesadas.oldElement.asunto);
			$('#telefono_fijo').data("kendoNumericTextBox").value(Solicitud_Procesadas.oldElement.telefono);
			$('#nombre_negocio').val(Solicitud_Procesadas.oldElement.nombre);
			$('#direccion_negocio').val(Solicitud_Procesadas.oldElement.direccion);
			$('#correo').val(Solicitud_Procesadas.oldElement.correo);
			$('#categoria').data("kendoDropDownList").value(Solicitud_Procesadas.oldElement.category);
			document.getElementById('foto').src = ".."+pathimages+Solicitud_Procesadas.oldElement.foto ;

			if(Solicitud_Procesadas.oldElement.foto1!=null){
				document.getElementById('foto1').src = ".."+pathimages+Solicitud_Procesadas.oldElement.foto1 ;
			}
			else{
				document.getElementById('foto1').src = ".."+pathimages+thumb;
			}
		if(Solicitud_Procesadas.oldElement.foto1!=null){
			document.getElementById('foto2').src = ".."+pathimages+Solicitud_Procesadas.oldElement.foto2 ;
			}
			else{
			document.getElementById('foto2').src = ".."+pathimages+thumb;
			}



		}

		else
		{
			$('#categoria').data("kendoDropDownList").value('');
			$('#telefono').data("kendoNumericTextBox").value('');

		}
	}}).data("kendoWindow");



//Definir controladora
Solicitud_Procesadas.oldElement=null;

/*Data Source  Tipo_proyecto*/


Solicitud_Procesadas.change = function onChange(arg) {
};
Solicitud_Procesadas.dataBind = function onDataBinding(arg) {
};
Solicitud_Procesadas.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Solicitud_Procesadas.kgrid=this;
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




//Mostrar Ventanas
function showUpdate_solicitud(e) {
	validator_solicitud_procesada.hideMessages();
	$('#solicitud_procesadas_form')[0].reset();
	var dataItem=Solicitud_Procesadas.finditem(e.id);
	Solicitud_Procesadas.oldElement= dataItem;
	$('#taskprocesadas').val('update');
	wnd_solicitud_procesadas.title("Datos de la Solicitud de Incripción del Negocio");
	wnd_solicitud_procesadas.center().open();
}
//On load
$(function() {

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
		max:9999999,
		format: "537-000-00",
		min:1111111
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


	validator_solicitud_procesada=$("#solicitud_procesadas_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();
						var i = 0;
						if (Solicitud_Procesadas.oldElement == null) {



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
	Solicitud_Procesadas.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_solicitud&task=solicitud_procesadas_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
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
					foto2:{type:"string"},
					nombre_usuario:{type:"string"}
				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_solicitud_negocio_procesadas").kendoGrid({
		dataSource: Solicitud_Procesadas.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		groupable:true,
		sortable: true,
		change: Solicitud_Procesadas.change,
		resizable: true,
		dataBound: Solicitud_Procesadas.dataBound,
		dataBinding: Solicitud_Procesadas.dataBinding,
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
				field: "nombre_usuario",
				template:'<div id="item" data-text="#: nombre_usuario#">#: nombre_usuario#</div>',
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
				type:"date"
			}
			,
			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_solicitud(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='ion-ios-search'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '10%'
			}
		]
	});


});
