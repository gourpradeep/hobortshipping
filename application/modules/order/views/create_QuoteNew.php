   <div class="mainWrapper innerPageWrapper">
            <section class="orderDetails sec-pad-30 bgImg">
                <div class="container">
                    <div class="addMyShipment">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-7">
                                <div class="boxViewBorder">
                                    <div class="boxBody">
                                        <div class="lsHead quoteHead">
                                            <span class="material-icons-outline md-account_circle"></span>
                                            <h2>Create Quote</h2>
                                        </div>
                                        <div class="quoteBody">

<!--                                             <form class="csForm">
 -->                                                <div class="form-group">
                                                    <label class="inLabel">Delivery Type</label>
                                                   <!--  <select id="delveryType" class="form-control CsSelect">
                                                        <option value="1">Air freight</option>
                                                        <option value="2">Sea freight</option>
                                                        <option value="3">Courier &amp; Express services</option>
                                                        <option value="4">Concierge Shipping</option>
                                                    </select> -->
                                                    <select id="delveryType" class="form-control CsSelect" onclick="all_calculation();">
                                                    <?php foreach (getAllDelivery() as $key => $value) { ?>
                                                        <option value="<?php echo $value['id']?>"><?php echo $value['value']?></option>
                                                        <?php
                                                    } ?>
                                                    <!-- <option value="red">Air freight</option> -->
                                                    <!-- <option value="yellow">Sea freight</option>
                                                    <option value="blue">Courier & Express services</option>
                                                    <option value="black">Concierge Shopping</option> -->
                                                </select>
                                                </div>
                                                <form class="csForm" action="<?php echo base_url('home/add_air_freight');?>"  method="POST" id="add_air_freight_qoute" autocomplete="off">

                                                <div id="delBox1" class="forAir delTypeBox" style="display: block;">
                                                    <div class="form-group">
                                                        <label class="inLabel">Item Details</label>
                                                         <input type="hidden" name="area_total" id="area_total">
                                                <input type="hidden" name="service_id" id="service_id">
                                                        <div class="row">
                                                            <div class="col-md-6 col-6">
                                                                <div class="input-group mb-3">
                                                                  <!-- <input type="text" class="form-control" placeholder="Length"> -->
                                                                   <input  type="number" onkeyup="calculation();" name="length" id="length" class="form-control" placeholder="Length" autocomplete="off">
                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">Feet</span>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <div class="input-group mb-3">
                                                                  <!-- <input type="text" class="form-control" placeholder="Height"> -->
                                                                  <input type="number" onkeyup="calculation();" name="height" id="height" class="form-control" placeholder="Height" autocomplete="off">
                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">Feet</span>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <div class="input-group">
                                                                  <!-- <input type="text" class="form-control" placeholder="Width"> -->
                                                        <input type="number" onkeyup="calculation();" name="width" id="width" class="form-control" placeholder="Width" autocomplete="off">

                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">Feet</span>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-6 col-6">
                                                                <div class="input-group">
                                                                 <!--  <input type="text" class="form-control" placeholder="Weight"> -->
                                                                  <input type="number" name="weight" id="weight" class="form-control" onkeyup="calculation();" placeholder="Weight" autocomplete="off">
                                                                  <div class="input-group-append">
                                                                    <span class="input-group-text" id="basic-addon2">LB</span>
                                                                  </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inLabel">Item</label>
                                                       <!--  <select class="form-control CsSelect">
                                                            <option value="1">Air freight</option>
                                                            <option value="2">Sea freight</option>
                                                            <option value="3">Courier &amp; Express services</option>
                                                            <option value="4">Concierge Shipping</option>
                                                        </select> -->
                                                         <select  class="form-control CsSelect" name="item" id="item">
                                                                <?php foreach ($air_freight_item as $key => $value) {
                                                                 ?>
                                                                <option value="<?php echo $value->airFreightItemID;?>"><?php echo $value->title;?></option>
                                                            <?php }?>
                                                            </select>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="inLabel">Item Value</label>
                                                                <input type="text" class="form-control" name="item_value" placeholder="Enter Value">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label class="inLabel">Quantity</label>
                                                               <!--  <select class="form-control CsSelect">
                                                                    <option value="1">1</option>
                                                                    <option value="2">2</option>
                                                                    <option value="3">3</option>
                                                                    <option value="4">4</option>
                                                                    <option value="4">5</option>
                                                                </select> -->
                                                                <select class="form-control CsSelect" name="quantity" id="quantity" onchange="calculation()">
                                                                <?php foreach (getAllPosition() as $key => $value) { ?>
                                                                
                                                                <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                                               <?php } ?>
                                                            </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="quoteAmt">
                                                            <h2>Total Amount <span id="total">$00.00</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="delBox2" class="forSea delTypeBox">
                                                    <div class="form-group">
                                                        <label class="inLabel">Item</label>
                                                        <select class="form-control CsSelect">
                                                            <option value="1">Small box(Heavy) - $5.00</option>
                                                            <option value="2">Small box(Light) - $5.00</option>
                                                            <option value="3">Laptop (Light) - $5.00</option>
                                                            <option value="4">Container (Heavy) - $56.00</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inLabel">Quantity</label>
                                                        <select class="form-control CsSelect">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="4">5</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="quoteAmt">
                                                            <h2>Total Amount <span>$00.00</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="delBox3" class="forCourier delTypeBox">
                                                    <div class="form-group">
                                                        <label class="inLabel">Item</label>
                                                        <select class="form-control CsSelect">
                                                            <option value="1">Small box(Heavy) - $5.00</option>
                                                            <option value="2">Small box(Light) - $5.00</option>
                                                            <option value="3">Laptop (Light) - $5.00</option>
                                                            <option value="4">Container (Heavy) - $56.00</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label class="inLabel">Quantity</label>
                                                        <select class="form-control CsSelect">
                                                            <option value="1">1</option>
                                                            <option value="2">2</option>
                                                            <option value="3">3</option>
                                                            <option value="4">4</option>
                                                            <option value="4">5</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <div class="quoteAmt">
                                                            <h2>Total Amount <span>$00.00</span></h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="delBox4" class="forConcierge delTypeBox">
                                                    <div class="form-group">
                                                        <label class="inLabel">Write Detail Here</label>
                                                        <textarea class="form-control" id="concierge_detail" name="concierge_detail" rows="5"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button id="submit" type="button" class="btn btnTheme btn-block">Continue</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-5 col-md-5">
                                <div class="boxViewShadow quoteImgBlk">
                                    <div class="quoteImg">
                                        <img src="<?php echo getenv(APP_FRONT_ASSETS_IMAGES)?>service_img_2.jpg">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>