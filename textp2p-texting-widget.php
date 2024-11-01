<?php
/*
Plugin Name: TextP2P Texting Widget
Description: The easiest and best way to allow your site visitors to text your business.
Version: 1.6
Author: TextP2P LLC
Author URI: https://textp2p.com
Developer: Harshal Dhingra
Developer URI: https://www.ignitemediasolution.com
Text Domain: textp2p
Copyright 2019-2024  Harshal Dhingra (email : harshal@ignitemediasolution.com || harshaldhingra18@gmail.com) skype: harshal.dhingra || whatsup: +91 9888434518
*/

if (!defined('ABSPATH')){
    die();
}

define('IM_TEXTP2P_VERSION', '1.6');
define('IM_TEXTP2P_PLUGIN_DIR', untrailingslashit( dirname(__FILE__)));
define('IM_TEXTP2P_ADMIN_SLUG', 'im-textp2p');
define('IM_TEXTP2P_DIR_NAME', plugin_basename(dirname(__FILE__)));
define('IM_TEXTP2P_BASE_URL', plugins_url() . '/' . IM_TEXTP2P_DIR_NAME);
define('IM_TEXTP2P_BASE_PATH', plugin_dir_path( __FILE__ ));
define('IM_TEXTP2P_LIST_API', 'https://app.textp2p.com/zapier/get-lists.php');
define('IM_TEXTP2P_CONTACT_API', 'https://app.textp2p.com/api-textme.php');
define('IM_TEXTP2P_CAPTCHA_VERIFY', 'https://www.google.com/recaptcha/api/siteverify');
define('IM_TEXTP2P_POWEREDBY', '1.6');
define('IM_TEXTP2P_POWEREDBY_LINK', 'https://textp2p.com');
define('IM_TEXTP2P_RECAPTCHA_V2', 'https://www.google.com/recaptcha/admin/create');
define('IM_TEXTP2P_RECAPTCHA_V3', 'https://www.google.com/recaptcha/admin/create');
define('IM_TEXTP2P_AGREE_MSG', 'By submitting you agree to receive text messages at the number provided. Message/data rates apply.');

require_once( IM_TEXTP2P_PLUGIN_DIR. '/inc/im-textp2p-functions.php');

add_action('plugins_loaded', 'imTextP2PStart');
register_activation_hook(__FILE__, 'imTextP2PActivate');

function imTextP2PStart() {
    if(is_admin()){
        add_action('admin_menu', 'imTextP2PAdminMenu');
        add_action('admin_enqueue_scripts','imTextP2PLoadAdminScripts');
      
    }else{
        add_action('wp_enqueue_scripts',  'imTextP2PLoadFrontScripts');
        add_action('wp_enqueue_scripts',  'imTextP2PLoadFrontStyles');
        add_action('wp_footer',  'imTextP2PChatWindowApply');
            
        }
}

function imTextP2PActivate(){

    $options = get_option('imtextp2p_options');
    $options = imTextP2PSetDefaultOptions($options);
    update_option('imtextp2p_options', $options);
    
}
  
function imTextP2PDeactive(){
           // run when deactivate the plugin
}

function imTextP2PChatWindowApply(){
    $options = get_option('imtextp2p_options');
   
    if(isset($options['im_api_list_id']) && !empty($options['im_api_list_id'])){
    echo imTextP2PChatHtml($options);
    }
    
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'imTextP2PActionlinks' );
function imTextP2PActionlinks( $links ) {
   $links[] = '<a href="'. esc_url( get_admin_url(null, 'options-general.php?page='.IM_TEXTP2P_ADMIN_SLUG) ) .'">Settings</a>';
//   $links[] = '<a href="https://www.ignitemediasolution.com/wordpress-plugins-ignite-media" target="_blank">More plugins by Harshal Dhingra</a>';
   return $links;
}

function imTextP2PChatHtml($options){
    $imChatWindow = '';
    
    $imLastNameShow = $options['im_last_name'];
    $imLastNameReq = $options['im_last_name_required'];
    if(isset($imLastNameReq) && $imLastNameReq =="on"){ $imLastNameRequired = 'im-lname-required' ;}else{$imLastNameRequired = '';}
    $imEmailShow = $options['im_email'];
    $imEmailShowReq = $options['im_email_required'];
    if(isset($imEmailShowReq) && $imEmailShowReq =="on"){ $imEmailRequired = 'im-email-required' ;}else{$imEmailRequired = '';}
    $imChatWindow .= '<style>'
            . '.chat__form__block{background-color: '.__($options['im_chat_box_window_background_color']).';}'
            . '.im__chat__form__block__HeaderContainer, .Im__TextInput__Bar::before, .Im__TextInput__Bar::after{background-color:'.__($options['im_chat_box_title_background_color']).';}'
            . '.im__chat__form__block__HeaderContainer p{color:'.__($options['im_chat_box_title_text_color']).'; font-size:'.__($options['im_chat_box_title_font_size']).'px;}'
            . '.SendButton{background-color:'.__($options['im_chat_box_button_background_color']).'; border-color:'.__($options['im_chat_box_button_background_color']).'; color: '.__($options['im_chat_box_button_text_color']).'; font-size:'.__($options['im_chat_box_button_font_size']).'px;}'
            . '.SendButton:hover, .chat__form__block .SendButton:focus{opacity: unset; background-color: '.__($options['im_chat_box_button_background_color']).'; border-color:'.__($options['im_chat_box_button_background_color']).'; }'
            . '.im__chat__footer {background-color: '.__($options['im_chat_box_footer_background_color']).';}'
            . '.TextInput label{color:'.__($options['im_chat_box_form_label_color']).'; font-size: '.__($options['im_chat_box_form_label_font_size']).'px;}'
            . '.im__chat__footer a{color: '.__($options['im_chat_box_footer_text_color']).'; font-size: '.__($options['im_chat_box_footer_text_font_size']).'px;}'
            . '.im__chat__footer a:hover, .Im__TextInput__Textarea:focus~label, .Im__TextInput__Input:focus~label {color:'.__($options['im_chat_box_title_background_color']).';}'
            . '.im_chat_opt_container, .im_chat_opt_container::after{ background-color: '.__($options['im_chat_bubble_girl_background_color']).';}'
            . '.im_chat_opt_container p{ color: '.__($options['im_chat_bubble_girl_text_color']).'; font-size: '.__($options['im_chat_bubble_girl_text_font_size']).'px;}'
            . '.im__chat__form__block__FormContent{padding: 16px 24px 20px; background-color: '.__($options['im_chat_box_form_background_color']).';}'
            . '.im__chat__form__block__FormContent:after{background-color: '.__($options['im_chat_box_form_background_color']).';}'
            . '.im__chat__form__block__TextInvitation{color: '.__($options['im_chat_welcome_message_text_color']).'; background-color: '.__($options['im_chat_welcome_message_background_color']).'; font-size: '.__($options['im_chat_welcome_message_text_font_size']).'px;}'
            . '.im__chat__form__block__ThankyouText{ color: '.__($options['im_chat_box_thankyou_message_text_color']).'; background-color: '.__($options['im_chat_box_thankyou_message_background_color']).'; font-size: '.__($options['im_chat_box_thankyou_message_text_font_size']).'px;}'
            . '.imContactBubble_IN {background-color:'.__($options['im_chat_box_icon_background_color']).';}'
            . '.imContactBubble_IN .imContactBubble_IN_MSG{fill:'.__($options['im_chat_box_message_icon_background_color']).';}';
    
            if($options['im_chat_popup'] == "true"){
                $imChatWindow .= '.ImContactBubble + .im_chat_option_visible{ display: block; }';
            }else{
                $imChatWindow .= '.ImContactBubble:hover + .im_chat_option_visible{ display: block; }';
            }
           $imChatWindow .= '</style>';
    $imChatWindow .= '<div class="chatting__main_wrapper">	 
		<div id="im__chatting__widget">
			<div class="im__chat__Body im__chat__Body--fullHeight">
				<div class="chat__form__block">
					<div class="im__chat__form__block__HeaderContainer">
						<p>'. __($options['im_chat_box_title']).'</p>
					</div>
                                        
					<div class="im__chat__form__block__MainContent">
                                        
						<div class="im__chat__form__block__FormContainer">
							<div class="im__chat__form__block__TextInvitation">
								<div>'. __($options['im_chat_welcome_message']).'</div>
							</div>
							<div class="im__chat__form__block__FormContent">
                                                                <div class="im-Error"></div>
								<div class="TextInput" id="im-fname-wrapper">
									<input class="Im__TextInput__Input" required="" name="im-fname" id="im-fname" type="text" tabindex="1" value="">
									<label for="im-fname">'. __('First Name').'</label>
									<div class="Im__TextInput__Bar"></div>
									<div class="Im__TextInput__Checkmark Im__TextInput__Checkmark--show">
										<svg class="checkmark" viewBox="0 0 52 52" style="width: 18px; height: 18px; border-radius: 50%; display: block; stroke-width: 4; stroke: white; stroke-miterlimit: 10; box-shadow: rgb(0, 189, 148) 0px 0px 0px inset; animation: 0.5s ease-in-out 0.3s 1 normal forwards running fill, 0.3s ease-in-out 0.65s 1 normal forwards running scale, 0.5s ease-in-out 0.5s 1 normal forwards running box-shadow;"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" style="stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 4; stroke-miterlimit: 10; stroke: rgb(0, 189, 148); fill: none; animation: 0.5s cubic-bezier(0.65, 0, 0.45, 1) 0s 1 normal forwards running stroke;"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" style="transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48; animation: 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.5s 1 normal forwards running stroke;"></path></svg>
									</div>
                                                                        <div class="Im__TextInput__TextInputError">'. __('Required').'</div>
								</div>';
                                                                
                                                                if(isset($imLastNameShow) && $imLastNameShow == "true"){
    $imChatWindow .=                                           '<div class="TextInput" id="im-lname-wrapper">
									<input class="Im__TextInput__Input '.$imLastNameRequired.'" required="" name="im-lname" id="im-lname" type="text" tabindex="1" value="">
									<label for="im-lname">'. __('Last Name').'</label>
									<div class="Im__TextInput__Bar"></div>
									<div class="Im__TextInput__Checkmark Im__TextInput__Checkmark--show">
										<svg class="checkmark" viewBox="0 0 52 52" style="width: 18px; height: 18px; border-radius: 50%; display: block; stroke-width: 4; stroke: white; stroke-miterlimit: 10; box-shadow: rgb(0, 189, 148) 0px 0px 0px inset; animation: 0.5s ease-in-out 0.3s 1 normal forwards running fill, 0.3s ease-in-out 0.65s 1 normal forwards running scale, 0.5s ease-in-out 0.5s 1 normal forwards running box-shadow;"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" style="stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 4; stroke-miterlimit: 10; stroke: rgb(0, 189, 148); fill: none; animation: 0.5s cubic-bezier(0.65, 0, 0.45, 1) 0s 1 normal forwards running stroke;"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" style="transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48; animation: 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.5s 1 normal forwards running stroke;"></path></svg>
									</div>
                                                                        <div class="Im__TextInput__TextInputError">'. __('Required').'</div>
								</div>';
                                                                }
                                                                
                                                                if(isset($imEmailShow) && $imEmailShow == "true"){
    $imChatWindow .=                                            '<div class="TextInput" id="im-email-wrapper">
									<input class="Im__TextInput__Input '.$imEmailRequired.'" required="" id="im-email" type="email" tabindex="1" value="">
									<div class="Im__TextInput__TextInputError">'. __('Required').'</div>
									<label for="im-email">'. __('Email').'</label>
									<div class="Im__TextInput__Bar"></div>
									<div class="Im__TextInput__Checkmark Im__TextInput__Checkmark--show">
										<svg class="checkmark" viewBox="0 0 52 52" style="width: 18px; height: 18px; border-radius: 50%; display: block; stroke-width: 4; stroke: white; stroke-miterlimit: 10; box-shadow: rgb(0, 189, 148) 0px 0px 0px inset; animation: 0.5s ease-in-out 0.3s 1 normal forwards running fill, 0.3s ease-in-out 0.65s 1 normal forwards running scale, 0.5s ease-in-out 0.5s 1 normal forwards running box-shadow;"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" style="stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 4; stroke-miterlimit: 10; stroke: rgb(0, 189, 148); fill: none; animation: 0.5s cubic-bezier(0.65, 0, 0.45, 1) 0s 1 normal forwards running stroke;"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" style="transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48; animation: 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.5s 1 normal forwards running stroke;"></path></svg>
									</div>
                                                                        
								</div>';
                                                                }
                                                                
    $imChatWindow .=                                            '<div class="TextInput" id="im-phone-wrapper">
									<input class="Im__TextInput__Input" required="" id="im-phone" type="tel" tabindex="1" value="">
									<label for="im-phone">'. __('Mobile Phone').'</label>
									<div class="Im__TextInput__Bar"></div>
									<div class="Im__TextInput__Checkmark Im__TextInput__Checkmark--show">
										<svg class="checkmark" viewBox="0 0 52 52" style="width: 18px; height: 18px; border-radius: 50%; display: block; stroke-width: 4; stroke: white; stroke-miterlimit: 10; box-shadow: rgb(0, 189, 148) 0px 0px 0px inset; animation: 0.5s ease-in-out 0.3s 1 normal forwards running fill, 0.3s ease-in-out 0.65s 1 normal forwards running scale, 0.5s ease-in-out 0.5s 1 normal forwards running box-shadow;"><circle class="checkmark__circle" cx="26" cy="26" r="25" fill="none" style="stroke-dasharray: 166; stroke-dashoffset: 166; stroke-width: 4; stroke-miterlimit: 10; stroke: rgb(0, 189, 148); fill: none; animation: 0.5s cubic-bezier(0.65, 0, 0.45, 1) 0s 1 normal forwards running stroke;"></circle><path class="checkmark__check" fill="none" d="M14.1 27.2l7.1 7.2 16.7-16.8" style="transform-origin: 50% 50%; stroke-dasharray: 48; stroke-dashoffset: 48; animation: 0.3s cubic-bezier(0.65, 0, 0.45, 1) 0.5s 1 normal forwards running stroke;"></path></svg>
									</div>
                                                                        <div class="Im__TextInput__TextInputError">'. __('Required').'</div>
								</div>
                                                               
								<div class="TextInput" id="im-msg-wrapper">
									<textarea  maxlength="3600" class="Im__TextInput__Textarea " required="" id="im-msg" tabindex="1" style="height: 60px;"></textarea>
									<label for="im-msg">'. __('Message').'</label>
                                                                        <div class="Im__TextInput__TextInputError">'. __('Required').'</div>
									<div class="Im__TextInput__Bar"></div>
								</div>';
								
								if($options['im_gcaptcha'] == "on" && $options['im_gcaptcha_version'] == 'v2') {
									
    $imChatWindow .=                                            '<div class="TextInput" id="im-gcaptcha-wrapper">
                                                                    <div id="im-gcaptcha-v2"></div>
                                                                    <div class="Im__TextInput__TextInputError">'. __('Please Fill the Captcha').'</div>
                                                                  
								</div>';
    
								}elseif ($options['im_gcaptcha'] == "on" && $options['im_gcaptcha_version'] == 'v3') {
    $imChatWindow .=                                            '<div class="TextInput" id="im-gcaptcha-wrapper">
                                                                    <input class="Im__TextInput__Input"  name="g-recaptcha-response" id="im-token-generate" type="hidden" value="">
                                                                    <div class="Im__TextInput__TextInputError">'. __('There are some error, Please contact with site owner.').'</div>
                                                                    
                                                                </div>';
								}

									
	
								

	$imChatWindow .= 		'</div>				
							<div class="im__chat__Legal__notice">
								<p>'. __(IM_TEXTP2P_AGREE_MSG).'</p>
							</div>
							<div class="im__chat__form__block__Center">
								<button onclick="imSubmitContact();" class="SendButton SendButton--incomplete" tabindex="2">'. __($options['im_chat_box_button_text']).'</button>
							</div>
						</div>
                                        
                                                <div class="im__chat__form__block__ThankyouText">
                                                    <div>'. __($options['im_chat_thankyou_message']).'</div>
                                                </div>	
					</div>
					<div class="im__chat__footer">
						<a target="_blank" href="'.esc_html(IM_TEXTP2P_POWEREDBY_LINK).'">'. __('Powered by TextP2P').'</a>
					</div>
				</div>
			</div>
		</div>
                <div class="ImContactBubble">
			<div class="ImContactBubble__Bubble">
				<div class="ImContactBubble__IconContainer">
					<div class="ImContactBubble__CloseSvg">
						<img src="'.IM_TEXTP2P_BASE_URL.'/assets/images/chat_icons/close_icon.png" />
					</div>
					<div class="ImContactBubble__Icon">
                                                <div class="imContactBubble_IN">
                                                <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px"
                                                        viewBox="0 0 499 452.9"  xml:space="preserve">                                               
                                               <path class="imContactBubble_IN_MSG" d="M410,0H89C39.8,0,0,39.8,0,89v152.7c0,49.1,39.8,89,89,89v122.3l120.9-122.3H410c49.1,0,89-39.8,89-89V89
                                                       C499,39.8,459.2,0,410,0z M141.1,200.6c-19.5,0-35.3-15.8-35.3-35.3s15.8-35.3,35.3-35.3s35.3,15.8,35.3,35.3
                                                       S160.6,200.6,141.1,200.6z M249.5,200.6c-19.5,0-35.3-15.8-35.3-35.3S230,130,249.5,130s35.3,15.8,35.3,35.3S269,200.6,249.5,200.6z
                                                        M357.9,200.6c-19.5,0-35.3-15.8-35.3-35.3s15.8-35.3,35.3-35.3s35.3,15.8,35.3,35.3S377.4,200.6,357.9,200.6z"/>
                                               </svg>
                                                </div> 
						
					</div>
				</div>
			</div>
		</div>
		<div class="im_chat_option_visible">
			<div class="im_chat_opt_container">
				<img src="'. __($options['im_chat_bubble_girl_image_url']).'" alt="Avatar" />
				<p>'. __($options['im_chat_bubble_girl_message']).'</p>
			</div>
		</div>
            </div>';
 return $imChatWindow ;   
}

function imTextP2PAdminMenu() {
    
    include (IM_TEXTP2P_BASE_PATH . '/inc/admin/im-textp2p-options.php');
    add_options_page('TextP2P', 'TextP2P', 'manage_options', IM_TEXTP2P_ADMIN_SLUG, 'imTextP2POptionPage');
    
}

function imTextP2PLoadAdminScripts() {
    wp_enqueue_style( 'im-textp2p-admin-settings',IM_TEXTP2P_BASE_URL.'/inc/admin/assets/css/im-textp2p-admin-settings.css', array(),IM_TEXTP2P_VERSION,'all' );
    wp_enqueue_script('im-textp2p-admin-settings', IM_TEXTP2P_BASE_URL . '/inc/admin/assets/js/im-textp2p-admin-settings.js', array( 'jquery','wp-color-picker' ),IM_TEXTP2P_VERSION);
   
    // Css rules for Color Picker
    wp_enqueue_style( 'wp-color-picker' );
        
}

function imTextP2PLoadFrontScripts() {

    if (!wp_script_is( 'jquery', 'queue' )){
        wp_enqueue_script( 'jquery' );
    }

    if (!wp_script_is( 'jquery-ui-core', 'queue' )){
        wp_enqueue_script( 'jquery-ui-core' );
    }
    $options = get_option('imtextp2p_options');
        
    wp_enqueue_script('textp2p-js', IM_TEXTP2P_BASE_URL . '/assets/js/im-textp2p.js',array('jquery'),IM_TEXTP2P_VERSION);
   
    $apiUrlBase = sprintf('https://www.recaptcha.net/recaptcha/api.js?hl=%s', get_locale());
    $jsUrl = sprintf('%s&onload=imCaptchaV2&render=explicit', $apiUrlBase);
    
    if($options['im_gcaptcha'] == "on" && $options['im_gcaptcha_version'] == 'v3'){
        $jsUrl = sprintf('%s&render=%s&onload=imCaptchaV3', $apiUrlBase, $options['im_gcaptcha_site_key']);
    }
 
    if($options['im_gcaptcha'] == "on"){
        wp_enqueue_script('recaptcha-js', $jsUrl, [], IM_TEXTP2P_VERSION);
    }

    wp_localize_script( 'textp2p-js', 'ImAjax', array(
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'security' =>  wp_create_nonce( "sa_security_ajax" ),
        'baseUrl' =>IM_TEXTP2P_BASE_URL,
        'imGcaptchaSiteKey' => $options['im_gcaptcha_site_key'],
        'imGcaptcha' => $options['im_gcaptcha'],
        'imGcaptchaVersion' => $options['im_gcaptcha_version'],
        'imGcaptchaTheme' => $options['im_gcaptcha_theme']
   ) );

  }

function imTextP2PLoadFrontStyles() {

        wp_enqueue_style( 'textp2p-css', IM_TEXTP2P_BASE_URL.'/assets/css/im-textp2p.css', array(),IM_TEXTP2P_VERSION,'all' );

   }
   
function imTextP2PSetDefaultOptions($options){
    
    if (!isset($options['im_chat_box_title']))
        $options['im_chat_box_title'] = 'Text Us';
    if (!isset($options['im_chat_box_title_background_color']))
        $options['im_chat_box_title_background_color'] = '#3c17f7';
    if (!isset($options['im_chat_box_title_text_color']))
        $options['im_chat_box_title_text_color'] = '#FFFFFF';
    if (!isset($options['im_chat_box_title_font_size']))
        $options['im_chat_box_title_font_size'] = '16';
    
    if (!isset($options['im_chat_bubble_girl_image_url']))
        $options['im_chat_bubble_girl_image_url'] = IM_TEXTP2P_BASE_URL.'/assets/images/chat_icons/user_icon.png';
    if (!isset($options['im_chat_bubble_girl_message']))
        $options['im_chat_bubble_girl_message'] = 'Hi there, have a question? Text us here!';
    if (!isset($options['im_chat_bubble_girl_background_color']))
        $options['im_chat_bubble_girl_background_color'] = '#FFFFFF';
    if (!isset($options['im_chat_bubble_girl_text_color']))
        $options['im_chat_bubble_girl_text_color'] = '#333333';
    if (!isset($options['im_chat_bubble_girl_text_font_size']))
        $options['im_chat_bubble_girl_text_font_size'] = '16';
    
     if (!isset($options['im_chat_welcome_message']))
        $options['im_chat_welcome_message'] = 'Enter your information below and our team will text you shortly.';
    if (!isset($options['im_chat_welcome_message_background_color']))
        $options['im_chat_welcome_message_background_color'] = '#e4e9f0';
    if (!isset($options['im_chat_welcome_message_text_color']))
        $options['im_chat_welcome_message_text_color'] = '#333333';
    if (!isset($options['im_chat_welcome_message_text_font_size']))
        $options['im_chat_welcome_message_text_font_size'] = '14';

    if (!isset($options['im_chat_thankyou_message']))
        $options['im_chat_thankyou_message'] = 'Thank you for your submission and our team will text you shortly';
    if (!isset($options['im_chat_box_thankyou_message_background_color']))
        $options['im_chat_box_thankyou_message_background_color'] = '#ffffff';
    if (!isset($options['im_chat_box_thankyou_message_text_color']))
        $options['im_chat_box_thankyou_message_text_color'] = '#333';
    if (!isset($options['im_chat_box_thankyou_message_text_font_size']))
        $options['im_chat_box_thankyou_message_text_font_size'] = '14';
   
   
    if (!isset($options['im_chat_box_window_background_color']))
        $options['im_chat_box_window_background_color'] = '#f5f5f7';
    if (!isset($options['im_chat_box_form_background_color']))
        $options['im_chat_box_form_background_color'] = '#ffffff';
    
    if (!isset($options['im_chat_box_icon_background_color']))
        $options['im_chat_box_icon_background_color'] = '#2fae07';
    if (!isset($options['im_chat_box_message_icon_background_color']))
        $options['im_chat_box_message_icon_background_color'] = '#ffffff';
    
    
    
    if (!isset($options['im_chat_box_button_background_color']))
        $options['im_chat_box_button_background_color'] = '#4c76e0';
    if (!isset($options['im_chat_box_button_text_color']))
        $options['im_chat_box_button_text_color'] = '#ffffff';
    if (!isset($options['im_chat_box_button_font_size']))
        $options['im_chat_box_button_font_size'] = '14';
    if (!isset($options['im_chat_box_button_text']))
        $options['im_chat_box_button_text'] = 'Text Me!';
    
    if (!isset($options['im_chat_box_form_label_color']))
        $options['im_chat_box_form_label_color'] = '#939090';
    if (!isset($options['im_chat_box_form_label_font_size']))
        $options['im_chat_box_form_label_font_size'] = '13';
    
    if (!isset($options['im_chat_box_footer_background_color']))
        $options['im_chat_box_footer_background_color'] = '#FFFFFF';
    if (!isset($options['im_chat_box_footer_text_color']))
        $options['im_chat_box_footer_text_color'] = '#adb6be';
    if (!isset($options['im_chat_box_footer_text_font_size']))
        $options['im_chat_box_footer_text_font_size'] = '12';
    
    if (!isset($options['im_first_name']))
        $options['im_first_name'] = 'true';

    if (!isset($options['im_first_name_required']))
        $options['im_first_name_required'] = 'on';

    if (!isset($options['im_last_name']))
        $options['im_last_name'] = 'false';

    if (!isset($options['im_last_name_required']))
        $options['im_last_name_required'] = '';

    if (!isset($options['im_phone']))
        $options['im_phone'] = 'true';

   if (!isset($options['im_phone_required']))
        $options['im_phone_required'] = 'on';
   
    if (!isset($options['im_message']))
        $options['im_message'] = 'true';
    
    if (!isset($options['im_message_required']))
        $options['im_message_required'] = 'on';
    
    if (!isset($options['im_email']))
        $options['im_email'] = 'false';

    if (!isset($options['im_chat_popup']))
        $options['im_chat_popup'] = 'true';
    
    if (!isset($options['im_email_required']))
        $options['im_email_required'] = '';
    
    if (!isset($options['im_username']))
        $options['im_username'] = '';
 
    if (!isset($options['im_secretkey']))
        $options['im_secretkey'] = '';
     
    if (!isset($options['im_api_list_id']))
        $options['im_api_list_id'] = '';
    
    if (!isset($options['im_gcaptcha_version']))
        $options['im_gcaptcha_version'] = 'v2';
      
    if (!isset($options['im_gcaptcha_theme']))
        $options['im_gcaptcha_theme'] = 'light';
    return $options;
}

