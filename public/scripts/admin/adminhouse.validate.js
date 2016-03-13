var Validate = {
	of : function(o, msgName, output) {
		this.__input = o;
		this.__inputVal = $.trim(o.val());
		this.__inputMsg = msgName || '';
		this.__output = output;
		return this;
	},

	val : function() {
		return this.__inputVal;
	},

	msg : function() {
		return this.__inputMsg;
	},

	isNotEmpty : function() {
		return this.val() != '';
	},

	isInt : function() {
		return __isInt(this.val());
	},

	isUnsignedInt : function() {
		return __isUnsignedInt(this.val());
	},

	isPositiveInt : function() {
		return __isPositiveInt(this.val());
	},

	isUnsignedNumber : function() {
		return __isUnsignedNumber(this.val());
	},

	isPositiveNumber : function() {
		return __isPositiveNumber(this.val());
	},

	isUnsignedNumberLimitScale : function(scale) {
		return __isUnsignedNumberLimitScale(this.val(), scale);
	}

};



var inputArea = $('#inputArea');
var inputComm = $('#inputComm');

var inputHouseTitle = $('#inputHouseTitle');


function enableTitle(self) {
	var inputHouseTitle = $('#inputHouseTitle');
	if (inputHouseTitle.attr("disabled")) {
		inputHouseTitle.removeAttr("disabled");
		$(self).text('自动生成');
	} else {
		inputHouseTitle.attr("disabled", "disabled");
		$(self).text('手动编辑');
		generateTitle();
	}
}


function registerListeners(myTarget) {
	var selLabel = myTarget.find('.seled');
	var optiondef = myTarget.find('.house-optiondef');
	var optiondefLi = optiondef.find('ul li');
	if (optiondef && optiondefLi) {
		myTarget.focus(function() {
			optiondef.show();
		}).blur(function() {
			optiondef.hide();
			if (selLabel.data('trtitle')) {
				generateTitle();
			}
		});
		optiondefLi.click(function() {
			var who = $(this);
			selLabel.text(who.text());

			if (who.data('id') == '0') {
				selLabel.removeData('valueid');
				selLabel.removeAttr('data-valueid');
			} else {
				selLabel.data('valueid', who.data('id'));
				selLabel.attr('data-valueid', who.data('id'));
			}

			optiondef.hide();
			myTarget.blur();
		});
	} 
}

// 分别给含有选项的属性注册选择器
$('.house-selectordef').each(function() {
	registerListeners($(this));
});




function __generateInputSelOps(output) {
	// 验证下拉列表选项
	var selLabels = $('.house-selectordef .seled');
	var optionSelections = [];
	selLabels.each(function() {
		var who = $(this);
		var whoField = who.data('field');
		optionSelections.push(whoField + '=' + (who.data('valueid') || '0'));
	});
	var optionSelectionsStr = $.trim(optionSelections.join('&'));
	console.log(optionSelectionsStr);
	return optionSelectionsStr;
}

function __checkEmpty (o, target, msg, hasMore) {
	Validate.of(o);
	if (!Validate.isNotEmpty()) {
		showToast('请填写' + msg);
		o.focus();
		return false;
	}
	if (!hasMore) {
		target.push(o.attr('name') + '=' + $.urlencode(Validate.val()));
	}
	return true;
}

function __checkIntInput (o, target, msg, msgEmpty, msgOver0, msgNeg) {
	Validate.of(o);
	// 如果不需要处理为空的情况
	if (!Validate.isNotEmpty() && !msgEmpty) {
		target.push(o.attr('name') + '=' + '0');
		return true;
	}

	if (!__checkEmpty(o, target, msg, true)) return false;

	if (msgOver0) {
		if (!Validate.isPositiveInt()) {
			showToast(msg + '必须为大于0的整数');
			o.focus();
			return false;
		}
	} else {
		if ((msgNeg && !Validate.isInt()) || (!msgNeg && !Validate.isUnsignedInt())) {
			showToast(msg + '必须为整数');
			o.focus();
			return false;
		}
	}
	target.push(o.attr('name') + '=' + Validate.val());
	return true;
}

function __checkDecimalInput (o, target, msg, msgEmpty, msgOver0) {
	Validate.of(o);
	// 如果不需要处理为空的情况
	if (!Validate.isNotEmpty() && !msgEmpty) {
		target.push(o.attr('name') + '=' + '0.00');
		return true;
	}

	if (!__checkEmpty(o, target, msg, true)) return false;

	if (msgOver0) {
		if (!Validate.isPositiveNumber()) {
			showToast(msg + '必须为大于0的数值');
			o.focus();
			return false;
		}
	} else {
		if (!Validate.isUnsignedNumber()) {
			showToast(msg + '必须为数值');
			o.focus();
			return false;
		}
	}

	if (!Validate.isUnsignedNumberLimitScale(2)) {
		showToast(msg + '只能保留两位小数');
		o.focus();
		return false;
	}
	target.push(o.attr('name') + '=' + Validate.val());
	return true;
}

// 检查值是否为空，不为空则填充
function __checkIfSet (o, target) {
	target.push(o.attr('name') + '=' + $.urlencode(Validate.of(o).val()));
}




// 自动补全
var houseTooltip = $('.house-tooltip');
var houseAutoCompleteul = houseTooltip.find('.house-autoCompleteul');
var houseAutoCompleteulli = houseAutoCompleteul.find('li');
houseAutoCompleteulli.hide();
var lastInputComm;
inputComm.keyup(function () {
	clearInputCommBlurTimeout();

	var val = Validate.of(inputComm).val();
	if (!Validate.isNotEmpty()) {
		dismissCommDropdown();
		return;
	}
	var howmany = 0;
	houseAutoCompleteulli.each(function() {
		var whichli = $(this);
		if (whichli.data('pinyin').indexOf(val) >= 0 || whichli.data('name').indexOf(val) >= 0) {
			howmany ++;
			whichli.show();
		} else {
			whichli.hide();
		}
	});
	if (howmany > 0) {
		houseTooltip.show();
	} else {
		houseTooltip.hide();
	}
	lastInputComm = val;
});

houseAutoCompleteulli.click(function() {
	var whichli = $(this);
	inputComm.val(whichli.data('name'));
	inputComm.data('id', whichli.data('id'));
	inputComm.data('name', whichli.data('name'));

	generateTitle();
	dismissCommDropdown();
}) ;

function dismissCommDropdown() {
	clearInputCommBlurTimeout();

	houseTooltip.hide();
	houseAutoCompleteulli.hide();
}

function clearInputCommBlurTimeout() {
	if (inputCommBlurTimeout) {
		clearTimeout(inputCommBlurTimeout);
		inputCommBlurTimeout = undefined;
	}
}

var inputCommBlurTimeout;
inputComm.blur(function() {
	inputCommBlurTimeout = setTimeout('dismissCommDropdown();', 500);
});













