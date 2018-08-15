$(document).ready(function () {

    $(window).scroll(function () {


        if ($(window).scrollTop() > 30) {
            $("#scrolling-switch").addClass("div_fixed");
        }
        else {
            $("#scrolling-switch").removeClass("div_fixed");
        }
    });

    $(function () {
        $('.footer-trigger').click(function () {
            $(".footer").toggleClass("active--1");
        });

        $('[data-anchor="true"]').on('click', function () {
            var obj = $(this).data('href');
            $('html,body').animate({ scrollTop: $('[data-href-id="' + obj + '"]').offset().top - 130 }, 800);
            return false;
        })

        $(window).on('scroll', function () {
            var scrollTop = $(this).scrollTop() + 200;
            $('[data-anchor="true"]').each(function () {
                var currLink = $(this);
                var currHref = currLink.data('href'),
                    refElement = $('[data-href-id="' + currHref + '"]');

                if (refElement.position().top <= scrollTop && refElement.position().top + refElement.outerHeight(true) > scrollTop) {
                    $('[data-anchor="true"]').removeClass("on");
                    currLink.addClass("on");
                }
            });
        }).trigger('scroll');

        //collapse
        $('[data-collapse="title"]').on('click', function (e) {
            $(this).toggleClass('on');
            $(this).next('[data-collapse="content"]').slideToggle();
            $(this).closest('.faq_collapse').siblings('.faq_collapse').find('[data-collapse="title"]').removeClass('on');
            $(this).closest('.faq_collapse').siblings('.faq_collapse').find('[data-collapse="content"]').slideUp();
        });

        $('.sections').each(function () {
            $(this).find('.faq_collapse:eq(0)').children('[data-collapse="title"]').trigger('click');
        });
    })

});


	//nav
	// $('.nav-load').load('components/nav.html');
//     var didScrollID = setTimer();
//     var didScroll = false,
//         lastScrollTop = 0,
//         delta = 120,
//         Wheight = $(window).height();
//         Wwidth = $(window).width();
//     $(window).resize(function () {
//         Wheight = $(window).height();
//         Wwidth = $(window).width();
//     });
//     function setTimer(){
//     	i = setInterval(function(){
//             if (didScroll) {
//                 hasScrolled();
//                 didScroll = false;
//             }
//     	}, 500);
//         return i;
//    }
    
//     $(window).scroll(function (event) {
//     	didScroll = true;
//     });
//     function hasScrolled() {
//     	clearInterval(didScrollID);
//         var st = $(this).scrollTop();
//         var $Tbottom = $(document).height() - Wheight - 120;
//         if (st > lastScrollTop && st > Wheight){
//             $('.nav').removeClass('is-active').addClass('is-hide');
//             $('.nav-index').removeClass('nav-index--click');
//             $(".menu, .sh-menu, .m-switch, #scrolling-switch").addClass('is--zero');
            
//             if ( st > $Tbottom ) {
//                 $('.nav').removeClass('is-hide').addClass('is-active');
//                 $('.nav-index').removeClass('nav-index--click');
//                 $(".menu, .sh-menu, .m-switch, #scrolling-switch").removeClass('is--zero');
//             }
//         } else {
//             if(st + Wheight < $(document).height()) {
//                 $('.nav').removeClass('is-hide').addClass('is-active');
//                 $(".menu, .sh-menu, .m-switch, #scrolling-switch").removeClass('is--zero');
//             }
//         }
//         if (st < $(".nav-content").height()) {
//             $('.nav-index').addClass('nav-index--click');
//         } else {
//             $('.nav-index').removeClass('nav-index--click');
//         }

//         //docking anchors
//         var mHeaderHeight=$('.m-header').outerHeight(true);
//         if(st > mHeaderHeight){
//             $('#scrolling-switch').addClass('is--fixedtop');
//         }else{
//             $('#scrolling-switch').removeClass('is--fixedtop');
//         }
        
//         lastScrollTop = st;
//         didScrollID = setTimer();
//     }
    
// 	//footer
// 	$('.footer-load').load('components/footer.html');
// 	$('.footer-trigger').click(function(){				
// 		$(".footer-load").slideToggle(500);	
// 		$(".footer-trigger__icon").toggleClass("is--active");
// 	});
//     $('.footer-cy').load('components/copyright.html');
//     $('.footer-owner').load('components/company.html');
    
    