<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header', array('website_title' => WEBSITE_NAME . '-登录')); ?>

    <div id="content-container" class="container" style="display: none;">
      <div class="form_wrapper">
            <h2 class="form-sign-heading">用户登录</h2>

            <div id="formErrTip"></div>
              
              <form id="loginForm" class="form-sign form-signin" action="" onsubmit="return false" method="post">
                  
                  <table class="input-table">
                      <tr>
                          <td>
                          <label for="inputUsername">账户</label>
                          </td>
                          <td>
                          <input type="text" name="user_name" id="inputUsername" class="form-control" placeholder="账户" autofocus <?php if (isset($user_name)) { echo ' value="'.$user_name.'" ';} ?>>
                          </td>
                      </tr>
                      <tr>
                          <td>
                          <label for="inputPassword">密码</label>
                          </td>
                          <td>
                          <input type="password" name="password" id="inputPassword" class="form-control" placeholder="密码">
                          </td>
                      </tr>
                  </table>
                  
                  <div id="content-login">
                        <label for="inputCode">验证码</label>
                        <input type="text" name="code" id="inputCode" >
                        <img data-src="admin/login_vercode" src="admin/login_vercode" id="inputCodeImg" align="absmiddle" style="height:22px">
                        <span class="kbq"><small><a href="javascript:;" id="change-inputcode">看不清楚？换一张</a></small></span>&nbsp;&nbsp;
                  </div>
                  
                  <button class="btn btn-lg btn-primary btn-block login-btn" type="submit" onClick="return check_input()">登录</button>

                  <!--<div style="text-align: right; margin: 10px 0;">-->
                  <!--    <a href="admin/register">去注册></a>-->
                  <!--</div>-->
              </form>
          </div>
        

      </div> <!-- /container -->
      
      <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
      <script type="text/javascript" src="public/scripts/jquery.min.js"></script>
      <!-- Include all compiled plugins (below), or include individual files as needed -->
      <script type="text/javascript" src="public/scripts/bootstrap.min.js"></script>
      <script type="text/javascript" src="public/scripts/md5.js"></script>
      <script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>
      <script type="text/javascript" src="public/scripts/admin/admin.validate.js"></script>
      
      <script type="text/javascript">
      $("#content-container").fadeIn(1500);

      function check_input() {
        return commonSignValidate("<?php echo base_url('admin/login/ajax'); ?>");
      }
      </script>
    
    <footer>
    	<div>
    		<span class=“copyright”>© <?php print_r(WEBSITE_C_YEAR); ?> <?php echo WEBSITE_NAME; ?></span>
    	</div>
    </footer>
<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>
