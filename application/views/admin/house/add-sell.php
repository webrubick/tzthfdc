<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-添加出售房源')); ?>

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