//share icons and more click
var $topicShare = $('.sharestyle'),
    $sharemask = $('.sharestyle, .mask-z'),
    $topicIcons = $('.sharebtn');
$sharemask.hide();
if (window.innerWidth > max_width){
    var yy = 40;
    $topicIcons.click(function(e){
        
        var shareleft = ($(window).width()+$(".t-relation__btn").width()+$topicShare.width())/2;
        $topicShare.css({"top": (e.pageY)-($topicShare.height()/2) + "px","left":(shareleft+yy/2)+"px"}).fadeIn(200);
    });       
} 
$topicIcons.click(function() {
    if (window.innerWidth <= max_width) {
        $topicShare.stop(true, false).animate({
            bottom: -300
        }, 0).fadeIn(100).animate({
            bottom: 0
        }, 300);
        $('.mask-z').fadeIn(100);

        // scroll lock
        var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
        ];
        var html = jQuery('html'); 
        var share = $('.page-header-share');
        html.data('scroll-position', scrollPosition);
        html.data('previous-overflow', html.css('overflow'));
        html.css('overflow', 'hidden');
        window.scrollTo(scrollPosition[0], scrollPosition[1]);
    } else if (window.innerWidth > max_width) {
        $sharemask.fadeIn(200);
    }
});
$('.mask-z, .share__cancel').click(function() {
    if (window.innerWidth <= max_width) {
        $topicShare.stop(true, false).animate({
            bottom: 0
        }, 0).animate({
            bottom: -300
        }, 200).fadeOut(100);
        $('.mask-z').fadeOut(100);

        // scroll unlock
        var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
        ];
        var html = jQuery('html');
        var scrollPosition = html.data('scroll-position');
        html.css('overflow', html.data('previous-overflow'));
        window.scrollTo(scrollPosition[0], scrollPosition[1]);
    } else if (window.innerWidth > max_width) {
        $sharemask.fadeOut(200);
        
    }
});

