var a = false, b = false;
	//nav
	$('.nav-load').load('components/nav.html');
    var didScrollID = setTimer();
    var didScroll = false,
        lastScrollTop = 0,
        delta = 120,
        Wheight = $(window).height();
        Wwidth = $(window).width();
    $(window).resize(function () {
        Wheight = $(window).height();
        Wwidth = $(window).width();
    });
    function setTimer(){
    	i = setInterval(function(){
            if (didScroll) {
                hasScrolled();
                didScroll = false;
            }
    	}, 500);
        return i;
   }
    
    $(window).scroll(function (event) {
    	if( a == false && b == false){
        	didScroll = true;
    	}
    });
    function hasScrolled() {
    	clearInterval(didScrollID);
        var st = $(this).scrollTop();
        var $Tbottom = $(document).height() - Wheight - 120;
        if (st > lastScrollTop && st > Wheight){
            $('.nav').removeClass('is-active').addClass('is-hide');
            $('.nav-index').removeClass('nav-index--click');
            $(".menu, .sh-menu, .m-switch, #scrolling-switch").addClass('is--zero');
            $(".sh-menu").addClass('is--z8');
            $('.sh-menu-btns, .m-switch').addClass('bb');
            
            if ( st > $Tbottom ) {
                $('.nav').removeClass('is-hide').addClass('is-active');
                $('.nav-index').removeClass('nav-index--click');
                $(".menu, .sh-menu, .m-switch, #scrolling-switch").removeClass('is--zero');
                $(".sh-menu").removeClass('is--z8');
                $('.sh-menu-btns, .m-switch').removeClass('bb');
                
            }
        } else {
            if(st + Wheight < $(document).height()) {
                $('.nav').removeClass('is-hide').addClass('is-active');
                $(".menu, .sh-menu, .m-switch, #scrolling-switch").removeClass('is--zero');
                $(".sh-menu").removeClass('is--z8');
                $('.sh-menu-btns, .m-switch').removeClass('bb');
                
            }
        }
        if (st < $(".nav-content").height()) {
            $('.nav-index').addClass('nav-index--click');
            $('.mainbar-aside-search input').removeClass('is--focus');
            $('.mainbar-aside__cs').stop(true,false).animate({marginRight:0},200).removeClass('is--rightline');
            $('.search-category').slideUp(10);
            $('.mask').hide();
        } else {
            $('.nav-index').removeClass('nav-index--click');
        }
        //menu docking would be changed under width 1024
        if (Wwidth > 1024) {
            var fake_div = "<div id='fake_id' style='height:"+$('.menu').height()+"px;'></div>";
            if(st > ($('.header, .s-header').height() - $(".nav-content").height())) {
            	if($('#fake_id').length < 1){
                	$( ".menu" ).before( fake_div );
            	}
                $('.menu').addClass('is--fixedtop');
            }else{
            	$('#fake_id').remove();
                $('.menu').removeClass('is--fixedtop');
            }
        }
        //others docking for all screen
        if(st > ($('.sh-header, .m-header').height())) {
            $('.sh-menu, .m-switch').addClass('is--fixedtop');
            $('.sh-menu-btns').addClass('bb');
            $(".sh-menu").addClass('is--z8');
            $(".mask-store").addClass('is--z6');
        }else{
            $('.sh-menu, .m-switch').removeClass('is--fixedtop');
            $('.sh-menu-btns').removeClass('bb');
            $(".sh-menu").removeClass('is--z8');
            $(".mask-store").removeClass('is--z6');
        } 
        //product page for switch
        var ghH = $('.g-header').outerHeight(),
            gcH = $('.g-cart').outerHeight(),
            gbH = 216;
        var total_gH = ghH + gcH + gbH;
        if(st > total_gH){
            $('#scrolling-switch').addClass('is--fixedtop');
            $('.g-main-brand').css('margin-bottom','54px');
        }else{
            $('#scrolling-switch').removeClass('is--fixedtop');
            $('.g-main-brand').css('margin-bottom','0');
        }
        /// ----- 訂單明細 商店 Docking 只有小螢幕 start ----- ///
        // if ($(window).width() <= 414) {
        //     if (st > lastScrollTop && st > Wheight){
        //         $('#store001').children('.store-brand').addClass('is--zero');
        //         $('#store002').children('.store-brand').addClass('is--zero');
        //         if ( st > $Tbottom ) {
        //            $('#store001').children('.store-brand').removeClass('is--zero'); 
        //            $('#store002').children('.store-brand').removeClass('is--zero');
        //         }
        //     }else{
        //         $('#store001').children('.store-brand').removeClass('is--zero');
        //         $('#store002').children('.store-brand').removeClass('is--zero');
        //     }
        //     //滾到商店1
        //     if(st > $("#store001").offset().top - 120) {
        //         $('#store001').children('.store-brand').addClass('is--fixedtop');
        //         $("#store001").siblings().children('.store-brand').removeClass('is--fixedtop');
        //     }else{
        //         $('#store001').children('.store-brand').removeClass('is--fixedtop');
        //     }
        //     //滾到商店2
        //     if(st > $("#store002").offset().top - 120) {
        //         $('#store002').children('.store-brand').addClass('is--fixedtop');
        //         $("#store002").siblings().children('.store-brand').removeClass('is--fixedtop');
        //     }else{
        //         $('#store002').children('.store-brand').removeClass('is--fixedtop');
        //     }
        //     //滾到訂單資訊，所有商品的 Docking 都解除
        //     if (st > $('.c-confirm').offset().top - 80) {
        //         $('.store-brand').removeClass( "is--fixedtop" );
        //     }
        // } 
        /// ----- 訂單明細 商店 Docking end ----- ///


        lastScrollTop = st;
        didScrollID = setTimer();
    }
    
	//footer
	$('.footer-load').load('components/footer.html');
	$('.footer-trigger').click(function(){				
		$(".footer-load").slideToggle(500);	
		$(".footer-trigger__icon").toggleClass("is--active");
	});
    $('.footer-cy').load('components/copyright.html');
    $('.footer-owner').load('components/company.html');
    
    //shopbag load
    $('.shopbag-load').load('components/shopbag.html');
    //share copy URL
    $(".share-href__copy").click(function(){
        $('.share-href__input').select();
        document.execCommand('copy');
        // $('input').blur();
        $('.sharestyle, .mask-z').fadeOut(200);
        $('.icons__share').removeClass('is--active');
        swal({
            title: "已複製連結",
            type: "success",
            timer: 1000,
            confirmButtonColor: "#f7b500",
            showConfirmButton: false,
            customClass: 'success-btn',
        });
        // scroll unlock
        var scrollPosition = [
        self.pageXOffset || document.documentElement.scrollLeft || document.body.scrollLeft,
        self.pageYOffset || document.documentElement.scrollTop  || document.body.scrollTop
        ];
        var html = jQuery('html');
        var scrollPosition = html.data('scroll-position');
        html.css('overflow', html.data('previous-overflow'));
        window.scrollTo(scrollPosition[0], scrollPosition[1]);
    });

    //R18 pop up
    $('.R18').not('img.R18').click(function(){
        $('.R18-popup').fadeIn(100);
    });
    $('.R18-popup-box-btns li, .R18-popup__bg').click(function(){
        $('.R18-popup').fadeOut(100);
    });
