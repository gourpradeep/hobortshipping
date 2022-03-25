<div class="container-fluid">
    <div class="page-title-box box-spacing">
        <div class="row align-items-center">
        <div class="col-sm-6">
            <h4 class="page-title">New Order</h4>
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
        </div>
        </div>
    </div>
    <!-- end row -->
    <div class="customer-info customer-detail shipment-page">
        <div class="row">
            <div class="col-lg-10 col-10 col-md-10 shipment-alldetailsform">
                <div class="quoteBody">
                    <div class="form-group all-details-section">
                        <h6>Customer Name : <b><?php echo $dataUser->full_name ?></b></h6>
                    </div>
                    <div class="form-group all-details-section">
                        <label class="inLabel">Delivery Type</label>
                        <!-- <select id="delveryType" class="form-control CsSelect select2-hidden-accessible" data-select2-id="select2-data-delveryType" tabindex="-1" aria-hidden="true">
                            <option value="1" data-select2-id="select2-data-2-uq45">Air freight</option>
                            <option value="2">Sea freight</option>
                        </select> -->
                        <!-- <select class ="form-control CsSelect" id="delveryType" onclick="all_calculation();"> -->
                        <select id="delveryType" class="form-control CsSelect select2-hidden-accessible" onclick="all_calculation(); data-select2-id="select2-data-delveryType" tabindex="-1" aria-hidden="true">
                        <?php foreach (getAllDelivery() as $key => $value) { ?>
                        <option value="<?php echo $value['id']?>" data-select2-id="select2-data-2-uq45"><?php echo $value['value']?></option>
                        <?php
                            } ?>
                        </select>
                        <input type="hidden" name="usid" id="usid" value="<?php echo $id ?>">
                        <!-- for air type -->
                        <div id="delBox1" class="forAir delTypeBox" style="display: block;">
                            <form class="csForm" action="<?php echo base_url('admin/add_new_order');?>" method="POST" id="add_new_order_qoute" autocomplete="off">
                                <div class="form-group all-details-section">
                                    <label class="inLabel">Item Details</label>
                                    <div class="row">
                                        <input type="hidden" name="area_total" id="area_total">
                                        <input type="hidden" name="service_id" id="service_id">
                                        <input type="hidden" name="totalValue" id="totalValue">

                                        <div class="col-md-6 col-6">
                                            <div class="input-group mb-4" id="lenErr">
                                                <!-- <input type="number" class="form-control" placeholder="Length"> -->
                                                <input type="number" onkeyup="calculateQuoteAmnt();" name="length" id="length" class="form-control" placeholder="Length" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Inches</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="input-group mb-4" id="heightErr">
                                            <!-- <input type="number" class="form-control" placeholder="Height"> -->
                                            <input type="number" onkeyup="calculateQuoteAmnt();" name="height" id="height" class="form-control" placeholder="Height" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Inches</span>
                                            </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="input-group" id="widthErr">
                                                <!-- <input type="number" class="form-control" placeholder="Width"> -->
                                                <input type="number" onkeyup="calculateQuoteAmnt();" name="width" id="width" class="form-control" placeholder="Width" autocomplete="off">
                                                <div class="input-group-append">
                                                    <span class="input-group-text" id="basic-addon2">Inches</span>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6 col-6">
                                            <div class="input-group" id="weightErr">
                                            <!-- <input type="number" class="form-control" placeholder="Weight"> -->
                                            <input type="number" name="weight" id="weight" class="form-control" onkeyup="calculateQuoteAmnt();" placeholder="Weight" autocomplete="off">
                                            <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Pound</span>
                                            </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group all-details-section">
                                            <label class="inLabel">Item Value</label>
                                            <!-- <input type="text" class="form-control" placeholder="Enter Value"> -->
                                            <input type="number" placeholder="Item Value" name="item_value"  class="form-control" id="item_value" onkeyup="calculateQuoteAmnt()">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group all-details-section">
                                            <label class="inLabel">Quantity</label>
                                            <!-- <select class="form-control CsSelect select2-hidden-accessible" data-select2-id="select2-data-6-itwo" tabindex="-1" aria-hidden="true">
                                            <option value="1" data-select2-id="select2-data-8-zngq">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="4">5</option>
                                            </select> -->
                                            <select class="form-control CsSelect" name="quantity" id="quantity" onchange="calculateQuoteAmnt()">
                                            <?php foreach (getAllPosition() as $key => $value) { ?>
                                            <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                            <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="totl-amiuntsection">
                                    <div class="pricetotaltxt">
                                        <h2>Total Amount</h2>
                                    </div>
                                    <div class="pricetotal">
                                        <h3 id="total">$00.00</h3>
                                    </div>
                                </div>
                                <div class="form-group add-shipment-btn">
                                    <!-- <button type="button" class="btn btnTheme btn-block">Add New Order</button> -->
                                    <button type="button" id="newOrder" class="btn btnTheme btn-block">Add New Order</button>
                                </div>
                            </form>
                        </div>
                        
                        <!-- for sea type -->
                        <div id="delBox2" class="forAir delTypeBox" style="display: none;">
                            <form class="csForm" action="<?php echo base_url('admin/add_new_order');?>" method="POST" id="add_new_order_sea_qoute" autocomplete="off">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group all-details-section">
                                            <label class="inLabel">Item</label>
                                            <input type="hidden" name="service_id_sea" id="service_id_sea">
                                            <select class="form-control CsSelect" name="item_sea" id="item_sea" onchange="admin_sea_calculation()">
                                                <?php foreach ($sea_freight_item as $key => $value) {
                                                    if($value->type == 1){
                                                        $type = 'Light';
                                                    }else{
                                                        $type = 'Heavy';
                                                    
                                                    }
                                                    ?>
                                                <option value="<?php echo $value->price;?>" data="<?php echo $value->seaFreightServiceID;?>"><?php echo $value->title.'('.$type.')'.' - '.'$'.$value->price?></option>
                                                <?php }?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group all-details-section">
                                            <label class="inLabel">Quantity</label>
                                            <!-- <select class="form-control CsSelect select2-hidden-accessible" data-select2-id="select2-data-6-itwo" tabindex="-1" aria-hidden="true">
                                            <option value="1" data-select2-id="select2-data-8-zngq">1</option>
                                            <option value="2">2</option>
                                            <option value="3">3</option>
                                            <option value="4">4</option>
                                            <option value="4">5</option>
                                            </select> -->

                                            <select class="form-control CsSelect" name="quantity_sea" id="quantity_sea" onchange="admin_sea_calculation()">
                                                <?php foreach (getAllPosition() as $key => $value) { ?>
                                                <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                                <?php } ?>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="totl-amiuntsection">
                                    <div class="pricetotaltxt">
                                        <h2>Total Amount</h2>
                                    </div>
                                    <div class="pricetotal">
                                        <h3 id="total_sea">$00.00</h3>
                                    </div>
                                </div>
                                <div class="form-group add-shipment-btn">
                                    <!-- <button type="button" class="btn btnTheme btn-block">Add New Order</button> -->
                                    <button type="button" id="newSeaOrder" class="btn btnTheme btn-block">Add New Order</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(()=>{
        admin_sea_calculation();
    });

    $('#delveryType').change(function(){
        $('.delTypeBox').hide();
        $('#delBox' + $(this).val()).show();
    });

    $("#length").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#height").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#width").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#weight").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
    });
    $("#item_value").on("keyup", function(){
        var valid = /^\d{1,3}(\.\d{0,2})?$/.test(this.value),
            val = this.value;
        
        if(!valid){
            console.log("Invalid input!");
            this.value = val.substring(0, val.length - 1);
        }
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

//function for adding new order by admin
$("#add_new_order_qoute").validate({
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
        item_value: {
            required: true,
            min: 1
        }
    },
    errorPlacement: function (error, element) {
        if (element.attr("name") == "weight") {
            error.insertBefore("#weightErr");
        }else if (element.attr("name") == "height") {
            error.insertBefore("#heightErr");
        }else if (element.attr("name") == "length") {
            error.insertBefore("#lenErr");
        }else if (element.attr("name") == "width") {
            error.insertBefore("#widthErr");
        }else {
            error.insertAfter(element);
        }
        
        // if (element.attr("name") == "item_value") {
        //     error.insertAfter("#lable_item_value");
        // }
    }

});

var add_new_order_qoute = $("#add_new_order_qoute");

$('body').on('click', '#newOrder', function (e) {
	// e.preventDefault();
    const colorselector = $('#delveryType').val();
    var uid = $('#usid').val();
    // toastr.remove();
    // event.preventDefault();
    if (add_new_order_qoute.valid() === false) {
        toastr.error("Please fill all the fields before proceeding.");
        return false;
    }

    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

    formData.append('delivery_type', colorselector);
    formData.append('id', uid);

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
                // if (data.flag == '') {
                    toastr.success(data.message);
                // }
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

// for sea

//sea calculation 
function admin_sea_calculation() {
    var sea= $('#item_sea').find(':selected').attr('data');
    $('#service_id_sea').val(sea);

    var item_sea = $('#item_sea').val();
    var quantity_sea = $('#quantity_sea').val();
    var amount = item_sea * quantity_sea;
    
    $('#total_sea').html(amount.toFixed(2));
}

//function for adding sea freight qoute
$("#add_new_order_sea_qoute").validate({
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

var add_new_order_sea_qoute = $("#add_new_order_sea_qoute");
$('body').on('click', '#newSeaOrder', function (e) {
    var colorselector = $('#delveryType').val();
    var uid = $('#usid').val();
    
    if (add_new_order_sea_qoute.valid() === false) {
        toastr.error(proceed_err);
        return false;
    }
    var _that = $(this),
        form = _that.closest('form'),
        formData = new FormData(form[0]),
        f_action = form.attr('action');

    formData.append('delivery_type', colorselector);
    formData.append('id', uid);

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
                // if (data.flag == '') {
                toastr.success(data.message);
                // }
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
</script>