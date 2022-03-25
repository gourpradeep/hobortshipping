<div class="mainWrapper innerPageWrapper">
   <section class="orderDetails sec-pad-30">
      <div class="container">
         <div class="orderDetailsBlk">
            <div class="row">
               <div class="col-lg-5 col-md-6">
                  <div class="boxViewShadow">
                     <div class="boxBody">
                        <div class="orderInfoBlk">
                           <h2 class="orderDelType ticketDetailsId"><span>Tracking ID :</span> #<?php echo $detail->ticketID; ?></h2>
                           <!--  <h5 class="statusBadge"><span class="badge badge-success">Completed</span></h5> -->
                           <?php switch ($detail->status) {
                              case '0':
                                echo '<h5 class="statusBadge"><span class="badge badge-warning">Pending</span></h5>';
                                break;
                              
                              case '1':
                                echo '<h5 class="statusBadge"><span class="badge badge-info">Completed</span></h5>';
                                break;
                              
                              case '2':
                                echo '<h5 class="statusBadge"><span class="badge badge-success">Completed</span></h5>';
                                break;
                              } ?>
                           <div class="orderMoreInfo">
                              <ul class="ticketMoreInfo">
                                 <li>Title <span><?php echo $detail->title; ?></span></li>
                                 <li>Date <span>29 Aug 2020</span></li>
                              </ul>
                           </div>
                           <div class="csDesc">
                              <p><?php echo $detail->description; ?></p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
               <div class="col-lg-7 col-md-6">
                  <div class="chatPage">
                     <div class="conversation conFullWidth">
                        <div class="conversationDetails productChatView">
                           <div class="chatHeader chatHeaderMsg">
                              <div class="chatHeaderAvatar historyHead">
                                 <h2>Comments</h2>
                              </div>
                             
                           </div>

                            <div class="messageBox" id="conversation">
                              <div class="messageContainer">
                              <div class="chat-container min-height" id="myDIV" onscroll="commentScroll()">
                                    <div id="content"> </div>
                                    <div id="btnLoadViewMe"></div>
                                 </div>
                                  <!-- <div class="message-body">
                                      <div class="message-main-receiver">
                                          <div class="adminCmt">
                                              <h5>Admin</h5>
                                              <div class="receiver">
                                                  <div class="message-text">
                                                      Hi, what are you doing?
                                                  </div>
                                                  <span class="message-time">
                                                      24 Mar 2021 11:12:am
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                  </div> -->
                                 <!--  <div class="message-body">
                                      <div class="message-main-sender">
                                          <div class="sender">
                                          <div class="message-text">
                                              I am doing nothing man!
                                          </div>
                                          <span class="message-time">
                                              24 Mar 2021 11:15:am
                                          </span>
                                          </div>
                                      </div>
                                  </div> -->
                                 <!--  <div class="message-body">
                                      <div class="message-main-receiver">
                                          <div class="adminCmt">
                                              <h5>Admin</h5>
                                              <div class="receiver">
                                                  <div class="message-text">
                                                      Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                                                  </div>
                                                  <span class="message-time pull-right">
                                                      24 Mar 2021 11:18:am
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                  </div> -->
                            <!--       <div class="message-body">
                                      <div class="message-main-sender">
                                          <div class="sender">
                                          <div class="message-text">
                                              It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout.
                                          </div>
                                          <span class="message-time pull-right">
                                              25 Mar 2021 11:12:am
                                          </span>
                                          </div>
                                      </div>
                                  </div> -->
                                <!--   <div class="message-body">
                                      <div class="message-main-sender">
                                          <div class="sender">
                                          <div class="message-text">
                                              Sed eget felis dignissim nunc fermentum tincidunt.
                                          </div>
                                          <span class="message-time pull-right">
                                              25 Mar 2021 01:12:pm
                                          </span>
                                          </div>
                                      </div>
                                  </div> -->
                                 <!--  <div class="message-body">
                                      <div class="message-main-receiver">
                                          <div class="adminCmt">
                                              <h5>Admin</h5>
                                              <div class="receiver">
                                                  <div class="message-text">
                                                      Hi, what are you doing?!
                                                  </div>
                                                  <span class="message-time pull-right">
                                                      25 Mar 2021 01:15:pm
                                                  </span>
                                              </div>
                                          </div>
                                      </div>
                                  </div> -->
                                  <!-- <div class="message-body">
                                      <div class="message-main-sender">
                                          <div class="sender">
                                          <div class="message-text">
                                              Ut accumsan arcu vel quam molestie imperdiet.
                                          </div>
                                          <span class="message-time pull-right">
                                              25 Mar 2021 05:12:pm
                                          </span>
                                          </div>
                                      </div>
                                  </div> -->
                                  <!-- <div class="message-body">
                                      <div class="message-main-sender">
                                          <div class="sender imgSend">
                                          <div class="message-text imgZoom">
                                              <a href="img/dummy/services/img1.png">
                                                  <img src="img/dummy/services/img1.png">
                                              </a>
                                          </div>
                                          <span class="message-time pull-right">
                                              26 Mar 2021 11:12:pm
                                          </span>
                                          </div>
                                      </div>
                                  </div> -->
                              </div>
                              </div>
                           <!-- <div class="reply-icon reply-emojis">
                              <i class="fa fa-smile-o fa-2x"></i>
                              </div> -->
                           <form action="<?php echo base_url('ticket/add_comment');?>"  method="POST" id="add_comment" style="display:<?php echo ($detail->status< 2)? "block" : "none"; ?>">
                              <div class="chatReply">
                                 <input type="hidden" name="ticket_id" value="<?php echo $detail->ticketID; ?>" id="ticketID">
                                 <div class="reply-main">
                                    <div id="ta-frame">
                                       <textarea placeholder="Leave Comment" class="form-control" rows="1" id="comment" name="comment"></textarea>
                                    </div>
                                 </div>
                                 <div class="reply-icon reply-recording ripple">
                                    <label class="attachFile">
                                       <!--  <input type="file"> -->
                                       <input type="file" name="comment_attechment" multiple onchange="commentAttechment(this)">
                                       <i class="fas fa-paperclip fa-rotate-45" aria-hidden="true"></i>
                                    </label>
                                 </div>
                                 <div class="reply-icon reply-send" type="submit" id="comment-submit"><i class="far fa-paper-plane ripple" aria-hidden="true"></i></div>
                           </form>

                          
                           <!--    <div class="reply-icon reply-send ">
                              <i class="far fa-paper-plane ripple" aria-hidden="true"></i>
                              </div> -->
                           </div>
                            <div class="sendBox" style="display:<?php echo ($detail->status=='2')? "block" : "none"; ?>">
                           <h4 id="disabled_comment" class="text-center text-warning">This ticket is closed now. Comment disabled.</h4>
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
<style type="text/css">
#disabled_comment{


    color: #070dff!important;
    font-size: 19px;
    margin-top: 15px;

}
</style>