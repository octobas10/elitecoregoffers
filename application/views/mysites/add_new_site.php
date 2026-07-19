<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); 
$available_offers = $offer_list;
//echo '<pre>';print_r($available_offers);print_r($result);
if (! empty ( $result->prime_offers )) {
	$intr_offers = @array_intersect ( @array_keys ( $available_offers ), explode ( ',', $result->prime_offers ) );
	if($intr_offers){
		foreach ( $intr_offers as $value ) {
			unset ( $available_offers [$value] );
		}
	}
}

if (! empty ( $result->regular_offers )) {
	$intr_offers = @array_intersect ( @array_keys ( $available_offers ), explode ( ',', $result->regular_offers ) );
	if($intr_offers){
		foreach ( $intr_offers as $value ) {
			unset ( $available_offers [$value] );
		}
	}
}
//echo 'availabel :';print_r($available_offers);
// echo"<pre>";print_r($available_offers);echo"</pre>";exit;
?>
<div class="col-md-12 ">
	<form role="form" method="post" id="form_sample_2"
		action="<?php echo base_url();?>MySite/add_site<?php if(!empty($result->id)) { echo "/".$result->id;}?>">
		<!-- BEGIN SAMPLE FORM PORTLET-->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i> 
					<span class="caption-subject font-green-sharp bold uppercase">Add New Site</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Site Name <span class="required"
									aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa"></i> <input type="text" class="form-control"
										name="site_name"
										value="<?php if(!empty($result->site_name)) { echo $result->site_name;}?>">
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Affiliate Names <span
									class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa"></i> <select class="form-control"
										name="affiliate_name">
											<?php if(!empty($GLOBALS['AFFILIATE_NAMES'])) { foreach ($GLOBALS['AFFILIATE_NAMES'] as $key=>$value) {?>
											<option value="<?php echo $key;?>"
											<?php if(!empty($result->affiliate_name) && $result->affiliate_name==$key) { echo "selected";}?>><?php echo $value;?></option>
											<?php } } ?>									
										</select>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- END SAMPLE FORM PORTLET-->

		<!-- OFFERs SECTION -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i> 
					<span class="caption-subject font-green-sharp bold uppercase">
					<?php if(!isset($result->id)){
						echo "Add offers while adding the site only";
					}else{
						echo "Manage Offers To Site";	
					}
					?>
					
					</span>
				</div>
			</div>
			<div class="portlet-body form">
				<div class="form-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Manage Offers On Site <span
									class="required" aria-required="true"> * </span></label> <select
									class="form-control" name="display_offer_type"
									id="display_offer_type">
									<option value="">Select Offer Type</option>
									<?php if(!empty($GLOBALS['DISPLAY_OFFER_TYPE'])){	foreach ($GLOBALS['DISPLAY_OFFER_TYPE'] as $key=>$value) { ?>
										<option value="<?php echo $key;?>"
										<?php if(!empty($result->display_offer_type) && $result->display_offer_type==$key) { echo "selected";}?>><?php echo $value?></option>
									<?php } } ?>
								</select>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Stage Exit <span
									class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa"></i> <select
									class="form-control" name="so_stage_exit"
									id="display_offer_type">
									<option value="">Select Stage Exit</option>
									<?php if(!empty($GLOBALS['SO_STATE_EXIT'])){	foreach ($GLOBALS['SO_STATE_EXIT'] as $key=>$value) { ?>
										<option value="<?php echo $key;?>"
										<?php if(!empty($result->so_stage_exit) && $result->so_stage_exit==$key) { echo "selected";}?>><?php echo $value?></option>
									<?php } } ?>
									</select>
								</div>
							</div>
						</div>
					</div>

					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Prime Offers</label>
								<div class="pull-right" style="margin-bottom: 1px;">
									<button type="button" class="btn btn-icon-only blue"
										id="prime_offer_add" title="Add Prime Offers">
										<i class="fa fa-chevron-circle-left"></i>
									</button>
									<button type="button" class="btn btn-icon-only red"
										id="prime_offer_remove" title="Remove Prime Offers">
										<i class="fa fa-chevron-circle-right"></i>
									</button>
								</div>
								
																

								<select multiple="" class="form-control" id="prime_offers"
									name="prime_offers[]">
								<?php
								if (! empty ( $result->prime_offers )) {
									
									$prime_offers = explode ( ",", $result->prime_offers );
									$prime_offers = array_filter ( array_map ( 'trim', $prime_offers ) );
									foreach ( $prime_offers as $value ) {
										?>
								<option value="<?php echo $value;?>" selected><?php echo $offer_list[$value];?></option>
								<?php }  } ?>
								</select>
							</div>

							<div class="form-group">
								<label>Regular Offers</label>
								<div class="pull-right" style="margin-bottom: 1px;">
									<button type="button" class="btn btn-icon-only blue"
										id="regular_offer_add" title="Add Regular Offers">
										<i class="fa fa-chevron-circle-left"></i>
									</button>
									<button type="button" class="btn btn-icon-only red"
										id="regular_offer_remove" title="Remove Regular Offers">
										<i class="fa fa-chevron-circle-right"></i>
									</button>
								</div>
								<select multiple="" class="form-control" id="regular_offers"
									name="regular_offers[]">
								<?php
								
								if (! empty ( $result->regular_offers )) {
									$regular_offers = explode ( ",", $result->regular_offers );
									$regular_offers = array_filter ( array_map ( 'trim', $regular_offers ) );
									foreach ( $regular_offers as $value ) {
										?>
								<option value="<?php echo $value;?>" selected><?php echo $offer_list[$value];?></option>
								<?php }  }  ?>
								</select>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Available Offers</label> 
								<div class="pull-right" style="margin-bottom: 1px;">
									<button type="button" class="btn btn-icon-only blue" id="up_available_offers" title="Circle Up">
										<i class="fa fa-chevron-circle-up"></i>
									</button>
									<button type="button" class="btn btn-icon-only red" id="down_available_offers" title="Circle Down">
										<i class="fa fa-chevron-circle-down"></i>
									</button>
								</div>
								<select multiple=""
									class="form-control" id="available_offers"
									style="height: 247px;">
									<?php
									if (count ( $available_offers ) > 0) {
										foreach ( $available_offers as $key => $value ) {
											?>
									<option value="<?php echo $key;?>"><?php echo $value;?></option>
									<?php } } ?>
								</select>
							</div>
							
							
						</div>
						
					</div>
					
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Prime Offers To Show</label>
								<div class="input-icon">
									<input type="number" min="0" max="100" maxLength="3" class="form-control" name="prime_offer_show" placeholder="Number of prime offers to show"
										value="<?php if(!empty($result->prime_offer_show)) { echo $result->prime_offer_show;}?>">
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Regular Offers To Show</label>
								<div class="input-icon">
									<input type="number" min="0"  max="100"  maxLength="3" class="form-control" placeholder="Number of regular offers to show"
										name="regular_offer_show"
										value="<?php if(!empty($result->regular_offer_show)) { echo $result->regular_offer_show;}?>">
								</div>
							</div>
						</div>
                        
                        <div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label>Randomize Prime offers?</label>
								<div class="input-icon">
									<input type="checkbox" class="form-control" name="po_seq_random" <?php if(!empty($result->po_seq_random)) { echo "checked";}?> />
								</div>
							</div>
						</div>

						<div class="col-sm-6">
							<div class="form-group">
								<label>Randomize Regular offers?</label>
								<div class="input-icon">
									<input type="checkbox" class="form-control" name="ro_seq_random" <?php if(!empty($result->ro_seq_random)) { echo "checked"; }?> />
								</div>
							</div>
						</div>
					</div>
				</div>

			</div>
		</div>
		<!-- /OFFERs SECTION -->
		<div class="form-actions">
			<input type="hidden" id="data_id"
				value="<?php if(!empty($result->id)) { echo $result->id;} ?>">
			<button type="submit" class="btn blue">Submit</button>
			<a href="<?php echo base_url();?>MySite/list_sites" class="btn default">Cancel</a>
		</div>
	</form>
</div>
