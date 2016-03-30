<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-管理区域')); ?>

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
<?php $this->load->view('admin/template/template-admin-footer'); ?>