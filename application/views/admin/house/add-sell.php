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

	<script type="text/javascript">
	var localHouseConfig = {
		url : '<?php echo base_url('adminhouse/add_sell/ajax'); ?>',
		successMsg : '房源添加成功'
	};
	</script>

	<div id="content">
		<div id="house-container">
			<h3>房源管理 <small>添加出售房源</small></h3>

			<?php $this->load->view('admin/house/editor-sell'); ?>

		</div>
	</div>

	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>