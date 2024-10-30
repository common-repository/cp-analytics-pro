<?php
/**
Plugin Name:CP Analytics Pro
Description: CP Analytics Pro is the cleanest analytics tracker. It lets you check the real time data on your website and other statistics through graphs and tables. You can download the plugin for free and power the performance of your website directly through the dashboard.
Version:1.0.0
Authour:
Authour URI:
*/
define('CPA_FILE_PATH', dirname(__FILE__));
define('CPA_DIR', basename(CPA_FILE_PATH));
define('CPA_URL_PATH', str_replace(array('http:', 'https:'), '',  untrailingslashit(plugins_url('/', __FILE__))));
define('CPA_GOOGLE_PATH', dirname(__FILE__) . '/google/');
define('CPA_JS_PATH', CPA_URL_PATH . '/assets/js/');
define('CPA_CSS_PATH', CPA_URL_PATH . '/assets/css/');
define('CPA_IMG_PATH', CPA_URL_PATH . '/assets/imag/');

class Cp_Analytics{
	    public $token  = false;
   		public $client = null;
	function __construct(){
		// create menu hook
		add_action('admin_menu', array($this, 'cpa_menu'));
		add_action( 'admin_enqueue_scripts', array( $this,'admin_scripts'));
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_styles' ));
		add_action( 'plugin_action_links', array( $this,'links' ),10,2);
		if( get_option( 'analytics_code') == 1) {
		   add_action( 'wp_head', array($this, 'add_analytics_code'));
		}
		add_action( 'wp_ajax_nopriv_get_ajax_single_admin_analytics', array($this, 'get_ajax_single_admin_analytics'));
        add_action( 'wp_ajax_get_ajax_single_admin_analytics', array($this, 'get_ajax_single_admin_analytics'));
		add_action( 'wp_ajax_get_online_data', array ( $this, 'realtime_data_get'));
		

		if(!class_exists('Google_Client')){
			require_once CPA_GOOGLE_PATH . 'Client.php';
			require_once CPA_GOOGLE_PATH . 'Service/Analytics.php';
		}
		$this->client = new Google_Client();
		$this->client->setApprovalPrompt("force");
		$this->client->setAccessType('offline');
		$this->client->setclientID('391417329737-e0nmq1uiqen2l2iu7bllvo9vl0rsul5u.apps.googleusercontent.com');
		$this->client->setClientSecret('ucYgrmbmMA1lamHt9-vPuO2y');
		$this->client->setRedirectUri('urn:ietf:wg:oauth:2.0:oob');
		$this->client->setScopes('https://www.googleapis.com/auth/analytics');
		$this->client->setDeveloperkey('');
		try{
			$this->service = new Google_Service_Analytics( $this->client );
		} catch ( Exception $e){
		}
		$this->cpa_google_api();
		
	}


	
	//Get Analytics
	public function get_analytics($metrics, $startDate, $endDate, $dimensions = false, $sort = false, $filter = false, $limit = false){
		$this->service = new Google_Service_Analytics($this->client);
		$params = array(
		
		
			  'dimensions' => 'rt:source,rt:medium,rt:city,rt:country,rt:trafficType'
		);
		$profile_id = get_option("data_dashboard");
		if(!profile_id){
			return false;
		}
		//print_r($params);
		return $this->service->data_realtime->get('ga:' .$profile_id, $metrics ,$params);
	
	}
	
	// Get analytics dashboard
	public function get_analytics_dashboard($metrics, $startDate, $endDate, $dimensions = false, $sort = false, $filter = false, $limit = false ){
		$this->service = new Google_Service_Analytics($this->client);
		$params = array();
		if($dimensions){
			$params['dimensions'] = $dimensions;
		}
		if($sort){
			$params['sort'] = $sort;
		}
		if($filter){
			$params['filter'] = $filter;
		}
		if($limit){
			$params['limit'] = $limit;
		}
		$profile_id = get_option("data_dashboard");
		if(!$profile_id){
			return false;
		}
		return $this->service->data_ga->get('ga:' .$profile_id, $startDate, $endDate, $metrics, $params);
	}
	
	
	
	function shortingtime($time){
		if(is_numeric($time)){
			$value = array(
							"years" => '00',
							"days"  => '00',
							"hours" => '',
							"minutes" => '',
							"seconds" => ''
			);
			if($time >= 31556926){
					$value["years"] = floor($time / 31556926);
					$time = ($time % 31556926);	
			}
			if($time >= 86400){
				$value["days"] = floor($time / 86400);
				$time = ($time % 86400);
			}
			if($time >= 3600){
				$value["hours"] = str_pad(floor($time/3600), 1, 0, STR_PAD_LEFT);
				$time = ($time % 3600);
			}
			if($time >= 60){
				$value["minutes"] = str_pad(floor($time / 60), 1, 0, STR_PAD_LEFT);
				$time = ($time % 60 );
			}
			$value["seconds"] = str_pad(floor($time), 1, 0, STR_PAD_LEFT);
			if($value['hours']!=''){
				$attach_hours='<sub>h</sub>';
			}
			if($value['minutes']!=''){
				$attach_min = '<sub>min</sub>';
			}
			if($value['seconds']!=''){
				$attach_sec= '<sub>sec</sub>';
			}
			return $value['hours'] .@$attach_hours.$value['minutes'].@$attach_min. $value['seconds'].$attach_sec;
		} else{
			return false;
		}
	}
	

	// add Menu
	public static function cpa_menu(){
	 add_menu_page('Google Analytics Pro', 'Google Analytics Pro', 'manage_options', 'gap_dashboard', array(__CLASS__, 'cpa_setting_page'), 'dashicons-chart-bar'); 
	 
     add_submenu_page('gap_dashboard','Google Analytics Pro Dashboard', 'Dashboard', 'manage_options','gap_dashboard',  array(__CLASS__, 'cpa_setting_page'));   
	 
	 add_submenu_page('gap_dashboard','Google Analytics Pro Settings', 'Setting', 'manage_options',    'gap_settings',  array(__CLASS__, 'cpa_setting_page'));  
	}
	//Template callback
	public static function cpa_setting_page(){
		$screen = get_current_screen();
		if(strpos($screen->base, 'gap_dashboard' ) !== false){
			include(CPA_FILE_PATH . '/classes/gap_dashboard.php'); 
		} else{
			include(CPA_FILE_PATH . '/classes/gap_option_settings.php');
		}
	}
	// Tabs settings
	public function settings_tabs($current = 'authentication'){
		$tabs = array(
				'authentication'          => 'Authentication',
				//'setting'		  => 'Setting',
				//'display'		  => 'Display Setting',
				
		);
		echo '<div id="" class=""></div>';
		echo '<div class="">';
		echo '<h2 class="nav-tab-wrapper">';
		foreach ($tabs as $tab => $name){
			$class = ($tab == $current ) ? 'nav-tab-active' : '';
			echo "<a class='nav-tab $class' href='?page=gap_settings&tab=$tab'>$name</a>";
		}
		echo '</h2>';
	}
	
	// DashBoard Tabs
	public function dashboard_tabs($current= 'general'){
                $dashtabs = array(
                    'general'       => 'General Statistics',
                    'realdata'      => 'Real Time Data',
                    'country'       => 'Country',
                    'city'          => 'City',
                    'keywords'      => 'Keywords',
                    'social'        => 'Traffic Source',
                    'browser'       => 'Browser',
                    'reffer'        => 'Referrals',
                    'os'            => 'Operating Systems',
                    'mobile'        => 'Mobile Device Source',
                    'page'          => 'Page Views',
                    'tele'          => 'Internet & Telecom',
                    'event'         => 'Goal Completions'
                );
		echo '<ul id="myTab" class="nav nav-tabs">';
			
			foreach($dashtabs as $dashtab => $dashname){
                            $class = ($dashtab == $current) ? 'active' : '';
                            echo "<li class='$class'><a href='?page=gap_dashboard&dashtab=$dashtab'><i class='fa fa-cog'></i>$dashname</a></li>";
                         
                        }
		
		echo '</ul>';
	}
	// Admin script add
	public function admin_scripts($page){
                wp_enqueue_script('modernizr-custom', CPA_JS_PATH .'modernizr.custom.js', '1.0.0', false);
		        wp_enqueue_script('jquery');
              	wp_enqueue_script('select', CPA_JS_PATH .'select2.js', '1.0.0', false);
		        wp_enqueue_script('custom', CPA_JS_PATH . 'custom.js', '1.0.0', false);
		        wp_enqueue_script('chart', CPA_JS_PATH . 'chart.js', '1.0.0', false);
		        wp_enqueue_script('jquery-uui-tooltip');
                wp_enqueue_script('bootstrap-min',CPA_JS_PATH . 'bootstrap.min.js', '1.0.0', false);
                wp_enqueue_script('bootstrap-select', CPA_CSS_PATH . 'bootstrap-select.min.css', '1.0.0', false);
                wp_enqueue_script('tabcollapse', CPA_JS_PATH . 'bootstrap-tabcollapse.js', '1.0.0', false);
                wp_enqueue_script('datepicker.min', CPA_JS_PATH . 'bootstrap-datepicker.min.js', '1.0.0', false);
                wp_enqueue_script('placeholders', CPA_JS_PATH . 'placeholders.min.js', '1.0.0', false);
                wp_enqueue_script('dataTables', CPA_JS_PATH . 'jquery.dataTables.min.js', '1.0.0', false);
                wp_enqueue_script('dataTables-responsive', CPA_JS_PATH .'dataTables.responsive.js', '1.0.0', false);
                wp_enqueue_script('plugin-custom', CPA_JS_PATH . 'plugin.custom.js', '1.0.0', false);
                
	}
	// Admin style addd
	public function admin_styles( $page ){
		wp_enqueue_style('cpa_style', CPA_CSS_PATH . 'cpa_style.css', '1.0.0');
		wp_enqueue_style('ui-css', CPA_CSS_PATH . 'jquery-ui.css', '1.0.0');
		wp_enqueue_style('select-bootstrap-css' , CPA_CSS_PATH . 'select2-bootstrap.css', '1.0.0');
		wp_enqueue_style('select-css', CPA_CSS_PATH . 'select2.css', '1.0.0');
		wp_enqueue_style('jquery-ui-tooltip-css', CPA_CSS_PATH . 'jquery.ui.tooltip.html.css', '1.0.0');
		wp_enqueue_style('wp-pointer');
        wp_enqueue_style('analytics_bootstrap', CPA_CSS_PATH . 'bootstrap.min.css', '1.0.0');
        wp_enqueue_style('pe-icon', CPA_CSS_PATH . 'Pe-icon-7-stroke.css', '1.0.0');
        wp_enqueue_style('font_awesome', CPA_CSS_PATH . 'font-awesome.css', '1.0.0');
        wp_enqueue_style('custom_style', CPA_CSS_PATH . 'custom.css', '1.0.0');
		
	}
	
	// connect Google Analytics API
	public function cpa_google_api(){
		$google_authtoken = get_option('google_token');
		if(!empty($google_authtoken)){
			$this->client->setAccessToken($google_authtoken);
		}else{
			$authCode = get_option('post_analytics_token'); 
			if(empty($authCode)) return false;
			try{
				$accessToken = $this->client->authenticate($authCode);
			}catch(Exception $e){
				return false;
			}
			if($accessToken){
				
				$this->client->setAccessToken($accessToken);
				update_option('google_token', $accessToken);
				return true;
			} else{
				return false;
			}
		}
		$this->token = $this->client->getAccessToken();
		return true;
		}
	//Links
	public function links($links, $file){
		static $this_plugin;
		if(empty($this_plugin))
			$this_plugin = 'cpanalytics/cpanalytics.php';
		if($file == $this_plugin){
			$settings_link  = '<a href="' . admin_url("admin.php?page=gap_settings").'">' . __('Settings', 'cpanalytics') . '</a> | <a href = "' . admin_url("admin.php?page=gap_dashboard ") . '">' . __('Dashboard', 'cpanalytics'). '</a>';
			array_unshift($links, $settings_link);
		}
		return $links;
	}
	// Google Analytics JS Code
	public function add_analytics_code(){
		if(get_option('tracking_code') == 'universal'){
			?>
            <script>
            	(function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
				(i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new date();a=s.createElement(o),
				m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
				})(window,document,'script', '//www.google-analytics.com/analytics.js', 'ga');
				ga('create', '<?php echo get_option('webPropertyId'); ?>', 'auto');
				ga('send', 'pageview');
            </script>
        
            <?php
		}
		if(get_option('tracking_code') == 'ga') {
		?>
        <script type="text/javascript"> //<![CDATA[
		var _gap = _gaq || [];
		_gaq.push(['_setAccount', '<?php echo get_option("webPropertyId"); ?>']);
		_gaq.push([_trackPageview]);
		(function() {
			var ga = document.createElement('script');
			ga.type = 'text/javascript';
			ga.async = true;
			ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + 'google-analytics.com/ga.js';
			var s = document.getElementsByTagName('script')[0];
			s.parentNode.insertBefore(ga, s);
			})();
			//]]>
		</script>
        <?php
		}
	}
	// Analytics from ajax() call
	public function get_ajax_single_admin_analytics(){
		$startDate = '';
		$enddate   = '';
		$postId    = 0;
		$startDate = $_POST['start_date'];
		$enddate   = $_POST['end_date'];
		$postId	= $_POST['post_id'];
		$this->get_single_admin_analytics($startDate, $enddate, $postId);
		die();
	}
	// Google Analytics account profiles.
	public function get_analytics_accounts(){
		try{
			if(get_option('google_token')!= ''){
				$profiles = $this->service->management_profiles->listManagementProfiles("~all", "~all");
				return $profiles;
			} else{
				echo _e('Must be login to access', 'cpanalytics');
			}
		}
		catch(Exception $e){
			die('An error: ' .$e->getMessage(). '\n');
		}
	}
	//setting url
	public function setting_url(){
		return admin_url('admin.php?page=gap_settings');
	}
	//Save Data
	public function save_data($key_google_token){
		update_option("post_analytics_token", $key_google_token);
		return true;
	}
	// Get RealTime statistics
	function realtime_data_get(){
		if(! isset($_REQUEST['security']) OR ! wp_verify_once($_REQUEST['security'], 'get_online_data')){
			return;
		}
		if(! function_exists('curl_version')){
			die();
		}
		print_r(stripslashes(json_encode($this->realtime_data(get_option("data_dashboard")))));
		
		die();
	}
	// check roles
	public function check_roles($access_level){
		if(is_user_ligged_in () && isset ($access_level)){
			global $current_user;
			$roles = $current_user->roles;
			if(current_user_can ('manage_options')){
				return true;
			}
			if(in_array($roles[0], $access_level)){
				return true;
			} else {
				return false;
			}
		}
	}
	
}

$wp_cpanalytics =   new Cp_Analytics();

 