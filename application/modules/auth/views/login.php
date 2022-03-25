<div class="mainWrapper innerPageWrapper">
   <section class="lsSec sec-pad-30">
      <div class="container">
         <div class="lsBlk">
            <div class="lsBox">
               <div class="lsHead">
                  <span class="material-icons-outline md-login"></span>
                  <h2>Login To Your Account</h2>
               </div>
               <div class="lsBody csForm floatLabelForm">
                  <form action="<?php echo base_url('auth/user_login');?>" class="form-horizontal" method="POST" id="user_login">
                     <input type="hidden" name="jsonData" id="jsonData" value='<?php echo !empty($jsonData)?$jsonData:''; ?>'>                                    
                     <div class="form-group">
                        <div class="floatLabel">
                           <label class="inLabel">Email<span class="reqStar">*</span></label>
                           <input class="form-control" type="text" name="email" id="email" placeholder="Enter Email">
                        </div>
<!--                         <span class="inError" id="inError">This field is required.</span>
 -->                     </div>
                     <div class="form-group">
                        <div class="floatLabel">
                           <label class="inLabel">Password<span class="reqStar">*</span></label>
                           <input class="form-control" type="password" name="password" placeholder="Enter Password">
                        </div>
                     </div>
                     <div class="fPWD text-right">
                        <a href="javascript:void(0);" data-toggle="modal" data-target="#forgotPassword">Forgot Password?</a>
                     </div>
                     <div class="form-group lsAct mt-20">
                        <button type="button" id="login_submit" name="login_submit" href="" class="btn btnTheme ripple">Log In</button>
                     </div>
                     <?php if(!empty($_GET)){?>
                     <div class="lstext">
                        <p>Don't have acount? <a href='<?php echo base_url('auth/signup?'.$jsonData); ?>'>Create An Account</a> </p>
                     </div>
                     <?php }else{ ?>
                     <div class="lstext">
                        <p>Don't have account? <a href="<?php echo base_url('auth/signup'); ?>">Create An Account</a> </p>
                     </div>
                     <?php }?>
                     <!-- div class="lstext">
                        <p>Don't have acount? <a href="<?php echo base_url().'auth/signup'?>">Create An Account</a></p>
                        </div> -->
                  </form>
               </div>
            </div>
         </div>
      </div>
   </section>
</div>
<div class="modal csModal csSmModal fade" id="forgotPassword" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <!-- <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
            </div> -->
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span class="material-icons-outline md-close"></span>
         </button>
         <div class="modal-body">
            <div class="modaldHeader">
               <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>resetpassword.png">
               <h2>Reset your password</h2>
               <p>Enter your email address and we'll send you a link to reset your password.</p>
            </div>
            <div class="modalCnt">
               <div class="csForm">
                  <!--   <form>
                     <div class="form-group">
                         <div class="floatLabel">
                             <label class="inLabel">Email<span class="reqStar">*</span></label>
                             <input class="form-control" type="text" name="" placeholder="Enter Email">
                         </div>
                     </div>
                     </form> -->
                  <form action="<?php echo base_url('auth/forgot_password');?>" id="reset_password">
                     <div class="form-group">
                        <div class="floatLabel">
                           <label class="inLabel">Email<span class="reqStar">*</span></label>
                           <input type="email" name="email" id="email" class="form-control" placeholder="Enter email">
                        </div>
                     </div>
                     <div class="modal-footer ">
                        <button type="button" class="btn btnSecondary" data-dismiss="modal">Close</button>
                        <button type="button" id="password_submit" class="btn btnTheme">Submit</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>
</body>
</html>