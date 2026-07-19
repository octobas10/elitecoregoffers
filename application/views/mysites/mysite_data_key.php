<?php defined ( 'BASEPATH' ) or exit ( 'No direct script access allowed' ); ?>
<div class="col-md-12" style="min-height: 55vh;">
	<form role="form" method="post" id="form_sample_2">
		<!-- BEGIN SAMPLE FORM PORTLET-->			
			<div class="portlet light">
				<div class="portlet-title">
					<div class="caption">
						<i class="fa fa-cogs font-green-sharp"></i> 
						<span class="caption-subject font-green-sharp bold uppercase">Add Site Field Keyword</span>
					</div>
				</div>
				<div class="portlet-body form">
					<div class="form-body">
						<div class="row">
							<div class="col-sm-3">
							   <label class="control-label">Select Site <span class="required" aria-required="true"> * </span></label>
								<select class="form-control" name="site_list" id="select_mysite_list">
								<?php 
								if(isset($list_sites) && !empty($list_sites)){
									echo "<option value='' selected>Select Site</option>";
                                    foreach($list_sites as $key){
                                        echo "<option value='".$key->id."' >".$key->site_name."(".$key->id.")"."</option>";
                                    }
								 }else{
								 	    echo "<option value=''>No Site Found</option>";
								 	}?>
								 </select>
							</div>
							<div class="col-sm-5">
								<div class="form-group">
									<label class="control-label">Field Name <span
										class="required" aria-required="true"> * </span></label>
									<div class="input-icon right">
										<i class="fa"></i> 
										<select class="form-control" 
											name="affiliate_name" id="d_select_field">
																														
											<option value=''></option>
										</select>
									</div>
									<div class="d_new_ajax_block"></div>
								</div>
								<div class="col-sm-3">
									<input type="button" value="Add" id="add_keyword">
						   		</div>
							</div>
							<div class="col-sm-3">
							<label class="control-label">Added Key Values <span
										class="required" aria-required="true"> * </span></label>
								<div class="form-group">
								  <table class="d_new_added_field table table-striped table-bordered table-hover dataTable no-footer">
                                     <tr><td colspan="2">No site selected.</td></tr>

								  </table>			
								</div>
							</div>							
						</div>
					</div>
				</div>
			</div>
	</form>
</div>