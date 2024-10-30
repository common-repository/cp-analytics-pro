<?php
function city($current, $city_stats){
     
	?>
  <?php if(!empty($city_stats["rows"])) { ?>
 
			<div class="col-md-12 col-xs-12">
                          
                <table id="table-resp-city" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                <th>City</th>
                                <th>Vists</th>
                            </tr>
                        </thead>
                        <tbody>
                            
                            <?php 
                            $citynumber = 1;
                            foreach($city_stats["rows"] as $c_stats) { ?>
                            <tr>
                                <td><?php echo $citynumber++ ; ?></td>
                                <td><?php echo $c_stats[0]; ?></td>
                                <td><span><?php echo $c_stats[1]; ?></span> </td>
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



    