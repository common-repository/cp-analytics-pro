<div class="wrap">
<h2>CP Analytics Pro Settings</h2>
</div>
 

  <?php
  
 $wp_cpanalytics = new Cp_Analytics();
if (! function_exists( 'curl_init' ) ) {
	
      esc_html_e('This plugin requires the CURL PHP extension');
    return false;
  }

  if (! function_exists( 'json_decode' ) ) {
    esc_html_e('This plugin requires the JSON PHP extension');
    return false;
  }

  if (! function_exists( 'http_build_query' )) {
    esc_html_e('This plugin requires http_build_query()');
    return false;
  }
 $url = http_build_query( array(
 									'next'			=> $wp_cpanalytics->setting_url(),
									'scope'		   => 'https://www.googleapis.com/auth/analytics',
									'response_type'   => 'code',
									'redirect_uri'    => 'urn:ietf:wg:oauth:2.0:oob',
									'client_id'	   => '391417329737-e0nmq1uiqen2l2iu7bllvo9vl0rsul5u.apps.googleusercontent.com'
									
 								)
 						);
	
 if(isset($_POST["save_code"])){
	 $key_google_token = $_POST["key_google_token"];
	 if($wp_cpanalytics->save_data($key_google_token)){
		 $update_message = '<div id="setting-error-settings_updated" class="updated settings-error below-h2"><p><strong>Access code saved</strong></p></div>';
	 }
 }
	
$postkey_google_token = get_option('post_analytics_token');
if(isset($_POST['clear'])){
	delete_option("google_token");
	delete_option("post_analytics_token");
	 $update_message = '<div id="setting-error-settings_updated" class="updated settings-error below-h2"> 
                        <p><strong>Authentication Cleared login again.</strong></p></div>';
}
//save settings
if(isset($_POST['save_settings_front'])){
	if(isset($_POST['frontend'])) update_option('post_analytics_settings', $_POST["frontend"]);
	update_option('post_analytics_access', $_POST['access_role']);
	if(isset($_POST['disable_front'])){
		update_option('disable_front', 1);
	} else{
		update_option('disable_front', 0);
	}
	if(isset($_POST['showguest'])){
		update_option('post_analytics_showguest', 1);
	} else {
		update_option('post_analytics_showguest', 0);
	}
	$update_message ='<div id="setting-error-setting_updated" class="updated settings-error bewlow-h2"></div>';
}
//save settings
if(isset($_POST['save_settings_admin'])){
	update_option('post_analytics_settings_back', $_POST['back']);
	update_option('post_analytics_access_back', $_POST['access_role_back']);
	$update_message = '<div id="setting-error-settings_updated" class="updated settings-error below-h2">Access code saved and Active </div>';
	
}
//save Profiles
if(isset($_POST["save_profile"])){
	$profile_id					= $_POST['webprofile'];
	$tracking_code				 = $_POST['tracking_code'];
	$web_profile_dashboard  		 = $_POST['data_dashboard'];
	$web_profile_url			   = $_POST[$web_profile_dashboard];
	$webPropertyId				 = $_POST[$profile_id."-1"];
	update_option('webprofile', $profile_id);
	update_option('webPropertyId', $webPropertyId);
	update_option('data_dashboard', $profile_id);
	update_option('webprofile_url', $web_profile_url);
	update_option('tracking_code', $tracking_code);
	if(isset($_POST['ga_code'])){
		update_option('analytics_code', 1);
	} else{
		update_option('analytics_code', 0);
	}
	
	$update_message = '<div id="setting-error-settings_updated" class="updated settings-error below-h2">Access code saved and Active</div>';
}

// Clear Authorization Data
if(isset($_post["clear"])){
	delete_option("webprofile");
	delete_option("data_dashboard");
	delete_option("webprofile_url");
	delete_option("google_token");
	delete_option("welcome_message");
	delete_option("post_analytics_token");
	$update_message = '<div id="setting-error-settings_uodated" class="updated settings-error below-h2"><p><strong>Access code saved</strong></p></div>';
	
}
if(isset($_POST['setting_save'])){
	
	$graph =$_POST['graph'];
	$general =$_POST['general'];
	$rtdata =$_POST['rtdata'];
	$countary = $_POST['countary'];
	$city =$_POST['city'];
	$keywords =$_POST['keywords'];
	$social = $_POST['social'];
	$browser =$_POST['browser'];
	$referrers =$_POST['referrers'];
	$osystem = $_POST['osystem'];
	$mobile =$_POST['mobile'];
	$page =$_POST['page'];
	$itelecom = $_POST['itelecom'];
	$gcompletions = $_POST['gcompletions'];
	
	update_option('graph', $graph);
	update_option('general', $general);
	update_option('rtdata', $rtdata);
	update_option('countary', $countary);
	update_option('city', $city);
	update_option('keywords', $keywords);
	update_option('social', $social);
	update_option('browser', $browser);
	update_option('referrers', $referrers);
	update_option('osystem', $osystem);
	update_option('mobile', $mobile);
	update_option('page', $page);
	update_option('itelecom', $itelecom);
	update_option('gcompletions', $gcompletions);
	
	

}
/*


*/

 if (isset($update_message)) echo $update_message;
  
  if ( isset ( $_GET['tab'] ) ) $wp_cpanalytics->settings_tabs($_GET['tab']); 
  else $wp_cpanalytics->settings_tabs( 'authentication' );

  if ( isset ( $_GET['tab'] ) ) {
  	
    $tab = $_GET['tab']; 
  }
  else {
    $tab = 'authentication';
  }
  
  // Authentication Tab section
  if( $tab == 'authentication' ) {
	  ?>

 <form action="<?php echo  $_SERVER['REQUEST_URI']; ?>" method="post" name="setting" id="setting">
 		<?php
		  if( get_option( 'google_token' ) ) { 
		  
		  $profiles = $wp_cpanalytics->get_analytics_accounts();
		
	   if(isset($profiles)){ 
	   
	   ?>
       <p><?php esc_html_e('Select profiles', 'cpanalytics'); ?></p>
        <table width="1004" class="form-table">
       	<tbody>
        	<tr style="display:none;">
            
            	<th width="115"><?php esc_html_e('Enable tracking Code : ', 'cpanalytics'); ?></th>
            	<td width="877">
                <input type="checkbox" name="ga_code" value="1" checked="checked" sty  />
                </td>
            </tr>
            <tr>
            	<th width="115"><?php esc_html_e('Tracking Code Type :', 'cpanalytics'); ?></th>
                <td width="877" >
                <select name='tracking_code' id='tracking_code'>
                	
                    <option value="ga" <?php selected('ga', get_option('tracking_code')); ?> >Tranditional Code(ga.js)</option>
                </select>
                </td>
            </tr>
            <tr>
            	<th width="115"><?php esc_html_e('Select Url :', 'cpanalytics'); ?></th>
                <td width="877">
                	<select name='webprofile' id='webprofile'>
                    	<?php foreach ($profiles->items as $profile) { ?>
                        	<option value="<?php echo $profile['id']; ?>" <?php selected($profile['id'], get_option('webprofile')); ?>>
							<?php echo $profile['websiteUrl']; ?> - <?php echo $profile['name']; ?></option>
                        
                        <?php } ?>
                    </select>
                    <?php
                    foreach($profiles->items as $profile) { ?>
                    <input type="hidden" name="<?php echo $profile['id']; ?>-1" value="<?php echo $profile['webPropertyId']; ?>" />
                    <?php } ?>
                </td>
            </tr>
           
            <tr>
            	<th></th>
                <td>
            
                <input type="submit" name="save_profile" value="Save Changes" class="button-primary" />
            	<input type="submit" class="button-primary" value="Reset" name="clear" />
                </td>
               
            </tr>
   
     
        </tbody>
        <?php
	   }
		 } ?>
       
       </table>
    <table width="1004" class="form-table">
      <tbody>
     <?php if( get_option( 'google_token' ) ) { ?>
     
      <?php 
      }
      else { ?>
       <tr>
          <th width="115"><?php esc_html_e( 'Authentication:' )?></th>
              <td width="877">
                    <button target="_blank" href="javascript:void(0);" onclick="window.open('https://accounts.google.com/o/oauth2/auth?<?php echo $url ?>','activate','width=700,height=500,toolbar=0,menubar=0,location=0,status=1,scrollbars=1,resizable=1,left=0,top=0');" class="button-primary">Click here</button>
              </td>
        </tr>
        <tr>
              <th><?php esc_html_e('Your Access Code:')?> </th>
              <td>
                <input type="text" name="key_google_token" value="<?php echo $postkey_google_token ?>" style="width:450px;"/>
              </td>
        </tr>
        <tr>
          <th></th>
          <td>
            <p class="submit">
              <input type="submit" class="button-primary" value ="Save Changes" name ="save_code" />
            </p>
          </td>
        </tr>
       <?php } ?>
        
      </tbody>
    </table>
 </form>
  <?php
  }
  
  
  ?>  
