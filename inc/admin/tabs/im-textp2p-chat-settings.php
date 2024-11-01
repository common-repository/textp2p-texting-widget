<?php

    $rows = array();
    $status = "";
    $msg = "";
    
    $chatOptions = get_option( 'imtextp2p_options' );
    
    $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Title Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
    
    // title style start    
    $rows[] = array(
        'id'      => 'im_chat_box_title',
        'label'   => __('Chat Box Title','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_title','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_title_background_color',
        'label'   => __('Chat Box Title Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_title_background_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_title_text_color',
        'label'   => __('Chat Box Title Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_title_text_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_title_font_size',
        'label'   => __('Chat Box Title Text Font Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_title_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
       // title style end
   
     $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Bubble Girl Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
     
    // Bubble style start
    $rows[] = array(
        'id'      => 'im_chat_bubble_girl_image_url',
        'label'   => __('Chat Box Bubble Girl Image Url','im-textp2p'),
        'content' => imTextInput( 'im_chat_bubble_girl_image_url','imtextp2p_options','url', ' Best size 256PX*256PX (Keep blank for default girl Icon)')
    );
    
     $rows[] = array(
        'id'      => 'im_chat_bubble_girl_message',
        'label'   => __('Chat bubble girl message','im-textp2p'),
        'content' => imTextArea( 'im_chat_bubble_girl_message','2','36','imtextp2p_options')
    );    
    $rows[] = array(
        'id'      => 'im_chat_bubble_girl_background_color',
        'label'   => __('Chat Box Bubble Girl Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_bubble_girl_background_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_bubble_girl_text_color',
        'label'   => __('Chat Box Bubble Girl Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_bubble_girl_text_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_bubble_girl_text_font_size',
        'label'   => __('Chat Box Bubble Girl Text Font Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_bubble_girl_text_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
    // Bubble style end
    
    // Chat welcome message start
    
     $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Welcome Message Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
     
    $rows[] = array(
        'id'      => 'im_chat_welcome_message',
        'label'   => __('Chat Box Welcome Message','im-textp2p'),
        'content' => imTextArea( 'im_chat_welcome_message','2','36','imtextp2p_options')
    );
     
    $rows[] = array(
        'id'      => 'im_chat_welcome_message_background_color',
        'label'   => __('Chat Box Welcome Message Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_welcome_message_background_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_welcome_message_text_color',
        'label'   => __('Chat Box Welcome Message Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_welcome_message_text_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_welcome_message_text_font_size',
        'label'   => __('Chat Box Welcome Message Text Fort Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_welcome_message_text_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
    // welcome message end
    
    // Thanks message style start
    
     $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Thanks Message Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
     
    $rows[] = array(
        'id'      => 'im_chat_thankyou_message',
        'label'   => __('Chat Box Thank You Message','im-textp2p'),
        'content' => imTextArea( 'im_chat_thankyou_message','2','36','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_thankyou_message_background_color',
        'label'   => __('Chat Box Thank You Message Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_thankyou_message_background_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_thankyou_message_text_color',
        'label'   => __('Chat Box Thank You Message Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_thankyou_message_text_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_thankyou_message_text_font_size',
        'label'   => __('Chat Box Thank You Message Text Font Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_thankyou_message_text_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
    // Thanks message style end
   
     $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Background Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
       
    $rows[] = array(
        'id'      => 'im_chat_box_window_background_color',
        'label'   => __('Chat Box Chat Window Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_window_background_color','imtextp2p_options')
    );
        // form style
    $rows[] = array(
        'id'      => 'im_chat_box_form_background_color',
        'label'   => __('Chat Box Chat Form Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_form_background_color','imtextp2p_options')
    );
    
    // Chatbox Icon style StART

    $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Icon Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
       
    $rows[] = array(
        'id'      => 'im_chat_box_icon_background_color',
        'label'   => __('Chat Box Chat Icon Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_icon_background_color','imtextp2p_options')
    );
        // form style
    $rows[] = array(
        'id'      => 'im_chat_box_message_icon_background_color',
        'label'   => __('Chat Box Chat Message Icon Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_message_icon_background_color','imtextp2p_options')
    );
    // Chatbox Icon style end
    
        // button style start
    
     $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Buttons Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
     
    $rows[] = array(
        'id'      => 'im_chat_box_button_text',
        'label'   => __('Button Text','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_button_text','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_button_background_color',
        'label'   => __('Chat Box Button Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_button_background_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_button_text_color',
        'label'   => __('Chat Box Button Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_button_text_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_button_font_size',
        'label'   => __('Chat Box Button Text Font Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_button_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
        // button style end
    
        // label style start
     $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Box Label Style:','im-textp2p'),
        'content'   => __('','im-textp2p'),
    );
    $rows[] = array(
        'id'      => 'im_chat_box_form_label_color',
        'label'   => __('Chat Box Form Label Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_form_label_color','imtextp2p_options')
    );
        $rows[] = array(
        'id'      => 'im_chat_box_form_label_font_size',
        'label'   => __('Chat Box Form Label Fort Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_form_label_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
        // label style end
    
   $rows[] = array(
          'id'      => '',
          'label'   => __('Chat Box Footer Area Style:','im-textp2p'),
          'content'   => __('','im-textp2p'),
      );
        
        // footer style start        
    $rows[] = array(
        'id'      => 'im_chat_box_footer_background_color',
        'label'   => __('Chat Box Footer Background Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_footer_background_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_footer_text_color',
        'label'   => __('Chat Box Footer Text Color','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_footer_text_color','imtextp2p_options')
    );
    $rows[] = array(
        'id'      => 'im_chat_box_footer_text_font_size',
        'label'   => __('Chat Box Footer Text Fort Size','im-textp2p'),
        'content' => imTextInput( 'im_chat_box_footer_text_font_size','imtextp2p_options','number',' px ( Best font size is 10px to 20px )')
    );
        // footer style end
    
    $rows[] = array(
        'id'      => '',
        'label'   => __('Select Chat Fields','im-textp2p'),
        'content'   => __('','im-textp2p'),
        'content2' => '<span style="color:red;">Required*</span>'
    );
    
    $rows[] = array(
        'id'      => 'im_first_name',
        'label'   => __('First Name','im-textp2p'),
        'content' => imSelect( 'im_first_name', array(
            'true'  => __('Show', 'im-textp2p'),
//            'false' => __('Hide', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        ),
        'content2' => imCheckbox( 'im_first_name_required','imtextp2p_options','disabled')
    );
    
    $im_last_name_val = $chatOptions['im_last_name'];
    if($im_last_name_val == "false"){$imLastDisable = "disabled"; }else{$imLastDisable = "";}
    $rows[] = array(
        'id'      => 'im_last_name',
        'label'   => __('Last Name','im-textp2p'),
        'content' => imSelect( 'im_last_name', array(
            'true'  => __('Show', 'im-textp2p'),
            'false' => __('Hide', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        ),
        'content2' => imCheckbox( 'im_last_name_required','imtextp2p_options',$imLastDisable)
    );
    
    $rows[] = array(
        'id'      => 'im_phone',
        'label'   => __('Phone','im-textp2p'),
        'content' => imSelect( 'im_phone', array(
            'true'  => __('Show', 'im-textp2p'),
//            'false' => __('Hide', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        ),
        'content2' => imCheckbox( 'im_phone_required','imtextp2p_options','disabled')
    );
    
    $im_email_val = $chatOptions['im_email'];
    if($im_email_val == "false"){$imEmailDisable = "disabled"; }else{$imEmailDisable = "";}
    $rows[] = array(
        'id'      => 'im_email',
        'label'   => __('Email','im-textp2p'),
        'content' => imSelect( 'im_email', array(
            'true'  => __('Show', 'im-textp2p'),
            'false' => __('Hide', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        ),
        'content2' => imCheckbox( 'im_email_required','imtextp2p_options',$imEmailDisable)
    );
    
    $rows[] = array(
        'id'      => 'im_message',
        'label'   => __('Message','im-textp2p'),
        'content' => imSelect( 'im_message', array(
            'true'  => __('Show', 'im-textp2p'),
//            'false' => __('Hide', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        ),
        'content2' => imCheckbox( 'im_message_required','imtextp2p_options', 'disabled')
    );

    $rows[] = array(
        'id'      => '',
        'label'   => __('Chat Window Popup Visible','im-textp2p'),
        'content'   => __('','im-textp2p')
    );
    
    $rows[] = array(
        'id'      => 'im_chat_popup',
        'label'   => __('Popup Message','im-textp2p'),
        'content' => imSelect( 'im_chat_popup', array(
            'true'  => __('Always Visible', 'im-textp2p'),
            'false' => __('Visible On Hover', 'im-textp2p'),
        ), false, $status, $msg,'imtextp2p_options'
        )
    );
   
      
    $save_button = '<div class="submitbutton"><input type="submit" class="button-primary" name="submit" value="'.__('Update Chat Settings','im-textp2p'). '" /></div><br class="clear"/>';
    imPostbox( 'im_textp2p_form_options', __( 'TextP2P:- Chat Settings', 'im-textp2p' ), imFormTable( $rows ) . $save_button);

