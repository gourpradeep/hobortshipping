<!-- Change-status-modal -->
<div class="modal fade" id="common_model" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog area-width" role="document">
      <div class="modal-content">
         <div class="modal-header change-status-heading">
            <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
         </div>
         <div class="modal-body">
            <div class="trackingBox">
               <div class="trackingInfo">
                  <div class="drop-address addFlex">
                     <div class="addBlk">
                     <?php if(!empty($orderData->drop_location)){?>
                        <p>Dropped Address</p>
                        <h6><i class="fas fa-map-marker-alt mr-2"></i><?php echo !empty($orderData->drop_location)?ucfirst($orderData->drop_location):'NA'; ?></h6>
                     <?php }?>
                     </div>
                     <div class="text-right">
                        <div class="dropdown dropsection">
                           <a class="dropdown-toggle btn" data-toggle="dropdown" href="#">
                           Change Status
                           <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu dropdown-menu-form drpdwn-section" role="menu">
                              <input type="hidden" name="check_value" id="check_value" value="">
                              <input type="hidden" name="order_id" id="order_id" value="<?php echo $orderData->orderID; ?>">
                              <li>
                                 <label class="checkbox">
                                 <input type="checkbox" class="checkboxes"  <?php if($orderData->status >2){echo "checked";} ?>  statusValue="3">
                                 Package Received at our warehouse
                                 </label>
                              </li>
                              <li>
                                 <label class="checkbox">
                                 <input type="checkbox" class="checkboxes" <?php  if($orderData->status >=4 || $orderData->status <= 2){echo "disabled";} ?>  <?php  if($orderData->status >=4){echo "checked";} ?> statusValue="4">
                                 Package preparing to ship
                                 </label>
                              </li>
                              <li>
                                 <label class="checkbox" >
                                 <input type="checkbox" class="checkboxes" <?php  if($orderData->status >=5 || $orderData->status <= 3){echo "disabled";} ?>  <?php  if($orderData->status >=5){echo "checked";} ?> statusValue="5">
                                 Shipment dropped off at Atlanta Airport
                                 </label>
                              </li>
                              <li>
                                 <label class="checkbox">
                                 <input type="checkbox" class="checkboxes" <?php  if($orderData->status >=6 || $orderData->status <= 4){echo "disabled";} ?>  <?php  if($orderData->status >=6){echo "checked";} ?> statusValue="6">
                                 Shipment in Transit
                                 </label>
                              </li>
                              <li>
                                 <label class="checkbox">
                                 <input type="checkbox" class="checkboxes" <?php  if($orderData->status >=7 || $orderData->status <= 5){echo "disabled";} ?>  <?php  if($orderData->status >=7){echo "checked";} ?> statusValue="7">
                                 Shipment Arrived in Accra
                                 </label>
                              </li>
                              <li>
                                 <label class="checkbox">
                                 <input type="checkbox" class="checkboxes" <?php  if($orderData->status >=8 || $orderData->status <= 6){echo "disabled";} ?>  <?php  if($orderData->status >=8){echo "checked";} ?> statusValue="8">
                                 Customs Clearance Started
                                 </label>
                              </li>
                              <li>
                                 <label class="checkbox">
                                 <input type="checkbox" class="checkboxes" <?php  if($orderData->status >=9 || $orderData->status <= 7){echo "disabled";} ?>  <?php  if($orderData->status >=9){echo "checked";} ?> statusValue="9">
                                 Shipment Cleared
                                 </label>
                              </li>

                              <button type="button" id="submitStatus" class="btn btn-secondary dn-btn text-center">Done</button>
                           </ul>
                        </div>
                     </div>
                  </div>
                  <div class="trackId noBorder">
                     <p>Tracking Id: <b>#<?php echo !empty($orderData->tracking_id)?$orderData->tracking_id:'NA'; ?></b></p>
                  </div>
                  <?php
                     $orderStatus = json_decode($orderData->status_updated_at);
                     ?>
                  <div class="stepBlocks">
                     <ul class="StepProgress">
                        <li class="StepProgress-item <?php if($orderData->status >=3 ){ echo 'is-done';}elseif($orderData->status==2){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Package Received at our warehouse</h4>
                                 <!-- <p>Order placed on 23rd Dec 2019</p> -->
                                 <?php if($orderData->status >=3){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->approved_at)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                        </li>
                        <li class="StepProgress-item <?php if($orderData->status >=4 ){ echo 'is-done';}elseif($orderData->status==3){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Package preparing to ship</h4>
                                 <?php if($orderData->status >=4){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->package_preparing_to_ship)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                        </li>
                        <li class="StepProgress-item <?php if($orderData->status >=5){ echo 'is-done';}elseif($orderData->status==4){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Shipment dropped off at Atlanta Airport</h4>
                                 <?php if($orderData->status >=5){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->shipment_dropped_off_at_atlanta_airport)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                           <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                        </li>
                        <li class="StepProgress-item <?php if($orderData->status >=6){ echo 'is-done';}elseif($orderData->status==5){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Shipment in Transit</h4>
                                 <?php if($orderData->status >=6){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->shipment_in_transit)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                           <!-- <button type="button" class="btn btn-secondary approve-btn float-right">Change</button> -->
                        </li>
                        <li class="StepProgress-item <?php if($orderData->status>=7){ echo 'is-done';}elseif($orderData->status==6){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Shipment Arrived in Accra</h4>
                                 <?php if($orderData->status >=7){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->ahipment_arrived_in_accra)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                        </li>
                        <li class="StepProgress-item <?php if($orderData->status>=8){ echo 'is-done';}elseif($orderData->status==7){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Customs Clearance Started</h4>
                                 <?php if($orderData->status >=8){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->customs_clearance_started)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                        </li>
                        <li class="StepProgress-item <?php if($orderData->status>=9){ echo 'is-done';}elseif($orderData->status==8){ echo 'current'; }else{echo '';}?>">
                           <div class="stepItem">
                              <div class="stepInfo">
                                 <h4>Shipment Cleared</h4>
                                 <?php if($orderData->status >=9){?>
                                 <p><?php echo date('d M Y', strtotime($orderStatus->shipment_cleared)); ?></p>
                                 <?php }?>
                              </div>
                           </div>
                        </li>

                     </ul>
                  </div>
               </div>
            </div>
         </div>
         <!-- <div class="modal-footer status-btn">
            <button type="button" class="btn btn-primary">Change</button>
            
            </div> -->
      </div>
   </div>
</div>