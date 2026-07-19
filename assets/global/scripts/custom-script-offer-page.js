// ----------------- Create Datepicker For every date picker field with its format ---------------------//
$('.date-picker').each(function(){
    var date_format = $(this).attr('date-format');
    $(this).datepicker({
        autoclose: true,
        format:date_format,
        
    });  
});