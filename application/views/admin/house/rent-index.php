<!-- Header -->
<?php $this->load->view('template/template-admin-header'); ?>
 
		<title>后台管理系统-我的房源</title>

		<!-- Local global -->
		<link href="public/css/global.css" rel="stylesheet" type="text/css">

		<!-- Bootstrap -->
		<link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!-- Local admin -->
		<link href="public/css/admin/admin.common.css" rel="stylesheet" type="text/css">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script type="text/javascript" src="public/scripts/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script type="text/javascript" src="public/scripts/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
		  <script type="text/javascript" src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		  <script type="text/javascript" src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->
	</head>
	<body>

	<!-- content -->

	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>

	<div id="content">
		<div id="house-container">

			<h3>房源管理 <small>出租房源列表</small></h3>
			
			<hr/>

			<form id="searchForm" action="adminhouse/rent_index" method="get">
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
					<tbody> <form id="delForm" action="<?php echo base_url('adminhouse/del_rent/ajax'); ?>" method="post">
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
									<a class="btn btn-warning house-op house-op-edit" href="adminhouse/edit_rent?hid=<?php print_r($house['hid']); ?>" onclick="return true;">编辑</a>
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



	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

	<script type="text/javascript">
	var searchForm = $('#searchForm');
	$('input[type="checkbox"]').prop('checked', false);

	function searchHouse (self) {
		console.log(searchForm.serialize());
		searchForm.submit();
		return true;
	}

	var delForm = $('#delForm');
	var __delRentResultData;
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
					__delRentResultData = data;
					showToast('房源删除成功');
					setTimeout('(top || window).location.href = __delRentResultData.data', 1000);
				},
				success : function() {

				}
			});
		}
		
		return r;
	}
	</script>

<!-- Footer -->
<?php $this->load->view('template/template-admin-footer'); ?>