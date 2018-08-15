$(document).ready(function(){
  // $('.div_checkoutProductQuantity').each(function(){
  //   var _this=$(this);
  //   var add=$(_this).find('.a_add');
  //   var reduce=$(_this).find('.a_minus');
  //   var num=1;
  //   var num_txt=$(_this).find('.txt_quantity');
  //   $(add).click(function(){
  //     num = $(num_txt).val();
  //     num++;
  //     num_txt.val(num);
  //   });
  //   $(reduce).click(function(){
  //     num =  $(num_txt).val();
  //       if(num >0){
  //       if(num==1)
  //       { num--;
  //        num_txt.val("1");
  //       }
  //       else
  //       {
  //        num--;
  //        num_txt.val(num);
  //       }
  //      }
  //   });
  // })
  //商品刪除POPUP
  $( '.btn_checkoutDelete[enabled]' ).click(function() {
  	$('.div_maskCheckout').addClass('div_maskCheckout--show');
  	$('.div_checkoutPopDelete').addClass('div_checkoutPopDelete--show');
  });
  $( '.btn_popCancel, .btn_popDelete' ).click(function() {
  	$('.div_maskCheckout').removeClass('div_maskCheckout--show');
  	$('.div_checkoutPopDelete').removeClass('div_checkoutPopDelete--show');
  });
  //寄送選擇POPUP
  $( '.btn_checkoutSentChoice' ).click(function() {
  	$('.div_maskCheckout').addClass('div_maskCheckout--show');
  	$('.div_checkoutPopBox').addClass('div_checkoutPopBox--show');
  });
  //店鋪折扣POPUP
  $( '.btn_checkoutCoupon' ).click(function() {
  	$('.div_maskCheckout').addClass('div_maskCheckout--show');
  	$('.div_checkoutPopCouponStore').addClass('div_checkoutPopCouponStore--show');
  });
  //全站折扣POPUP
  $( '.btn_checkoutCouponStore' ).click(function() {
  	$('.div_maskCheckout').addClass('div_maskCheckout--show');
  	$('.div_checkoutPopCoupon').addClass('div_checkoutPopCoupon--show');
  });
  //Checkout mask
  $( '.div_maskCheckout' ).click(function() {
  	$(this).removeClass('div_maskCheckout--show');
  	$('.div_checkoutPopDelete').removeClass('div_checkoutPopDelete--show');
  	$('.div_checkoutPopBox').removeClass('div_checkoutPopBox--show');
  	$('.div_checkoutPopCoupon').removeClass('div_checkoutPopCoupon--show');
  	$('.div_checkoutPopCouponStore').removeClass('div_checkoutPopCouponStore--show');
  });
});
