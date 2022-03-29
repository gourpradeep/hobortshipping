<footer>
				<div class="color-part2"></div>
				<div class="color-part"></div>
				<div class="container custom-container">
					<div class="row block-content">
						<div class="col-md-3 col-sm-12">
							<a href="#" class="logo-footer"></a>
							<p>Hobort Shipping services is part of a worldwide group of transport and logistics companies registered facilitate international trade between the world’s major economies and among emerging markets across all continents.</p>
							<div class="footer-icons">
                     <a href="https://www.facebook.com/hobortshipping" target="_blank"><i class="fab fa-facebook"></i></a>
                        <a href="https://www.instagram.com/hobortshipping" target="_blank"><i class="fab fa-instagram"></i></a>
                        <a href="https://twitter.com/hobortshipping" target="_blank"><i class="fab fa-twitter"></i></a>
							</div>
						</div>
						<div class="col-md-3 col-sm-12">
							<h4>Company</h4>
							<nav class="aboutTexts mt-4">
                     <a href="<?php echo base_url().'about'?>" class="scrollLink"><i class="fa fa-angle-double-right pr-2"></i>About Company</a>

<a href="<?php echo base_url('about')?>" class="scrollLink"><i class="fa fa-angle-double-right pr-2"></i>Our History</a>

<a href="<?php echo base_url('about')?>" class="scrollLink"><i class="fa fa-angle-double-right pr-2"></i>Company Achievement</a>

<a href="<?php echo base_url('about')?>" class="scrollLink"><i class="fa fa-angle-double-right pr-2"></i>Meet The Team</a>

<a href="<?php echo base_url('about')?>"><i class="fa fa-angle-double-right pr-2"></i>Success Story</a>
							</nav>
						</div>
						<div class="col-md-3 col-sm-12">
							<h4>Quick Links</h4>
							<nav class="aboutTexts mt-4">
                     <a href="<?php echo base_url('contact-us')?>"><i class="fa fa-angle-double-right pr-2"></i>Email Us</a>
                     <a href="<?php echo base_url('contact-us')?>"><i class="fa fa-angle-double-right pr-2"></i>Help Center</a>
                     <a href="<?php echo base_url('privacy-policy')?>"><i class="fa fa-angle-double-right pr-2"></i>Privacy Policy</a>
                     <a href="<?php echo base_url('terms')?>"><i class="fa fa-angle-double-right pr-2"></i>Terms and Conditions</a>
							</nav>
						</div>
						<div class="col-md-3 col-sm-12">
							<h4>Contact Us</h4>
							<div class="contact-info mt-4">
								<span><i class="fa fa-location-arrow pr-3"></i>815 Progress Ct Ste A Lawrenceville GA 30043</span>
								<span><i class="fa fa-phone pr-3"></i>+1 770 676 6044 | +233 50 403 0404</span>
								<span><i class="fa fa-envelope pr-3"></i>info@hobortshipping.com</span>
								<span><i class="fa fa-clock pr-3"></i>Monday - Friday 8:30am - 5pm
Saturday - 9am - 2pm</span>
							</div>
						</div>
					</div>
               <div class="pmtMethodImg">
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>1.png"></a>
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>2.png"></a>
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>3.png"></a>
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>4.png"></a>
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>5.png"></a>
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>6.png"></a>
            <a href=""><img src="<?php echo getenv('APP_FRONT_ASSETS_IMAGES') ?>7.png"></a>
         </div>
					<div class="copy">Copyright 2021 © Hobort Shipping</div>
				</div>
			</footer>
<script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>/owl.carousel.min.js"></script>
<script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>/select2.min.js"></script>
<script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>/intlTelInput.min.js"></script>
<script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>ResizeSensor.js"></script>
<script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>theia-sticky-sidebar.js"></script>
<script src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>lightgallery-all.min.js"></script>



<!-- Data Tables -->
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.10.22/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript" src="https://datatables.net/release-datatables/extensions/Responsive/js/dataTables.responsive.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/fixedheader/3.1.8/js/dataTables.fixedHeader.min.js"></script>


<!-- fancybox gallery -->


<script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js">
</script>
<script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>custom.js"></script>
<!-- <script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>custom2.js"></script>
 --><script type="text/javascript" src="<?php echo getenv('APP_FRONT_ASSETS_JS') ?>front_common.js"></script>
<!-- Scripts end -->
<?php if(ENVIRONMENT === 'production') { ?>
<script>
   function initFreshChat() {
       window.fcWidget.init({
       token: "1127f920-a8be-4071-a995-0e75e23497a4",
       host: "https://wchat.freshchat.com"
   });
   }
   function initialize(i,t){var e;i.getElementById(t)?initFreshChat():((e=i.createElement("script")).id=t,e.async=!0,e.src="https://wchat.freshchat.com/js/widget.js",e.onload=initFreshChat,i.head.appendChild(e))}function initiateCall(){initialize(document,"freshchat-js-sdk")}window.addEventListener?window.addEventListener("load",initiateCall,!1):window.attachEvent("load",initiateCall,!1);
</script>
<?php } ?>
<script type="text/javascript">
   $(document).ready(function() {
       // $('a[href*="#"]').bind('click', function(e) {
       //     e.preventDefault(); 
   
       //     var target = $(this).attr("href"); // Set the target as variable
       //     $('html, body').stop().animate({
       //         scrollTop: $(target).offset().top - 120
       //     }, 600, function() {
       //         location.hash = target; //attach the hash (#jumptarget) to the pageurl
       //     });
       //     alert($(this).attr("href"));
       //     return false;
   
       // });
       // $('a[href*="#"]').click(function (e) {
       //     e.preventDefault();
       //     var curLink = $(this);
       //     var scrollPoint = $(curLink.attr('href')).position().top + 15;
       //     $('body,html').animate({
       //         scrollTop: scrollPoint
       //     }, 500);
       // })
   });
   
   
   
   $(window).scroll(function() {
       var scrollDistance = $(window).scrollTop();
       $('.srItemBlk').each(function(i) {
           if ($(this).position().top <= scrollDistance) {
               $('.servicesMain a.active').removeClass('active');
               $('.servicesMain a').eq(i).addClass('active');
           }
       });
   }).scroll();
   
   if ($(window).width() > 767) {
     if($('.theiaStickySidebar').length > 0) {
       $('.theiaStickySidebar').theiaStickySidebar({
           additionalMarginTop: 120
       });
     }
   }
</script>
