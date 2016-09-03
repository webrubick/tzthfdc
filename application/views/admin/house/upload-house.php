<style>
.house-img-container { position: relative; max-width: 400px; }
.house-img-container, .house-img-container ul, .house-img-container ul > li { display: inline-block; }
.house-img-container ul > li { vertical-align: top; margin-right: 10px; position: relative; }

.house-img-container img, .house-img-container .add-more { width: 120px; }
.house-img-container .add-more { position: relative;
            height: 120px; line-height: 115px; text-align: center; 
            border: 1px solid #ccc; box-shadow: 0 1px 11px rgba(0, 0, 0, 0.27); border-radius: 5px; }
.house-img-container .add-more img { width: 50px; }
.house-img-container .del { width: 20px; height: 20px; background: #fff; position: absolute; top: 0; right: 0; z-index: 1; cursor: pointer; }
.house-img-container .add-more a, .house-img-container .del a, .house-img-container .del img { width: 100%; height: 100%; }

.house-img-container input[type="file"] {
	display: inline-block; position: absolute; top: 0; left: 0;
	width: 100%; height: 100%; overflow: hidden; font-size: 300px;
	opacity: 0; filter:alpha(opacity=0);
	cursor: pointer;
}   
</style>

<?php $editMode = isset($house); ?>
<?php 
	$images = NULL;
	if ($editMode) {
		$this->load->helper('house');
		$images = to_preview_and_images($house)['images'];
	}
?>
<tr>
	<th>房型图片</th>
	<td>
		<div class="house-edit-input-container">
<?php if ($editMode && isset($images) && !empty($images)) : ?>
			<div class="house-img-container">
				<ul>
	<?php foreach ($images as $image) : ?>
					<li class="house-subs-li">
						<div>
						<img src="<?php print_r($image); ?>"/>
						<div class="del" onclick="checkDelHouseSubsImage(this)"><img src="public/img/admin/house-img-del.png" /></div>
						</div>
					</li>
	<?php endforeach;?>
				</ul>
			</div>
			<br/><br/>
<?php endif; ?>
			<div id="house-img-container" class="house-img-container">
				<ul>
					<li>
                        <div class="add-more">
                        <img src="public/img/admin/house-img-add.png" />
                        <input type="file" name="case_subs" multiple>
                        </div>
                    </li>
                </ul>
            </div>
		</div>
		<span><small>* 第一张图将作为封面图</small></span>
	</td>
</tr>

<script type="text/javascript" src="public/scripts/admin/zxxFile-multi.js"></script>

<script type="text/javascript">
var inputHouseSubsList = $('#house-img-container ul');
var inputHouseInputLi = inputHouseSubsList.find('li');
var inputHouseSubs = inputHouseInputLi.find('input[type="file"]');
function prepare_upload(uploadUrl) {
	var _myUrl = uploadUrl || $("#uploadForm").attr("action");
	localHouseConfig.uploadUrl = _myUrl;
	var params = {
		fileInput: inputHouseSubs.get(0),
	    url: _myUrl,
	    filter: function(files) {
	        var arrFiles = [];
	        for (var i = 0, file; file = files[i]; i++) {
	            if ((!file.type || file.type.indexOf("image") == 0) && /\.(?:jpg|png|gif|jpeg)$/i.test(file.name) /* for IE10 */) {
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
		onAppendSelect: function(filteredFiles) {
	        var i = 0;
	        var funAppendImage = function() {
	            var file = filteredFiles[i];
	            if (!file) { return ; } // end
	            var reader = new FileReader();
				reader.onload = function(e) {
				    var li = $('<li class="house-subs-li"></li>')
				                .html('<div><img src="' + e.target.result + '"/>\n'
			                        + '<div class="del" onclick="delHouseSubsImage(this)"><img src="public/img/admin/house-img-del.png" /></div>\n'
			                        + '</div>');
				    inputHouseInputLi.before(li);
				    i++;
	                funAppendImage();
				};
				reader.readAsDataURL(file);
	        };
	        funAppendImage();
	    },
	    onDelete: function(deletedFile) {
	        var target = inputHouseSubsList.find('li').eq(deletedFile.index);
	        target.remove();
	    },
	    onComplete: function() {
	    	doOnUploadSuccess();
	    },
	    dealResponse: function(xhr) {
	        return false; 
	    }
	};
	ZXXFILE = $.extend(ZXXFILE, params);
	ZXXFILE.init();
}

function delHouseSubsImage(obj) {
    var target = $(obj);
    var li = target;
    while(1) {
        li = li.parent();
        if (li.is('li')) {
            break;
        }
    }
    ZXXFILE.deleteFile(li.index());
}

function checkDelHouseSubsImage(obj) {
    var target = $(obj).parent().children('img');
    if (target.length > 0) {
    	var r = confirm('确认删除这张图片吗？');
    	if (r) {
    		// delete
    		var postData = 'image=' + $.urlencode(target.attr('src'))
    		if (localHouseConfig.filterPostData) {
				postData = localHouseConfig.filterPostData(postData);
			}
    		var progress = showProgress();
    		simplePost(localHouseConfig.delImageUrl, postData, {
				ok : function(data) {
					var li = target;
				    while(1) {
				        li = li.parent();
				        if (li.is('li')) {
				            break;
				        }
				    }
				    li.remove();
				},

				success : function() {
					hideProgress(progress);
					delete progress;
				},

				error : function() {
					hideProgress(progress);
					delete progress;
				}
			});
    	}
    }
}
</script>


