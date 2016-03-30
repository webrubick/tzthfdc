<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-管理小区')); ?>
 
	<!-- content -->
	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>

	<div id="content">
		<div id="house-container">

			<h3>公共信息 <small>管理小区</small></h3>
			
			<hr/>

			<button type="button" class="btn btn-primary" onclick="addCommunity()">&nbsp;&nbsp;&nbsp;添&nbsp;&nbsp;&nbsp;&nbsp;加&nbsp;&nbsp;&nbsp;</button>

			<div id="house-list-container">
				<table class="table table-bordered table-hover table-striped">
					<tbody>
						<?php if (isset($communitys)) : ?>
							<?php $myIndex = 0; ?>
							<?php foreach ($communitys as $community) : ?>
								<?php if ($myIndex % 2 == 0) : ?>
								<tr>
								<?php endif; ?>
									<td class="house-col-1" <?php echo ($myIndex % 2 == 0) ? '' : 'style="border-left:5px solid #ddd"' ;?>><?php echo $community['cname']; ?></td>
									<td>
										<a class="btn btn-warning house-op house-op-edit" data-cid="<?php echo $community['cid']; ?>" data-cname="<?php echo $community['cname']; ?>" href="javascript:void(0);" onclick="editCommunity(this);">编辑</a>
										<a class="btn btn-danger house-op house-op-delete" data-cid="<?php echo $community['cid']; ?>" href="admincommon/community/del?cid=<?php echo $community['cid']; ?>" onclick="return confirm('确认要删除吗？');">删除</a>
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

		<?php $this->load->view('admin/common/edit'); ?>
	</div>



	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

	<script type="text/javascript">
	function addCommunity () {
		add_layer_show("<?php echo base_url('admincommon/community/add/ajax'); ?>");
	}

	function editCommunity(self) {
		var selfAjax = $(self);
		edit_layer_show({
			id: selfAjax.data('cid'),
			name: selfAjax.data('cname'),
			url: "<?php echo base_url('admincommon/community/edit/ajax'); ?>"
		});
	}
	</script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>