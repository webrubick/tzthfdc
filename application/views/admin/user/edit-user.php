<!-- Header -->
<?php $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-修改基本信息')); ?>
 
	<!-- content -->
	<?php $this->load->view('admin/home-header'); ?>
	<?php $this->load->view('admin/home-sidebar'); ?>
    
    <div id="content">
		<div id="house-container">

            <h3>用户信息管理 <small>修改基本信息</small></h3>
			
			<hr/>

            <div id="house-list-container">
                <form id="registerForm" class="narrow-form" action="" onsubmit="return false" method="post">
    				<table class="table table-striped input-table">
    					<tr>
    						<td class="label-col">
    							<label for="inputAvatar">头像</label>
    						</td>
    						<td>
    							<img id="inputAvatar" class="img-thumbnail avator" alt="点击上传头像" onclick="changeAvatar()" />
    						</td>
    					</tr>
    
    					<tr class="danger">
    						<td>
    							<label for="inputTrueName">姓名</label>
    						</td>
    						<td>
    							<input type="text" name="true_name" id="inputTrueName" class="form-control" placeholder="姓名" <?php if(isset($true_name)) echo 'value="'.$true_name.'"'; ?> >
    						</td>
    					</tr>
    
    					<tr>
    						<td>
    							<label for="inputSex">性别</label>
    						</td>
    						<td>
    							<label class="radio-inline">
    								<input type="radio" name="inputSex" value="0" <?php if(isset($sex) && $sex == 0) echo 'checked="checked"'; ?> > 男
    							</label>
    							<label class="radio-inline">
    								<input type="radio" name="inputSex" value="1" <?php if(isset($sex) && $sex == 1) echo 'checked="checked"'; ?> > 女
    							</label>
    						</td>
    					</tr>
    
    					<tr class="danger">
    						<td>
    							<label for="inputMobile">手机号</label>
    						</td>
    						<td>
    							<input type="text" name="contact_mobile" maxlength="11" id="inputMobile" class="form-control" placeholder="手机号"  <?php if(isset($contact_mobile)) echo 'value="'.$contact_mobile.'"'; ?> >
    						</td>
    					</tr>
    
    					<tr>
    						<td>
    							<label for="inputQQ">QQ</label>
    						</td>
    						<td>
    							<input type="text" name="qqchat" id="inputQQ" class="form-control" placeholder="QQ号" <?php if(isset($qqchat)) echo 'value="'.$qqchat.'"'; ?>  >
    						</td>
    					</tr>
    
    					<tr>
    						<td>
    							<label for="inputEmail">邮箱</label>
    						</td>
    						<td>
    							<input type="text" name="email" id="inputEmail" class="form-control" placeholder="邮箱" <?php if(isset($email)) echo 'value="'.$email.'"'; ?>  >
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

	<?php $this->load->view('admin/user/upload-avatar2'); ?>

	<script type="text/javascript">
	<?php if (isset($avatar) && !empty($avatar)) : ?>
	$('#inputAvatar').data('src', '<?php print_r($avatar); ?>');
	$('#inputAvatar').attr('src', '<?php print_r($avatar); ?>');
	<?php endif ; ?>

	function checkInput() {
		return commonSignValidate("<?php echo base_url('adminuser/edit/ajax'); ?>");
	}

	prepare_upload(null);

	</script>

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>