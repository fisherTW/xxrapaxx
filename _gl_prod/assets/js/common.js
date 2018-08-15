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
            // $('.nav-index').removeClass('nav-index--click');

            if ( st > $Tbottom ) {
                $('.nav').removeClass('is-hide').addClass('is-active');
                // $('.nav-index').removeClass('nav-index--click');

            }
        } else {
            if(st + Wheight < $(document).height()) {
                $('.nav').removeClass('is-hide').addClass('is-active');

            }
        }
        if (st < $(".nav-content").height()) {
            // $('.nav-index').addClass('nav-index--click');
            $('.mainbar-aside-search input').removeClass('is--focus');
        } else {
            // $('.nav-index').removeClass('nav-index--click');
        }

        lastScrollTop = st;
        didScrollID = setTimer();
    }


    //footer
    $('.footer-load').load('components/footer.html');
    $('.footer-trigger').click(function(){
        $(".footer-load").slideToggle(500);
        $(".footer-trigger__icon").toggleClass("is--active");
    });

    //copyright
    $('.footer-cy').load('components/copyright.html');

    //like toggle
    $('.list__like').click(function(){
        $(this).toggleClass('is--active');
    });
    $('.list__share').click(function(){
        $(this).toggleClass('is--active');
    });
