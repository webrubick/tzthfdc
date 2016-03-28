<!DOCTYPE html>
<html lang="zh-CN">
	<head>
		<base href="<?php echo base_url(); ?>" />
	    <meta charset="utf-8">
	    <meta http-equiv="content-type" content="text/html; charset=utf-8" />
	    <meta http-equiv="X-UA-Compatible" content="IE=edge">
	    <!-- 上述3个meta标签*必须*放在最前面，任何其他内容都*必须*跟随其后！ -->
	    <meta name="Author" content="YY" />
	    <meta name="Copyright" content="YY" />
	    <?php echo meta('keywords', WEBSITE_KEYWORD); ?>
	    <?php echo meta('description', WEBSITE_KEYWORD); ?>
	    <link rel="shortcut icon" href="public/favicon.ico">
	    <title><?php echo WEBSITE_NAME; ?></title>

		<!-- Local global -->
		<link href="public/css/global.css" rel="stylesheet" type="text/css">

		<!-- Bootstrap -->
		<link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!-- Local portal -->
		<link href="public/css/portal/common.css" rel="stylesheet" type="text/css">

		<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
		<script type="text/javascript" src="public/scripts/jquery.min.js"></script>
		<!-- Include all compiled plugins (below), or include individual files as needed -->
		<script type="text/javascript" src="public/scripts/bootstrap.min.js"></script>
		<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
		<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->

		<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>
		
		<script>
        var _hmt = _hmt || [];
        (function() {
          var hm = document.createElement("script");
          hm.src = "//hm.baidu.com/hm.js?464dce96a743a4307ffef3c5302acf6c";
          var s = document.getElementsByTagName("script")[0]; 
          s.parentNode.insertBefore(hm, s);
        })();
        </script>
	</head>
	<body>
		<header class="welcome">
			<div class="fixed-sub-container">
        		您好！欢迎访问&nbsp;<a href="/" target="_self"><?php echo WEBSITE_NAME; ?></a>&nbsp;。
        		&nbsp;&nbsp;&nbsp;&nbsp;
        		<img src="public/img/portal/ic_call.png" style="width: 25px; height: 25px; margin-top: -5px;" />
        		<span class="highlight call"><?php print_r(WEBSITE_CONTACT); ?></span>
			</div>
		</header>
		
<?php $this->load->view('portal/template/template-session'); ?>

		<header id="logo-header" class="sub-container">
			<div id="top-nav" class="fixed-sub-container">
				<span class="city-logo"></span>
				<img class="logo-img" src="public/img/portal/thfdc-ico.png" />
				<img class="primary-logo-img" src="public/img/portal/logo-2.png" />
			</div>
		</header>

		<div class="section-sep"></div>
    