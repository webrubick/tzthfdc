			<?php $tabIndex = 1; ?>
			<?php $editMode = isset($house); ?>
			<?php //!$editMode OR print_r($house); ?>
			<table class="table table-bordered table-striped house-edit-container">

				<?php if (isset($rent_types)) : ?>
				<tr>
					<th><small>*</small>出租方式</th>
					<td>
						<div id="house-edit-input-container">
							<?php foreach ($rent_types as $key => $value) : ?>
							<label class="radio-inline">
								<input type="radio" name="rent_type" value="<?php echo $key; ?>"> <?php echo $value; ?>
							</label>
							<?php endforeach; ?>
						</div>
						<script type="text/javascript">
						$('input[name="rent_type"]').prop('checked', false);
						<?php if ($editMode) : ?>
						$('input[name="rent_type"][value="<?php echo $house['rent_type']; ?>"]').prop('checked', true);
						<?php else : ?>
						$($('input[name="rent_type"]').get(0)).prop('checked', true);
						<?php endif ; ?>
						</script>
					</td>
				</tr>
				<?php endif; ?>

				<tr>
					<th><small>*</small><label>小区</label></th>
					<td>
						<div class="house-edit-input-container">
							<?php if (isset($areas)) : ?>
							<div class="house-selectordef" style="width:160px" tabindex="<?php echo $tabIndex++; ?>">
								<div class="title">
									<?php if ($editMode && isset($house['aid']) && isset($areas[$house['aid']])) : ?>
										<?php $target_aid = $house['aid']; $target_aname = $areas[$target_aid]['area_name']; ?>
										<span id="inputArea" class="seled" data-field="aid" data-trtitle="1" data-valueid="<?php print_r($target_aid); ?>"><?php echo "$target_aname"; ?></span>
									<?php else : ?>
									<span id="inputArea" class="seled" data-field="aid" data-trtitle="1">选择区域(非必选)</span>
									<?php endif ; ?>
									
									<div class="arrow"></div>
								</div>
								<div class="house-optiondef" style="display:none; width:172px" >
									<ul>
										<li data-id="0">请选择区域</li>
										<?php foreach ($areas as $key => $value) : ?>
											<li data-id="<?php echo $key; ?>"><?php echo $value['area_name']; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<?php endif; ?>

							<div class="house-related-long" style="height: 34px; display: inline-block; float: left;">
								<?php if ($editMode) : ?>
									<?php $target_cid = 0; $target_cname = ''; ?>
									<?php if (isset($house['cid'])) : ?>
										<?php $target_cid = intval($house['cid']); ?>
										<?php if (isset($communitys) && isset($communitys[$target_cid])) : ?>
											<?php $target_cname = $communitys[$target_cid]['cname']; ?>
										<?php endif ; ?>
									<?php endif ; ?>
									<?php if (isset($house['community']) && !empty($house['community'])) : ?>
										<?php $target_cname = $house['community']; ?>
									<?php endif ; ?>
									<input type="text" name="community" id="inputComm" class="form-control" style="width: 100%;" placeholder="只填写小区名，例财富广场, cfgc" tabindex="<?php echo $tabIndex++; ?>" data-id="<?php print_r($target_cid); ?>" data-name="<?php echo "$target_cname"; ?>" value="<?php echo "$target_cname"; ?>" autofocus/>
								<?php else : ?>
									<input type="text" name="community" id="inputComm" class="form-control" style="width: 100%;" placeholder="只填写小区名，例财富广场, cfgc" tabindex="<?php echo $tabIndex++; ?>" autofocus/>
								<?php endif ; ?>
								<div class="house-tooltip" style="display: none;">
									<ul class="house-autoCompleteul">
										<?php if (isset($communitys)) : ?>
										<?php foreach ($communitys as $key => $value) : ?>
										<li data-id="<?php echo $key; ?>" data-pinyin="<?php echo $value['pinyin']; ?>" data-name="<?php echo $value['cname']; ?>"><?php echo $value['cname']; ?></li>
										<?php endforeach; ?>
										<?php endif; ?>
									</ul>
								</div>
							</div>
							
						</div>
					</td>
				</tr>

				<tr>
					<th><small>*</small>房屋户型</th>
					<td>
						<div class="house-edit-input-container">
							<div class="house-input_text_wrap">
								<input type="text" name="rooms" id="inputHouseRooms" maxlength="1" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['rooms']) && !empty($house['rooms'])) ? 'value="'.$house['rooms'].'"' : ''; ?> />
								<span>室</span>
							</div>
							<div class="house-input_text_wrap">
								<input type="text" name="halls" id="inputHouseHalls" maxlength="1" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['halls']) && !empty($house['halls'])) ? 'value="'.$house['halls'].'"' : ''; ?> />
								<span>厅</span>
							</div>
							<div class="house-input_text_wrap">
								<input type="text" name="bathrooms" id="inputHouseBathrooms" maxlength="1" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['bathrooms']) && !empty($house['bathrooms'])) ? 'value="'.$house['bathrooms'].'"' : ''; ?> />
								<span>卫</span>
							</div>

							<div class="house-input_text_wrap">
								<span>共</span>
								<input type="text" name="size" id="inputHouseSize" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['size']) && !empty($house['size'])) ? 'value="'.$house['size'].'"' : ''; ?> />
								<span>㎡(<small>*支持两位小数</small>)</span>
							</div>
						</div>
					</td>
				</tr>

				<!-- 额外的一些信息㎡ -->
				<tr>
					<th>楼层</th>
					<td>
						<div class="house-edit-input-container">
							<div class="house-input_text_wrap">
								<span>第</span>
								<input type="text" name="floors" id="inputHouseFloor" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['floors']) && !empty($house['floors'])) ? 'value="'.$house['floors'].'"' : ''; ?> />
								<span>层(<small>地下室用负数，例：-3</small>）</span>
							</div>
							<div class="house-input_text_wrap">
								<span>共</span>
								<input type="text" name="floors_total" id="inputHouseTotalFloor" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['floors_total']) && !empty($house['floors_total'])) ? 'value="'.$house['floors_total'].'"' : ''; ?> />
								<span>层</span>
							</div>
						</div>
					</td>
				</tr>

				<tr>
					<th>类型</th>
					<td>
						<div class="house-edit-input-container clearfix">
							<?php if (isset($house_types)) : ?>
							<div class="house-selectordef" tabindex="<?php echo $tabIndex++; ?>">
								<div class="title">
									<?php if ($editMode && isset($house['house_type']) && isset($house_types[$house['house_type']])) : ?>
										<?php $target_id = $house['house_type']; $target_name = $house_types[$target_id]; ?>
										<span class="seled" data-field="house_type" data-valueid="<?php print_r($target_id); ?>"><?php echo "$target_name"; ?></span>
									<?php else : ?>
									<span class="seled" data-field="house_type">请选择类型</span>
									<?php endif ; ?>
									<div class="arrow"></div>
								</div>
								<div class="house-optiondef" style="display:none;" >
									<ul>
										<li data-id="0">请选择类型</li>
										<?php foreach ($house_types as $key => $value) : ?>
											<li data-id="<?php echo $key; ?>"><?php echo $value; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<?php endif; ?>

							<?php if (isset($house_decors)) : ?>
							<div class="house-selectordef" tabindex="<?php echo $tabIndex++; ?>">
								<div class="title">
									<?php if ($editMode && isset($house['decor']) && isset($house_decors[$house['decor']])) : ?>
										<?php $target_id = $house['decor']; $target_name = $house_decors[$target_id]; ?>
										<span id="inputDecor" class="seled" data-field="decor" data-trtitle="1" data-valueid="<?php print_r($target_id); ?>"><?php echo "$target_name"; ?></span>
									<?php else : ?>
									<span id="inputDecor" class="seled" data-field="decor" data-trtitle="1">请选择装修情况</span>
									<?php endif ; ?>
									<div class="arrow"></div>
								</div>
								<div class="house-optiondef" style="display:none;" >
									<ul>
										<li data-id="0">请选择装修情况</li>
										<?php foreach ($house_decors as $key => $value) : ?>
											<li data-id="<?php echo $key; ?>"><?php echo $value; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<?php endif; ?>

							<?php if (isset($house_orientations)) : ?>
							<div class="house-selectordef" tabindex="<?php echo $tabIndex++; ?>">
								<div class="title">
									<?php if ($editMode && isset($house['orientation']) && isset($house_orientations[$house['orientation']])) : ?>
										<?php $target_id = $house['orientation']; $target_name = $house_orientations[$target_id]; ?>
										<span class="seled" data-field="orientation" data-valueid="<?php print_r($target_id); ?>"><?php echo "$target_name"; ?></span>
									<?php else : ?>
									<span class="seled" data-field="orientation">请选择朝向</span>
									<?php endif ; ?>
									<div class="arrow"></div>
								</div>
								<div class="house-optiondef" style="display:none;" >
									<ul>
										<li data-id="0">请选择朝向</li>
										<?php foreach ($house_orientations as $key => $value) : ?>
											<li data-id="<?php echo $key; ?>"><?php echo $value; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<?php endif; ?>

						</div>
					</td>
				</tr>

				<?php if (isset($support_devices)) : ?>
				<tr>
					<th>房屋配置</th>
					<td>
						<div id="house-edit-input-container">
							<?php foreach ($support_devices as $key => $value) : ?>
							<label class="checkbox-inline">
								<input type="checkbox" name="support_device[]" value="<?php echo $key; ?>"> <?php echo $value; ?>
							</label>
							<?php endforeach; ?>
							<br/>
							<a id="supportDeviceCheckAll" class="btn btn-default house-op house-op-edit">全选</a>
						</div>
					</td>
				</tr>
				<?php endif; ?>

				<tr>
					<th><small>*</small>租金</th>
					<td>
						<div class="house-edit-input-container">
							<div class="house-input_text_wrap">
								<?php if ($editMode && isset($house['price']) && !empty($house['price'])) : ?>
								<input type="text" name="price" id="inputHousePrice" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" value="<?php print_r($house['price']); ?>">
								<?php else : ?>
								<input type="text" name="price" id="inputHousePrice" class="house-related-short" tabindex="<?php echo $tabIndex++; ?>" value="面议">
								<?php endif; ?>
								<span>元/月(<small>*整数</small>)</span>
							</div>

							<?php if (isset($rentpay_types)) : ?>
							<div class="house-selectordef" tabindex="<?php echo $tabIndex++; ?>">
								<div class="title">
									<?php if ($editMode && isset($house['rentpay_type']) && isset($rentpay_types[$house['rentpay_type']])) : ?>
										<?php $target_id = $house['rentpay_type']; $target_name = $rentpay_types[$target_id]; ?>
										<span class="seled" data-field="rentpay_type" data-valueid="<?php print_r($target_id); ?>"><?php echo "$target_name"; ?></span>
									<?php else : ?>
										<?php foreach ($rentpay_types as $key => $value) : ?>
										<span class="seled" data-field="rentpay_type" data-valueid="<?php echo "$key"; ?>"><?php echo "$value"; ?></span>
										<?php break; ?>
										<?php endforeach; ?>
									<?php endif ; ?>
									<div class="arrow"></div>
								</div>
								<div class="house-optiondef" style="display:none;" >
									<ul>
										<?php foreach ($rentpay_types as $key => $value) : ?>
										<li data-id="<?php echo $key; ?>"><?php echo $value; ?></li>
										<?php endforeach; ?>
									</ul>
								</div>
							</div>
							<?php endif; ?>
						</div>
					</td>
				</tr>
				

				<tr>
					<th><small>*</small>房源标题(<small>*可自动生成</small>)</th>
					<td>
						<div class="house-edit-input-container form-inline">
							<input type="text" name="title" id="inputHouseTitle" maxlength="50" class="form-control house-related-long" tabindex="<?php echo $tabIndex++; ?>" <?php echo ($editMode && isset($house['title'])) ? 'value="'.$house['title'].'"' : ''; ?> disabled />

							<button class="btn btn-warning" onclick="enableTitle(this);">编辑</button>
						</div>
					</td>
				</tr>

				<?php $this->load->view('admin/house/upload-house'); ?>
				<script type="text/javascript">
				prepare_upload('<?php echo base_url('adminhouse/rent_image'); ?>');
				</script>

				<!-- 详细信息 -->
				<tr>
					<th>详细介绍</th>
					<td>
						<div class="house-edit-input-container">
							<textarea name="details" id="inputDetails" class="form-control house-related-long" rows="5" placeholder="" tabindex="<?php echo $tabIndex++; ?>"></textarea>
							<script type="text/javascript">
							<?php if ($editMode) : ?>
							<?php $house_details = isset($house['details']) ? $house['details'] : ''; ?>
							<?php $house_details = str_replace("\n", '\n', $house_details); ?>
							$('#inputDetails').val('<?php echo $house_details; ?>')
							<?php endif; ?>
							</script>
						</div>
					</td>
				</tr>

				<tr>
					<th></th>
					<td>
						<div class="house-edit-input-container">
							<button class="btn btn-lg btn-primary btn-block login-btn house-related-short" type="submit" onClick="return checkInput()">提交</button>
						</div>
					</td>
				</tr>
			</table>

			<script type="text/javascript" src="public/scripts/admin/adminhouse.validate.js"></script>
			<script type="text/javascript" src="public/scripts/admin/adminrenthouse.validate.js"></script>
