<header id="header">
  
	<div class="user">
		<span>hi, <?php echo $true_name; ?></span>
		<a href="<?php echo base_url('adminuser/edit?uid=').$uid;?>" class="setup" title="修改个人资料"></a>
		<a href="<?php echo base_url('admin/logout');?>" class="logout" title="注销"></a>    
	</div>

</header>