<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-注册')); ?>

	<div id="content-container" class="container register" style="display: none;">
		<div class="form_wrapper">
			<h2 class="form-sign-heading">用户注册</h2>

            <div id="formErrTip"></div>
			
			<form id="registerForm" class="form-sign form-signup" action="" onsubmit="return false" method="post">
				<table class="table table-striped input-table">
					<tr>
						<td>
							<label for="inputAvatar">头像</label>
						</td>
						<td>
							<img id="inputAvatar" class="img-thumbnail avator" alt="点击上传头像" onclick="changeAvatar()" />
							<br/>
							<small style="color:red; ">* 建议宽高比3:4的图片，比如长度为150px，宽度为200px</small>
						</td>
					</tr>

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
							<input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码">
						</td>
					</tr>
					
					<tr class="danger">
						<td>
							<label for="inputCodeWord">注册码</label>
						</td>
						<td>
							<input type="text" name="code_word" id="inputCodeWord" class="form-control" placeholder="注册码" >
						</td>
					</tr>

					<tr class="danger">
						<td>
							<label for="inputTrueName">姓名</label>
						</td>
						<td>
							<input type="text" name="true_name" id="inputTrueName" class="form-control" placeholder="姓名">
						</td>
					</tr>

					<tr>
						<td>
							<label for="inputSex">性别</label>
						</td>
						<td>
							<label class="radio-inline">
								<input type="radio" name="inputSex" value="0"  checked="checked"> 男
							</label>
							<label class="radio-inline">
								<input type="radio" name="inputSex" value="1"> 女
							</label>
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

					<tr>
						<td>
							<label for="inputQQ">QQ</label>
						</td>
						<td>
							<input type="text" name="qqchat" id="inputQQ" class="form-control" placeholder="QQ号" >
						</td>
					</tr>

					<tr>
						<td>
							<label for="inputEmail">邮箱</label>
						</td>
						<td>
							<input type="text" name="email" id="inputEmail" class="form-control" placeholder="邮箱" >
						</td>
					</tr>
				</table>

				<button class="btn btn-lg btn-primary btn-block login-btn" type="submit" onClick="return checkInput()">注册</button>
			</form>

		</div>
	</div>

	<script type="text/javascript" src="public/scripts/md5.js"></script>
	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>
	<script type="text/javascript" src="public/scripts/admin/admin.validate.js"></script>

	<?php $this->load->view('admin/user/upload-avatar2'); ?>

	<script type="text/javascript">
	$("#content-container").fadeIn(1500);

	function checkInput() {
		return commonSignValidate("<?php echo base_url('admin/register/ajax'); ?>");
	}

	prepare_upload(null);

	</script>
	
    <footer>
    	<div>
    		<span class=“copyright”>© <?php print_r(WEBSITE_C_YEAR); ?> <?php echo WEBSITE_NAME; ?></span>
    	</div>
    </footer>
<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>