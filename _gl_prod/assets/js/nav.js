$(function() {
  //navOpen
  $( '.div_navIcon' ).click(function() {
  	$('.nav_headerCenter').addClass('nav_headerCenter--show');
  	$('.div_maskForSearch').removeClass('div_maskForSearch--show');
  	$('.login').removeClass('btn_loginNav');
  	$('.nav_member').removeClass('nav_member--show');
  	$('.div_mask').addClass('div_mask--show');
  	$('.div_mask').css({'zIndex':'1002'});
  	$('.div_searchBar').slideUp();
  });
  //navMemebr
  $( '.login' ).click(function() {
  	$(this).toggleClass('btn_loginNav');
  	$('.div_maskForSearch').removeClass('div_maskForSearch--show');
  	$('.div_mask').toggleClass('div_mask--show');
  	$('.div_mask').css({'zIndex':'999'});
  	$('.div_searchBar').slideUp();
  	$('.nav_member').toggleClass('nav_member--show');
  });
  //navClose
  $( '.div_navCloseIcon' ).click(function() {
  	$('.nav_headerCenter').removeClass('nav_headerCenter--show');
  	$('.div_mask').removeClass('div_mask--show');
  });
  //search
  $( '.a_search' ).click(function() {
  	$('.div_searchBar').slideToggle();
  	$('.div_mask').removeClass('div_mask--show');
  	$('.login').removeClass('btn_loginNav');
  	$('.nav_member').removeClass('nav_member--show');
  	$('.div_maskForSearch').toggleClass('div_maskForSearch--show');
  });
  //mask
  $( '.div_mask' ).click(function() {
  	$('.nav_headerCenter').removeClass('nav_headerCenter--show');
  	$(this).removeClass('div_mask--show');
  	// $('.div_searchBar').slideUp();
  	$('.login').removeClass('btn_loginNav');
  	$('.nav_member').removeClass('nav_member--show');
  });
  $( '.div_maskForSearch' ).click(function() {
  	$(this).removeClass('div_maskForSearch--show');
  	$('.div_searchBar').slideUp();
  });
});
