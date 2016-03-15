<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<title>欢迎界面</title>

	<style type="text/css">
    * {
        margin: 0;
        padding: 0;
    }

	::selection { background-color: #E13300; color: white; }
	::-moz-selection { background-color: #E13300; color: white; }

	body {
		background-color: #fff;
		color: #4F5155;
		overflow: hidden;
	}

	p.footer {
	    position: fixed;
	    top: 0;
	    left: 0;
	    right: 0;
		text-align: right;
		font-size: 11px;
		/*border-top: 1px solid #D0D0D0;*/
		line-height: 32px;
		padding: 0 10px 0 10px;
		/*margin: 20px 0 0 0;*/
	}
	
	
	div {
	    display: block;
	    width: 100%;
	    height: 100%;
	}
	
	.center-center {
	    position: fixed;
	    text-align: center;
	    top: 45%;
	    bottom: 50%;
	    color: #2826cc;
	    font-size: 20px;
	}

	</style>
</head>
<body>

<div id="container">
    <div class="center-center">
        
        <?php echo WEBSITE_REG_CODE; ?>
        
    </div>
</div>

<p class="footer">Page rendered in <strong>{elapsed_time}</strong> seconds. Memory use <strong>{memory_usage}</strong></p>
</body>
</html>