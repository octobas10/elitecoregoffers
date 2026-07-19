<!-- BEGIN PAGE CONTENT -->
<div class="page-content">
	<div class="container">
		<!-- BEGIN PAGE CONTENT INNER -->
		<div class="row">
				<div class="col-md-3">
					<!-- BEGIN TODO SIDEBAR -->
					<div class="todo-sidebar">
						<div class="portlet light">
							<div class="portlet-title">
								<div class="caption" data-toggle="collapse" data-target=".todo-project-list-content">
									<span class="caption-subject font-green-sharp bold uppercase">INDEX </span>									
								</div>
							</div>
							<div class="portlet-body todo-project-list-content" style="height: auto;">
								<div class="todo-project-list">
									<ul class="nav nav-pills nav-stacked">
										<li>
											<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1"><i class="fa fa-hand-o-right"></i> ADD OFFER TO PAGE </a>
										</li>
										<li>
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2"><i class="fa fa-hand-o-right"></i> MANAGE CSS</a>
										</li>
										<li>
											<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3"><i class="fa fa-hand-o-right"></i> PRE-POP FIELDS</a>
										</li>										
									</ul>
								</div>
							</div>
						</div>
					</div>
					<!-- END TODO SIDEBAR -->					
				</div>
				
				<!-- BEGIN TODO CONTENT -->
				<div class="col-md-9">
					<!-- BEGIN ACCORDION PORTLET-->
					<div class="portlet light">
						<div class="portlet-title">
							<div class="caption">
								<i class="fa fa-cogs font-green-sharp"></i>
								<span class="caption-subject font-green-sharp bold uppercase">Instructions</span>
							</div>							
						</div>
						<div class="portlet-body">
							<div class="panel-group accordion" id="accordion3">
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_1">
										How to add offer to page ? </a>
										</h4>
									</div>
									<div id="collapse_3_1" class="panel-collapse in">
										<div class="panel-body">
											<p>
												 Add following code to your page where you want to display page.<br/><br/>
												<code>
												<?php 
												$code = htmlentities('<?php')."<br/>";
                                                $code .= htmlentities('$curl_session  = curl_init();')."<br/>";   
                                                $code .= htmlentities('curl_setopt($curl_session, CURLOPT_URL, "http://elitecoregoffers.com/Remote_content/getMysiteKey");')."<br/>"; 
                                                $code .= htmlentities('curl_setopt($curl_session, CURLOPT_RETURNTRANSFER, true);')."<br/>"; 
                                                $code .= htmlentities('curl_setopt($curl_session, CURLOPT_HEADER, false);')."<br/>"; 
                                                $code .= htmlentities('curl_setopt($curl_session, CURLOPT_POSTFIELDS,"request_data=".json_encode($_REQUEST));')."<br/>"; 
                                                $code .= htmlentities('$response = curl_exec($curl_session);')."<br/>"; 
                                                $code .= htmlentities('curl_close($curl_session);')."<br/>"; 
                                                $code .= htmlentities('echo "<script type=\'text/javascript\'>var s_user_session_key = \'$response\';</script>";')."<br/>";
                                                $code .= htmlentities('?> ')."<br/>";
                                                echo $code;
                                                echo '<br/><br/>';
												
												$a = htmlentities("<script type=\"text/javascript\">")."<br/>";
												$a .= htmlentities("var so_affiliate_id = AFFILIATE_ID;")."<br/>";
												$a .= htmlentities("var so_site_id = SITE_ID;")."<br/>";
												$a .= htmlentities("var so_redirect_url = \"REDIRECT_URL\";")."<br/>";
												$a .= htmlentities("</script>")."<br/>";												
												$a .= htmlentities("<script src=\"".base_url()."assets/offers.js\" type=\"text/javascript\"> </script>");
												echo $a ;
												?>
												</code>
											</p>
											<p>AFFILIATE_ID - Provided by '<?php echo SITE_TITLE;?>' provided by administrator</p>
											<p>SITE_ID - Provided by '<?php echo SITE_TITLE;?>' provided by administrator</p>
											<p>REDIRECT_URL - Enter url where you want to redirect after offer submit. Like, http://yourdomain.com</p>
																						
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_2">
										How to add custom css to offer ? </a>
										</h4>
									</div>
									<div id="collapse_3_2" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Use following JAVASCRIPT variables to change look and feel of offer page.</p>
											
											<p><i class="fa fa-minus"></i> so_main_bg_color </p>
											<p><i class="fa fa-minus"></i> so_main_bg_width  </p>
											<p><i class="fa fa-minus"></i> so_image_width  </p>
											<p><i class="fa fa-minus"></i> so_content_width  </p>
											<p><i class="fa fa-minus"></i> so_text_color  </p>
											<p><i class="fa fa-minus"></i> so_inputtext_color </p>
											<p><i class="fa fa-minus"></i> so_font_size </p>
											<p><i class="fa fa-minus"></i> so_font_family </p>
											<p><i class="fa fa-minus"></i> so_color_border </p>
											<p><i class="fa fa-minus"></i> so_error_bg_color </p>
											<p><i class="fa fa-minus"></i> so_error_txt_color </p>
											<p><i class="fa fa-minus"></i> so_page_number </p>
											<p><i class="fa fa-minus"></i> so_offer_seperator_color </p>
											<p><i class="fa fa-minus"></i> so_text_align </p>	
											<p>For Example,</p>
											<code>
											<?php 
												$a = htmlentities("<script type=\"text/javascript\">")."<br/>";
												$a .= htmlentities("var so_main_bg_color = '#EFF3F8';")."<br/>";
												$a .= htmlentities("</script>")."<br/>";
												echo $a;												
											?>
											</code>																						
										</div>
									</div>
								</div>
								<div class="panel panel-default">
									<div class="panel-heading">
										<h4 class="panel-title">
										<a class="accordion-toggle accordion-toggle-styled collapsed" data-toggle="collapse" data-parent="#accordion3" href="#collapse_3_3">
										How to pre-pop field ? </a>
										</h4>
									</div>
									<div id="collapse_3_3" class="panel-collapse collapse">
										<div class="panel-body">
											<p>Following are JAVASCRIPT variable with help of this you can pre-pop field value:</p>
											<p>
												<p><i class="fa fa-minus"></i> so_first_name </p>
												<p><i class="fa fa-minus"></i> so_last_name </p>
												<p><i class="fa fa-minus"></i> so_email </p>
												<p><i class="fa fa-minus"></i> so_dob </p>
												<p><i class="fa fa-minus"></i> so_homephone </p>
												<p><i class="fa fa-minus"></i> so_workphone </p>
												<p><i class="fa fa-minus"></i> so_mobilephone </p>
												<p><i class="fa fa-minus"></i> so_address </p>
												<p><i class="fa fa-minus"></i> so_city </p>
												<p><i class="fa fa-minus"></i> so_state </p>
												<p><i class="fa fa-minus"></i> so_zipcode </p>												
												<p><i class="fa fa-minus"></i> so_gender </p>
												<p><i class="fa fa-minus"></i> so_country </p>
												<p><i class="fa fa-minus"></i> so_ip </p>
												<p><i class="fa fa-minus"></i> so_date </p>												
											</p>
											<p>For Example,</p>
											<code>
											<?php 
												$a = htmlentities("<script type=\"text/javascript\">")."<br/>";
												$a .= htmlentities("var so_first_name = 'FIRST_NAME';")."<br/>";
												$a .= htmlentities("</script>")."<br/>";
												echo $a;												
											?>
											</code>
										</div>
									</div>
								</div>								
							</div>
						</div>
					</div>
					<!-- END ACCORDION PORTLET-->
				</div>
				<!-- END TODO CONTENT -->
			</div>
			<!-- END PAGE CONTENT INNER -->
	</div>
</div>
<!-- END PAGE CONTENT -->
