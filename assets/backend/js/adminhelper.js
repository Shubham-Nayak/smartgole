var booking_ajax_load = false;
jQuery('#ajax-save-form').addClass('ajax-save-form'); //backward compatability
jQuery(document).on('submit', '.ajax-save-form', function(e){
	e.preventDefault();
	var ajax_save_form = jQuery(this);
	var formaction = ajax_save_form.attr('action');
	jQuery('.successformdiv').html('');
	jQuery('.errormessageformdiv').html('');
	jQuery.ajax({
		enctype: 'multipart/form-data',
		url: formaction,
		data: new FormData(this),
		method:'post',
		dataType: 'json', 
		processData: false,
		contentType: false,
		cache: false,
		timeout: 600000,
		beforeSend: function() {
			jQuery('.errormessageformdiv').html('<span style="color:#ff0000;">Please wait while form is submitting... <img src="'+baseurl+'/assets/backend/img/loading.gif"><span>');			
		},
		success : function(response) {
			jQuery('.successformdiv').html();
			jQuery('.errormessageformdiv').html();
			if(response.status) {
				jQuery('.errormessageformdiv').html();
				jQuery('.successformdiv').html(response.message);
				if(response.http_redirect) {
					window.location.href=response.http_redirect;
				}
			} else {
				jQuery('.errormessageformdiv').html(response.message);
				jQuery('.successformdiv').html();
				var alert = $('div.alert[auto-close]');
				alert.each(function() {
					var that = $(this);
					var time_period = that.attr('auto-close');
					window.setTimeout(function() {
						that.fadeTo(500, 0).slideUp(500, function(){
							that.remove(); 
						});
					}, time_period);
				});
			}
		}
	});
});