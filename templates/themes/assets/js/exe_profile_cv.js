 $(document).ready(function() {
              var fullnameForm = $("form[name='fullname-form']");
              var avatarForm = $("form[name='avatar-form']");
              var birthdayForm = $("form[name='birthday-form']");
              var sexForm = $("form[name='sex-form']");
              var emailForm = $("form[name='pemail-form']");
              var mobileForm = $("form[name='mobile-form']");
              var skypeForm = $("form[name='skype-form']");
              var addressForm = $("form[name='address-form']");
              var websiteForm = $("form[name='website-form']");
              var facebookForm = $("form[name='facebook-form']");
              var linkedinForm = $("form[name='linkedin-form']");
              var twitterForm = $("form[name='twitter-form']");
              var aboutForm = $("form[name='about-form']");
              var nativeLanguageForm = $("form[name='nativeLanguage-form']");
              var FromToLanguageForm = $("form[name='FromToLanguage-form']");
              var SpeedTranslateForm = $("form[name='speedTranslate-form']");
              var experienceForm = $("form[name='experience-form']");
              var specializeForm = $("form[name='specialize-form']");
              var softwareForm = $("form[name='software-form']");
              var serviceForm = $("form[name='service-form']");
              var cvForm = $("form[name='cv-form']");
              
              var urlProcess = 'load/submit_cv.php';
              var urlGetInfo = 'load/get_information_cv.php';

             // full name
             fullnameForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#fullname-gear').removeClass('bg-active');
                $('#fullname-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              });
             });

             // avatar
             avatarForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#avatar-gear').removeClass('bg-active');
                $('#avatar-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

             // birthday
             birthdayForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#birthday-gear').removeClass('bg-active');
                $('#birthday-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

              // sex
              sexForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#sex-gear').removeClass('bg-active');
                $('#sex-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });
              
              // email
              emailForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#pemail-gear').removeClass('bg-active');
                $('#pemail-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

               // mobile
              mobileForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#mobile-gear').removeClass('bg-active');
                $('#mobile-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

               // mobile
             skypeForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#skype-gear').removeClass('bg-active');
                $('#skype-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

             addressForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#address-gear').removeClass('bg-active');
                $('#address-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

             websiteForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#website-gear').removeClass('bg-active');
                $('#website-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

             facebookForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#facebook-gear').removeClass('bg-active');
                $('#facebook-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
                
              })
             });

              linkedinForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#linkedin-gear').removeClass('bg-active');
                $('#linkedin-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
               
              })
             });

          twitterForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#twitter-gear').removeClass('bg-active');
                $('#twitter-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
                
              })
             });

          aboutForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#about-gear').removeClass('bg-active');
                $('#about-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000); 
              })
             });

          nativeLanguageForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#nativeLanguage-gear').removeClass('bg-active');
                $('#nativeLanguage-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

          FromToLanguageForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#FromToLanguage-gear').removeClass('bg-active');
                $('#FromToLanguage-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

          SpeedTranslateForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#speedTranslate-gear').removeClass('bg-active');
                $('#speedTranslate-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

          // avatar
             avatarForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#avatar-gear').removeClass('bg-active');
                $('#avatar-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });


             // avatar
             experienceForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#experience-gear').removeClass('bg-active');
                $('#experience-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

                  // avatar
             specializeForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#specialize-gear').removeClass('bg-active');
                $('#specialize-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

             // avatar
             softwareForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#software-gear').removeClass('bg-active');
                $('#software-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

             // avatar
             serviceForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#service-gear').removeClass('bg-active');
                $('#service-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

               // avatar
             cvForm.submit(function(e) {
               e.preventDefault();
               $.ajax({
                url: urlProcess,
                type: 'POST',
                data: new FormData(this),
                processData: false,
                contentType: false
              })
               .done(function(data){
                $("#loadingInfo").css("display", "block");
                $('#cv-gear').removeClass('bg-active');
                $('#cv-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                setTimeout(function(){location.reload();}, 1000);
              })
             });

             


            });