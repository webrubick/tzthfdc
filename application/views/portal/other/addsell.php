<!-- Header -->
<?php $this->load->view('portal/template/template-portal-header'); ?>

    <script type="text/javascript">
	var localHouseConfig = {
		url : '<?php echo base_url('other/addsell/ajax'); ?>',
		successMsg : '房源添加成功'
	};
	</script>

    <section>
		<div class="sub-container fixed-sub-container">
    		<div id="house-container">
    		    <a href="/" style="text-decoration: underline;">&lt;&lt; 返回首页</a>
    		    
    		    <h3>添加出售房源</h3>
    
    			<?php $this->load->view('admin/house/editor-sell'); ?>
    
    		</div>
        </div>
    </section>

	<script type="text/javascript" src="public/scripts/admin/admin.common.js"></script>

	<div class="section-sep"></div>

	<script type="text/javascript">
    $('tr.house-poster').removeClass('house-poster');
    
    localHouseConfig.uploadUrl = '<?php echo base_url('other/sell_image'); ?>';
	</script>


<!-- Footer -->
<?php $this->load->view('portal/template/template-portal-footer'); ?>