<?php
function pages($content, $page){
	//echo "<pre>";
	//print_r($page);
	?>
          <div class="row cate-sect real-time-data">
        	<div class="col-lg-12 col-md-12 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Total Page Views</h3></div>
               		<div class="cat-details">
                    	<h4><?php echo $page->totalsForAllResults['ga:exits']; ?></h4>
                        
                        
                        
                        
                    </div>
                </article>
                    
            </div>
        </div>
  
                	<?php
					$exit_num = 0;
					$exit_path = '';
					if(! empty($page["rows"])){ ?>
                    	<script type="text/javascript">
							google.charts.load('current', {'packages':['corechart']});
   						    google.charts.setOnLoadCallback(drawChart);
							
							function drawChart(){
								var data = google.visualization.arrayToDataTable([
								['Links', 'Page Views', 'Page Exits'],
								<?php foreach($page["rows"] as $pages) { ?>
								['<?php echo $pages[0]; ?>', <?php echo $pages[2]; ?>, <?php echo $pages[3]; ?>],
								<?php } ?>
								]);
								var options = {
										hAxis: {title: 'Exits', titleTextStyle:{color:'red'}}
									};
								var chart = new google.visualization.ColumnChart(document.getElementById('pagechart'));
								chart.draw(data, options);
								
								
								
							}
						</script>
                        
                        <div id="pagechart" style="auto; height:400px;"></div>
                        
                        <div class="row">
			<div class="col-md-12 col-xs-12">
                    
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Page Views</th>
                                <th>Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $pageviews= 1;
                              foreach($page["rows"] as $pages){
                                 
                                  ?>
                            <tr>
                                <td><?php echo $pageviews++ ; ?></td>
                                <td><?php echo $exit_name = $pages[0]; ?></td>
                                <td><span><?php echo $exit_path = $pages[1]; ?></span> </td>
                            </tr>
                                <?php 
                               
                              }
                              
                              ?>
                          
                       </tbody>
                    </table>
                
            </div>            
        </div>   
                        
    <?php                        
    }
}
?>
