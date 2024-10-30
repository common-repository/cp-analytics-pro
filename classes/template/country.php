<?php
function country($current, $country_stats){
	//print_r($country_stats);
	?>
    <?php if(!empty($country_stats["rows"])){ ?>
     <script type='text/javascript' src='https://www.google.com/jsapi'></script>
    <script type='text/javascript'>
     google.load('visualization', '1', {'packages': ['geochart']});
     google.setOnLoadCallback(drawRegionsMap);

      function drawRegionsMap() {
        var data = google.visualization.arrayToDataTable([
          ['Country', 'Visitors'],
           <?php
                            foreach ($country_stats["rows"] as $c_stats): ?>
                              ['<?php echo $c_stats[0];?>', <?php echo $c_stats[1]; ?>],
                              <?php endforeach; ?>
        ]);

        var options = {};

        var chart = new google.visualization.GeoChart(document.getElementById('chart_div'));
        chart.draw(data, options);
    };
    </script>
    <div id="chart_div" style="width: auto; height: 500px;"></div>
     
             
        <!--[City-audience]-->
        <h2>Country</h2>
       

        <div class="row">
			<div class="col-md-12 col-xs-12">
                <table id="table-resp-city" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>Country</th>
                                <th>% Sessions</th>
                            </tr>
                        </thead>
                        <tbody>
                              <?php 
                              $countrynumber = 1;
                              foreach ($country_stats["rows"] as $c_stats){ ?>
                            <tr>
                                <td><?php echo $countrynumber ++ ;?></td>
                                <td><?php  echo $c_stats[0];?></td>
                                <td><span><?php echo $c_stats[1];?></span> 100%</td>
                            </tr>
                            
                              <?php } ?>
                       </tbody>
                    </table>
            </div>            
        </div>   
        <!--[/City-audience]-->  

    <?php
    }
}
?>


