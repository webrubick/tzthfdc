<!-- Header -->
<?php $this->load->view('portal/template-portal-header'); ?>

	<link href="public/css/portal/index-listing-filter.css" rel="stylesheet" type="text/css">
	<!-- content -->

	<section>
		<div class="top-tab">
			<ul>
				<li>
					<a class="active" href="">出售房源</a>
				</li>
				<li>
					<a href="">出租房源</a>
				</li>
			</ul>
		</div>
		<form id="listing-filters" class="sub-container fixed-sub-container">
			<fieldset>
				<span class="legend">区域</span>
				<div class="links">
					<a class="checked" href="">1</a>
					<a href="">2</a>
					<a href="">3</a>
					<a href="">4</a>
					<span class="range">
						<label>自定义：</label>
						<input type="text" class="number" />
						<label>~</label>
						<input type="text" class="number" />
						<label class="unit">平方米</label>
						<input type="submit" value="筛选" class="filter-button" />
					</span>
				</div>
			</fieldset>
			<fieldset>
				<span class="legend">面积</span>
				<div></div>
			</fieldset>
			<fieldset>
				<span class="legend">户型</span>
				<div></div>
			</fieldset>
			<fieldset>
				<span class="legend">售价</span>
				<div></div>
			</fieldset>
			<fieldset>
				<span class="legend">装修</span>
				<div></div>
			</fieldset>
			<fieldset>
				<span class="legend">楼层</span>
				<div></div>
			</fieldset>
			<div style="border-top: 1px solid #ddd; "></div>
			<fieldset>
				<span class="legend">热门小区</span>
				<div ></div>
			</fieldset>
			<fieldset class="search-fieldset">
				<input type="text" placeholder="搜索关键词"/>
				<button type="submit">
					<i class="glyphicon-search"></i>
				</button>
			</fieldset>
		</form>
	</section>

	<div class="section-sep"></div>

	<link href="public/css/portal/index-list.css" rel="stylesheet" type="text/css">

	<?php $this->load->view('portal/house-list-result', array('item_url' => 'sellhouse')); ?>

	<section id="listing-pager" class="fixed-sub-container">
		<ul>
			<li class="checked"><span>1</span></li>
			<li><span>2</span></li>
			<li><span>3</span></li>
			<li><span>4</span></li>
			<li><span>5</span></li>
			<li><span>6</span></li>
			<li><span>7</span></li>
			<li><span>8</span></li>
			<li><span>9</span></li>
			<li><span>...</span></li>
			<li><span>99</span></li>
			<li><span>100</span></li>
			<li><span>下一页</span></li>
		</ul>
	</section>

	<script type="text/javascript">

	</script>


<!-- Footer -->
<?php $this->load->view('portal/template-portal-footer'); ?>