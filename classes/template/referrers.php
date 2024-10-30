<?php
function referrers($content, $referr){
	//print_r($referr);
?>

                	<script type="text/javascript">
						  google.charts.load('current', {'packages':['corechart']});
  						    google.charts.setOnLoadCallback(drawChart);
						function drawChart(){
							 var data = google.visualization.arrayToDataTable([
								['Task', 'Referr Stats'],
								<?php foreach ($referr["rows"] as $referrs) { ?>
								['<?php echo $referrs[0] ?>/<?php echo $referrs[1]; ?>', <?php echo $referrs[2]; ?>],
								<?php } ?>
							]);
							var options = {
								legend: 'none',
								pieHole: 0.4,
							};
							  
						 var chart = new google.visualization.ColumnChart(document.getElementById('referrchart'));
						
							chart.draw(data, options);
						}
					</script>
                    <div id="referrchart" style="auto; height:300px; margin:0 auto;"></div>
                    
                     <div class="row">
			<div class="col-md-12 col-xs-12">
                      <?php  if(!empty($referr["rows"])){  ?>    
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Referrals</th>
                                <th>Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $reff= 1;
                                foreach($referr["rows"] as $referrs) { ?>
                            <tr>
                                <td><?php echo $reff++ ; ?></td>
                                <td><?php echo $referrs[0]; ?>/<?php echo $referrs[1]; ?></td>
                                <td><span><?php echo $referrs[2]; ?></span> </td>
                            </tr>
                                <?php } ?>
                          
                       </tbody>
                    </table>
                      <?php } ?>      
            </div>            
        </div>   
        <!--[/social-network]-->
    <?php
}
?>
                            