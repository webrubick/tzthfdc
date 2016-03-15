	<?php if (isset($pagearr) && $pagearr['pagenum'] > 0) : ?>
	<section id="listing-pager" class="fixed-sub-container">
		<ul>
		<?php $currentpage = $pagearr['currentpage']; ?>
		<?php $totalnum = $pagearr['totalnum']; ?>
		<?php $numlinks = 10; ?>
		<?php $pagenum = $pagearr['pagenum']; ?>

		<?php $suf_page = min($currentpage + 4, $pagenum); ?>
		<?php $pre_page = $currentpage - (9 - ($suf_page - $currentpage)); ?>

		<?php if ($pagenum <= $numlinks) : ?>
			<?php $pre_page = 1; ?>
			<?php $suf_page = min($numlinks, $pagenum); ?>
		<?php else : ?>

			<?php //保证中间显示10个 ?>
			<?php if ($currentpage > 6) : ?>
				<?php $suf_page = min($currentpage + 4, $pagenum); ?>
				<?php $pre_page = $currentpage - (9 - ($suf_page - $currentpage)); ?>
			<?php else: ?>
				<?php $pre_page = 1; ?>
				<?php $suf_page = 10; ?>
			<?php endif; ?>
		<?php endif; ?>

		<?php if ($pagenum > $numlinks && $currentpage > 1) : ?>
		<li><a href="javascript: gotopage(<?php print_r($currentpage - 1); ?>);">上一页</a></li>
		<?php endif; ?>

		<?php for ($i = max(0, $pre_page - 1); $i < $suf_page; $i++) { ?> 
			<?php if ($i + 1 == $currentpage) : ?>
		<li class="checked"><span><?php print_r($i + 1); ?></span></li>
			<?php else: ?>
		<li><a href="javascript: gotopage(<?php print_r($i + 1); ?>);"><?php print_r($i + 1); ?></a></li>
			<?php endif; ?>
		<?php } ?>

		<?php if ($pagenum > $numlinks && $currentpage < $pagenum) : ?>
		<li><a href="javascript: gotopage(<?php print_r($currentpage + 1); ?>);">下一页</a></li>
		<?php endif; ?>
		</ul>

		<form id="listing-pager-form" action="<?php print_r($page_url); ?>">
		<?php foreach ($filters as $key => $value) : ?>
			<input type="hidden" name="<?php print_r($key); ?>" value="<?php print_r($value); ?>"/>
		<?php endforeach; ?>
			<input type="hidden" name="currentpage" value="<?php print_r($currentpage); ?>">
		</form>
	</section>

	<script type="text/javascript">
	var listingPagerForm = $('#listing-pager-form');
	var inputCurrentPage = listingPagerForm.find('input[name="currentpage"]');
	function gotopage (num) {
		inputCurrentPage.val(num);
		listingPagerForm.submit();
	}
	</script>
	<?php endif; ?>