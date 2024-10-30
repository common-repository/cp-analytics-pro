<?php
function keywords($current, $keywords){
	?>
 <?php if(!empty($keywords["rows"])){ ?>
                  		<script type="text/javascript">
							 google.charts.load('current', {'packages':['corechart']});
      						google.charts.setOnLoadCallback(drawChart);
							function drawChart(){
								 var data = google.visualization.arrayToDataTable([
										['Browsers (OS)', 'Sessions'],
										<?php foreach($keywords["rows"] as $keyss) {?>
										['<?php echo $keyss[0]; ?>', <?php echo $keyss[1]; ?>],
										<?php } ?>
								]);
								var options = {
									hAxis:{title: 'Keywords', titleTextStyle:{color: 'red'}},
									legend: 'none',
								};
								 var chart = new google.visualization.ColumnChart(document.getElementById('keys_chart'));

        chart.draw(data, options);
								
							
							}
						</script>
                        <div id="keys_chart" style="width:auto; height:400px; margin:0 auto;"></div>

        <div class="row">
			<div class="col-md-12 col-xs-12">
                        
                <table id="table-resp-city" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Keywords</th>
                                <th>Vists</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $keynumber = 1;
                             foreach($keywords["rows"] as $keys ) { ?>
                            <tr>
                                <td><?php echo $keynumber++ ; ?></td>
                                <td><?php echo $keys[0]; ?></td>
                                <td><span><?php echo $keys[1]; ?></span> </td>
                            </tr>
                            
                            <?php } ?>
                       </tbody>
                    </table>
                            <?php } ?>
            </div>            
        </div>   
        <!--[/City-audience]-->  
    
    <?php
}
?>
          
  