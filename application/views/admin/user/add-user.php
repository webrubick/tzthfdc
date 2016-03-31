<!-- Header -->
<?php $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-添加用户')); ?>
 
	<!-- content -->
	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>

	<div id="content">
		<div class="form_wrapper">
			<h2 class="form-sign-heading">添加用户</h2>

			<form id="registerForm" class="form-sign form-signup" action="" onsubmit="return false" method="post">
				<table class="table table-striped input-table">

					<tr class="danger">
						<td>
							<label for="inputUsername">账户</label>
						</td>
						<td>
							<input type="text" name="user_name" id="inputUsername" class="form-control" placeholder="账户" autofocus >
						</td>
					</tr>

					<tr class="danger">
						<td>
							<label for="inputPassword">密码</label>
						</td>
						<td>
							<input type="text" name="password" id="inputPassword" class="form-control" placeholder="密码">
						</td>
					</tr>
					
					<tr class="danger">
						<td>
							<label for="inputTrueName">姓名</label>
						</td>
						<td>
							<input type="text" name="true_name" id="inputTrueName" class="form-control" placeholder="姓名" >
						</td>
					</tr>

					<tr class="danger">
						<td>
							<label for="inputMobile">手机号</label>
						</td>
						<td>
							<input type="text" name="contact_mobile" maxlength="11" id="inputMobile" class="form-control" placeholder="手机号" >
						</td>
					</tr>
				</table>

				<button class="btn btn-lg btn-primary btn-block login-btn" type="submit" onClick="return checkInput()">添加</button>
			</form>

		</div>
	</div>

	<script type="text/javascript" src="public/scripts/md5.js"></script>
	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>
	<script type="text/javascript" src="public/scripts/admin/admin.validate.js"></script>

	<script type="text/javascript">
	function checkInput() {
		return commonSignValidate("<?php echo base_url('adminuser/add/ajax'); ?>");
	}
	
	var superDoOnUploadSuccess = function(file, responseUrl) {
		(top || window).location.reload();
	};
	
	function doOnUploadSuccess (file, responseUrl) {
	    __releaseProgress();
	    showToast('添加成功');
    	setTimeout('superDoOnUploadSuccess();', 1000);
    }
	</script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>