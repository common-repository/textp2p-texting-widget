<div id="im_view_options">
	<h3 class="hndle"><span><?php _e('TextP2P:- General Settings', 'im-textp2p');?></span></h3>
	<div class="inside">
             <?php
            $options = get_option( 'imtextp2p_options' );
            $im_username  = $options['im_username'];
            $im_secretkey = $options['im_secretkey'];
            $im_ApiListID = $options['im_api_list_id'];
            $im_CacheMessage = get_option( 'im_textp2p_dismiss_cache_message' );
            $listContent = "";
            $Listdata = array();
            $imConnect = "display:inline-block";
            $imConnected = "display:none";
            $imDisconnect = "display:none";
            $imCacheError = "display:none";
            $imReadonly = "";
            $listContentError = "";
            if(!empty($im_username) && !empty($im_secretkey)){
            $Listdata =   imTextP2PGetList($im_username,$im_secretkey,$im_ApiListID,'NoEcho');
              if(count($Listdata)> 0){
                  if($Listdata['code'] == "200"){
                      $listContent = $Listdata['content'] ;
                      $imConnect = "display:none";
                      $imConnected = "display:inline-block";
                      $imDisconnect = "display:inline-block";
                      $imReadonly = "readonly=readonly";
                      if($im_CacheMessage == "SHOW")
                          {
                             $imCacheError = "display:block";
                          }else{
                             $imCacheError = "display:none";
                          }
                  }else{
                      
                      $listContentError = $Listdata['content'] ;
                      $imReadonly = "";
                      $imCacheError = "display:none";
                  }
                  
              }
              
            }

            ?>
         
            <div class="cache-error-message" style="<?php echo $imCacheError ;?>"><?php _e( '<div class="im-textp2p-cache-notice"><b>The TextP2P Plugin has been successfully configured. If you are using Wordpress caching, please be sure to clear it.</b> <a href="https://www.wpbeginner.com/beginners-guide/how-to-clear-your-cache-in-wordpress" target="_blank">Click here for instructions</a><button type="button" class="im-textp2p-cache-dismiss-notice notice-dismiss"><span class="screen-reader-text">Dismiss this notice.</span></button></div>' ); ?></div>
         
            <div class="error-message"><?php echo $listContentError; ?></div>
          <form method="post" action="options.php" name="im-general-setting-form" id="im-general-setting-form">
            <div class="im-loading-img-wrapper">
                <img src="<?php echo plugins_url('/textp2p-texting-widget/assets/images/im-loading.gif'); ?>"  class="im-loading-img"/>
            </div>  

		<table class="form-table">
			<tbody>
                            
				<tr valign="top">
                                    <th valign="top" colspan="2">
                                        <?php _e('Enter your username and API secret key which you will get from <a target="_blank" href="https://app.textp2p.com/application.php">application page</a> inside your TextP2P account. If you do not yet have an account you can sign up for a free trial at <a  target="_blank" href="https://app.textp2p.com/FREE14DayTrial.php">textp2p.com</a>');?>
                                    </th>
				</tr>
                                <tr valign="top">
                                    <th scope="row"><?php _e( 'Username:' ); ?></th>
                                    <td>
                                        
                                        <input name="im_username" id="im-username" value="<?php esc_attr_e( $options['im_username'] ); ?>" type="text"  <?php echo $imReadonly; ?> />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th scope="row"><?php _e( 'API secret Key:' ); ?></th>
                                    <td>
                                        <input name="im_secretkey" id="im-api-secret-key" value="<?php esc_attr_e( $options['im_secretkey'] ); ?>" type="text"  <?php echo $imReadonly; ?> />
                                    </td>
                                </tr>
                                <tr valign="top">
                                    <th></th>
                                    <td >
                                        <span id="im-api-connect" class="button-primary" style="<?php echo $imConnect ;?>" >Connect</span>
                                        <span id="im-api-connected" class="im-connected" style="<?php echo $imConnected ;?>">Connected</span>
                                        <span id="im-api-disconnect" class="im-disconnected" style="<?php echo $imDisconnect ;?>" >Disconnect</span>
                                    </td>
                                </tr>
                               
                                
			</tbody>
		</table> 
                <table class="im-api-response-data form-table">
                    <tbody>
                           <?php echo $listContent; ?>
                    </tbody>
                </table>
            </form>
	</div>
</div>