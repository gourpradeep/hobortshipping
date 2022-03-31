<?php 
   $header_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'header';
   $content_images = getenv('APP_FRONT_ASSETS_IMAGES') . 'content';
   ?>
<style type="text/css">
   .load {
   height: 15px;
   width: 15px;
   }
   .modal-open{
      padding-right:0px !important;
   }
   #quotesModl{
      padding-right:0px !important;
   }
   #tracking_id-error {
    color: red;
    float: left;
    margin-right: 0px;
   }
   p.disclaim_clsd {
    font-size: 13px;
    margin: 0px;
    margin-left: 5px;
    color: #333;
}
</style>
<div class="mainWrapper">
   <section class="bannerSec">
      <div class="container custom-container">
      <div class="bannerText">
         <div class="row">
            <div class="col-md-7 mx-auto">
            <div class="bannerCntBlk">
               <div class="bannerCnt">
                  <div class="bannerTrack animate__animated animate__zoomIn">
                     <h3 class="mb-0">Track Your Shipment</h3>
                     <form action="<?php echo base_url('home/track')?>" class="form-horizontal" method="GET" id="track">
                        <div class="tackBox">
                           <input type="text" name="tracking_id" id="tracking_id" placeholder="Enter your tracking number">
                           <button id="track_sub" class="nb btn btnTheme" type="submit" onclick="csAdd()">Track Order Now</button>
                        </div>
                     </form>
                  </div>
               </div>
            </div>
               <div class="animate__animated animate__fadeInDown text-center pt-4">
                     <h2>Freight & Logistics Services</h2>
                     <!-- <p>There are many variations of passages of Lorem Ipsum available, but the majority have suffered alteration in some form, by injected humour, or randomised words which don't look even slightly believable. If you are going to use a passage of Lorem Ipsum, you need to be sure there isn't anything embarrassing hidden in the middle of text.</p> -->
               </div>
            </div>
         </div>
         
      </div>
      </div>
   </section>
   <section class="requestQuote sec-pad-50">
   <div class="quoteHead">
      <h1>Request A Quote</h1>
   </div>
         <div class="container custom-container">
         <div class="row">
               <div class="col-lg-10 mx-auto">
                  <div class="quoteForm animate__animated animate__fadeInLeft p-3">
                     <div class="quoteBody">      
                           <div class="csForm">                           
                        <div class="form-group mb-3">
                           <label class="inLabel">Delivery Type</label>
                           <select class ="form-control CsSelect" id="delveryType" onclick="all_calculation();">
                              <?php foreach (getAllDelivery() as $key => $value) { ?>
                              <option value="<?php echo $value['id']?>"><?php echo $value['value']?></option>
                              <?php
                                 } ?>
                           </select>
                        </div>
                        
                        <div id="delBox1" class="forAir delTypeBox" style="display: block;">
                           <form action="<?php echo base_url('home/add_air_freight');?>" method="POST" id="add_air_freight_qoute" autocomplete="off">
                              <div class="form-group mb-3">
                                 <label class="inLabel">Item Details</label>
                                 <div class="row">
                                    <div class="col-md-6 col-6 mb-3">
                                       <div class="input-group mb-3">
                                          <input type="hidden" name="area_total" id="area_total">
                                          <input type="hidden" name="service_id" id="service_id">
                                          <!-- <input type="text" class="form-control" placeholder="Length"> -->
                                          <input  type="number" onkeyup="calculateQuoteAmnt();" name="length" id="length" class="form-control rdbCss" placeholder="Length" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Inches</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-6 mb-3">
                                       <div class="input-group mb-3">
                                          <!--  <input type="text" class="form-control" placeholder="Height"> -->
                                          <input type="number" onkeyup="calculateQuoteAmnt();" name="height" id="height" class="form-control rdbCss" placeholder="Height" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Inches</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-6 mb-3">
                                       <div class="input-group">
                                          <!--  <input type="text" class="form-control" placeholder="Width"> -->
                                          <input type="number" onkeyup="calculateQuoteAmnt();" name="width" id="width" class="form-control rdbCss" placeholder="Width" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Inches</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-6 mb-3">
                                       <div class="input-group">
                                          <!--  <input type="text" class="form-control" placeholder="Weight"> -->
                                          <input type="number" name="weight" id="weight" class="form-control rdbCss" onkeyup="calculateQuoteAmnt();" placeholder="Weight" autocomplete="off">
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
                                 <div class="col-md-6 mb-3">
                                    <div class="form-group">
                                       <label class="inLabel">Item Value</label>
                                       <!--  <input type="text" class="form-control" placeholder="Enter Value"> -->
                                       <input type="number" placeholder="Item Value" name="item_value"  class="form-control" id="item_value" onkeyup="calculateQuoteAmnt()">
                                    </div>
                                 </div>
                                 <div class="col-md-6 mb-3">
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
                                    <h2><b>Total Amount </b><div><span id="totalh"><b>$</b></span><span id="total"><b>00.00</b></span></div><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png"></h2>
                                    <!--                                                              <h2><span id="totalh">$</span><span id="total"> 00.00</span>
                                       -->                                                        
                                 </div>
                              </div>
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
                              <div class="form-group mb-3">
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
                              <div class="form-group mb-3">
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
                                 <h2><b>Total Amount</b><div> <span id="totalh"><b>$</b></span><span id="total_sea"><b>00.00</b></span><dv><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png"></h2>
                                    <!-- <h2>Total Amount<span id="totalh">$</span><span id="total_sea">00.00</span><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png">
                                    </h2> -->
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
                                    <h2>Total Amount<div><span id="totalh">$</span><span id="total_courier">00.00</span><div><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png"></h2>
                                 </div>
                                 <input type="hidden" name="totalValue_courier" id="totalValue_courier">
                                 <input type="hidden" name="service_id_courier" id="service_id_courier">

                                 <div class="form-group">
                                    <button href="javascript:void(0);" id="submitCourier" class="btn btnTheme btn-block">Continue</button>
                                 </div>
                              </div>
                           </form>
                        </div> -->

                        <!-- <div id="delBox3" class="forCourier delTypeBox">
                           <form action="<?php echo base_url('home/add_air_freight');?>"  method="POST" id="add_air_freight_qoute" autocomplete="off">
                              <div class="form-group">
                                 <label class="inLabel">Item Details</label>
                                 <div class="row">
                                    <div class="col-md-6 col-6">
                                       <div class="input-group mb-3">
                                          <input type="hidden" name="area_total" id="area_total">
                                          <input type="hidden" name="service_id" id="service_id">
                                          
                                          <input  type="number" onkeyup="calculation();" name="length" id="length" class="form-control" placeholder="Length" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Inches</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                       <div class="input-group mb-3">
                                       
                                          <input type="number" onkeyup="calculation();" name="height" id="height" class="form-control" placeholder="Height" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Inches</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                       <div class="input-group">
                     
                                          <input type="number" onkeyup="calculation();" name="width" id="width" class="form-control" placeholder="Width" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Inches</span>
                                          </div>
                                       </div>
                                    </div>
                                    <div class="col-md-6 col-6">
                                       <div class="input-group">
                                          
                                          <input type="number" name="weight" id="weight" class="form-control" onkeyup="calculation();" placeholder="Weight" autocomplete="off">
                                          <div class="input-group-append">
                                             <span class="input-group-text" id="basic-addon2">Pound</span>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                              <input type="hidden" name="totalValue" id="totalValue">
                              <div class="form-group">
                                 <label class="inLabel">Item</label>
                                 <select class="form-control CsSelect" name="item" id="item">
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
                                    
                                       <input type="number" placeholder="Item Value" name="item_value"  class="form-control" id="item_value" autocomplete="off">
                                    </div>
                                 </div>
                                 <div class="col-md-6">
                                    <div class="form-group">
                                       <label class="inLabel">Quantity</label>
                                       
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
                                    <h2>Total Amount <div><span id="totalh">$</span><span id="total">00.00</span></div><img style="display: none;" id="load" class="load" src="<?php echo $content_images;?>/load.png"></h2>
                                                                                       
                                 </div>
                              </div>
                  
                              <div class="form-group">
                                 <button href="javascript:void(0);" id="submit" class="btn btnTheme btn-block">Continue</button>
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
                     <!--  <div class="form-group">
                        <button type="button" class="btn btnTheme btn-block">Continue</button>
                        </div> -->
                     <!--                                     </form>
                        -->                                
                  </div>
               </div>
            </div>
      </div>
         </div>
   </div>
</section>

<section class="servicesSec bg-light sec-pad-50">
   <div class="container custom-container">
      <div class="secTitle text-center">
         <h2>INTERNATIONAL SHIPPING COMPANY</h2>
         <!-- <p>This is Photoshop's version of Lorem Ipsum. Proin gravida nibh vel velit auctor aliquet.</p> -->
      </div>
      <div id="serviceSlider" class="owl-carousel owl-theme extra-space serviceSliderBlk">
            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/1.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute  animate__animated animate__zoomIn">
                        <i class="fas fa-fighter-jet"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>Air Freight</h3>
                           <p>Hobort can meet all your transportation needs globally by our best Air Freight Services. Whether you're flying finished goods or raw material or equipment, you can count on us to get your freight where it's going - on time. </p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase"  href="<?php echo base_url('services')?>#sr1">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>
            

            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/2.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute  animate__animated animate__zoomIn">
                        <i class="fas fa-ship"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>Sea Freight</h3>
                           <p>At Hobort we place value and understand the importance of providing a reliable and consistent international freight service. We have developed a full range of freight forwarding services.</p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr2">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>
            
            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/4.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute  animate__animated animate__zoomIn">
                        <i class="fas fa-truck"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>Courier & Express Services</h3>
                           <p>From a small envelope or package to a full truckload, we are committed to offering superior levels of essential service with the most flexible options for your time-sensitive deliveries.</p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr4">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>
            

            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/5.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute animate__animated animate__zoomIn">
                        <i class="fas fa-warehouse"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>Customs brokers</h3>
                           <p>At Hobort, we process hundreds of international packages on a daily basis. With brokerage facilities in the top world markets, we cover the global trading centers where you do business with consistency, reliability, and flexibility.</p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr5">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>
            

            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/6.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute animate__animated animate__zoomIn">
                        <i class="fas fa-box"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>Freight consolidation</h3>
                           <p>Many of our customers ship from and to the same centers and destinations, so we can consolidate your smaller shipments with others to deliver to the same consignees.</p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr6">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>
            

            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/7.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute animate__animated animate__zoomIn">
                        <i class="fas fa-truck-loading"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>General cargo</h3>
                           <p>Hobort offers a very professional cargo handling service to facilitate and to fulfill our commitment to our clients.</p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr7">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>


            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                        <div class="ft-service-img position-relative">
                        <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/8.jpg"> -->
                        </div>
                        <div class="ft-service-text-icon position-relative">
                        <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute animate__animated animate__zoomIn">
                        <i class="fas fa-shapes"></i>
                     </div>
                     <div class="ft-service-text position-relative headline pera-content">
                           <h3>Large and oversize freight</h3>
                           <p>Shipping large and oversized cargo is a matter of detail, proper planning, execution and this is what we offer our client.</p>
                     </div>
                     <div class="more-btn position-absolute">
                           <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr8">Read More <i class="fas fa-arrow-right"></i></a>
                     </div>
                        </div>
                     </div>
               </div>
           

            <div class="item">
               <div class="ft-service-innerbox-3 position-relative">
                     <div class="ft-service-img position-relative">
                     <!-- <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>services/9.jpg"> -->
                     </div>
                     <div class="ft-service-text-icon position-relative">
                     <div class="ft-service-icon d-flex align-items-center justify-content-center position-absolute animate__animated animate__zoomIn">
                     <i class="fas fa-shipping-fast"></i>
                  </div>
                  <div class="ft-service-text position-relative headline pera-content">
                        <h3>Door 2 Door</h3>
                        <p>Service for small and medium-sized businesses. Shipping cargo door-to-door, over land and sea, our team will help you focus on what you do best by taking care of the logistics.</p>
                  </div>
                  <div class="more-btn position-absolute">
                        <a class="d-flex align-items-center justify-content-center text-uppercase" href="<?php echo base_url('services')?>#sr9">Read More <i class="fas fa-arrow-right"></i></a>
                  </div>
                     </div>
                  </div>
            </div>
            

</section>
</div>
<script type="text/javascript">
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

   // ===============================================================================

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