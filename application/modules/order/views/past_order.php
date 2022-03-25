
        <div class="mainWrapper innerPageWrapper">
            <section class="currentOrder sec-pad-30">
                <div class="container">
                    <div class="filterFlex d-flex align-items-center">
                        <div class="pageHead">
                            <h2>Past Orders</h2>
                        </div>
                        <div class="filterBlk filter4Grid csForm ml-auto">
                            <!-- <div class="filterItem">
                                <div class="form-group">
                                    <div class="floatLabel">
                                        <label class="inLabel">Search</label>
                                        <div class="searchBx">
                                            <input class="form-control" type="text" name="" placeholder="Search...">
                                            <span class="material-icons-outline md-search"></span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                          <!--   <div class="filterItem">
                                <div class="form-group">
                                    <div class="floatLabel">
                                        <label class="inLabel">By Delivery Types</label>
                                        <select class="form-control CsSelect">
                                            <option value="">All Delivery Types</option>
                                            <option value="1">Air freight</option>
                                            <option value="2">Sea freight</option>
                                            <option value="3">Courier &amp; Express services</option>
                                            <option value="4">Concierge Shipping</option>
                                            <option value="5">My Shipment</option>
                                        </select>
                                    </div>
                                </div>
                            </div> -->
                            <div class="filterItem">
                  <div class="form-group">
                     <div class="floatLabel">
                        <label class="inLabel">By Delivery Types</label>
                        <select class="form-control CsSelect" id="type_filter123" onchange="filter_fun123()">
                           <option value="">All Service Types</option>
                           <?php foreach (getServicetype() as $key => $value) { ?>
                           <option value="<?php echo $value['id'];?>"><?php echo $value['value'];?></option>
                           <?php
                              } ?>
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
                    </div>
                    <div class="historyTable">
                        <table id="pastOrderList" class="dataTableHistory21 table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                   <th>Tracking ID</th>
                                   <th>Delivery Type</th>
                                   <th>Price</th>
                                   <th>Item</th>
                                   <th>Date & Time</th>
                                   <th class="text-right">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
                                    <td></td>
<!--                                     <td></td>
 -->                                   <!--  <td class="text-right">
                                        <div class="recHisAction">
                                            <a href="order-details-concierge-shipping.html" class="icView icCircle"><span data-toggle="tooltip" class="material-icons-outline md-visibility" title="Details"></span></a>
                                            <a href="" class="icEdit icCircle"><span data-toggle="tooltip" class="material-icons-outline md-receipt_long" title="Download Reciept"></span></a>
                                        </div>
                                    </td> -->
                                </tr>
                               
                         
                            </tbody>
                            
                        </table>
                    </div>
                </div>
            </section>
        </div>
     
               <!-- Data Tables -->
       
    </body>
</html>
