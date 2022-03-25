var pageLoader = $("#pageLoader");

function show_loader() {
    pageLoader.show();
}

function hide_loader() {
    pageLoader.hide();
}

var base_url = $('#base_url').val();

//Login from validation
var user_login = $("#user_login");
user_login.validate({
    ignore: [],
    rules: {
        email: {
            required: true,
            email: true,
            maxlength: 100
        },
        password: {
            required: true,
            maxlength: 100
        },
    },
});

//Login Submit action
// var jsonData = '<?php echo $jsonData;?>';
$('body').on('click', '#login_submit', function (e) {
    $("#inError").hide();

    toastr.remove();
    // event.preventDefault();

    if (user_login.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    // formData.append('jsonData', jsonData);
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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                window.setTimeout(function () {
                    window.location.href = data.url;
                }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(err_unknown);
        }
    });
});


var track = $("#track");
track.validate({
    ignore: [],
    rules: {
        tracking_id: {
            required: true,
        },
    },
});

//traking  
// var jsonData = '<?php echo $jsonData;?>';
$('body').on('click', '#track_sub', function (e) {

    toastr.remove();
    if (track.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    // formData.append('jsonData', jsonData);
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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                // window.setTimeout(function () {
                //     window.location.href = data.url;
                // }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //toastr.error(err_unknown);
        }
    });
});


var tracker = $("#tracker");
tracker.validate({
    ignore: [],
    rules: {
        tracking_id: {
            required: true,
        },
    },
});

//traking  
// var jsonData = '<?php echo $jsonData;?>';
$('body').on('click', '#tracker_sub', function (e) {
    toastr.remove();
    // event.preventDefault();

    if (tracker.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    // formData.append('jsonData', jsonData);
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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                window.setTimeout(function () {
                    window.location.href = data.url;
                }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            //toastr.error(err_unknown);
        }
    });
});
//Signup Form Validation
var signup = $("#signup");
signup.validate({
    ignore: [],
    rules: {
        name: {
            required: true,
            maxlength: 100
        },
        email: {
            required: true,
            email: true,
            maxlength: 100
        },
        password: {
            required: true,
            maxlength: 100
        },
        phone: {
            required: true,
            maxlength: 11,
            number: true
        },
        idproof: {
            required: true,
        },
    },
    messages: {
        phone: {
            maxlength: 'Please enter no more than 10 numbers',
            number: 'Please enter number only',
        },
    }
});

//Signup submit action
$('body').on('click', '#signup_submit', function (e) {
    toastr.remove();
    $("#inError").hide();

    // event.preventDefault();

    if (signup.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

    $.ajax({
        type: "POST",
        url: f_action,
        data: formData, //only input
        processData: false,
        contentType: false,
        dataType: "JSON",
        cache: false,
        beforeSend: function () {
            show_loader();
        },
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                window.setTimeout(function () {
                    window.location.href = data.url;
                }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(err_unknown);
        }
    });
});


//function for forgot password

//forgot password form validation
var reset_password = $("#reset_password");
reset_password.validate({
    ignore: [],
    rules: {
        email: {
            required: true,
            email: true,
            maxlength: 100
        }
    },
});

//Login Submit action
// var jsonData = '<?php echo $jsonData;?>';
$('body').on('click', '#password_submit', function (e) {
    toastr.remove();
    // event.preventDefault();

    if (reset_password.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    // formData.append('jsonData', jsonData);
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
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(err_unknown);
        }
    });
});

//function for adding air freight qoute
$("#add_air_freight_qoute").validate({
    ignore: [],
    rules: {

        weight: {
            required: true,
            min: 1
        },
        height: {
            required: true,
            min: 1
        },
        length: {
            required: true,
            min: 1
        },
        width: {
            required: true,
            min: 1
        },
        // item: {
        //     required: true
        // },
        item_value: {
            required: true,
            min: 1
        }
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") == "weight") {
            error.insertAfter("#lable_weight");
        }
        if (element.attr("name") == "height") {
            error.insertAfter("#lable_height");
        }
        if (element.attr("name") == "length") {
            error.insertAfter("#lable_length");
        }
        if (element.attr("name") == "width") {
            error.insertAfter("#lable_width");
        }
        if (element.attr("name") == "item_value") {
            error.insertAfter("#lable_item_value");
        }
    },

});

var add_air_freight_qoute = $("#add_air_freight_qoute");
$('body').on('click', '#submit', function (e) {
    const colorselector = $('#delveryType').val();
    toastr.remove();
    // event.preventDefault();
    if (add_air_freight_qoute.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    // if( $("#disclaimer").is(':checked') == false ) {
    //     toastr.error("Please check the disclaimer.");
    //     return false;
    // }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

    formData.append('delivery_type', colorselector);

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
                setTimeout(function () {
                    window.location = data.url
                },
                    2000)
                if (data.flag == '') {
                    toastr.success(data.message);
                }
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
    e.stopImmediatePropagation();
    return false;
});

//function for adding sea freight qoute
$("#add_sea_freight_qoute").validate({
    ignore: [],
    rules: {

        item_sea: {
            required: true
        },
        quantity_sea: {
            required: true
        }
    },
});

var add_sea_freight_qoute = $("#add_sea_freight_qoute");
$('body').on('click', '#submitSea', function (e) {
    var colorselector = $('#delveryType').val();
    toastr.remove();
    // event.preventDefault();
    if (add_sea_freight_qoute.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    formData.append('delivery_type', colorselector);

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
                setTimeout(function () {
                    window.location = data.url
                },
                    2000)
                if (data.flag == '') {
                    toastr.success(data.message);
                }
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
    e.stopImmediatePropagation();
    return false;
});

// //function for adding concierge_detail freight qoute
// $("#add_concierge_freight_qoute").validate({
//     ignore: [],
//     rules: {

//         concierge_detail: {
//             required: true
//         }
//     },
// });

// var add_concierge_freight_qoute = $("#add_concierge_freight_qoute");
// $('body').on('click', '#submitConcierge', function (e) {
//     var colorselector = $('#delveryType').val();
//     toastr.remove();
//     // event.preventDefault();
//     if (add_concierge_freight_qoute.valid() === false) {
//         toastr.error(proceed_err);
//         return false;
//     }
//     var _that = $(this),
//         form = _that.closest('form'),
//         formData = new FormData(form[0]),
//         f_action = form.attr('action');
//     formData.append('delivery_type', colorselector);

//     $.ajax({
//         type: "POST",
//         url: f_action,
//         data: formData, //only input
//         processData: false,
//         contentType: false,
//         dataType: "JSON",
//         beforeSend: function () {
//             show_loader();
//         },
//         success: function (data) {
//             if (data.status == 1) {
//                 setTimeout(function () {
//                     window.location = data.url
//                 },
//                     2000)
//                 if (data.flag == '') {
//                     toastr.success(data.message);
//                 }
//             } else if (data.status == -1) {
//                 //authetication failed
//                 toastr.error(data.msg);
//                 window.setTimeout(function () {
//                     window.location.href = data.url;
//                 }, 2000);
//             } else {
//                 toastr.error(data.message);
//                 hide_loader();
//             }
//         },
//     });
//     e.stopImmediatePropagation();
//     return false;
// });


//function for adding courier qoute
$("#add_courier_freight_qoute").validate({
    ignore: [],
    rules: {

        item_sea: {
            required: true
        },
        quantity_sea: {
            required: true
        }
    },
});

var add_courier_freight_qoute = $("#add_courier_freight_qoute");
$('body').on('click', '#submitCourier', function (e) {
    var colorselector = $('#delveryType').val();
    toastr.remove();
    // event.preventDefault();
    if (add_courier_freight_qoute.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    formData.append('delivery_type', colorselector);

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
                setTimeout(function () {
                    window.location = data.url
                },
                    2000)
                if (data.flag == '') {
                    toastr.success(data.message);
                }
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
    e.stopImmediatePropagation();
    return false;
});

//function for add shipper info
$("#add_shipper_info").validate({
    ignore: [],
    rules: {

        shipper_name: {
            required: true
        },
        tracking_id: {
            required: true
        },
        content: {
            required: true
        },
        company_name: {
            required: true
        }
    },
});

var add_shipper_info = $("#add_shipper_info");
$('body').on('click', '#shipper_submit', function (e) {
    toastr.remove();
    // event.preventDefault();
    if (add_shipper_info.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
                setTimeout(function () {
                    location.reload();
                },
                    2000)
                toastr.success(data.message);
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
    e.stopImmediatePropagation();
    return false;
});

$("#add_my_shipper").validate({
    ignore: [],
    rules: {

        shipper_name: {
            required: true
        },
        receiver_name: {
            required: true
        },
        origin: {
            required: true
        },
        total_value: {
            required: true
        },
        req_tracking_id: {
            required: true
        },
        description: {
            required: true
        },
    },
});

//my_shipper
var add_my_shipper = $("#add_my_shipper");
$('body').on('click', '#add_my_shipment', function (e) {
    toastr.remove();
    // event.preventDefault();
    if (add_my_shipper.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
                setTimeout(function () {
                    window.location = data.url
                },
                    2000)
            } else {
                toastr.error(data.message);
                hide_loader();
            }
        },
    });
    e.stopImmediatePropagation();
    return false;
});

function calculateQuoteAmnt() {
    const originalWeight = $('#weight').val(),
        length = $('#length').val(),
        height = $('#height').val(),
        width = $('#width').val(),
        itemVal = $('#item_value').val(),
        quantity = $('#quantity').val();

        let itemQuantity = itemVal * quantity;

        // if( quantity > 1 ) {
        //     itemQuantity = itemVal * quantity;
        // }

        const getDimentionalWeight = (length*height*width)/139; 
        let countWeightAmnt = getDimentionalWeight * 6;
        const getItemValuePercent = (15/100)*itemQuantity;

        console.log("countWeightAmnt", countWeightAmnt );
        console.log("$('#item_value').val()", $('#item_value').val() );
        // console.log("getItemValuePercent", getItemValuePercent );
        // console.log("getDimentionalWeight", getDimentionalWeight );
        // console.log("originalWeight", originalWeight );
        // console.log("itemQuantity", itemQuantity );
        // console.log("originalWeight", typeof originalWeight );

    if( originalWeight > getDimentionalWeight ) {
        countWeightAmnt = originalWeight * 6;
    }

    const countTotalAmnt = getItemValuePercent + countWeightAmnt + 10;

    if( $('#item_value').val() > 0 && countWeightAmnt !== 0 ) {
        
        const areaCount = (length*height*width)/366,
            area_total_inch = areaCount/0.032808;

        $('#total').html(countTotalAmnt.toFixed(2));
        $('#totalValue').val(countTotalAmnt.toFixed(2));
        $('#area_total').val(area_total_inch.toFixed(2));

        $('#total').show();
        // $('#totalh').show();
    }else {
        $('#total').html("0.00");
        $('#totalValue').val(0);
    }

}

function calculation() {
    var weight = $('#weight').val();
    // alert(weight);
    var length = $('#length').val();
    var height = $('#height').val();
    var width = $('#width').val();
    var quantity = $('#quantity').val();
    var url = base_url + 'home/calculation';
    $.ajax({
        type: "POST",
        url: url,
        data: {
            width: width,
            height: height,
            length: length,
            weight: weight,
            quantity: quantity
        },
        beforeSend: function () {
            $('#total').hide();
            $('#totalh').hide();
            $('.load').show();
        },

    }).done(function (response) {
        toastr.remove();
        var data = JSON.parse(response);
        $('.load').hide();
        $('#total').show();
        $('#totalh').show();
        if (data.status == 1) {
            $('#session').val(data.session);
            $('#total').html(data.amount.toFixed(2));
            $('#totalValue').val(data.amount);
            $('#area_total').val(data.area_total);
            $('#service_id').val(data.service_id);
        } else {
            // toastr.error(data.message);
            $('#totalValue').val('');
            $('#total').html("0.00");

        }

    });
} //end of function
 
 //sea calculation 
function sea_calculation() {
    var sea= $('#item_sea').find(':selected').attr('data');
    $('#id').val(sea);

    var colorselector = $('#delveryType').val();
    var promo = $('#promo').val();
    var item_sea = $('#item_sea').val();
    var quantity_sea = $('#quantity_sea').val();
    var item_courier = $('#item_courier').val();
    var quantity_courier = $('#quantity_courier').val();
    var amount = item_sea * quantity_sea;
    if (promo == 1) {
        var discount_percent = 10;
        var amount = item_sea * quantity_sea;
        var dec = (amount / 100).toFixed(2); //its convert 10 into 0.10
        var mult = dec * discount_percent ; // gives the value for subtract from main value
        var discont = amount - mult;
            $('#total_sea').html(discont.toFixed(2));
            $('#totalValue_sea').val(discont);
    }
    else{
        $('#total_sea').html(amount.toFixed(2));
        $('#totalValue_sea').val(amount);
    }
} //end of function
sea_calculation();

 //sea calculation 
function courier_calculation() {
    var courier_id = $('#item_courier').find(':selected').attr('data');
    $('#id1').val(courier_id);
    var colorselector = $('#delveryType').val();
    var promo = $('#promo').val();
    var item_courier = $('#item_courier').val();
    var quantity_courier = $('#quantity_courier').val();
    var amount = item_courier * quantity_courier;
    if (promo == 1) {
        var discount_percent = 10;
        var amount = item_courier * quantity_courier;
        var dec = (amount / 100).toFixed(2); //its convert 10 into 0.10
        var mult = dec * discount_percent ; // gives the value for subtract from main value
        var discont = amount - mult;
            $('#total_courier').html(discont.toFixed(2));
            $('#totalValue_courier').val(discont);
    }
    else{
        $('#total_courier').html(amount.toFixed(2));
        $('#totalValue_courier').val(amount);
    }
   
} //end of function
courier_calculation();

function all_calculation(){
    sea_calculation();
    courier_calculation();

}

//function for accept and reject concierge order

function accept_concierge(flag, id) {
    var url = base_url + 'order/accept_reject_concierge';
    if (flag == 1) {
        var message = 'accept';
    }

    if (flag == 2) {
        var message = 'reject';
    }
    bootbox.confirm({
        message: "Are you sure, you want to " + message + " this offer ?",


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
                $.ajax({
                    type: "POST",
                    url: url,
                    data: {
                        flag: flag,
                        id: id
                    },
                    beforeSend: function () {
                        show_loader();
                        $('#buttons1').hide();
                        $('#buttons2').show();
                    },

                }).done(function (response) {
                    toastr.remove();
                    var data = JSON.parse(response);
                    hide_loader();

                    if (data.status == 1) {
                        setTimeout(function () {
                            window.location = data.url
                        },
                            2000)
                        toastr.success(data.message);

                    } else if (data.status == -1) {
                        //authetication failed
                        toastr.error(data.msg);
                        window.setTimeout(function () {
                            window.location.href = data.url;
                        }, 2000);
                    } else {
                        $('#buttons1').show();
                        $('#buttons2').hide();
                        toastr.error(data.message);


                    }

                });

            }
        },
    });
}//end of function

//function for adding ticket
$("#add_ticket").validate({
    ignore: [],
    rules: {

        title: {
            required: true
        },
        description: {
            required: true
        }
    },
});

var add_ticket = $("#add_ticket");
$('body').on('click', '#submitTicket', function (event) {
    toastr.remove();
    event.preventDefault();

    if (add_ticket.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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

                setTimeout(function () {
                    window.location = data.url
                },
                    2000)
                if (data.flag == '') {
                    toastr.success(data.message);
                }
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

// ticket list Datatable
if ($("#ticketList").length) {
    var ticketList = $("#ticketList").DataTable({
        // responsive: true,
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
            url: base_url + "ticket/get_ticket_list",
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
            className: "text-right detailoption", "targets": [5]
        },
        ],
    });
}

// past order list Datatable
if ($("#pastOrderList").length) {
    var pastOrderList = $("#pastOrderList").DataTable({
        // responsive: true,
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
            url: base_url + "order/get_past_order_list",
            type: "POST",
            dataType: "json",
           data: function (res) {
                var type_filter = jQuery("#type_filter123").val();
                res.type =  type_filter;
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
            className: "text-right detailoption", "targets": [5]
        },
        ],
    });
}



// current order list Datatable
if ($("#currentOrderList").length) {
    var pastOrderList = $("#currentOrderList").DataTable({
        // responsive: true,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server side processing mode.
        lengthChange: false,
        order: [], //Initial no order.
        iDisplayLength: 20,
        "language": {
            "zeroRecords": "No orders found",
            "infoFiltered" : ""
          },

        // Load data for the table's content from an Ajax source
        ajax: {
            url: base_url + "order/get_current_order_list",
            type: "POST",
            dataType: "json",
            data: function (res) {
                var status_filter = jQuery("#status_filter").val();
                var type_filter = jQuery("#type_filter").val();
                // $('.dataTables_empty').html('jhfjd');
                res.status =  status_filter;
                res.type =  type_filter;
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
            className: "text-right detailoption", "targets": [5]
        },
        ],
    });
}



// current order list Datatable
if ($("#conciergeOrderList").length) {
    var pastOrderList = $("#conciergeOrderList").DataTable({
        // responsive: true,
        processing: true, //Feature control the processing indicator.
        serverSide: true, //Feature control DataTables' server side processing mode.
        lengthChange: false,
        order: [], //Initial no order.
        iDisplayLength: 20,
        "language": {
            "zeroRecords": "No orders found",
            "infoFiltered" : ""
          },
        // Load data for the table's content from an Ajax source
        ajax: {
            url: base_url + "order/get_concierge_order_list",
            type: "POST",
            dataType: "json",
            data: function (res) {
                var status_filter = jQuery("#status_filter_concierge").val();
                res.status =  status_filter;
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
            className: "text-right detailoption", "targets": [5]
        },
        ],
    });
}

var filter_fun = function () {   
        // var status_filter = jQuery("#status_filter").val();
        $('#conciergeOrderList').DataTable().ajax.reload();
        $('#currentOrderList').DataTable().ajax.reload();
    }

    var filter_fun123 = function () {   
        // var status_filter = jQuery("#status_filter").val();
        $('#pastOrderList').DataTable().ajax.reload();
    }

$(document).on('change', '#ticket-status', function () {
    ticketList.draw();
});

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

var scrollHeightElement = document.getElementById("content");
var is_next = '0';

//ajax funnction to get_comment_list_view
function get_comment_list_view(is_load_more = 0) {

    if (!$('#content').length) {
        return;
    }
    if (is_load_more != 0) {
        //if is_load_more is not 0 then get offset data from btnlod attr
        offset = $('#btnLoadViewMe').attr("data-offset");
    } else {
        //set offset =0 when is_load_more is 0
        offset = 0;
    }

    ticketId = $('#ticketID').val();

    $.ajax({
        url: base_url + "ticket/comment_list_ajax",
        type: "POST",
        data: { offset: offset, ticketId: ticketId },
        dataType: "JSON",
        success: function (data) {

            if (data.no_record == 0) {//show data in div when no previous record
                $("#conversation #content").html(data.html_receive);
            } else {
                //append data when already record show in view
                $("#conversation #content").prepend(data.html_receive);
                $("#btnLoadViewMe").attr("data-offset", data.new_offset);
                is_next = data.is_next;
            }

            $('#total').text(data.count);

            if (is_load_more != 0) {

                $('#conversation').animate({
                    scrollTop: Number(scrollHeightElement.scrollHeight - $('#conversation').attr("scroll-height"))
                }, 500);
                $("#conversation").attr("scroll-height", $('#conversation').prop("scrollHeight"));
            } else {
                $('#conversation').scrollTop(scrollHeightElement.scrollHeight, scrollHeightElement.scrollHeight);
                $("#conversation").attr("scroll-height", $('#conversation').prop("scrollHeight"));
            }

            fancyboxLoad();

        },
    });
}//End function


function commentScroll() {
    //console.log('sc:',scrollHeightElement.scrollTop);

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

function getCompanyName() {
    var tracking_id = $('#tracking_id').val();
    var url = base_url + "order/getCompanyName";
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: {
            tracking_id: tracking_id,
        },
        beforeSend: function () {
            $('#total_courier').hide();
            $('#totalh').hide();
            $('.load').show();
        },

    }).done(function (data) {
        toastr.remove();
        if (data.status == 1) {
            $('#company_name').val(data.company_name);
        } else {
            // toastr.error(data.message);
            $('#company_name').val('');

        }

    });
}//end of cuntion

//fuunction for document upload

function upload_reciept(value, id) {
    var url = base_url + 'order/upload_reciept';
    // var file_name = value.value;
    var file_name = $('#invoice')[0].files[0];
    console.log(file_name);
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    formData.append('file_name', file_name);
    formData.append('id', id);
    // console.log(file_name);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            show_loader();
        },

    }).done(function (data) {
        toastr.remove();
        if (data.status == 1) {
            toastr.success(data.message);
            // $('#onrefresh').hide();
            // $('#norefresh').show();
            // $('.preview').attr('src', data.image);
            // $("#downloadImageName").val(data.image_name);
            setTimeout(function () {
                location.reload();
            },
                2000)
            hide_loader();
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
};



function downloadResource(urls, file_name) {
    // var file_name = $("#downloadImageName").val();
    // var file_name = 'djfkdf'

    var url = base_url + 'order/download_reciept';
    // var file_name = value.value;
    // var file_name = $('#invoice')[0].files[0];
    console.log(file_name);
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    formData.append('file_name', file_name);
    formData.append('urls', urls);
    // console.log(file_name);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            show_loader();
        },

    }).done(function (data) {
        toastr.remove();
        if (data.status == 1) {
            // toastr.success(data.message);
            $('#onrefresh').hide();
            $('#norefresh').show();
            var a = $("<a>")
                .attr("href", data.image)
                .attr("download", data.image)
                .appendTo("body");

            a[0].click();

            a.remove();
            hide_loader();
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
}


//Signup Form Validation
var updateprofile = $("#update");
updateprofile.validate({
    ignore: [],
    rules: {
        name: {
            required: true,
            maxlength: 100
        },
        phone: {
            required: true,
            maxlength: 12,
        },
    },
    messages: {
        phone: {
            maxlength: 'Please enter no more than 10 numbers',
            number: 'Please enter number only',
        },
    }
});

//Signup submit action
$('body').on('click', '#updateUserDetail', function () {
    toastr.remove();

    if (updateprofile.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {

                toastr.success(data.msg);
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

                toastr.error(data.msg);
            }
        }
    });
});

//Signup Form Validation
var update = $("#change_password");
update.validate({
    ignore: [],
    rules: {
        old_password: {
            required: true,
            minlength: 5
        },
        new_password: {
            required: true,
            minlength: 5
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#new_password"
        }
    },
    messages: {
        phone: {
            maxlength: 'Please enter no more than 10 numbers',
            number: 'Please enter number only',
        },
    }
});

//Signup submit action
$('body').on('click', '#submit_password', function () {
    toastr.remove();

    if (update.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {

                toastr.success(data.msg);
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

                toastr.error(data.msg);
            }
        }
    });
});

function upload_id(value, id) {
    var url = base_url + 'user/upload_id';
    // var file_name = value.value;
    var file_name = $('#file_name')[0].files[0];
    console.log(file_name);
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    formData.append('file_name', file_name);
    formData.append('id', id);
    // console.log(file_name);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            show_loader();
        },

    }).done(function (data) {
        toastr.remove();
        if (data.status == 1) {
            toastr.success(data.message);
            $('#onrefreshid').hide();
            $('#norefreshid').show();
            $('#previewid').attr('src', data.image);

            hide_loader();
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
};


function delete_id(id) {
    var url = base_url + 'user/delete_id';
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');
    formData.append('id', id);
    // console.log(file_name);
    $.ajax({
        type: "POST",
        url: url,
        dataType: "JSON",
        data: formData,
        processData: false,
        contentType: false,
        beforeSend: function () {
            show_loader();
        },

    }).done(function (data) {
        toastr.remove();
        if (data.status == 1) {
            toastr.success(data.message);
            $("#cross_id").hide();
            $("#onrefreshid").hide();
            $("#norefreshid").hide();

            hide_loader();
        } else {
            hide_loader();
            toastr.error(data.message);

        }
    });
};

var newslatters = $("#newsletter");
newslatters.validate({
    ignore: [],
    rules: {
        email: {
            required: true,
        }
    },
});

// newsletter submit action
$('body').on('click', '#newsletter_submit', function () {
    //alert('hiii');
    toastr.remove();

    if (newslatters.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {

                toastr.success(data.message);
                window.setTimeout(function () {
                    location.reload();
                }, 1000);
            } else {

                toastr.error(data.message);
            }
        }
    });
});

var contactUs = $("#contactUs");
contactUs.validate({
    ignore: [],
    rules: {
        name: {
            required: true,
            maxlength: 100
        },
        email: {
            required: true,
            email: true,
            maxlength: 100
        },
        subject: {
            required: true,
            maxlength: 150
        },
        message: {
            required: true,
            maxlength: 300
        },
    },
    messages: {
        subject: {
            maxlength: 'Please enter no more than 150 Characters',
        },
        message: {
            maxlength: 'Please enter no more than 300 Characters',
        },
    }
});

//contact us submit action
$('body').on('click', '#contact_submit', function (e) {
    toastr.remove();
    // event.preventDefault();

    if (contactUs.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {
                toastr.success(data.msg);
                window.setTimeout(function () {
                    window.location.href = data.url;
                }, 1000);
            } else {
                toastr.error(data.msg);
            }
        },
        error: function (jqXHR, textStatus, errorThrown) {
            toastr.error(err_unknown);
        }
    });
});

//auto grow ticket textarea
var ta = document.getElementById('comment-text');
if ($('#comment-text').length) {
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
}

$(document).ready(function(){
  $("#email").keydown(function(){
    $("#inError").hide();

  });
});

// upload id proof new 
//Signup Form Validation
var upload_id_proof = $("#id_proof");
update.validate({
    ignore: [],
    rules: {
        file_name: {
            required: true,
            minlength: 5
        },
        new_password: {
            required: true,
            minlength: 5
        },
        confirm_password: {
            required: true,
            minlength: 5,
            equalTo: "#new_password"
        }
    },
    messages: {
        phone: {
            maxlength: 'Please enter no more than 10 numbers',
            number: 'Please enter number only',
        },
    }
});
$('body').on('click', '#upload_id_proof', function () {
    toastr.remove();

    if (upload_id_proof.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

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
        complete: function () {
            hide_loader();
        },
        success: function (data, textStatus, jqXHR) {
            if (data.status == 1) {

                toastr.success(data.msg);
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

                toastr.error(data.msg);
            }
        }
    });
});