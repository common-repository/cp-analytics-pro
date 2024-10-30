<?php
function realtime($current, $real){
	//echo "<pre>";
	//print_r($real);
	?>
     <div class="row cate-sect real-time-data">
        	<div class="col-lg-12 col-md-12 col-xs-12">
            	<article>
	            	<div class="cat-head"><h3>Right Now</h3></div>
               		<div class="cat-details">
                    	<h4><?php echo $real->totalsForAllResults['ga:activeVisitors']; ?></h4>
                        <p>Active users on sites</p>
                       
                    </div>
                </article>
                    
            </div>
        </div>
        
      
        
             

        <div class="row">
        <!--[Traffic Source]-->
			<div class="col-md-12 col-xs-12">
             <h2>Traffic Source</h2>
             <p>Raw denim you probably haven't...</p>
            
                <table id="table-resp-traffic" class="table table-striped table-bordered dt-responsive clearfix" cellspacing="0" width="100%">
                        <thead>
                            <tr>
                                <th></th>
                                
                                <th>Source</th>
                                <th>Active Users</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                               
                                <td>SOCIAL</td>                                
                                <td><span><?php
						if($real["rows"][0][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][1][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][2][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][3][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][4][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][5][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][6][4]=='SOCIAL'){
							echo $real["rows"][0][5];
						}else{
							echo "0";
						}?></span> </td>
                            </tr>
                            
                          <tr>
                                <td>2</td>
                               
                                <td>DIRECT</td>                                
                                <td><span><?php
						if($real["rows"][0][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][1][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][2][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][3][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][4][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][5][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][6][4]=='DIRECT'){
							echo $real["rows"][0][5];
						}else{
							echo "0";
						}?></span> </td>
                            </tr>
                            <tr>
                                <td>3</td>
                               
                                <td>ORGANIC</td>                                
                                <td><span><?php
						if($real["rows"][0][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][1][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][2][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][3][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][4][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][5][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][6][4]=='ORGANIC'){
							echo $real["rows"][0][5];
						}else{
							echo "0";
						}?></span> </td>
                            </tr
                            <tr>
                                <td>4</td>
                               
                                <td>REFERRAL</td>                                
                                <td><span><?php
						if($real["rows"][0][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][1][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][2][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][3][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][4][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][5][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][6][4]=='REFERRAL'){
							echo $real["rows"][0][5];
						}else{
							echo "0";
						}?></span> </td>
                            </tr>
                            <tr>
                                <td>5</td>
                               
                                <td>NEW</td>                                
                                <td><span><?php
						if($real["rows"][0][4]=='NEW'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][1][4]=='NEW'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][2][4]=='NEW'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][3][4]=='NEW'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][4][4]=='NEW'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][5][4]=='NEW'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][6][4]=='NEW'){
							echo $real["rows"][0][5];
						}else{
							echo "0";
						}?></span> </td>
                            </tr
                            <tr>
                                <td>6</td>
                               
                                <td>RETURNING</td>                                
                                <td><span><?php
						if($real["rows"][0][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][1][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][2][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][3][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][4][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][5][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}elseif($real["rows"][6][4]=='RETURNING'){
							echo $real["rows"][0][5];
						}else{
							echo "0";
						}?></span> </td>
                            </tr>
                           
                       </tbody>
                    </table>
            </div>
        <!--[/Traffic Source]-->            
        </div>
      




						
    
    <?php
}
 
?>
 
