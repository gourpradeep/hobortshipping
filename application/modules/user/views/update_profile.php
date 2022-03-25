<!doctype html>
<div class="mainWrapper innerPageWrapper">
   <section class="cprofilePage sec-pad-30">
      <div class="container">
         <div class="row">
            <div class="col-md-5 col-lg-4">
               <!-- <div class="boxViewShadow"> -->
                  <div class="boxBody">
                     <div class="prMyInfo">


                        <!-- <?php if(!empty($userData->avatar)){?>
                        <img src="<?php echo getenv('S3_USER_AVATAR_THUMB').$userData->avatar ?>">
                        <?php }else{?>
                        <img src="<?php echo getenv('S3_USER_PLACEHOLDER_AVATAR');?>" id="pImg">
                        <?php }?> -->
                        <h1><?php echo !empty($userData->full_name)? $userData->full_name:'NA'; ?></h1>
                        <p><?php echo !empty($userData->email)?$userData->email:'NA'; ?></p>
                        <p><?php echo !empty($userData->phone_number)?$userData->phone_dial_code.'-'.$userData->phone_number:'NA'; ?></p>
                     </div>
                  </div>
               <!-- </div> -->
            </div>
            <div class="col-md-7 col-lg-8">
               <div class="boxViewBorder">
                  <div class="prTabs">
                     <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item active">
                           <a class="nav-link" id="csTab-tab" data-toggle="tab" href="#csTab" role="tab" aria-controls="csTab" aria-selected="true">Edit Profile</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="csTab1-tab" data-toggle="tab" href="#csTab1" role="tab" aria-controls="csTab1" aria-selected="false">Change Password</a>
                        </li>
                        <li class="nav-item">
                           <a class="nav-link" id="csTab2-tab" data-toggle="tab" href="#csTab2" role="tab" aria-controls="csTab2" aria-selected="false">ID Proof</a>
                        </li>
                     </ul>
                  </div>
                  <div class="boxBody">
                     <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="csTab" role="tabpanel" aria-labelledby="csTab-tab">
                           <div class="tabInnerCnt">
                              <div class="csForm floatLabelForm">
                                 <form action="<?php echo base_url('user/update_user_detail'); ?>"   id="update" method="post" enctype="multipart/form-data">
                                  <input type="hidden" name="user_id" id="user_id" value="<?php echo $userData->userID;?>">
                                    <!-- <div class="profilePic">
                                       <div class="log_div">
                                          <div class="imgProfile">
                                             
                                             <?php if(!empty($userData->avatar)){?>
                                             <img id="pImg" src="<?php echo getenv('S3_USER_AVATAR_THUMB').$userData->avatar ?>">
                                             <?php }else{?>
                                             <img src="<?php echo getenv('S3_USER_PLACEHOLDER_AVATAR');?>" id="pImg">
                                             <?php }?>
                                          </div>
                                       </div>
                                       <div class="uploadBtnBlk">
                                          <input accept="images/*" class="inputfile hideDiv" id="file-1" name="profileImages" onchange="document.getElementById('pImg').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file">
                                          <label for="file-1" class="">
                                          Upload Image
                                          </label>
                                          <p class="smInfoText">PNG and JPG formats supported. Max file size 10MB.</p>
                                       </div>
                                    </div> -->
                                    <div class="form-group">
                                       <div class="floatLabel">
                                          <label class="inLabel">Full Name</label>
                                          <input class="form-control" type="text" name="name" placeholder="Enter Full Name" value="<?php echo !empty($userData->full_name)? $userData->full_name:'NA'; ?>">
                                       </div>
                                    </div>
                                    <!-- <div class="form-group">
                                       <div class="floatLabel">
                                          <label class="inLabel">Address</label>
                                          <input class="form-control" type="text" name="address" placeholder="Enter Address" value="73 Schoolhouse Court Matthews, NC 28104">
                                       </div>
                                    </div> -->
                                    <div class="form-group">
                                       <div class="floatLabel">
                                          <label class="inLabel">Contact Number</label>
                                          <input type="hidden" name="country_code" id="country_code" value="<?php echo !empty($userData->country_code)? $userData->country_code:'NA'; ?>">
                                          <input type="hidden" name="dial_code" id="dial_code" value="<?php echo !empty($userData->phone_dial_code)? $userData->phone_dial_code:'NA'; ?>">
                                          <input class="form-control phone" type="tel" name="phone" id="phone" placeholder="Enter Number" value="<?php echo !empty($userData->phone_number)? $userData->phone_number:'NA'; ?>">
                                       </div>
                                    </div>
                                    <div class="form-group mt-20">
                                       <button href="#" type="button" id= "updateUserDetail" class="btn btnTheme ripple">Update Profile</button>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <div class="tab-pane fade show" id="csTab1" role="tabpanel" aria-labelledby="csTab1-tab">
                           <div class="tabInnerCnt">
                              <div class="csForm floatLabelForm">
							    	<form action="<?php echo base_url('user/change_password'); ?>"   id="change_password" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                       <div class="floatLabel">
                                       <input type="hidden" name="user_id" id="user_id" value="<?php echo $userData->userID;?>">
                                          <label class="inLabel">Old Password</label>
                                          <input class="form-control" type="password" name="old_password" id="old_password" placeholder="Enter Password">
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="floatLabel">
                                          <label class="inLabel">New Password</label>
                                          <input class="form-control" type="password" name="new_password" id="new_password" placeholder="Enter Password">
                                       </div>
                                    </div>
                                    <div class="form-group">
                                       <div class="floatLabel">
                                          <label class="inLabel">Confirm Password</label>
                                          <input class="form-control" type="password" name="confirm_password" id="confirm_password" placeholder="Enter Password">
                                       </div>
                                    </div>
                                    <div class="form-group mt-20">
                                       <button type="button" id="submit_password" class="btn btnTheme ripple">Update Password</a>
                                    </div>
                                 </form>
                              </div>
                           </div>
                        </div>
                        <?php 
						    $id_status = 'Not uploaded';
						    if(!empty($userData->id_proof_status)){

						    	if($userData->id_proof_status==1){
						    		$id_status = 'Pending';
						    	}elseif($userData->id_proof_status==2){

						    		$id_status = 'Verified';
						    	}else{
						    		$id_status = 'Rejected';
						    	}

						    }
						    $file_name = $userData->id_proof;
						    // pr($userData->id_proof);
						    ?>	

                        <div class="tab-pane fade show" id="csTab2" role="tabpanel" aria-labelledby="csTab2-tab">
                           <div class="csForm floatLabelForm">
                              <form action="<?php echo base_url('user/upload_id_new'); ?>"   id="id_proof" method="post" enctype="multipart/form-data">
                              <div class="d-flex align-items-center flex-wrap">

                                 <div class="uploadedId" id="uploadedId">
                                    <label>Uploaded ID</label>
                                    <div class="upload-id-img-1-1">
                                       <img src="<?php echo getenv('S3_ID_PROOF_MEDIUM').$file_name;?>">
                                       <span id="closed" class="removeID material-icons-outline md-close"></span>
                                    </div>
                                 </div>
                                 <div class="uploadNewId">
                                    <div class="form-group">
                                       <div class="floatLabel">
                                          <label class="inLabel">Update ID Proof</label>
                                          <div class="fileField">
                                             <label class="form-control">
                                             	<input type="hidden" name="user_id" id="user_id" value="<?php echo $userData->userID;?>">

                                                <input class="form-control phone" type="file" name="file_name" placeholder="Enter Number">
                                                <span>Choose File</span>
                                                <p class="btn btnTheme">Choose File</p>
                                             </label>
                                          </div>
                                          <p class="smInfoText">Minimum size should be 200x200px</p>
                                       </div>
                                    </div>
                                    <div class="mt-10">
                                       <button type="button" id="upload_id_proof" class="btn btnTheme ripple">Update</button>
                                    </div>
                                 </div>
                              </div>
                              </form>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.0/css/intlTelInput.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        setTimeout(function(){
           var library = $('#library').val();
           var input = document.querySelector("#phone");
           // window.intlTelInput(input, {
           //     utilsScript: "build/js/utils.js",
           // });
          //console.log( $("#countryCode").val());
          var iti = window.intlTelInput(input, {
              initialCountry:  $("#country_code").val(),
              separateDialCode:true,
              // initialCountry: "in",
                 dropdownContainer: document.body,
                 utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js",
          });
         
          input.addEventListener("countrychange", function() {
           // do something with iti.getSelectedCountryData()
              var countryData = iti.getSelectedCountryData();
              var countryDialCode = countryData.dialCode;
              var countryCode     = countryData.iso2;
              $('#dial_code').val(countryDialCode);
              $('#country_code').val(countryCode);
          });
        },800);
   
     }); //document ready ends here

	$("#closed").click(function(){
		$('#uploadedId').val();
		$('#uploadedId').hide();
});
</script>