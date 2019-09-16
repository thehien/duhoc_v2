$(document).ready(function(){
	$(".editlink").on("click", function(e){
	  e.preventDefault();
		var dataset = $(this).prev(".datainfo");
		var savebtn = $(this).next(".savebtn");
		var theid   = dataset.attr("id");
		
		//dataset.hide();
		if (theid == 'fullname') {
			$('#fullname-gear').addClass('bg-active');
			$('#fullname-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

		} else if (theid == 'avatar') {
			$('#avatar-gear').addClass('bg-active');
			$('#avatar-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

		} else if (theid == 'birthday') {
			$('#birthday-gear').addClass('bg-active');
			$('#birthday-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

		} else if (theid == 'sex') {
			$('#sex-gear').addClass('bg-active');
			$('#sex-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();


		} else if (theid == 'pemail') {
			$('#pemail-gear').addClass('bg-active');
			$('#pemail-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();


		} else if (theid == 'mobile') {
			$('#mobile-gear').addClass('bg-active');
			$('#mobile-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();


		} else if (theid == 'skype') {
			$('#skype-gear').addClass('bg-active');
			$('#skype-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

		} else if (theid == 'address') {
			$('#address-gear').addClass('bg-active');
			$('#address-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();
		} else if (theid == 'company') {
			$('#company-gear').addClass('bg-active');
			$('#company-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

		} else if (theid == 'address_company') {
			$('#address_company-gear').addClass('bg-active');
			$('#address_company-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();
		} else if (theid == 'website') {
			$('#website-gear').addClass('bg-active');
			$('#website-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

		} else if (theid == 'facebook') {
			$('#facebook-gear').addClass('bg-active');
			$('#facebook-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

		} else if (theid == 'linkedin') {
			$('#linkedin-gear').addClass('bg-active');
			$('#linkedin-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

		} else if (theid == 'twitter') {
			$('#twitter-gear').addClass('bg-active');
			$('#twitter-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

		} else if (theid == 'google') {
			$('#google-gear').addClass('bg-active');
			$('#google-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();


		} else if (theid == 'password') {
			$('#password-gear').addClass('bg-active');
			$('#password-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#language-gear').removeClass('bg-active');
			$('#language-disp').fadeOut(300);
			$('#language,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

		} else if (theid == 'language') {
			$('#language-gear').addClass('bg-active');
			$('#language-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#password-gear').removeClass('bg-active');
			$('#password-disp').fadeOut(300);
			$('#password,.editlink').show();

			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();

		} else if (theid == 'account') {
			$('#account-gear').addClass('bg-active');
			$('#account-disp').fadeIn(300).css({'display': 'flex','justify-content': 'center'});

			$('#password-gear').removeClass('bg-active');
			$('#password-disp').fadeOut(300);
			$('#password,.editlink').show();

			$('#language-gear').removeClass('bg-active');
			$('#language-disp').fadeOut(300);
			$('#language,.editlink').show();
		}

		$(this).css("display", "none");
		savebtn.css("display", "block");
	});

	$(".cancel").on("click", function(e){
		e.preventDefault();
			$('#fullname-gear').removeClass('bg-active');
			$('#fullname-disp').fadeOut(300);
			$('#fullname,.editlink').show();


	    	$('#avatar-gear').removeClass('bg-active');
			$('#avatar-disp').fadeOut(300);
			$('#avatar,.editlink').show();

			$('#birthday-gear').removeClass('bg-active');
			$('#birthday-disp').fadeOut(300);
			$('#birthday,.editlink').show();

			$('#sex-gear').removeClass('bg-active');
			$('#sex-disp').fadeOut(300);
			$('#sex,.editlink').show();

			$('#pemail-gear').removeClass('bg-active');
			$('#pemail-disp').fadeOut(300);
			$('#pemail,.editlink').show();

			$('#mobile-gear').removeClass('bg-active');
			$('#mobile-disp').fadeOut(300);
			$('#mobile,.editlink').show();

			$('#skype-gear').removeClass('bg-active');
			$('#skype-disp').fadeOut(300);
			$('#skype,.editlink').show();

			$('#address-gear').removeClass('bg-active');
			$('#address-disp').fadeOut(300);
			$('#address,.editlink').show();

			$('#company-gear').removeClass('bg-active');
			$('#company-disp').fadeOut(300);
			$('#company,.editlink').show();

			$('#website-gear').removeClass('bg-active');
			$('#website-disp').fadeOut(300);
			$('#website,.editlink').show();

			$('#facebook-gear').removeClass('bg-active');
			$('#facebook-disp').fadeOut(300);
			$('#facebook,.editlink').show();

			$('#linkedin-gear').removeClass('bg-active');
			$('#linkedin-disp').fadeOut(300);
			$('#linkedin,.editlink').show();

			$('#twitter-gear').removeClass('bg-active');
			$('#twitter-disp').fadeOut(300);
			$('#twitter,.editlink').show();

			$('#google-gear').removeClass('bg-active');
			$('#google-disp').fadeOut(300);
			$('#google,.editlink').show();


			$('#address_company-gear').removeClass('bg-active');
			$('#address_company-disp').fadeOut(300);
			$('#address_company,.editlink').show();

	});	
});