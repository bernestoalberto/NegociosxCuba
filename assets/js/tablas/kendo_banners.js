/** * Created by Ernesto on .
 *Date:12/20/2015
 *Time:5:16 */
//Creando variables globales
	var validator;
	var Banners={};
	var message=""
//Definir controladora
Banners.oldElement = null;

Banners.change = function onChange(arg) {
};
Banners.change = function onDataBinding(arg) {
};
Banners.dataBound = function onDataBound(arg) {
	var dataarray = this._data;
	var i = 0;
	$('#all_check').prop('checked', false);
	Banners.kgrid = this;
}
Banners.finditem = function (uid) {
	var dataItem = null;
	dataItem = $.map(Banners.gridDataSource._data, function (val, index) {
		if (val.uid == uid) {
			return val;
		}
	});
	return dataItem[0];
}

//On load
$(function() {
	Banners.gridDataSource = new kendo.data.DataSource({
		transport: {
			read: {
				type: 'POST',
				url: "?option=com_spot&task=spot_json_list",
				dataType: "json"
			}
		},
		change: function (e) {
			console.clear();
		},
		schema: {
			model: {
				fields: {
					name: {type: "string"},
					descripcion: {type: "string"},
					state: {type: "number"},
					estado: {type: "string"},
					clicks: {type: "number"},
					clickurl: {type: "string"},
					publish_down: {type: "date"},
					publish_up: {type: "date"},
					//posicion:{type:"number"},
					//position: {type: "string"},
					id: {type: "number"}
				}
			}
		},
		pageSize: 12
	});
	$("#gridselection_banner").kendoGrid({
		dataSource: Banners.gridDataSource,
		height: 500,
		columnMenu: true,
		filterable: {
			mode: "row"
		},
		detailTemplate: kendo.template($("#template_banners").html()),
		detailInit:detailInit,
		sortable: true,
		groupable: true,
		change: Banners.change,
		resizable: true,
		dataBound: Banners.dataBound,
		dataBinding: Banners.dataBinding,
		pageable: {
			buttonCount: 5,
			refresh: true,
			pageSizes: [2, 10, 20, 30, 50, 100]
		},
		columns: [

			{
				field: "name",
				template: '<div id="item" data-text="#: name#">#: name#</div>',
				title: "Cliente",
				width: '10%',
				type: "string"
			}
			,

			{
				field: "description",
				template: '<div id="item" data-text="#: description#">#: description#</div>',
				title: "Descripción",
				width: '10%',
				type: "string",
					hidden:true
			}
			,
			{
				field: "estado",
				template: '<div id="item" data-text="#: estado#">#: estado#</div>',
				title: "estado",
				width: '10%',
				type: "string",
					hidden:true
			}
			,

			{
				field: "clicks",
				template: '<div id="item" data-text="#: clicks#">#: clicks#</div>',
				title: "Clicks",
				width: '5%',
				type: "number"
			}
			,		{
				field: "clickurl",
				template: '<div id="item" data-text="#: clickurl#">#: clickurl#</div>',
				title: "Url",
				width: '10%',
				type: "string"
			}
			,

			{
				field: "publish_down",
				title: "Expira",
				width: '7%',
				type: "publish_down",
				format: "{0:dd-MM-yyyy}"
			}

		]
	});

	function detailInit(e) {
		var detailRow = e.detailRow;

		var datos = [{description:e.data.description,estado:e.data.estado,publish_up:e.data.publish_up}];

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

				{ field: "publish_up",type:"date",format:"{0:dd-MM-yyyy}"	,title:"Creado" , width: "100px" },
				{ field: "estado", title:"Estado", width: "80px"},
				{ field: "description"	, title:"Descripción" }



			]
		});

	}

	});

