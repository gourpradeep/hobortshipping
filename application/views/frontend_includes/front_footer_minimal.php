   
    <!-- Footer section Start -->
    <div class="footer_section" id="about-section">
        <div class="footer_img_overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer_service_heading_wrapper">
                        <div class="footer_service_heading">
                            <h1>Company</h1>
                        </div>
                    </div>

                    <div class="footer_service_list_wrapper">
                        <div class="footer_service_list">
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;About Company</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Our History</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Company Achievement</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Meet The Team</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Success Story</a></li>
                            </ul>
                        </div>
                    </div>
                    
                    <div class="news_social_icon_wrapper">
                        <div class="news_social_icon">
                            <ul>
                                <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                <li><a href="#"><i class="fa fa-pinterest"></i></a></li>
                                <li><a href="#"><i class="fa fa-linkedin"></i></a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer_service_heading_wrapper">
                        <div class="footer_service_heading">
                            <h1>QUICK LINKS</h1>
                        </div>
                    </div>

                    <div class="footer_service_list_wrapper">
                        <div class="footer_service_list">
                            <ul>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Email Us</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Help Center</a></li>
                                <li><a href="#"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;FAQ</a></li>
                                <li><a href="t&c_and_p&p.html"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Privacy Policy</a></li>
                                <li><a href="<?php echo base_url('home/terms'); ?>"><i class="fa fa-angle-double-right"></i> &nbsp;&nbsp;&nbsp;Terms and Conditions</a></li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer_service_heading_wrapper">
                        <div class="footer_service_heading">
                            <h1>Contact Us</h1>
                        </div>
                    </div>

                    <div class="footer_service_list_wrapper">
                        <div class="footer_service_list">
                            <ul>
                                <li>
                                    <div class="media phone-img">
                                    <img class="mr-3" src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>content/phone.png" class="twitter icon" alt="twitter icon">
                                        <a href="#">&nbsp;&nbsp;&nbsp;+012 (345) 556 99</a>
                                    </div>
                                </li>
                                <li>
                                    <div class="media phone-img">
                                    <img class="mr-3" src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>content/envelope.png" class="twitter icon" alt="twitter icon">
                                        <a href="#">&nbsp;&nbsp;&nbsp;support@gmail.com</a>
                                    </div>
                                </li>

                                <li>
                                    <div class="media phone-img">
                                    <img class="mr-3" src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>content/pin.png" class="twitter icon" alt="twitter icon">
                                        <a href="#">&nbsp;&nbsp;&nbsp;North Avenue,Chicago, IL, 55030</a>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-3 col-sm-6 col-xs-12">
                    <div class="footer_service_heading_wrapper">
                        <div class="footer_service_heading">
                            <h1>About Us</h1>
                        </div>
                    </div>

                    <div class="footer_service_list_wrapper">
                        <div class="footer_service_list">
                            <ul>
                            <p>Sed ut perspiciatis unde omnis iste natus erroe sit voluptatem accusantium dolorem que laudantium,totam rem aperiam,eaque ipsa quae ab illo inventore veritatis.</p>
                            </ul>
                            <div class="newsletter_wrapper">
                                <div class="newsletter_sec">
                                    <h4>Get Newsletter Here</h4>
                                </div>
                            </div>
                            <div class="news_searchbar_wrapper">
                                <div class="news_searchbar_sec">
                                    <input type="email" placeholder="Email">
                                    <span class="next-icon"><i class="fa fa-arrow-right"></i></span>
                                    <!-- <button type="submit">Submit</button> -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="footer_bottom_border"></div>
                </div>

                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bottom_footer_main text-center">
                        <div class="bottom_footer_wrapper">
                            <p>Copyright 2020 © <span><a href="#">Hobort</a></span></p>
                        </div>
                    </div>	
                </div>
            </div>
        </div>
    </div>
    <!-- Footer section End -->
    <center>
        <div id="tl_user_loader" class="tl_loader" style="display: none;" >
            <img style="float: center; margin-top: 18%;" src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES'); ?>header/preloader.gif">
        </div>
    </center>
    <!-- Page Loader -->
    <div class="pageLoader">
        <div id="status">
            <img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>header/loader_new.png" id="pageLoader" alt="loader">
        </div>
    </div>
   
    <?php
    //Load Scripts for Home Page only
    $page_slug = $this->router->fetch_method();
    $current_control = $this->router->fetch_class();
    if($current_control == 'home' && $page_slug == 'index') {
    ?>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>owl/owl.carousel.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>megnific/jquery.magnific-popup.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>counter/jquery.countTo.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>counter/jquery.inview.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/jquery.themepunch.tools.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/jquery.themepunch.revolution.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/revolution.extension.actions.min.js"></script>    
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/revolution.extension.layeranimation.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/revolution.extension.migration.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/revolution.extension.parallax.min.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_PLUGINS') ?>rs_slider/revolution.extension.slideanims.min.js"></script>
    <?php } ?>

    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>custom.js"></script>
    <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>front_common.js"></script>
    <!-- Scripts end -->
   
    <script type="text/javascript">

        $(document).ready(function() {

            $(".truck_btn").click(function() {
                $(".pageLoader").show();
            });

            $('#colorselector').change(function(){
                $('.colors').hide();
                $('#' + $(this).val()).show();
            });

        });
        
        var tabs = document.getElementById('icetab-container').children;
        var tabcontents = document.getElementById('icetab-content').children;

        var myFunction = function() {
            var tabchange = this.mynum;
            for(var int=0;int<tabcontents.length;int++){
                tabcontents[int].className = ' tabcontent';
                tabs[int].className = ' icetab';
            }
            tabcontents[tabchange].classList.add('tab-active');
            this.classList.add('current-tab');
        };

        for(var index=0;index<tabs.length;index++) {
            tabs[index].mynum=index;
            tabs[index].addEventListener('click', myFunction, false);
        };
    </script>
   
</body>
 
</html>