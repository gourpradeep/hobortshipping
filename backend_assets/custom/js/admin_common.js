var proceed_err = "Please fill all the fields properly";

function show_loader() {
	$("#tl_admin_loader").show();
}

function hide_loader() {
	$("#tl_admin_loader").hide();
}

//Services- Air Freight Datatable
var dtAirFreightService = $("#dtAirFreightService");
dtAirFreightService.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/service/air_freight_list",
		type: "POST",
		dataType: "json",
		data: {},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//Services- Sea Freight Datatable
var dtSeaFreightService = $("#dtSeaFreightService");
dtSeaFreightService.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/service/sea_freight_list",
		type: "POST",
		dataType: "json",
		data: {},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//Services- Air Freight Item Datatable
var dtAirFreightItem = $("#dtAirFreightItem");
dtAirFreightItem.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	language: {
		"infoFiltered": ""
	},
	order: [], //Initial no order.
	iDisplayLength: 20,
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/item/air_freight_items_list",
		type: "POST",
		dataType: "json",
		data: {},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//Services- Courier/Express Services Datatable
var dtCourierExpressServices = $("#dtCourierExpressServices");
dtCourierExpressServices.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/service/courier_express_freight_list",
		type: "POST",
		dataType: "json",
		data: {},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

// ticket list Datatable
var ticketList = $("#ticketList").DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/ticket/get_ticket_list",
		type: "POST",
		dataType: "json",
		data: function (res) {
			res.ticketStatus = $('#ticket-status').val();
		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	{
		className: "text-right detailoption",
		"targets": [5]
	},
	],
});

$(document).on('change', '#ticket-status', function () {
	ticketList.draw();
});

//Delete function
var deleteFn = function (table, field, id, ctrl, method) {
	bootbox.confirm({
		message: "Are you sure you want to delete this record ?",
		buttons: {
			confirm: {
				label: "OK",
				className: "btn btn-warning",
			},
			cancel: {
				label: "Cancel",
				className: "btn-danger",
			},
		},
		callback: function (result) {
			if (result) {
				show_loader();
				var url = base_url + ctrl + "/" + method;
				$.ajax({
					method: "POST",
					url: url,
					dataType: "json",
					data: {
						id: id,
						id_name: field,
						table: table
					},
					success: function (data) {
						hide_loader();
						if (data.status == 1) {
							toastr.success(data.message);
							window.setTimeout(function () {
								window.location.reload();
							}, 2000);
						} else {
							toastr.error(data.message);
						}
					},
					error: function (error, ror, r) {
						toastr.error(error);
					},
				});
			}
		},
	});
};

//Edit function
var editFn = function (ctrl, method, id) {
	$.ajax({
		url: base_url + ctrl + "/" + method,
		type: "POST",
		data: {
			id: id
		},
		beforeSend: function () {
			show_loader();
		},
		success: function (data, textStatus, jqXHR) {
			hide_loader();
			$("#form-modal-box").html(data);
			$("#common_model").modal("show");
		},
	});
};

var viewFn = function (ctrl, method, id) {
	$.ajax({
		url: base_url + ctrl + "/" + method,
		type: "POST",
		data: {
			id: id
		},
		beforeSend: function () {
			show_loader();
		},
		success: function (data, textStatus, jqXHR) {
			hide_loader();
			$("#form-modal-box").html(data);
			$("#common_model").modal("show");
		},
	});
};


//Customer List Data table 
var customer = $("#customerlist");
customer.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/customer/customer_list",
		type: "POST",
		dataType: "json",
		data: {},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//New order List
var new_order = $("#new_order_list");
new_order.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/order/new_order_list",
		type: "POST",
		dataType: "json",
		data: function (data) {

			var status = jQuery("#service_type").val();
			data.status = status;

		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//shipment request 
var shipment_request = $("#shipment_request");
shipment_request.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/shipment/shipment_request_list",
		type: "POST",
		dataType: "json",
		data: function (data) {

			var status = jQuery("#service_type").val();
			data.status = status;

		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});


//new_quote_concierge List
var new_quote_concierge = $("#new_quote_concierge");
new_quote_concierge.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/new_quote_concierge_shipping/new_quote_concierge_list",
		type: "POST",
		dataType: "json",
		data: function (data) {

			var status = jQuery("#new_quote_status").val();
			data.status = status;

		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//pending order list
var pending_order_list = $("#pending_order_list");
pending_order_list.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/order/pending_order_list",
		type: "POST",
		dataType: "json",
		data: function (data) {

			var status = jQuery("#status_id").val();
			var service_type = jQuery("#service_type").val();
			data.status = status;
			data.service_type = service_type;

		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

//completed order list
var completed_order_list = $("#completed_order_list");
completed_order_list.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/order/completed_order_list",
		type: "POST",
		dataType: "json",
		data: function (data) {

			var status = jQuery("#service_type").val();
			data.status = status;

		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

// customer_details_list
var id = $('#customer_details').attr('data-id');
var customer_details = $("#customer_details");
customer_details.DataTable({
	processing: true, //Feature control the processing indicator.
	serverSide: true, //Feature control DataTables' server side processing mode.
	lengthChange: false,
	order: [], //Initial no order.
	iDisplayLength: 20,
	language: {
		"infoFiltered": ""
	},
	// Load data for the table's content from an Ajax source
	ajax: {
		url: base_url + "/customer/customer_details_list",
		type: "POST",
		dataType: "json",

		data: function (data) {

			var status = jQuery("#service_type").val();
			var status_id = jQuery("#status_id").val();
			data.user_id = id;
			data.status = status;
			data.status_id = status_id;

		},
		dataSrc: function (jsonData) {
			return jsonData.data;
		},
	},
	//Set column definition initialisation properties.
	columnDefs: [{
		orderable: false,
		targets: -1
	},
	{
		orderable: false,
		targets: -1
	},
	],
});

/**
 * chage user status
 */
var statuChange = function (method, id, status) {

	msg = "Are you sure you want to active user ?"
	if (status == 1) {
		msg = "Are you sure you want to deactive user ?"
	}

	bootbox.confirm({
		message: msg,
		buttons: {
			confirm: {
				label: 'OK',
				className: 'btn btn-primary'
			},
			cancel: {
				label: 'Cancel',
				className: 'btn-default'
			}
		},
		callback: function (result) {
			if (result) {
				$.ajax({
					url: base_url + method,

					type: 'POST',
					dataType: 'json',
					data: {
						'id': id,
						'status': status
					},
					beforeSend: function () {
						show_loader()
					},
					success: function (data, textStatus, jqXHR) {
						hide_loader();
						if (data.status == "success") {

							setTimeout(function () {
								location.reload();
							}, 2000)

							toastr.success(data.message)
						} else {

							toastr.error(data.message);
						};

					}
				});
			}
		}
	});
}

function myFunction(user_id, idproof, dataitem) {
	var message = "";
	if (idproof == '3') {
		message = "Reject";

		tosMsg = ' Rejected';
	} else if (idproof == '2') {
		message = "Approve";

		tosMsg = 'Approved';
	}

	bootbox.confirm({
		message: "Are you sure, you want to " + message + " this " + dataitem + " ?",


		buttons: {
			confirm: {
				label: "OK",
				className: "btn btn-warning",
			},
			cancel: {
				label: "Cancel",
				className: "btn-danger",
			},
		},
		callback: function (result) {
			if (result) {
				show_loader();
				//var url = base_url + ctrl + "/" + method;
				$.ajax({
					url: base_url + "/customer/change_idproof_status",
					type: "POST",
					data: {
						'id': user_id,
						'status': idproof
					},
					beforeSend: function () {
						show_loader()

					},
					success: function (data, textStatus, jqXHR,) {
						if (idproof == 2) {
							hide_loader()
							$('#reject').hide()
							$('#accept').hide()
							$('#app').show()
							toastr.success(tosMsg);
						} else {
							hide_loader()
							$('#reject').hide()
							$('#accept').hide()
							$('#rej').show()
							toastr.error(tosMsg);

						};
					},

				});
			}
		},
	});
};

$('body').on('click', '#comment-submit', function (event) {
	toastr.remove();
	event.preventDefault();

	if ($('#comment-text').val() == "") {
		toastr.error('Please enter comment');
		return false;
	}

	var _that = $(this),
		form = _that.closest('form'),
		formData = new FormData(form[0]),
		f_action = form.attr('action');

	formData.append('is_comment_text', '1');

	$.ajax({
		type: "POST",
		url: f_action,
		data: formData, //only input
		processData: false,
		contentType: false,
		dataType: "JSON",
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			if (data.status == 1) {
				location.reload();
			} else if (data.status == -1) {
				//authetication failed
				toastr.error(data.msg);
				window.setTimeout(function () {
					window.location.href = data.url;
				}, 2000);
			} else {
				toastr.error(data.message);
				hide_loader();
			}
		},
	});
	event.stopImmediatePropagation();
	return false;
});

function commentAttechment(input) {
	var url = input.value;
	var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
	if (input.files && input.files[0] && (ext == "gif" || ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "pdf" || ext == "docx" || ext == "doc" || ext == "txt" || ext == "csv" || ext == "xls")) {
		var reader = new FileReader();

		var _that = $(input),
			form = _that.closest('form'),
			formData = new FormData(form[0]),
			f_action = form.attr('action');

		formData.append('is_comment_text', '0');

		$.ajax({
			type: "POST",
			url: f_action,
			data: formData, //only input
			processData: false,
			contentType: false,
			dataType: "JSON",
			beforeSend: function () {
				show_loader();
			},
			success: function (data) {
				if (data.status == 1) {
					location.reload();
				} else if (data.status == -1) {
					//authetication failed
					toastr.error(data.msg);
					window.setTimeout(function () {
						window.location.href = data.url;
					}, 2000);
				} else {
					toastr.error(data.message);
					hide_loader();
				}
			},
		});

	} else {
		toastr.error('Please select right format for this file.');
	}
}

// Show comment list with loadmore
get_comment_list_view();

var scrollHeightElement = document.getElementById("admin-content");
var is_next = '0';

//ajax funnction to get_comment_list_view
function get_comment_list_view(is_load_more = 0) {

	if (is_load_more != 0) {
		//if is_load_more is not 0 then get offset data from btnlod attr
		offset = $('#btnLoadViewMe').attr("data-offset");

	} else {
		//set offset =0 when is_load_more is 0
		offset = 0;
	}

	ticketId = $('#ticketID').val();

	$.ajax({
		url: base_url + "/ticket/comment_list_ajax",
		type: "POST",
		data: {
			offset: offset,
			ticketId: ticketId
		},
		dataType: "JSON",
		success: function (data) {

			if (data.no_record == 0) { //show data in div when no previous record
				$("#admin-attechment-div #admin-content").html(data.html_receive);
			} else {
				//append data when already record show in view
				$("#admin-attechment-div #admin-content").prepend(data.html_receive);
				$("#btnLoadViewMe").attr("data-offset", data.new_offset);
				is_next = data.is_next;
			}

			$('#total').text(data.count);

			if (is_load_more != 0) {

				$('#admin-content').animate({
					scrollTop: Number(scrollHeightElement.scrollHeight - $('#admin-content').attr("scroll-height"))
				}, 500);
				$("#admin-content").attr("scroll-height", $('#admin-content').prop("scrollHeight"));
			} else {
				$("#admin-content").attr("scroll-height", $('#admin-content').prop("scrollHeight"));
				$('#admin-content').scrollTop(scrollHeightElement.scrollHeight, scrollHeightElement.scrollHeight);
			}

			fancyboxLoad();

		},
	});
} //End function


function commentScroll() {
	if (scrollHeightElement.scrollTop == '0' && is_next != '0') {
		is_load_more = 1;
		get_comment_list_view(is_load_more);
	}
}

function fancyboxLoad() {
	//FANCYBOX
	$(".fancybox").fancybox({
		'transitionIn': 'fade',
		'transitionOut': 'fade',
	});
}

function ticketStatusChange() {
	console.log($('input[name="ticket_status"]:checked').val());

	formData = new FormData(),
		f_action = base_url + "/ticket/ticket_status";

	formData.append('ticket_status', $('input[name="ticket_status"]:checked').val());
	formData.append('ticket_id', $('#ticketID').val());

	$.ajax({
		type: "POST",
		url: f_action,
		data: formData, //only input
		processData: false,
		contentType: false,
		dataType: "JSON",
		beforeSend: function () {
			show_loader();
		},
		success: function (data) {
			if (data.status == 1) {
				toastr.success(data.message);
				location.reload();
			} else if (data.status == -1) {
				//authetication failed
				toastr.error(data.msg);
				window.setTimeout(function () {
					window.location.href = data.url;
				}, 2000);
			} else {
				toastr.error(data.message);
				hide_loader();
			}
		},
	});
}


//onclick
$('body').on('click', '.checkboxes', function () {

	if ($(this).is(':checked')) {
		var stat = $(this).attr('statusValue');
		$('#check_value').val(stat);
	} else {
		$('#check_value').val('');
	}
	event.stopPropagation();
});

function show_loader() {
	$("#tl_admin_loader").show();
}

function hide_loader() {
	$("#tl_admin_loader").hide();
}


$('body').on('click', '#submitStatus', function () {
	var url = base_url + '/order/status_change';
	var status = $('#check_value').val();
	var order_id = $('#order_id').val();
	// alert(order_id);
	if (status == '') {
		return false;
	}
	// console.log(file_name);
	$.ajax({
		type: "POST",
		url: url,
		dataType: "JSON",
		data: {
			order_id: order_id,
			status: status
		},

		beforeSend: function () {
			show_loader();
		},

	}).done(function (data) {
		toastr.remove();
		if (data.status == 1) {
			hide_loader();
			toastr.success(data.message);
			window.setTimeout(function () {
				location.reload();
			}, 1000);
		} else if (data.status == -1) {
			//authetication failed
			toastr.error(data.msg);
			window.setTimeout(function () {
				window.location.href = data.url;
			}, 2000);
		} else {
			hide_loader();
			toastr.error(data.message);
		}
	});
});


function add() {
	var userID = $("#userID").val();
	var cost_of_order = $("#cost_of_order").val();
	var concierge_fee = $("#concierge_fee").val();
	// var promo = $("#promo").val();
	var total = parseFloat(cost_of_order) + parseFloat(concierge_fee);
	var url = base_url + '/New_quote_concierge_shipping/concierge_calculation'
	$.ajax({
		type: "POST",
		url: url,
		data: {
			userID:userID,
			cost_of_order: cost_of_order,
			concierge_fee: concierge_fee,
			total: total
		}
	}).done(function (response) {
		toastr.remove();
		var data = JSON.parse(response);
		if (data.status == 1) {
			
			if (!isNaN(data.amount)) {
				$('#total').val(data.amount);
				if (concierge_fee !="" && cost_of_order !="" && data.promo_applicable == 1) {
					$('#discount_applied').show();
				}else{
    				$('#discount_applied').hide();
    	    	}
			}
			
			else {
				$('#total').val(0);
			}
		} else {
			toastr.error(data.message);
		}
	});
};

//auto grow ticket textarea
var ta = document.getElementById('comment-text');
ta.addEventListener('keydown', auto_grow);
function auto_grow() {
	setTimeout(function () {
		ta.style.cssText = 'height:0px';
		//console.log('scrollHeight', ta.scrollHeight);
		var height = Math.min(20 * 5, ta.scrollHeight);
		//console.log('height', height);
		// div.style.cssText = 'height:' + height + 'px';
		ta.style.cssText = 'height:' + height + 'px';
	}, 0);
}

