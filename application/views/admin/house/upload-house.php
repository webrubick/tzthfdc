<style type="text/css">
/* style 专门就写在这边 */
.fileInputContainer {
	display: block;
	width: 150px;
	height: 100px;
	line-height: 100px;
	overflow: hidden;
	float: left;
	position: relative;
}

.fileInput {
	height: 100%;
	overflow: hidden;
	position: absolute;
	font-size: 100px;
	right:0;
	top:0;
	opacity: 0;
	filter:alpha(opacity=0);
	cursor:pointer;
}
</style>

			<?php $editMode = isset($house); ?>
<tr>
	<th>房型图片</th>
	<td>
		<div class="house-edit-input-container">
			<div class="fileInputContainer">
				<?php if ($editMode && isset($house['images']) && !empty($house['images'])) : ?>
					<img id="inputImage" class="img-thumbnail" style="width: 120px; height: 90px; " alt="点击上传图片" data-src="<?php print_r($house['images']); ?>" data-rawsrc="<?php print_r($house['images']); ?>" src="<?php print_r($house['images']); ?>"/>
				<?php else : ?>
				<img id="inputImage" class="img-thumbnail" style="width: 120px; height: 90px; " alt="点击上传图片" />
				<?php endif; ?>
				<form id="uploadForm" action="adminhouse/avatar" method="post" enctype="multipart/form-data">
				<input id="fileImage" size="10" class="fileInput" type="file" name="fileselect[]" />
				</form>
			</div>
			<button id="cancelUseImage" class="btn btn-default">取消</button>
			<div class="fl-clear"></div>
			<span><small>* 尽量上传宽高比例为4:3的图片</small></span>
		</div>
	</td>
</tr>


<script type="text/javascript" src="public/scripts/admin/zxxFile-delay-upload.js"></script>

<script type="text/javascript">
var inputImage = $('#inputImage');
var cancelUseImage = $('#cancelUseImage');
cancelUseImage.hide();
cancelUseImage.click(function() {
	removeSelectedImage();
});

function prepare_upload(uploadUrl) {
	var _myUrl = uploadUrl || $("#uploadForm").attr("action");
	localHouseConfig.uploadUrl = _myUrl;
	var params = {
		fileInput: $('#fileImage').get(0),
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
				removeSelectedImage();
				return ;
			}

			if (files.length > 1) {
				ZXXFILE.funDeleteFile(files[0]);
				ZXXFILE.funDealFiles();
				return ;
			}
		  	var file = files[0];
		  	var reader = new FileReader();
			reader.onload = function(e) {
				inputImage.attr('src', e.target.result);
				inputImage.attr('title', file.name);
				inputImage.removeData('src');
				inputImage.removeAttr('data-src');
				localHouseConfig.selectedFile = file;
				cancelUseImage.show();
			};
			reader.readAsDataURL(file);	
		},
		onDelete: function(file) {
			
		},
		onProgress: function(file, loaded, total) {
			
		},
		onSuccess: function(file, response) {
		    // 处理回调
		    doOnUploadSuccess(file, response);
		},
		onFailure: function(file, msg) {
			doOnUploadFailure(file, msg);
		},
		onComplete: function() {

		}
	};
	ZXXFILE = $.extend(ZXXFILE, params);
	ZXXFILE.init();
}

function removeSelectedImage() {
	if (inputImage.data('rawsrc')) { // 如果有原始数据，则回复原始数据
		inputImage.attr('src', inputImage.data('rawsrc'));
		inputImage.data('src', inputImage.data('rawsrc'));
	} else {
		inputImage.removeAttr('src');
	}
	inputImage.removeAttr('title');
	if (localHouseConfig.selectedFile) {
		ZXXFILE.funDeleteFile(localHouseConfig.selectedFile);
	}
	$('#fileImage').val(''); // clear value
	cancelUseImage.hide();
}
</script>


