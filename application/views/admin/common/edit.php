		<style type="text/css">
		/* style 专门就写在这边 */
		#overlayer {
			background-attachment: scroll;
			background-color: #000;
			height: 100%;
			left: 0;
			opacity: 0.6;
			position: fixed;
			top: 0;
			width: 100%;
			z-index: 100
		}

		#loadbox {
			height: 100%;
			left: 0;
			position: absolute;
			text-align: center;
			top: 20%;
			width: 100%;
			z-index: 101
		}

		.loadlayer {
			background: none repeat scroll 0 0 #f4f1f4;
			display: block;
			margin: 0 auto;
			padding: 10px 20px;
			position: relative;
			text-align: center;
			width: auto;
			max-width: 500px;
		}

		.loadlayer .close {
			position: absolute;
			right: 20px;
			top: 10px;
			font-size: 20px;
			line-height: 20px;
			opacity: .5;
			filter: alpha(opacity=50);
		}

		.loadlayer .close img {
			height: 20px;
			width: 20px
		}
		</style>

		<div id="overlayer" style="display:none;">
			
		</div>

		<div id="loadbox" style="display:none;">
		    <div id="loadlayer-add" class="loadlayer" style="display:none;">
		        <a href="javascript:void(0)" class="close" onclick="add_layer_close();">
		        	<img src="public/img/admin/close.png" />
		        </a>

		        <div class="house-edit-input-container">
		        	<span class="f-red" style="margin-bottom: 10px; float: left;" >*多行批量上传</span>

		        	<textarea id="inputAddCommon"  class="form-control house-related-long" rows="5" placeholder=""></textarea>

					<button type="button" class="btn btn-primary" style="margin-top: 10px; float: left;" onclick="return addCommonAjax();">
						&nbsp;&nbsp;&nbsp;添&nbsp;&nbsp;&nbsp;&nbsp;加&nbsp;&nbsp;&nbsp;
					</button>

					<div class="fl-clear"></div>
				</div>
		    </div>


		    <div id="loadlayer-edit" class="loadlayer" style="display:none;">
		        <a href="javascript:void(0)" class="close" onclick="edit_layer_close();">
		        	<img src="public/img/admin/close.png" />
		        </a>

		        <div class="house-edit-input-container">
		        	<input type="text" id="inputEditCommon" class="form-control house-related-long" >

					<button type="button" class="btn btn-primary" style="margin-top: 10px; float: left;" onclick="return editCommonAjax();">
						&nbsp;&nbsp;&nbsp;提&nbsp;&nbsp;&nbsp;&nbsp;交&nbsp;&nbsp;&nbsp;
					</button>

					<div class="fl-clear"></div>
				</div>
		    </div>
	    </div>
	    <script type="text/javascript">
	    var inputAddCommon = $('#inputAddCommon');
	    var inputAddCommonDoWhat;
	    function add_layer_show(paramDoWhat) {
	    	inputAddCommon.val('');

	    	inputAddCommonDoWhat = paramDoWhat;
			
			$("#loadbox").show();
			$("#overlayer").show();
			$('#loadlayer-add').show();
	    }

	    function add_layer_close() {
	    	inputAddCommon.val('');
	    	inputAddCommonDoWhat = undefined;

			$("#loadbox").hide();
			$("#overlayer").hide();
			$('#loadlayer-add').hide();
	    }

	    function addCommonAjax() {
	    	var val = $.trim(inputAddCommon.val());
	    	if (val == "") {
	    		showToast("请输入信息");
	    		return false;
	    	}
	    	var postData = "name=" + $.urlencode(val);
	    	console.log(postData);
			$.ajax({
				type: "POST",
				url: inputAddCommonDoWhat,
				dataType: "json",
				data: postData,
				success: function(data){
					if (data.code == 200) {
						(top || window).location.href = data.data;
					} else {
						showToast(data.msg);
					}
				},
				beforeSend:function(){

				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					showToast("出错了：" + textStatus);
				}
			});
	    	return true;
	    }

	    var inputEditCommon = $('#inputEditCommon');
	    var inputEditCommonDoWhat;
	    function edit_layer_show(paramDoWhat) {
	    	inputEditCommon.val('');

	    	inputEditCommonDoWhat = paramDoWhat;
	    	inputEditCommon.val(inputEditCommonDoWhat['name']);
			
			$("#loadbox").show();
			$("#overlayer").show();
			$('#loadlayer-edit').show();
	    }

	    function edit_layer_close() {
	    	inputEditCommon.val('');
	    	inputEditCommonDoWhat = undefined;

			$("#loadbox").hide();
			$("#overlayer").hide();
			$('#loadlayer-edit').hide();
	    }

		function editCommonAjax() {
	    	var val = $.trim(inputEditCommon.val());
	    	if (val == "") {
	    		showToast("请输入信息");
	    		return false;
	    	}
	    	if (val == inputEditCommonDoWhat['name']) {
	    		showToast("你没有做任何修改");
	    		return false;
	    	}
	    	var postData = "id=" + inputEditCommonDoWhat['id'] + "&name=" + $.urlencode(val);
			$.ajax({
				type: "POST",
				url: inputEditCommonDoWhat['url'],
				dataType: "json",
				data: postData,
				success: function(data){
					if (data.code == 200) {
						(top || window).location.href = data.data;
					} else {
						showToast(data.msg);
					}
				},
				beforeSend:function(){

				},
				error:function(XMLHttpRequest, textStatus, errorThrown){
					showToast("出错了：" + textStatus);
				}
			});
	    }
	    </script>


