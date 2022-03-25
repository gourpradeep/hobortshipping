
    </div>
    <!-- content -->

    <footer class="footer">
        <?php echo getenv('APP_NAME') . ' © ' . date('Y') . '. All Rights Reserved.'; ?>
    </footer>
    

    </div>
    <!-- content-page -->

    <!-- ============================================================== -->
    <!-- End Right content here -->
    <!-- ============================================================== -->

    </div>
    <!-- END wrapper -->

    <!-- Loader -->
    <center>
        <div id="tl_admin_loader" class="tl_loader" style="display: none;" ><img style="float: left;" src="<?php echo getenv('APP_BACK_ASSETS_IMAGES'); ?>Preloader_3.gif">
        </div>
    </center>

    <!-- fancybox gallery -->
    <script src="//cdnjs.cloudflare.com/ajax/libs/fancybox/2.1.5/jquery.fancybox.min.js"></script>

    <script src="<?php echo getenv('APP_BACK_ASSETS_CUSTOM_JS'); ?>admin_common.js"></script>
    <!-- App js -->
    <script src="<?php echo getenv('APP_BACK_ASSETS_JS'); ?>app.js"></script>
</body>
</html>
