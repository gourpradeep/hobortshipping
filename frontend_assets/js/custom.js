// $(window).on('load', function() {
//     // PRELOADER
//     $(".preloader").fadeOut(500);

// });



$(document).ready(function(){

// $(window).scroll(function() {
//     var scroll = $(window).scrollTop();
//     if (scroll >= 50) {
//         $(".mainHeader").addClass("navbarFixed");
//     } else {
//         $(".mainHeader").removeClass("navbarFixed");
//     }
// });
$(window).on('scroll', function(){
    if ($(this).scrollTop() > 0) {
        $('.mainHeader').addClass("navbarFixed");
    }else{
        $('.mainHeader').removeClass("navbarFixed");
    }
});



/*===============Select 2 Init============*/
$('.CsSelect').select2();
$('.CsMultiSelect').select2({
  placeholder: "Select Option",
});

/*===============Tooltip Init============*/
$('[data-toggle="tooltip"]').tooltip()


/*===============Create Quote============*/
$('#delveryType').change(function(){
    $('.delTypeBox').hide();
    $('#delBox' + $(this).val()).show();
});

/*===============Image Zoom============*/
$('.imgZoom').lightGallery({
  // thumbnail:true,
  download :false
}); 



// // Date Time Picker

// $(function () {
//   $('.datepickAutoPos').datetimepicker({
//     format: 'MM/DD/YYYY',
//     ignoreReadonly: true
//   });
//   $('.dateTime').datetimepicker({
//     // inline: true
//     ignoreReadonly: true
//   });  
//   $('.timeSelect').datetimepicker({
//     // inline: true
//     format: 'LT',
//     ignoreReadonly: true
//   });
// });


$("#serviceSlider").owlCarousel({
    loop: true,
    margin: 15,
    autoplay: false,
    responsiveClass: true,
    navText: ['<i class="fa fa-chevron-left" aria-hidden="true"></i>', '<i class="fa fa-chevron-right" aria-hidden="true"></i>'],
    responsive: { 0: { items: 1, nav: true }, 480: { items: 2, nav: true }, 767: { items: 3, nav: true }, 1000: { items: 3, nav: true, loop: false } },
});


$('.dataTableHistory2').DataTable({
    "responsive": true,
    "ordering": false,
    "searching": false,
    "lengthChange": false,
    "fixedHeader": {
        "headerOffset": 120
    }
});


// $("#addMoreId").click(function() {
//   $(".moreTrackId:last").before('<div class="moreTrackId"><input class="form-control" type="text" name="" placeholder="Enter Tracking ID"> <label class="icoDeleteId material-icons-outline md-close"></label> </div>');
// });
// $('.trackIdBlk').on('click','.icoDeleteId',function() {
//   $(this).parent().remove();
// });




});
