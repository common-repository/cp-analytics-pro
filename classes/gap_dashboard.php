<?php
$wp_cpanalytics = new Cp_Analytics();
$start_date_val =   strtotime("- 30 days"); 
$end_date_val   =   strtotime("now");
$start_date     =   date( "Y-m-d", $start_date_val);
$end_date       =   date( "Y-m-d", $end_date_val);
if( isset( $_POST["view_data"] ) ) {
  $s_date   = $_POST["st_date"];
  $ed_date  = $_POST["ed_date"];
}

if( isset( $s_date ) ) {
  $start_date = $s_date;
}
if( isset( $ed_date ) ) {
  $end_date = $ed_date;
}
?>
<div class="wrap">
    <section class="wrapper">
<div class="head-sect">
	<div class="row">
    	<div class="col-sm-5 col-xs-12 text-left">
	        <div class="titles">
            	<h1>Dashboard Analytics</h1>
                <p>Welcome to CP Analytics Pro</p>
            </div>
        </div>
        
    	<div class="col-sm-7 col-xs-12 text-right">
            <form action="<?php echo str_replace('%7E', '~', $_SERVER['REQUEST_URI']); ?>" method="post">
        	    <div class="datepicker-sect pull-right">
                <div class="input-daterange input-group pull-left" id="datepicker" data-format="y-m-d">
                    <input type="text" class="input-sm form-control" name="st_date" placeholder="Start Date" />
                    <span class="input-group-addon">to</span>
                    <input type="text" class="input-sm form-control" name="ed_date" placeholder="End Date" />
                </div>
                <input type="submit" class="btn btn-danger" name="view_data" value="View Data" />
                </div>
            </form>
        </div>
    </div>
</div>
               <div class="content-sect">
<div class="tab-sect">
    <?php 
	$acces_token = get_option("post_analytics_token");
	//print_r($acces_token);
	if($acces_token){
        if ( isset ( $_GET['dashtab'] ) ) $wp_cpanalytics->dashboard_tabs($_GET['dashtab']); 
		
  else $wp_cpanalytics->dashboard_tabs( 'general' );
        if ( isset ( $_GET['dashtab'] ) ) {
    $dashtab = $_GET['dashtab'];
  }
  else {
    $dashtab = 'general';
  }
  ?>
    <div id="myTabContent" class="tab-content analytics-sect">
       <?php
       if( $dashtab == 'general')  {
       ?>
	<!--[general]-->
    <div class="tab-pane fade in active" id="<?php echo $_GET['dashtab'];?>">
    	<h2>General Statistics</h2>
        <p>The general statistics of your website</p>
        
        <div class="row cate-sect">
            <?php
						
							$stats = $wp_cpanalytics->get_analytics_dashboard( 'ga:sessions,ga:bounces,ga:newUsers,ga:entrances,ga:pageviews,ga:sessionDuration,ga:avgSessionDuration,ga:users', $start_date, $end_date);
							if(isset($stats->totalsForAllResults)){
							 include CPA_FILE_PATH . '/classes/template/general.php';
								general($wp_cpanalytics,$stats);
							}
							
						
				
							 ?>
        	
        </div>
        
        
        
    </div>
	<!--[/general]-->    
        <?php
       }elseif($dashtab =='realdata'){
       ?>
      
	<!--[real-time-data]-->    
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
        <h2>Real Time Data</h2>
        <p>View the number of active visitors in realtime</p>
        
         
                             <?php
						$real = $wp_cpanalytics->get_analytics('ga:activeVisitors', $start_date, $end_date, 'rt:source,rt:keyword,rt:userType');
					
						if(isset($real->totalsForAllResults)){
						include CPA_FILE_PATH .'/classes/template/realtime.php';
						 realtime($wp_cpanalytics, $real);
						}
							 ?>
        
    </div>
        
        
	<!--[real-time-data]-->    
        <?php
       }elseif($dashtab =='country'){
       ?>
    
    <!--[countries-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Overview</h2>
        <p>Overview The Location of your audience</p>
               <?php
								// Country
					$country_stats = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:country', '-ga:sessions');
					if(isset($country_stats->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/country.php';
					country($wp_cpanalytics, $country_stats);
					}
					
						
				
							 ?>
    
   
        
        
        
    </div>
	<!--[/countries-sect]-->
       <?php } elseif($dashtab =='city') {?>
    <!--[cities-sect]-->
    <div class="tab-pane fade" id="city">
    	<h2>Overview</h2>
        <p>Overview the city from where the user is visiting your website</p>
        
         <?php
							// City Data
					$city_stats = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:city', '-ga:sessions');
					if(isset($city_stats->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/city.php';
						city($wp_cpanalytics, $city_stats);
					}
				
							 ?>
     
     
    </div>
	<!--[/cities-sect]-->
    
       <?php }elseif($dashtab == 'keywords'){  ?>
          <!--[Keywords-sect]-->
    <div class="tab-pane fade" id="city">
    	<h2>Overview</h2> 
        <p>Keywords searched to visit your website</p>
        
        <?php
							//Keywords 
					$keyword = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:keyword', '-ga:sessions');
					if(isset($keyword->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/keywords.php';
						keywords($wp_cpanalytics, $keyword);
					}
						
                                        ?>
     
     
    </div>
	<!--[/keywords-sect]-->
       
       
     <?php  }elseif($dashtab =='social') { ?>
     <!--[social-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Social Traffic</h2>
        <p>Overview the source of traffic from social media channels</p>        
              
         
                             <?php
							// Social
					$social = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:socialNetwork', '-ga:sessions');
					if(isset($social->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/social.php';
						social($wp_cpanalytics, $social);
					}
							 ?>       
      
 
        
    </div>
	<!--[/social-sect]--> 
       <?php  }elseif($dashtab =='browser') { ?>
     <!--[social-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Web Browsers</h2>
        <p>The list of web browsers used to visit your website</p>        
              
             <?php
							//Browser
					$browser = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:browser,ga:operatingSystem', '-ga:sessions');
					if(isset($browser->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/browser.php';
						browser($wp_cpanalytics, $browser);
					}
				
							 ?>
      
 
        
    </div>
	<!--[/social-sect]--> 
       <?php } elseif($dashtab =='reffer') { ?> 
          <!--[Refeeral-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Referrals</h2>
        <p>The referral traffic of your website</p>        
             <?php
						//Referral
					$referr = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:source,ga:medium', '-ga:sessions');
					if(isset($referr->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/referrers.php';
						referrers($wp_cpanalytics, $referr);
					}
				
							 ?>
      
 
        
    </div>
	<!--[/Refeeral-sect]--> 
        
       <?php } elseif($dashtab =='os') {?> 
            <!--[Operating System-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Operating Systems</h2>
        <p>The list of operating systems used by visitors to visit your website</p>        
           <?php
							// Operating system
					$operating = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:operatingSystem,ga:operatingSystemVersion', '-ga:sessions');
					if(isset($operating->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/operating.php';
						operating($wp_cpanalytics, $operating);
					}
				
							 ?>
      
 
        
    </div>
	<!--[/Operating System-sect]--> 
       <?php } elseif($dashtab =='mobile') {?> 
            <!--[Mobile-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Mobile Devices</h2>
        <p>The List of mobile devices used by visitors to view your website</p>        
           <?php
							//Mobile
					$mobile = $wp_cpanalytics->get_analytics_dashboard('ga:sessions', $start_date, $end_date, 'ga:mobileDeviceInfo', '-ga:sessions');
				    	if(isset($mobile->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/mobile.php';
							mobile($wp_cpanalytics, $mobile);
						}
				
							 ?>
 
        
    </div>
	<!--[/mobile-sect]--> 
       <?php } elseif($dashtab =='page') {?> 
            <!--[Page View-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Page Views </h2>
        <p>Pages viewed on your website</p>        
             <?php
							//pages
					$page = $wp_cpanalytics->get_analytics_dashboard('ga:entrances,ga:pageviews,ga:exits', $start_date, $end_date, 'ga:PagePath', '-ga:exits');
					if(isset($page->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/pages.php';
						pages($wp_cpanalytics, $page);
					}
					?>
 
        
    </div>
	<!--[/Page View-sect]--> 
       <?php } elseif($dashtab =='tele') {?>
            <!--[Internet and Telecon-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Internet And Telecom</h2>
        <p>The internet & telecome services used to visit your website</p>        
             
                             <?php
							//Internet & Telecom
					
					$tele = $wp_cpanalytics->get_analytics_dashboard('ga:sessions',$start_date, $end_date, 'ga:networkLocation', '-ga:sessions');
					if(isset($tele->totalsForAllResults)){
						include CPA_FILE_PATH . '/classes/template/telecom.php';
						internets($wp_cpanalytics, $tele);
					}
				
							 ?>
      
 
        
    </div>
	<!--[/Internat and Telecome-sect]--> 
       <?php } elseif($dashtab =='event') {?> 
            <!--[Goal And Event-sect]-->
    <div class="tab-pane fade" id="<?php echo $_GET['dashtab'];?>">
    	<h2>Goal Completions</h2>
        <p>The specifics actions completed by the visitor on your website</p>        
               <?php
							$goal = $wp_cpanalytics->get_analytics_dashboard('ga:goalCompletionsAll',$start_date, $end_date, 'ga:goalCompletionLocation');
					if(isset($goal->totalsForAllResults)){
						
						include CPA_FILE_PATH . '/classes/template/goal.php';
						goals($wp_cpanalytics, $goal);
					}
				
							 ?>
 
        
    </div>
	<!--[/Goal and Event-sect]--> 
       <?php } ?>
    
</div>
    <?php
        

        }
			  ?>
</div>
               </div>
    </section>
	
 <script type="text/javascript">

jQuery(document).ready(function ($) {
abc();
function abc(){
  $("#st_date").datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-9y:c+nn'       
        }).datepicker( 'setDate' , "<?php echo $start_date ?>" );

  $("#ed_date").datepicker({
            dateFormat : 'yy-mm-dd',
            changeMonth : true,
            changeYear : true,
            yearRange: '-9y:c+nn'
        }).datepicker( 'setDate' , "<?php echo $end_date ?>" );
}
jQuery(window).resize(function(){
  drawChart();
  drawMap();
});

});



</script> 
