<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>
<style>
#form_sample_2 .checkbox input[type="checkbox"], .checkbox-inline input[type="checkbox"], .radio input[type="radio"], .radio-inline input[type="radio"]
{margin-left:-9px;}
</style>
<div class="col-md-12 ">
	<!-- BEGIN SAMPLE FORM PORTLET-->
	<div class="portlet light">
		<div class="portlet-title">
			<div class="caption">
				<i class="fa fa-cogs font-green-sharp"></i> 
				<span class="caption-subject font-green-sharp bold uppercase">Add New Client</span>
			</div>
		</div>
		<div class="portlet-body form">
			<form role="form" method="post" id="form_sample_2" action="<?php echo base_url();?>client/add_client<?php if(!empty($result->id)) { echo "/".$result->id;}?>">
				<div class="form-body">
					<div class="row">
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Name <span class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa fa-user"></i>
									<input type="text" class="form-control" name="client_name" value="<?php if(!empty($result->client_name)) { echo $result->client_name;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Alias <span class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_alias" value="<?php if(!empty($result->client_alias)) { echo $result->client_alias;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Contact Person </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_contact_person" value="<?php if(!empty($result->client_contact_person)) { echo $result->client_contact_person;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Email <span class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa fa-envelope"></i>
									<input type="text" class="form-control" name="client_email" value="<?php if(!empty($result->client_email)) { echo $result->client_email;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Phone Number <span class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa fa-phone"></i>
									<input type="text" class="form-control" minlength="10" maxlength="10" name="client_phone_number" value="<?php if(!empty($result->client_phone_number)) { echo $result->client_phone_number;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Client Ext </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_ext" value="<?php if(!empty($result->client_ext)) { echo $result->client_ext;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Fax Number </label>
								<div class="input-icon right">
									<i class="fa fa-fax"></i>
									<input type="text" class="form-control" name="client_fax_number" value="<?php if(!empty($result->client_fax_number)) { echo $result->client_fax_number;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Address </label>
								<div class="input-icon right">
									<i class="fa fa-building"></i>
									<input type="text" class="form-control" name="client_address" value="<?php if(!empty($result->client_address)) { echo $result->client_address;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Suite </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_suite" value="<?php if(!empty($result->client_suite)) { echo $result->client_suite;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">City </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_city" value="<?php if(!empty($result->client_city)) { echo $result->client_city;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">State </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_state" value="<?php if(!empty($result->client_state)) { echo $result->client_state;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Zip </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_zip" value="<?php if(!empty($result->client_zip)) { echo $result->client_zip;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">URL </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="client_url" value="<?php if(!empty($result->client_url)) { echo $result->client_url;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Password <span class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<i class="fa fa-lock"></i>
									<input type="password" class="form-control" name="client_password" value="<?php if(!empty($result->client_password)) { echo $result->client_password;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Affiliate Names <span class="required" aria-required="true"> * </span></label>
								<div class="input-icon right">
									<select class="form-control" name="affiliate_id">
											<option value="">Select</option>
											<?php if(!empty($GLOBALS['AFFILIATE_NAMES'])) { foreach ($GLOBALS['AFFILIATE_NAMES'] as $key=>$value) {?>
											<option value="<?php echo $key;?>" <?php if(!empty($result->affiliate_id) && $result->affiliate_id==$key) { echo "selected";}?>><?php echo $value;?></option>
											<?php } } ?>									
										</select>
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label class="control-label">Sales Person </label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" class="form-control" name="sales_person" value="<?php if(!empty($result->sales_person)) { echo $result->sales_person;}?>">
								</div>
							</div>
						</div>
						<div class="col-sm-6">
							<div class="form-group">
								<label>Status</label>
								<div class="radio-list">
									<label class="radio-inline">
										<div class="radio">
											<span class="checked">
												<input type="radio" checked="" value="1" name="client_status">
											</span>
										</div> Active
									</label>
									<label class="radio-inline">
										<div class="radio">
											<span>
												<input type="radio" value="2" name="client_status">
											</span>
										</div> Inactive 
									</label>									
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="form-actions">
					<button type="submit" class="btn blue">Submit</button>
					<button type="button" class="btn default">Cancel</button>
				</div>
			</form>
		</div>
	</div>
	<!-- END SAMPLE FORM PORTLET-->
</div>
<input type="hidden" name="data_id" id="data_id" value="<?php if(!empty($result->id)) { echo $result->id;}?>">