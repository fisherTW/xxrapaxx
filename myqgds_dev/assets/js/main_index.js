

//------------plugin-------------//
//swiper-top
// var swiper = new Swiper('.header .swiper-container', {
//     pagination: '.swiper-pagination',
//     paginationClickable: true,
//     centeredSlides: true,
//     autoplay: 5000
// });
//swiper-funding
var swiperCart = new Swiper('.funding-focus', {
	nextButton: '.focusNext',
	prevButton: '.focusPrev',
	centeredSlides: true,
    autoplay: 5000
});
//swiper-project
var swiperCart = new Swiper('.project-list', {
	nextButton: '.projectNext',
	prevButton: '.projectPrev',
    slidesPerView: 2,
    spaceBetween: 20,
    breakpoints: {
        414: {
            slidesPerView: 1,
            spaceBetweenSlides: 0
        }
    }
});
// var swiperCart = new Swiper('.article-list', {
//     nextButton: '.articleNext',
//     prevButton: '.articlePrev',
//     slidesPerView: 2,
//     spaceBetween: 20,
//     breakpoints: {
//         414: {
//             slidesPerView: 1,
//             spaceBetweenSlides: 0
//         }
//     }
// });
// swiper-life 智造生活圈輪播
// var swiperCart = new Swiper('.life-routine', {
// 	nextButton: '.lifeNext',
// 	prevButton: '.lifePrev',
//     slidesPerView: 3,
//     spaceBetween: 20,
//     breakpoints: {
//         414: {
//             slidesPerView: 1,
//             spaceBetweenSlides: 0
//         }
//     }
// });

// 精選文章 img fit
  //fix height 0
$(window).ready(updateHeight);
$(window).resize(updateHeight);
function updateHeight()
{
  var picBox = $('.article .list__pic');
  var boxWidth = picBox.width();
  picBox.css('height', boxWidth/2);
}
$(function() {
  var imgFit = $('.article .list__pic a img');
  imgFit.each(function(){
    if($(this).width() / $(this).height() < $(this).parent().width() / $(this).parent().height()) {
      $(this).width("100%");
    } else {
      $(this).height("100%");
    }
  });
});
