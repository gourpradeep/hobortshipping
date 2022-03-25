
 <div class="mainWrapper innerPageWrapper">
            <section class="currentOrder sec-pad-30">
                <div class="container">
                    <div class="filterFlex d-flex align-items-center">
                        <div class="pageHead">
                            <h2>Concierge Orders</h2>
                        </div>
                        <div class="filterBlk filter4Grid csForm ml-auto">
                            <div class="filterItem">
                                <div class="form-group">
                                    <!-- <div class="floatLabel">
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
                                        <label class="inLabel">By Status</label>
                                      
                                         <select class="form-control CsSelect" id="status_filter_concierge" onchange="filter_fun()">
                        <option value="">All Status</option>
                        <option value="-1">Pending</option>
                        <option value="0">Offer Sent</option>
                        <option value="1">Placed</option>
                        <?php foreach (get_status() as $key => $value) { ?>
                            <option value="<?php echo $value['id'];?>"><?php echo $value['value'];?></option>
                          <?php
                        } ?>
                     </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="historyTable">
                        <table id="conciergeOrderList" class="dataTableHistory21 table table-striped table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                   <th>Tracking ID</th>
                                   <th>Description</th>
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