function login() {
    var formobj=$("#loginForm");
	var loginname=formobj.find("input[name='user_name']");
	
	if(loginname.val()==""){
		loginname.focus();
		showToast("用户名不能为空");
		return false;
	}
	var postData = 'user_name=' + $.urlencode(loginname.val());
	
	var password=formobj.find("input[name='password']");
	if(password.val()==""){
		password.focus();
		showToast("密码不能为空");
		return false;
	}
	postData += '&password=' + hex_md5(password.val());
	
	var logincode=formobj.find("input[name='code']");
	if(logincode.val()==""){
		logincode.focus();
		showToast("验证码不能为空");
		return false;
	}
	postData += '&code=' + $.urlencode(logincode.val());
	
	simplePost('/login/ajax', postData, {
	    ok : function() {
	        (top || window).location.reload();
	    },
	    notok : function() {
	        change_logincode();
	    },
	    error : function() {
	        change_logincode();
	    }
	});
}

function register() {
    var formobj=$("#registForm");
	var loginname=formobj.find("input[name='user_name']");
	if(loginname.val()==""){
		loginname.focus();
		showToast("用户名不能为空");
		return false;
	}
	var postData = 'user_name=' + $.urlencode(loginname.val());
	
	var password=formobj.find("input[name='password']");
	if(password.val()==""){
		password.focus();
		showToast("密码不能为空");
		return false;
	}
	var confirm_pwd=formobj.find("input[name='confirm_pwd']");
	if(confirm_pwd.val()==""){
		confirm_pwd.focus();
		showToast("确认密码不能为空");
		return false;
	}
	if (password.val() != confirm_pwd.val()) {
	    confirm_pwd.focus();
		showToast("两次密码不一致");
		return false;
	}
	postData += '&password=' + hex_md5(password.val());
	
	var truename=formobj.find("input[name='true_name']");
	if(truename.val()==""){
		truename.focus();
		showToast("姓名不能为空");
		return false;
	}
	postData += '&true_name=' + $.urlencode(truename.val());
	
	var contact=formobj.find("input[name='contact_mobile']");
	if(contact.val()==""){
		contact.focus();
		showToast("联系方式不能为空");
		return false;
	}
	postData += '&contact_mobile=' + $.urlencode(contact.val());
	
	var logincode=formobj.find("input[name='code']");
	if(logincode.val()==""){
		logincode.focus();
		showToast("验证码不能为空");
		return false;
	}
	postData += '&code=' + $.urlencode(logincode.val());
	
	simplePost('/register/ajax', postData, {
	    ok : function() {
	        (top || window).location.reload();
	    },
	    notok : function() {
	        change_registcode();
	    },
	    error : function() {
	        change_registcode();
	    }
	});
}

function logout() {
    simplePost('/logout', '', {
	    ok : function() {
	        (top || window).location.reload();
	    }
	});
}

function change_logincode() {
    $("#logincode").get(0).src="/login_vercode?rand="+Math.random();
}

function change_registcode() {
    $("#registcode").get(0).src="/register_vercode?rand="+Math.random();
}

$("#change_registcode").click(function(){
	change_registcode();
});

$("#change_logincode").click(function(){
	change_logincode();
});
