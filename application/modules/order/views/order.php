<!-- <style type="text/css">
   select {
       -webkit-appearance: none;
       -moz-appearance: none;
       text-indent: 1px;
       text-overflow: '';
   }
   
   select {
         padding: 0 27px;
   }
   </style>
   <section class="pastOrder">
      <div class="container">
         <div class="generate-ticket" style="text-align: center;">
            <h2>Other Orders</h2>
         </div>
         <div class="currentOrderList ticketTable">
            <div class="row">
               <div class="col-lg-12">
   
                  <div class="statusFilter">
                   <div class="sltBox">
                     <select id="status_filter" onchange="filter_fun()">
                       <option value="">All Status</option>
                       <option value="1">Placed</option>
                       <?php foreach (get_status() as $key => $value) { ?>
                           <option value="<?php echo $value['id'];?>"><?php echo $value['value'];?></option>
                         <?php
      } ?>
                     </select>
                     <span class="caret caret-2"></span>
                   </div>
                   <div class="sltBox">
                     <select id="type_filter" onchange="filter_fun()">
                       <option value="">All Service Types</option>
                       <?php foreach (getServicetype() as $key => $value) { ?>
                           <option value="<?php echo $value['id'];?>"><?php echo $value['value'];?></option>
                         <?php
      } ?>
                    </select>
                    <span class="caret caret-2"></span>
                   </div>
                  </div>
               </div>
   
                  <table class="table" id="currentOrderList">
                    <thead class="thead-dark">
                      <tr class="tbldata">
                        <th scope="col">Tracking ID</th>
                        <th scope="col">Delivery Type</th>
                        <th scope="col">Price</th>
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
   </section> -->
<div class="mainWrapper innerPageWrapper">
   <section class="currentOrder sec-pad-30">
      <div class="container">
         <div class="filterFlex d-flex align-items-center">
            <div class="pageHead">
               <h2>Other Orders</h2>
            </div>
            <div class="filterBlk filter4Grid csForm ml-auto">
               <div class="filterItem">
                  <div class="form-group">
                    <!--  <div class="floatLabel">
                        <label class="inLabel">Search</label>
                        <div class="searchBx">
                           <input class="form-control" type="text" name="" placeholder="Search...">
                           <span class="material-icons-outline md-search"></span>
                        </div>
                     </div> -->
                  </div>
               </div>
               <div class="filterItem">
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">By Delivery Types</label>
                        <select class="form-control CsSelect" id="type_filter" onchange="filter_fun()">
                           <option value="">All Service Types</option>
                           <?php foreach (getServicetype() as $key => $value) { ?>
                           <option value="<?php echo $value['id'];?>"><?php echo $value['value'];?></option>
                           <?php
                              } ?>
                        </select>
                     </div>
                  </div>
               </div>
               <div class="filterItem">
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">By Status</label>
                       <!--  <select class="form-control CsSelect">
                           <option value="">All Status</option>
                           <option value="1">Placed</option>
                           <option value="2">Approved</option>
                           <option value="3">Shipped by Customer</option>
                           <option value="4">Received by Hobort</option>
                           <option value="5">Packed</option>
                           <option value="6">On the Way</option>
                           <option value="7">Delivered</option>
                        </select> -->
                        <select  class="form-control CsSelect" id="status_filter" onchange="filter_fun()">
                       <option value="">All Status</option>
                       <option value="1">Placed</option>
                       <?php foreach (get_status() as $key => $value) { ?>
                           <option value="<?php echo $value['id'];?>"><?php echo $value['value'];?></option>
                        <?php } ?>
                     </select>

                     </div>
                  </div>
               </div>
            </div>
         </div>
         <div class="historyTable">
            <table id="currentOrderList" class="dataTableHistory21 table table-striped table-bordered" style="width:100%">
               <thead>
                  <tr>
                     <th>Tracking ID</th>
                     <th>Delivery Type</th>
                     <th>Price</th>
                     <th>Date & Time</th>
                     <th>Status</th>
                     <th class="text-right">Action</th>
                  </tr>
               </thead>
               <tbody>
               </tbody>
            </table>
         </div>
      </div>
   </section>
</div>