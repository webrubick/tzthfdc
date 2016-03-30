<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-编辑出售房源')); ?>
 
	<!-- content -->
	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>

	<script type="text/javascript">
	var localHouseConfig = {
		url : '<?php echo base_url('adminhouse/edit_sell/ajax'); ?>',
		successMsg : '编辑房源成功',
		unrefresh : true,
		filterPostData : function(postData) {
			return postData + '&hid=<?php echo $house['hid']; ?>';
		}
	};
	</script>

	<div id="content">
		<div id="house-container">
			<h3>房源管理 <small>编辑出售房源</small></h3>

			<?php if (isset($house)) : ?>
				<?php $this->load->view('admin/house/editor-sell'); ?>
			<?php else : ?>
				<p style="font-size:24px; color: red;">
					没有找到相应的房源
				</p>
			<?php endif; ?>
		</div>
	</div>

	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>