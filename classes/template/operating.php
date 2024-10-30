<?php
function operating($content, $operating){
    //echo "<pre>";
  //  print_r($operating);
	?>
   	<?php if(!empty($operating["rows"])) { ?>
                		<script type="text/javascript">
							 google.charts.load('current', {'packages':['corechart']});
      						google.charts.setOnLoadCallback(drawChart);
							function drawChart(){
								 var data = google.visualization.arrayToDataTable([
										['Browsers (OS)', 'Sessions'],
										<?php foreach($operating["rows"] as $opps) {?>
										['<?php echo $opps[0]; ?>( <?php echo $opps[1]; ?>)', <?php echo $opps[2]; ?>],
										<?php } ?>
								]);
								var options = {
									hAxis:{title: 'Opearting System', titleTextStyle:{color: 'red'}},
									legend: 'none',
								};
								 var chart = new google.visualization.ColumnChart(document.getElementById('open_chart'));

        chart.draw(data, options);
								
							
							}
						</script>
                        <div id="open_chart" style="width:auto; height:400px; margin:0 auto;"></div>
                        
                        
                        
                         <div class="row">
			<div class="col-md-12 col-xs-12">
                  
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Operating Systems</th>
                                <th>Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $oss= 1;
                               foreach($operating["rows"] as $os ){ ?>
                            <tr>
                                <td><?php echo $oss++ ; ?></td>
                                <td><?php echo $os[0]; ?>(<?php echo $os[1]; ?>)</td>
                                <td><span><?php echo $os[2]; ?></span> </td>
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
    