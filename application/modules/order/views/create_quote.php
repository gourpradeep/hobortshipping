<?php 
$header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
$content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
?>
<style type="text/css">
    .load {
      height: 15px;
    width: 15px;
}
</style>
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
                        <div class="quoteBody csForm">
                           <div class="form-group">
                              <label class="inLabel">Delivery Type</label>
                              <!-- <select id="delveryType" class="form-control CsSelect">
                                 <option value="1">Air freight</option>
                                 <option value="2">Sea freight</option>
                                 <option value="3">Courier &amp; Express services</option>
                                 <option value="4">Concierge Shipping</option>
                                 </select> -->
                              <select class="form-control CsSelect" id="delveryType" onclick="all_calculation();">
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
                           <div id="delBox1" class="forAir delTypeBox" style="display: block;">
                              <form action="<?php echo base_url('home/add_air_freight');?>"  method="POST" id="add_air_freight_qoute" autocomplete="off">
                                 <div class="form-group">
                                    <label class="inLabel">Item Details</label>
                                    <div class="row">
                                       <div class="col-md-6 col-6">
                                          <div class="input-group mb-3">
                                             <input type="hidden" name="area_total" id="area_total">
                                             <input type="hidden" name="service_id" id="service_id">
                                             <!-- <input type="text" class="form-control" placeholder="Length"> -->
                                             <input  type="number" onkeyup="calculateQuoteAmnt();" name="length" id="length" class="form-control" placeholder="Length" autocomplete="off">
                                             <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Inches</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-6">
                                          <div class="input-group mb-3">
                                             <!--  <input type="text" class="form-control" placeholder="Height"> -->
                                             <input type="number" onkeyup="calculateQuoteAmnt();" name="height" id="height" class="form-control" placeholder="Height" autocomplete="off">
                                             <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Inches</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-6">
                                          <div class="input-group">
                                             <!--  <input type="text" class="form-control" placeholder="Width"> -->
                                             <input type="number" onkeyup="calculateQuoteAmnt();" name="width" id="width" class="form-control" placeholder="Width" autocomplete="off">
                                             <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Inches</span>
                                             </div>
                                          </div>
                                       </div>
                                       <div class="col-md-6 col-6">
                                          <div class="input-group">
                                             <!--  <input type="text" class="form-control" placeholder="Weight"> -->
                                             <input type="number" name="weight" id="weight" class="form-control" onkeyup="calculateQuoteAmnt();" placeholder="Weight" autocomplete="off">
                                             <div class="input-group-append">
                                                <span class="input-group-text" id="basic-addon2">Pound</span>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                                 <input type="hidden" name="totalValue" id="totalValue">
                                 <!-- <div class="form-group">
                                    <label class="inLabel">Item</label>
                        
                                    <select class="form-control CsSelect" name="item" id="item">
                                       <?php foreach ($air_freight_item as $key => $value) {
                                          ?>
                                       <option value="<?php echo $value->airFreightItemID;?>"><?php echo $value->title;?></option>
                                       <?php }?>
                                    </select>
                                 </div> -->
                                 <div class="row">
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="inLabel">Item Value</label>
                                          <!--  <input type="text" class="form-control" placeholder="Enter Value"> -->
                                          <input type="number" placeholder="Item Value" name="item_value"  class="form-control" id="item_value" onkeyup="calculateQuoteAmnt()" autocomplete="off">
                                       </div>
                                    </div>
                                    <div class="col-md-6">
                                       <div class="form-group">
                                          <label class="inLabel">Quantity</label>
                                          <!--    <select class="form-control CsSelect">
                                             <option value="1">1</option>
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
                                 <div class="form-group">
                                    <div class="quoteAmt">
                                       <h2>Total Amount<div><span id="totalh">$</span><span id="total">00.00</span></div><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png"></h2>
                                       <!--                                                              <h2><span id="totalh">$</span><span id="total"> 00.00</span>
                                          -->                                                        
                                    </div>
                                 </div>
                                 <!-- <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                                    <a href="javascript:void(0);" id="submit" class="btn csBtn">Continue</a>
                                 </div> -->

                                 <div class="signupTerms">
                                    <div class="control mb-3">
                                       <!-- <label class="control--checkbox"> -->
                                       <!-- <div>
                                          <input type="checkbox" id="disclaimer" name="check">
                                          <div class="control__indicator"></div>
                                       </div> -->
                                          <p class="disclaim_clsd"><b>Disclaimer:</b> This is an estimate and not FINAL Charge. Final Charges will be determined upon receipt of your shipment.</p>
                                       <!-- </label> -->
                                    </div>
                                 </div>
                                  <div class="form-group">
                                    <button href="javascript:void(0);" id="submit" class="btn btnTheme btn-block">Continue</button>
                                 </div>
                              </form>
                           </div>
                           <div id="delBox2" class="forSea delTypeBox">
                              <form action="<?php echo base_url('home/add_air_freight');?>"  method="POST" id="add_sea_freight_qoute">
                                 <input type="hidden" name="id" id="id" value="">
                                 <div class="form-group">
                                    <label class="inLabel">Item</label>
                                    <?php  if(!empty($_SESSION['app_user_sess'])){
                                       $session =1;}
                                       else{$session =0; 
                                           }?>
                                    <input type="hidden" name="" id="session_check" value="<?php echo $session?>">
                                    <input type="hidden" name="" id="promo" value="<?php echo $sea_calculation->promo_applicable?>">
                                    <input type="hidden" name="" id="id" value="<?php echo $value->seaFreightServiceID?>">
                                    <!-- <select class="form-control CsSelect">
                                       <option value="1">Small box(Heavy) - $5.00</option>
                                       <option value="2">Small box(Light) - $5.00</option>
                                       <option value="3">Laptop (Light) - $5.00</option>
                                       <option value="4">Container (Heavy) - $56.00</option>
                                       </select> -->
                                    <select class="form-control CsSelect" name="item_sea" id="item_sea" onchange="sea_calculation()">
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
                                 <div class="form-group">
                                    <label class="inLabel">Quantity</label>
                                    <input type="hidden" name="" id="promo" value="<?php echo $sea_calculation->promo_applicable?>">
                                    <!-- 
                                       <select class="form-control CsSelect">
                                           <option value="1">1</option>
                                           <option value="2">2</option>
                                           <option value="3">3</option>
                                           <option value="4">4</option>
                                           <option value="4">5</option>
                                       </select> -->
                                    <select class="form-control CsSelect" name="quantity_sea" id="quantity_sea" onchange="sea_calculation()">
                                       <?php foreach (getAllPosition() as $key => $value) { ?>
                                       <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <div class="quoteAmt">
                                         
                                       <h2>Total Amount<div><span id="totalh">$</span><span id="total_sea">00.00</span></div><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png">
                                       </h2>
                                    </div>
                                    <input type="hidden" name="totalValue_sea" id="totalValue_sea">
                                    <input type="hidden" name="service_id_sea" id="service_id_sea">
                                 </div>
                                <!--  <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 mt-3">
                                    <a href="javascript:void(0);" id="submitSea" class="btn csBtn">Continue</a>
                                 </div> -->
                                  <div class="form-group">
                                    <button href="javascript:void(0);" id="submitSea" class="btn btnTheme btn-block">Continue</button>
                                 </div>
                              </form>
                           </div>
                           <!-- <div id="delBox3" class="forCourier delTypeBox">
                              <form action="<?php echo base_url('home/add_air_freight');?>"  method="POST" id="add_courier_freight_qoute">
                                 <input type="hidden" name="id1" id="id1" value="">
                                 <div class="form-group">
                                    <label class="inLabel">Item</label>
                                  
                                    <select class="form-control CsSelect" name="item_courier" id="item_courier" onchange="courier_calculation()">
                                       <?php foreach ($courier_freight_item as $key => $value) {
                                          ?>
                                       <option  value="<?php echo $value->price;?>"data="<?php echo $value->courierServiceID;?>"><?php echo $value->title.' - '.'$'.$value->price;?></option>
                                       <?php }?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <label class="inLabel">Quantity</label>
                                    
                                    <select class="form-control CsSelect" name="quantity_courier" id="quantity_courier" onchange="courier_calculation()">
                                       <?php foreach (getAllPosition() as $key => $value) { ?>
                                       <option value="<?php echo $value['value'];?>"><?php echo $value['value'];?></option>
                                       <?php } ?>
                                    </select>
                                 </div>
                                 <div class="form-group">
                                    <div class="quoteAmt">
                                      
                                       <h2>Total Amount<div><span id="totalh">$</span><span id="total_courier">$00.00</span></div><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png"></h2>
                                    </div>
                                    <input type="hidden" name="totalValue_courier" id="totalValue_courier">
                                    <input type="hidden" name="service_id_courier" id="service_id_courier">
                                   
                                    <div class="form-group">
                                    <button href="javascript:void(0);" id="submitCourier" class="btn btnTheme btn-block">Continue</button>
                                 </div>
                                 </div>
                              </form>
                           </div> -->
                           <!-- <div id="delBox4" class="forConcierge delTypeBox">
                              <form action="<?php echo base_url('home/add_air_freight');?>"  method="POST" id="add_concierge_freight_qoute">
                                 <div class="form-group">
                                    <label class="inLabel">Write Detail Here</label>
                                    <textarea class="form-control" id="concierge_detail" name="concierge_detail" rows="5"></textarea>
                                 </div>
                                 <div class="form-group">
                                    <button href="javascript:void(0);" id="submitConcierge" class="btn btnTheme btn-block">Continue</button>
                                 </div>
                                 
                              </form>
                           </div> -->
                           
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

<script>
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
</script>