<?php

    $rows = array();
    $status = "";
    $msg = "";
    
    $gCaptchaOptions = get_option( 'imtextp2p_options' );
    
    $rows[] = array(
        'flag' => 'No main row',
        'desc' => 'reCAPTCHA protects you against spam and other types of automated abuse. With Our reCAPTCHA integration module, you can block abusive form submissions by spam bots. For details, see <a href="'.IM_TEXTP2P_RECAPTCHA_V2.'">reCAPTCHA (v2)</a>, <a href="'.IM_TEXTP2P_RECAPTCHA_V2.'">reCAPTCHA (v3)</a>.'
    );
    
    $rows[] = array(
        'id'      => 'im_gcaptcha',
        'label'   => __('Enable/Disable','im-textp2p'),
        'content' => imCheckbox( 'im_gcaptcha','imtextp2p_options')
    );

    $rows[] = array(
        'id'      => 'im_gcaptcha_version',
        'label'   => __('Select Google Captcha Version','im-textp2p'),
        'content' => imRadioButton( 'im_gcaptcha_version', array(
            'v2'  => __('V2', 'im-textp2p'),
            'v3' => __('V3', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        )
    );
    
   $rows[] = array(
        'id'      => 'im_gcaptcha_site_key',
        'label'   => __('Site Key','im-textp2p'),
        'content' => imTextInput( 'im_gcaptcha_site_key','imtextp2p_options')
    );
   
   $rows[] = array(
        'id'      => 'im_gcaptcha_secret_key',
        'label'   => __('Secret Key','im-textp2p'),
        'content' => imTextInput( 'im_gcaptcha_secret_key','imtextp2p_options')
    );
    
   $rows[] = array(
        'id'      => 'im_gcaptcha_theme',
        'label'   => __('Captcha Theme','im-textp2p'),
        'desc' => 'This setting will work on Captcha V2',
        'content' => imSelect( 'im_gcaptcha_theme', array(
            'light'  => __('Light', 'im-textp2p'),
            'dark' => __('Dark', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        )
    );
    $save_button = '<div class="submitbutton"><input type="submit" class="button-primary" name="submit" value="'.__('Update Captcha Settings','im-textp2p'). '" /></div><br class="clear"/>';
    imPostbox( 'im_textp2p_form_options', __( 'TextP2P:- Captcha Settings', 'im-textp2p' ), imFormTable( $rows ) . $save_button);

