<?php
function social($content, $social){
	//print_r($social);
	?>

  <!--[social-network]-->
    
         <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
                var data = google.visualization.arrayToDataTable([
                  ['Task', 'Referr stats'],
                 <?php foreach ( $social["rows"] as $s_stats ): ?>
                  ['<?php echo $s_stats[0]; ?>',
                  <?php echo $s_stats[1]; ?>
                  ],
                <?php endforeach; ?>
                ]);
       var options = {
                                  hAxis: {title: 'Top Referr', titleTextStyle: {color: 'red'}},
                                  legend: 'none',
                                };

        var chart = new google.visualization.PieChart(document.getElementById('social_chart'));

        chart.draw(data, options);
      }
    </script>

                <div id="social_chart" style="width:auto; height:300px;"></div>

        <div class="row">
			<div class="col-md-12 col-xs-12">
                             <?php if(!empty($social["rows"])) { ?>
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Social Network</th>
                                <th>% Sessions</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $so= 1;
                                foreach($social["rows"] as $dasocial){ ?>
                            <tr>
                                <td><?php echo $so++ ; ?></td>
                                <td><?php echo $dasocial[0]; ?></td>
                                <td><span><?php echo $dasocial[1]; ?></span> </td>
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
   
