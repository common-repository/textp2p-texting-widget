jQuery(document).ready(function() {

    jQuery('#im-admin-tabs').find('a').click(function() {
        jQuery('#im-admin-tabs').find('a').removeClass('nav-tab-active');
        jQuery('.im-tab').removeClass('active');

        var id = jQuery(this).attr('id').replace('-tab','');
        jQuery('#' + id).addClass('active');
        jQuery(this).addClass('nav-tab-active');
    });
    
    // manage checkbox on select
    jQuery('#im_last_name, #im_email').change(function() {
         var imHideValue = jQuery(this).val();
         var imHideID = jQuery(this).attr('id');
         if(imHideValue === "false"){
             jQuery("#"+imHideID+"_required").attr("disabled", true);
             if(jQuery("#"+imHideID+"_required").prop("checked") === true){
                jQuery("#"+imHideID+"_required"). prop("checked", false);
             }
         }else{
             jQuery("#"+imHideID+"_required").removeAttr("disabled");
         }
         
    });
    
    // init
    var active_tab = window.location.hash.replace('#top#','');

    // default to first tab
    if ( active_tab == '' || active_tab == '#_=_') {
        active_tab = jQuery('.im-tab').attr('id');
    }

    jQuery('#' + active_tab).addClass('active');
    jQuery('#' + active_tab + '-tab').addClass('nav-tab-active');
    jQuery( '#im_chat_box_title_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_title_text_color' ).wpColorPicker();
    jQuery( '#im_chat_box_window_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_button_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_button_text_color' ).wpColorPicker();
    jQuery( '#im_chat_box_form_label_color' ).wpColorPicker();
    jQuery( '#im_chat_box_footer_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_footer_text_color' ).wpColorPicker();
    jQuery( '#im_chat_box_form_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_icon_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_message_icon_background_color' ).wpColorPicker();
    jQuery( '#im_chat_bubble_girl_background_color' ).wpColorPicker();
    jQuery( '#im_chat_bubble_girl_text_color' ).wpColorPicker();
    jQuery( '#im_chat_box_thankyou_message_background_color' ).wpColorPicker();
    jQuery( '#im_chat_box_thankyou_message_text_color' ).wpColorPicker();
    jQuery( '#im_chat_welcome_message_background_color' ).wpColorPicker();
    jQuery( '#im_chat_welcome_message_text_color' ).wpColorPicker();




    jQuery('input[name="im_gcaptcha_version"]').on('click', function() {
        jQuery('#im_gcaptcha_site_key').val('');
        jQuery('#im_gcaptcha_secret_key').val('');
    });
  
});



