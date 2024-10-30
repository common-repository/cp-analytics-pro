<?php
function browser($content, $browser){
//	print_r($browser);
	?>
        
   
            	<?php if(!empty($browser["rows"])) { ?>
                		<script type="text/javascript">
							 google.charts.load('current', {'packages':['corechart']});
      						google.charts.setOnLoadCallback(drawChart);
							function drawChart(){
								 var data = google.visualization.arrayToDataTable([
										['Browsers (OS)', 'Sessions'],
										<?php foreach($browser["rows"] as $brows) {?>
										['<?php echo $brows[0]; ?>( <?php echo $brows[1]; ?>)', <?php echo $brows[2]; ?>],
										<?php } ?>
								]);
								var options = {
									hAxis:{title: 'Browsers', titleTextStyle:{color: 'red'}},
									legend: 'none',
								};
								 var chart = new google.visualization.ColumnChart(document.getElementById('browser_chart'));

        chart.draw(data, options);
								
							
							}
						</script>
                        <div id="browser_chart" style="width:auto; height:400px; margin:0 auto;"></div>
                        
                        
                        
        <div class="row">
			<div class="col-md-12 col-xs-12">
                             
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Web Browsers</th>
                                <th>Operating System</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $bo= 1;
                                foreach($browser["rows"] as $dasrowser){ ?>
                            <tr>
                                <td><?php echo $bo++ ; ?></td>
                                <td><?php echo $dasrowser[0]; ?></td>
                                <td><span><?php echo $dasrowser[1]; ?></span> </td>
                            </tr>
                                <?php } ?>
                          
                       </tbody>
                    </table>
                           
            </div>            
        </div>   
        <!--[/social-network]-->
                        
                        
                        
                <?php } ?>
        
    <?php
}
?>

 