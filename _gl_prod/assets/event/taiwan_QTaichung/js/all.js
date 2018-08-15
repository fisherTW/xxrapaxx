(function($) {  
    $.fn.watch = function(callback) {  
        return this.each(function() {
            
        $.data(this, 'originVal', $(this).val());  
  
            //event  
        $(this).on('input paste', function() {  
            var originVal = $(this, 'originVal');  
            var currentVal = $(this).val();  
            if (originVal !== currentVal) {  
                $.data(this, 'originVal', $(this).val());  
                    callback(currentVal);  
                }  
            });  
        });  
    };
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
})(jQuery);

if (!window.console){
	console = {};
	console.log = console.log || function() {
	};
	console.warn = console.warn || function() {
	};
	console.error = console.error || function() {
	};
	console.info = console.info || function() {
	};
}
var Wheight = window.innerHeight ? window.innerHeight : $(window).height();
var Wwidth = window.innerWidth ? window.innerWidth : $(window).width()
var max_width = 414;
$(window).resize(function () {
	Wheight = window.innerHeight ? window.innerHeight : $(window).height();
	Wwidth = window.innerWidth ? window.innerWidth : $(window).width()
});

$(document).ready(function () {
	$('.store-way').css('cursor','pointer'); //fix ios
	$('.info__like').css('cursor','pointer'); //fix ios
	$('.info__cart').css('cursor','pointer'); //fix ios
	$('.footer-trigger').css('cursor','pointer'); //fix ios
	$('.btns__rebuy').css('cursor','pointer'); //fix ios
	$('.count-up').css('cursor','pointer'); //fix ios
	$('.count-down').css('cursor','pointer'); //fix ios
	$('.g-cart__incart , .info__cart , .see-btns__cart').css('cursor','pointer'); //fix ios
	$('.store-goods__pic').css('cursor','pointer'); //fix ios
	cartTotal();
	$('.shopbag-load').load('/cartbag');
});

(function() {
    window.alert = function(message, callback) {
        callback = callback || function(){}
        
        var options =
        {
            title: arguments[0],
            // imageUrl: "https://storage.googleapis.com/rapaq_public/login_icon/Rapaq.svg",
            customClass: 'single-btn'
        }
        if(typeof(message) === "object")
        {
            options = message;
        }

        sweetAlert(options, callback);
    };
})(window.alert);

function swal_confirm(title, content, sure_title,cancel_title,sure_link) {
    swal({
      title: title,
      text: content,
      showCancelButton: true,
      // confirmButtonClass: "btn-danger",
      confirmButtonText: sure_title,
      cancelButtonText: cancel_title,
      closeOnConfirm: false,
      closeOnCancel: true,
      customClass: 'dobule-btn',
      html:true
    },
    function(isConfirm) {
      if (isConfirm) {
        location.href=sure_link;
      } 
    });
}
function swal_result(title, content, type, callback){

    var options =
    {
        title: title,
        text: content,
        customClass: 'single-btn',
        html:true
    }
    if(type=="rapaq"){
        options.imageUrl = "https://storage.googleapis.com/rapaq_public/login_icon/Rapaq.svg";
    }else{
        options.type = type;
    }
    sweetAlert(options,function(isConfirm){
        if(isConfirm){
            $('.sweet-alert').removeClass('sweetalert_cs');
            // console.log(callback);
            if (typeof callback !="undefined" && callback.length > 0) {
              location.href=callback;
            } else {
              swal.close();
            }
        }
      });
}

function notlogin(url) {
    $(window).load(function() {
        $("a#login_btn").trigger('click');
    });
    // setTimeout(function() {
    //     $("a#login_btn").trigger('click');
    // },100);
/*	  
    swal({
	    title: "請先登入",
	    //text: "是否登入",
	    imageUrl: "https://storage.googleapis.com/rapaq_public/login_icon/Rapaq.svg",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "是",
	    cancelButtonText: "否",
	    customClass:"dobule-btn",
	    closeOnConfirm: false,
	    closeOnCancel: false
	  },
	  function(isConfirm){
	    if (isConfirm) {
	      location.href=url;
	    } else {
	      swal.close();
	    }
	  });
*/
}
function notlogin2(url) {
    $(window).load(function() {
        $("a#login_btn").trigger('click');
    });
    // setTimeout(function() {
    //     $("a#login_btn").trigger('click');
    // },100);
/*
	  swal({
	    title: "請先登入",
	    //text: "是否登入",
	    imageUrl: "https://storage.googleapis.com/rapaq_public/login_icon/Rapaq.svg",
	    showCancelButton: true,
	    confirmButtonColor: "#DD6B55",
	    confirmButtonText: "是",
	    cancelButtonText: "否",
	    customClass:"dobule-btn",
	    closeOnConfirm: false,
	    closeOnCancel: false
	  },
	  function(isConfirm){
	    if (isConfirm) {
	      location.href=url;
	    } else {
	    	location.href="/";
	    }
	  });
*/      
}

function priceFormat($number, $currency, $value = '', $format = true) {
	var data;
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        data:{'number':$number , 'currency':$currency ,'value':$value ,'format':$format },
        async: false, //啟用同步請求
        url: '/priceFormat',
        success: function(res){
        	if(res.status){
        		//is--wrong
        		data = res;
        	}else{
        		data = false;
        	}
        }
    });
    return data;
}
function getFormData($form){
    var unindexed_array = $form.serializeArray();
    var indexed_array = {};

    $.map(unindexed_array, function(n, i){
        indexed_array[n['name']] = n['value'];
    });

    return indexed_array;
}
function post_to_url(path, params, method) {
    method = method || "post"; // Set method to post by default, if not specified.

    // The rest of this code assumes you are not using a library.
    // It can be made less wordy if you use one.
    var form = document.createElement("form");
    form.setAttribute("method", method);
    form.setAttribute("action", path);

    for(var key in params) {
        var hiddenField = document.createElement("input");
        hiddenField.setAttribute("type", "hidden");
        hiddenField.setAttribute("name", key);
        hiddenField.setAttribute("value", params[key]);

        form.appendChild(hiddenField);
    }

    document.body.appendChild(form);    // Not entirely sure if this is necessary
    form.submit();
}
function checknull(input){
	var data;
	data = false;
    if(isset(input) && input!=""){
    	data = true;
    }
    return data;
}
function checkEmail(email){
	var data;
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        data:{'email':email},
        async: false, //啟用同步請求
        url: '/checkEmail',
        success: function(res){
        	if(!res.status){
        		//is--wrong
        		data = false;
        	}else{
        		data = true;
        	}
        }
    });
    return data;
}
function checkAddr(addr){
	var data;
	data = false;
    if(isset(addr) && addr!=""){
    	data = true;
    }
    return data;
}
function checkZip(sZip){
	return /^[\d]+$/.test(sZip);
}
function checkName(name){
	var data;
	data = false;
    if(isset(name) && name!=""){
    	data = true;
    }
    return data;
}
function checkTel(tel){
	var data;
    jQuery.ajax({
        type: 'POST',
        dataType: 'json',
        data:{'tel':tel},
        async: false, //啟用同步請求
        url: '/checkTel',
        success: function(res){
        	if(!res.status){
        		//is--wrong
        		data = false;
        	}else{
        		data = true;
        	}
        }
    });
    return data;
}
function checkdata(type,fc,object){
    var error_msg = {
		'Name':'<div class="basic__ps"><span class="ps__wrong">您輸入的姓名格式錯誤</span>請填寫購買人姓名</div>',
		'Tel':'<div class="basic__ps"><span class="ps__wrong">您輸入的電話號碼格式錯誤</span>寄送人聯絡及付款確認使用。請填寫電話號碼全碼，如 0221231234 0912123456、+1415000000。</div>',
		'Zip':'<div class="basic__ps"><span class="ps__wrong">您輸入的郵遞區號格式錯誤</span>請填寫購買人郵遞區號</div>',
		'Addr':'<div class="basic__ps"><span class="ps__wrong">您輸入的地址格式錯誤</span>請填寫購買人寄送地址</div>',
		'Email':'<div class="basic__ps"><span class="ps__wrong">您輸入的email格式錯誤</span>請填寫購買人email</div>',
		'Editorial':'<div class="basic__ps"><span class="ps__wrong">您輸入的統一編號格式錯誤</span>請填寫統一編號</div>',
    }    
    if (typeof (fc) == 'function') { 

    	if(fc(object.val())){
    		object.removeClass( "is--wrong" );
    		object.next().remove();
    		return true;
       	}else{
       		object.removeClass( "is--wrong" ).addClass( "is--wrong" );
       		object.next().remove();
       		$.each(error_msg,function(i,v){
				if(i==type){
	        		object.after(v);
				}
           	});
    		return false;
        }
    }
}

function cartTotal(){
    jQuery.ajax({
        type: 'GET',
        dataType: 'json',
        async: false, //啟用同步請求
        url: '/cart/total',
        success: function(res){
			if(res.status){
				    $("#cart_ajax").html('<div class="cart__msg  msg-alert" id="cartnum">'+res.data+'</div>');
			}
        }
    });
}
//----------shop panel slide effect----------//
$(document).on('click','#cart_ajax',function(event){
	event.preventDefault();
	//alert('show_cart');
	show_cart();
});





$( ".search__input" ).bind('keypress',function(event) {

    if (event.which == 13) {
		if($(this).val().length != 0){
			var string = $(this).val();
			$(this).val('');
            string = remove_tags(string);
            // console.log(string);
			document.location.href="/search?name="+string;
		}
        return false;
    }
});
function remove_tags(string){ 
    return string.replace(/[\~|\`|\!|\@|\#|\$|\%|\^|\&|\*|\(|\)|\-|\_|\+|\=|\||\\|\[|\]|\{|\}|\;|\"|\'|\,|\<|\>|\/|\?]/g,""); 
}


function runScript(e) {

    if (e.keyCode == 13) {
		if($('#search').val().length != 0){
			var string = $('#search').val();
			$('#search').val('');
            string = remove_tags(string);
			document.location.href="/search?name="+string;
		}
        return false;
    }
    //return false;
}

function getCookie(cname) {
    var name = cname + "=";
    var decodedCookie = decodeURIComponent(document.cookie);
    var ca = decodedCookie.split(';');
    for(var i = 0; i <ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}

function getCountsFromCategory(){
    $.post('/get_counts_from_category',{data:data},function(limit){
        console.log(limit);
    });
}
//$('.btns__rebuy').css('cursor','pointer'); //fix ios
$(document).on("click", '.btns__rebuy', function () {
    //alert('用on綁定就沒有問題!!');
    hide_cart();
});


$('div[id=site_link]').click(function(){
        var href = $(this).attr('href');
        var title = $(this).attr('title');
        var target = $(this).attr('target');
        if(href == ""){
            swal_result(title,'Coming Soon!');
        }else{
            if(target == "_blank"){
                window.open(href, title);
            }else{
                location.href = href;
            }
        }
    });
//$('.footer-trigger').css('cursor','pointer'); //fix ios
$(document).on("click", '.footer-trigger', function () {
    $(".footer").toggleClass("active--2");
	$(".footer-load").slideToggle(500);	
	$(".footer-trigger__icon").toggleClass("is--active");
});
//$('.info__cart').css('cursor','pointer'); //fix ios
$(document).on("click", '.info__cart', function () {
	if(!$(this).hasClass( "is--active" )){
	    $(this).toggleClass('is--active');
	}
});
//$('.info__like').css('cursor','pointer'); //fix ios
$(document).on("click", '.info__like , .icons__like', function () {
    $(this).toggleClass('is--active');
    var pid = $(this).data('pid');
    //console.log(pid);
    add_favorite(pid);
});
$(document).on("click", '.store-goods__pic', function () {
    var href = $(this).data('href');
    document.location.href = href;
    
});

