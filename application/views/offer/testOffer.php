<html>
	<head>
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta content="width=device-width, initial-scale=1.0" name="viewport" />
        <meta http-equiv="Content-type" content="text/html; charset=utf-8">
        <meta content="" name="description" />
        <meta content="" name="author" />
        <!-- BEGIN GLOBAL MANDATORY STYLES -->

        <link href="http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700&subset=all" rel="stylesheet" type="text/css">
        <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/global/plugins/bootstrap/css/bootstrap.min.css'/>        
        <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/global/css/components-rounded.css'/>        
        <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/admin/layout3/css/layout.css'/>        


        <link rel='stylesheet' type='text/css' href='<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/css/datepicker3.css'/>
        <script src='<?php echo base_url();?>assets/global/plugins/jquery.min.js' type='text/javascript'></script>
        <script type='text/javascript' src='<?php echo base_url();?>assets/global/plugins/bootstrap-datepicker/js/bootstrap-datepicker.js'></script>
        
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3234816981395206"
     crossorigin="anonymous"></script>
<meta name="google-adsense-account" content="ca-pub-3234816981395206">
	<body>
        <div class="page-content" style="padding-top:20px;">
            <div class="container">
                
        <form id="test_offer" action="<?php echo base_url();?>offer/testOffer<?php if(!empty($result->id)) { echo "/".$result->id; }?>" method="post">
            <div class="portlet light">
                <div class="portlet-title">
                    <div class="caption">
                        <i class="fa fa-cogs font-green-sharp"></i> <span
                            class="caption-subject font-green-sharp bold uppercase"><?php echo (isset($result->offer_name) && !empty($result -> offer_name) ? $result -> offer_name : 'Offer Test' ); ?></span>
                    </div>
                    <div class="tools"></div>
                </div>
                <div class="portlet-body form" style="display: block;">
                    <div class="form-body">
					<div class="row">
						<div class="col-md-12">
							
            <?php 
                    $s_url = '';                
                    $systemDbFields = '';
                    $postFields = '';
                    $otherDbField ='';
                    echo '<div class="form-group"><label class="control-label"></label><div>';
                    if(!empty($result->offer_image)) { 
                        echo '<img alt="offer image" src="'.base_url().'uploads/'.$result->offer_image.'" style="width: 300px; height: 250px;">';
                    }
                    $opt_in_selected = isset($result->offer_options) == "opt_in" ? '' : '';
					$opt_out_selected = isset($result->offer_options) == "opt_out" ? '' : '';
                    echo '<div style="padding-left:100px"><label class="control-label"><input type="radio" name="smart_offer_status" '.$opt_in_selected.' value="yes">&nbsp;Yes&nbsp;<input type="radio" '.$opt_out_selected.' value="no" name="smart_offer_status">&nbsp;No</label></div>
					</div>
					<div><label class="control-label">'.$result->offer_content.'</label></div>
					</div>';                 
                    if($result -> offer_options == 'opt_popout'){
                        $s_url = ((isset($result -> http_post_url) && !empty($result -> http_post_url) && ($result -> transfer_method == 'transfer_method_post')) ? $result -> http_post_url : ((isset($result -> http_get_url) && !empty($result -> http_get_url) && ($result -> transfer_method == 'transfer_method_get')) ? $result -> http_get_url : '' ) );
                        if(!empty($s_url)){
                           echo '<div class="form-group"><label class="control-label"></label> <div class="radio-list">';
                                    echo '<label class="radio-inline"><div class="md-radio pull-left"><input required type="radio" class="offer_action" id="radio_yes" name="offer_action" value="Yes" /><label for="radio_yes"><span></span><span class="check"></span> <span class="box"></span>Yes</label></div><label>';   
                                    echo '<label class="radio-inline"><div class="md-radio pull-left"><input required type="radio" class="offer_action" id="radio_no" name="offer_action" value="No" /><label for="radio_no"><span></span><span class="check"></span> <span class="box"></span>No</label></div><label>';   
                            echo '</div></div>';
                        }else{
                            echo 'No URL Found To Open Offer';
                        }
                    }else{ 
                        if(isset($result->offer_form) && !empty($result->offer_form)){
                            $tmp_offer_form = json_decode($result->offer_form);
							//echo '<pre>';print_r($tmp_offer_form);exit;
                            if(count((array)$tmp_offer_form)>0){
                                foreach ($tmp_offer_form as $tfield){
                                    switch($tfield -> fieldtype){
                                        case 'radio':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.' </label> <div class="radio-list">';
                                            if(isset($tfield -> value) && !empty($tfield -> value) && !empty($tfield -> value -> values)){
                                                foreach($tfield -> value -> values as $i_key => $s_value){
                                                    echo '<label class="radio-inline"><div class="md-radio pull-left"><input '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' type="radio" id="radio_'.$i_key.'" name="'.$tfield -> title.'" value="'.$s_value.'" /><label for="radio_'.$i_key.'"><span></span><span class="check"></span> <span class="box"></span>'.$s_value.'</label></div><label>';   
                                                }                        
                                            }
                                            echo '</div></div>';
                                        break;
                                        case 'checkbox':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.' </label><div class="md-checkbox-inline"> ';
                                            if(isset($tfield -> value) && !empty($tfield -> value) && !empty($tfield -> value -> values)){
                                                foreach($tfield -> value -> values as  $i_key => $s_value){
                                                    echo '<div class="md-checkbox"><input id="check_'.$i_key.'" class="" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).'  type="checkbox" name="'.$tfield -> title.'[]" value="'.$s_value.'" /><label for="check_'.$i_key.'"><span></span><span class="check"></span><span class="box"></span> '.$s_value.' </label></div>';   
                                                }                                
                                            }
                                            echo '</div></div>';
                                        break;
                                        case 'text':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.' </label><div class="input-icon right"> <input class="form-control" type="text" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' placeholder="'.$tfield->label.'" name="'.$tfield -> title.'" /></div></div>';
                                        break;
                                        case 'date-picker-box':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.' </label><div class="input-icon right"><input class="form-control date-picker" type="text" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).'  readonly date-format="'.$tfield -> date_format.'" placeholder="'.$tfield->label.'" name="'.$tfield -> title.'" /></p>';
                                        break;
                                        case 'date-selector':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.' </label> 
                                            <input type="hidden" name="'.$tfield -> title.'[format]" value="'.$tfield -> date_format.'" />
                                            <div class="row"><div class="col-xs-4"><div class="form-group">
                                                <select class="form-control" name="'.$tfield -> title.'[date]" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' >
                                                    <option value="">Select Date</option>';
                                                    for($i_date=1;$i_date<=31;$i_date++){
                                                        echo '<option value='.$i_date.'>'.$i_date.'</option>';
                                                    }
                                                echo '</select></div></div>
                                            <div class="col-xs-4"><div class="form-group">
                                                <select class="form-control" name="'.$tfield -> title.'[month]" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' >
                                                    <option value="">Select Month</option>';
                                                    for($i_month=1;$i_month<=12;$i_month++){
                                                        echo '<option value='.$i_month.'>'.date("F", mktime(0, 0, 0, $i_month, 10)).'</option>';
                                                    }
                                                echo '</select></div></div>
                                            <div class="col-xs-4"><div class="form-group">
                                                <select class="form-control" name="'.$tfield -> title.'[year]" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' >
                                                    <option value="">Select Year</option>';
                                                    for($i_year=(date('Y')-18);$i_year>=((date('Y')-18)-80);$i_year--){
                                                        echo '<option value='.$i_year.'>'.$i_year.'</option>';
                                                    }
                                                echo '</select></div></div></div>
                                            </div>';
                                        break;
                                        case 'hidden':
                                            echo '<input type="hidden" name="'.$tfield -> title.'" value="'.$tfield->label.'" />';
                                        break;
                                        case 'textarea':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.' </label> <textarea class="form-control" placeholder="'.$tfield->label.'" name="'.$tfield -> title.'" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' ></textarea></div>';
                                        break;
                                        case 'selectbox':
                                            echo '<div class="form-group"><label class="control-label">'.$tfield->label.'</label> ';
                                            if(isset($tfield -> value) && !empty($tfield -> value) && !empty($tfield -> value -> values)){
                                                echo '<select class="form-control" name="'.$tfield -> title.'" '.(isset($tfield->required) && $tfield->required==1 ? "required" : "" ).' >';
                                                $rcount=0;
                                                foreach($tfield->value->values as $s_value){
                                                    $key_opt=isset($tfield->value->keys[$rcount]) ? $tfield->value->keys[$rcount] : $s_value;
                                                    echo '<option value="'.$key_opt.'">'.$s_value.'</option>';
                                                    $rcount++;   
                                                }
                                                echo '</select>';
                                            }
                                            echo '</div>';
                                        break;
                                    }
                                }
                            }
                        }
                    }
            ?>
                        </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($result -> offer_options != 'opt_popout'){ ?>
            <div class="form-actions">
                <input type="submit" value="Submit Test" class="btn blue" />
            </div>
            <?php } ?>
        </form>
        </div>
        </div>
        <script type='text/javascript' src='<?php echo base_url();?>assets/global/scripts/custom-script-offer-page.js'></script>
        <script type="text/javascript">
            $(document).on('click','.offer_action',function(){
                if($(this).val() == 'Yes'){
                    window.location.href = '<?php echo $s_url; ?>';  
                }
            });
        </script>
	</body>
</html>