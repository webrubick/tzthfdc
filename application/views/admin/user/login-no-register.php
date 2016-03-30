<!-- Header -->
<?php  $this->load->view('admin/template/template-admin-header'); ?>

    <title>个人信息管理-登录</title>

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
        z-index: 10;
    }
    
    html , body {
        height: 100%;
    }
    
    body {
        background: #fff;
        position: relative;
        text-align: center;
        min-width: 450px;
        min-height: 400px;
    }
    </style>
  </head>


  <body>
    <div style="width: 100%; height: 50%; position: absolute; top: 0; left: 0; background: #00bcd4; z-index: 0;">
              
    </div>
    
    <div style="z-index: 10; position: absolute; top: 0; left: 0; width: 100%; height: 100%">
        <div id="content-container" class="container" style="position: relative; top: 50%; margin-top: -70px;">
          <div class="form_wrapper" style="position: relative; padding: 10px 0px; border-radius: 2px; border: none; box-shadow: 0 1px 11px rgba(0, 0, 0, 0.27); width: 400px; ">
                <div id="formErrTip"></div>
                  
                  <form id="loginForm" class="form-sign form-signin" action="" onsubmit="return false" method="post">
                      
                      <table class="input-table" style="margin-top: 0px; ">
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
                              <input type="password" name="password" id="inputPassword" class="form-control" style="margin-bottom: 0px; " placeholder="密码">
                              </td>
                          </tr>
                          
                      </table>
                      
                      <div style="margin-top: 10px; text-align: left; ">
                          <label for="inputCode" style="display:inline; margin-top: 10px;">验证码</label>
                          <input type="text" name="code" id="inputCode" style="width: 5em; margin-bottom: 0px; ">
                      </div>
                      
                      <button style="font-size: 16px; color: #fff; background: #f46; border: none; outline: none; width: 50px; height: 50px; border-radius: 50%; position: absolute; top: 50%; margin-top: -25px; right: -25px;" type="submit" onClick="return check_input()">登录</button>
                  </form>
              </div>
            
        
          </div> <!-- /container -->
      </div>

    

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
