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
              var companyForm = $("form[name='company-form']");
              var facebookForm = $("form[name='facebook-form']");
              var linkedinForm = $("form[name='linkedin-form']");
              var twitterForm = $("form[name='twitter-form']");
              var googlForm = $("form[name='google-form']");
              var addressCompanyForm = $("form[name='address_company-form']");

              var urlProcess = 'load/submit.php';
              var urlGetInfo = 'load/get_information.php';

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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){
                    var fullname = data[0][5];
                    $('#fullname').empty();
                    setTimeout(function() {$('#loadingInfo').css("display", "none")}, 300);
                    $('#fullname').append(fullname);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){  
                    var images = data[0]['avatar'];
                    var imagePath = "http://linkrica.com/upload/avatar/";
                    var img = " <img src=" + imagePath + images + " style=\"width:100px; height: 100px; margin-top: 20px;\" alt=\"img\"/>";
                    var img_avatar = " <img class='img-circle' src='" + imagePath + images + "' style=\"width:50px; height:50px;\" />";
                     var img_avatar_top = " <img class='img-circle' src='" + imagePath + images + "' style=\"width:30px; height:30px;\" />";
                    $('#avatar').empty();
                    $('#avatar_result').empty();
                    $('#avatar_top_result').empty();
                    setTimeout(function() {$('#loadingInfo').css("display", "none")}, 300);
                    $('#avatar').append(img_avatar);
                    $('#avatar_result').append(img_avatar);
                    $('#avatar_top_result').append(img_avatar_top);
                    
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){
                    console.log(data);
                    var birthday = data[0]['birthday'];
                    $('#birthday').empty();
                    setTimeout(function() {$('#loadingInfo').css("display", "none")}, 300);
                    $('#birthday').append(birthday);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){       
                    var sex = data[0]['sex'];
                    if (sex == 1) {
                      var strSex = 'Nam';
                    } else {
                      var strSex = 'Nữ';
                    }
                    $('#sex').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#sex').append(strSex);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var email = data[0]['email'];
                   
                    $('#pemail').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#pemail').append(email);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var mobile = "("+ data[0]['mobile_code'] + ") " + data[0]['mobile'];
                   
                    $('#mobile').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#mobile').append(mobile);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var skype = data[0]['skype'];
                   
                    $('#skype').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#skype').append(skype);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var address = data[0]['address'];
                   
                    $('#address').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#address').append(address);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var website = data[0]['website'];
                    $('#website').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#website').append(website);
                  }
                });
              })
             });

             companyForm.submit(function(e) {
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
                $('#company-gear').removeClass('bg-active');
                $('#company-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var company = data[0]['company'];
                    $('#company').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#company').append(company);
                  }
                });
              })
             });

             addressCompanyForm.submit(function(e) {
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
                $('#address_company-gear').removeClass('bg-active');
                $('#address_company-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var address_company = data[0]['address_company'];
                    $('#address_company').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#address_company').append(address_company);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var facebook = data[0]['facebook'];
                    $('#facebook').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#facebook').append(facebook);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var linkedin = data[0]['linkedin'];
                    $('#linkedin').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#linkedin').append(linkedin);
                  }
                });
              })
             });

          googlForm.submit(function(e) {
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
                $('#google-gear').removeClass('bg-active');
                $('#google-disp').fadeOut(300);
                $('.editlink').fadeIn(300).css({'display': 'block'});
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var google = data[0]['google'];
                    $('#google').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#google').append(google);
                  }
                });
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
                var account = $('#accUser').val();
                $.ajax({
                  url: urlGetInfo,
                  type: 'POST',
                  data: "id="+ account,
                  dataType: 'json',    
                  success: function(data){    
                  console.log(data);   
                    var twitter = data[0]['twitter'];
                    $('#twitter').empty();
                    setTimeout(function(){$('#loadingInfo').css("display", "none")}, 300);
                    $('#twitter').append(twitter);
                  }
                });
              })
             });
            });