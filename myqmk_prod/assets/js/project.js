$(function() {
    //brand icons
    var $share = $('.p-brand-share'),
        $sharemask = $('.p-brand-share, .mask-z'),
        $icons = $('.icons-share');

    $sharemask.hide();
    $icons.click(function(){
        $icons.addClass('icons-share--active');
        if(window.innerWidth <= 414){
            $('.p-brand-share').stop(true,false).animate({
                bottom:-300
            },0).fadeIn(300).animate({
                bottom:0
            },300);
            $('.mask-z').fadeIn(100);
        } else if(window.innerWidth > 414){
            $('.p-brand-share, .mask-z').fadeIn(500);
        }
    });

    $('.mask-z, .share__cancel').click(function(){
        $icons.removeClass('icons-share--active');
        if(window.innerWidth <= 414){
            $('.p-brand-share').stop(true,false).animate({
                bottom:0
            },0).animate({
                bottom:-300
            },200).fadeOut(100);
            $('.mask-z').fadeOut(100);
        } else if(window.innerWidth > 414){
            $('.p-brand-share, .mask-z').fadeOut(300);
        }
    }); 

    //support trigger
    $('.support-box-foot__trigger').click(function(){              
        $(this).parent().prev().slideToggle(500); 
        $(this).toggleClass("trigger--active");
    });

    //rwdtabs
    var $tabs = $('#resTab');
    $tabs.responsiveTabs({
        rotate: false,
        startCollapsed: 'accordion',
        collapsible: 'accordion',
        setHash: true,
        click: function(e, tab) {
            $('.info').html('Tab <strong>' + tab.id + '</strong> clicked!');
        },
        activate: function(e, tab) {
            $('.info').html('Tab <strong>' + tab.id + '</strong> activated!');
        },
        activateState: function(e, state) {
            $('.info').html('Switched from <strong>' + state.oldState + '</strong> state to <strong>' + state.newState + '</strong> state!');
        }
    });

    //status text limit
    var lenp = 100;
    $(".status-box-content__p").each(function(i){
        if($(this).text().length>lenp){
            $(this).attr("title",$(this).text());
            var text=$(this).text().substring(0,lenp-1)+"...";
            $(this).text(text);
        }
    });
    //status moving animation
    var $dst = $('.detail-status-all-timeline'),
        $dsm = $('.detail-status-all-more'),
        $stb = $('.status-box');
    $('.status-box-content__readmore').click(function(){
       $dst.animate({marginLeft:- $dst.outerWidth() - 20},300);
       $stb.fadeOut(100);
       $dsm.load('components/project/readmore.html');
    });
    $(window).resize(function(){
        $dst.outerWidth();
    });

    //faq
    var $faq = $(".faq");
    $faq.find("div").eq(0).slideDown();
    $faq.find('ul').eq(0).addClass("faq-que--active");
    $faq.click(function() {
        $(this).find("div").slideDown(300).end().siblings().find("div").slideUp(300);
        $(this).find('ul').addClass("faq-que--active").end().siblings().find("ul").removeClass("faq-que--active");
        return false;
    });

});
