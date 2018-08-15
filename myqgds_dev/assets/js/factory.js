//share
var $share = $('.f-header-focus-share'),
    $sharemask = $('.f-header-focus-share, .mask-z'),
    $icons = $('.list__share');
$sharemask.hide();
$icons.click(function(){
    $icons.addClass('is--active');
    if(window.innerWidth <= 414){
        $share.stop(true,false).animate({
            bottom:-300
        },0).fadeIn(300).animate({
            bottom:0
        },300);
        $('.mask-z').fadeIn(100);
        $('.share-icons').css('transform','translate3d(0px, 0px, 0px)')
    } else if(window.innerWidth > 414){
        $sharemask.fadeIn(500);
    }
});

$('.mask-z, .share__cancel, .share-icons li').click(function(){
    $icons.removeClass('is--active');
    if(window.innerWidth <= 414){
        $share.stop(true,false).animate({
            bottom:0
        },0).animate({
            bottom:-300
        },200).fadeOut(100);
        $('.mask-z').fadeOut(100);
    } else if(window.innerWidth > 414){
        $sharemask.fadeOut(300);
    }
}); 

//scroll docking
// $(window).on("scroll", function()  {
//     var st = $(this).scrollTop();
//     var scrollbottom = $(document).height()-$(window).height();
//     if ( st > 500) {
//         $(".f-coopBtn").addClass('is--docking');
//         if ( st  == scrollbottom ) {
//             $(".f-coopBtn").addClass('is--bottom');
//          } else{
//             $(".f-coopBtn").removeClass('is--bottom');
//          }   
        
//     } else {
//         $(".f-coopBtn").removeClass('is--docking');
//     }
// });


//share icon
var $Width = $(window).width();
if ($Width <= 414) {
    var carouselIcons;
    $(document).ready(function() {
        carouselIcons = $("ul.share-icons");
        carouselIcons.itemslide({
            left_sided: true
        });
    });
}
$(window).resize(function() {
    var $Width = window.innerWidth;
    if ($Width <= 414) {
        var carouselIcons;
        $(document).ready(function() {
            carouselIcons = $("ul.share-icons");
            carouselIcons.itemslide({
                left_sided: true
            });
        });
    }
})