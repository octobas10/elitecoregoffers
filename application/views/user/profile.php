<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
	<div class="container">
		<!-- BEGIN PAGE CONTENT INNER -->
		<div class="row">
			<div class="col-md-12">
				<!-- BEGIN ACCORDION PORTLET-->
				<div class="portlet light">
					<div class="portlet-title">
						<div class="caption">
							<i class="fa fa-cogs font-green-sharp"></i> <span
								class="caption-subject font-green-sharp bold uppercase"><?php echo $page_title;?></span>
						</div>
					</div>
					<div class="portlet-body">
						<form role="form" method="post" action="<?php echo base_url();?>user/profile">
							<div class="form-body">
								<div class="row">
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">First Name </label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="text" class="form-control" name="first_name" value="<?php if(!empty($result->first_name)) { echo $result->first_name;}?>">
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Last Name </label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="text" class="form-control" name="last_name" value="<?php if(!empty($result->last_name)) { echo $result->last_name;}?>">
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Email </label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="email" class="form-control" name="email" value="<?php if(!empty($result->email)) { echo $result->email;}?>">
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Phone Number</label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="number" class="form-control" name="phone_number" value="<?php if(!empty($result->phone_number)) { echo $result->phone_number;}?>">
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">New Password</label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="text" class="form-control" name="password" value="">
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-group">
												<label class="control-label">Confirm Password</label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="text" class="form-control" name="conf_password" value="">
												</div>
											</div>
										</div>
									</div>
									
									<div class="col-sm-12">
										<div class="col-sm-6">
											<div class="form-actions">
												<button type="submit" class="btn blue">Submit</button>
												<a href="<?php echo base_url();?>user/dashboard" class="btn default">Cancel</a>
											</div>
										</div>	
									</div>
								</div>
							</div>							
						</form>
					</div>
				</div>
			</div>
		</div>
		<!-- END PAGE CONTENT INNER -->
	</div>
</div>
<!-- END PAGE CONTENT -->
