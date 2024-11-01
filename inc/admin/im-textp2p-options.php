<?php

function imTextP2POptionPage() { 
    
    $options = get_option('imtextp2p_options');
      $_POST = array_map( 'stripslashes_deep', $_POST );
    if (isset($_POST['form_submit'])) {
    
           // $options['im_chat_box_title'] =  $_POST['im_chat_box_title'];
        /*General and View Options*/
        if (array_key_exists('im_chat_box_title', $_POST) && filter_var($_POST['im_chat_box_title'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_title'] =  $_POST['im_chat_box_title'];
        }else{
             $options['im_chat_box_title'] = 'Text Us!';
        }
        if (array_key_exists('im_chat_box_title_background_color', $_POST) && filter_var($_POST['im_chat_box_title_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_title_background_color'] = sanitize_text_field( $_POST['im_chat_box_title_background_color']);
        }else{
             $options['im_chat_box_title_background_color'] = '#3c17f7';
        }
        if (array_key_exists('im_chat_box_title_text_color', $_POST) && filter_var($_POST['im_chat_box_title_text_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_title_text_color'] = sanitize_text_field( $_POST['im_chat_box_title_text_color']);
        }else{
             $options['im_chat_box_title_text_color'] = '#FFFFFF';
        }
        if (array_key_exists('im_chat_box_title_font_size', $_POST) && filter_var($_POST['im_chat_box_title_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_title_font_size'] = sanitize_text_field( $_POST['im_chat_box_title_font_size']);
        }else{
             $options['im_chat_box_title_font_size'] = '16';
        }
        
       // bubble girl settings
        if (array_key_exists('im_chat_bubble_girl_image_url', $_POST) && filter_var($_POST['im_chat_bubble_girl_image_url'], FILTER_SANITIZE_URL)) {
             $options['im_chat_bubble_girl_image_url'] = sanitize_text_field( $_POST['im_chat_bubble_girl_image_url']);
        }else{
             $options['im_chat_bubble_girl_image_url'] = 'Hi there, have a question? Text us here!';
        }
        
        if (array_key_exists('im_chat_bubble_girl_message', $_POST) && filter_var($_POST['im_chat_bubble_girl_message'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_bubble_girl_message'] = sanitize_text_field( $_POST['im_chat_bubble_girl_message']);
        }else{
             $options['im_chat_bubble_girl_message'] = 'Hi there, have a question? Text us here!';
        }
        if (array_key_exists('im_chat_bubble_girl_background_color', $_POST) && filter_var($_POST['im_chat_bubble_girl_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_bubble_girl_background_color'] = sanitize_text_field( $_POST['im_chat_bubble_girl_background_color']);
        }else{
             $options['im_chat_bubble_girl_background_color'] = '#ffffff';
        }
        if (array_key_exists('im_chat_bubble_girl_text_color', $_POST) && filter_var($_POST['im_chat_bubble_girl_text_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_bubble_girl_text_color'] = sanitize_text_field( $_POST['im_chat_bubble_girl_text_color']);
        }else{
             $options['im_chat_bubble_girl_text_color'] = '#333333';
        }
        if (array_key_exists('im_chat_bubble_girl_text_font_size', $_POST) && filter_var($_POST['im_chat_bubble_girl_text_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_bubble_girl_text_font_size'] = sanitize_text_field( $_POST['im_chat_bubble_girl_text_font_size']);
        }else{
             $options['im_chat_bubble_girl_text_font_size'] = '16';
        }
        
        // Welcome message settings
        if (array_key_exists('im_chat_welcome_message', $_POST) && filter_var($_POST['im_chat_welcome_message'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_welcome_message'] = sanitize_text_field( $_POST['im_chat_welcome_message']);
        }else{
             $options['im_chat_welcome_message'] = 'Enter your information below and our team will text you shortly.';
        }
        if (array_key_exists('im_chat_welcome_message_background_color', $_POST) && filter_var($_POST['im_chat_welcome_message_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_welcome_message_background_color'] = sanitize_text_field( $_POST['im_chat_welcome_message_background_color']);
        }else{
             $options['im_chat_welcome_message_background_color'] = '#e4e9f0';
        }
        if (array_key_exists('im_chat_welcome_message_text_color', $_POST) && filter_var($_POST['im_chat_welcome_message_text_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_welcome_message_text_color'] = sanitize_text_field( $_POST['im_chat_welcome_message_text_color']);
        }else{
             $options['im_chat_welcome_message_text_color'] = '#333333';
        }
        if (array_key_exists('im_chat_welcome_message_text_font_size', $_POST) && filter_var($_POST['im_chat_welcome_message_text_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_welcome_message_text_font_size'] = sanitize_text_field( $_POST['im_chat_welcome_message_text_font_size']);
        }else{
             $options['im_chat_welcome_message_text_font_size'] = '14';
        }
        
        
        // Thannk you settings
        if (array_key_exists('im_chat_thankyou_message', $_POST) && filter_var($_POST['im_chat_thankyou_message'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_thankyou_message'] = sanitize_text_field( $_POST['im_chat_thankyou_message']);
        }else{
             $options['im_chat_thankyou_message'] = 'Thank you for your submission and our team will text you shortly.';
        }
        if (array_key_exists('im_chat_box_thankyou_message_background_color', $_POST) && filter_var($_POST['im_chat_box_thankyou_message_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_thankyou_message_background_color'] = sanitize_text_field( $_POST['im_chat_box_thankyou_message_background_color']);
        }else{
             $options['im_chat_box_thankyou_message_background_color'] = '#ffffff';
        }
        if (array_key_exists('im_chat_box_thankyou_message_text_color', $_POST) && filter_var($_POST['im_chat_box_thankyou_message_text_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_thankyou_message_text_color'] = sanitize_text_field( $_POST['im_chat_box_thankyou_message_text_color']);
        }else{
             $options['im_chat_box_thankyou_message_text_color'] = '#333333';
        }
        if (array_key_exists('im_chat_box_thankyou_message_text_font_size', $_POST) && filter_var($_POST['im_chat_box_thankyou_message_text_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_thankyou_message_text_font_size'] = sanitize_text_field( $_POST['im_chat_box_thankyou_message_text_font_size']);
        }else{
             $options['im_chat_box_thankyou_message_text_font_size'] = '14';
        }
        
        
        // window back and form back setings
        if (array_key_exists('im_chat_box_window_background_color', $_POST) && filter_var($_POST['im_chat_box_window_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_window_background_color'] = sanitize_text_field( $_POST['im_chat_box_window_background_color']);
        }else{
             $options['im_chat_box_window_background_color'] = '#f5f5f7';
        }
        if (array_key_exists('im_chat_box_form_background_color', $_POST) && filter_var($_POST['im_chat_box_form_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_form_background_color'] = sanitize_text_field( $_POST['im_chat_box_form_background_color']);
        }else{
             $options['im_chat_box_form_background_color'] = '#ffffff';
        }
        // Chat box Icon Style START
        if (array_key_exists('im_chat_box_icon_background_color', $_POST) && filter_var($_POST['im_chat_box_icon_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_icon_background_color'] = sanitize_text_field( $_POST['im_chat_box_icon_background_color']);
        }else{
             $options['im_chat_box_icon_background_color'] = '#2fae07';
        }
        
        if (array_key_exists('im_chat_box_message_icon_background_color', $_POST) && filter_var($_POST['im_chat_box_message_icon_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_message_icon_background_color'] = sanitize_text_field( $_POST['im_chat_box_message_icon_background_color']);
        }else{
             $options['im_chat_box_message_icon_background_color'] = '#ffffff';
        }
        // CHAT box Icon STyle END
        
        
        // Button settings
         if (array_key_exists('im_chat_box_button_text', $_POST) && filter_var($_POST['im_chat_box_button_text'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_button_text'] = sanitize_text_field( $_POST['im_chat_box_button_text']);
        }else{
             $options['im_chat_box_button_text'] = 'Text Me!';
        }
        if (array_key_exists('im_chat_box_button_background_color', $_POST) && filter_var($_POST['im_chat_box_button_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_button_background_color'] = sanitize_text_field( $_POST['im_chat_box_button_background_color']);
        }else{
             $options['im_chat_box_button_background_color'] = '#4c76e0';
        }
        if (array_key_exists('im_chat_box_button_text_color', $_POST) && filter_var($_POST['im_chat_box_button_text_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_button_text_color'] = sanitize_text_field( $_POST['im_chat_box_button_text_color']);
        }else{
             $options['im_chat_box_button_text_color'] = '#FFFFFF';
        }
        if (array_key_exists('im_chat_box_button_font_size', $_POST) && filter_var($_POST['im_chat_box_button_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_button_font_size'] = sanitize_text_field( $_POST['im_chat_box_button_font_size']);
        }else{
             $options['im_chat_box_button_font_size'] = '14';
        }
        
        // label settings
         if (array_key_exists('im_chat_box_form_label_color', $_POST) && filter_var($_POST['im_chat_box_form_label_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_form_label_color'] = sanitize_text_field( $_POST['im_chat_box_form_label_color']);
        }else{
             $options['im_chat_box_form_label_color'] = '#939090';
        }
        if (array_key_exists('im_chat_box_form_label_font_size', $_POST) && filter_var($_POST['im_chat_box_form_label_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_form_label_font_size'] = sanitize_text_field( $_POST['im_chat_box_form_label_font_size']);
        }else{
             $options['im_chat_box_form_label_font_size'] = '13';
        }
        
        // footer settings
        if (array_key_exists('im_chat_box_footer_background_color', $_POST) && filter_var($_POST['im_chat_box_footer_background_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_footer_background_color'] = sanitize_text_field( $_POST['im_chat_box_footer_background_color']);
        }else{
             $options['im_chat_box_footer_background_color'] = '#FFFFFF';
        }
        if (array_key_exists('im_chat_box_footer_text_color', $_POST) && filter_var($_POST['im_chat_box_footer_text_color'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_footer_text_color'] = sanitize_text_field( $_POST['im_chat_box_footer_text_color']);
        }else{
             $options['im_chat_box_footer_text_color'] = '#adb6be';
        }
        if (array_key_exists('im_chat_box_footer_text_font_size', $_POST) && filter_var($_POST['im_chat_box_footer_text_font_size'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_box_footer_text_font_size'] = sanitize_text_field( $_POST['im_chat_box_footer_text_font_size']);
        }else{
             $options['im_chat_box_footer_text_font_size'] = '12';
        }
       
        // form settings
        // first name
        if (array_key_exists('im_first_name', $_POST) && filter_var($_POST['im_first_name'], FILTER_SANITIZE_STRING)) {
             $options['im_first_name'] = sanitize_text_field( $_POST['im_first_name']);
        }else{
             $options['im_first_name'] = 'true';
        }
        if (array_key_exists('im_first_name_required', $_POST) && filter_var($_POST['im_first_name_required'], FILTER_SANITIZE_STRING)) {
             $options['im_first_name_required'] = sanitize_text_field( $_POST['im_first_name_required']);
        }else{
             $options['im_first_name_required'] = 'on';
        }
        
        // last name
        if (array_key_exists('im_last_name', $_POST) && filter_var($_POST['im_last_name'], FILTER_SANITIZE_STRING)) {
             $options['im_last_name'] = sanitize_text_field( $_POST['im_last_name']);
        }else{
             $options['im_last_name'] = '';
        }
        if (array_key_exists('im_last_name_required', $_POST) && filter_var($_POST['im_last_name_required'], FILTER_SANITIZE_STRING)) {
             $options['im_last_name_required'] = sanitize_text_field( $_POST['im_last_name_required']);
        }else{
             $options['im_last_name_required'] = '';
        }
        
        // phone
        if (array_key_exists('im_phone', $_POST) && filter_var($_POST['im_phone'], FILTER_SANITIZE_STRING)) {
             $options['im_phone'] = sanitize_text_field( $_POST['im_phone']);
        }else{
             $options['im_phone'] = 'true';
        }
        if (array_key_exists('im_phone_required', $_POST) && filter_var($_POST['im_phone_required'], FILTER_SANITIZE_STRING)) {
             $options['im_phone_required'] = sanitize_text_field( $_POST['im_phone_required']);
        }else{
             $options['im_phone_required'] = 'on';
        }
        
        // email
        if (array_key_exists('im_email', $_POST) && filter_var($_POST['im_email'], FILTER_SANITIZE_STRING)) {
             $options['im_email'] = sanitize_text_field( $_POST['im_email']);
        }else{
             $options['im_email'] = '';
        }
        if (array_key_exists('im_email_required', $_POST) && filter_var($_POST['im_email_required'], FILTER_SANITIZE_STRING)) {
             $options['im_email_required'] = sanitize_text_field( $_POST['im_email_required']);
        }else{
             $options['im_email_required'] = '';
        }
       
        // message
        if (array_key_exists('im_message', $_POST) && filter_var($_POST['im_message'], FILTER_SANITIZE_STRING)) {
             $options['im_message'] = sanitize_text_field( $_POST['im_message']);
        }else{
             $options['im_message'] = 'true';
        }
        if (array_key_exists('im_message_required', $_POST) && filter_var($_POST['im_message_required'], FILTER_SANITIZE_STRING)) {
             $options['im_message_required'] = sanitize_text_field( $_POST['im_message_required']);
        }else{
             $options['im_message_required'] = 'on';
        }

        if (array_key_exists('im_chat_popup', $_POST) && filter_var($_POST['im_chat_popup'], FILTER_SANITIZE_STRING)) {
             $options['im_chat_popup'] = sanitize_text_field( $_POST['im_chat_popup']);
        }else{
             $options['im_chat_popup'] = 'false';
        }
        
        // Gen. settings
        if (array_key_exists('im_username', $_POST) && filter_var($_POST['im_username'], FILTER_SANITIZE_STRING)) {
             $options['im_username'] = sanitize_text_field( $_POST['im_username']);
        }else{
             $options['im_username'] = '';
        }
        if (array_key_exists('im_secretkey', $_POST) && filter_var($_POST['im_secretkey'], FILTER_SANITIZE_STRING)) {
             $options['im_secretkey'] = sanitize_text_field( $_POST['im_secretkey']);
        }else{
             $options['im_secretkey'] = '';
        }
        if (array_key_exists('im_api_list_id', $_POST) && filter_var($_POST['im_api_list_id'], FILTER_SANITIZE_STRING)) {
             $options['im_api_list_id'] = sanitize_text_field( $_POST['im_api_list_id']);
        }else{
             $options['im_api_list_id'] = '';
        }

        //Google Captcha Settings

        if (array_key_exists('im_gcaptcha', $_POST) && filter_var($_POST['im_gcaptcha'], FILTER_SANITIZE_STRING)) {
             $options['im_gcaptcha'] = sanitize_text_field( $_POST['im_gcaptcha']);
        }else{
             $options['im_gcaptcha'] = '';
        }

        if (array_key_exists('im_gcaptcha_site_key', $_POST) && filter_var($_POST['im_gcaptcha_site_key'], FILTER_SANITIZE_STRING)) {
             $options['im_gcaptcha_site_key'] = sanitize_text_field( $_POST['im_gcaptcha_site_key']);
        }else{
             $options['im_gcaptcha_site_key'] = '';
        }

        if (array_key_exists('im_gcaptcha_secret_key', $_POST) && filter_var($_POST['im_gcaptcha_secret_key'], FILTER_SANITIZE_STRING)) {
             $options['im_gcaptcha_secret_key'] = sanitize_text_field( $_POST['im_gcaptcha_secret_key']);
        }else{
             $options['im_gcaptcha_secret_key'] = '';
        }

        if (array_key_exists('im_gcaptcha_version', $_POST) && filter_var($_POST['im_gcaptcha_version'], FILTER_SANITIZE_STRING)) {
             $options['im_gcaptcha_version'] = sanitize_text_field( $_POST['im_gcaptcha_version']);
        }else{
             $options['im_gcaptcha_version'] = '';
        }
        
        if (array_key_exists('im_gcaptcha_theme', $_POST) && filter_var($_POST['im_gcaptcha_theme'], FILTER_SANITIZE_STRING)) {
             $options['im_gcaptcha_theme'] = sanitize_text_field( $_POST['im_gcaptcha_theme']);
        }else{
             $options['im_gcaptcha_theme'] = 'light';
        }
        
        update_option('imtextp2p_options', $options);

      
        /*Message*/
        echo '<div class="updated fade"><p>' . __('Settings Saved', 'im-textp2p') . '</p></div>';
    }
   
    
    ?>
	<div class="wrap options-im-textp2p">
        <div class="wrap">
            <div id="icon-themes" class="icon32"></div>
            <h2><?php _e( "TextP2P Setting", 'im-textp2p' ) ?></h2>
			<div class="im-container" id="postbox-container-2">
				<div class="meta-box-sortables ui-sortable">
					<form id="form_data" name="form" method="post">
                                            <input type="hidden" name="form_submit" value="true" />
                                            <h2 class="nav-tab-wrapper" id="im-admin-tabs">
                                                <a class="nav-tab" id="general-tab" href="#top#general"><?php _e( 'General Settings', 'im-textp2p' );?></a>
                                                <a class="nav-tab" id="chat-tab" href="#top#chat"><?php _e( 'Chat Settings', 'im-textp2p' );?></a>
                                                <a class="nav-tab" id="gcaptcha-tab" href="#top#gcaptcha"><?php _e( 'Captcha Settings', 'im-textp2p' );?></a>
                                            </h2>
                                            <div class="tabwrapper">
                                                <div id="general" class="im-tab">
                                                   <?php include(IM_TEXTP2P_BASE_PATH.'/inc/admin/tabs/im-textp2p-general-settings.php'); ?>
                                                </div>
                                                <div id="chat" class="im-tab">
                                                    <?php include(IM_TEXTP2P_BASE_PATH.'/inc/admin/tabs/im-textp2p-chat-settings.php'); ?>
                                                </div>
                                                <div id="gcaptcha" class="im-tab">
                                                    <?php include(IM_TEXTP2P_BASE_PATH.'/inc/admin/tabs/im-textp2p-gcaptcha-settings.php'); ?>
                                                </div>  				   
                                            </div>
					</form>
				</div>
			</div>
                    
		</div>
	</div>	
<?php 
}
