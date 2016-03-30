<!-- Header -->
<?php $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-修改密码')); ?>
 
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