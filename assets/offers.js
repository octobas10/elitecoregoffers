// Initialize variables
if(typeof so_affiliate_id == 'undefined'){
	alert('Sorry but Affiliate ID must be provided');
}
if(typeof so_site_id == 'undefined'){
	alert('Sorry but Site ID must be provided');
}
if(typeof so_redirect_url == 'undefined'){
	alert('Sorry but Redirect URL must be provided');
}else{
	so_redirect_url = so_redirect_url.replace(/\//g, '~');
	so_redirect_url = so_redirect_url.replace(/\?/g, '~2~');
}
if(typeof so_page_name == 'undefined'){
	so_page_name = '';
}else{
	so_page_name = so_page_name.replace(/\//g, '~');
	so_page_name = so_page_name.replace(/\?/g, '~2~');
}
//Define smart offer URL
var smart_offer_url 						= 'https://elitecoregoffers.com';
if(so_main_bg_color==null) 					var so_main_bg_color = '#5e93b2';
if(so_main_bg_width==null) 					var so_main_bg_width = 'auto';
if(so_image_width==null) 					var so_image_width = 'auto';
if(so_content_width==null) 					var so_content_width = 'auto';
if(so_text_color==null) 				    var so_text_color = '#fff';
if(so_inputtext_color==null) 				var so_inputtext_color = '#000';
if(so_font_size==null) 						var so_font_size = '14px';
if(so_font_family==null) 					var so_font_family = '"Open Sans", sans-serif';
if(so_color_border==null) 					var so_color_border = '1px solid #ccc';
if(so_error_bg_color==null) 				var so_error_bg_color = '#F36A5A';
if(so_error_txt_color==null) 				var so_error_txt_color = '#FFF';
if(so_page_number==null) 		     		var so_page_number = '1';
if(so_offer_seperator_color==null) 		    var so_offer_seperator_color = '#ccc';
if(so_text_align==null) 		            var so_text_align = 'center';
if(so_first_name==null)  					var so_first_name='';
if(so_last_name==null)   					var so_last_name='';
if(so_email==null)       					var so_email='';
if(so_dob==null)        				 	var so_dob='';
if(so_homephone==null)   					var so_homephone='';
if(so_workphone==null)   					var so_workphone='';
if(so_mobilephone==null) 					var so_mobilephone='';
if(so_address==null)     					var so_address='';
if(so_city==null)        					var so_city='';
if(so_state==null)       					var so_state='';
if(so_country==null)     					var so_country='';
if(so_zipcode==null)     					var so_zipcode='';
if(so_gender==null)      					var so_gender='';

var so_offer_shown = getParameterByName('so_offer_shown');
var so_stage_exit = getParameterByName('so_stage_exit');
if(so_stage_exit==null)      				var so_stage_exit= 0;
if(so_other_form==null)      				var so_other_form= 0;
//Initialize offers
offer_loadPage();
/*
 *  Function for Load offers
 */
function offer_loadPage(){
	document.write("<link href='//fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css'><style type='text/css'>#smart_offer label,#smart_offer input{margin:5px;} #smart_offer input,#smart_offer select,#smart_offer textarea{color:"+so_inputtext_color+";} #smart_offer div,#smart_offer div{text-align:"+so_text_align+"} #smart_offer{  font-family: 'Open Sans', sans-serif;}  #smart_offer div{padding:5px;font-size:15px;} #smart_offer .offer_wraper{border:"+so_color_border+";}</style>");
	document.write("<script language=\"javascript\" src=\""+smart_offer_url+"/Remote_content?" +
    					"so_affiliate_id="+encodeURIComponent(so_affiliate_id)+
    					"&so_site_id="+encodeURIComponent(so_site_id)+
    					"&so_redirect_url="+encodeURIComponent(so_redirect_url)+
    					"&so_page_name="+encodeURIComponent(so_page_name)+
						"&so_first_name="+encodeURIComponent(so_first_name)+
    					"&so_last_name="+encodeURIComponent(so_last_name)+
    					"&so_email="+encodeURIComponent(so_email)+
    					"&so_dob="+encodeURIComponent(so_dob)+
    					"&so_homephone="+encodeURIComponent(so_homephone)+
    					"&so_workphone="+encodeURIComponent(so_workphone)+
    					"&so_mobilephone="+encodeURIComponent(so_mobilephone)+
    					"&so_address="+encodeURIComponent(so_address)+
    					"&so_city="+encodeURIComponent(so_city)+
    					"&so_state="+encodeURIComponent(so_state)+    					
    					"&so_zipcode="+encodeURIComponent(so_zipcode)+
    					"&so_country="+encodeURIComponent(so_country)+
    					"&so_gender="+encodeURIComponent(so_gender)+
    					"&so_date="+formatDate(new Date())+
                        "&request_id="+s_user_session_key+
						"&so_offer_shown="+encodeURIComponent(so_offer_shown)+
						"&so_stage_exit="+encodeURIComponent(so_stage_exit)+		
    					"&so_other_form="+encodeURIComponent(so_other_form)+
						"&so_content_width="+encodeURIComponent(so_content_width)+
    					"&so_main_bg_color="+encodeURIComponent(so_main_bg_color)+
    					"&so_main_bg_width="+encodeURIComponent(so_main_bg_width)+
    					"&so_image_width="+encodeURIComponent(so_image_width)+
    					"&so_text_color="+encodeURIComponent(so_text_color)+
    					"&so_font_size="+encodeURIComponent(so_font_size)+
    					"&so_font_family="+encodeURIComponent(so_font_family)+
    					"&so_color_border="+encodeURIComponent(so_color_border)+
    					"&so_error_bg_color="+encodeURIComponent(so_error_bg_color)+
    					"&so_error_txt_color="+encodeURIComponent(so_error_txt_color)+
    					"&so_offer_seperator_color="+encodeURIComponent(so_offer_seperator_color)+
    					"&so_redirect_url="+encodeURIComponent(so_redirect_url)+
    					"&so_text_align="+encodeURIComponent(so_text_align)+
    					"&so_text_align="+encodeURIComponent(so_text_align)+
    					"&so_page_number="+encodeURIComponent(so_page_number)+"\"><\/script>");
    
}

function formatDate(date) {
	var d = new Date(date),
        month = '' + (d.getMonth() + 1),
        day = '' + d.getDate(),
        year = d.getFullYear();

    if (month.length < 2) month = '0' + month;
    if (day.length < 2) day = '0' + day;
    return [year, month, day].join('-');
}

function dropdown(lname,formname)
{
	var fina;
   	if( formname=='')
    {
   		//alert("in");
   		eval("fina=document.forms[0]."+lname+".checked");
    }
   	else
    {
    	//alert("out");
   		eval("fina=document."+formname+"."+lname+".checked");
    }
    if(fina)
   	{
   		show_layer(lname+'div');
    }
   	else
    {
    	hide_layer(lname+'div');
    }
}

function show_layer(lname)
{
	if(document.layers)
	{ //NN4+
		document.layers[lname].visibility="show";
	}
	else if(document.getElementById)
	{ //gecko(NN6) + IE 5+
		var obj = document.getElementById(lname);
		obj.style.display="block";
	}
	else if(document.all)
	{ // IE 4
		document.all[lname].style.display="block";
	}
	else
	{
		lname.style.visibility="visible";
	}
}

function hide_layer(lname)
{
	if(document.layers)
	{ //NN4+
		document.layers[lname].visibility="hide";
	}	
	else if(document.getElementById)
	{//gecko(NN6) + IE 5+
		var obj = document.getElementById(lname);
		obj.style.display="none";
	}
	else if(document.all)
	{ // IE 4
		document.all[lname].style.display="none";
	}
	else
	{
		lname.style.visibility="hidden";
	}
}

function getParameterByName(name) {
    name = name.replace(/[\[]/, "\\[").replace(/[\]]/, "\\]");
    var regex = new RegExp("[\\?&]" + name + "=([^&#]*)"),
        results = regex.exec(location.search);
    return results === null ? "" : decodeURIComponent(results[1].replace(/\+/g, " "));
}