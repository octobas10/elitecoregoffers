<?php 
//echo"<pre>";print_r($list_clients);echo"</pre>";exit;
//echo"<pre>";print_r($result);echo"</pre>";exit;
?>
<!-- FORM STARTs -->
<form role="form"
	action="<?php echo base_url();?>offer/add_offer<?php if(!empty($result->id)) { echo "/".$result->id; }?>"
	method="post" id="form_sample_2" enctype="multipart/form-data" >
	<div class="">
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-cogs font-green-sharp"></i> <span
						class="caption-subject font-green-sharp bold uppercase"><?php if(!empty($result->id)) { echo "Edit"; } else { echo "Add New";}?> Offer</span>
				</div>
				<div class="tools"></div>
			</div>
			<div class="portlet-body form" style="display: block;">
				<div class="form-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label class="control-label">Offer Name</label>
								<div class="input-icon right">
									<i class="fa"></i> <input type="text" name="offer_name"
										value="<?php if(!empty($result->offer_name)) { echo $result->offer_name;} ?>"
										class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">Client Name</label> <select
									class="form-control" name="client_id">
									<option value="">select client</option>
									<?php if(count($list_clients)>0){ foreach ($list_clients as $key=>$value) {?>
									<option value="<?php echo $key?>"
										<?php if(!empty($result->client_id) && $result->client_id==$key) { echo "selected";} ?>><?php echo $value?></option>
									<?php } }?>
								</select>
							</div>

							<div class="form-group">
								<label>Notes</label>
								<textarea class="form-control" rows="3" name="notes"><?php if(!empty($result->notes)) { echo $result->notes;} ?></textarea>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label>Question</label>
								<div class="input-icon">
									<i class="fa"></i> <input type="text" name="question"
										value="<?php if(!empty($result->question)) { echo $result->question;} ?>"
										class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label>Offer Options</label>
								<div class="radio-list">
									<label class="radio-inline">
										<div class="md-radio pull-left">
											<input type="radio" id="field_opt_in" name="offer_options" value="opt_in" class="md-radiobtn" <?php if(!empty($result->id) && $result->offer_options=="opt_in") { echo "checked";} ?>> 
											<label for="field_opt_in"> 
												<span></span>
												<span class="check"></span> <span class="box"></span>Opt-in
											</label>
										</div>										
									</label>
									
									<label class="radio-inline">
										<div class="md-radio pull-left">
											<input type="radio" id="field_opt_out" name="offer_options" value="opt_out" class="md-radiobtn" <?php if(!empty($result->id) && $result->offer_options=="opt_out") { echo "checked";} ?>> 
											<label for="field_opt_out"> 
												<span></span>
												<span class="check"></span> <span class="box"></span>Opt-out
											</label>
										</div>										
									</label>
									
									<label class="radio-inline">
										<div class="md-radio pull-left">
											<input type="radio" id="field_opt_popout" name="offer_options" value="opt_popout" class="md-radiobtn" <?php if(!empty($result->id) && $result->offer_options=="opt_popout") { echo "checked";} ?>> 
											<label for="field_opt_popout"> 
												<span></span>
												<span class="check"></span> <span class="box"></span>Offer is a Pop Out
											</label>
										</div>										
									</label>
									<?php //since 14 july 2016 update ?>
									<label class="radio-inline">
										<div class="md-radio pull-left">
											<input type="radio" id="field_double_opt" name="offer_options" value="double_opt" class="md-radiobtn d_double_opt" <?php if(!empty($result->id) && $result->offer_options=="double_opt") { echo "checked";} ?>> 
											<label for="field_double_opt"> 
												<span></span>
												<span class="check"></span> <span class="box"></span>Double Opt-in
											</label>
										</div>										
									</label>
									<?php // ?>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label">Transfer Method (Click on radio button to update offers specs) </label>
								<div class="radio-list">
									<label>
										<div class="md-radio">
											<input type="radio" id="transfer_method_post" name="transfer_method" value="transfer_method_post" data-toggle="modal" href="#transfer_method_post_model" class="md-radiobtn" <?php if(!empty($result->transfer_method) && $result->transfer_method=="transfer_method_post") { echo "checked";} ?>> 
											<label for="transfer_method_post"> 
												<span></span>
												<span class="check"></span> <span class="box"></span> Http Post
											</label>
										</div>										
									</label>
									
									<label>
										<div class="md-radio">
											<input type="radio" id="transfer_method_get" name="transfer_method" value="transfer_method_get" data-toggle="modal" href="#transfer_method_get_model" class="md-radiobtn" <?php if(!empty($result->transfer_method) && $result->transfer_method=="transfer_method_get") { echo "checked";} ?>> 
											<label for="transfer_method_get"> 
												<span></span>
												<span class="check"></span> <span class="box"></span> Http Get
											</label>
										</div>										
									</label>
									
									<label>
										<div class="md-radio">
											<input type="radio" id="transfer_method_email" name="transfer_method" value="transfer_method_email" data-toggle="modal" href="#transfer_method_email_model" class="md-radiobtn" <?php if(!empty($result->transfer_method) && $result->transfer_method=="transfer_method_email") { echo "checked";} ?>> 
											<label for="transfer_method_email"> 
												<span></span>
												<span class="check"></span> <span class="box"></span> Email
											</label>
										</div>										
									</label>
									
									<label>
										<div class="md-radio">
											<input type="radio" id="transfer_method_ftp" name="transfer_method" value="transfer_method_ftp" data-toggle="modal" href="#transfer_method_ftp_model" class="md-radiobtn" <?php if(!empty($result->transfer_method) && $result->transfer_method=="transfer_method_ftp") { echo "checked";} ?>> 
											<label for="transfer_method_ftp"> 
												<span></span>
												<span class="check"></span> <span class="box"></span> FTP
											</label>
										</div>										
									</label>
								</div>
							</div>
							<div class="form-group d_image_pixel_block <?php if((!empty($result->offer_options) && $result->offer_options!="double_opt") || (empty($result->offer_options))) { echo 'hide';} ?>">
                               <label class="control-label">Image Pixel Link</label>
								<div class="input-icon right">
									<i class="fa"></i>
									<input type="text" name="image_pixel_link"	class="d_image_pixel_link form-control" value="<?php if(!empty($result->image_pixel_link)) { echo $result->image_pixel_link;} ?>" class="form-control">
								</div>	
							</div>
						</div>
					</div>
					<!-- Models for transfer method -->
					<div class="row">
						<div class="col-lg-12">
							<div id="transfer_method_post_model" class="modal fade"
								tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true">&times;</button>
											<h4 class="modal-title">HTTP POST Method for Transfer Offer
												Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label" for="focusedInput">Http Post
													URL</label> <i class="fa"></i> <input class="form-control"
													id="" type="text" name="http_post_url"
													value="<?php if(!empty($result->http_post_url)){ echo $result->http_post_url;}?>">
											</div>

											<div class="form-group">
												<label class="control-label">Response Type </label>
												<div class="input-icon right">
													<i class="fa"></i> <select class="form-control"
														name="response_type[]" >
														<option value="">Select</option>
															<?php if(isset($GLOBALS['CLIENT_RESPONSE_TYPE']) && count($GLOBALS['CLIENT_RESPONSE_TYPE']) > 0) {  foreach ($GLOBALS['CLIENT_RESPONSE_TYPE'] as $key=>$value) { ?>
															<option value="<?php echo $key;?>"
															<?php if(isset($result->response_type) && $result->response_type==$key) { echo "selected";}?>><?php echo $value;?></option>
															<?php } } ?>	
														</select>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label">Possible Accepted Response Tag
												</label>
												<div class="input-icon right">
													<i class="fa"></i> <input type="text" 
														placeholder="eg. status,<IsValid>,RESULT,none" class="form-control" name="accepted_response_tag[]"
														value="<?php if(!empty($result->accepted_response_tag)) { echo $result->accepted_response_tag;}?>">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label">Possible Accepted Response
													Value </label>
												<div class="input-icon right">
													<i class="fa"></i> <input type="text" 
														placeholder="eg. Accepted,True,1,MatchFound"
														class="form-control" name="accepted_response_value[]"
														value="<?php if(!empty($result->accepted_response_value)) { echo $result->accepted_response_value;}?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div id="transfer_method_get_model" class="modal fade"
								tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true">&times;</button>
											<h4 class="modal-title">HTTP GET Method for Transfer Offer
												Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label" for="focusedInput">Http Get URL</label>
												<input class="form-control" id="" type="text"
													name="http_get_url"
													value="<?php if(!empty($result->http_get_url)){ echo $result->http_get_url;}?>">
											</div>
											<div class="form-group">
												<label class="control-label">Response Type </label>
												<div class="input-icon right">
													<i class="fa"></i> <select class="form-control"
														name="response_type[]" >
														<option value="">Select</option>
															<?php if(isset($GLOBALS['CLIENT_RESPONSE_TYPE']) && count($GLOBALS['CLIENT_RESPONSE_TYPE']) > 0) {  foreach ($GLOBALS['CLIENT_RESPONSE_TYPE'] as $key=>$value) { ?>
															<option value="<?php echo $key;?>"
															<?php if(isset($result->response_type) && $result->response_type==$key) { echo "selected";}?>><?php echo $value;?></option>
															<?php } } ?>	
														</select>
												</div>
											</div>

											<div class="form-group">
												<label class="control-label">Possible Accepted Response Tag
												</label>
												<div class="input-icon right">
													<i class="fa"></i> 
													<input type="text" placeholder="eg. status,<IsValid>,RESULT,none" class="form-control" name="accepted_response_tag[]" value="<?php if(!empty($result->accepted_response_tag)) { echo $result->accepted_response_tag;}?>">
												</div>
											</div>

											<div class="form-group">
												<label class="control-label">Possible Accepted Response
													Value </label>
												<div class="input-icon right">
													<i class="fa"></i> <input type="text" 
														placeholder="eg. Accepted,True,1,MatchFound"
														class="form-control" name="accepted_response_value[]"
														value="<?php if(!empty($result->accepted_response_value)) { echo $result->accepted_response_value;}?>">
												</div>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div id="transfer_method_email_model" class="modal fade"
								tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true">&times;</button>
											<h4 class="modal-title">Email Method for Transfer Offer Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label" for="focusedInput">Email</label>
												<input class="form-control" id="" type="text"
													name="transfer_email"
													value="<?php if(!empty($result->transfer_email)){ echo $result->transfer_email;}?>">
											</div>

											<div class="form-group">
												<label class="control-label" for="focusedInput">File Name</label>
												<input class="form-control" id="" type="text"
													name="email_file_name"
													value="<?php if(!empty($result->email_file_name)){ echo $result->email_file_name;}?>">
											</div>

											<div class="form-group">
												<label class="control-label" for="focusedInput">Delimeter</label>
												<select id="email_delimeter" name="email_delimeter">
													<option value="">--Select Delimeter--</option>
													<option value="comma"
														<?php if(!empty($result->id) && $result->email_delimeter=="comma"){echo "selected";}?>>Common</option>
													<option value="tab"
														<?php if(!empty($result->id) && $result->email_delimeter=="tab"){echo "selected";}?>>Tab</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>

							<div id="transfer_method_ftp_model" class="modal fade"
								tabindex="-1" role="basic" aria-hidden="true">
								<div class="modal-dialog modal-lg">
									<div class="modal-content">
										<div class="modal-header">
											<button type="button" class="close" data-dismiss="modal"
												aria-hidden="true">&times;</button>
											<h4 class="modal-title">FTP Method for Transfer Offer Data</h4>
										</div>
										<div class="modal-body">
											<div class="form-group">
												<label class="control-label" for="focusedInput">FTP Protocol</label>
												<select id="ftp_protocol" name="ftp_protocol">
													<option value="">--Select FTP Protocol--</option>
													<option value="1" <?php if(!empty($result->id) && $result->ftp_protocol=="1"){echo "selected";}?>>FTP</option>
													<option value="2" <?php if(!empty($result->id) && $result->ftp_protocol=="2"){echo "selected";}?>>sFTP</option>
												</select>
											</div>
											<div class="form-group">
												<label class="control-label" for="focusedInput">Host Name</label>
												<input class="form-control" id="" type="text"
													name="ftp_host_name"
													value="<?php if(!empty($result->ftp_host_name)){ echo $result->ftp_host_name;}?>">
											</div>
											<div class="form-group">
												<label class="control-label" for="focusedInput">FTP port</label>
												<input class="form-control" id="" type="text" name="ftp_port" value="<?php if(!empty($result->ftp_port)){ echo $result->ftp_port;}?>">
											</div>
											<div class="form-group">
												<label class="control-label" for="focusedInput">Login Name</label>
												<input class="form-control" id="" type="text"
													name="ftp_login_name"
													value="<?php if(!empty($result->ftp_login_name)){ echo $result->ftp_login_name;}?>">
											</div>

											<div class="form-group">
												<label class="control-label" for="focusedInput">Password</label>
												<input class="form-control" id="" type="text"
													name="ftp_login_password"
													value="<?php if(!empty($result->ftp_login_password)){ echo $result->ftp_login_password;}?>">
											</div>

											<div class="form-group">
												<label class="control-label" for="focusedInput">File Name</label>
												<input class="form-control" id="" type="text"
													name="ftp_file_name"
													value="<?php if(!empty($result->ftp_file_name)){ echo $result->ftp_file_name;}?>">
											</div>

											<div class="form-group">
												<label class="control-label" for="focusedInput">Delimeter</label>
												<select id="ftp_delimeter" name="ftp_delimeter">
													<option value="">--Select Delimeter--</option>
													<option value="comma"
														<?php if(!empty($result->id) && $result->ftp_delimeter=="comma"){echo "selected";}?>>Common</option>
													<option value="tab"
														<?php if(!empty($result->id) && $result->ftp_delimeter=="tab"){echo "selected";}?>>Tab</option>
												</select>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<!-- */Models for transfer method -->
					
					<div class="form-group">
								<label>Offer Rated</label>
								<div class="radio-list">
									<label class="radio-inline">
										<div class="md-radio pull-left">
											<input type="radio" id="field_pg_offer" name="rated_offers" value="1" class="md-radiobtn" <?php if(!empty($result->id) && $result->rated_offers=="1") { echo "checked";} ?>> 
											<label for="field_pg_offer"> 
												<span></span>
												<span class="check"></span> <span class="box"></span>PG Offer
											</label>
										</div>										
									</label>
									
									<label class="radio-inline">
										<div class="md-radio pull-left">
											<input type="radio" id="field_rated_offers" name="rated_offers" value="2" class="md-radiobtn" <?php if(!empty($result->id) && $result->rated_offers=="2") { echo "checked";} ?>> 
											<label for="field_rated_offers"> 
												<span></span>
												<span class="check"></span> <span class="box"></span>Rated R
											</label>
										</div>										
									</label>
								</div>
							</div>
					
					
					
				</div>
				<input type="hidden" name="data_id" id="data_id"
					value="<?php if(!empty($result->id)) { echo $result->id;} ?>">
			</div>
		</div>

		<!-- /* IO PAGE SECTION  -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-file-text-o font-green-sharp"></i> <span
						class="caption-subject font-green-sharp bold uppercase">IO Management</span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
            
            <div id="io_management_container">
                <input type="hidden" name="removed_io_management" id="removed_io_management" />
                <?php
                    if(isset($io_management) && !empty($io_management) && count((array)$io_management) > 0 ){
                        foreach($io_management as $i_key => $o_io_data){
                        ?>
                        <div class="portlet-body form io_management_block" style="display: block;">
                            <span class="remove_io_management">X Remove</span>
                            <div class="form-horizontal form-bordered">
                                <input type="hidden" name="io_data[]" class="io_data" value="<?php echo $o_io_data -> id ?>" />
                                <div class="form-body">
                                        <div class="row" >
                                            <div class="col-md-6">	
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Date Range</label>
                                                    <div class="col-md-4">
                                                        <div class="input-group input-large date-picker input-daterange" data-date="<?php echo date('Y-m-d');?>" data-date-format="yyyy-mm-dd">
                                                            <input type="text" class="form-control" maxLength="10" value="<?php echo $o_io_data->so_start_date; ?>" name="t_so_start_date_<?php echo ($i_key+1); ?>">
                                                            <span class="input-group-addon">
                                                            to </span>
                                                            <input type="text" class="form-control" maxLength="10" value="<?php echo $o_io_data->so_end_date; ?>" name="t_so_end_date_<?php echo ($i_key+1); ?>">
                                                        </div>
                                                        <!-- /input-group -->
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">EAR</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right clearfix">	
                                                        <input type="text" class="form-control" maxLength="2" value="<?php echo $o_io_data->so_ear; ?>" name="t_so_ear_<?php echo ($i_key+1); ?>">
                                                        </div>
                                                    </div>
                                                </div>



                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Weekly</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right clearfix">	
                                                        <input type="text" class="form-control makeTotal so_weekly" maxLength="10" id="so_weekly" value="<?php echo $o_io_data->so_weekly; ?>" name="t_so_weekly_<?php echo ($i_key+1); ?>">
                                                        </div>
                                                    </div>
                                                </div>


                                            </div>

                                            <div class="col-md-6">								
                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Payout</label>
                                                    <div class="col-md-9">
                                                        <div class="input-group input-icon right clearfix">	
                                                        <span class="input-group-addon"><i class="fa fa-dollar"></i></span>
                                                        <input type="text" class="form-control" maxLength="10" value="<?php echo $o_io_data->so_payout; ?>" name="t_so_payout_<?php echo ($i_key+1); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Daily</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right clearfix">	
                                                        <input type="text" class="form-control makeTotal so_daily" maxLength="10" id="so_daily" value="<?php echo $o_io_data->so_daily; ?>" name="t_so_daily_<?php echo ($i_key+1); ?>">
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Monthly</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right clearfix">	
                                                        <input type="text" class="form-control makeTotal so_monthly" maxLength="10" id="so_monthly" value="<?php  echo $o_io_data->so_monthly; ?>" name="t_so_monthly_<?php echo ($i_key+1); ?>">
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="form-group">
                                                    <label class="control-label col-md-3">Total</label>
                                                    <div class="col-md-9">
                                                        <div class="input-icon right clearfix">	
                                                        <input type="text" class="form-control display_total" value="<?php  echo $o_io_data->so_total; ?>" name="t_so_total_<?php echo ($i_key+1); ?>" id="display_total" >
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>	
                                        </div>
                                </div>
                            </div>
                        </div>   
                        <?php
                        }
                    }else{

                    }
                ?>
                         
            </div>
            <span id="add_io_management_block">Add IO Management</span>
            
		</div>
		<!-- IO PAGE SECTION*/  -->
			
		<!-- /*OFFER IMAGE UPLOAD  -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-file-image-o font-green-sharp"></i> <span
						class="caption-subject font-green-sharp bold uppercase">Offer Image </span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title="" title=""></a>
				</div>
			</div>
			<div class="portlet-body form" style="display: block;">
				<?php /*?>
				<div class="form-horizontal form-bordered">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-12">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<div class="fileinput-new thumbnail" style="width: 200px; height: 150px;">
										<img src="http://www.placehold.it/200x150/EFEFEF/AAAAAA&amp;text=no+image" alt="" />
									</div>
									<div class="fileinput-preview fileinput-exists thumbnail" style="width:50%;"></div>									
									<div>
										<span class="btn default btn-file"> 
										<span class="fileinput-new"> Select image </span> 
										<span class="fileinput-exists"> Change </span> 
										<input type="file" name="...">
										</span> <a href="javascript:;" class="btn red fileinput-exists" data-dismiss="fileinput">Remove </a>
									</div>
								</div>
								<div class="clearfix margin-top-10">
									<span class="label label-danger"> NOTE! </span> Image preview
									only works in IE10+, FF3.6+, Safari6.0+, Chrome6.0+ and
									Opera11.1+. In older browsers the filename is shown instead.
								</div>
							</div>
						</div>
					</div>
				</div>
				<?php */?>
				<div class="form-horizontal form-bordered">
					<div class="form-body">
						<div class="form-group">
							<div class="col-md-9">
								<div class="fileinput fileinput-new" data-provides="fileinput">
									<span class="btn default btn-file"> 
									<span class="fileinput-new">Select file </span> <span class="fileinput-exists">Change </span> 
									<input type="file" id="offer_image" value="<?php if(!empty($result->offer_image)) { echo $result->offer_image;} ?>" name="offer_image">
									</span> &nbsp; <a href="javascript:;"
										class="close fileinput-exists" data-dismiss="fileinput"></a>
									<div id="offer_image_box1">
										<?php  if(!empty($result->offer_image)) { ?>
										<img alt="offer image"
											src="<?php echo base_url()."uploads/".$result->offer_image;?>"
											style="width: 300px; height: 250px;">
										<?php }?>
									</div>
								</div>
							</div>
							<div class="col-md-3">
								<div id="offer_image_box2"></div>
								<input type="hidden" id="x" name="x" /> <input type="hidden"
									id="y" name="y" /> <input type="hidden" id="w" name="w" /> <input
									type="hidden" id="h" name="h" />
							</div>
						</div>
					</div>
					<div class="form-group">
						<div class="col-md-12">
							<div class="clearfix margin-top-10">
								<span class="label label-danger"> NOTE! </span>
								<p>This preview will be used to show on offer page.</p>
								<p>Image preview only works in IE10+, FF3.6+, Safari6.0+,
									Chrome6.0+ and Opera11.1+. In older browsers the filename is
									shown instead.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- OFFER IMAGE UPLOAD*/  -->

		<!-- /*OFFER CONTENT -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-file-text-o font-green-sharp"></i> <span
						class="caption-subject font-green-sharp bold uppercase">Offer Page
						Content </span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title=""
						title=""></a>
				</div>
			</div>
			<div class="portlet-body form" style="display: block;">
				<div class="form-horizontal form-bordered">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Offer Content</label>
							<div class="col-md-9">
								<textarea id="maxlength_textarea" class="form-control"
									name="offer_content" maxlength="1000" rows="2"
									placeholder="This textarea has a limit of 1000 chars."><?php if(!empty($result->offer_content)) { echo $result->offer_content; }?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- OFFER CONTENT*/ -->

        <!-- /*OFFER SCRIPT -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-file-text-o font-green-sharp"></i> <span
						class="caption-subject font-green-sharp bold uppercase">Offer Page Script </span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title=""
						title=""></a>
				</div>
			</div>
			<div class="portlet-body form" style="display: block;">
				<div class="form-horizontal form-bordered">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">Script</label>
							<div class="col-md-9">
								<textarea class="form-control" name="script"  rows="5" ><?php if(!empty($result->script)) { echo $result->script; }?></textarea>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!-- OFFER SCRIPT*/ -->
        
		<!-- /*OFFER FORM CONTENT -->
		<div class="portlet light">
			<div class="portlet-title">
				<div class="caption">
					<i class="fa fa-list-alt font-green-sharp"></i> <span
						class="caption-subject font-green-sharp bold uppercase">Offer Layout </span>
				</div>
				<div class="tools">
					<a href="javascript:;" class="collapse" data-original-title=""
						title=""></a>
				</div>
			</div>
			<div class="portlet-body form" style="display: block;">
				<div class="form-horizontal form-bordered">
					<div class="form-body">
						<div class="form-group">
							<label class="control-label col-md-3">
								<div class="caption font-red-sunglo">
									<i class="icon-check font-red-sunglo"></i> <span
										class="caption-subject bold uppercase"> Add Form Fields</span>
								</div>
							</label>
							<div class="clearfix">
								<a href="javascript:;" class="btn default red-stripe" onclick="add_fieldto_form('text');">Text Field </a> <a
									href="javascript:;" class="btn default blue-stripe" onclick="add_fieldto_form('radio');">Radio Button </a> <a
									href="javascript:;" class="btn default green-stripe" onclick="add_fieldto_form('selectbox');">Select Box </a> <a
									href="javascript:;" class="btn default yellow-stripe" onclick="add_fieldto_form('checkbox');">Check Box </a> <a
									href="javascript:;" class="btn default purple-stripe" onclick="add_fieldto_form('textarea');">Textarea </a> <a
									href="javascript:;" class="btn default red-stripe" onclick="add_fieldto_form('hidden');">Hidden Field </a> <a
									href="javascript:;" class="btn default red-stripe" onclick="add_fieldto_form('date-selector');">Date Selector</a>
									<a href="javascript:;" class="btn default red-stripe" onclick="add_fieldto_form('date-picker-box');">Date Picker </a>
							</div>
						</div>
						<!-- /*USER FORM -->
						<div id="offer-form-elements">
							<?php
							//echo '<pre>';print_r($result->offer_form);
							if(!empty($result->offer_form)){
							$offer_layout = json_decode($result->offer_form);	
							$count = 1;
							$required ='';
							$hidden = '';
							foreach ($offer_layout as $key=>$value){
								if(count($GLOBALS['SYSTEM_FIELDS']) > 0){
									$selectbox  = "<select name='userform[field_".$count."][system_field]'>";
									$selectbox .= "<option>Select System Field</option>";
									foreach ($GLOBALS['SYSTEM_FIELDS'] as $skey=>$svalue){
										$selectbox_selected = ($value->system_field==$skey) ? "selected" :"";										
										$selectbox .= "<option value='".$skey."' ".$selectbox_selected.">".$svalue."</option>";
									}
									$selectbox .= "</select>";
								}
								//echo"<pre>";print_r($value);echo"</pre>";//exit;
								$field = "";
								$set_field_name = "<input type='text' class='form-control required' required='required' name='userform[field_".$count."][title]' value='".$value->title."' placeholder='Field Name'>";
								$required = (!empty($value->required)) ? "checked" : "";
								$hidden   = (!empty($value->hidden)) ? "checked" : "";
								$client_field_label = "Client Field Label";
								switch($value->fieldtype){
									case"text":
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Text Field</h4>";
										$field .= "							<div class='col-md-3'>";
										$field .= "								<div class='md-checkbox-list'>";
										$field .= "									<div class='md-checkbox pull-left'>";
										$field .= "										<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' class='md-check' ".$required.">";
										$field .= "										<label for='field_".$count."_required'> <span></span> ";
										$field .= "										<span class='check'></span> <span class='box'></span> Required</label>&nbsp;&nbsp;&nbsp;";
										$field .= "									</div>";
										$field .= "									<div class='md-checkbox pull-left'>";
										//$field .= "										<input type='checkbox' name='userform[field_".$count."][hidden]' value='1' id='field_".$count."_hidden' class='md-check' ".$hidden."> ";
										//$field .= "										<label for='field_".$count."_hidden'> <span class='inc'></span> ";
										//$field .= "										<span class='check'></span> <span class='box'></span> Hidden</label>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "							</div>";
										$field .= "							<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_". $count . "][fieldtype]' value='" . $value->fieldtype . "'>";
										$field .= "							</div>";
										$field .= "						</div>";
										break;
									
									case "hidden" :
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Hidden Field</h4>";
										$field .= "							<div class='col-md-3'>";
										$field .= "								<div class='md-checkbox-list'>";
										$field .= "									<div class='md-checkbox pull-left'>";
										$field .= "									</div>";
										$field .= "									<div class='md-checkbox pull-left'>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "							</div>";
										$field .= "							<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_". $count . "][fieldtype]' value='" . $value->fieldtype . "'>";
										$field .= "							</div>";
										$field .= "						</div>";
										break;
										
									 case"radio":
										$field .= "	<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Radio Group</h4>";
										$field .= "								<div class='col-md-3'>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= "										<div class='md-checkbox pull-left '>";
										$field .= "											<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' ".$required." class='md-check'> <label for='field_".$count."_required' > <span></span>";
										$field .= "												<span class='check'></span> <span class='box'></span>";
										$field .= "												Required";
										$field .= "											</label>&nbsp;&nbsp;&nbsp;";
										$field .= "										</div>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= $selectbox;
										$field .= "									</div>";										
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "								<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "								</div>";
										$field .= "								<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
										$field .= "									<div id='field_".$count."_option_container'>";
										//Add options
										$rcount = 1;
										
										$radiochecked = (isset($value->value->checked) && strlen($value->value->checked) > 0) ? $value->value->checked : 123; 
										
										//Define field type
										foreach ($value->value->values as $rkey=>$rvalue){
										$checked = ($rkey==$radiochecked) ? "checked" : '';
										if($rcount > 1)
										{
											$field .= "<div class='form-group form-md-radios border-none' id='form-radios-".$count."-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'><div class='md-radio pull-left mrleftn17'> <input type='radio' id='field_".$count."_radio_".$rkey."' name='userform[field_".$count."][value][checked]' value='".$rkey."' class='md-radiobtn' ".$checked."> <label for='field_".$count."_radio_".$rkey."'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."	</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'><a href=\"javascript:;\" class=\"btn btn-icon-only purple\" onclick=\"remove_field('form-radios-$count-$rcount');\"><i class=\"fa fa-times\"></i></a></div>	</div></div>";
										}
										else
										{
											$field .= "<div class='form-group form-md-radios border-none' id='form-md-radios-".$count."-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'><div class='md-radio pull-left mrleftn17'> <input type='radio' id='field_".$count."_radio_".$rkey."' name='userform[field_".$count."][value][checked]' value='".$rkey."' class='md-radiobtn' ".$checked."> <label for='field_".$count."_radio_".$rkey."'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."	</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'>	</div>	</div></div>";
										}
										//$field .= "<div class='form-group form-md-radios border-none' id='form-md-radios-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'><div class='md-radio pull-left mrleftn17'> <input type='radio' id='field_".$rcount."_radio' name='userform[field_".$count."][value][checked]' value='0' class='md-radiobtn' ".$checked."> <label for='field_".$rcount."_radio'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."	</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'>	</div>	</div></div>";
										$rcount++;}
										
										$field .= "</div>";
										$field .= "<a href='javascript:;' class='btn green btn-xs' onclick=\"return add_field_options('".$count."','radios',0);\"><i class='fa fa-plus'></i></a>";
										$field .= "</div>";
										$field .= "<div class='col-md-1'>";
										$field .= "<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "<input type='hidden' name='userform[field_".$count."][fieldtype]' value='".$value->fieldtype."'>";
										$field .= "</div>";
										$field .= "</div>";
										break;
										
									case"selectbox":
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Select List</h4>";
										$field .= "								<div class='col-md-3'>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= "										<div class='md-checkbox pull-left '>";
										$field .= "											<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' class='md-check'  ".$required."> <label for='field_".$count."_required'> <span></span>";
										$field .= "												<span class='check'></span> <span class='box'></span>";
										$field .= "												Required";
										$field .= "											</label>&nbsp;&nbsp;&nbsp;";
										$field .= "										</div>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "								<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "								</div>";
										$field .= "								<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
										$field .= "<div id='field_".$count."_option_container'>";
										//	Add options
										$rcount = 1;
										
										$check_selected = (isset($value->value->checked)) ? $value->value->checked : 123; 
										foreach ($value->value->values as $rkey=>$rvalue){
										$checked = ($rkey==$check_selected) ? "checked" : '';
										if($rcount > 1)
										{
											$field .= "<div class='form-group form-md-radios border-none' id='form-selectbox-".$count."-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'><div class='md-radio pull-left mrleftn17'> <input type='radio' id='field_".$count."_radio_".$rcount."' name='userform[field_".$count."][value][checked]' value='0' class='md-radiobtn' ".$checked."> <label for='field_".$count."_radio_".$rcount."'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."	</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'><a href=\"javascript:;\" class=\"btn btn-icon-only purple\" onclick=\"remove_field('form-selectbox-".$count."-".$rcount."');\"><i class=\"fa fa-times\"></i></a>	</div>	</div></div>";
										}
										else
										{
											$field .= "<div class='form-group form-md-radios border-none' id='form-selectbox-".$count."-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'><div class='md-radio pull-left mrleftn17'> <input type='radio' id='field_".$count."_radio_".$rcount."' name='userform[field_".$count."][value][checked]' value='0' class='md-radiobtn' ".$checked."> <label for='field_".$count."_radio_".$rcount."'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."	</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'>	</div>	</div></div>";
										}
										
										$rcount++;}
										
										$field .= "</div>";
										$field .= "									<a href='javascript:;' class='btn green btn-xs' onclick=\"return add_field_options('".$count."','selectbox',0);\"><i class='fa fa-plus'></i></a>";
										$field .= "								</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_".$count."][fieldtype]' value='".$value->fieldtype."'>";
										$field .= "							</div>";
										$field .= "							</div>";
										break;
										
									case"checkbox":
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Checkbox Group</h4>";
										$field .= "								<div class='col-md-3'>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= "										<div class='md-checkbox pull-left '>";
										$field .= "											<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' class='md-check'  ".$required."> <label for='field_".$count."_required' > <span></span>";
										$field .= "												<span class='check'></span> <span class='box'></span>";
										$field .= "												Required";
										$field .= "											</label>&nbsp;&nbsp;&nbsp;";
										$field .= "										</div>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "								<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "								</div>";
										$field .= "								<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
										$field .= "									<div id='field_".$count."_option_container'>";
										//	Add options
										$rcount = 1;
										
										$check_checked = (isset($value->value->checked)) ? $value->value->checked : array();
										foreach ($value->value->values as $rkey=>$rvalue){
										$checked = (in_array($rkey,$check_checked)) ? "checked" : '';
										
										if($rcount>1)
										{
											$field .= "<div class='form-group form-md-radios border-none' id='form-checkbox-".$count."-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'>	<div class='md-checkbox pull-left mrleftn17'>	<input type='checkbox' id='field_".$count."_radio_".$rcount."' name='userform[field_".$count."][value][checked][]' value='".$rkey."' $checked class='md-check'> <label for='field_".$count."_radio_".$rcount."'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'><a href=\"javascript:;\" class=\"btn btn-icon-only purple\" onclick=\"remove_field('form-checkbox-".$count."-".$rcount."');\"><i class=\"fa fa-times\"></i></a>	</div>	</div></div>";
										}
										else 
										{
											$field .= "<div class='form-group form-md-radios border-none' id='form-md-checkbox-".$count."-".$rcount."'>	<div class='md-radio-inline border-none'>	<div class='col-md-3'>	<div class='md-checkbox pull-left mrleftn17'>	<input type='checkbox' id='field_".$count."_radio_".$rcount."' name='userform[field_".$count."][value][checked][]' value='".$rkey."'  $checked class='md-check'> <label for='field_".$count."_radio_".$rcount."'> <span></span>	<span class='check'></span> <span class='box'></span>Option ".$rcount."</label></div></div><div class='col-md-6'><input type='text' class='form-control' name='userform[field_".$count."][value][values][]' value='".$rvalue."' placeholder='Field Value'>	</div>	<div class='col-md-3'>	</div>	</div></div>";
										}										
										
										$rcount++;}
										
										$field .= "									</div>";
										$field .= "									<a href='javascript:;' class='btn green btn-xs' onclick=\"return add_field_options('".$count."','checkbox');\"><i class='fa fa-plus'></i></a>";
										$field .= "								</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_".$count."][fieldtype]' value='".$value->fieldtype."'>";
										$field .= "							</div>";
										$field .= "							</div>";
										break;
										
									case"textarea":
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Paragraph Field</h4>";
										$field .= "							<div class='col-md-3'>";
										$field .= "								<div class='md-checkbox-list'>";
										$field .= "									<div class='md-checkbox pull-left'>";
										$field .= "										<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' class='md-check' ".$required.">";
										$field .= "										<label for='field_".$count."_required'> <span></span> ";
										$field .= "										<span class='check'></span> <span class='box'></span> Required</label>&nbsp;&nbsp;&nbsp;";
										$field .= "									</div>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "							</div>";
										$field .= "							<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_".$count."][fieldtype]' value='".$value->fieldtype."'>";
										$field .= "							</div>";
										$field .= "						</div>";
										break;	 		
                                        
                                        case"date-selector":
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>Date Selector(Dropdown)</h4>";
										$field .= "							<div class='col-md-3'>";
										$field .= "								<div class='md-checkbox-list'>";
										$field .= "									<div class='md-checkbox pull-left'>";
										$field .= "										<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' class='md-check' ".$required.">";
										$field .= "										<label for='field_".$count."_required'> <span></span> ";
										$field .= "										<span class='check'></span> <span class='box'></span> Required</label>&nbsp;&nbsp;&nbsp;";
										$field .= "									</div>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "							</div>";
										$field .= "							<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
                                        $field .= "                       Client Date Format   <select name='userform[field_".$count."][date_format]'><option value='d-m-Y' ".($value->date_format == 'd-m-Y' ? 'selected' : '' )." >d-m-Y</option><option value='m/d/Y' ".($value->date_format == 'm/d/Y' ? 'selected' : '' ).">m/d/Y</option><option value='Y-m-d' ".($value->date_format == 'Y-m-d' ? 'selected' : '' ).">Y-m-d</option></select>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_".$count."][fieldtype]' value='".$value->fieldtype."'>";
										$field .= "							</div>";
										$field .= "						</div>";
										break;	 

										case "datepicker_box":
										$field .= "<div class='form-group' id='field_".$count."'>";
										$field .= "							<h4 class='block'>DatePicker Field</h4>";
										$field .= "							<div class='col-md-3'>";
										$field .= "								<div class='md-checkbox-list'>";
										$field .= "									<div class='md-checkbox pull-left'>";
										$field .= "										<input type='checkbox' id='field_".$count."_required' name='userform[field_".$count."][required]' value='1' class='md-check' ".$required.">";
										$field .= "										<label for='field_".$count."_required'> <span></span> ";
										$field .= "										<span class='check'></span> <span class='box'></span> Required</label>&nbsp;&nbsp;&nbsp;";
										$field .= "									</div>";
										$field .= "									<div class='md-checkbox-list'>";
										$field .= $selectbox;
										$field .= "									</div>";
										$field .= "								</div>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-3'>";
										$field .= $set_field_name;
										$field .= "							</div>";
										$field .= "							<div class='col-md-5'>";
										$field .= "								<input type='text' class='form-control' name='userform[field_".$count."][label]' value='".$value->label."' placeholder='".$client_field_label."'>";
                                        $field .= "                       Client Date Format   <select name='userform[field_".$count."][date_format]'><option value='dd-mm-yyyy' ".($value->date_format == 'dd-mm-yyyy' ? 'selected' : '' )." >d-m-Y</option><option value='mm/dd/yyyy' ".($value->date_format == 'mm/dd/yyyy' ? 'selected' : '' ).">m/d/Y</option><option value='yyyy-mm-dd' ".($value->date_format == 'yyyy-mm-dd' ? 'selected' : '' ).">Y-m-d</option></select>";
										$field .= "							</div>";
										$field .= "							<div class='col-md-1'>";
										$field .= "								<a href='javascript:;' class='btn btn-icon-only red remove-field'";
										$field .= "									onclick=\"remove_field('field_".$count."');\"><i class='fa fa-times'></i></a>";
										$field .= "								<input type='hidden' name='userform[field_".$count."][fieldtype]' value='".$value->fieldtype."'>";
										$field .= "							</div>";
										$field .= "						</div>";
										break;	 			
                                        
                                        
								}
								echo $field;
								$count++;
							} 
							
							}?>
						</div>
						<!--END USER FORM -->
					</div>
				</div>
			</div>
		</div>
		<!-- OFFER FORM CONTENT*/ -->
		<div class="form-actions">
			<button type="submit" class="btn blue">Submit</button>
			<button type="button" class="btn default">Cancel</button>
			<button type="button" data-href="<?php echo base_url(); ?>offer/testOffer<?php if(!empty($result->id)) { echo "/".$result->id; }?>" id="run_test" class="btn default" >Run Test</button>
		</div>
	</div>
</form>
<!-- */ FORM ENDs -->

<script type="text/javascript">
	var offer_id =  '<?php if(!empty($result->id)) { echo $result->id;}?>' ;
    document.getElementById('breadcrumb').innerHTML += '<li><a href="<?php echo base_url(); ?>offer/list_offers">Offer List</a></li>';
</script>