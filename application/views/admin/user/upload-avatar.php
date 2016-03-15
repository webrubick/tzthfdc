

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

	#loadlayer {
		background: none repeat scroll 0 0 #f4f1f4;
		display: block;
		margin: 0 auto;
		padding: 10px 20px;
		position: relative;
		text-align: center;
		width: 640px
	}

	#loadlayer .close {
			position: absolute;
			right: 20px;
			top: 10px;
			font-size: 20px;
			line-height: 20px;
			opacity: .5;
			filter: alpha(opacity=50);
		}

	#loadlayer .close img {
		height: 20px;
		width: 20px
	}


	.upload_box {
		width: 100%;
		margin: 1em auto;
	}

	.upload_main {
		border-width: 1px 1px 2px;
		border-style: solid;
		border-color: #ccc #ccc #ddd;
		background-color: #fbfbfb;
	}

	.upload_choose {
		padding: 10px;
	}

	.fileInputContainer {
		display: block;
		float: left;
		height: 200px;
		width: 200px;
		line-height: 200px;
		position: relative;
		overflow: hidden;
	}

	.fileInput-dummy {
		max-height: 200px;
		max-width: 200px;
		margin: auto;
	}

	.fileInput {
		height: 100%;
		overflow: hidden;
		position: absolute;
    	font-size: 300px;
		right:0;
		top:0;
		opacity: 0;
		filter:alpha(opacity=0);
		cursor:pointer;
	}

	.upload_drag_area {
		display: block;
		float: right;
		width: 350px;
		height: 200px;
		line-height: 200px;

		border: 1px dashed #ddd;
		/*  background: #fff url(../img/java.jpg) no-repeat 20px center;*/
		color: #999;
		text-align: center;
		vertical-align: middle;
	}

	.upload_drag_hover {
		border-color: #069;
		box-shadow: inset 2px 2px 4px rgba(0, 0, 0, .5);
		color: #333;
	}

	.upload_preview {
		border-top: 1px solid #bbb;
		border-bottom: 1px solid #bbb;
		background-color: #fff;
		overflow: hidden;
		_zoom: 1;
	}

	.upload-image-container {
		height: 300px;
		padding: 0 10px;
		float: left;
		position: relative;
		width: 100%;
		box-sizing: border-box;
		-moz-box-sizing: border-box;
		-webkit-box-sizing: border-box;
	}

	.upload-image-container p {
		margin: 0 auto;
		width: 50%;
	}

	.upload_image {
		max-height: 250px;
		max-width: 250px;
		padding: 5px;
		-moz-box-sizing: border-box;
		box-sizing: border-box;
		-webkit-box-sizing: border-box;
	}

	.upload_progress {
		display: none;
		padding: 5px;
		border-radius: 10px;
		color: #fff;
		background-color: rgba(0,0,0,.6);
		position: absolute;
		left: 25px;
		top: 45px;
	}


	.upload_submit {
	  padding-top: 1em;
	  padding-left: 1em;
	}

	.upload_submit_btn {
	  display: none;
	  height: 32px;
	  font-size: 14px;
	}

	.upload_loading {
		height: 250px;
		background: url("<?php echo base_url('public/img/admin/loading.gif'); ?>") no-repeat center;
	}
	</style>
	
	<div id="overlayer" style="display:none;"></div>

	<div id="loadbox" style="display:none;">
	    <div id="loadlayer">
	        <a href="javascript:void(0)" class="close" onclick="upload_layer_close();">
	        	<img src="public/img/admin/close.png" />
	        </a>
            <form id="uploadForm" action="/upload" method="post" enctype="multipart/form-data">
                <div class="upload_box">
                    <div class="upload_main">
                        <div class="upload_choose">

                            <div class="fileInputContainer">
                            	<img class="fileInput-dummy" src="public/img/admin/demo_1.jpg" />
                                <input id="fileImage" size="30" class="fileInput" type="file" name="fileselect[]" />
                            </div>

                            <span id="fileDragArea" class="upload_drag_area">或者将图片拖到此处</span>
                            <div class="fl-clear"></div>
                        </div>
                        <div id="preview" class="upload_preview"></div>
                    </div>
                    <div class="upload_submit">
                        <button type="button" id="fileSubmit" class="upload_submit_btn">确认上传图片</button>
                    </div>
                    <div id="uploadInf" class="upload_inf"></div>
                </div>
            </form>
	    </div>
	</div>



	<script type="text/javascript" src="public/scripts/admin/zxxFile.js"></script>
	
	<script type="text/javascript">
		function upload_layer_show() {
			$("#loadbox").show();
			$("#overlayer").show();
		}

		function upload_layer_close() {
			$("#loadbox").hide();
			$("#overlayer").hide();
		}

		function prepare_upload(uploadUrl, funcOnSuccess) {
			var _myUrl = uploadUrl || $("#uploadForm").attr("action");
			var myJQ = $;
			var params = {
				fileInput: $("#fileImage").get(0),
				dragDrop: $("#fileDragArea").get(0),
				upButton: $("#fileSubmit").get(0),
				url: _myUrl,
				filter: function(files) {
				  var arrFiles = [];
				  for (var i = 0, file; file = files[i]; i++) {
				      if (file.type.indexOf("image") == 0 || (!file.type && /\.(?:jpg|png|gif|jpeg)$/.test(file.name) /* for IE10 */ )) {
				          if (file.size >= 512000000) {
				              alert('您这张"' + file.name + '"图片大小过大，应小于500k');
				          } else {
				              arrFiles.push(file);
				          }
				      } else {
				          alert('文件"' + file.name + '"不是图片。');
				      }
				  }
				  return arrFiles;
				},
				onSelect: function(files) {
					// 如果没有文件选中，则清空状态
					if (!files || !files[0]) {
						$("#preview").html('');
						$("#fileSubmit").fadeOut();
						return ;
					}
				  	$("#preview").html('<div class="upload_loading"></div>');
				  	var file = files[0];
				  	var reader = new FileReader();
					reader.onload = function(e) {
						var html = '<div id="uploadImageContainer" class="upload-image-container">'
										+ '<p>'
											+ '<strong>' + file.name + '</strong>'
											+ '<img id="uploadImage" src="' + e.target.result + '" class="upload_image" />'
										+ '</p>'
										+ '<span id="uploadProgress" class="upload_progress"></span>'
									+ '</div>';
						$("#preview").html(html);
						//提交按钮显示
						$("#fileSubmit").show();
					};
					reader.readAsDataURL(file);	
				},
				onDelete: function(file) {
					$("#fileSubmit").fadeOut();
					$("#preview").html('');
				},
				onDragOver: function() {
				  $(this).addClass("upload_drag_hover");
				},
				onDragLeave: function() {
				  $(this).removeClass("upload_drag_hover");
				},
				onProgress: function(file, loaded, total) {
					var eleProgress = $("#uploadProgress"),
					    percent = (loaded / total * 100).toFixed(2) + '%';
					eleProgress.show().html(percent);
				},
				onSuccess: function(file, response) {
				    $("#uploadInf").append("<p>上传成功，图片地址是：" + response + "</p>");
				    // 处理回调
				    if (funcOnSuccess) {
				    	funcOnSuccess(response);
				    }
				},
				onFailure: function(file) {
				    $("#uploadInf").append("<p>图片" + file.name + "上传失败！</p>");
				},
				onComplete: function() {
				  //提交按钮隐藏
				  $("#fileSubmit").hide();
				  //file控件value置空
				  $("#fileImage").val("");
				  showToast("图片上传完毕~");
				  $("#uploadInf").html("");
				  upload_layer_close();
				}
			};
			ZXXFILE = $.extend(ZXXFILE, params);
			ZXXFILE.init();
		}
		
	</script>