
        
        <div class="mainWrapper innerPageWrapper">
            <section class="orderDetails sec-pad-30 bgImg">
                <div class="container">
                    <div class="addMyShipment">
                        <div class="row justify-content-center">
                            <div class="col-lg-7 col-md-6">
                                <div class="boxViewBorder">
                                    <div class="boxBody">
                                        <div class="lsHead">
                                            <span class="material-icons-outline md-account_circle"></span>
                                            <div class="">
                                                <h2>Contact Us</h2>
                                                <p>We'd love to hear from you, please drop us a line if you've any query.</p>
                                            </div>
                                        </div>
                                        <div class="csForm floatLabelForm">
                                            <form action="<?php echo base_url('home/create_contact'); ?>" class="" method="POST" id="contactUs">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Full Name<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="name" placeholder="Enter Name">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Email<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="email" placeholder="Enter Email">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <div class="floatLabel">
                                                                <label class="inLabel">Subject<span class="reqStar">*</span></label>
                                                                <input class="form-control" type="text" name="subject" placeholder="Enter Subject">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <div class="floatLabel">
                                                        <label class="inLabel">Message<span class="reqStar">*</span></label>
                                                        <textarea rows="4" class="form-control" type="text" name="message" placeholder="Enter Message"></textarea>
                                                    </div>
                                                </div>
                                                <div class="form-group">
                                                    <button class="btn btnTheme" id="contact_submit" type="button">Submit</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        