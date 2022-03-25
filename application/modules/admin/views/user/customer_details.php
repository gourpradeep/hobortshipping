<style type="text/css">
  .fltr{
    margin-bottom: 40px;
  }
  #allowClear{
    position: absolute;
    right: 16px;
  }
</style>

<div id="form-modal-box"></div>
<div class="content" id="common_model">
   <div class="container-fluid">
      <div class="page-title-box box-spacing">
         <div class="row align-items-center">
            <div class="col-sm-6">
               <h4 class="page-title">Customer Detail</h4>
               <ol class="breadcrumb">
                  <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
               </ol>
            </div>
         </div>
      </div>
      <!-- end row -->
      <div class="">
         <div class="customer-info">
            <div class="customer-detail">
               <div class="row">
                  <div class="col-lg-12 col-12">
                     <div class="vehicle-info-data wallet-info cstmr-info">
                        <div class="customer-img">
                           <input type="hidden" name="id" id="id" value="<?php echo $dataexist->userID?>">
                          
                              
                           <!-- if ($dataexist->avatar) {
                              $url = getenv('S3_USER_AVATAR_THUMB') . $dataexist->avatar;                
                           } else {
                              $url = getenv('S3_USER_PLACEHOLDER_AVATAR');
                           } -->
                                 
                           <img class="" src="<?php echo $url; ?>">
                           <div class="media-body ml-3 cstmr-text">
                              <h6 class="mt-0"><?php echo ucfirst($dataexist->full_name); ?></h6>
                              <p><?php echo $dataexist->email; ?></p>
                              <?php 
                                 if ($dataexist->status==1) { ?>
                              <span class="active-icon"><i class="typcn typcn-media-record"></i> Active</span>        <?php }?>
                              <?php
                                 if ($dataexist->status==0) { ?>
                              <span class="inactive"><i class="typcn typcn-media-record"></i>Inactive</span>        <?php }?>
                           </div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-12">
                     <div class="vehicle-info-data">
                        <div class="row">
                           <div class="col-lg-10 col-10">
                              <div class="row">
                                 <div class="col-lg-6 col-6">
                                    <div class="idproof-img">
                                       <div class="id-info">
                                          <h6>Id Proof</h6>
                                       </div>
                                       <?php 
                                          if ($dataexist->id_proof) {
                                            $idproof = getenv('S3_ID_PROOF_MEDIUM') . $dataexist->id_proof;                
                                          } 
                                          ?>
                                       <img style=""src="<?php echo $idproof;?>">
                                    </div>
                                    <div class="accept-reject-btn">
                                       <br>
                                       <?php if ($dataexist->id_proof_status == 2) { ?>
                                       <div class="active-icon" id="">Approved</div>
                                       <?php } ?>
                                       <?php  if ($dataexist->id_proof_status==3) { ?>
                                       <div class="inactive" id="">Rejected</div>
                                       <?php } ?>
                                       <?php if ($dataexist->id_proof_status==1) { ?>
                                       <a href="javascript:void(0)" onclick="myFunction(<?php echo $dataexist->userID?>,2,'ID Proof')" id="accept" class="accept">APPROVE</a>
                                       <a href="javascript:void(0)" onclick="myFunction(<?php echo $dataexist->userID?>,3,'ID Proof')" id="reject" class="deny">REJECT</a>
                                       <div class="active-icon" id="app">       Approved</div>
                                       <div class="inactive" id="rej">Rejected</div>
                                       <?php } ?>
                                    </div>
                                 </div>
                              </div>
                           </div>
                           <div class="col-lg-2 col-2"></div>
                        </div>
                     </div>
                  </div>
                  <div class="col-lg-12 col-12">
                     <div class="">
                        <div class="customer-info">
                           <div class="row">
                              <div class="float-right  mb-3 mt-3 mr-4 ml-3" id="select">
                                <!--  <select name="slct" id="service_type" onclick="filter_fun_status()">
                                    <div class=" mb-3 mt-3 mr-4 ml-3" id="selected"> -->
                              <select id="service_type" class="js-example-placeholder-multiple" multiple="multiple" name="slct1[]" oninput="filter_fun_status()" style="">
                                
                                    <option value="1">Air Freight</option>
                                    <option value="2">Sea Freight</option>
                                    <!-- <option value="3">Courier & Express Services</option> -->
                                    <!-- <option value="4">Concierge Shopping </option> -->
                                 </select>
                              </div>
                              <div class=" mb-3 mt-3 mr-4 ml-3" id="selected">
                              <select id="status_id" class="js-example-placeholder-multiple" multiple="multiple" name="slct[]" oninput="filter_fun_status1()" style="">
                                 <optgroup label="">
                                    <?php
                                       $statusArray = get_status();
                                       foreach ($statusArray as $key => $value) { 
                                       ?>
                                    <option value="<?php echo $value['id']; ?>"><?php echo $value['value']; ?></option>
                                    <?php }?>
                                 </optgroup>
                              </select>
                               <div class="fltr" >
                                 <button class="btn btn-primary" id="allowClear"  onclick="filter_status_click()" >Clear Filter</button>
                              </div>
                                  </div>


                             <!--  <div class="fltr" style="margin-bottom: 2%;">
                                 <button class="btn btn-primary" id="allowClear" style="margin-left: 871px;" onclick="filter_status_click()" >Clear Filter</button>
                              </div> -->
                           </div>

                           <div class="tab-content" id="pills-tabContent">
                              <div class="tab-pane fade show active" id="pills-profile" role="tabpanel" aria-labelledby="pills-profile-tab">
                                 <div class="row">
                                    <div class="col-lg-12 col-12">
                                       <div class="table-responsive">
                                          <table id="customer_details" class="table table-bordered dt-responsive nowrap" data-id="<?php echo $dataexist->userID; ?>" style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                             <thead class="thead-spacing">
                                                <tr>
                                                   <!-- <?php echo $dataexist->userID?> -->
                                                   <th scope="col">S.No.</th>
                                                   <th scope="col">Tracking ID</th>
                                                   <th scope="col">Service Type</th>
                                                   <!-- <th scope="col">Amount</th> -->
                                                   <th scope="col">Date & Time</th>
                                                   <th scope="col">Status</th>
                                                   <th scope="col" class="text-right">Action</th>
                                                </tr>
                                             </thead>
                                          </table>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
<!-- container-fluid -->

</div>
<!-- content -->
</div>
<!-- ============================================================== -->
<!-- End Right content here -->
<!-- ============================================================== -->
</div>
<!-- END wrapper -->
<!-- Change-status-modal -->
</div>
<script type="text/javascript">
   $('#rej').hide()
   $('#app').hide()
</script>
<script type="text/javascript">
   function filter_fun_status() {
     //alert(status);
       var status = jQuery(".js-example-basic-si").val();
       $('#customer_details').DataTable().ajax.reload();
        // }
   }
</script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.min.js"></script>
<script type="text/javascript">
    $('#status_id').select2({
        placeholder: "Status",
        allowClear: true,
        minimumResultsForSearch: -1
   
    });
     $('#service_type').select2({
        placeholder: "Service Type",
        allowClear: true,
        minimumResultsForSearch: -1
   
    });
</script>
<script type="text/javascript">
   function filter_fun_status1() {
       var status_id = jQuery(".js-example-basic-si").val();
       $('#customer_details').DataTable().ajax.reload();
      }
   
</script>
<script type="text/javascript">
   function filter_status_click(){
     $("#status_id").val('').trigger("change");
     $("#service_type").val('').trigger("change");
     $('#customer_details').DataTable().ajax.reload();
   }
</script>