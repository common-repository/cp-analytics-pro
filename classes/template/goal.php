<?php
function goals($content, $goal){
	
	?>
  
      <div class="row">
			<div class="col-md-12 col-xs-12">
                     <?php if(!empty($goal["rows"])) { ?>   
                <table id="table-resp-social-net" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th>SL.</th>
                                <th>Goal Completions</th>
                                <th>Visits</th>
                            </tr>
                        </thead>
                        <tbody>
                            	<?php 
                                $gosal= 1;
                                	foreach($goal["rows"] as $goals){ ?>
                            <tr>
                                <td><?php echo $gosal++ ; ?></td>
                                <td><?php echo $referrs[0]; ?>/<?php echo $goals[0]; ?></td>
                                <td><span><?php echo $goals[1]; ?></span> </td>
                            </tr>
                                <?php } ?>
                          
                       </tbody>
                    </table>
                      <?php } ?>      
            </div>            
        </div>   
    <?php
}
?>