/* Copyright (C) YOOtheme GmbH, YOOtheme Proprietary Use License (http://www.yootheme.com/license) */

jQuery(function($) {

    var config = $('html').data('config') || {};

    // Social buttons
    $('article[data-permalink]').socialButtons(config);
		
	// For language in Menu
	var language = $('#languageCode').val();	
	$('.tm-headerbar .uk-navbar-content ul').css('display', 'inline-flex');
	$('.tm-headerbar .uk-navbar-flip .uk-navbar-content ul .lang-item').css('display', 'inline-block');
	$(".tm-headerbar .uk-navbar-content ul li:nth-child(1) a").html('DE');
	$(".tm-headerbar .uk-navbar-content ul li:nth-child(2) a").html('EN');
	if(language == 'de') {
		$(".tm-headerbar .uk-navbar-content ul li:nth-child(1) a").css('color','#525252').css('font-weight', 'bold');
		$(".uk-navbar-content input").attr("placeholder", "Suche ...");
	} else if(language == 'en') {
		$(".uk-navbar-content input").attr("placeholder", "Search ...");
		$(".tm-headerbar .uk-navbar-content ul li:nth-child(2) a").css('color','#525252').css('font-weight', 'bold');
	}	
	// contact page
	var objContact = $('#sh-contact-page').val();
	if (objContact !== undefined){
		$('.tm-bottom').css('display', 'none');
	}	
	
	$("#sh-btn-contact-footer").click(function(){
		$.ajax({
			type: "POST",
			url: "../wp-content/functions/mail.php",
			beforeSend: function(xhr, event) {
				var validEmail = false;
				var email = $("input[name=txtEmail]").val().trim().toLowerCase();
				var pattern = /^[\w-']+(\.[\w-']+)*@([a-zA-Z0-9]+[a-zA-Z0-9-]+(\.[a-zA-Z0-9-]+)*?\.[a-zA-Z]{2,6}|(\d{1,3}\.){3}\d{1,3})(:\d{4})?$/;
				validEmail = pattern.exec(email);
				if(!validEmail) {
					$('#sh-mail-error').css('display','inline-block');
					xhr.abort(event);
					setTimeout(function(){ 
						$('#sh-mail-error').css('display','none');
					}, 4000);
				}
			},
			data: $('#sh-contact-form-footer').serialize(),
			success: function(data){
				$('#sh-mail-msg').css('display','inline-block');
				$("input[name=txtName]").val('');
				$("input[name=txtEmail]").val('');
				$("textarea[name=txtMessage]").val('');
				setTimeout(function(){ 
					$('#sh-mail-msg').css('display','none');
				}, 4000);
			}
		});
	});	
	
});
