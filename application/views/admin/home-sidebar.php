<aside id="sidebar">
	<nav id="main-nav">
		<a href="<?php echo 'admin'; ?>" class="ico-home"></a>
		<?php $superUser = (isset($uid) && $uid == 1);?>
		<?php $allowed = (isset($permission) && !empty($permission));?>
		<?php if ($allowed) : ?>
		<a href="javascript:void(0)" class="ico-nav" data-id="sn-house">管理房源</a>
		<?php endif; ?>
		<a href="<?php echo 'adminuser/edit_password'; ?>" class="ico-nav" >修改密码</a>
		<a href="<?php echo 'adminuser/edit'; ?>" class="ico-nav" >修改资料</a>
		<?php if ($superUser) : ?>
		<a href="javascript:void(0)" class="ico-nav" data-id="sn-common">公共信息</a>
		<a href="<?php echo 'adminuser/grant'; ?>" class="ico-nav">授权管理</a>
		<?php endif; ?>
	</nav>
	<?php if ($allowed) : ?>
	<nav class="sub-nav" id="sn-house">
		<dd><a href="<?php echo 'adminhouse/sell_index'; ?>">出售房源列表</a></dd>
		<dd><a href="<?php echo 'adminhouse/add_sell'; ?>">添加出售房源</a></dd>
		<div style="width: 100%; height: 2px; background: #fff"></div>
		<dd><a href="<?php echo 'adminhouse/rent_index'; ?>">出租房源列表</a></dd>
		<dd><a href="<?php echo 'adminhouse/add_rent'; ?>">添加出租房源</a></dd>
	</nav>
	<?php endif; ?>
	<?php if ($superUser) : ?>
	<nav class="sub-nav" id="sn-common">
		<dd><a href="<?php echo 'admincommon/area'; ?>">管理区域</a></dd>
		<dd><a href="<?php echo 'admincommon/community'; ?>">管理小区</a></dd>
	</nav>
	<?php endif; ?>
</aside>
<script>
(function() {
	
	var mainNav = $("#main-nav"),
	    subNav = $(".sub-nav");
	
	mainNav.on("mouseover", "a", function() {
		
		var ts = $(this);
		
		subNav.hide();
		$("#" + ts.data("id")).css("top", ts.position().top).fadeIn(300);
	});
		
	subNav.on("mouseleave", function() {
		
		mainNav.find("a").removeClass("curr");
		subNav.hide();
	});

})();
</script>