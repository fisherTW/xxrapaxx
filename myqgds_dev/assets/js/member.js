// 下拉選單
$('.select').click(function() {
    $(this).find('ul').slideToggle(100);
    $(this).find('span').toggleClass('is--select');
});
// $(document).mouseup(function(e) {
//     var $option = $('.select').find('ul');
//     if ($option.has(e.target).length === 0) {
//         $option.slideUp(100).siblings().removeClass('is--select');
//     }
// });
$('.select ul li').click(function() {
    var str = "";
    $(this).each(function() {
        str += $(this).text() + " ";
    });
    $(this).parent().siblings().text(str).css('color', '#666666');
});

//底下按鈕捲動
function mDocking(){
    if($(window).width() > 414) {
        $('.m-dock').addClass('is--scrollBottom');
        $(window).scroll(function() {
            if ($(window).scrollTop() + $(window).height() > $(document).height() - 52) {
                $('.m-dock').addClass('is--scrollBottom');
            } else {
                $('.m-dock').removeClass('is--scrollBottom');
            }
        });
    }else{
        $('.m-dock').removeClass('is--scrollBottom');
    }
}
mDocking();
$(window).resize(function() {
    mDocking();
});




