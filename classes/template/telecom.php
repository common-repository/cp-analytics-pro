<?php
function internets($content, $tele){
?>
	
    
        <?php if(!empty($tele["rows"])) {?>
        	<script type="text/javascript">
				google.charts.load('current', {'packages':['corechart']});
   						    google.charts.setOnLoadCallback(drawChart);

							
							function drawChart(){
								var data = google.visualization.arrayToDataTable([
								['TeleCome', 'Visits'],
								<?php foreach($tele["rows"] as $teles) { ?>
								['<?php echo $teles[0]; ?>', <?php echo $teles[1]; ?>],
								<?php } ?>
								]);
								
								
								var options = {
										hAxis: {title: 'Internet & Telecom', titleTextStyle:{color:'red'}},
										pieHole: 0.1,
									};
									
									
								var chart = new google.visualization.PieChart(document.getElementById('telechart'));
								chart.draw(data, options);

							}
			</script>
            <div id="telechart" style="width:auto; height:400px; "></div> 
            
              <div class="row">
			<div class="col-md-12 col-xs-12">
                    
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Internet And Telecom</th>
                                <th>Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $teleds= 1;
                               foreach($tele["rows"] as $teles){ ?>
                            <tr>
                                <td><?php echo $teleds++ ; ?></td>
                                <td><?php echo $teles[0]; ?></td>
                                <td><span><?php echo $teles[1]; ?></span> </td>
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