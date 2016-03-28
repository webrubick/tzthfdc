<!-- Header -->
<?php $this->load->view('portal/template/template-portal-header'); ?>

    <script type="text/javascript">
	var localHouseConfig = {
		url : '<?php echo base_url('other/addrent/ajax'); ?>',
		successMsg : '房源添加成功'
	};
	</script>

    <link href="public/css/admin/admin.common.css" rel="stylesheet" type="text/css">
    
    <style>
    body {
        font-family: 'Hiragino Sans GB','Microsoft YaHei','黑体',sans-serif;
        font-size: 14px;
        line-height: 1.428571429;
        color: #333;
        min-width: 980px;
        background: #eeeff1;
    }
    .admin-ui-dialog {
        position: fixed;
    }
    </style>

    <section>
		<div class="sub-container fixed-sub-container">
    		<div id="house-container">
    		    <a href="/" style="text-decoration: underline;">&lt;&lt; 返回首页</a>
    		    
    		    <h3>房源管理 <small>房源列表</small></h3>
			
    			<hr/>
    
    			<form id="searchForm" action="<?php echo base_url('other/adminhouse');?>" method="get">
    			<div id="house-cat-container">
    				<label class="radio-inline">
    					<input type="radio" name="cat" value="0"> 出售房源
    				</label>
    				<label class="radio-inline">
    					<input type="radio" name="cat" value="1"> 出租房源
    				</label>
    			</div>
    
    			<div id="house-keyword-container" class="form-inline">
    				<input id="house-keyword-input" name="kw" type="text" class="form-control" placeholder="输入关键字" <?php echo isset($kw) ? "value=\"$kw\"" : ''; ?>>
    				<a class="btn btn-default" href="javascript:void(0);" onclick="return searchHouse(this);" target="_self">搜索</a>
    			</div>
    			</form>
    
    			<div id="house-result-lable"><strong>搜索结果：</strong></div>
    
    			<div id="house-list-container">
    				<?php if (isset($houses) && !empty($houses)) : ?>
    				<table class="table table-bordered table-hover table-striped">
    					<thead>
    						<tr>
    							<th class="check"><input type="checkbox" onclick="checkAll(this,'hid[]')" /></th>
    							<th>标题</th>
    							<th>户型</th>
    							<th>更新时间</th>
    							<th>操作</th>
    						</tr>
    					</thead>
    					<tbody> <form id="delForm" action="<?php echo ($cat == 0 ? base_url('other/adminhouse/del_sell/ajax') : base_url('other/adminhouse/del_rent/ajax')); ?>" method="post">
    						<input type="hidden" name="cat" value="<?php echo $cat; ?>" />
    						<input type="hidden" name="kw" value="<?php echo $kw; ?>" />
    						<?php 
    							$myIndex = 0;
    							foreach ($houses as $house) : ?>
    							<?php $house_title = to_room_title($house); ?>
    							<tr>
    								<td class="check">
    									<input type="checkbox" id="<?php echo "hid$myIndex";?>" name="hid[]" value="<?php echo $house['hid'];?>" />
    								</td>
    								<td class="house-col-1" title="<?php echo $house_title; ?>"><?php echo $house_title; ?></td>
    								<td>
    									<?php 
    										echo to_room_type($house); 
    									?>
    								</td>
    								<td><?php echo $house['update_time']; ?></td>
    								<td>
    									<a class="btn btn-warning house-op house-op-edit" href="<?php echo ($cat == 0 ? base_url('other/adminhouse/edit_sell') : base_url('other/adminhouse/edit_rent')).'?hid='.$house['hid']; ?>" onclick="return true;">编辑</a>
    									<a class="btn btn-danger house-op house-op-delete" data-inputid="<?php echo "hid$myIndex";?>" onclick="return delBatch(this);">删除</a>
    								</td>
    							</tr>
    							<?php $myIndex++; ?>
    						<?php endforeach;?>
    					</form>
    					</tbody>
    				</table>
    				<?php endif; ?>
    			</div>
    			
    		</div>
        </div>
    </section>

	<div class="section-sep"></div>

	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

	<script type="text/javascript">
	var searchForm = $('#searchForm');
	searchForm.find('input[name="cat"][value="<?php echo $cat; ?>"]').prop('checked', true);
	$('input[type="checkbox"]').prop('checked', false);

	function searchHouse (self) {
		console.log(searchForm.serialize());
		searchForm.submit();
		return true;
	}

	var delForm = $('#delForm');
	var __delSellResultData;
	function delBatch(o) {
		var inputCheckbox = $('#' + $(o).data('inputid'));
		var tcheck = inputCheckbox.is(':checked');
		if (!tcheck) {
			inputCheckbox.prop('checked', true);
		}
		var r = confirm('确认要删除吗？');
		if (!r) {
			if (!tcheck) {
				inputCheckbox.prop('checked', false);
			}
		} else {
			var postData = delForm.serialize();
			console.log(postData);
			// delForm.submit();
			simplePost(delForm.attr('action'), postData, {
				ok : function(data) {
					__delSellResultData = data;
					showToast('房源删除成功');
					setTimeout('(top || window).location.href = __delSellResultData.data', 1000);
				},
				success : function() {

				}
			});
		}
		
		return r;
	}
	</script>


<!-- Footer -->
<?php $this->load->view('portal/template/template-portal-footer'); ?>