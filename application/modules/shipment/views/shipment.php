 <div class="mainWrapper innerPageWrapper">
            <section class="orderDetails sec-pad-30 bgImg">
                <div class="container">
                    <div class="addMyShipment">
                        <div class="row justify-content-center">
                            <!-- <div class="col-lg-5 col-md-6">
                                <div class="boxViewShadow">
                                    <div class="boxBody">
                                        <div class="orderInfoBlk">
                                            <h2 class="orderDelType">Courier & Express Services</h2>
                                            <div class="orderMoreInfo">
                                                <ul>
                                                    <li>Item : <span>Furniture1 - $78.00</span></li>
                                                    <li>Price : <span>$78.00</span></li>
                                                    <li>Quantity: <span>1</span></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <div class="col-lg-7 col-md-6">
                                <div class="boxViewBorder">
                                    <div class="boxBody">
                                        <div class="lsHead">
                                            <span class="material-icons-outline md-account_circle"></span>
                                            <h2>Add Shipment Info</h2>
                                        </div>
                                        <div class="csForm floatLabelForm">
                                             <form action="<?php echo base_url('shipment/add_shipper_info');?>" method="POST" id="add_my_shipper">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Shipper Name<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="shipper_name" placeholder="Enter Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Receiver Name<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="receiver_name" placeholder="Enter Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Origin<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="origin" placeholder="Enter Origin">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Total Value<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="total_value" placeholder="Enter Value">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="floatLabel">
                                                        <label class="inLabel">Content<span class="reqStar">*</span></label>
                                                        <textarea rows="4" class="form-control" type="text" name="description" placeholder="Enter Description"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="floatLabel">
                                                        <label class="inLabel">Tracking ID<span class="reqStar">*</span></label>
                                                        <input class="form-control" type="text" name="req_tracking_id" placeholder="Enter Tracking ID">
                                                        <div class="trackIdBlk">
                                                            <div class="moreTrackId">
                                                                <input class="form-control" type="text" name="tracking_id[]" placeholder="Enter Tracking ID">
                                                                <label class="icoDeleteId material-icons-outline md-close"></label>
                                                            </div>
                                                            <div class="moreTrackId addMoreAct">
                                                                <button type="button" class="btn btn-outline-info" id="addService">Add More ID</button>
                                                            </div>

                                                            <!-- <div id="contain"> 
                                                                <div>
                                                                <input type="text" name='+value+'[]>
                                                                <button type="button" class="addService">Add More</button>
                                                                </div>
                                                                </div>
 -->
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button id="add_my_shipment" class="btn btnTheme" type="button">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
     <script type="text/javascript">
        $("#addService").click(function () {
    $(".moreTrackId:last").before('<div class="moreTrackId"><input class="form-control" type="text" name="tracking_id[]" placeholder="Enter Tracking ID"> <label class="icoDeleteId material-icons-outline md-close"></label> </div>');
});
        
$('.trackIdBlk').on('click', '.icoDeleteId', function () {
    $(this).parent().remove();
});
     </script>