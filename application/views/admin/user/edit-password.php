<!-- Header -->
<?php $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-修改密码')); ?>
 
	<!-- content -->
	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>

    <div id="content">
		<div id="house-container">

            <h3>用户信息管理 <small>修改密码</small></h3>
			
			<hr/>

            <div id="house-list-container">
                <form id="registerForm" class="narrow-form" action="" onsubmit="return false" method="post">
    				<table class="table table-hover input-table">
    					<tr>
    						<td class="label-col">
    							<label for="inputPassword">新密码</label>
    						</td>
    						<td class="input-col">
    							<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码">
    						</td>
    					</tr>
    
    					<tr>
    						<td class="label-col">
    							<label for="inputPassword2">再输一次</label>
    						</td>
    						<td class="input-col">
    							<input type="password" name="password2" id="inputPassword2" class="form-control" placeholder="重新输入一次密码">
    						</td>
    					</tr>
    				</table>
    
    				<button class="btn btn-lg btn-primary login-btn" type="submit" onClick="return checkInput()">提交修改</button>
    			</form>
            </div>
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