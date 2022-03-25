<!-- <section class="pastOrder">
   <div class="container">
    <div class="generate-ticket">
        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#ticketModal" data-whatever="@mdo">Generate Ticket</button>
    </div>
    <div class="pastOrderList ticketTable">
        <div class="row">
            <div class="col-lg-12">
                <div class="statusFilter">
                    <span>Status:</span>
                    <select id="ticket-status">
                        <option value="">All</option>
                        <option value="0">Pending</option>
                        <option value="1">In Review</option>
                        <option value="2">Completed</option>
                    </select>
                </div>
                <table class="table" id="ticketList">
                  <thead class="thead-dark">
                    <tr class="tbldata">
                      <th scope="col">ID</th>
                      <th scope="col">Title</th>
                      <th scope="col">Description</th>
                      <th scope="col">Status</th>
                      <th scope="col">Created Date</th>
                      <th scope="col" class="text-right">Action</th>
                    </tr>
                  </thead>
                </table>
            </div>
        </div>
    </div>
   </div>
   </section>
   
   <div class="modal fade" id="ticketModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header generate-heading">
          <h5 class="modal-title" id="exampleModalLabel">Generate Ticket</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form action="<?php echo base_url('ticket/add_ticket');?>"  method="POST" id="add_ticket">
        <div class="modal-body">
          <div class="form-group generate-content">
            <label for="recipient-name" class="col-form-label">Title</label>
            <input type="text" name="title" class="form-control" id="recipient-name" style="color: black;">
          </div>
          <div class="form-group generate-content">
            <label for="message-text" class="col-form-label">Description</label>
            <textarea name="description" class="form-control" id="message-text" rows="5" style="color: black;"></textarea>
          </div>
        </div>
        <div class="modal-footer modal-btn">
            <button type="button" class="btn btn-secondary cancel-btn" data-dismiss="modal">Cancel</button>
            <button type="submit" id="submitTicket" class="btn btn-primary done-btn">Done</button>
        </div>
        </form>
      </div>
    </div>
   </div> -->
<div class="mainWrapper innerPageWrapper">
   <section class="currentOrder ticketPage sec-pad-30">
      <div class="container">
         <div class="filterFlex d-flex align-items-center">
            <div class="pageHead">
               <h2>Ticket</h2>
            </div>
            <div class="filterBlk filter4Grid csForm ml-auto">
               <div class="filterItem">
                  <!--  <div class="form-group">
                     <div class="floatLabel">
                         <label class="inLabel">Search</label>
                         <div class="searchBx">
                             <input class="form-control" type="text" name="" placeholder="Search...">
                             <span class="material-icons-outline md-search"></span>
                         </div>
                     </div>
                     </div> -->
               </div>
               <div class="filterItem">
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">By Status</label>
                        <select class="form-control CsSelect" id="ticket-status">
                           <option value="">All</option>
                           <option value="0">Pending</option>
                           <option value="1">In Review</option>
                           <option value="2">Completed</option>
                        </select>
                     </div>
                  </div>
               </div>
               <!-- <div class="filterItem">
                  <div class="form-group">
                      <div class="floatLabel">
                          <label class="inLabel">By Status</label>
                          <select class="form-control CsSelect">
                              <option value="">All Status</option>
                              <option value="1">Placed</option>
                              <option value="2">Approved</option>
                              <option value="3">Shipped by Customer</option>
                              <option value="4">Received by Hobort</option>
                              <option value="5">Packed</option>
                              <option value="6">On the Way</option>
                              <option value="7">Delivered</option>
                          </select>
                      </div>
                  </div>
                  </div> -->
            </div>
            <div class="ticketAct">
               <button class="btn btnTheme" data-toggle="modal" data-target="#generateTicket">Generate Ticket</button>
            </div>
         </div>
         <div class="historyTable">
            <table id="ticketList" class="dataTableHistory21 table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th>Ticket ID</th>
                     <th>Title</th>
                     <th>Description</th>
                     <th>Status</th>
                     <th>Created Date</th>
                     <th class="text-right">Action</th>
                  </tr>
               </thead>
            </table>
         </div>
      </div>
   </section>
</div>
<div class="modal csModal csSmModal fade" id="generateTicket" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog" role="document">
      <div class="modal-content">
         <button type="button" class="close" data-dismiss="modal" aria-label="Close">
         <span class="material-icons-outline md-close"></span>
         </button>
         <div class="modal-body">
            <div class="modaldHeader">
               <img src="<?php echo getenv(APP_FRONT_ASSETS_IMAGES)?>tickets.png">
               <h2>Generate Ticket</h2>
               <p>Fill some information to generate ticket.</p>
            </div>
            <div class="modalCnt">
               <div class="csForm">
                  <!--   <form action="<?php echo base_url('ticket/add_ticket');?>"  method="POST" id="add_ticket">
                     <div class="form-group">
                         <div class="floatLabel">
                             <label class="inLabel">Title<span class="reqStar">*</span></label>
                             <input class="form-control" type="text" name="" placeholder="Enter Title">
                         </div>
                     </div>
                     <div class="form-group">
                         <div class="floatLabel">
                             <label class="inLabel">Description<span class="reqStar">*</span></label>
                             <textarea rows="4" class="form-control" type="text" name="" placeholder="Enter Description"></textarea>
                         </div>
                     </div>
                     </form> -->
                  <form action="<?php echo base_url('ticket/add_ticket');?>"  method="POST" id="add_ticket">
                     <div class="form-group">
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Title<span class="reqStar">*</span></label>
                              <input class="form-control" type="text" name="title" placeholder="Enter Title">
                           </div>
                        </div>
                        <div class="form-group">
                           <div class="floatLabel">
                              <label class="inLabel">Description<span class="reqStar">*</span></label>
                              <textarea rows="4" class="form-control" type="text" name="description" placeholder="Enter Description"></textarea>
                           </div>
                        </div>
                     </div>
                     <div class="modal-footer ">
                        <button type="button" class="btn btnSecondary" data-dismiss="modal">Close</button>
                        <button type="submit" id="submitTicket" class="btn btnTheme">Done</button>
                     </div>
                  </form>
               </div>
            </div>
         </div>
         
      </div>
   </div>
</div>