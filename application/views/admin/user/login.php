<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header'); ?>

    <title>后台管理系统-登录</title>

    <!-- Local global -->
    <link href="public/css/global.css" rel="stylesheet" type="text/css">
    
    <!-- Bootstrap -->
    <link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css">

    <!-- Local admin -->
    <link href="public/css/admin/admin.common.css" rel="stylesheet" type="text/css">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
      <script type="text/javascript" src="//cdn.bootcss.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script type="text/javascript" src="//cdn.bootcss.com/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

    <style type="text/css">
    #content-container {
        display: none;
    }
    </style>
  </head>


  <body>

    <h1 class="form-sign-h1">后台管理系统</h1>

    <div id="content-container" class="container">
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
                  
                  <button class="btn btn-lg btn-primary btn-block login-btn" type="submit" onClick="return check_input()">登录</button>

                  <div style="text-align: right; margin: 10px 0;">
                      <a href="admin/register">去注册></a>
                  </div>
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

<!-- Footer -->
<?php $this->load->view('admin/template/template-admin-footer'); ?>
