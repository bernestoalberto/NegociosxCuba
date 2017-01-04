/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Articulo={};

var message="";

//Definir controladora
Articulo.oldElement=null;

//Mostrar Ventanas

//Eliminar elemento
function delete_element_articulo(e)
{
	var dataItem=Articulo.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Articulo?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_articulo&task=articulo_delete",
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
					Articulo.gridDataSource.read();
				}
				//error:problemas
			});
		}
		else
			close();
	})
}
Articulo.change = function onChange(arg) {
};
Articulo.change = function onDataBinding(arg) {
};
Articulo.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Articulo.kgrid=this;
}
Articulo.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Articulo.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}



function showUpdate_articulo(e) {
	validator_articulo.hideMessages();
	$('#articulo_form')[0].reset();
	var dataItem=Articulo.finditem(e.id);
	Articulo.oldElement= dataItem;
	$('#taskarticulo').val('update');
	wnd_articulo.title("Actualizar Artículo");
	$('#accionbtn_articulosave_exit').text('Actualizar');
	$('#accionbtn_articulosave_new').hide();
	wnd_articulo.center().open();
}
//On load
$(function() {
	//Creando los windows Dialogs
	wnd_articulo = $("#articulo_window").kendoWindow({
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
			if(Articulo.oldElement!=null) {
				$('#fotografo').val(Articulo.oldElement.fotografo);
				$('#ley_asociada').data("kendoDropDownList").value(Articulo.oldElement.ley_asociada);
				$('#state').data("kendoDropDownList").value(Articulo.oldElement.state);
				$('#acceso').data("kendoDropDownList").value(Articulo.oldElement.acceso);
				$('#id_categoria').data("kendoDropDownList").value(Articulo.oldElement.categoria);
				$('#fotografo').data("kendoDropDownList").value(Articulo.oldElement.fotografo);
				$('#autor').data("kendoDropDownList").value(Articulo.oldElement.autor);
				$('#inicio_publicacion').data("kendoDatePicker").value(Articulo.oldElement.inicio_publicacion);
				$('#fin_publicacion').data("kendoDatePicker").value(Articulo.oldElement.fin_publicacion);
				$('#titulo_articulo').val(Articulo.oldElement.titulo);
				$('#epigrafe').val(Articulo.oldElement.epigrafe);
				$('#palabras_claves').val(Articulo.oldElement.palabras_claves);
				$('#anuncio').val(Articulo.oldElement.anuncio);
				$('#bajante').val(Articulo.oldElement.bajante);

				if (Articulo.oldElement.pagina_principal=="si") {

				$("#pagina_principal").prop('checked', true);


				}
				else{
					$("#pagina_principal").prop('checked', false);
				}
			}

			else
			{
				$('#ley_asociada').data("kendoDropDownList").value('');
				$('#fotografo').data("kendoDropDownList").value('');
				$('#autor').data("kendoDropDownList").value('');
				$('#state').data("kendoDropDownList").value('');
				$('#acceso').data("kendoDropDownList").value('');
				$('#id_categoria').data("kendoDropDownList").value('');
				$('#inicio_publicacion').data("kendoDatePicker").value('');
				$('#fin_publicacion').data("kendoDatePicker").value('');

			}
		}}).data("kendoWindow");
	$("#inicio_publicacion").kendoDatePicker({
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
	/*Date Picker  duracionInicio*/
	$("#fin_publicacion").kendoDatePicker({
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
	var accesodatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_persona&task=rol_json_list",
				dataType: "json"
			}
		}
	});
	/*ComboBox  Clasificacion*/
	$("#acceso").kendoDropDownList({
		dataTextField: "title",
		dataValueField: "id",
		dataSource: accesodatasource,
		filter: "contains",
		open: function(e) {
		},
		change:function(e){

		},
		close: function(e){
		},
		suggest: true,
		index: 3
	});

	var negociodatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_negocio&task=categoria_combo_json_list",
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


	var estadodatasource = [
	{"id_estado":1,estado:"publicado"},
	{"id_estado":0,estado:"oculto"},
	{"id_estado":2,estado:"archivado"},
	{"id_estado":-2,estado:"eliminado"}];

	$("#state").kendoDropDownList({
		dataTextField: "estado",
		dataValueField: "id_estado",
		dataSource: estadodatasource,
		filter: "contains",
		open: function(e) {
		},
		change:function(e){

		},
		close: function(e){
		},
		suggest: true,
		index: 3
	});

	var personadatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_negocio&task=usuario_json_list",
				dataType: "json"
			}
		}
	});

	$("#autor").kendoDropDownList ({
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
	$("#fotografo").kendoDropDownList ({
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
	var leydatasource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url: "?option=com_ley&task=ley_combo_json_list",
				dataType: "json"
			}
		}
	});


	$("#ley_asociada").kendoDropDownList ({
		dataTextField: "gaceta",
		dataValueField: "id_ley",
		dataSource: leydatasource,
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
	$("#editor").kendoEditor({
	            tools: [
                "bold",
                "italic",
                "underline",
                "strikethrough",
                "justifyLeft",
                "justifyCenter",
                "justifyRight",
                "justifyFull",
                "insertUnorderedList",
                "insertOrderedList",
                "indent",
                "outdent",
                "createLink",
                "unlink",
                "insertImage",
                "insertFile",
                "subscript",
                "superscript",
                "createTable",
                "addRowAbove",
                "addRowBelow",
                "addColumnLeft",
                "addColumnRight",
                "deleteRow",
                "deleteColumn",
                "viewHtml",
                "formatting",
                "cleanFormatting",
                "fontName",
                "fontSize",
                "foreColor",
                "backColor",
                "print"
            ]
	});

	function showInsert_articulo() {
		Articulo.oldElement=null;
		validator_articulo.hideMessages();
		$('#articulo_form')[0].reset();
		$('#taskarticulo').val('insert');
		$('#accionbtn_articulosave_exit').text('Guardar y Salir');
		wnd_articulo.title("Crear Artículo");
		$('#accionbtnarticulo_save_new').show();
		wnd_articulo.center().open();
	}





	validator_articulo=$("#articulo_form").kendoValidator({
				rules:{
					unique: function(input) {
						var found = false;
						var value = input.val();

						var i =0;

						if (Articulo.oldElement == null) {

							if (input.is("[id=fotografo]")) {


								var size = value.length;
									if (size > 35  ) {
										found = true;
										message = "El fotografo del articulo es mas largo de lo permitido";
										return $('#fotografo').val('');
									}



							}
							if (input.is("[id=titulo_articulo]")) {
								var size = value.length;
								if (size > 50  ) {
									found = true;
									message = "El titulo del articulo es mas largo de lo permitido";
									return $('#titulo_articulo').val('');
								}
								while (i < Articulo.gridDataSource._data.length) {
									var elem = Articulo.gridDataSource._data[i];
									if (elem.titulo == value) {
										found = true;
										message = "El titulo del articulo ingresado ya existe";
										i = Articulo.gridDataSource._data.length;
										alert("El titulo del articulo ingresado ya existe");
										return $('#titulo_articulo').val('');
									}
									i++;
								}



							}
							if (input.is("[id=epigrafe]")) {
								var size = value.length;
								if (size > 100  ) {
									found = true;
									message = "El epigrafe del articulo es mas largo de lo permitido";
									return $('#epigrafe').val('');
								}



							}
							if (input.is("[id=palabras_claves]")) {
								var size = value.length;
								if (size > 100  ) {
									found = true;
									message = "Las palabras_claves del articulo es mas largo de lo permitido";
									return $('#palabras_claves').val('');
								}



							}
							if (input.is("[id=bajante]")) {
								var size = value.length;
								if (size > 250  ) {
									found = true;
									message = "El bajante del articulo es mas largo de lo permitido";
									return $('#bajante').val('');
								}



							}
							if (input.is("[id=anuncio]")) {
								var size = value.length;
								if (size > 250  ) {
									found = true;
									message = "El anuncio del articulo es mas largo de lo permitido";
									return $('#palabras_claves').val('');
								}



							}
							if(input.is("[id=fin_publicacion]")) {
								var	inicio = $("#inicio_publicacion").data('kendoDatePicker').value();
								var	final = $("#fin_publicacion").data('kendoDatePicker').value();
								if(inicio > final && final != null){
									message = "La fecha de fin de publicación debe ser posterior a la fecha inicial";
									return $('#fin_publicacion').data('kendoDatePicker').value('');
								}
							}
							if ($('#pagina_principal').prop("checked")) {

								$('#pagina_principal').val('si');

							}

							else if(!$('#pagina_principal').prop("checked")){
								$('#pagina_principal').val('no');
							}
							return !found;


						}
						else if($('#taskarticulo').val()=='update'){

							if ($('#pagina_principal').prop("checked")) {

								$('#pagina_principal').val('si');
							}

							else if(!$('#pagina_principal').prop("checked")){
								$('#pagina_principal').val('no');
							}
							if(input.is("[id=fin_publicacion]")) {
								var	inicio = $("#inicio_publicacion").data('kendoDatePicker').value();
								var	final = $("#fin_publicacion").data('kendoDatePicker').value();
								if(inicio > final && final != null){
									message = "La fecha de fin de publicación debe ser posterior a la fecha inicial";
									return $('#fin_publicacion').data('kendoDatePicker').value('');
								}
							}
							if (input.is("[id=fotografo]")) {

								var size = value.length;

								if (size > 35  ) {
									found = true;
									message = "El fotografo del articulo es mas largo de lo permitido";
									return $('#fotografo').val('');
								}



							}
							if (input.is("[id=titulo]")) {
								var size = value.length;
								if (size > 50  ) {
									found = true;
									message = "El titulo del articulo es mas largo de lo permitido";
									return $('#titulo').val('');
								}



							}
							if (input.is("[id=epigrafe]")) {
								var size = value.length;
								if (size > 100  ) {
									found = true;
									message = "El epigrafe del articulo es mas largo de lo permitido";
									return $('#epigrafe').val('');
								}



							}
							if (input.is("[id=palabras_claves]")) {
								var size = value.length;
								if (size > 100  ) {
									found = true;
									message = "Las palabras_claves del articulo es mas largo de lo permitido";
									return $('#palabras_claves').val('');
								}



							}
							if (input.is("[id=bajante]")) {
								var size = value.length;
								if (size > 250  ) {
									found = true;
									message = "El bajante del articulo es mas largo de lo permitido";
									return $('#bajante').val('');
								}



							}
							if (input.is("[id=anuncio]")) {
								var size = value.length;
								if (size > 250  ) {
									found = true;
									message = "El anuncio del articulo es mas largo de lo permitido";
									return $('#anuncio').val('');
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
	Articulo.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_articulo&task=articulo_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			//console.clear();
		},
		schema:{
			model:{
				fields:{
					id_articulo:{type:"number"},
					epigrafe:{type:"string"},
					categoria:{type:"number"},
					category:{type:"string"},
					autor:{type:"number"},
					author:{type:"string"},
					titulo:{type:"string"},
					state:{type:"number"},
					estado:{type:"string"},
					ley_asociada:{type:"number"},
					fotografo:{type:"number"},
					fotograph:{type:"string"},
					acceso:{type:"number"},
					access:{type:"string"},
					pagina_principal:{type:"string"},
					palabras_claves:{type:"string"},
					inicio_publicacion:{type:"date"},
					fin_publicacion:{type:"date"},
					numerito:{type:"number"},
					asset_id:{type:"number"}
				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_articulo").kendoGrid({
		dataSource: Articulo.gridDataSource,
		height: 550,
		width: 900,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_articulo").html()),
		detailInit: detailInit,
		groupable:true,
		sortable: true,
		change: Articulo.change,
		resizable: true,
		dataBound: Articulo.dataBound,
		dataBinding: Articulo.dataBinding,
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
				headerTemplate: "<input class='' id='all_check_articulo' type='checkbox'/>",
				template: "<input class='check_row' id='#: uid#' type='checkbox'/>",
				hidden:false
			}
			,

			{
				field: "category",
				title: "Categoria",
				template:'<div id="item" data-text="#: category#">#: category#</div>',
				width: '8%',
				type:"string"
			},

			{
				field: "titulo",
				template:'<div id="item" data-text="#: titulo#">#: titulo#</div>',
				title: "Titulo",
				width: '8%',
				type:"string"
			}
			,

			{
				field: "author",
				template:'<div id="item" data-text="#: author#">#: author#</div>',
				title: "Autor",
				width: '10%',
				type:"string"
			}
			,

			{
				field: "estado",
				title: "Estado",
				template:'<div id="item" data-text="#: estado#">#: estado#</div>',
				width: '8%',
				type:"string"
			}
			,


			{
				field: "access",
				title: "Acceso",
				template:'<div id="item" data-text="#: access#">#: access#</div>',
				width: '8%',
				type:"string"
			}

			,
			{
				field: "inicio_publicacion",
				title: "inicio_publicacion",
				template:'<div id="item" data-text="#: inicio_publicacion#">#: inicio_publicacion#</div>',
				width: '3%',
				type:"date",
				hidden:true
			}

			,
			{
				field: "fin_publicacion",
				title: "fin_publicacion",
				template:'<div id="item" data-text="#: fin_publicacion#">#: fin_publicacion#</div>',
				width: '3%',
				type:"date",
				hidden:true
			}

			,
			{
				field: "pagina_principal",
				title: "pagina_principal",
				template:'<div id="item" data-text="#: pagina_principal#">#: pagina_principal#</div>',
				width: '3%',
				type:"string",
				hidden:true
			}

			,
			{
				field: "fotografo",
				title: "fotografo",
				template:'<div id="item" data-text="#: fotografo#">#: fotografo#</div>',
				width: '3%',
				type:"number",
				hidden:true
			}

			,
			{
				field: "fotograph",
				title: "fotografo",
				template:'<div id="item" data-text="#: fotograph#">#: fotograph#</div>',
				width: '3%',
				type:"string",
				hidden:true
			}

			,
			{
				field: "palabras_claves",
				title: "palabras_claves",
				template:'<div id="item" data-text="#: palabras_claves#">#: palabras_claves#</div>',
				width: '3%',
				type:"string",
				hidden:true
			}

			,




			{
				template: "<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='showUpdate_articulo(this)' data-toggle='tooltip' data-original-title='Modificar|Modificar elemento'><i class='fa fa-edit'></i></div>" +
				"<div class='btn btn-circle btn-icon-circle btn-default' id='#: uid#' onclick='delete_element_articulo(this)' data-toggle='tooltip' data-original-title='Eliminar|Eliminar elemento'><i class='fa fa-trash-o'></i></div>",
				name:'edit',
				headerTemplate: "<p>Acciones</p>",
				width: '8%'
			}
		]
	});
	function detailInit(e) {
		var detailRow = e.detailRow;

		var datos = [{inicio_publicacion:e.data.inicio_publicacion,fin_publicacion:e.data.fin_publicacion,url:e.data.url,palabras_claves:e.data.palabras_claves,
			pagina_principal:e.data.pagina_principal,fotograph:e.data.fotograph}];

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
				{ field: "inicio_publicacion",	type:"date",format:"{0:dd-MM-yyyy}"	, title:"Inicio Publicación", width: "80px" },
				{ field: "fin_publicacion",	type:"date",format:"{0:dd-MM-yyyy}"	,title:"Fin Publicación", width: "70px" },
				{ field: "palabras_claves", title:"Palabras Claves" },
				{ field: "pagina_principal", title:"Página Principal" },
				{ field: "fotograph", title:"Fotógrafo" }

			]
		});

	}

	/*Acciones de los botones*/

	$('#all_check_articulo').click(function () {
		var c = this.checked;
		$('#gridselection_articulo :checkbox').prop('checked',c);
	});
	$('#accionbtn_articulosave_exit').click(function()
	{
		if (validator_articulo.validate())
		{

			var fd = new FormData(document.querySelector("#articulo_form"));
			var  url="?option=com_articulo&task=articulo_add";

			if($('#taskarticulo').val()=="update")
			{
				var olditem=JSON.stringify(Articulo.oldElement);
				fd.append('olditem',olditem);
				  url="?option=com_articulo&task=articulo_update";
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
						if($('#taskarticulo').val()=='update')
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
					Articulo.gridDataSource.read();
					$('#articulo_form')[0].reset();
					wnd_articulo.close();
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
	$('#accionbtn_articulosave_new').click(function()
	{
		if (validator_articulo.validate())
		{

			var fd = new FormData(document.querySelector("#articulo_form"));
			var url="?option=com_articulo&task=articulo_add";
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
						if($('#taskarticulo').val()=='update')
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
					showInsert_articulo();
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

	$('#cancelbtn_articulo').click(function(){
		$('#articulo_form')[0].reset();
		Articulo.gridDataSource.read();
		wnd_articulo.close();
	});

	$('#addbutton_articulo').click(function(){
		showInsert_articulo();
	});
	$('#deletebutton_articulo').click(function(){
		var checkbox_checked=$('#gridselection_articulo .check_row:checked');

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
						var dataItem=Articulo.finditem($(this).attr('id'));
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
						url:"?option=com_articulo&task=articulo_delete",
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
							Articulo.gridDataSource.read();
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
