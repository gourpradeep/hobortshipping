<div class="container-fluid">
   <div class="page-title-box box-spacing">
      <div class="row align-items-center">
         <div class="col-sm-6">
            <h4 class="page-title">Ticket Detail</h4>
            <ol class="breadcrumb">
               <!-- <li class="breadcrumb-item active">Welcome to Hobort</li> -->
            </ol>
         </div>
      </div>
   </div>
   <!-- end row -->
   <div class="">
      <div class="customer-info">
         <div class="p-3">
            <div class="row">
               <!-- <div class="col-md-1"></div> -->
               <div class="col-md-12">
                  <div class="orderInfo-1">
                     <section class="pastOrder">
                        <div class="">
                           <div class="row">
                              <!-- <div class="col-md-2"></div> -->
                              <div class="col-md-12">
                                 <div class="orderInfo pastOrderInfo ticket-detail">
                                    <div class="">
                                       <p>Tracking ID : <b>#<?php echo $detail->ticketID; ?></b> </p>
                                       <div class="status-pending text-right">
                                          <?php switch ($detail->status) {
                                            case '0':
                                              echo '<button type="button" class="btn pending-btn"> Pending </button>';
                                              break;

                                            case '1':
                                              echo '<button type="button" class="btn review-btn"> In Review </button>';
                                              break;
                                            
                                            case '2':
                                              echo '<button type="button" class="btn succuss-btn"> Completed </button>';
                                              break;
                                          } ?>
                                       
                                       </div>
                                    </div>
                                    <div class="description-scst">
                                       <h5>Title</h5>
                                       <p><?php echo $detail->title; ?></p>
                                    </div>
                                    <div class="text-right created-date">
                                       <span class=""> <b><?php echo date('d M Y',strtotime($detail->created_at)); ?></b></span>
                                    </div>
                                    <div class="description-scst">
                                       <h5>Description</h5>
                                       <p><?php echo $detail->description; ?></p>
                                    </div>
                                 </div>

                                 <div style="display:<?php echo ($detail->status < 2)? "block" : "none"; ?>">
                                    <h5>You can change status from here</h5>
                                    <button type="button" class="btn btn-primary mt-2" data-toggle="modal" data-target="#exampleModal" data-whatever="@mdo">Change Status</button>
                                 </div>

                                 <div style="display:<?php echo ($detail->status=='2')? "block" : "none"; ?>">
                                  <h6 class="text-warning">This ticket is closed now.</h6>
                                </div>

                              </div>
                              <!-- <div class="col-md-2"></div> -->
                           </div>
                        </div>
                     </section>
                     <section class="msger" id="admin-attechment-div">
                        <header class="msger-header">
                           <div class="msger-header-title">
                              <i class="fas fa-comment-alt"></i> Comment Section
                           </div>
                        </header>

                        <main class="msger-chat" id="admin-content" onscroll="commentScroll()"></main>
                        <div id="btnLoadViewMe"></div>

                        <form class="msger-inputarea form" action="<?php echo base_url('admin/ticket//add_comment');?>"  method="POST" id="add_comment" style="display:<?php echo ($detail->status < 2)? "block" : "none"; ?>">
                            <div class="sendBox">
                              <input type="hidden" name="ticket_id" value="<?php echo $detail->ticketID; ?>" id="ticketID">
                              <textarea  style name="comment" type="text" id="comment-text" class="msger-input" placeholder="Leave comment"></textarea>
                              <div class="file-upload-wrapper file-field btn-floating" data-text="Select your file!">
                                <label>
                                 <i class="fa fa-image" aria-hidden="true"></i>
                                 <input type="file" class="file-upload-field" name="comment_attechment" multiple onchange="commentAttechment(this)">
                                </label>
                                 <button type="submit" class="msger-send-btn" type="submit" id="comment-submit">Send</button>
                              </div>
                            </div>
                        </form>

                        <div class="sendBox" style="display:<?php echo ($detail->status=='2')? "block" : "none"; ?>">
                          <h6 class="text-center text-warning">This ticket is closed now. Comment disabled.</h6>
                        </div>

                     </section>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
</div>

<!-- Modal -->

<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
 <div class="modal-dialog" role="document">
   <div class="modal-content radio-modal">
     <div class="modal-header change-status-heading">
       <h5 class="modal-title" id="exampleModalLabel">Change Status</h5>
       <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span aria-hidden="true">&times;</span>
       </button>
     </div>
     <div class="modal-body">
       <div class="container">
           <div class="change-status-radio-btn"> 
               <ul class="radio-li">
                  <li>
                     <label>
                       <span><input type="radio" class="option-input radio change-status" name="ticket_status" <?php echo ($detail->status=='0')? "checked" : "disabled"; ?> value="1"/></span>
                       Pending
                     </label>
                   </li>
                   <li>
                     <label>
                       <span><input type="radio" class="option-input radio change-status" name="ticket_status" <?php echo ($detail->status=='1')? "checked" : ""; ?> <?php echo ($detail->status=='2')? "disabled" : ""; ?> value="1"/></span>
                        In Review
                     </label>
                   </li>
                   <li>
                     <label>
                       <input type="radio" class="option-input radio change-status" name="ticket_status" <?php echo ($detail->status=='2')? "checked" : ""; ?> value="2"/>
                       Completed
                     </label>
                   </li>
               </ul>
           </div> 
       </div>
     </div>
     <div class="modal-footer">
       <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
       <button type="button" class="btn btn-primary" onclick="ticketStatusChange()">Change</button>
     </div>
   </div>
 </div>
</div>