	<link href="public/css/portal/index-list.css" rel="stylesheet" type="text/css">
	
	<section>
		<div id="listing-result" class="sub-container fixed-sub-container">
			<div class="listing-result-hint">
				共搜到<span class="highlight"><?php print_r($result_num); ?></span>条房源
				<img src="public/img/portal/house_result_bc.png"/>
			</div>
			<?php if ($result_num > 0) : ?>
				<ul id="house-list">
				<?php foreach ($houses as $house) : ?>
				<li>
					<?php $item_url_path = "renthouse/{$house['hid']}" ; ?>
					<a class="media-cap" href="<?php print_r($item_url_path); ?>" target="_blank">
						<?php if (empty($house['images'])) : ?>
						<img src="public/img/portal/list_default_house_img.png"/>
						<?php else : ?>
						<img src="<?php print_r($house['images']); ?>"/>
						<?php endif ; ?>
					</a>
					<div class="media-body">
						<div class="media-body-title">
							<span class="highlight"><?php print_r($house['price']); ?>元/月</span>
							<a class="house-title" href="<?php print_r($item_url_path); ?>" target="_blank"><?php print_r($house['title']); ?></a>
						</div>
						<div class="house-info">
							<span class="highlight"><?php print_r($house['subinfo_area']); ?> </span>
							<?php if (!empty($house['subinfo_house'])) : ?>
							&nbsp;&nbsp;&nbsp;&nbsp; <?php print_r(implode('&nbsp;/&nbsp;', $house['subinfo_house'])); ?>
							<?php endif ; ?>
						</div>
						<div class="house-info">经纪人：<?php print_r($house['poster_name']); ?> &nbsp;&nbsp;&nbsp;&nbsp; 联系电话：<b><?php print_r($house['poster_mobile']); ?></b></div>
					</div>
				</li>
				<?php endforeach ; ?>
				</ul>
			<?php endif ; ?>
		</div>
	</section>

	<?php $this->load->view('portal/house-list-pager', array('page_url' => 'renthouse')); ?>