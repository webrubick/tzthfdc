<!-- Header -->
<?php $this->load->view('admin/template/template-admin-header'); ?>
 


	<title>后台管理系统-修改密码</title>

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
	  <script src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
	  <script src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>

	<!-- content -->

	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>

	<div id="content">

		<div class="form_wrapper">
			<h2 class="form-sign-heading">修改密码</h2>

			<form id="registerForm" class="form-sign form-signup" action="" onsubmit="return false" method="post">
				<table class="table table-striped input-table">
					<tr class="danger">
						<td>
							<label for="inputPassword">新密码</label>
						</td>
						<td>
							<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码">
						</td>
					</tr>

					<tr class="danger">
						<td>
							<label for="inputPassword2">再输一次</label>
						</td>
						<td>
							<input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="重新输入一次密码">
						</td>
					</tr>
				</table>

				<button class="btn btn-lg btn-primary btn-block login-btn" type="submit" onClick="return checkInput()">提交修改</button>
			</form>
		</div>
	</div>



	<script type="text/javascript" src="public/scripts/md5.js"></script>
	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>
	<script type="text/javascript" src="public/scripts/admin/admin.validate.js"></script>

	<script type="text/javascript">
	function checkInput() {
		return commonSignValidate("<?php echo base_url('adminuser/edit_password/ajax'); ?>");
	}
	</script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>