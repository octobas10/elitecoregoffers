var current_display_offers = new Array();
function add_offer_to_page(){
	var htmlform = "<div id='so_loader'><h3>Loading best offers for you... <img src='<?php echo base_url();?>assets/global/img/so_loader.GIF'/></h3></div>";
	htmlform += "<link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'/>";
	htmlform += "<script src='https://code.jquery.com/jquery-1.10.2.js' type='text/javascript'></script>";
	htmlform += "<script type='text/javascript' src='<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>";
	<?php 
	$s_passed_parameter = '';
	if(isset($t_temp_array) && !empty($t_temp_array)){
		$s_passed_parameter = '?'.http_build_query($t_temp_array);
	}
    ?>
	htmlform     += "<form novalidate action='<?php echo base_url();?>offer/offer_data_submit<?php echo $s_passed_parameter;?>' method='post' name='offer_form' id='offer_form' onsubmit='return validate();'>";
	htmlform     += "<div border='0' id='smart_offer' cellspacing='10'style='display: inline-block;background-color:<?php echo $so_main_bg_color;?>;color:<?php echo $so_text_color;?> '>";
	htmlform     += "<div>";
	htmlform     += "<style>.submit_button{  display: block; margin: auto; width: 80px; height: 30px; border-radius: 2px; border: 1px solid #000; }</style>";
	<?php if(!empty($list_offer) && count($list_offer)>0){ ?>
		<?php if($site_detail['display_offer_type']=="horizontal_display"){
			foreach ($list_offer as $offer) {
				$offer_id           = $offer['id'];
				$opt_in_selected    = 0 ;
				$opt_out_selected   = 0;
				$yesbutton_click_fn = "show_layer('smart_offer_form_".$offer_id."')";
				$make_offer_form    = 1;
                $t_script = preg_split('/\r\n|[\r\n]/', $offer['script']);
				if($offer['offer_options']=="opt_popout"){  
					$make_offer_form=0;
					$post_url = $offer['http_post_url'];
					$get_url = $offer['http_get_url'];
					$url = !empty($post_url) ? $post_url : $get_url;
					// LINK OUT CODE 
					if(!empty($offer['offer_form'])){
						$offer_form = json_decode($offer['offer_form']);
						foreach ($offer_form as $offer_field){
							$field_name   = ($offer_field->system_field =="other" || $offer_field->system_field =="fixed") ? $offer_field->title : $offer_field->system_field;
							if($offer_field->system_field =='fixed'){
								$value_of_the_field = $offer_field->label;
							}else if($offer_field->system_field =='other'){
								$value_of_the_field = (isset($t_posted_array[$offer_field->system_field.'_'.$offer_field->label]) ? $t_posted_array[$offer_field->system_field.'_'.$offer_field->label] : '' );	
							}else{	
								$value_of_the_field = (isset($t_posted_array[$field_name]) ? $t_posted_array[$field_name] : '' );
							}
							$linkout_keyword[] = '%'.$offer_field->label.'%';
							$linkout_values[] = $value_of_the_field;
						}
						$url = str_replace($linkout_keyword, $linkout_values, $url);
					}
					// LINK OUT CODE 
					$yesbutton_click_fn = "offer_popout(".$offer_id.",'".$url."','".$site_detail['id']."');"; 
				}else if($offer['offer_options']=="opt_in"){ //Check for opt in(Yes option for radio button selected or not)
					$opt_in_selected = 1;			
				}else if($offer['offer_options']=="opt_out"){ //Check for opt in(Yes option for radio button selected or not)
					$opt_out_selected = 1;
				}
				?>
				htmlform += "		<div id='smart_offer_<?php echo $offer_id;?>'  class='offer-row'>";
				htmlform += "			<div class='offer_wraper'>";
				htmlform += "				<div>";
				htmlform += "					<div>";
				htmlform += "						<label style='width:110px;'><input type='radio' name='smart_offer_status_<?php echo $offer_id;?>' value='yes' <?php if($opt_in_selected==1){ echo"checked"; } ?> onclick=\"<?php echo $yesbutton_click_fn;?>\">Yes&nbsp;<input type='radio' value='no'  <?php if($opt_out_selected==1){ echo"checked"; } ?>  name='smart_offer_status_<?php echo $offer_id;?>' onclick=\"hide_layer('smart_offer_form_<?php echo $offer_id;?>');\">No<\/label>";
				<?php if(!empty($offer['offer_image'])){?>
				htmlform += "						<label style=''><img src='<?php echo base_url();?>uploads\/<?php echo $offer['offer_image'];?>' style='width:<?php echo $so_image_width;?>;'\/><\/label>";
				<?php }?>
				htmlform += "						<label valign='top' style='width:<?php echo $so_content_width;?>;'><?php echo addslashes($offer['offer_content']);?><\/label>";
				htmlform += "					<\/div>";
				htmlform += "					<div>";
				htmlform += "						<div>";
				htmlform += "<div id='smart_offer_form_<?php echo $offer_id;?>' style='<?php if($opt_in_selected !=1){ echo "display: none;";} ?>'>";
				
				<?php if(!empty($offer['offer_form']) && $make_offer_form==1){ 
				$offer_form = json_decode($offer['offer_form']);
				$pocount=0;
				foreach ($offer_form as $offer_field){
					//Set field name
					$field_name   = ($offer_field->system_field =="other" || $offer_field->system_field =="fixed") ? $offer_field->title : $offer_field->system_field;   //[ fixed/other or system fields]
					$system_field =$offer_field->system_field;
					//Check for prepop value in field
					if(!empty($$system_field)){
				?>		
				htmlform += "<input type='hidden' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' value='<?php echo $$system_field;?>' >";
				<?php } else { 
							if($system_field == 'so_country'){
                                $o_country_details = json_decode(file_get_contents('http://country.io/names.json'));
                                ?>
                                htmlform += "<div class='date_fields'><label><?php echo ucfirst($offer_field->label);?></label><br><select name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>'  >";
                                htmlform += "<option value=''>Select Country</option>";
		                        <?php 
                                if(!empty($o_country_details)){
									if(!isset($t_posted_array[$field_name]) || empty($t_posted_array[$field_name])){
										  $t_posted_array[$field_name] = 'United States';										  
									}
                                      foreach ($o_country_details as $key => $value) {
                                              ?>
                                                htmlform += "<option value='<?php echo $value;?>' <?php echo (isset($t_posted_array[$field_name]) && (strtolower($t_posted_array[$field_name]) == strtolower($value))  ? 'selected' : '' ); ?> <?php if(isset($offer_field->value->checked) && $offer_field->value->checked==$key){echo"selected";}?> ><?php echo $value;?></option>";
                                                <?php
                                      }
                                  }
                                ?>
							     htmlform += "<\/select></div>";	
                                <?php
                                 continue;
                            }
							/** * @Since : 18/01/2017 (10:15)
                             * @Description : add ip address textbox in hidden field if ip address field is exist.
                             */  
							if($system_field =='so_ip'){?>
							   htmlform +='<input type="hidden" value="<?php echo $_SERVER['REMOTE_ADDR'] ;?>" name="so_ip">';
							   <?php continue;
							}
							if($system_field =='fixed'){
								$value_of_the_field = $offer_field->label;		
								$fieldtype = $system_field; //which is "fixed" in this case
							}else if($system_field =='other'){
								$value_of_the_field = (isset($t_posted_array[$offer_field->system_field.'_'.$offer_field->label]) ? $t_posted_array[$offer_field->system_field.'_'.$offer_field->label] : '' );	
								$fieldtype = $system_field; //which is "fixed" in this case
							}else{	
								$value_of_the_field = (isset($t_posted_array[$field_name]) ? $t_posted_array[$field_name] : '' );
								$fieldtype = $field_name;
							}
							
							if($offer_field->fieldtype=='text'){?>
							htmlform += "<div><input name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' fieldtype='<?php echo $fieldtype;?>' placeholder='<?php echo ucfirst($offer_field->label);?>' type='text' value='<?php echo $value_of_the_field; ?>' class='<?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;?> coreg_fields'></div>";
                            <?php } else if($offer_field->fieldtype=='date-selector'){?>
                            htmlform += "<div>";
                                    htmlform += "<input type='hidden' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][format]' value='<?php echo $offer_field -> date_format; ?>' />";
                                    htmlform+= "<div class='date_fields' style='display: inline-block;'> Date :  <select class='coreg_fields' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][date]' <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> ><option value=''>Select Date</option>";
                                        <?php
                                            for($i_date=1;$i_date<=31;$i_date++){
                                                 ?> 
                                                    htmlform+= "<option value='<?php echo $i_date; ?>' <?php echo (isset($t_posted_array['dob_day']) && ($t_posted_array['dob_day'] == $i_date) ? 'selected' : '' ); ?> ><?php echo $i_date; ?></option>";
                                                <?php
                                            } ?>
                                    htmlform+= "</select></div>";
                                    htmlform+= "<div class='date_fields' style='display: inline-block;' > Month :  <select class='coreg_fields' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][month]' <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> ><option value=''>Select Month</option>";
                                        <?php
                                            for($i_month=1;$i_month<=12;$i_month++){
                                                 ?> 
                                                    htmlform+= "<option value='<?php echo $i_month; ?>' <?php echo (isset($t_posted_array['dob_month']) && ($t_posted_array['dob_month'] == $i_month) ? 'selected' : '' ); ?> ><?php echo date("F", mktime(0, 0, 0, $i_month, 10)); ?></option>";
                                                <?php
                                            } ?>
                                    htmlform+= "</select></div>";
                                    htmlform+= "<div class='date_fields' style='display: inline-block;' > Year :  <select class='coreg_fields' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][year]' <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> ><option value=''>Select Year</option>";
                                        <?php
                                            for($i_year=(date('Y')-18);$i_year>=((date('Y')-18)-80);$i_year--){
                                                 ?> 
                                                    htmlform+= "<option value='<?php echo $i_year; ?>' <?php echo (isset($t_posted_array['dob_year']) && ($t_posted_array['dob_year'] == $i_year) ? 'selected' : '' ); ?> ><?php echo $i_year; ?></option>";
                                                <?php
                                            } ?>
                                    htmlform+= "</select></div>";
                                    htmlform +="</div>";
							<?php }else if($offer_field->fieldtype=='date-picker-box'){ ?>
                                                htmlform += "<div><input  placeholder='<?php echo ucfirst(str_replace('_',' ',$offer_field->label));?>' fieldtype='<?php echo $field_name;?>' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' type='text' value='<?php echo (isset($t_posted_array[$field_name]) && !empty($t_posted_array[$field_name]) ? date('d-m-Y',strtotime(str_replace('/','-',$t_posted_array[$field_name]))) : '' ); ?>' readonly date-format='<?php echo $offer_field->date_format;?>' class='coreg_fields date-picker <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;?>'></div>";
							<?php } else if($offer_field->fieldtype=='radio'){?>
							htmlform += "<div><label><?php echo ucfirst($offer_field->label);?></label><br/>";
								<?php foreach ($offer_field->value->values as $key=>$radios) {?>
								htmlform += "<input name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' type='radio' value='<?php echo $radios;?>' <?php echo (isset($t_posted_array[$field_name]) && ($t_posted_array[$field_name] == $radios)  ? 'checked' : '' ); ?> class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' <?php if(!isset($t_posted_array[$field_name]) && isset($offer_field->value->checked) && $offer_field->value->checked==$key){echo"checked";}?>><?php echo $radios;?><\/br>";
								<?php }?>
							htmlform += "</div>";
							<?php } else if($offer_field->fieldtype=='selectbox'){?>
							htmlform += "<div><select name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>'><option value=''>--Select <?php echo str_replace('_',' ',ucfirst($offer_field->label))?>--<\/option>";
								<?php 
								$rcount = 0;
								foreach ($offer_field->value->values as $key=>$select) {
								$key_option = isset($offer_field->value->keys[$rcount])? $offer_field->value->keys[$rcount] : $select;	
								?>
								htmlform += "<option value='<?php echo $key_option;?>' <?php echo (isset($t_posted_array[$field_name]) && ($t_posted_array[$field_name] == $select)  ? 'selected' : '' ); ?> <?php if(isset($offer_field->value->checked) && $offer_field->value->checked==$key){echo"selected";}?>><?php echo $select;?><\/option>";
								<?php 
								$rcount++;	
								}?>
							htmlform += "<\/select></div>";			
							<?php } else if($offer_field->fieldtype=='checkbox'){?>
							htmlform += "<div><label><?php echo ucfirst(str_replace('_',' ',$offer_field->label));?></label><br>";
								<?php foreach ($offer_field->value->values as $key=>$check) {?>
								htmlform += "<input name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][]' type='checkbox' value='<?php echo $check;?>' <?php echo (isset($t_posted_array[$field_name]) && ($t_posted_array[$field_name] == $check)  ? 'checked' : '' ); ?> class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' <?php if(isset($offer_field->value->checked) && in_array($key, $offer_field->value->checked)){echo"checked";}?>><?php echo $check;?><\/br>";
								<?php }?>
							htmlform += "</div>";
							<?php } else if($offer_field->fieldtype=='textarea'){?>
							htmlform += "<div>";
							htmlform += "<textarea name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' placeholder='<?php echo ucfirst(str_replace('_',' ',$offer_field->label));?>' class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' ><?php echo (isset($t_posted_array[$field_name]) ? $t_posted_array[$field_name] : $offer_field->label ); ?><\/textarea>";
							htmlform += "</div>";
							<?php } else if($offer_field->fieldtype=='hidden'){ ?>
							htmlform += "<input id='<?php echo $field_name;?>' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' type='hidden' value='<?php echo $offer_field->label;?>'>";
							<?php }?>
						<?php }?>
				<?php } }?>
				htmlform += "							<\/div>";
				htmlform += "						<\/div>";
				htmlform += "					<\/div>";
				htmlform += "				<\/div>";
				htmlform += "			<\/div>			";
				htmlform += "		<\/div>";
		current_display_offers.push(<?php echo $offer_id;?>);		
		<?php } ?>
		<?php } else if($site_detail['display_offer_type']=="vertical_display"){
		foreach ($list_offer as $offer) {
			$offer_id = $offer['id'];$make_offer_form    = 1;$opt_in_selected    = 0 ;$opt_out_selected   = 0;
            $t_script = preg_split('/\r\n|[\r\n]/', $offer['script']);
            $yesbutton_click_fn = "show_layer('smart_offer_form_".$offer_id."')";
			if($offer['offer_options']=="opt_popout"){
				$make_offer_form    = 0;
				$offer_form = json_decode($offer['offer_form']);
				$post_url = $offer['http_post_url'];
				$get_url = $offer['http_get_url'];
				$url = !empty($post_url) ? $post_url : $get_url;
				// LINK OUT CODE 
				if(!empty($offer['offer_form'])){
					$offer_form = json_decode($offer['offer_form']);
					
					foreach ($offer_form as $offer_field){
						$field_name   = ($offer_field->system_field =="other" || $offer_field->system_field =="fixed") ? $offer_field->title : $offer_field->system_field;
						if($offer_field->system_field =='fixed'){
							$value_of_the_field = $offer_field->label;
						}else if($offer_field->system_field =='other'){
							$value_of_the_field = (isset($t_posted_array[$offer_field->system_field.'_'.$offer_field->label]) ? $t_posted_array[$offer_field->system_field.'_'.$offer_field->label] : '' );	
						}else{	
							$value_of_the_field = (isset($t_posted_array[$field_name]) ? $t_posted_array[$field_name] : '' );
						}
						$linkout_keyword[] = '%'.$offer_field->label.'%';
						$linkout_values[] = $value_of_the_field;
					}
					$url = str_replace($linkout_keyword, $linkout_values, $url);
				}
				// LINK OUT CODE 
				$yesbutton_click_fn = "offer_popout(".$offer_id.",'".$url."','".$site_detail['id']."');";
			}else if($offer['offer_options']=="opt_in"){ //Check for opt in(Yes option for radio button selected or not)
                $opt_in_selected = 1;			
            }else if($offer['offer_options']=="opt_out"){ //Check for opt in(Yes option for radio button selected or not)
                $opt_out_selected = 1;
            }
			//else
			//{ $yesbutton_click_fn = "show_layer('smart_offer_form_".$offer_id."')"; }
			?>
			htmlform += "<div id='smart_offer_<?php echo $offer_id;?>'  style='background-color:'>"; 
			htmlform += "<div class='offer_wraper'>";
			htmlform += "<div>";		
			htmlform += "<div style=''><img src='<?php echo base_url();?>uploads\/<?php echo $offer['offer_image'];?>' style='width:<?php echo $so_image_width;?>;'\/></div>";
			htmlform += "<div style='text-align:center'><input type='radio' name='smart_offer_status_<?php echo $offer_id;;?>' value='yes' <?php if($opt_in_selected==1){ echo"checked"; } ?> onclick=\"<?php echo $yesbutton_click_fn;?>\">Yes&nbsp;<input type='radio' value='no' <?php if($opt_out_selected==1){ echo"checked"; } ?>   name='smart_offer_status_<?php echo $offer_id;;?>' onclick=\"hide_layer('smart_offer_form_<?php echo $offer_id;;?>');\">No</div>";
			htmlform += "<div style='width:<?php echo $so_content_width;?>;'><?php echo addslashes($offer['offer_content']);?></div>";
			htmlform += "<div id='smart_offer_form_<?php echo $offer_id;?>' style='<?php if($opt_in_selected !=1){ echo "display: none;";} ?>'>";
			
			<?php if(!empty($offer['offer_form']) && $make_offer_form==1){ 
			$offer_form = json_decode($offer['offer_form']);
			$pocount=0;
			foreach ($offer_form as $offer_field){
				$field_name   = ($offer_field->system_field =="other" || $offer_field->system_field =="fixed") ? $offer_field->title : $offer_field->system_field;   //[ fixed/other or system fields]
				$system_field = $offer_field->system_field;
				//Check for prepop value in field
				if(!empty($$system_field)){ ?>		
					htmlform += "<input type='hidden' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' value='<?php echo $$system_field;?>' >";
				<?php }else{
						if($system_field == 'so_country'){
                                $o_country_details = json_decode(file_get_contents('http://country.io/names.json'));
                                ?>
                                htmlform += "<div class='date_fields'><label><?php echo ucfirst($offer_field->label);?></label><br><select name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>'  >";
                                htmlform += "<option value=''>Select Country</option>";
		                        <?php 
                                if(!empty($o_country_details)){
									if(!isset($t_posted_array[$field_name]) || empty($t_posted_array[$field_name])){
										  $t_posted_array[$field_name] = 'United States';										  
									}
									foreach ($o_country_details as $key => $value) {?>
                                        htmlform += "<option value='<?php echo $value;?>' <?php echo (isset($t_posted_array[$field_name]) && (strtolower($t_posted_array[$field_name]) == strtolower($value))  ? 'selected' : '' ); ?> <?php if(isset($offer_field->value->checked) && $offer_field->value->checked==$key){echo"selected";}?> ><?php echo $value;?></option>";
                                    <?php
									}
                                  }
                                ?>
							    htmlform += "<\/select></div>";	
                                <?php
                                 continue;
                            } 
						if($system_field =='so_ip'){?>
							htmlform +='<input type="text" value="<?php echo $_SERVER['REMOTE_ADDR'] ;?>" name="so_ip">';
							<?php continue;
						}else if($system_field =='fixed'){
							$value_of_the_field = $offer_field->label;
							$fieldtype = $system_field; //which is "fixed" in this case
						}else if($system_field =='other'){
							$value_of_the_field = (isset($t_posted_array[$offer_field->system_field.'_'.$offer_field->label]) ? $t_posted_array[$offer_field->system_field.'_'.$offer_field->label] : '' );	
							$fieldtype = $system_field; //which is "other" in this case
						}else{	
							$value_of_the_field = (isset($t_posted_array[$field_name]) ? $t_posted_array[$field_name] : '' );
							$fieldtype = $field_name;
						}?>
						
						
						
						<?php if($offer_field->fieldtype=='text'){?>
							htmlform += "<div><input name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' fieldtype='<?php echo $fieldtype;?>' placeholder='<?php echo ucfirst(str_replace('_',' ',$offer_field->label));?>' type='text' value='<?php echo $value_of_the_field;?>' class='<?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;?> coreg_fields'></div>";

                        <?php }else if($offer_field->fieldtype=='date-selector'){ ?>
                                    htmlform += "<div>";
                                    htmlform += "<input type='hidden' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][format]' value='<?php echo $offer_field -> date_format; ?>' />";
                                    htmlform+= "<div class='date_fields' style='display: inline-block;'> Date :  <select class='coreg_fields' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][date]' <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> ><option value=''>Select Day</option>";
                                        <?php
                                            for($i_date=1;$i_date<=31;$i_date++){
                                                 ?> 
                                                    htmlform+= "<option value='<?php echo $i_date; ?>' <?php echo (isset($t_posted_array['dob_day']) && ($t_posted_array['dob_day'] == $i_date) ? 'selected' : '' ); ?> ><?php echo $i_date; ?></option>";
                                                <?php
                                            } ?>
                                    htmlform+= "</select></div>";
                                    htmlform+= "<div class='date_fields' style='display: inline-block;'> Month :  <select class='coreg_fields' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][month]' <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> ><option value=''>Select Month</option>";
                                        <?php
                                            for($i_month=1;$i_month<=12;$i_month++){
                                                 ?> 
                                                    htmlform+= "<option value='<?php echo $i_month; ?>' <?php echo (isset($t_posted_array['dob_month']) && ($t_posted_array['dob_month'] == $i_month) ? 'selected' : '' ); ?> ><?php echo date("F", mktime(0, 0, 0, $i_month, 10)); ?></option>";
                                                <?php
                                            } ?>
                                    htmlform+= "</select></div>";
                                    htmlform+= "<div class='date_fields' style='display: inline-block;'> Year :  <select class='coreg_fields' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>][year]' <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> ><option value=''>Select Year</option>";
                                        <?php
                                            for($i_year=(date('Y')-18);$i_year>=((date('Y')-18)-80);$i_year--){
                                                 ?> 
                                                    htmlform+= "<option value='<?php echo $i_year; ?>' <?php echo (isset($t_posted_array['dob_year']) && ($t_posted_array['dob_year'] == $i_year) ? 'selected' : '' ); ?> ><?php echo $i_year; ?></option>";
                                                <?php
                                            } ?>
                                    htmlform+= "</select></div>";
                                    htmlform +="</div>";
						<?php } else if($offer_field->fieldtype=='date-picker-box'){?>
							htmlform += "<div><input name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' fieldtype='<?php echo $field_name;?>' placeholder='<?php echo ucfirst(str_replace('_',' ',$offer_field->label));?>' type='text' value='' readonly  date-format='<?php echo $offer_field->date_format;?>' class='coreg_fields date-picker <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;?>'></div>";
						<?php } else if($offer_field->fieldtype=='radio'){?>
						htmlform += "<div><label><?php echo $offer_field->label;?></label><br>";
							<?php foreach ($offer_field->value->values as $key=>$radios) {?>
							htmlform += "<input name='offer_<?php echo $offer_id;;?>[<?php echo $field_name;?>]' type='radio' value='<?php echo $radios;?>' <?php echo (isset($t_posted_array[$field_name]) && ($t_posted_array[$field_name] == $radios)  ? 'checked' : '' ); ?> class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' <?php if(!isset($t_posted_array[$field_name]) && isset($offer_field->value->checked) && $offer_field->value->checked==$key){echo"checked";}?>><?php echo $radios;?><\/br>";
							<?php }?>
						htmlform += "</div>";
						<?php } else if($offer_field->fieldtype=='selectbox'){?>
						htmlform += "<div><select name='offer_<?php echo $offer_id;;?>[<?php echo $field_name;?>]' class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' ><option value=''>--Select <?php echo str_replace('_',' ',ucfirst($offer_field->label))?>--<\/option>";
							<?php 
							$rcount = 0;
							foreach ($offer_field->value->values as $key=>$select) {
							$key_option = isset($offer_field->value->keys[$rcount])? $offer_field->value->keys[$rcount] : $select;	
							?>
							htmlform += "<option value='<?php echo $key_option;?>' <?php echo (isset($t_posted_array[$field_name]) && ($t_posted_array[$field_name] == $select)  ? 'selected' : '' ); ?> <?php if(isset($offer_field->value->checked) && $offer_field->value->checked==$key){echo"selected";}?>><?php echo $select?><\/option>";
							<?php 
							$rcount++;
							}?>
						htmlform += "<\/select></div>";			
						<?php } else if($offer_field->fieldtype=='checkbox'){?>
						htmlform += "<div><label><?php echo ucfirst(str_replace('_',' ',$offer_field->label));?></label><br>";
							<?php foreach ($offer_field->value->values as $key=>$check) {?>
							htmlform += "<input name='offer_<?php echo $offer_id;;?>[<?php echo $field_name;?>][]' type='checkbox' value='<?php echo $check;?>' <?php echo (isset($t_posted_array[$field_name]) && ($t_posted_array[$field_name] == $check)  ? 'checked' : '' ); ?> class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' <?php if(isset($offer_field->value->checked) && in_array($key, $offer_field->value->checked)){echo"checked";}?>><?php echo $check;?><\/br>";
							<?php }?>
							
							
							
							
						htmlform += "</div>";
						<?php } else if($offer_field->fieldtype=='textarea'){?>
						htmlform += "<div>";
						htmlform += "<textarea placeholder='<?php echo $offer_field->label;?>' name='offer_<?php echo $offer_id;;?>[<?php echo $field_name;?>]' class='coreg_fields <?php if(isset($offer_field->required) && $offer_field->required==1){echo "require";}?> <?php echo $field_name;  ?>' ><?php echo (isset($t_posted_array[$field_name]) ? $t_posted_array[$field_name] : $offer_field->label ); ?><\/textarea>";
						htmlform += "</div>";
						<?php } else if($offer_field->fieldtype=='hidden'){?>
						htmlform += "<input id='<?php echo $field_name;?>' name='offer_<?php echo $offer_id;?>[<?php echo $field_name;?>]' type='hidden' value='<?php echo $offer_field->label;?>'>";
						<?php }?>	
					<?php }?>	
		<?php } }?>
		
		htmlform += "					<\/div>";
		htmlform += "				<\/div>";
		htmlform += "			<\/div>";
		htmlform += "		<\/div>";
	
	
	current_display_offers.push(<?php echo $offer_id;?>);			
	<?php } ?>
	<?php } ?>
	htmlform += "	<\/div>";
	htmlform += "<\/div>";
	htmlform += "<input type='hidden' name='so_redirect_url' value='<?php echo $so_redirect_url;?>'>";
	htmlform += "<input type='hidden' name='site_id' value='<?php echo base64_encode($site_detail['id']);?>'>";
	htmlform += "<input type='hidden' name='so_offer_shown' value='<?php if(strlen($so_offer_shown)>0){ echo $so_offer_shown.",";} ?>"+current_display_offers.join()+"'>";
	htmlform += "<input type='hidden' name='so_current_offer_shown' value='"+current_display_offers.join()+"'>";
	htmlform += "<input type='hidden' name='so_stage_exit' value='<?php echo $so_stage_exit;?>'>";
	htmlform += "<input type='hidden' name='firstformelementsvalue' id='firstformelementsvalue' value=''>";
	htmlform += "<input type='hidden' id='so_other_form' name='so_other_form' value='<?php echo $so_other_form;?>'>";
	<?php if( $so_other_form != 'iframe'){ ?>
	htmlform += "<input type='submit' name='offer_submit' class='so_submit submit_button' value='SUBMIT'>";
	<?php } ?>
	htmlform += "</form>";	
    htmlform += "<script type='text/javascript' src='<?php echo base_url();?>assets/global/scripts/custom-script-offer-page.js'></script>";
	htmlform += "<script type='text/javascript'>";
    htmlform += "function hideElement(){"
    htmlform += "$('.coreg_fields').each(function(){";
    htmlform += "if($(this).val()){ $(this).parent('div').hide(); ";
    htmlform += "if($(this).prop('type') != 'checkbox' && $(this).prop('type') != 'radio'){";
    htmlform += "if($(this).closest('.date_fields').length){ $(this).closest('.date_fields').hide(); }else{";
    htmlform += "$(this).hide();";
    htmlform += "}";
    htmlform += "}";
    htmlform += "}";
    htmlform += "});";
    htmlform += "}";
	htmlform += " $('form').submit(function(e) {";
	htmlform += " var formname='#<?php echo $so_other_form;?>';";
	htmlform += " var firstformelements = $(formname).serialize();$('#firstformelementsvalue').val(firstformelements);";
	htmlform += " if('<?php echo $so_other_form;?>'=='iframe'){ window.frames['newframe'].formvalidate(); }else{ formvalidate(); }";
	htmlform += " e.preventDefault();";
	htmlform += "});";
    htmlform += "hideElement();";
    htmlform += "</script>";
	<?php }else{  //END IF (!empty($list_offer) && count($list_offer)>0){ ?>
	htmlform += "<script type='text/javascript'>var redirecturl='<?php echo $so_redirect_url;?>';redirecturl = redirecturl.replace(/~/g ,'/'); window.location =redirecturl;</script>";
	<?php }	?>
	document.write(htmlform);
	var so_loader = document.getElementById('so_loader');
	so_loader.parentNode.removeChild(so_loader);
}
//Initialize function
add_offer_to_page();
//VALIDATE FORM
function formvalidate(){
	var radio_button_error = 0;
	for(var i=0;i < current_display_offers.length;i++){
		var radio_button = document.getElementsByName("smart_offer_status_"+current_display_offers[i]);
		if(radio_button[0].checked ==false && radio_button[1].checked ==false){   
			document.getElementById('smart_offer_'+current_display_offers[i]).style.backgroundColor = '<?php echo $so_error_bg_color;?>';
			document.getElementById('smart_offer_'+current_display_offers[i]).style.color = '<?php echo $so_error_txt_color;?>';
		    radio_button_error++;
		}else if(radio_button[0].checked ==true){
			document.getElementById('smart_offer_'+current_display_offers[i]).style.backgroundColor = '<?php echo $so_main_bg_color;?>';
			document.getElementById('smart_offer_'+current_display_offers[i]).style.color = '<?php echo $so_text_color;?>';
			var a= document.getElementById('smart_offer_'+current_display_offers[i]);
			var req_fields = a.getElementsByClassName('require');
			for(var p=0;p < req_fields.length;p++){
				if(req_fields[p].value==""){
					//alert(req_fields[p].name);
					radio_button_error++;
					req_fields[p].style.border = '1px solid <?php echo $so_error_bg_color;?>';
				}else if(req_fields[p].getAttribute('fieldtype')=='so_email' && checkEmail(req_fields[p].value) == false){
					radio_button_error++;
					req_fields[p].style.border = '1px solid <?php echo $so_error_bg_color;?>';
				}else if(req_fields[p].getAttribute('fieldtype')=='so_homephone' && IsMobileNumber(req_fields[p].value) == false){
					radio_button_error++;
					req_fields[p].style.border = '1px solid <?php echo $so_error_bg_color;?>';
				}else{	
					//alert(req_fields[p].getAttribute('name'));
					req_fields[p].style.border = '1px solid'; 
				}
			}
		}else{
			document.getElementById('smart_offer_'+current_display_offers[i]).style.backgroundColor = '<?php echo $so_main_bg_color;?>';
			document.getElementById('smart_offer_'+current_display_offers[i]).style.color = '<?php echo $so_text_color;?>';
		}
	}
	if(radio_button_error > 0){
		alert('Please Fill Highlighted Parts');
		return false;
	}else{
		document.getElementById("offer_form").submit();
		return true;
	}
}
//pop out offer
function offer_popout(id,url,sid){
	var url = '<?php echo base_url();?>/Remote_content/popout?url='+encodeURIComponent(url)+'&sid='+sid+'&oid='+id;
	window.open(url,"_blank",'Offer Page','width=800,height=600,scrollbars=yes');	
}
function checkEmail(email){
    var filter = /^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
    if (!filter.test(email)){
   		//alert('Please provide a valid email address');
   		return false;
 	}
}
function IsMobileNumber(txtMob) {
    var mob = /^[1-9]{1}[0-9]{9}$/;
    if (mob.test(txtMob) == false) {
        //alert("Please enter valid mobile number.");
        return false;
    }
    return true;
}