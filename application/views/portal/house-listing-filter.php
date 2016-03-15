	<!-- content -->
	<link href="public/css/portal/index-listing-filter.css" rel="stylesheet" type="text/css">

	<section>
		<div class="top-tab fixed-sub-container">
			<ul>
			<?php $is_rent = ($cat == HOUSE_CAT_RENT); ?>
			<?php $filter_url = $is_rent ? 'renthouse' : 'sellhouse'; ?>
			<?php if ($is_rent) :?>
				<li>
					<a href="sellhouse">出售房源</a>
				</li>
				<li>
					<a class="active" href="javascript:;">出租房源</a>
				</li>
			<?php else : ?>
				<li>
					<a class="active" href="javascript:;">出售房源</a>
				</li>
				<li>
					<a href="renthouse">出租房源</a>
				</li>
			<?php endif; ?>
			</ul>
		</div>

		<div id="listing-filters" class="sub-container fixed-sub-container">
		<?php if (isset($filters_area)) :?>
			<fieldset>
				<span class="legend">区域</span>
				<div class="links">
				<?php foreach ($filters_area as $area_id => $area) : ?>
					<?php if ($filters['area'] == $area_id) :?>
						<a class="checked"><?php print_r($area['area_name']); ?></a>
					<?php else : ?>
						<a href="javascript:performFilter('area', <?php print_r($area_id); ?>);"><?php print_r($area['area_name']); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<?php if (isset($filters_size)) :?>
			<fieldset>
				<span class="legend">面积</span>
				<div class="links">
				<?php foreach ($filters_size as $index => $size_name) : ?>
					<?php if ($filters['size'] == $index) :?>
						<a class="checked"><?php print_r($size_name); ?></a>
					<?php else : ?>
						<a href="javascript:performFilter('size', <?php print_r($index); ?>);"><?php print_r($size_name); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<?php if (isset($filters_room)) :?>
			<fieldset>
				<span class="legend">户型</span>
				<div class="links">
				<?php foreach ($filters_room as $index => $room_name) : ?>
					<?php if ($filters['room'] == $index) :?>
						<a class="checked"><?php print_r($room_name); ?></a>
					<?php else : ?>
						<a href="javascript:performFilter('room', <?php print_r($index); ?>);"><?php print_r($room_name); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<?php if (isset($filters_price)) :?>
			<fieldset>
				<span class="legend"><?php echo $is_rent ? '租金' : '售价';?></span>
				<div class="links">
				<?php foreach ($filters_price as $index => $price) : ?>
					<?php if ($filters['price'] == $index) :?>
						<a class="checked"><?php print_r($price); ?></a>
					<?php else : ?>
						<a href="javascript:performFilter('price', <?php print_r($index); ?>);"><?php print_r($price); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<?php if (isset($filters_decor)) :?>
			<fieldset>
				<span class="legend">装修</span>
				<div class="links">
				<?php foreach ($filters_decor as $index => $decor) : ?>
					<?php if ($filters['decor'] == $index) :?>
						<a class="checked"><?php print_r($decor); ?></a>
					<?php else : ?>
						<a href="javascript:performFilter('decor', <?php print_r($index); ?>);"><?php print_r($decor); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

		<?php if (isset($filters_floor)) :?>
			<fieldset>
				<span class="legend">楼层</span>
				<div class="links">
				<?php $custom_floor = $filters['floor_from'] != $filters['floor_to'] ; ?>
				<?php foreach ($filters_floor as $index => $floor) : ?>
					<?php if (!$custom_floor && $filters['floor_from'] == $index) :?>
						<a class="checked"><?php print_r($floor); ?></a>
					<?php else : ?>
						<a href="javascript:performFloorFilter(<?php print_r($index); ?>, <?php print_r($index); ?>);"><?php print_r($floor); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
					<span class="range">
						<label>自定义：</label>
						<input id="customFloorFrom" type="text" class="number" value="<?php $custom_floor ? print_r($filters['floor_from']) : ''; ?>" />
						<label>~</label>
						<input id="customFloorTo" type="text" class="number" value="<?php $custom_floor ? print_r($filters['floor_to']) : ''; ?>" />
						<label class="unit">楼</label>
						<input type="submit" value="筛选" class="filter-button" onclick="return floorSubmit();" />
					</span>
				</div>
			</fieldset>
		<?php endif; ?>

			<div style="border-top: 1px solid #ddd; "></div>

		<?php if (isset($filters_community)) :?>
			<fieldset>
				<span class="legend">热门小区</span>
				<div class="links">
				<?php foreach ($filters_community as $community_id => $community) : ?>
					<?php if ($filters['community'] == $community_id) :?>
						<a class="checked"><?php print_r($community['cname']); ?></a>
					<?php else : ?>
						<a href="javascript:performFilter('community', <?php print_r($community_id); ?>);"><?php print_r($community['cname']); ?></a>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</fieldset>
		<?php endif; ?>

			<fieldset class="search-fieldset">
				<form id="listing-filters-form" action="<?php echo $filter_url; ?>">

				<?php foreach ($filters as $key => $value) : ?>
					<input type="hidden" name="<?php print_r($key); ?>" value="<?php print_r($value); ?>"/>
				<?php endforeach; ?>

					<input type="text" name="kw" placeholder="搜索关键词" value="<?php print_r($kw); ?>" />
					<button type="submit" onclick="return submitKw();">
						<i class="glyphicon-search"></i>
					</button>
				</form>
				
			</fieldset>
		</div>

		<script type="text/javascript">
		var listingFiltersForm = $('#listing-filters-form');
		var initFormData = listingFiltersForm.serialize();
		console.log(initFormData);

		var inputFloorFrom = listingFiltersForm.find('input[name="floor_from"]');
		var inputFloorTo = listingFiltersForm.find('input[name="floor_to"]');
		
		var inputKw = listingFiltersForm.find('input[name="kw"]');
		var initKw = $.trim(inputKw.val());
		console.log(initKw);

		var customFloorFrom = $('#customFloorFrom');
		var customFloorTo = $('#customFloorTo');

		function submitKw () {
			var kw = $.trim(inputKw.val());
			console.log(kw);
			if (initKw == kw) {
				return false;
			}
			return true;
		}

		function performFilter(name, value) {
			var ele = listingFiltersForm.find('input[name="' + name + '"]');
			var eleVal = $.trim(ele.val());
			if (eleVal == value) {
				return;
			}
			ele.val(value);
			listingFiltersForm.submit();
		}

		function performFloorFilter(valFrom, valTo) {
			var floorFrom = $.trim(inputFloorFrom.val());
			var floorTo = $.trim(inputFloorTo.val());
			if (valFrom == floorFrom && valTo == floorTo) {
				return false;
			}
			inputFloorFrom.val(valFrom);
			inputFloorTo.val(valTo);
			listingFiltersForm.submit();
			return true;
		}

		function floorSubmit() {
			var from = $.trim(customFloorFrom.val());
			if (!__isPositiveInt(from)) {
				alert('请输入大于0的整数');
				customFloorFrom.focus();
				return false;
			}
			var to = $.trim(customFloorTo.val());
			if (!__isPositiveInt(to)) {
				alert('请输入大于0的整数');
				customFloorTo.focus();
				return false;
			}
			if (from > to) {
				alert('楼层数值设置有误！');
				customFloorTo.focus();
				return false;
			}
			return performFloorFilter(from, to);
		}
		</script>
	</section>