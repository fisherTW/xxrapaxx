$(window).scroll(function() {
  var windowTop = $(window).scrollTop();
  var windowH = $(window).height();
  var footH = $('.footer_new').offset().top;
  var btnHidden = windowTop + windowH;
  var navTabH = $('.tab-content').offset().top;
  if(footH > btnHidden){
      $('.div_btnAll').stop(true,false).animate({
          bottom:0
      },0);
  } else if(footH < btnHidden){
    $('.div_btnAll').stop(true,false).animate({
        bottom:-60
    },0);
  }
  if((navTabH - 99) > windowTop){
    $('.div_PlanProjectTabBar').removeClass('div_PlanProjectTabBar--show');
  } else if((navTabH - 99) < windowTop){
    $('.div_PlanProjectTabBar').addClass('div_PlanProjectTabBar--show');
  }
});
$(function() {
  $('.nav-tabs li').bind('click',function(){
    theOffset = $('.tab-content').offset();
    $('body,html').animate({
      scrollTop: theOffset.top - 98
    });
  });
  $( '.btn_support' ).click(function() {
    $('.div_support').css('display','block');
    var windowW = $(window).width();
    supportOffset = $('.div_support').offset();
    if(windowW > 991){
      $('body,html').animate({
        scrollTop: supportOffset.top - 140
      });
    } else if(windowW <= 991){
      $('body,html').animate({
        scrollTop: supportOffset.top - 100
      });
    }
  });
});
//svg
jQuery('img.svg').each(function(){
  var $img = jQuery(this);
  var imgID = $img.attr('id');
  var imgClass = $img.attr('class');
  var imgURL = $img.attr('src');
  jQuery.get(imgURL, function(data) {
    var $svg = jQuery(data).find('svg');
    if(typeof imgID !== 'undefined') {
        $svg = $svg.attr('id', imgID);
    }
    if(typeof imgClass !== 'undefined') {
        $svg = $svg.attr('class', imgClass+' replaced-svg');
    }
    $svg = $svg.removeAttr('xmlns:a');
    if(!$svg.attr('viewBox') && $svg.attr('height') && $svg.attr('width')) {
        $svg.attr('viewBox', '0 0 ' + $svg.attr('height') + ' ' + $svg.attr('width'))
    }
    $img.replaceWith($svg);
  }, 'xml');
});