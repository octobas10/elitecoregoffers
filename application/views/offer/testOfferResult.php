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
        <style>
            body{
                background:#eff3f8;    
            }
            *{
                word-wrap:break-word;
            }
        </style>
	<script async src="https://pagead2.googlesyndication.com/pagead/js/adsbygoogle.js?client=ca-pub-3234816981395206"
     crossorigin="anonymous"></script>
<meta name="google-adsense-account" content="ca-pub-3234816981395206">
	<body>
        <div class="page-content" style="padding-top:20px;">
            <div class="container">
                <div class="portlet box blue-sharp">
                    <div class="portlet-title">
                        <div class="caption">
                           Post String
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body form" style="display: block;">
                        <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if(isset($result) && !empty($result) && !empty($result['send_url'])){
                                        echo $result['send_url'];
                                    }
                                ?>                            
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet box blue-sharp">
                    <div class="portlet-title">
                        <div class="caption">
                           Return Message
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body form" style="display: block;">
                        <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if(isset($result) && !empty($result) && isset($result['response_data'])){
                                        echo htmlentities($result['response_data']);
                                    }
                                ?>                            
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="portlet box blue-sharp">
                    <div class="portlet-title">
                        <div class="caption">
                           Outcome
                        </div>
                        <div class="tools"></div>
                    </div>
                    <div class="portlet-body form" style="display: block;">
                        <div class="form-body">
                        <div class="row">
                            <div class="col-md-12">
                                <?php 
                                    if(isset($result) && !empty($result) && isset($result['status'])){
                                        echo ($result['status'] == 1 ? 'Accepted' : 'Rejected' );
                                    }
                                ?>                            
                            </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>