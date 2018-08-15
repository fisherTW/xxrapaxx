function validateEmail(email) {
	//console.log(email);
  var re = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  //console.log(re.test(email));
  return re.test(email);
}

$( document ).ready(function() {
	$("#action_1").submit(function(event){
		event.preventDefault();
		$(this).find("input").removeClass('is--wrong');
		$(this).find("span").remove();
		var email_object = $(this).find("input[name='email']");
	    if (validateEmail(email_object.val())) {

	    } else {
	    		email_object.addClass('is--wrong');
	    		$( '<span class="ps__wrong">請輸入有效的電子郵件位址</span>' ).insertAfter(email_object);
	        return false;
	    }
	    var password_object = $(this).find("input[name='password']");
	    if (password_object.val().length > 0) {

	    } else {
	    		password_object.addClass('is--wrong');
    			$( '<span class="ps__wrong">請輸入6碼~16碼的密碼，密碼限用英文，數字或底線！</span>' ).insertAfter(password_object);
	        return false;
	    }
	    return true;
	});
	$("#action_2").submit(function(e){
		event.preventDefault();
		$(this).find("input").removeClass('is--wrong');
		$(this).find("span").remove();
		var name_object = $(this).find("input[name='showname']");
	    if (name_object.val().length > 0) {

	    } else {
	    		name_object.addClass('is--wrong');
	    		$( '<span class="ps__wrong">顯示名稱不能為空</span>' ).insertAfter(name_object);
	        return false;
	    }

		var email_object = $(this).find("input[name='email']");
	    if (validateEmail(email_object.val())) {

	    } else {
	    		email_object.addClass('is--wrong');
	    		$( '<span class="ps__wrong">請輸入有效的電子郵件位址</span>' ).insertAfter(email_object);
	        return false;
	    }
	    var password_object = $(this).find("input[name='password']");
	    if (password_object.val().length > 0) {

	    } else {
	    		password_object.addClass('is--wrong');
    			$( '<span class="ps__wrong">請輸入6碼~16碼的密碼，密碼限用英文，數字或底線！</span>' ).insertAfter(password_object);
	        return false;
	    }
	    var checkpassword_object = $(this).find("input[name='checkpassword']");
	    if (password_object.val() === checkpassword_object.val()) {

	    } else {
	    		checkpassword_object.addClass('is--wrong');
    			$( '<span class="ps__wrong">請再確認您的密碼是否正確！</span>' ).insertAfter(checkpassword_object);
	        return false;
	    }
	});
});
