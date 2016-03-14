<!-- Header -->
<?php $this->load->view('portal/template/template-portal-header'); ?>

	<?php $this->load->view('portal/house-listing-filter'); ?>

	<div class="section-sep"></div>

	<?php $is_rent = ($cat == HOUSE_CAT_RENT); ?>
	<?php if ($is_rent) : ?>
	<?php $this->load->view('portal/renthouse-list-result'); ?>
	<?php else : ?>
	<?php $this->load->view('portal/sellhouse-list-result'); ?>
	<?php endif ; ?>

<!-- Footer -->
<?php $this->load->view('portal/template/template-portal-footer'); ?>