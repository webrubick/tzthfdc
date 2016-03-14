<!-- Header -->
<?php $this->load->view('template/template-admin-header'); ?>
 
		<title>后台管理系统-管理区域</title>

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

			<h3>公共信息 <small>管理区域</small></h3>
			
			<hr/>

			<button type="button" class="btn btn-primary" onclick="addArea()">&nbsp;&nbsp;&nbsp;添&nbsp;&nbsp;&nbsp;&nbsp;加&nbsp;&nbsp;&nbsp;</button>

			<div id="house-list-container">
				<table class="table table-bordered table-hover table-striped">
					<tbody>
						<?php if (isset($areas)) : ?>
							<?php foreach ($areas as $area) : ?>
								<tr>
									<td class="house-col-1"><?php echo $area['area_name']; ?></td>
									<td>
										<a class="btn btn-warning house-op house-op-edit" data-aid="<?php echo $area['aid']; ?>" data-aname="<?php echo $area['area_name']; ?>" href="javascript:void(0);" onclick="editArea(this);">编辑</a>
										<a class="btn btn-danger house-op house-op-delete" href="admincommon/area/del?aid=<?php echo $area['aid']; ?>" onclick="return confirm('确认要删除吗？');">删除</a>
									</td>
								</tr>
							<?php endforeach;?>
						<?php endif; ?>
					</tbody>
				</table>
			</div>

		</div>

		<?php $this->load->view('admin/common/edit'); ?>
	</div>



	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

	<script type="text/javascript">
	function addArea() {
		add_layer_show("<?php echo base_url('admincommon/area/add/ajax'); ?>");
	}

	function editArea(self) {
		var selfAjax = $(self);
		edit_layer_show({
			id: selfAjax.data('aid'),
			name: selfAjax.data('aname'),
			url: "<?php echo base_url('admincommon/area/edit/ajax'); ?>"
		});
	}
	</script>

<!-- Footer -->
<?php $this->load->view('template/template-admin-footer'); ?>