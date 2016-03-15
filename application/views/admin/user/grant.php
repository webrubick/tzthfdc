<!-- Header -->
<?php $this->load->view('admin/template/template-admin-header'); ?>
 
		<title>后台管理系统</title>

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

			<h3>授权管理</h3>
			
			<hr/>

			<div id="house-list-container">
				<table class="table table-bordered table-hover table-striped">
					<tbody>
						<?php if (isset($grant_users)) : ?>
						<?php //print_r($grant_users) ; ?>
							<?php $myIndex = 0; ?>
							<?php foreach ($grant_users as $user) : ?>
								<?php if ($myIndex % 2 == 0) : ?>
								<tr>
								<?php endif; ?>
									<td class="house-col-1" <?php echo ($myIndex % 2 == 0) ? '' : 'style="border-left:5px solid #ddd"' ;?>><?php echo $user['true_name']; ?></td>
									<td>
										<a class="btn house-op house-op-edit" data-uid="<?php echo $user['uid']; ?>" data-permission="<?php echo $user['permission']; ?>" href="javascript:void(0);" onclick="changePermission(this);"></a>
									</td>
								<?php if ($myIndex % 2 == 1) : ?>
								</tr>
								<?php endif; ?>
								<?php $myIndex++; ?>
							<?php endforeach; ?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

		</div>

	</div>



	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

	<script type="text/javascript">
	$('a[data-permission="0"]').text('授权').removeClass('btn-warning').addClass('btn-primary');
	$('a[data-permission="1"]').text('取消授权').removeClass('btn-primary').addClass('btn-warning');
	function changePermission (self) {
		// body...
		var ele = $(self);
		var uid = ele.data('uid');
		var permission = parseInt(ele.data('permission') || 0);
		var targetPermission = (permission + 1) % 2;
		console.log('uid = ' + uid);
		console.log('permission = ' + permission);
		console.log('target permission = ' + targetPermission);
		var progress = showProgress();
		simplePost('<?php echo base_url('adminuser/grant/ajax'); ?>', 'uid=' + uid + '&permission=' + targetPermission, {
			success : function() {
				hideProgress(progress);
				delete progress;
			},

			ok : function() {
				hideProgress();
				ele.data('permission', targetPermission);
				changeClass(ele);
			},

			error: function() {
				hideProgress(progress);
				delete progress;
			}
		});
	}

	function changeClass(ele) {
		if (ele.data('permission') == 1) {
			ele.text('取消授权').removeClass('btn-primary').addClass('btn-warning');
		} else {
			ele.text('授权').removeClass('btn-warning').addClass('btn-primary');
		}
	}
	</script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>