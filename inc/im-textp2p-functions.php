<?php

add_action('wp_ajax_im_textp2p_dismiss_cache_message', 'imTextP2PDismissCacheMessage' );
function imTextP2PDismissCacheMessage(){
    check_ajax_referer( 'im_textp2p_security_cache_ajax', 'csecurity');
    update_option('im_textp2p_dismiss_cache_message','HIDE');
    die();
}

add_action('admin_footer', 'imTextP2PAdminInlineJs');
function imTextP2PAdminInlineJs() {
      $imCacheSecurity = wp_create_nonce( "im_textp2p_security_cache_ajax" );
        echo '  <script>
                    jQuery(function(){
                    
                        jQuery("#im-api-connect").on("click", function(){
                        var imLoading = jQuery(".im-loading-img-wrapper");
                        var imConnectButton = jQuery("#im-api-connect");
                        var imDisConnectButton = jQuery("#im-api-disconnect");
                        var imConnectedButton = jQuery("#im-api-connected");
                        var imUserInput = jQuery("#im-username");
                        var imSecretInput = jQuery("#im-api-secret-key");
                        var imApiResposeWrapper = jQuery(".im-api-response-data tbody");     
                         var imUsername =  imUserInput.val();
                         var imSecretKey =  imSecretInput.val();
                         if (imUsername == "") {
                            alert("Please fill Username");
                            return false;
                          }
                         if (imSecretKey == "") {
                            alert("Please fill SecretKey");
                            return false;
                          }
                            jQuery.ajax({
                                type: "post",
                                url: "'.admin_url( 'admin-ajax.php' ).'",
                                data: {action: "im_textp2p_get_list", im_username: imUsername,  im_secretkey: imSecretKey},
                                beforeSend: function() {
                                imConnectButton.text("Connecting...");                                  
                                imLoading.show();
                                    
                                  },
                                success: function(data){ 
  
                                var obj = jQuery.parseJSON(data);
                                var imVerifyCode = obj.code;
                                var imListContent = obj.content;
                              
                                if(imVerifyCode == "200")
                                {
                                imConnectButton.hide();
                                imConnectedButton.show();
                                imDisConnectButton.show();
                                imUserInput.prop("readonly", true);
                                imSecretInput.prop("readonly", true);
                                imApiResposeWrapper.html(imListContent);
                                imConnectButton.text("Connect");       
                                jQuery(".error-message").html("");
                                jQuery(".cache-error-message").show();
                                }else{
                                 imConnectButton.text("Connect");   
                                 jQuery(".error-message").html(imListContent);
                                }
                                },	              			
                                complete: function(){
                                    imLoading.hide();
                                },
                                error: function(data){      
                                     alert("Error while request..");
                                }
                            });                        
                                    
                        });
                        
                    jQuery("#im-api-disconnect").on("click", function(){
                        var imLoading = jQuery(".im-loading-img-wrapper");
                        var imConnectButton = jQuery("#im-api-connect");
                        var imDisConnectButton = jQuery("#im-api-disconnect");
                        var imConnectedButton = jQuery("#im-api-connected");                        
                        var imUserInput = jQuery("#im-username");
                        var imSecretInput = jQuery("#im-api-secret-key");
                        var imApiResposeWrapper = jQuery(".im-api-response-data tbody");   
                        jQuery.ajax({
                                type: "post",
                                url: "'.admin_url( 'admin-ajax.php' ).'",
                                data: {action: "im_textp2p_get_list_disconnected"},
                                beforeSend: function() {
                                imDisConnectButton.text("Disconnecting...");                                  
                                imLoading.show();
                                    
                                  },
                                success: function(data){ 
  
                                var obj = jQuery.parseJSON(data);
                                var imVerifyCode = obj.code;
                               // var imListContent = obj.content;
                              
                                if(imVerifyCode == "200")
                                {
                                imDisConnectButton.hide();
                                imDisConnectButton.text("Disconnect");  
                                imConnectedButton.hide();
                                imConnectButton.show();
                                imUserInput.prop("readonly", false);
                                imSecretInput.prop("readonly", false);
                                imUserInput.val("");
                                imSecretInput.val("");
                                imApiResposeWrapper.html("");
                                 jQuery(".cache-error-message").fadeOut();
                                jQuery(".error-message").html("");
                                }else{
                                 jQuery(".error-message").html("Something wrong...");
                                }
                                
                                },	              			
                                complete: function(){
                                    imLoading.hide();
                                },
                                error: function(data){      
                                     alert("Error while request..");
                                }
                            });
                        });

                     jQuery(".im-textp2p-cache-dismiss-notice").on("click", function(){
                     
                      });
                      
                    jQuery(".im-textp2p-cache-dismiss-notice").on("click", function(){
                          //  jQuery(".im-textp2p-cache-notice").fadeOut();
                            jQuery(".cache-error-message").fadeOut();
                            jQuery.ajax({
                                type: "post",
                                url: "'.admin_url( 'admin-ajax.php' ).'",
                                data: {action: "im_textp2p_dismiss_cache_message", csecurity: "'.$imCacheSecurity.'"}
                            })                        
                                    
                        }); 
                        
                    });
                </script>';
}



add_action('wp_ajax_im_textp2p_get_list_disconnected', 'imTextP2PGetListDiscoonnected' );
function imTextP2PGetListDiscoonnected(){
    
    $options = get_option('imtextp2p_options');
    $options['im_username'] = "";
    $options['im_secretkey'] = "";
    $options['im_api_list_id'] = "";
    update_option('imtextp2p_options', $options);
    update_option('im_textp2p_dismiss_cache_message','HIDE');
    $apiListReturn['code'] = "200" ;
    
    echo json_encode($apiListReturn);
    die();
    
}
    

add_action('wp_ajax_im_textp2p_get_list', 'imTextP2PGetList' );
function imTextP2PGetList($user="",$secret="",$apilistid="",$echo=""){
  
    if(!empty($user)){ $imUser = $user;}else{ $imUser = sanitize_text_field($_POST['im_username']); }
    if(!empty($secret)){ $imSecret = $secret;}else{ $imSecret = sanitize_text_field($_POST['im_secretkey']); }

    $data = array( 'AUTH_USERNAME' => $imUser , 'AUTH_SECRET' => $imSecret );
    $response = wp_remote_get( IM_TEXTP2P_LIST_API, array( 'body' => $data ) );
    $status = "";
    $msg = "";
    $output = "";
    $apiList = array();
    $apiListReturn = array();
    $options = get_option('imtextp2p_options');
   
    
    if (!is_wp_error($response)) {
        $responseArray = $response['response'];
        $responseCode  = $responseArray['code'];
        
        if($responseCode == "200"){
            $responsedata = json_decode($response['body'], true);
            $options['im_username'] = $imUser;
            $options['im_secretkey'] = $imSecret;
            
            if(count($responsedata) > 0){
                
                foreach($responsedata as $responsedatakey => $responsedatavalue) {
                   $apiList[$responsedatavalue['id']] = $responsedatavalue['name'] ;
                }
            }
           // setting default first form id
            if(!empty($apilistid)){ $imApiListID = $apilistid;}else{ $imApiListID = $responsedata[0]['id']; }
            
            $options['im_api_list_id'] = $imApiListID;  
            if($echo == ""){
            update_option('im_textp2p_dismiss_cache_message','SHOW');
             }
            update_option('imtextp2p_options', $options);
            
            $output .= '<tr valign="top">
                            <th scope="row">'.__( 'Select TextP2P List:' ).'</th>
                            <td>'
                             .imSelect( 'im_api_list_id', $apiList, false, $status, $msg,'imtextp2p_options').
                                '<br />'.
                             __('<b>Select a TextP2P list that new contacts will be added to within TextP2P. New lists can be found and created under the <a target="_blank" href="https://app.textp2p.com/list-management.php">list management</a> screen. </b>').
                            '</td>
                        </tr>
                        <tr valign="top">
                             <td></td>
                            <td scope="row"><input class="button-primary " name="im-list-from-update" id="im-list-form-update" value="Update" type="submit"></td>
                        </tr> ';
            
           $apiListReturn['code'] = $responseCode ;
           $apiListReturn['content'] = $output;
            
        }else{
            $options['im_api_list_id'] = "";
            update_option('imtextp2p_options', $options);
            update_option('im_textp2p_dismiss_cache_message','HIDE');
            $responsedata = json_decode($response['body'],true);
            
            $apiListReturn['code'] = $responseCode ;
            $apiListReturn['content'] = $responsedata['Error'];  
        }
        
    }else{
        
         $apiListReturn['code'] = "501" ;
         $apiListReturn['content'] =  __("Something wrong with server");  
    }
    if($echo == "NoEcho"){
        return $apiListReturn ;
    }else{
      echo json_encode($apiListReturn);
      die();
    }
}

add_action('wp_ajax_im_textp2p_send_form_data', 'imTextP2PSendFormData' );
add_action('wp_ajax_nopriv_im_textp2p_send_form_data', 'imTextP2PSendFormData' );

function imTextP2PSendFormData(){
    
    $options = get_option('imtextp2p_options');
    $imGCaptchaVersion = $options['im_gcaptcha_version'];
    $imUsername  = $options['im_username'];
    $imSecretkey = $options['im_secretkey'];
    $imApiListID = $options['im_api_list_id'];
    $imGCaptchaEnableDisable = $options['im_gcaptcha'];
    $imGCaptchaSecretkey = $options['im_gcaptcha_secret_key'];
    
    // $_POST = array_map( 'stripslashes_deep', $_POST );
    
    $imGCaptchaToken = $_POST['im_captcha_token'];
   
    if($imGCaptchaEnableDisable == "on" && $imGCaptchaToken != "NO-CAPTCHA"){
        
        $ip = $_SERVER['REMOTE_ADDR'];
        
        $postArray = array(
            'secret' => $imGCaptchaSecretkey,
            'response' => $imGCaptchaToken
        );  

        $postJSON = http_build_query($postArray);
        
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, "https://www.google.com/recaptcha/api/siteverify");
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, $postJSON);
        $response = curl_exec($curl);
        if (curl_errno($curl))
            {
        //    echo 'Error:' . curl_error($curl);
            }
                                        
        curl_close($curl);
        
        $curlResponseArray = json_decode($response, true);
          
        $imCaptchaSuccess = $curlResponseArray["success"];
        $imCaptchaScore  = $curlResponseArray["score"];
        $imCaptchaErrorCode = $curlResponseArray['error-codes'][0] ?? null;
       
    }else{
       $imCaptchaSuccess = true;
       $imCaptchaScore = '0.8';
       $imCaptchaErrorCode = null;
    }
 
    if( ($imCaptchaSuccess && floatval($imCaptchaScore ?? 0) > 0.5 && $imGCaptchaVersion == 'v3') || ($imCaptchaSuccess &&  $imGCaptchaVersion == 'v2') ) {
        $idata = array( 'AUTH_USERNAME' => $imUsername, 'AUTH_SECRET' => $imSecretkey , 'listid' => $imApiListID, 'PHONE' => $_POST['im_phone'], 'FNAME' => $_POST['im_first_name'], 'LNAME' => $_POST['im_last_name'], 'EMAIL' => $_POST['im_email'], 'MSG' => $_POST['im_message'] );
        $response = wp_remote_post( IM_TEXTP2P_CONTACT_API, array( 'body' => $idata ) );
        if (!is_wp_error($response)) {
            $responseArray = $response['response'];
            $responseCode = $responseArray['code'];
            $apiListReturn['code'] = $responseCode ;
            $apiListReturn['content'] = $response['body'];

        }else{
            $apiListReturn['code'] = "501" ;
            $apiListReturn['content'] = __('Something wrong with server!', 'im-textp2p');  
        }
        
    } else {
        $apiListReturn['code'] = "501" ;
        $apiListReturn['content'] = __('You are probably not a human!', 'im-textp2p'); 
    }
        
    echo json_encode($apiListReturn);
    die();
    
}

add_action('wp_ajax_im_textp2p_dismiss_message', 'imTextP2PDismissMessage' );
function imTextP2PDismissMessage(){
    check_ajax_referer( 'im_textp2p_security_ajax', 'security');
    update_option('im_textp2p_dismiss_message',IM_TEXTP2P_VERSION);
    die();
}

add_action( 'admin_notices', 'imTextP2PAdminNotice');
function imTextP2PAdminNotice(){
    $security = wp_create_nonce( "im_textp2p_security_ajax" );
    $current_user = wp_get_current_user();

    if(get_option('im_textp2p_dismiss_message') != IM_TEXTP2P_VERSION) {
        echo '<div class="im-textp2p-notice info notice-info notice">';
        echo '<div class="im-testp2p-logo"><img src='.plugins_url('/textp2p-texting-widget/assets/images/chat_icons/textp2p.png').' alt="Textp2p" /></div><div>';
        echo '<p>' . __('Thanks for using <b>TextP2P Texting Widget!</b> ', 'im-textp2p');
        //echo '<p>' . __('<span style="font-weight: bold;">Need Help ? OR Want new site built ?</span> You can hire professional assistance with us: <a target="_blank" href="https://www.ignitemediasolution.com">Harshal Dhingra</a> | You can email us as well <a href="mailto:harshal@ignitemediasolution.com">harshal@ignitemediasolution.com</a>', 'im-gf-ip-block');
        echo '</p><p>';
        echo '<a type="button" class="im-textp2p-settings-button button button-primary" href="'.esc_url( get_admin_url(null, 'options-general.php?page='.IM_TEXTP2P_ADMIN_SLUG) ).'">'. __('Settings', 'im-textp2p').'</a> ';
//        echo '<a type="button" class="im-textp2p-addons-button button button-primary" target="_blank" href="https://www.ignitemediasolution.com/wordpress-plugins-ignite-media">'. __('Check out our Premium Services', 'im-textp2p').'</a>';
        echo '</p>';
        echo '<button type="button" class="im-textp2p-dismiss-notice notice-dismiss"><span class="screen-reader-text">'. __('Dismiss this notice.', 'im-textp2p').'</span></button>';
        echo '</div>';
        echo '</div>';

        echo '  <script>
                    jQuery(function(){
                        jQuery(".im-textp2p-dismiss-notice").on("click", function(){
                            jQuery(".im-textp2p-notice").fadeOut();
                            
                            jQuery.ajax({
                                type: "post",
                                url: "'.admin_url( 'admin-ajax.php' ).'",
                                data: {action: "im_textp2p_dismiss_message", security: "'.$security.'"}
                            })                        
                                    
                        })                    
                    })
                </script>';
     }
    echo '
    <style>    
            .im-testp2p-logo img{ width: 60px; height: 60px;}
            .im-testp2p-logo{ float: left; padding: 10px;}
            .im-textp2p-notice{
                background-color: #3088AC;
                background-image: -webkit-linear-gradient(30deg, #3088AC 50%, #525F7F 50%);
                background-size: cover;
                color: #FFF;
                min-height: 48px;
            }
            .im-textp2p-settings-button{background: #7CD9C8!important;}
            
            .notice-info{
                    border-left-color: #E5E34F;
            }

            .im-textp2p-settings-button:before{
                background: 0 0;
                color: #fff;
                content: "\f111";
                display: block;
                font: 400 16px/20px dashicons;
                speak: none;
                height: 29px;
                text-align: center;
                width: 16px;
                float: left;
                margin-top: 3px;
                margin-right: 4px;
            }
            
            .im-textp2p-addons-button:before{
                background: 0 0;
                color: #fff;
                content: "\f106";
                display: block;
                font: 400 16px/20px dashicons;
                speak: none;
                height: 29px;
                text-align: center;
                width: 16px;
                float: left;
                margin-top: 3px;
                margin-right: 4px;
            }
            .im-textp2p-addons-button, .im-textp2p-addons-button:visited,.im-textp2p-addons-button:active{
                background: #E5E34F !important;
                border-color: #E5E34F !important; 
                color: #fff !important;
                text-decoration: none !important;
                text-shadow: none!important;
                box-shadow: none !important;
            }
            
            .im-textp2p-addons-button:hover{
                background:#E5E34F !important;
                border-color: #E5E34F !important; 
            }
            
            
            .im-textp2p-dismiss-notice{
                top:5px        
            }
            .im-textp2p-dismiss-notice:hover:before, .im-textp2p-dismiss-notice:focus:before, .im-textp2p-dismiss-notice:visited:before{
                color:#E5E34F !important;
            }
                        
            .im-textp2p-notice{
                position:relative
            }
            .im-textp2p-notice a{ color: #E5E34F; font-weight: bold; }
    </style>';

}

/**
* Create a Checkbox input field
*/
function imCheckbox($id,$optionname,$filter="") {
   $options = get_option( $optionname );
 
   $checked = false;
   if ( isset($options[$id]) && $options[$id] == 'on' )
       $checked = true;
   return '<input '.$filter.' type="checkbox" id="'.$id.'" name="'.$id.'"'. checked($checked,true,false).'/>';
}

/**
* Create a radio button input field
*/
function imRadioButton($id, $options, $multiple = false, $state = "", $msg = "",$optionname) {
    $opt = get_option( $optionname );
   
    $output = '';
    foreach ($options as $val => $name) {

     if ($opt[$id] == $val){
          $sel = ' checked="checked"';
     }else{
         $sel = '';
     }
     if ($name == ''){
         $name = $val;
     }

     $output .=   '<input  type="radio" id="'.$id.'" name="'.$id.'" value="'.$val.'"'.$sel.'>'.$name.'&nbsp';
     
    }
   
   return $output;
}
 
/**
* Create a Text input field
*/
function imTextInput($id,$optionname,$imtype="text", $inputText = "" , $attr = array()) {
   $options = get_option( $optionname );
   
   if(!empty($attr)){
        $attr =  implode(' ', array_map(
            function ($v, $k) { return sprintf('%s="%s"', $k, $v); },
            $attr,
            array_keys($attr)
        ));
    }else{
        $attr = "";
    }
            
  $val = '';
   if ( isset( $options[$id] ) )
       $val = $options[$id];
   return '<input class="text" type="'.$imtype.'" id="'.$id.'" name="'.$id.'" size="38" value="'.$val.'"/>'.$inputText;
}

/**
* Create a Text input field
*/
function imTextArea($id,$r,$c,$optionname) {
   $options = get_option( $optionname );
   $val = '';
   if ( isset( $options[$id] ) )
       $val = $options[$id];
   return '<textarea class="textarea" id="'.$id.'" name="'.$id.'" rows="'.$r.'" cols="'.$c.'">'.$val.'</textarea>';
}

/**
 * Create a dropdown field
 */
function imSelect($id, $options, $multiple = false, $state = "", $msg = "",$optionname) {
    $opt = get_option($optionname);
    $output = '<select class="select" name="'.$id.'" id="'.$id.'" '.$state.'>';
    foreach ($options as $val => $name) {
        $sel = '';
        if ($opt[$id] == $val)
            $sel = ' selected="selected"';
        if ($name == '')
            $name = $val;
        $output .= '<option value="'.$val.'"'.$sel.'>'.$name.'</option>';
    }
    $output .= '</select><label><i>'.$msg.'</i></label>';
    return $output;
}
        
/**
 * Create a potbox widget
 */
function imPostbox($id, $title, $content) {
?>
    <div id="<?php echo $id; ?>">
        <h3 class="hndle"><span><?php echo $title; ?></span></h3>
        <div class="inside">
            <?php echo $content; ?>
        </div>
    </div>
<?php
}   


/**
 * Create a form table from an array of rows
 */
function imFormTable($rows) {
    $content = '<table class="form-table">';
    $i = 1;
    foreach ($rows as $row) {
        $class = '';
        if ($i > 1) {
            $class .= 'yst_row';
        }
        if ($i % 2 == 0) {
            $class .= ' even';
        }
        if(!isset($row['flag'])){
        $content .= '<tr id="'.$row['id'].'_row" class="'.$class.'"><th valign="top" scrope="row">';
        if (isset($row['id']) && $row['id'] != '')
            $content .= '<label for="'.$row['id'].'">'.$row['label'].':</label>';
        else
            $content .= '<h2>'.$row['label'].'</h2>';
        $content .= '</th><td valign="top" ';
                if ( !isset($row['content2']) && empty($row['content2']) ) {
             $content .= "colspan=2";         
                }
        $content .= '>';
        $content .= $row['content'];
        $content .= '</td>';
        if ( isset($row['content2']) && !empty($row['content2']) ) {
            $content .= '<td>'.$row['content2'].'</td>';
        }       
            $content .= '</tr>'; 
        }    
        if ( isset($row['desc']) && !empty($row['desc']) ) {
            $content .= '<tr class="'.$class.'"><td colspan="2" class="yst_desc"><small>'.$row['desc'].'</small></td></tr>';
        }

        $i++;
    }
    $content .= '</table>';
    return $content;
}

function imTextLimit( $text, $limit, $finish = ' [&hellip;]') {
    if( strlen( $text ) > $limit ) {
        $text = substr( $text, 0, $limit );
        $text = substr( $text, 0, - ( strlen( strrchr( $text,' ') ) ) );
        $text .= $finish;
    }
    return $text;
}
        
function imGetDateFormat( $date, $format) {
    $timelineDate = explode("-", $date);

    if ($format == 'yy') {
        return $timelineDate[0];
    } elseif ($format == 'yy/mm') {
        return $timelineDate[0]."/".$timelineDate[1];
    } elseif ($format == 'mm/yy') {
        return $timelineDate[1]."/".$timelineDate[0];
    } else  {
        return "";
    }
}  

/**
* @param string|null $error_code
* @return string
*/
function imErrorMessage(?string $error_code): string
{
    switch ($error_code) {
        case 'missing-input-secret':
            return __('The secret parameter is missing.', 'im-textp2p');
        case 'missing-input-response':
            return __('The response parameter is missing.', 'im-textp2p');
        case 'invalid-input-secret':
            return __('The secret parameter is invalid or malformed.', 'im-textp2p');
        case 'invalid-input-response':
            return __('The response parameter is invalid or malformed.', 'im-textp2p');
        case 'bad-request':
            return __('The request is invalid or malformed.', 'im-textp2p');
        case 'timeout-or-duplicate':
            return __('The response is no longer valid: either is too old or has been used previously.', 'im-textp2p');
        default:
            return __('Unknown error.', 'im-textp2p');
    }
}  