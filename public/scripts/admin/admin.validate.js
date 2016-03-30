var avatar = $('#inputAvatar');
var user_name = $("#inputUsername");
var password = $("#inputPassword");
var password2 = $("#inputPassword2");
var true_name = $("#inputTrueName");
var sex = $('input[name="inputSex"]');
var contact_mobile = $("#inputMobile");
var qqchat = $("#inputQQ");
var email = $("#inputEmail");
var code_word = $("#inputCodeWord");

var inputVerCode = $('#inputCode');
var inputVerCodeImg = $('#inputCodeImg');
var changeInputVerCode = $('#change-inputcode');

var postIsProgressing;
function commonSignValidate(postUrl) {
	if (postIsProgressing) {
		return false;
	}

	var result = "";
	if (user_name && user_name.length > 0) {
		var val = $.trim(user_name.val());
		if (val == "") {
			showToast("请输入用户名");
			user_name.focus();
			return false;
		}
		result = "user_name=" + $.urlencode(val);
	}
	var pwdVal;
	if (password && password.length > 0) {
		var val = $.trim(password.val());
		if (val == "") {
			showToast("请输入密码");
			password.focus();
			return false;
		}
		if (val.length < 6) {
			showToast("密码长度至少6位");
			password.focus();
			return false;
		}
		pwdVal = val;
		result += "&password=" + hex_md5(val);
	}
	if (password2 && password2.length > 0) {
		var val = $.trim(password2.val());
		if (val != pwdVal) {
			showToast("两次密码不一致");
			password2.focus();
			return false;
		}
	}
	
	if (code_word && code_word.length > 0) {
	    var val = $.trim(code_word.val());
		if (val == "") {
			showToast("请输入注册码");
			code_word.focus();
			return false;
		}
		result += "&code_word=" + $.urlencode(val);
	}
	
	if (inputVerCode && inputVerCode.length > 0) {
	    var val = $.trim(inputVerCode.val());
		if (val == "") {
			showToast("请输入验证码");
			inputVerCode.focus();
			return false;
		}
		result += "&code=" + $.urlencode(val);
	}
	
	if (true_name && true_name.length > 0) {
		var val = $.trim(true_name.val());
		if (val == "") {
			showToast("请输入姓名");
			true_name.focus();
			return false;
		}
		result += "&true_name=" + $.urlencode(val);
	}

	var sex = $('input[name="inputSex"]:checked');
	if (sex && sex.length > 0) {
		var val = sex.val();
		result += "&sex=" + val;
	}

	if (contact_mobile && contact_mobile.length > 0) {
		var val = $.trim(contact_mobile.val());
		if (val == "") {
			showToast("请输入手机号");
			contact_mobile.focus();
			return false;
		}
		if (val.length != 11 || !__isUnsignedNumber(val)) {
			showToast("手机号必须为11位纯数字");
			contact_mobile.focus();
			return false;
		}
		result += "&contact_mobile=" + val;
	}
	if (qqchat && qqchat.length > 0) {
		var val = $.trim(qqchat.val());
		if (val != "") {
			if (!__isUnsignedNumber(val)) {
				showToast("QQ号必须为纯数字");
				qqchat.focus();
				return false;
			}
			result += "&qqchat=" + val;
		}
	}
	if (email && email.length > 0) {
		var val = $.trim(email.val());
		if (val != "") {
			if (!__isEmail(val)) {
				showToast("请输入正确的邮箱");
				email.focus();
				return false;
			}
			result += "&email=" + val;
		}
	}

	console.log(result);
	if (result.indexOf('&') == 0) {
		result = result.substr(1);
	}

	var postData = result;

	console.log(postData);

	postIsProgressing = showProgress();

	simplePost(postUrl, postData, {
		ok : function(data) {
			checkUploadAfterPost(postUrl, postData, data);
		},
		
		success : function(data) {
			__releaseProgress();
		},

		error : function(XMLHttpRequest, textStatus, errorThrown) {
			__releaseProgress();
			changeInputVerCodeFunc();
		},
		
		notok : function() {
		    changeInputVerCodeFunc();
		}
	});

	return true;
}


var userInfoRedirectUrl;
function checkUploadAfterPost(postUrl, postData, resultData) {
	postIsProgressing = showProgress();
	userInfoRedirectUrl = resultData.data;
	if (avatar.data('src')) { // 如果没有设置图片资源
		doOnUploadSuccess();
		return ;
	}
	if (!avatar.attr('src')) {
		doOnUploadSuccess();
		return ;
	}
	ZXXFILE.funUploadFile();
}

function doOnUploadSuccess (file, responseUrl) {
	if (userInfoRedirectUrl) {
		(top || window).location.href = userInfoRedirectUrl;
	}
	__releaseProgress();
}

function doOnUploadFailure (file, msg) {
	__releaseProgress();
	showToast("图片" + file.name + "上传失败！原因：" + msg);
}

function doOnUploadComplete() {

}

function changeAvatar() {
	upload_layer_show();
}
	
function setImagePreview(data) {
	avatar.removeAttr('src');
	avatar.removeData('src');
	if (data) {
		avatar.attr('src', data);
	}
}

function __releaseProgress() {
	hideProgress(postIsProgressing);
	postIsProgressing = false;
	userInfoRedirectUrl = undefined;
}

function changeInputVerCodeFunc() {
    inputVerCodeImg.attr('src', inputVerCodeImg.data('src'));
}
changeInputVerCode.click(changeInputVerCodeFunc);