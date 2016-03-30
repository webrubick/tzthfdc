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
	    
	    <title><?php echo ((isset($website_title) && !empty($website_title)) ? $website_title : WEBSITE_NAME); ?></title>

		<!-- Local global -->
		<link href="public/css/global.css" rel="stylesheet" type="text/css">
		<!-- Bootstrap -->
		<link href="public/css/bootstrap.min.css" rel="stylesheet" type="text/css">

		<!-- Local portal -->
		<link href="public/css/portal/common.css" rel="stylesheet" type="text/css">
		<link href="public/css/portal/admin.css" rel="stylesheet" type="text/css">

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
