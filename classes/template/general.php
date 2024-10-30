<?php 
function general( $current, $value){
	//print_r($value);
	?>
   
<div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Sessions</h3></div>
               		<div class="cat-details">
                    	<h4><?php echo number_format($value->totalsForAllResults['ga:sessions']); ?></h4>
                        <p>Total number of interactions taking place in your website within the time frame set by you.</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Users</h3></div>
               		<div class="cat-details">
                    	<h4><?php echo number_format($value->totalsForAllResults['ga:users']); ?></h4>
                        <p>The total number of users who visited your site.</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Page Views</h3></div>
               		<div class="cat-details">
                    	<h4> <?php if($value->totalsForAllResults['ga:pageviews'] <=0){ ?>0
            <?php } else {echo $value->totalsForAllResults['ga:pageviews']; } ?></h4>
                        <p>The number of pages visited or clicked by a user during the given time.</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Page / Sessions</h3></div>
               		<div class="cat-details">
                    	<h4> <?php if($value->totalsForAllResults['ga:sessions'] <= 0) { ?>0.00
            <?php } else {
				echo number_format(round($value->totalsForAllResults['ga:pageviews'] / $value->totalsForAllResults['ga:sessions'], 2), 2);
			}
			?></h4>
                        <p>The number of page views visited on your website in a session</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Avg. Sessions Duration</h3></div>
               		<div class="cat-details">
                    	<h4> <?php if($value->totalsForAllResults['ga:sessions'] <= 0){ ?> 00:00:00
            <?php } else {
						echo $current->shortingtime($value->totalsForAllResults['ga:avgSessionDuration']);
				} ?>
            </h4>
                        <p>The average time period states the average amount of time spent by a user on your site.</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Bounce Rate</h3></div>
               		<div class="cat-details">
                    	<h4><?php if($value->totalsForAllResults['ga:entrances'] <=0){ ?>
            0.00%
            <?php
			} else {
				echo number_format(round(($value->totalsForAllResults['ga:bounces'] / $value->totalsForAllResults['ga:entrances']) * 100, 2), 2);
			?>%
            <?php } ?></h4>
                        <p>The percentage of visitors who leave your website from the landing page.</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>% New Sessions</h3></div>
               		<div class="cat-details">
                    	<h4><?php 
					$total_sessions = $value->totalsForAllResults['ga:sessions'];
					$newusers	   = $value->totalsForAllResults['ga:newUsers'];
					if($total_sessions>0){
						echo number_format(round(($newusers / $total_sessions ) * 100, 2), 2);
					} else {
						echo "0";
					}
				?>%</h4>
                        <p>This shows the average percentage of first time visitors on your website.</p>
                    </div>
                </article>
            </div>
            
            <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>New / returning Visitors</h3></div>
               		<div class="cat-details">
                    	<h4><?php
				if(isset($value->totalsForAllResults)){
				
					if(!empty($value["rows"])):
					 $returning = $value->totalsForAllResults['ga:sessions'] - $value->totalsForAllResults['ga:newUsers'];
					
				?>
    <script type="text/javascript">
    google.charts.load('current', {packages: ['corechart']});
    google.charts.setOnLoadCallback(drawChart);

    function drawChart() {
      // Define the chart to be drawn.
      var data = new google.visualization.DataTable();
      data.addColumn('string', 'Element');
      data.addColumn('number', 'Percentage');
      data.addRows([
	    ['New Visitors', <?php echo $value->totalsForAllResults['ga:newUsers']; ?>],
        ['Return Visitors', <?php echo $returning; ?>],
     
      ]);
	  	//alert(123);
                        var options = {
                          is3D: true,
                          legend:'none',
                          colors: ['#32A539', '#DC3912']
                        };

      // Instantiate and draw the chart.
      var chart = new google.visualization.PieChart(document.getElementById('myPieChart'));
      chart.draw(data, options);
    }
  </script>

             
                <div id="myPieChart" style="width: 99%; height:150px;"></div>
                    <span class="visitor-stats-new"><span class="font-sizing"> New  (<?php echo $value->totalsForAllResults['ga:newUsers']; ?>)</span> </span>
                    <span class="visitor-stats-ret"><span class="font-sizing"> Returning (<?php echo $returning; ?>)</span> </span>
                  <?php
				  endif;
				}
				?></h4>
                        <p>The average number of new and returning visitors on your website.</p>
                    </div>
                </article>
            </div>



<?php	
}
?>

