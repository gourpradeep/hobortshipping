<link href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/css/intlTelInput.css" rel="stylesheet" media="screen">

<div class="mainWrapper innerPageWrapper">
            <section class="lsSec sec-pad-30">
                <div class="container">
                    <div class="lsBlk">
                        <div class="lsBox">
                            <div class="lsHead">
                                <span class="material-icons-outline md-login"></span>
                                <h2>Sign up for an Hobort Account</h2>
                            </div>
                            <div class="lsBody csForm floatLabelForm">
                                <form action="<?php echo base_url('auth/user_signup'); ?>" class="form-horizontal" method="POST" id="signup">

                                    <input type="hidden" name="jsonData" id="jsonData" value='<?php echo !empty($jsonData)?$jsonData:''; ?>'>
                                    <!-- <div class="profilePic">
                                        <div class="log_div">
                                            <div class="imgProfile">
                                                <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>user-acnt-icn.png" id="pImg">
                                            </div>
                                        </div>
                                        <div class="uploadBtnBlk">
                                            <input accept="images/*" class="inputfile hideDiv" id="file-1" name="avatar" onchange="document.getElementById('pImg').src = window.URL.createObjectURL(this.files[0])" style="display: none;" type="file" accept="image/jpg,image/jpeg,image/png">
                                            <label for="file-1" class="">
                                            Upload Image
                                            </label>
                                            <p class="smInfoText">PNG and JPG,JPEG formats supported. Max file size 10MB.</p>
                                        </div>
                                    </div> -->
                                    <div class="form-group">
                                        <div class="floatLabel">
                                            <label class="inLabel">Full Name<span class="reqStar">*</span></label>
                                            <input class="form-control" type="text" name="name" placeholder="Enter Full Name">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="floatLabel">
                                            <label class="inLabel">Email<span class="reqStar">*</span></label>
                                            <input class="form-control" type="text" name="email" id="email" placeholder="Enter Email">
                                        </div>
<!--                                         <span class="inError" id="inError">This field is required.</span>
 -->                                    </div>
                                    <div class="form-group">
                                        <div class="floatLabel">
                                            <label class="inLabel">Password<span class="reqStar">*</span></label>
                                            <input class="form-control" type="password" name="password" placeholder="Enter Password">
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="floatLabel">
                                        <input type="hidden" name="country_code" id="country_code" value="us">
                                          <input type="hidden" name="dial_code" id="dial_code" value="1">
                                            <label class="inLabel">Contact Number<span class="reqStar">*</span></label>
                                            <input class="form-control phone" id="phone" type="tel" name="phone">
                                            <!--  <span id="valid-msg" class="hide">Valid</span>
                                             <span id="error-msg" class="hide">Invalid number</span> -->
                                             <!-- <input class="form-control phone" type="text" name="phone_number" placeholder="Enter Number"> -->
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <div class="floatLabel">
                                            <label class="inLabel">Upload ID Proof<span class="reqStar">*</span></label>
                                            <div class="fileField">
                                                <label class="form-control">
                                                    <input class="form-control phone" type="file" name="idproof" id="idproof" placeholder="Enter Number" accept="image/jpg,image/jpeg,image/png">
                                                    <span>Choose File</span>
                                                    <p class="btn btnTheme">Choose File</p>
                                                </label>
                                            </div>
                                            <p class="smInfoText">PNG and JPG,JPEG formats supported And Minimum size should be 200x200px</p>
                                        </div>
                                    </div>
                                    <div class="signupTerms">
                                        <div class="control cpedding">
                                            <label class="control--checkbox">
                                             <input type="checkbox" id="box-1" name="check">

                                              <div class="control__indicator"></div>
                                              <h2>Apply <a href="javascript:void(0)" data-toggle="modal" data-target="#termCondModal">Terms & Conditions</a></h2>
                                              <!-- <h2>Apply <a target="_blank" href="<?php echo base_url('terms')?>">Terms & Conditions</a></h2> -->
                                            </label>
                                        </div>
                                    </div>
                                    <div class="form-group lsAct mt-20" id="signup_submit">
                                        <button type="button" href="" class="btn btnTheme ripple">Create Account</button>
                                    </div>
                                    <div class="lstext">
                                        <p>Already have an account? <a href="<?php echo base_url().'auth/login'?>">Log In</a></p>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.0/css/intlTelInput.css">

        <!-- Terms and Conditions modal -->
        <div class="modal fade" id="termCondModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modalWidth terms_conditions" role="document">
                <div class="modal-content">
                    <div class="modal-header change-status-heading">
                        <h5 class="modal-title" id="term-condition">Terms and Conditions</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="trm-secsd mt-15">
                    <div class="trm-title">
                    <?php echo $terms;?>
                 </div>
                </div>
                </div>
            </div>
        </div>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/intlTelInput.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.3/js/intlTelInput.min.js"></script>

<script type="text/javascript">
   $('#id1').hide();

   $(document).ready(function(){
      setTimeout(function(){
         var library = $('#library').val();
         var input = document.querySelector("#phone");
         // window.intlTelInput(input, {
         //     utilsScript: "build/js/utils.js",
         // });
        //console.log( $("#countryCode").val());
        var iti = window.intlTelInput(input, {
            initialCountry:  $("#countryCode").val(),
            separateDialCode:true,
            initialCountry: "us",
               dropdownContainer: document.body,
               utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/11.0.9/js/utils.js",
        });
        // iti.setCountry("us");
        input.addEventListener("countrychange", function() {
         // do something with iti.getSelectedCountryData()
            var countryData = iti.getSelectedCountryData();
            var countryDialCode = countryData.dialCode;
            var countryCode     = countryData.iso2;
            $('#dial_code').val(countryDialCode);
            $('#country_code').val(countryCode);
        });
      },800);

      $("#hide").click(function(){
         $("#id1").hide();
         $("#idproof").val('');
      });

   }); //document ready ends here

   function readURL(input) {
      if (input.files && input.files[0]) {
         var reader = new FileReader();
         reader.onload = function (e) {
               $('#profile-img-tag').attr('src', e.target.result);
         }
         reader.readAsDataURL(input.files[0]);
      }
   }

   $("#profile-img").change(function(){
      readURL(this);
   });

   function readURLd(input) {
        if (input.files && input.files[0]) {
            var reader = new FileReader();
            
            reader.onload = function (e) {
                $('#idproof-img-tag').attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        }
   }

   $("#idproof").change(function(){
      $('#id1').show();
      readURLd(this);
   });
</script>