$(function() {
	// UP DOWN
    $("#up_available_offers").click(function(){
		$("#available_offers").moveSelectedUp();
	});
	$("#down_available_offers").click(function(){
		$("#available_offers").moveSelectedDown();
	});
	// UP DOWN
    $(".resizable").resizable({
    	minWidth: 150,
    	minHeight: 150,
        containment: "#sortable"
    });
    
    $("#sortable").sortable();
    
    $('#offer_image').on('change', uploadFiles);

    $('#offer_text_box').dblclick(function(e){
		e.preventDefault();
		var tmp_con = $(this).html();
		
		var tmp_input = "<textarea id='offer_text'>"+tmp_con+"</textarea>";
		$(this).html(tmp_input);
	});

	$('#offer_text_box').focusout(function(e){
		e.preventDefault();
		var tmp = $("#offer_text").val();
		$(this).html(tmp);
	});

	
	if(typeof offer_id !== 'undefined' && typeof offer_id !== null){
		$("#offer_image_box").parent('li').css('width',$(".offer_image").width());
		$("#offer_image_box").parent('li').css('height',$(".offer_image").height());
		$("#offer_image_box").html($(".offer_image").html());
	
		$("#offer_text_box").parent('li').css('width',$(".offer_text").width());
		$("#offer_text_box").parent('li').css('height',$(".offer_text").height());
		$("#offer_text_box").html($(".offer_text").html());
		
		$('#formbuilder').formbuilder({
			'save_url': base_url+'offer/example_save',
			'load_url': base_url+'offer/getofferform/'+offer_id,
			'useJson' : true
		});
		$("#formbuilder ul").sortable({ opacity: 0.6, cursor: 'move'});
  }
	
	//select prime offers
	$("#prime_offer_add").click(function(){		
		var tmp_options ="";
		$("#available_offers option:selected").each(function()
		{
			tmp_options +="<option value='"+$(this).val()+"' selected>"+$(this).text()+"</option>";	
			$(this).remove();
		});
		if(tmp_options.length>0)
		{ 
			$("#prime_offers").append(tmp_options); 
			$("#available_offers").parent("div").removeClass("has-error").css('color','#333333');	
			var remspan = $("#available_offers").parent("div");
			remspan.children(".help-block").remove();
		}
		else
		{ 
			if(!$("#available_offers").parent("div").hasClass("has-error"))
			{
				$("#available_offers").parent("div").addClass("has-error").css('color','#AB4942').append("<span class='help-block'>Please select value </span>");
			}			
		}		
	});
	
	//remove prime offers
	$("#prime_offer_remove").click(function(){		
		var tmp_options ="";
		$("#prime_offers option:selected").each(function()
		{
			tmp_options +="<option value='"+$(this).val()+"'>"+$(this).text()+"</option>";	
			$(this).remove();
		});
		
		if(tmp_options.length>0)
		{ 
			$("#available_offers").append(tmp_options);
		}
		else
		{ 
			if(!$("#prime_offers").parent("div").hasClass("has-error"))
			{
				$("#prime_offers").parent("div").addClass("has-error").css('color','#AB4942').append("<span class='help-block'>Please select value </span>");
			}
		}
	});
	
	//select regular offers
	$("#regular_offer_add").click(function(){		
		var tmp_options ="";
		$("#available_offers option:selected").each(function()
		{
			tmp_options +="<option value='"+$(this).val()+"' selected>"+$(this).text()+"</option>";	
			$(this).remove();
		});
		
		if(tmp_options.length>0)
		{ 
			$("#regular_offers").append(tmp_options); 
			$("#available_offers").parent("div").removeClass("has-error").css('color','#333333');	
			var remspan = $("#available_offers").parent("div");
			remspan.children(".help-block").remove();
		}
		else
		{ 
			if(!$("#available_offers").parent("div").hasClass("has-error"))
			{
				$("#available_offers").parent("div").addClass("has-error").css('color','#AB4942').append("<span class='help-block'>Please select value </span>");
			}
		}
	});
	
	//remove regular offers
	$("#regular_offer_remove").click(function(){		
		var tmp_options ="";
		$("#regular_offers option:selected").each(function()
		{
			tmp_options +="<option value='"+$(this).val()+"'>"+$(this).text()+"</option>";	
			$(this).remove();
		});
		
		if(tmp_options.length>0)
		{ $("#available_offers").append(tmp_options); }
		else
		{ 
			if(!$("#regular_offers").parent("div").hasClass("has-error"))
			{
				$("#regular_offers").parent("div").addClass("has-error").css('color','#AB4942').append("<span class='help-block'>Please select value </span>");
			}
		}
	});
	
	/*
	 *STARTs DATATABLE  
	 */
	if($.isFunction($.fn.dataTable)){
		$("#table-list-sites").dataTable();
	}
	
	/*-------------------------*/
	
	/*
	 * STARTs FORM VALIDATION
	 */
	// validation using icons
    var handleValidation2 = function() {
        // for more info visit the official plugin documentation: 
            // http://docs.jquery.com/Plugins/Validation

            var form2 = $('#form_sample_2');
            var error2 = $('.alert-danger', form2);
            var success2 = $('.alert-success', form2);

            form2.validate({
                errorElement: 'span', //default input error message container
                errorClass: 'help-block help-block-error', // default input error message class
                focusInvalid: false, // do not focus the last invalid input
                ignore: "",  // validate all fields including form hidden input
                rules: {
                	site_name: {
                        minlength: 2,
                        remote:base_url+"MySite/check_sitename",
                        remote: {
                        	url:base_url+"MySite/check_sitename",
                        	type:"get",
                        	data:{
                        		 data_id: function() {
                                     return $("#data_id").val();
                                 }
                        	}
                        },
                        required: true
                    },
                    display_offer_type: {
                        required: true
                    },
                    offer_name:{
                    	minlength: 2,
                    	required: true,
                    	remote: {
                    		url:base_url+"offer/check_offername",
                            type: "get" ,
                            data: {
                               data_id: function() {
                                  return $("#data_id").val();
                               }
                            }                            
                          }
                    },
                    client_id:{
                    	required: true
                    },
                    transfer_method:{
                    	required: true
                    },  
                    client_name: {
                        minlength: 2,
                        required: true,
                        remote: {
                    		url:base_url+"client/check_clientname",
                            type: "get" ,
                            data: {
                               data_id: function() {
                                  return $("#data_id").val();
                               }
                            }                            
                          }
                    },
                    client_alias:{
                    	minlength:2,
                    	required: true
                    }, 
                    client_email:{
                    	minlength:2,
                    	email:true,
                    	required: true
                    }, 
                    client_phone_number:{
                    	minlength:10,
                    	number: true,                    	
                    	required: true
                    },
                    client_login:{
                    	required: true
                    },
                    client_password:{
                    	minlength:5,
                    	required: true
                    },
                    affiliate_id:{
                    	required: true
                    },
                },
                
                messages: {
                	offer_name:{
                        remote: "Offer name already exits! Try another."
                    },
                    site_name:{
                        remote: "Site name already exits! Try another."
                    },
                    client_name:{
                        remote: "Client name already exits! Try another."
                    },
                },
                
                invalidHandler: function (event, validator) { //display error alert on form submit              
                    success2.hide();
                    error2.show();
                    Metronic.scrollTo(error2, -200);
                },

                errorPlacement: function (error, element) { // render error placement for each input type
                    var icon = $(element).parent('.input-icon').children('i');
                    icon.removeClass('fa-check').addClass("fa-warning");  
                    icon.attr("data-original-title", error.text()).tooltip({'container': 'body'});
                },

                highlight: function (element) { // hightlight error inputs
                    $(element)
                        .closest('.form-group').removeClass("has-success").addClass('has-error'); // set error class to the control group   
                },

                unhighlight: function (element) { // revert the change done by hightlight
                    
                },

                success: function (label, element) {
                    var icon = $(element).parent('.input-icon').children('i');
                    $(element).closest('.form-group').removeClass('has-error').addClass('has-success'); // set success class to the control group
                    icon.removeClass("fa-warning").addClass("fa-check");
                },

                submitHandler: function (form) {
                    success2.show();
                    error2.hide();
                    // For Selecting All Option Inside Prime Offers and Regular Offer If These two selectbox available on current page
                    if($('#prime_offers').length && $('#regular_offers').length){
                        $('#prime_offers option').prop('selected', true);
                        $('#regular_offers option').prop('selected', true);
                    }
                    form.submit(); // submit the form
                }
            });
    }
    
    if($.isFunction($.fn.validate)){
    	handleValidation2();
    }    
	/*-----------------------*/
    
    $("#display_offer_type").change(function(){
    	var prime_offer = $("#prime_offers").val();
    	var regular_offer = $("#regular_offers").val();
    	$.ajax({
    		url:base_url+"offer/ajax_getoffers/"+$("#display_offer_type").val(),
    		method:'post',
    		data:"prime="+prime_offer+"&regular="+regular_offer,
    		success:function(result){
    			
    			if(result.length > 0)
    			{
    				$("#available_offers").html(result);
    			}
    		}
    	});
    });
		
});


function performClick(elemId) 
{
	   var elem = document.getElementById(elemId);
	   if(elem && document.createEvent) 
	   {
	      var evt = document.createEvent("MouseEvents");
	      evt.initEvent("click", true, false);
	      elem.dispatchEvent(evt);
	   }
}

var files;	
function uploadFiles(event)
{
	files = event.target.files;
	console.log(files);
	var fd = new FormData();
	
	$.each(files, function(key, value){
		fd.append(key, value);
	});
		
	var other_data = $('form').serializeArray();
	$.each(other_data,function(key,input){
		fd.append(input.name,input.value);
	});
    
    var formData = new FormData($('form')[0]);

	$.ajax({
		url: base_url+'offer/upload_ajax_image',
		type: 'POST',
		data: formData,
		cache: false,
		processData: false,
		contentType: false,
        mimeType:"multipart/form-data",
		success: function(data, textStatus, jqXHR){
			img = files['0']['name'];
			img = img.replace(/\s+/g, '_');
			img = img.replace(/'+/g, '_');
			img = img.replace(/-+/g, '_');
			
			var imgdata = '<img src="'+base_url+'uploads/'+img+'" id="demo3" style="weight:800px;height:500px;"/>';
			$("#offer_image_box1").html(imgdata);
			var imgdata ="<div id=\"preview-pane\"><div class=\"preview-container\"><img src=\""+base_url+"uploads/"+img+"\"  class=\"jcrop-preview\" alt=\"Preview\"/></div></div>";
			$("#offer_image_box2").html(imgdata);
			$("#offer_img").attr("value",img);
			demo3();
		},
		error: function(jqXHR, textStatus, errorThrown){
			//console.log('ERRORS2: ' + textStatus);
		}
	});
	return false;
}

/* ****************************/
var demo8 = function() {
    $('#demo8').Jcrop({
      aspectRatio: 1,
      onSelect: updateCoords
    });

    function updateCoords(c)
      {
        $('#crop_x').val(c.x);
        $('#crop_y').val(c.y);
        $('#crop_w').val(c.w);
        $('#crop_h').val(c.h);
      };

      $('#demo8_form').submit(function(){
        if (parseInt($('#crop_w').val())) return true;
        alert('Please select a crop region then press submit.');
        return false;
        });

}

var demo3 = function() {
    // Create variables (in this scope) to hold the API and image size
    var jcrop_api,
        boundx,
        boundy,
        // Grab some information about the preview pane
        $preview = $('#preview-pane'),
        $pcnt = $('#preview-pane .preview-container'),
        $pimg = $('#preview-pane .preview-container img'),

        xsize = $pcnt.width(),
        ysize = $pcnt.height();
    
        console.log('init',[xsize,ysize]);

    $('#demo3').Jcrop({
      onChange: updatePreview,
      onSelect: updatePreview,
      aspectRatio: xsize / ysize
    },function(){
      // Use the API to get the real image size
      var bounds = this.getBounds();
      boundx = bounds[0];
      boundy = bounds[1];
      // Store the API in the jcrop_api variable
      jcrop_api = this;
      // Move the preview into the jcrop container for css positioning
      $preview.appendTo(jcrop_api.ui.holder);
    });

    function updatePreview(c)
    {
      if (parseInt(c.w) > 0)
      {
        var rx = xsize / c.w;
        var ry = ysize / c.h;

        $pimg.css({
          width: Math.round(rx * boundx) + 'px',
          height: Math.round(ry * boundy) + 'px',
          marginLeft: '-' + Math.round(rx * c.x) + 'px',
          marginTop: '-' + Math.round(ry * c.y) + 'px'
        });
        
        $('#x').val(c.x);
        $('#y').val(c.y);
        $('#w').val(c.w);
        $('#h').val(c.h);
      }
    };
}

/* ************* TEXTAREA MAXLENGTH ***************/
if($.isFunction($.fn.maxlength)){
	$(document).ready(function(){
		  $('#maxlength_textarea').maxlength({
	          limitReachedClass: "label label-danger",
	          alwaysShow: true
	      });
	});
}

/* ********************* ADD FORM FIELDS *************************/
/*//GET SYSTEM FIELDS
var system_fields = '';
$(document).ready(function(){
	$.ajax({
		type:'post',
		url:base_url+'offer/get_system_fields',
		success:function(res){
			system_fields=res;			
		}
	});
});
*/
function add_fieldto_form(field_name){
	var count = $("#offer-form-elements .form-group").length+1;
	var client_field_name = "Client Field Name";
	var client_field_label = "Client Field Label";
	//make ajax request
	var system_fields = '';
	var set_field_name = "<input type=\"text\" class=\"form-control required\" required=\"required\" name=\"userform[field_"+count+"][title]\" value=\"\" placeholder='"+client_field_name+"'>";
	$.ajax({
		type:'post',
		url:base_url+'offer/get_system_fields/'+count,
		success:function(res){
			system_fields = res;
			var field = "";
			switch(field_name){
					case"text":
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Text Field</h4>";
						field += "							<div class=\"col-md-3\">";
						field += "								<div class=\"md-checkbox-list\">";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += "										<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\">";
						field += "										<label for=\"field_"+count+"_required\"> <span><\/span> ";
						field += "										<span class=\"check\"><\/span> <span class=\"box\"><\/span> Required<\/label>&nbsp;&nbsp;&nbsp;";
						field += "									<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "								<\/div>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-3\">";
						field += set_field_name;
						field += "							<\/div>";
						field += "							<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "						<\/div>";
					break;
					case"hidden":
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Hidden Field</h4>";
						field += "							<div class=\"col-md-3\">";
						field += system_fields;
						field += "							<\/div>";
						field += "							<div class=\"col-md-3\">";
						field += set_field_name;
						field += "							<\/div>";
						field += "							<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "						<\/div>";
					break;
					case"radio":
						var field="";
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Radio Group</h4>";
						field += "								<div class=\"col-md-3\">";
						field += "									<div class=\"md-checkbox-list\">";
						field += "										<div class=\"md-checkbox pull-left \">";
						field += "											<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\"> <label for=\"field_"+count+"_required\"> <span><\/span>";
						field += "												<span class=\"check\"><\/span> <span class=\"box\"><\/span>";
						field += "												Required";
						field += "											<\/label>&nbsp;&nbsp;&nbsp;";
						field += "										<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "									<\/div>";
						field += "								<\/div>";
						field += "								<div class=\"col-md-3\">";
						field += set_field_name;
						field += "								<\/div>";
						field += "								<div class=\"col-md-5\">";
						field += "									<div id=\"field_"+count+"_option_container\"><div class=\"form-group form-md-radios border-none\" id=\"form-radios-"+count+"-0\">	";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";						
						field += " <div class=\"md-radio-inline border-none\">	";
						field += 		"<div class=\"col-md-3\"><div class=\"md-radio pull-left mrleftn17\">	";
						field += 		"<input type=\"radio\" id=\"field_"+count+"_radio_0\" name=\"userform[field_"+count+"][value][checked]\" value=\"0\" class=\"md-radiobtn\"> ";
						field += 				"<label for=\"field_"+count+"_radio_0\"> <span><\/span>	<span class=\"check\"><\/span> <span class=\"box\"><\/span>Option<\/label><\/div><\/div><div class=\"col-md-6\"><input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][value][values][]\" value=\"\" placeholder=\"Field Value\">	<\/div>	<div class=\"col-md-3\">	<\/div>	<\/div><\/div><\/div>";
						field += "									<a href=\"javascript:;\" class=\"btn green btn-xs\" onclick=\"return add_field_options('"+count+"','radios',0);\"><i class=\"fa fa-plus\"><\/i><\/a>";
						field += "								<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "							<\/div>";
					break;	
					case"selectbox":
						var field="";
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Select List</h4>";
						field += "								<div class=\"col-md-3\">";
						field += "									<div class=\"md-checkbox-list\">";
						field += "										<div class=\"md-checkbox pull-left \">";
						field += "											<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\"> <label for=\"field_"+count+"_required\"> <span><\/span>";
						field += "												<span class=\"check\"><\/span> <span class=\"box\"><\/span>";
						field += "												Required";
						field += "											<\/label>&nbsp;&nbsp;&nbsp;";
						field += "										<\/div>";
						field += "									<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "								<\/div>";
						field += "								<div class=\"col-md-3\">";
						field += set_field_name;
						field += "								<\/div>";
						field += "								<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
						field += "									<div id=\"field_"+count+"_option_container\"><div class=\"form-group form-md-radios border-none\" id=\"form-selectbox-"+count+"-0\"><div class=\"md-radio-inline border-none\"><div class=\"col-md-3\"><div class=\"md-radio pull-left mrleftn17\"><input type=\"radio\" id=\"field_"+count+"_radio_0\" name=\"userform[field_"+count+"][value][checked]\" value=\"0\" class=\"md-radiobtn\"> <label for=\"field_"+count+"_radio_0\"> <span><\/span><span class=\"check\"><\/span> <span class=\"box\"><\/span>Option<\/label><\/div><\/div><div class=\"col-md-6\"><input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][value][values][]\" value=\"\" placeholder=\"Field Value\">	<\/div>	<div class=\"col-md-3\">	<\/div>	<\/div><\/div><\/div>";
						field += "									<a href=\"javascript:;\" class=\"btn green btn-xs\" onclick=\"return add_field_options('"+count+"','selectbox',0);\"><i class=\"fa fa-plus\"><\/i><\/a>";
						field += "								<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "							<\/div>";
					break;	
					case"checkbox":
						var field="";
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Checkbox Group</h4>";
						field += "								<div class=\"col-md-3\">";
						field += "									<div class=\"md-checkbox-list\">";
						field += "										<div class=\"md-checkbox pull-left \">";
						field += "											<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\"> <label for=\"field_"+count+"_required\"> <span><\/span>";
						field += "												<span class=\"check\"><\/span> <span class=\"box\"><\/span>";
						field += "												Required";
						field += "											<\/label>&nbsp;&nbsp;&nbsp;";
						field += "										<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "									<\/div>";
						field += "								<\/div>";
						field += "								<div class=\"col-md-3\">";
						field += set_field_name;
						field += "								<\/div>";
						field += "								<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
						field += "									<div id=\"field_"+count+"_option_container\"><div class=\"form-group form-md-radios border-none\" id=\"form-checkbox-"+count+"-0\">	<div class=\"md-radio-inline border-none\">	<div class=\"col-md-3\">	<div class=\"md-checkbox pull-left mrleftn17\">	<input type=\"checkbox\" id=\"field_"+count+"_radio_0\" name=\"userform[field_"+count+"][value][checked][]\" value=\"0\" class=\"md-check\"> <label for=\"field_"+count+"_radio_0\"> <span><\/span> <span class=\"check\"><\/span> <span class=\"box\"><\/span>Option <\/label><\/div><\/div><div class=\"col-md-6\"><input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][value][values][]\" value=\"\" placeholder=\"Field Value\">	<\/div>	<div class=\"col-md-3\">	<\/div>	<\/div><\/div><\/div>";
						field += "									<a href=\"javascript:;\" class=\"btn green btn-xs\" onclick=\"return add_field_options('"+count+"','checkbox',0);\"><i class=\"fa fa-plus\"><\/i><\/a>";
						field += "								<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "							<\/div>";
					break;	
					case"textarea":
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Paragraph Field</h4>";
						field += "							<div class=\"col-md-3\">";
						field += "								<div class=\"md-checkbox-list\">";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += "										<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\">";
						field += "										<label for=\"field_"+count+"_required\"> <span><\/span> ";
						field += "										<span class=\"check\"><\/span> <span class=\"box\"><\/span> Required<\/label>&nbsp;&nbsp;&nbsp;";
						field += "									<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "								<\/div>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-3\">";
						field += set_field_name;
						field += "							<\/div>";
						field += "							<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "						<\/div>";
					break;
                     case"date-selector":
                        field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">Date Selector(Dropdown)</h4>";
						field += "							<div class=\"col-md-3\">";
						field += "								<div class=\"md-checkbox-list\">";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += "										<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\">";
						field += "										<label for=\"field_"+count+"_required\"> <span><\/span> ";
						field += "										<span class=\"check\"><\/span> <span class=\"box\"><\/span> Required<\/label>&nbsp;&nbsp;&nbsp;";
						field += "									<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "								<\/div>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-3\">";
						field += set_field_name;
						field += "							<\/div>";
						field += "							<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
                        field += "                          Client Date Format <select name=\"userform[field_"+count+"][date_format]\"><option value=\"d-m-Y\">d-m-Y</option><option value=\"m/d/Y\">m/d/Y</option><option value=\"Y-m-d\">Y-m-d</option></select>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "						<\/div>";
					break;
                    case"date-picker-box":
						field += "<div class=\"form-group\" id=\"field_"+count+"\">";
						field += "							<h4 class=\"block\">DatePicker Field</h4>";
						field += "							<div class=\"col-md-3\">";
						field += "								<div class=\"md-checkbox-list\">";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += "										<input type=\"checkbox\" id=\"field_"+count+"_required\" name=\"userform[field_"+count+"][required]\" value=\"1\" class=\"md-check\">";
						field += "										<label for=\"field_"+count+"_required\"> <span><\/span> ";
						field += "										<span class=\"check\"><\/span> <span class=\"box\"><\/span> Required<\/label>&nbsp;&nbsp;&nbsp;";
						field += "									<\/div>";
						field += "									<div class=\"md-checkbox pull-left\">";
						field += system_fields;
						field += "									<\/div>";
						field += "								<\/div>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-3\">";
						field += set_field_name;
						field += "							<\/div>";
						field += "							<div class=\"col-md-5\">";
						field += "								<input type=\"text\" class=\"form-control\" name=\"userform[field_"+count+"][label]\" value=\"\" placeholder='"+client_field_label+"'>";
                        field += "                          Client Date Format <select name=\"userform[field_"+count+"][date_format]\"><option value=\"dd-mm-yyyy\">d-m-Y</option><option value=\"mm/dd/yyyy\">m/d/Y</option><option value=\"yyyy-mm-dd\">Y-m-d</option></select>";
						field += "							<\/div>";
						field += "							<div class=\"col-md-1\">";
						field += "								<a href=\"javascript:;\" class=\"btn btn-icon-only red remove-field\"";
						field += "									onclick=\"remove_field('field_"+count+"');\"><i class=\"fa fa-times\"><\/i><\/a>";
						field += "								<input type=\"hidden\" name=\"userform[field_"+count+"][fieldtype]\" value=\""+field_name+"\">";
						field += "							<\/div>";
						field += "						<\/div>";
					break;
                    
                    
				}
			$("#offer-form-elements").append(field);
		}
	});
	
	

}

/*
 * remove form element
 */
function remove_field(id){
	//alert(id);
	$("#"+id).remove();
}

/*
 * Add radio,checkbox,select box
 */
function add_field_options(id,type,idcount){
	
	var count = $("#field_"+id+"_option_container .form-group").length+idcount+1;
	var strVal="";

	//alert($("#field_"+id+"_option_container #form-md-radios-"+count).length);
	if($("#field_"+id+"_option_container #form-md-"+type+"-"+count).length > 0)
	{
		idcount = count;
		add_field_options(id,type,idcount);
	}
	else
	{
		if(type=="radios")
		{
			strVal += "<div class=\"form-group form-md-radios border-none\" id=\"form-radios-"+id+"-"+count+"\">";
			strVal += "											<div class=\"md-radio-inline border-none\">";
			strVal += "												<div class=\"col-md-3\">";
			strVal += "													<div class=\"md-radio pull-left mrleftn17\">";
			strVal += "														<input type=\"radio\" id=\"field_"+id+"_radio_"+count+"\"";
			strVal += "															name=\"userform[field_"+id+"][value][checked]\" value=\""+(count-1)+"\"";
			strVal += "															class=\"md-radiobtn\"> <label for=\"field_"+id+"_radio_"+count+"\"> <span><\/span>";
			strVal += "															<span class=\"check\"><\/span> <span class=\"box\"><\/span>";
			strVal += "															Option ";
			strVal += "														<\/label>";
			strVal += "													<\/div>";
			strVal += "												<\/div>";
			strVal += "												<div class=\"col-md-6\">";
			strVal += "													<input type=\"text\" class=\"form-control\"";
			strVal += "														name=\"userform[field_"+id+"][value][values][]\" value=\"\"";
			strVal += "														placeholder=\"Field Value\">";
			strVal += "												<\/div>";
			strVal += "												<div class=\"col-md-3\">";
			strVal += "													<a href=\"javascript:;\" class=\"btn btn-icon-only purple\" onclick=\"remove_field('form-radios-"+id+"-"+count+"');\"><i";
			strVal += "														class=\"fa fa-times\"><\/i><\/a>";
			strVal += "	";
			strVal += "												<\/div>";
			strVal += "											<\/div>";
			strVal += "										<\/div>";
		}
		else if(type=="selectbox")
		{
			strVal += "<div class=\"form-group form-md-radios border-none\" id=\"form-selectbox-"+id+"-"+count+"\">";
			strVal += "											<div class=\"md-radio-inline border-none\">";
			strVal += "												<div class=\"col-md-3\">";
			strVal += "													<div class=\"md-radio pull-left mrleftn17\">";
			strVal += "														<input type=\"radio\" id=\"field_"+id+"_radio_"+count+"\"";
			strVal += "															name=\"userform[field_"+id+"][value][checked]\" value=\""+(count-1)+"\"";
			strVal += "															class=\"md-radiobtn\"> <label for=\"field_"+id+"_radio_"+count+"\"> <span><\/span>";
			strVal += "															<span class=\"check\"><\/span> <span class=\"box\"><\/span>";
			strVal += "															Option ";
			strVal += "														<\/label>";
			strVal += "													<\/div>";
			strVal += "												<\/div>";
			strVal += "												<div class=\"col-md-6\">";
			strVal += "													<input type=\"text\" class=\"form-control\"";
			strVal += "														name=\"userform[field_"+id+"][value][values][]\" value=\"\"";
			strVal += "														placeholder=\"Field Value\">";
			strVal += "												<\/div>";
			strVal += "												<div class=\"col-md-3\">";
			strVal += "													<a href=\"javascript:;\" class=\"btn btn-icon-only purple\" onclick=\"remove_field('form-selectbox-"+id+"-"+count+"');\"><i";
			strVal += "														class=\"fa fa-times\"><\/i><\/a>";
			strVal += "	";
			strVal += "												<\/div>";
			strVal += "											<\/div>";
			strVal += "										<\/div>";
		}
		else
		{
			strVal += "<div class=\"form-group form-md-radios border-none\" id=\"form-checkbox-"+id+"-"+count+"\">";
			strVal += "											<div class=\"md-radio-inline border-none\">";
			strVal += "												<div class=\"col-md-3\">";
			strVal += "													<div class=\"md-checkbox pull-left mrleftn17\">";
			strVal += "														<input type=\"checkbox\" id=\"field_"+id+"_radio_"+count+"\"";
			strVal += "															name=\"userform[field_"+id+"][value][checked][]\" value=\""+(count-1)+"\"";
			strVal += "															class=\"md-check\"> <label for=\"field_"+id+"_radio_"+count+"\"> <span><\/span>";
			strVal += "															<span class=\"check\"><\/span> <span class=\"box\"><\/span>";
			strVal += "															Option ";
			strVal += "														<\/label>";
			strVal += "													<\/div>";
			strVal += "												<\/div>";
			strVal += "												<div class=\"col-md-6\">";
			strVal += "													<input type=\"text\" class=\"form-control\"";
			strVal += "														name=\"userform[field_"+id+"][value][values][]\" value=\"\"";
			strVal += "														placeholder=\"Field Value\">";
			strVal += "												<\/div>";
			strVal += "												<div class=\"col-md-3\">";
			strVal += "													<a href=\"javascript:;\" class=\"btn btn-icon-only purple\" onclick=\"remove_field('form-checkbox-"+id+"-"+count+"');\"><i";
			strVal += "														class=\"fa fa-times\"><\/i><\/a>";
			strVal += "	";
			strVal += "												<\/div>";
			strVal += "											<\/div>";
			strVal += "										<\/div>";
		}
		$("#field_"+id+"_option_container").append(strVal);
	}
}

/* ***********************************************************/


$(document).ready(function(){	
	$(".deleteButton").live( "click", function() {
		var link = $(this).attr('link');
		$("#deleteLink").attr('href',link);
		$("#deleteData").modal();
	});
	$(".pauseButton").live( "click", function() {
		var link = $(this).attr('link');
		$("#pauseLink").attr('href',link);
		$("#pauseData").modal();
	});
	$(".unpauseButton").live( "click", function() {
		var link = $(this).attr('link');
		$("#unpauseLink").attr('href',link);
		$("#unpauseData").modal();
	});
	if($.isFunction($.fn.daterangepicker)){
	$('input[name="daterange"]').daterangepicker({
	    "showDropdowns": true,
	    "autoApply": true,
	    "ranges": {
	        "Today": [
	            "2015-09-08T10:49:45.342Z",
	            "2015-09-08T10:49:45.342Z"
	        ],
	        "Yesterday": [
	            "2015-09-07T10:49:45.342Z",
	            "2015-09-07T10:49:45.342Z"
	        ],
	        "Last 7 Days": [
	            "2015-09-02T10:49:45.342Z",
	            "2015-09-08T10:49:45.342Z"
	        ],
	        "Last 30 Days": [
	            "2015-08-10T10:49:45.342Z",
	            "2015-09-08T10:49:45.342Z"
	        ],
	        "This Month": [
	            "2015-08-31T18:30:00.000Z",
	            "2015-09-30T18:29:59.999Z"
	        ],
	        "Last Month": [
	            "2015-07-31T18:30:00.000Z",
	            "2015-08-31T18:29:59.999Z"
	        ]
	    },
	    "locale": {
	        "format": "YYYY-MM-DD",
	        "separator": " TO ",
	        "applyLabel": "Apply",
	        "cancelLabel": "Cancel",
	        "fromLabel": "From",
	        "toLabel": "To",
	        "customRangeLabel": "Custom",
	        "daysOfWeek": [
	            "Su",
	            "Mo",
	            "Tu",
	            "We",
	            "Th",
	            "Fr",
	            "Sa"
	        ],
	        "monthNames": [
	            "January",
	            "February",
	            "March",
	            "April",
	            "May",
	            "June",
	            "July",
	            "August",
	            "September",
	            "October",
	            "November",
	            "December"
	        ],
	        "firstDay": 1
	    },
	    /*"startDate": "09/02/2015",
	    "endDate": "09/08/2015"*/
	}, function(start, end, label) {
	  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
	});
	
	$('#daterange_left').daterangepicker({
	    "showDropdowns": true,
	    "autoApply": true,
	    "opens": "left",
	    "ranges": {
	        "Today": [
	            "2015-09-08T10:49:45.342Z",
	            "2015-09-08T10:49:45.342Z"
	        ],
	        "Yesterday": [
	            "2015-09-07T10:49:45.342Z",
	            "2015-09-07T10:49:45.342Z"
	        ],
	        "Last 7 Days": [
	            "2015-09-02T10:49:45.342Z",
	            "2015-09-08T10:49:45.342Z"
	        ],
	        "Last 30 Days": [
	            "2015-08-10T10:49:45.342Z",
	            "2015-09-08T10:49:45.342Z"
	        ],
	        "This Month": [
	            "2015-08-31T18:30:00.000Z",
	            "2015-09-30T18:29:59.999Z"
	        ],
	        "Last Month": [
	            "2015-07-31T18:30:00.000Z",
	            "2015-08-31T18:29:59.999Z"
	        ]
	    },
	    "locale": {
	        "format": "YYYY-MM-DD",
	        "separator": " TO ",
	        "applyLabel": "Apply",
	        "cancelLabel": "Cancel",
	        "fromLabel": "From",
	        "toLabel": "To",
	        "customRangeLabel": "Custom",
	        "daysOfWeek": [
	            "Su",
	            "Mo",
	            "Tu",
	            "We",
	            "Th",
	            "Fr",
	            "Sa"
	        ],
	        "monthNames": [
	            "January",
	            "February",
	            "March",
	            "April",
	            "May",
	            "June",
	            "July",
	            "August",
	            "September",
	            "October",
	            "November",
	            "December"
	        ],
	        "firstDay": 1
	    },
	    /*"startDate": "09/02/2015",
	    "endDate": "09/08/2015"*/
	}, function(start, end, label) {
	  console.log("New date range selected: ' + start.format('YYYY-MM-DD') + ' to ' + end.format('YYYY-MM-DD') + ' (predefined range: ' + label + ')");
	});
	}
	
	if($.isFunction($.fn.tablesorter)){
	$("#offer_data").tablesorter();
	}
});	

/* ******************/
$('document').ready(function(){
	//if($.isFunction($.fn.spinner)){
		$('#number-spiner1').spinner({value:1, step: 5, min: 0, max: 200});
	//}	 	
});

/* ****Offer data show other details****/
$('document').ready(function(){
	$("#offer_data tbody").on( 'click', 'tr td.details-control', function () {
		var trdetail = $(this).closest('tr').next();
		if(trdetail.is(":visible"))
		{
			//alert('dd');
			$(".trdetails").hide();
			$("tr").removeClass("details");
		}
		else
		{
			//alert('dd11');
			$("tr").removeClass("details");
			$(".trdetails").hide();
			$(this).parent().addClass("details");
			trdetail.show('slow');
		}	
	});
});
/* ************************************/

/* **********CHART SECTION**************/
if($.isFunction($.fn.AmCharts)){
	initSmartChart1();
}
	
var initSmartChart1 = function() {
		
		var chart = AmCharts.makeChart("SmartChart_1", {
		    "theme": "light",
		    "type": "serial",
		    "dataProvider": SmartChart1,
		    "valueAxes": [{
		        "stackType": "3d",
		        "unit": "",
		        "position": "left",
		        "title": "Offer Total",
		    }],
		    "startDuration": 5,
		    "graphs": [{
		        "balloonText": "Offer Submitted : <b>[[value]]</b>",
		        "fillAlphas": 1,
		        "lineAlpha": 1,
		        "title": "2004",
		        "type": "column",
		        "valueField": "submitted"
		    }, {
		        "balloonText": "Offer Displayed: <b>[[value]]</b>",
		        "fillAlphas": 1,
		        "lineAlpha": 1,
		        "title": "2005",
		        "type": "column",
		        "valueField": "displayed"
		    }],
		    "plotAreaFillAlphas": 0.1,
		    "depth3D": 60,
		    "angle": 30,
		    "categoryField": "date_created",
		    "categoryAxis": {
		        "gridPosition": "start"
		    },
		    "export": {
		    	"enabled": true
		     }
		});		
    }
/* *************************************/ 

/* ********** DATE PICKER **********/
if (jQuery().datepicker) {
    $('.date-picker').datepicker({
        autoclose: true,
        format:'yyyy-mm-dd',
        startDate:new Date(),
    });    
}
/* *********************************/

$(document).ready(function(){
//	$(".makeTotal").focusout(function(){
//		var sum = 0;		
//		sum = parseInt($('#so_daily').val())+parseInt($('#so_weekly').val())+parseInt($('#so_monthly').val());
//		$("#display_total").val(sum);
//	});
});

/**************** 30-08-2016 *****************/

 // Get Current Date
 function getDate(){
    var today = new Date();
    var dd = today.getDate();
    var mm = today.getMonth()+1; //January is 0!
    var yyyy = today.getFullYear();
    if(dd<10) {
        dd='0'+dd
    }
    if(mm<10) {
        mm='0'+mm
    }
    return today = yyyy+'-'+mm+'-'+dd;
 }

 // IO Management Block Script
 $(document).on('click','#add_io_management_block',function(){
    var new_number = $('.io_management_block').length+1;
    $('#io_management_container').append('<div class="portlet-body form io_management_block" style="display: block;"> <span class="remove_io_management">X Remove</span><input type="hidden" name="io_data[]" value="" /><div class="form-horizontal form-bordered"> <div class="form-body"> <div class="row" > <div class="col-md-6"> <div class="form-group"> <label class="control-label col-md-3">Date Range</label> <div class="col-md-4"> <div class="input-group input-large date-picker input-daterange" data-date="'+getDate()+'" data-date-format="yyyy-mm-dd"> <input type="text" class="form-control" maxLength="10" value="" name="t_so_start_date_'+new_number+'"> <span class="input-group-addon"> to </span> <input type="text" class="form-control" maxLength="10" value="" name="t_so_end_date_'+new_number+'"> </div> <!-- /input-group --> </div> </div> <div class="form-group"> <label class="control-label col-md-3">EAR</label> <div class="col-md-9"> <div class="input-icon right clearfix"> <input type="text" class="form-control" maxLength="2" value="" name="t_so_ear_'+new_number+'"> </div> </div> </div> <div class="form-group"> <label class="control-label col-md-3">Weekly</label> <div class="col-md-9"> <div class="input-icon right clearfix"> <input type="text" class="form-control makeTotal so_weekly" maxLength="10" id="so_weekly" value="-1" name="t_so_weekly_'+new_number+'"> </div> </div> </div> </div><div class="col-md-6"> <div class="form-group"> <label class="control-label col-md-3">Payout</label> <div class="col-md-9"> <div class="input-group input-icon right clearfix"> <span class="input-group-addon"><i class="fa fa-dollar"></i></span> <input type="text" class="form-control" maxLength="10" value="" name="t_so_payout_'+new_number+'"> </div> </div> </div><div class="form-group"> <label class="control-label col-md-3">Daily</label> <div class="col-md-9"> <div class="input-icon right clearfix"> <input type="text" class="form-control makeTotal so_daily" maxLength="10" id="so_daily" value="-1" name="t_so_daily_'+new_number+'"> </div> </div> </div> <div class="form-group"> <label class="control-label col-md-3">Monthly</label> <div class="col-md-9"> <div class="input-icon right clearfix"> <input type="text" class="form-control makeTotal so_monthly" maxLength="10" id="so_monthly" value="-1" name="t_so_monthly_'+new_number+'" > </div> </div> </div><div class="form-group"> <label class="control-label col-md-3">Total</label> <div class="col-md-9"> <div class="input-icon right clearfix"> <input type="text" class="form-control display_total" name="t_so_total_'+new_number+'" value="-1" id="display_total"> </div> </div> </div> </div> </div> </div> </div> </div> ');
    $('.date-picker').datepicker({
        autoclose: true,
        format:'yyyy-mm-dd',
        startDate:new Date(),
    });  
 });

 if($('.io_management_block').length == 0){
    $('#add_io_management_block').click();
 }

function PopupCenter(url, title, w, h) {
    // Fixes dual-screen position                         Most browsers      Firefox
    var dualScreenLeft = window.screenLeft != undefined ? window.screenLeft : screen.left;
    var dualScreenTop = window.screenTop != undefined ? window.screenTop : screen.top;

    var width = window.innerWidth ? window.innerWidth : document.documentElement.clientWidth ? document.documentElement.clientWidth : screen.width;
    var height = window.innerHeight ? window.innerHeight : document.documentElement.clientHeight ? document.documentElement.clientHeight : screen.height;

    var left = ((width / 2) - (w / 2)) + dualScreenLeft;
    var top = ((height / 2) - (h / 2)) + dualScreenTop;
    var newWindow = window.open(url, title, 'scrollbars=yes, width=' + w + ', height=' + h + ', top=' + top + ', left=' + left);

    // Puts focus on the newWindow
    if (window.focus) {
        newWindow.focus();
    }
}

 $(document).on('click','#run_test',function(){
        PopupCenter($(this).attr('data-href'),'Offer Test','500','500');
 });


 // Remove IO management Block
 $(document).on('click','.remove_io_management',function(){
     if(confirm('Are You Sure?')){
         var id_management_id = $(this).closest('.io_management_block').find('.io_data').val();
         $(this).closest('.io_management_block').remove();       
         if(id_management_id){             
            var removed_io_management_ids = $('#removed_io_management').val();
            $('#removed_io_management').val((removed_io_management_ids ? removed_io_management_ids+','+id_management_id : id_management_id ));
         }
     }
 })


/*********************************/
/**
	 * @Since : 18 November 2016 17:30 PM
	 * @Author : Chirag Rohit
	 * @Description : script for my website/mysite_data_key.php page.
	 */
	 //----------------- start here -----------//
    /**
     * on change of select site
     */
     $(document).on('change','#select_mysite_list',function(){
     	$('.d_new_added_field').html('');
     	$('.d_select_field').html('');
     	if($('#select_mysite_list option:selected').val()!='' && $('#select_mysite_list option:selected').val()!=undefined){
	        $.ajax({
		    		url:base_url+"MySite/getMysitekeyData",
		    		contentType:'application/json',
		    		dataType:'json',
		    		data:{site_id:$('#select_mysite_list option:selected').val()},
		    		success:function(res){		    			        
				    			if(res.flag==1){
				    				var t_site_key='';
				    				var s_site_keyword = '';
				    				var s_system_keyword = '<option value="">Select Key</option>';
				    				var t_exist_keyword =[];
                                    var i_other_date_format_selected = 0;
	                                $.each(res.t_site_keyword,function(key,value){
                                        value['key_value'] = value['key_value'].replace(/\###/g,' ');
                                        if(value['key'] == 'other_date_format'){
                                            i_other_date_format_selected = 1;
                                        }
                                        s_site_keyword +='<tr row_id="'+value['id']+'"><td><div class="d_new_child_field"><label class="control-label">'+value['key_text']+' </td><td>  '+value['key_value']+'</label></td><td><a class="d_remove_key"><i class="fa fa-trash-o"></i></a></div></td></tr>';   
                                            if(value['key_text']!='Other'){            
                                            	t_exist_keyword.push(value['key_text']);                       
                                            }
	                                }); 

                                    $.each(res.t_system_keyword,function(key,value){
                                    	 if($.inArray(value,t_exist_keyword)<0){
                                            s_system_keyword +='<option value="'+key+'">'+value+'</option>';
                                        }
	                                });  
	                                if(t_exist_keyword.length==0){
	                                	$('.d_new_added_field').html('<tr><td colspan="2">No Record Found.</td></tr>');
	                                }else{
	                                	$('.d_new_added_field').append(s_site_keyword); 
	                                }
	                                $('#d_select_field').html(s_system_keyword+(i_other_date_format_selected == 0 ? '<option value="other_date_format">DOB Other Format(Drop Down)</option>' : '' ));   			      
				    			}else{
				    				$('.d_new_added_field').html('<tr><td colspan="2">No Record Found.</td></tr>'); 
				    			}
		    		}
		    	});
        }else{
            $('#d_select_field').html('<option value=""></option>');
            $('.d_new_added_field').html('<tr><td colspan="2">No Record Found.</td></tr>');
        }
        $('.d_new_ajax_block').html('');
     });
    /**
     * script for add new textbox on change of select box
     */
    $(document).on('change','#d_select_field',function(){
        var field_value= $('#d_select_field option:selected').val();
        if(field_value!=''){
            if(field_value == 'other_date_format'){
                $('.d_new_ajax_block').find('.d_new_ajax').remove();
                $('.d_new_ajax_block').html('<div class="d_new_child_field d_new_ajax"><label class="control-label">DOB Day <span class="required"	aria-required="true"> * </span></label><div class="input-icon right"><i class="fa"></i> <input type="text" class="form-control" id="d_key_value" value="" placeholder="dob_day" name="site_name"><label class="control-label">DOB Month <span class="required" aria-required="true"> * </span></label><div class="input-icon right"><i class="fa"></i> <input type="text" class="form-control" id="m_key_value" name="site_name" value="" placeholder="dob_month" ><label class="control-label">DOB Year <span class="required" aria-required="true"> * </span></label><div class="input-icon right"><i class="fa"></i> <input type="text" class="form-control" id="y_key_value" name="site_name" value="" placeholder="dob_year"></div></div>');
            }else{
                $('.d_new_ajax_block').html('<div class="d_new_child_field d_new_ajax"><label class="control-label">Key Name <span class="required"	aria-required="true"> * </span></label><div class="input-icon right"><i class="fa"></i> <input type="text" class="form-control" id="key_value" name="site_name" value=""></div></div>');
            }
        }else{
            //$('.d_new_ajax_block').find('.d_new_ajax').remove();
        }
    });
    /**
     * script for save the keyword in table
     */
     $(document).on('click','#add_keyword',function(){
        var site_id = $('#site_id').val();        
        var other_date_format = '';
        if($('#d_select_field').val() == 'other_date_format'){
            if($('#d_key_value').val() && $('#m_key_value').val() && $('#y_key_value').val()){
                other_date_format += $('#d_key_value').val()+'###'+$('#m_key_value').val()+'###'+$('#y_key_value').val()
            }
        }
     	if(($('#key_value').val() || other_date_format) && $('#d_select_field option:selected').val()!=''){
            var key_value = (other_date_format ? other_date_format : $('#key_value').val() );
			$.ajax({
	    		url:base_url+"MySite/addPostkey",
	    		contentType:'application/json',
	    		dataType:'json',
	    		data:{key:$('#d_select_field option:selected').val(),key_text:$('#d_select_field option:selected').text(),key_value:key_value,site_id:$('#select_mysite_list option:selected').val()},
	    		success:function(res){
			    			if(res.flag==1){
			    				 if($('.d_new_added_field').find('tr td').length==1){
                                         $('.d_new_added_field').html('');      
									}
                                  $('.d_new_added_field').append('<tr row_id="'+res.mysite_data_key_id+'"><td><div class="d_new_child_field"><label class="control-label">'+$('#d_select_field option:selected').text()+' </td><td>  '+key_value.replace(/\###/g,' ')+'</label></td><td><a class="d_remove_key"><i class="fa fa-trash-o"></i></a></div></td></tr>');
			    			      if($('#d_select_field option:selected').text()!='Other'){
			    			      	  $('#d_select_field option:selected').remove();	
			    			 	  }
			    			 	  $('#d_select_field').val('');
			    			      $('.d_new_ajax_block').html('');		    			      
			    			}else{
                                alert('Not added try again.');
			    			}
	    		}
	    	});
		}else{
			$('#key_value').focus();
		}
     });
    /**
     * @since : 19 November 2016 13:11 PM
     * @description : delete keyword from table
     */
     $(document).on('click','.d_remove_key',function(){
     	var closest_tr = $(this).closest('tr')
     	var keyword_id = closest_tr.attr('row_id');
     	if(keyword_id!=''){
	        $.ajax({
		    		url:base_url+"MySite/deleteSitekey",
		    		contentType:'application/json',
		    		dataType:'json',
		    		data:{keyword_id:keyword_id,site_id:$('#select_mysite_list option:selected').val()},
		    		success:function(res){
				    			if(res.flag==1){
	                                closest_tr.remove();  
                                    var t_site_key='';
				    				var s_site_keyword = '';
				    				var s_system_keyword =  '<option value="">Select Key</option>';
				    				var t_exist_keyword =[];
                                    var i_other_date_format_selected = 0;
	                                $.each(res.t_site_keyword,function(key,value){
                                        if(value['key'] == 'other_date_format'){
                                            i_other_date_format_selected = 1;
                                        }
                                        s_site_keyword +='<tr row_id="'+value['id']+'"><td><div class="d_new_child_field"><label class="control-label">'+value['key_text']+' </td><td>  '+value['key_value']+'</label></td><td><a class="d_remove_key"><i class="fa fa-trash-o"></i></a></div></td></tr>';               
                                            t_exist_keyword.push(value['key_text']);                       
                                            
	                                }); 
                                    $.each(res.t_system_keyword,function(key,value){
                                    	 if($.inArray(value,t_exist_keyword)<0){
                                            s_system_keyword +='<option value="'+key+'">'+value+'</option>';
                                        }
	                                });  
                                    //console.log(i_other_date_format_selected)
	                                if(t_exist_keyword.length==0){
	                                	$('.d_new_added_field').html('<tr><td colspan="2">No Record Found.</td></tr>');
	                                }else{
	                                	$('.d_new_added_field').html(s_site_keyword); 
	                                } 
	                                $('#d_select_field').html(s_system_keyword+(i_other_date_format_selected == 0 ? '<option value="other_date_format">DOB Other Format(Drop Down)</option>' : '' ));   		
				    			}else{

				    			}
		    		}
		    	}); 
        } 
     })     
	 //------------------end here-------------//
