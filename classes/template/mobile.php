<?php
function mobile($content, $mobile){
	?>

	<?php if(!empty($mobile["rows"])) { ?>
                		<script type="text/javascript">
							 google.charts.load('current', {'packages':['corechart']});
      						google.charts.setOnLoadCallback(drawChart);
							function drawChart(){
								 var data = google.visualization.arrayToDataTable([
										['Browsers (OS)', 'Sessions'],
										<?php foreach($mobile["rows"] as $mobbbs) {?>
										['<?php echo $mobbbs[0]; ?>', <?php echo $mobbbs[1]; ?>],
										<?php } ?>
								]);
								var options = {
									hAxis:{title: 'Mobile Device', titleTextStyle:{color: 'red'}},
									legend: 'none',
								};
								 var chart = new google.visualization.ColumnChart(document.getElementById('browser_chart'));

        chart.draw(data, options);
								
							
							}
						</script>
                        <div id="browser_chart" style="width:auto; height:400px; margin:0 auto;"></div>
        <?php } ?>
         <div class="row">
			<div class="col-md-12 col-xs-12">
                    <?php if(!empty($mobile["rows"])) { ?>
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Mobile Devices</th>
                                <th>Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $tmob= 1;
                               foreach($mobile["rows"] as $mob) { ?>
                            <tr>
                                <td><?php echo $tmob++ ; ?></td>
                                <td><?php echo $mob[0]; ?></td>
                                <td><span><?php echo $mob[1]; ?></span> </td>
                            </tr>
                                <?php } ?>
                          
                       </tbody>
                    </table>
                    
            </div>            
        </div>   


    <?php 
                    }
	}
?>
