var go = function(){
  if($(".theme_Slider").length > 0){
    $.each($(".theme_Slider"),function(i,v){
      if($(v).find('.oneByOne').length == 2){
        var owl = $(v).find('.oneByOne');
          var next = $(v).find(".next");
          var prev = $(v).find(".prev");
          owl.owlCarousel({
            loop:true,
            margin:0,
            responsiveClass:true,
            autoplay:true,
            autoplayTimeout:5000,
            touchDrag:false,
            freeDrag:false,
            mouseDrag:false,
            pullDrag:false,
            responsive:{
              0:{
                items:1,
                nav:true
              }
            }
          })
          next.click(function() {
            owl.trigger('next.owl.carousel');
          })
          prev.click(function() {
            owl.trigger('prev.owl.carousel', [300]);
          })
          }
    });
  }
  }
$(document).ready(function() {
  go();
});
$(document).ready(function() {
  //nav_Action
  $( ".hamber" ).click(function() {
    $('body').toggleClass('hide-overlay');
    $(this).toggleClass('hamber_onclick');
  });
  //ScrollAnimation
  function animateDivers(){
    $('.down').delay(2500).animate({bottom:'25px',width:'25px'},250,'easeInCirc').animate({bottom:'30px',width:'30px'},250,'easeOutCirc').animate({bottom:'25px',width:'25px'},250,'easeInCirc').animate({bottom:'30px',width:'30px'},250,'easeOutCirc',animateDivers)
  }
  animateDivers();
});

$(window).scroll(function() {
  if ($(this).scrollTop()>200){
    $('.navMain').addClass('navMain_bg');
    $('.navBottom').addClass('navBottom_show');
  }else if ($(this).scrollTop()<200){
    $('.navMain').removeClass('navMain_bg');
    $('.navBottom').removeClass('navBottom_show');
  };
});

function addbtnstyle(object , href){
  var windowTop = $(window).scrollTop()
  var windowH = $(window).height()
  var showTime = windowTop + windowH / 2
  if(showTime >= object.offset().top){
  	//href.addClass('arrive');
    $.each($('.navBottomInner a'),function(i,v){
      //console.log($(v));
      //console.log(href);
        if($(v).data('id') != href.data('id')){
          $(v).removeClass('arrive');
        }else{
          href.addClass('arrive');
        }
    });
  }
  // href.bind('click',function(){
  //
  // });
}

$(window).scroll(function () {
  // $(this).bind('scroll');
  addbtnstyle($('.navbtnATop'),$('.navbtnA'));
  addbtnstyle($('.navbtnBTop'),$('.navbtnB'));
  addbtnstyle($('.navbtnCTop'),$('.navbtnC'));
  addbtnstyle($('.navbtnDTop'),$('.navbtnD'));
  addbtnstyle($('.navbtnETop'),$('.navbtnE'));
  
});

//NavScroll
$(document).on("click", ".navbtnA", function(){
  // $(window).unbind('scroll');
  $('html,body').animate({
		scrollTop: $(".navbtnATop").offset().top},'slow'),
    $(this).addClass('arrive').siblings().removeClass('arrive');
});
$(document).on("click", ".navbtnB", function(){
  // $(window).unbind('scroll');
		$('html,body').animate({
			scrollTop: $(".navbtnBTop").offset().top},'slow'),
      $(this).addClass('arrive').siblings().removeClass('arrive');
});
$(document).on("click", ".navbtnC", function(){
  // $(window).unbind('scroll');
		$('html,body').animate({
			scrollTop: $(".navbtnCTop").offset().top},'slow'),
      $(this).addClass('arrive').siblings().removeClass('arrive');
});
$(document).on("click", ".navbtnD", function(){
  // $(window).unbind('scroll');
		$('html,body').animate({
			scrollTop: $(".navbtnDTop").offset().top},'slow'),
      $(this).addClass('arrive').siblings().removeClass('arrive');
});
$(document).on("click", ".navbtnE", function(){
  // $(window).unbind('scroll');
		$('html,body').animate({
			scrollTop: $(".navbtnETop").offset().top},'slow'),
      $(this).addClass('arrive').siblings().removeClass('arrive');
});

//
$(document).on("click", ".jumpA", function(){
		$('html,body').animate({
			scrollTop: $(".jumpA-get").offset().top},'slow')
});
$(document).on("click", ".jumpB", function(){
		$('html,body').animate({
			scrollTop: $(".jumpB-get").offset().top},'slow')
});
$(document).on("click", ".jumpC", function(){
		$('html,body').animate({
			scrollTop: $(".jumpC-get").offset().top},'slow')
});
$(document).on("click", ".jumpD", function(){
		$('html,body').animate({
			scrollTop: $(".jumpD-get").offset().top},'slow')
});
$(document).on("click", ".jumpE", function(){
		$('html,body').animate({
			scrollTop: $(".jumpE-get").offset().top},'slow')
});

