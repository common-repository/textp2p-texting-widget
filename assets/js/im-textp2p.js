/* Copyright 2019-2024 Harshal Dhingra*/

function imCaptchaV2(){
    console.log('imCaptchaV2 loaded!');
    grecaptcha.render('im-gcaptcha-v2', {
        'sitekey': ImAjax.imGcaptchaSiteKey,
        'theme' : ImAjax.imGcaptchaTheme

    });
}

function imCaptchaV3(){
    console.log('imCaptchaV3 loaded!');
    grecaptcha.execute(ImAjax.imGcaptchaSiteKey, {action: 'submit'}).then(function(token) {  
         let response =  document.getElementById('im-token-generate');
             response.value = token;
    });
    setTimeout(imCaptchaV3, 1000 * 60);
}
jQuery(function(){  

    jQuery("#im-fname, #im-lname, #im-phone, #im-email, #im-msg").on('input',function(){
    var imErrorMsg = jQuery(".im-Error");
    var imInputID = jQuery(this).attr('id') ;
    imErrorMsg.hide(); imErrorMsg.html('');
    if(imInputID === "im-phone"){
        if(jQuery(this).val().length >= 10){ jQuery("#"+imInputID+"-wrapper .Im__TextInput__Checkmark").show(); }else{  jQuery("#"+imInputID+"-wrapper .Im__TextInput__Checkmark").hide(); }
        if(jQuery(this).val().length >= 1){ jQuery("#"+imInputID+"-wrapper .Im__TextInput__TextInputError").hide();}
    } else if(imInputID === "im-email" || imInputID === "im-msg" ){
        if(jQuery(this).val().length >= 1){ jQuery("#"+imInputID+"-wrapper .Im__TextInput__TextInputError").hide();}  
    } else{
    if(jQuery(this).val().length >= 1){ jQuery("#"+imInputID+"-wrapper .Im__TextInput__Checkmark").show(); jQuery("#"+imInputID+"-wrapper .Im__TextInput__TextInputError").hide();}
    if(jQuery(this).val().length < 1){ jQuery("#"+imInputID+"-wrapper .Im__TextInput__Checkmark").hide(); }
    }
    });
    
    // Check Email format
     jQuery("#im-email").on('blur',function(){
         var imErrorMsg = jQuery(".im-Error");
         var imEmail = jQuery(this).val();
         imErrorMsg.hide(); imErrorMsg.html('');
         var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
     if(regex.test(imEmail)) {
         jQuery("#im-email-wrapper .Im__TextInput__Checkmark").show();
         jQuery("#im-email-wrapper .Im__TextInput__TextInputError").hide();
		 jQuery("#im-email-wrapper .Im__TextInput__TextInputError").removeClass('im_invalid');	 
     }else{
         if(imEmail !== ""){
         jQuery("#im-email-wrapper .Im__TextInput__TextInputError").text('Invalid Format');
		 jQuery("#im-email-wrapper .Im__TextInput__TextInputError").addClass('im_invalid');	 
			 
         jQuery("#im-email-wrapper .Im__TextInput__TextInputError").show();
         }
      jQuery("#im-email-wrapper .Im__TextInput__Checkmark").hide();
     }
     });
     
     jQuery('#im-phone').keydown(function (e) {
             var key = e.charCode || e.keyCode || 0 || e.ctrlKey;
             $text = jQuery(this); 
             if (key !== 8 && key !== 9) {
                 if ($text.val().length === 3) {
                     $text.val($text.val() + '-');
                 }
                 if ($text.val().length === 7) {
                     $text.val($text.val() + '-');
                 }
             }
             return (key == 8 || key == 9 || key == 46 || (key >= 48 && key <= 57) || (key >= 96 && key <= 105));
        });
    
    jQuery('.ImContactBubble__Bubble').click(function(){
            var imErrorMsg = jQuery(".im-Error");
            var imThanksText = jQuery(".im__chat__form__block__ThankyouText"); 
            var imChatFormContainer = jQuery(".im__chat__form__block__FormContainer");
            var imFrontFirst = jQuery("#im-fname");
            var imFrontLast = jQuery("#im-lname");
            var imFrontPhone= jQuery("#im-phone");
            var imFrontEmail = jQuery("#im-email");
            var imFrontMsg = jQuery("#im-msg");     
            var imErrorMsg = jQuery(".im-Error");
       
       
       var imFrontFirstError = jQuery("#im-fname-wrapper .Im__TextInput__TextInputError");
       var imFrontLastError  = jQuery("#im-lname-wrapper .Im__TextInput__TextInputError");
       var imFrontPhoneError = jQuery("#im-phone-wrapper .Im__TextInput__TextInputError");
       var imFrontEmailError = jQuery("#im-email-wrapper .Im__TextInput__TextInputError");
       var imFrontMsgError   = jQuery("#im-msg-wrapper .Im__TextInput__TextInputError");
       var imFrontCheckbox = jQuery("#im-fname-wrapper .Im__TextInput__Checkmark, #im-lname-wrapper .Im__TextInput__Checkmark, #im-phone-wrapper .Im__TextInput__Checkmark, #im-email-wrapper .Im__TextInput__Checkmark, #im-msg-wrapper .Im__TextInput__Checkmark");
       
            imFrontFirst.val('');
            imFrontLast.val('');
            imFrontPhone.val('');
            imFrontEmail.val('');
            imFrontMsg.val('');
            imFrontFirstError.hide();
            imFrontLastError.hide();
            imFrontPhoneError.hide();
            imFrontEmailError.hide();
            imFrontMsgError.hide();
            imFrontCheckbox.hide();
            
            imErrorMsg.hide();
            imErrorMsg.html('');
            imThanksText.hide();
            imChatFormContainer.show();
            if(jQuery(this).hasClass('ImContactBubble__Bubble--opened')){
                    jQuery(this).removeClass('ImContactBubble__Bubble--opened');
                    jQuery('.ImContactBubble__CloseSvg').removeClass('ImContactBubble__CloseSvg--opened');
                    jQuery('.ImContactBubble__Icon').removeClass('ImContactBubble__Icon--opened');
                    jQuery('#im__chatting__widget').css('display' , 'none');
                  
            }
            else{
                
                    jQuery(this).addClass('ImContactBubble__Bubble--opened');
                    jQuery('.ImContactBubble__CloseSvg').addClass('ImContactBubble__CloseSvg--opened');
                    jQuery('.ImContactBubble__Icon').addClass('ImContactBubble__Icon--opened');
                    jQuery('#im__chatting__widget').css('display' , 'block');
            }
    });
    
    
    });
    


function imSubmitContact(){
       console.log('textp2p-submit');
       var imFrontFirst = jQuery("#im-fname");
       var imFrontLast = jQuery("#im-lname");
       var imFrontPhone= jQuery("#im-phone");
       var imFrontEmail = jQuery("#im-email");
       var imFrontMsg = jQuery("#im-msg");
       
       var imThanksText = jQuery(".im__chat__form__block__ThankyouText");
       var imChatFormBlock = jQuery(".im__chat__form__block__FormContent");
       var imChatTextInvitation = jQuery(".im__chat__form__block__TextInvitation");
       var imChatFormContainer = jQuery(".im__chat__form__block__FormContainer");
       var imErrorMsg = jQuery(".im-Error");
       
       
       var imFrontFirstError = jQuery("#im-fname-wrapper .Im__TextInput__TextInputError");
       var imFrontLastError  = jQuery("#im-lname-wrapper .Im__TextInput__TextInputError");
       var imFrontPhoneError = jQuery("#im-phone-wrapper .Im__TextInput__TextInputError");
       var imFrontEmailError = jQuery("#im-email-wrapper .Im__TextInput__TextInputError");
       var imFrontMsgError   = jQuery("#im-msg-wrapper .Im__TextInput__TextInputError");
       var imFrontPhoneCheckbox = jQuery("#im-phone-wrapper .Im__TextInput__Checkmark");
       var imFrontGCaptchError   = jQuery("#im-gcaptcha-wrapper .Im__TextInput__TextInputError");
       var imFirstName =  imFrontFirst.val();
       var imLastName =  imFrontLast.val();
       var imPhone =  imFrontPhone.val();
       var imEmail =  imFrontEmail.val();
       var imMessage =  imFrontMsg.val();
       
       var imFirstError = false;
       var imEmailError = false;
       var imPhoneError = false;
       var imLastError = false;
       var imMsgError = false;
       var imGCaptchaError = false;
       var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
        if(imFirstName === ""){ imFrontFirstError.show(); imFirstError = false; }else{ imFrontFirstError.hide(); imFirstError = true;}
        if(imLastName === "" && imFrontEmail.hasClass("im-lname-required")){ imLastError = false; imFrontLastError.show();}else{ imFrontLastError.hide(); imLastError = true; }
        if(imEmail === "" && imFrontEmail.hasClass("im-email-required")){ imEmailError = false; imFrontEmailError.show();}else if(!regex.test(imEmail) && imFrontEmail.hasClass("im-email-required")){ imEmailError = false; imFrontEmailError.text('Invalid Format'); imFrontEmailError.show(); }else{ imFrontEmailError.hide(); imEmailError = true;}
        if(imPhone === ""){ imFrontPhoneError.show(); imPhoneError = false;}else if(imPhone.length < '10'){imPhoneError = false; imFrontPhoneError.text('Too Short'); imFrontPhoneError.show(); imFrontPhoneCheckbox.hide(); }else if(imPhone.length >=13){imPhoneError = false; imFrontPhoneError.text('Too long'); imFrontPhoneError.show(); imFrontPhoneCheckbox.hide(); }else{ imFrontPhoneError.hide(); imPhoneError = true;}   
        if(imMessage === ""){ imFrontMsgError.show(); imMsgError = false;}else{ imFrontMsgError.hide(); imMsgError = true;} 
        
        
        if(ImAjax.imGcaptcha == "on" && ImAjax.imGcaptchaVersion == "v3"){
                console.log('textp2p-v3');
            var imFrontCaptchaV3 = jQuery("#im-token-generate");
            var imCaptchaTokenValue =  imFrontCaptchaV3.val();
                console.log('textp2p v3 response:- '+imCaptchaTokenValue);
        }else if(ImAjax.imGcaptcha == "on" && ImAjax.imGcaptchaVersion == "v2"){
                console.log('textp2p-v2');
            var imCaptchaTokenValue = grecaptcha.getResponse()
                console.log('textp2p v2 response:- '+imCaptchaTokenValue);
        }else{
            imCaptchaTokenValue  = "NO-CAPTCHA";
            imGCaptchaError = true;
        }
        
        if(imCaptchaTokenValue === ""){
            imFrontGCaptchError.show();
            imGCaptchaError = false;
        }else{
            imFrontGCaptchError.hide();
            imGCaptchaError = true;
        } 
        console.log('textp2p-err'+imGCaptchaError);
     
       if(imFirstError === true && imLastError === true && imEmailError === true && imPhoneError === true && imMsgError === true && imGCaptchaError === true && "1"==="1"){
            jQuery('.SendButton').prop('disabled', true);               
            jQuery.ajax({
                 type: "post",
                 url:  ImAjax.ajaxurl,
                 data: {action: "im_textp2p_send_form_data", im_first_name: imFirstName,  im_last_name: imLastName, im_phone: imPhone, im_email: imEmail, im_message: imMessage, im_captcha_token: imCaptchaTokenValue  },
                 beforeSend: function() {

                   },
                 success: function(data){ 

                 var obj = jQuery.parseJSON(data);
                 var imVerifyCode = obj.code;
                 var imContent = obj.content;

                 if(imVerifyCode == "200"){

                     imChatFormContainer.hide();
                     imThanksText.show();
                     imErrorMsg.hide();
                     imErrorMsg.html('');

                 }else{
                     imErrorMsg.show();
                     imErrorMsg.html(imContent);

                 }
                 jQuery('.SendButton').prop('disabled', false);  
                 },                      
                 complete: function(){
                 //    imLoading.hide();
                    jQuery('.SendButton').prop('disabled', false);  
                 },
                 error: function(data){      
                      alert("Error while request..");
                 }
             });

            }else{
             //   alert("Some thing not correct..");
            }

   
    }