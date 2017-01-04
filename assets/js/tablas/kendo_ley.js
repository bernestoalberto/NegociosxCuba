/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:6:17 */
//Creando variables globales
var validator;
var Ley={};
var message="";
var ley_pic_path = "../images/leyes/";
var ley_doc_path_word = "../images/logos/word.png";
var ley_doc_path_power_point = "../images/logos/powerpoint.png";
var ley_doc_path_pdf = "../images/logos/AdobeReader.png";
var doc_path = "../documentos/";


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

		if(Ley.oldElement!=null) {


             
			$('#numero_gaceta').data('kendoNumericTextBox').value(Ley.oldElement.numero_gaceta);
			$('#numero_ley').data('kendoNumericTextBox').value(Ley.oldElement.numero_ley);
			$('#inicio_publicacion').data('kendoDatePicker').value(Ley.oldElement.inicio_publicacion);
			$('#fin_publicacion').data('kendoDatePicker').value(Ley.oldElement.fin_publicacion);
			
			$('#acceso').data("kendoDropDownList").value(Ley.oldElement.acceso);
			$('#id_estado_ley').data('kendoDropDownList').value(Ley.oldElement.id_estado_ley);
			$('#anyo_ley').data('kendoDropDownList').value(Ley.oldElement.anyo_ley);
			$('#anyo_gaceta').data('kendoDropDownList').value(Ley.oldElement.anyo_gaceta);
			$('#palabras_claves_general').val(Ley.oldElement.palabras_claves_general);

			$('#epigrafe').val(Ley.oldElement.epigrafe);
			$('#bajante').val(Ley.oldElement.bajante);
			$('#palabras_claves_info').val(Ley.oldElement.palabras_claves_info);
			$('#anuncio').val(Ley.oldElement.anuncio);

			$('#autor').data("kendoDropDownList").value(Ley.oldElement.autor);
				switch (Ley.oldElement.tipo_ley){

					case 1:
						$("#tipo_ley2").prop("checked",true);
						break;
					case 2:
						$("#tipo_ley3").prop("checked",true);
						break;
					case 3:

						$("#tipo_ley4").prop("checked",true);
						$('#organismo').data('kendoDropDownList').value(Ley.oldElement.organismo);
						$('#organismo').data('kendoDropDownList').enable();
						break;

				}
			document.getElementById('image_contenedor_2').hidden = false;
			document.getElementById("img_ley").src=ley_pic_path+Ley.oldElement.imagen;
			document.getElementById("img_ley").alt=Ley.oldElement.auto;
			if(Ley.oldElement.documento !="") {
			var	doc = Ley.oldElement.documento;
				document.getElementById('image_contenedor_1').hidden = false;
				if(doc.contains("pptx")){
					document.getElementById("documento_ley").src = ley_doc_path_power_point;
				}
				else if(doc.contains("pdf")){
					document.getElementById("documento_ley").src = ley_doc_path_pdf;
				}
				else{
					document.getElementById("documento_ley").src = ley_doc_path_word;
				}

				document.getElementById("referecia_doc").href = doc_path + doc;
				kendo.template($("#doc_ley").html());
			}
 
			if(Ley.oldElement.incluir_pagina_principal=="si") {
			$("#incluir_pagina_principal").prop('checked', true);

			}
			else{


			$("#incluir_pagina_principal").prop('checked', false);
			}

		}

		else
		{
			$('#autor').data("kendoDropDownList").value('');
			$('#acceso').data("kendoDropDownList").value('');
			$('#id_estado_ley').data('kendoDropDownList').value('');
			$('#numero_gaceta').data('kendoNumericTextBox').value('');
			$('#numero_ley').data('kendoNumericTextBox').value('');
			$('#inicio_publicacion').data('kendoDatePicker').value('');
			$('#fin_publicacion').data('kendoDatePicker').value('');
			$('#organismo').data('kendoDropDownList').value('');
			 document.getElementById("img_ley").src="";
			 document.getElementById("documento_ley").src="";

		}
	}}).data("kendoWindow");



//Definir controladora
Ley.oldElement=null;

Ley.change = function onChange(arg) {
};
Ley.change = function onDataBinding(arg) {
};
Ley.dataBound=function onDataBound(arg) {
	var dataarray=this._data;
	var i=0;
	$('#all_check').prop('checked',false);
	Ley.kgrid=this;
}
Ley.finditem=function(uid){
	var dataItem=null;
	dataItem=$.map(Ley.gridDataSource._data,function(val,index){
		if(val.uid==uid)
		{
			return val;
		}
	});
	return dataItem[0];
}

$("#numero_gaceta").kendoNumericTextBox({
	max:2500000,
	min:1

});
$("#numero_ley").kendoNumericTextBox({
	max:2500000,
	min:1

});

/*Date Picker  duracionInicio*/
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

function showInsert_ley() {
	Ley.oldElement=null;
	validator_ley.hideMessages();
	$('#ley_form')[0].reset();
	$('#taskley').val('insert');
	document.getElementById('image_contenedor_2').hidden = true;
	document.getElementById('image_contenedor_1').hidden = true;

	$('#accionbtn_leysave_exit').text('Guardar y Salir');
	wnd_ley.title("Registrar Ley");
	$('#accionbtn_leysave_new').show();
	wnd_ley.center().open();
}

//Mostrar Ventanas
function showUpdate_ley(e) {
	validator_ley.hideMessages();
	$('#ley_form')[0].reset();
	var dataItem=Ley.finditem(e.id);
	Ley.oldElement= dataItem;
	$('#taskley').val('update');
	wnd_ley.title("Actualizar Ley");
	$('#accionbtn_leysave_exit').text('Actualizar');
	$('#accionbtn_leysave_new').hide();
	wnd_ley.center().open();
}
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
var anyodatasource = [
	{id:1,anyo:1900},
	{id:2,anyo:1901},
	{id:3,anyo:1902},
	{id:4,anyo:1903},
	{id:5,anyo:1904},
	{id:6,anyo:1905},
	{id:7,anyo:1906},
	{id:8,anyo:1907},
	{id:9,anyo:1908},
	{id:10,anyo:1909},
	{id:11,anyo:1910},
	{id:12,anyo:1911},
	{id:13,anyo:1912},
	{id:14,anyo:1913},
	{id:15,anyo:1914},
	{id:16,anyo:1915},
	{id:17,anyo:1916},
	{id:18,anyo:1917},
	{id:19,anyo:1918},
	{id:20,anyo:1919},
	{id:21,anyo:1920},
	{id:22,anyo:1921},
	{id:23,anyo:1922},
	{id:24,anyo:1923},
	{id:25,anyo:1924},
	{id:26,anyo:1925},
	{id:27,anyo:1926},
	{id:28,anyo:1927},
	{id:29,anyo:1928},
	{id:30,anyo:1929},
	{id:31,anyo:1930},
	{id:32,anyo:1931},
	{id:33,anyo:1932},
	{id:34,anyo:1933},
	{id:35,anyo:1934},
	{id:36,anyo:1935},
	{id:37,anyo:1936},
	{id:38,anyo:1937},
	{id:39,anyo:1938},
	{id:40,anyo:1939},
	{id:41,anyo:1940},
	{id:42,anyo:1941},
	{id:43,anyo:1942},
	{id:44,anyo:1943},
	{id:45,anyo:1944},
	{id:46,anyo:1945},
	{id:47,anyo:1946},
	{id:48,anyo:1947},
	{id:49,anyo:1948},
	{id:50,anyo:1949},
	{id:51,anyo:1950},
	{id:52,anyo:1951},
	{id:53,anyo:1952},
	{id:54,anyo:1953},
	{id:55,anyo:1954},
	{id:56,anyo:1955},
	{id:57,anyo:1956},
	{id:58,anyo:1957},
	{id:59,anyo:1958},
	{id:60,anyo:1959},
	{id:61,anyo:1960},
	{id:62,anyo:1961},
	{id:63,anyo:1962},
	{id:64,anyo:1963},
	{id:65,anyo:1964},
	{id:66,anyo:1965},
	{id:67,anyo:1966},
	{id:68,anyo:1967},
	{id:69,anyo:1968},
	{id:70,anyo:1969},
	{id:71,anyo:1970},
	{id:72,anyo:1971},
	{id:73,anyo:1972},
	{id:74,anyo:1973},
	{id:75,anyo:1974},
	{id:76,anyo:1975},
	{id:77,anyo:1976},
	{id:78,anyo:1977},
	{id:79,anyo:1978},
	{id:80,anyo:1979},
	{id:81,anyo:1980},
	{id:82,anyo:1981},
	{id:83,anyo:1982},
	{id:84,anyo:1983},
	{id:85,anyo:1984},
	{id:86,anyo:1985},
	{id:87,anyo:1986},
	{id:88,anyo:1987},
	{id:89,anyo:1988},
	{id:90,anyo:1989},
	{id:91,anyo:1990},
	{id:92,anyo:1991},
	{id:93,anyo:1992},
	{id:94,anyo:1993},
	{id:95,anyo:1994},
	{id:96,anyo:1995},
	{id:97,anyo:1996},
	{id:98,anyo:1997},
	{id:99,anyo:1998},
	{id:100,anyo:1999},
	{id:101,anyo:2000},
	{id:102,anyo:2001},
	{id:103,anyo:2002},
	{id:104,anyo:2003},
	{id:105,anyo:2004},
	{id:106,anyo:2005},
	{id:107,anyo:2006},
	{id:108,anyo:2007},
	{id:109,anyo:2008},
	{id:110,anyo:2009},
	{id:111,anyo:2010},
	{id:112,anyo:2011},
	{id:113,anyo:2012},
	{id:114,anyo:2013},
	{id:115,anyo:2014},
	{id:116,anyo:2015},
	{id:117,anyo:2016},
	{id:118,anyo:2017},
	{id:119,anyo:2018},
	{id:120,anyo:2019},
	{id:121,anyo:2020},
	{id:122,anyo:2021},
	{id:123,anyo:2022},
	{id:124,anyo:2023},
	{id:125,anyo:2024},
	{id:126,anyo:2025},
	{id:127,anyo:2026},
	{id:128,anyo:2027},
	{id:129,anyo:2028},
	{id:130,anyo:2029},
	{id:131,anyo:2030}

];

$("#anyo_ley").kendoDropDownList({
	dataTextField: "anyo",
	dataValueField: "id",
	dataSource: anyodatasource,
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
$("#anyo_gaceta").kendoDropDownList({
	dataTextField: "anyo",
	dataValueField: "id",
	dataSource: anyodatasource,
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
var orgdatasource = [
	{id:0,nombre:"No Tiene"},
	{id:1,nombre:"MINAGRI"},
	{id:2,nombre:"MICOM"},
	{id:3,nombre:"MINSAP"},
	{id:4,nombre:"MINTUR"},
	{id:5,nombre:"MINED"},
	{id:6,nombre:"MINREX"},
	{id:7,nombre:"MINBAS"},
	{id:8,nombre:"MITRANS"},
	{id:9,nombre:"MINFP"},
	{id:10,nombre:"MICONS"},
	{id:11,nombre:"MINFAR"},
	{id:12,nombre:"MININT"},
	{id:13,nombre:"MINJUS"}
];
$("#organismo").kendoDropDownList({
	dataTextField: "nombre",
	dataValueField: "id",
	dataSource: orgdatasource,
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
var estado_leydatasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url:"?option=com_estado_ley&task=ley_json_list",
			dataType: "json"
		}
	}
});
/*ComboBox  Clasificacion*/
$("#id_estado_ley").kendoDropDownList({
	dataTextField: "estado",
	dataValueField: "id_estado_ley",
	dataSource: estado_leydatasource,
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
var autordatasource = new kendo.data.DataSource({
	transport: {
		read: {
			type:'POST',
			url:"?option=com_negocio&task=usuario_json_list",
			dataType: "json"
		}
	}
});
/*ComboBox  Clasificacion*/
$("#autor").kendoDropDownList({
	dataTextField: "username",
	dataValueField: "id_user",
	dataSource: autordatasource,
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




//Eliminar elemento
function delete_element_ley(e)
{
	var dataItem=Ley.finditem(e.id);
	var array=[];
	array.push(dataItem);
	$.MetroMessageBox({
		title: "<span class='fa fa-trash-o'></span> Eliminar ",
		content: "<p class='fg-white'>Desea eliminar este Ley?</p> ",
		NormalButton: "#232323",
		ActiveButton: "#008a00 ",
		buttons: " [Cancelar][Aceptar]"
	}, function (a) {
		if(a=="Aceptar")
		{
			$.ajax({
				type: "POST",
				url:"?option=com_ley&task=ley_delete_one",
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
					Ley.gridDataSource.read();
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
						var size = value.length;
				//		var i = 0;
						if (Ley.oldElement == null) {

							if (input.is("[id=documento]")) {

								var file = document.getElementById('documento').files[0];


								var ext = file.type;
								switch(ext){
									case "application/msword":
										break;
									case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
										break;
									case "text/plain":
										break;
									case "application/pdf":
										break;
									default:
										found=true;
										message="El archivo adjuntado solo admite extensiones en formato doc, docx, txt y pdf";
										return $('#documento').val('');
									break;

								}


								var overall =  file.size;

								if($("#imagen").val() != ""){
									var file2 = document.getElementById('imagen').files[0];
									var sizefile2 =  file2.size;

									overall = sizefile2 + overall;
								}



								if(overall > 9992132){
									found=true;
									message="El archivo adjuntado excede el tamaño permitido";
									$('#imagen').val('');
									return $('#documento').val('');
								}

							}
							if (input.is("[id=imagen]")) {



								var file2 = document.getElementById('imagen').files[0];

								if($("#imagen").val() != "") {
									var overall = file2.size;
									var ext2 = file2.type;
								}
								if($("#documento").val() != ""){
									var file = document.getElementById('documento').files[0];
									var sizefile =  file.size;

									 overall = sizefile + overall;
								}

								if(ext2 !="image/jpeg"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#imagen').val('');
								}
								else if(overall > 9992132){
									$('#documento').val('');
									return $('#imagen').val('');
								}
							}

							if (input.is("[id=palabras_claves_general]")) {


								if(size > 50){
									found=true;
									message="Las palabras_claves  ingresadas no debe exceder los 50 caracteres";
									return $('#palabras_claves_general').val('');
								}
							}
							if ($('#tipo_ley1').prop("checked")) {
								if ($('#tipo_ley1').prop("checked")) {

								$('#organismo').data("kendoDropDownList").value(0);
								$('#organismo').data("kendoDropDownList").readonly();


							}
						}
						if (input.is("[id=tipo_ley2]")) {
							if ($('#tipo_ley2').prop("checked")) {
								$('#organismo').data("kendoDropDownList").value(0);
								$('#organismo').data("kendoDropDownList").readonly();

							}
						}
						if (input.is("[id=tipo_ley3]")) {
							if ($('#tipo_ley3').prop("checked")) {
								$('#organismo').data("kendoDropDownList").value(0);
								$('#organismo').data("kendoDropDownList").readonly();

							}
						}
						if (input.is("[id=tipo_ley4]")) {
							if ($('#tipo_ley4').prop("checked")) {
								$('#organismo').data("kendoDropDownList").enable();
							}
						}





							if ($('#incluir_pagina_principal').prop("checked")) {

									$('#incluir_pagina_principal').val('si');
							}

							else if(!$('#incluir_pagina_principal').prop("checked")){
								$('#incluir_pagina_principal').val('no');
							}
							if(input.is("[id=fin_publicacion]")) {
								var	inicio = $("#inicio_publicacion").data('kendoDatePicker').value();
								var	final = $("#fin_publicacion").data('kendoDatePicker').value();
								if(inicio > final && final != null){
									message = "La fecha de fin de publicación debe ser posterior a la fecha inicial";
									return $('#fin_publicacion').data('kendoDatePicker').value('');
								}
							}
							if (input.is("[id=palabras_claves_info]")) {


								if(size > 50){
									found=true;
									message="Las palabras_claves ingresadas no debe exceder los 50 caracteres";
									return $('#palabras_claves_info').val('');
								}
							}
							if (input.is("[id=epigrafe]")) {


								if(size > 50){
									found=true;
									message="El epigrafe ingresadas no debe exceder los 50 caracteres";
									return $('#epigrafe').val('');
								}
							}
							if (input.is("[id=anuncio]")) {


								if(size > 50){
									found=true;
									message="El anuncio ingresado no debe exceder los 50 caracteres";
									return $('#anuncio').val('');
								}
							}
							if (input.is("[id=bajante]")) {


								if(size > 50){
									found=true;
									message="El bajante ingresado no debe exceder los 50 caracteres";
									return $('#bajante').val('');
								}
							}

							return !found;


						}
						else if($('#taskley').val()=='update'){

							if (input.is("[id=documento]")) {

								var file = document.getElementById('documento').files[0];


								var ext = file.type;
								switch(ext){
									case "application/msword":
										break;
									case "application/vnd.openxmlformats-officedocument.wordprocessingml.document":
										break;
									case "text/plain":
										break;
									case "application/pdf":
										break;
									default:
										found=true;
										message="El archivo adjuntado solo admite extensiones en formato doc, docx, txt y pdf";
										return $('#documento').val('');
										break;

								}


								var overall =  file.size;

								if($("#imagen").val() != ""){
									var file2 = document.getElementById('imagen').files[0];
									var sizefile2 =  file2.size;

									overall = sizefile2 + overall;
								}



								if(overall > 9992132){
									found=true;
									message="El archivo adjuntado excede el tamaño permitido";
									$('#imagen').val('');
									return $('#documento').val('');
								}

							}
							if (input.is("[id=epigrafe]")) {


								if(size > 50){
									found=true;
									message="El epigrafe ingresadas no debe exceder los 50 caracteres";
									return $('#epigrafe').val('');
								}
							}
							if (input.is("[id=imagen]")) {

								var file2 = document.getElementById('imagen').files[0];
								if(file2 !=null){
									var overall =  file2.size;
									var ext2 = file2.type;
								}


								if($("#documento").val() != ""){
									var file = document.getElementById('documento').files[0];
									var sizefile =  file.size;

									overall = sizefile + overall;
								}




								if(ext2 !="image/jpeg"){
									found=true;
									message="El archivo adjuntado solo admite extensiones en formato jpg";
									return $('#imagen').val('');
								}
								else if(overall > 9992132){
									$('#documento').val('');
									return $('#imagen').val('');
								}
							}
							if ($('#tipo_ley1').prop("checked")) {
								if ($('#tipo_ley1').prop("checked")) {

									$('#organismo').data("kendoDropDownList").value(0);
									$('#organismo').data("kendoDropDownList").readonly();


								}
							}
							if (input.is("[id=tipo_ley2]")) {
								if ($('#tipo_ley2').prop("checked")) {
									$('#organismo').data("kendoDropDownList").value(0);
									$('#organismo').data("kendoDropDownList").readonly();

								}
							}
							if (input.is("[id=tipo_ley3]")) {
								if ($('#tipo_ley3').prop("checked")) {
									$('#organismo').data("kendoDropDownList").value(0);
									$('#organismo').data("kendoDropDownList").readonly();

								}
							}
							if (input.is("[id=tipo_ley4]")) {
								if ($('#tipo_ley4').prop("checked")) {
									$('#organismo').data("kendoDropDownList").enable();
								}
							}

							if (input.is("[id=palabras_claves_general]")) {


								if(size > 50){
									found=true;
									message="Las palabras_claves  ingresadas no debe exceder los 50 caracteres";
									return $('#palabras_claves_general').val('');
								}
							}
							if ($('#incluir_pagina_principal').prop("checked")) {

								$('#incluir_pagina_principal').val('si');
							}

							else if(!$('#incluir_pagina_principal').prop("checked")){
								$('#incluir_pagina_principal').val('no');
							}
							if(input.is("[id=fin_publicacion]")) {
								var	inicio = $("#inicio_publicacion").data('kendoDatePicker').value();
								var	final = $("#fin_publicacion").data('kendoDatePicker').value();
								if(inicio > final && final != null){
									message = "La fecha de fin de publicación debe ser posterior a la fecha inicial";
									return $('#fin_publicacion').data('kendoDatePicker').value('');
								}
							}
							if (input.is("[id=palabras_claves_info]")) {


								if(size > 50){
									found=true;
									message="Las palabras_claves ingresadas no debe exceder los 50 caracteres";
									return $('#palabras_claves_info').val('');
								}
							}
							if (input.is("[id=anuncio]")) {


								if(size > 50){
									found=true;
									message="El anuncio ingresado no debe exceder los 50 caracteres";
									return $('#anuncio').val('');
								}
							}
							if (input.is("[id=bajante]")) {


								if(size > 50){
									found=true;
									message="El bajante ingresado no debe exceder los 50 caracteres";
									return $('#bajante').val('');
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
	Ley.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type:'POST',
				url:"?option=com_ley&task=ley_json_list",
				dataType: "json"
			}
		},
		change: function(e){
			console.clear();
		},
		schema:{
			model:{
				fields:{

					id_ley:{type:"number"},
					numero_gaceta:{type:"number"},
					gaceta:{type:"string"},
					palabras_claves_general:{type:"string"},
					acceso:{type:"number"},
					acces:{type:"string"},
					id_estado_ley:{type:"number"},
					tipo:{type:"string"},
					state:{type:"string"},
					documento:{type:"string"},
					imagen:{type:"string"},
					incluir_pagina_principal:{type:"string"},
					inicio_publicacion:{type:"date"},
					fin_publicacion:{type:"date"},
					autor:{type:"number"},
					author:{type:"string"},
					bajante:{type:"string"},
					anuncio:{type:"string"},
					palabras_claves_info:{type:"string"},
					numero_ley:{type:"number"},
					anyo_ley:{type:"number"},
					anyo_gaceta:{type:"number"},
					tipo_ley:{type:"number"},
					epigrafe:{type:"string"},
					organismo:{type:"number"},
					organism:{type:"string"},


				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_ley").kendoGrid({
		dataSource: Ley.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_ley").html()),
		detailInit:detailInit,
		groupable:true,
		sortable: true,
		change: Ley.change,
		resizable: true,
		dataBound: Ley.dataBound,
		dataBinding: Ley.dataBinding,
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
				field: "palabras_claves_general",
				title: "Palabras Claves",
				template:'<div id="item" data-text="#: palabras_claves_general#">#: palabras_claves_general#</div>',
				width: '8%',
				type:"string",
				hidden:true
			},

			{
				field: "gaceta",
				title: "Gaceta",
				template:'<div id="item" data-text="#: gaceta#">#: gaceta#</div>',
				width: '8%',
				type:"string"
			}

			,
			{
				field: "inicio_publicacion",
				title: "Inicio",
				format:"{0:dd-MM-yyyy}",
				width: '8%',
				type:"date",
				hidden:true
			}
			,
			{
				field: "fin_publicacion",
				title: "Fin",
				format:"{0:dd-MM-yyyy}",
				width: '8%',
				type:"date",
				hidden:true
			}
			,
			{
				field: "tipo",
				title: "Tipo",
				template:'<div id="item" data-text="#: tipo#">#: tipo#</div>',
				width: '8%',
				type:"string"
			}
			,
			{
				field: "state",
				title: "state",
				template:'<div id="item" data-text="#: state#">#: state#</div>',
				width: '8%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "epigrafe",
				title: "epigrafe",
				template:'<div id="item" data-text="#: epigrafe#">#: epigrafe#</div>',
				width: '8%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "acces",
				title: "Acceso",
				template:'<div id="item" data-text="#: acces#">#: acces#</div>',
				width: '8%',
				type:"string"
			}
			,
			{
				field: "incluir_pagina_principal",
				title: "Página Principal",
				template:'<div id="item" data-text="#: incluir_pagina_principal#">#: incluir_pagina_principal#</div>',
				width: '8%',
				type:"string"
			}
			,
			{
				field: "author",
				title: "author",
				template:'<div id="item" data-text="#: author#">#: author#</div>',
				width: '8%',
				type:"string",
				hidden:true
			}
			,
			{
				field: "organism",
				title: "organism",
				template:'<div id="item" data-text="#: organism#">#: organism#</div>',
				width: '8%',
				type:"string",
				hidden:true
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
	function detailInit(e) {
		var detailRow = e.detailRow;

		var datos = [{inicio_publicacion:e.data.inicio_publicacion,fin_publicacion:e.data.fin_publicacion,author:e.data.author,state:e.data.state,
			epigrafe:e.data.epigrafe,organism:e.data.organism,palabras_claves_general:e.data.palabras_claves_general}];

		detailRow.find(".tabstrip").kendoTabStrip({
			animation: {
				open: { effects: "fadeIn" }
			}
		});

		detailRow.find(".orders").kendoGrid({
			dataSource:datos,
			scrollable: false,
			sortable: true,
			resizable: true,
			pageable: true,
			columns: [
				{ field: "inicio_publicacion",	type:"date",format:"{0:dd-MM-yyyy}"	, title:"Inicio Publicación", width: "80px" },
				{ field: "fin_publicacion",	type:"date",format:"{0:dd-MM-yyyy}"	,title:"Fin Publicación", width: "70px" },
				{ field: "author", title:"Autor" },
				{ field: "state", title:"Estado" },
				{ field: "epigrafe", title:"Epigrafe" },
				{ field: "organism", title:"Organismo" },
				{ field: "palabras_claves_general", title:"Palabras Claves" }

			]
		});

	}

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

			var  url="?option=com_ley&task=ley_add";

			if($('#taskley').val()=="update")
			{
				var olditem=JSON.stringify(Ley.oldElement);
				fd.append('olditem',olditem);
				  url="?option=com_ley&task=ley_update";
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
					Ley.gridDataSource.read();
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
			var url="?option=com_ley&task=ley_add";
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
		Ley.gridDataSource.read();
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
						var dataItem=Ley.finditem($(this).attr('id'));
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
						url:"?option=com_ley&task=ley_delete_one",
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
							Ley.gridDataSource.read();
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
