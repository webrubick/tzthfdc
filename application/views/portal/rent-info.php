<!-- Header -->
<?php $this->load->view('portal/template/template-portal-header'); ?>

	<link href="public/css/portal/house-info.css" rel="stylesheet" type="text/css">
	<!-- content -->
<?php if (isset($house)) : ?>
	<section class="house-info-container">
		<div class="house-main">
			<div class="house-info">
				<div class="house-header">
					<div class="house-title">
						<h1><?php print_r($house['title']); ?></h1>
					</div>
					<div class="house-title-footer">
						<span>更新时间：<?php print_r($house['update_time']); ?></span>
					</div>
				</div>
				<div class="house-content">
					<div class="house-gallery">
					<?php if (!isset($house['images']) || empty($house['images'])) : ?>
						<div class="empty-img-placeholder">
							<img src="public/img/portal/house_info_placeholder.jpg"/>
						</div>
					<?php else : ?>
						<div class="img-container">
							<img src="<?php print_r($house['images']); ?>" />
						</div>
						<script type="text/javascript">
						var adjustImgSize = function(img, boxWidth, boxHeight) {
					        // var imgWidth=img.width();
					        // var imgHeight=img.height();
					        // 上面这种取得img的宽度和高度的做法有点儿bug 
					        // src如果由两个大小不一样的图片相互替换时，上面的写法就有问题了，换过之后的图片的宽度和高度始终取得的还是换之前图片的值。
					        // 解决方法：创建一个新的图片类，并将其src属性设上。
					        var tempImg = new Image();        
					        tempImg.src = img.attr('src');
					        var imgWidth=tempImg.width;
					        var imgHeight=tempImg.height;

					        //比较imgBox的长宽比与img的长宽比大小
					        if((boxWidth/boxHeight)>=(imgWidth/imgHeight))
					        {
					            //重新设置img的width和height
					            img.width((boxHeight*imgWidth)/imgHeight);
					            img.height(boxHeight);
					        }
					        else
					        {
					            //重新设置img的width和height
					            img.width(boxWidth);
					            img.height((boxWidth*imgHeight)/imgWidth);
					        }
					    };
				    
					    // 本机能的js事件
					    // 图像加载完成之后，调整图片大小
				         $('.house-gallery .img-container img').load(function() {
				             adjustImgSize($(this), 300, 300);
				         });
						</script>
					<?php endif; ?>
					</div>
					<div class="house-basic-info">
						<section>
							<ul>
								<li>
									<label>价格：</label>
									<span class="house-price highlight"><?php print_r($house['price']); ?>元/月</span>
								</li>
								<li>
									<label>出租方式：</label>
									<span><?php print_r($house['rent_type']); ?></span>
								</li>
								<li>
									<label>付款方式：</label>
									<span><?php print_r($house['rentpay_type']); ?></span>
								</li>
								<li>
									<label>房型：</label>
									<span><?php print_r($house['room_type']); ?></span>
								</li>
								<li>
									<label>面积：</label>
									<span><?php print_r($house['size']); ?>㎡</span>
								</li>
								<li>
									<label>装修：</label>
									<span><?php print_r($house['decor']); ?></span>
								</li>
								<li>
									<label>小区名：</label>
									<span><?php print_r($house['subinfo_area']); ?></span>
								</li>
								<li>
									<label>楼层：</label>
									<span><?php print_r($house['subinfo_floors']); ?></span>
								</li>
								<li>
									<label>朝向：</label>
									<span><?php print_r($house['orientation']); ?></span>
								</li>
							</ul>
						</section>

						<!--
						<section class="house-poster-contact">
							<ul>
								<li>
									<label>联系方式</label>
									<span><?php print_r($house['poster']['contact_mobile']); ?></span>
								</li>
							</ul>
						</section>
						-->
					</div>
				</div>
				<div class="house-detail">
					<div class="house-common-header">
						<div class="section-title">详情介绍</div>
					</div>
					<div class="section-sep"></div>
					<div>
						<div class="detail-text">
							
						</div>
						<script type="text/javascript">
						<?php $house_details = isset($house['details']) ? $house['details'] : ''; ?>
						<?php $house_details = str_replace("\n", '<br/>', $house_details); ?>
						$('.house-detail div.detail-text').html('<?php echo $house_details; ?>');
						</script>
					</div>
				</div>
			</div>

			<img src="" />
		</div>

		<?php $this->load->view('portal/house-poster'); ?>
	</section>
<?php else : ?>
	<section class="house-info-container">
		<div class="house-main">
		没有找到指定房源
		</div>
	</section>
<?php endif; ?>

	<div class="section-sep"></div>

	<script type="text/javascript">

	</script>


<!-- Footer -->
<?php $this->load->view('portal/template/template-portal-footer'); ?>