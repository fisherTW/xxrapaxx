$(function() {
  //navOpen
  $( '.div_navIcon' ).click(function() {
  	$('.nav_headerCenter').addClass('nav_headerCenter--show');
  	$('.div_mask').addClass('div_mask--show');
  	$('.div_mask').css({'zIndex':'1002'});
  	$('.div_searchBar').slideUp();
  });
  //mask
  $( '.div_mask' ).click(function() {
  	$('.nav_headerCenter').removeClass('nav_headerCenter--show');
  	$(this).removeClass('div_mask--show');
  	$('.div_searchBar').slideUp();
  });
  //navClose
  $( '.div_navCloseIcon' ).click(function() {
  	$('.nav_headerCenter').removeClass('nav_headerCenter--show');
  	$('.div_mask').removeClass('div_mask--show');
  });
  //search
  $( '.a_search' ).click(function() {
  	$('.div_searchBar').slideToggle();
  	$('.div_mask').toggleClass('div_mask--show');
  	$('.div_mask').css({'zIndex':'999'});
  });
});
