<?php

	include(APPPATH.'includes/site_info'.EXT);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title></title>

<script type="text/javascript" src="<?php echo js_asset_url('jquery-1.7.2.min.js', '') ?>"></script>
<script type="text/javascript" src="<?php echo js_asset_url('hoverIntent.js', '') ?>"></script>
<script type="text/javascript" src="<?php echo js_asset_url('dropdown.js', '') ?>"></script>

</head>

<body >

    
    <div class="clear"></div>
    
    <div id="content">
    
    	<div id="data">
        
        	<?php 
			
				foreach($records as $row) 
				{
					$class_name = $row->class_name;
					$qtt_name = $row->qtt_name;
					$starter = count($records);
					$race_type = $row->race_type_name;
					$laps = $row->laps;
					$race_num = $row->race_num;
					$race_type = $row->race_type_name;
					$starter = count($records);
					
				}
				
			?>
        
        	<div id="qtt-header-summary"><!--qtt-header-->
            
            	<div id="starting-list">
                    	<h2>Starting List</h2>
                        
                        <table id="laps_race_num">
                        	<tr>
                            	<td class="laps-tag">Laps</td>
                                <td class="race-tag">Race</td>
                            </tr>
                            
                            <tr>
                            	<td class="laps-data"><?php echo $laps ?></td>
                                <td class="race-data"><?php echo $race_num ?></td>
                            </tr>
                        
                        </table>
                    </div>
                    
                                
            	<div id="qtt-header-summary-tag">
            		<h1><?php echo $title ?></h1>
                	<h2><?php echo $champions ?></h2>
                	<p><?php echo $date ?></p>
                	<p><?php echo $location ?></p>
               </div>
               
               
                	
                    <div class="summary-item">
                    	<table class="qtt-header-data">
                        	<tr>
                				<td class="class-tag">Kelas :</td>
                    			<td class="class-data"><?php echo $class_name ?></td>
                                <td></td>
                            </tr>
                            
                            <tr>
                				<td class="qtt-tag">Babak :</td>
                    			<td class="qtt-data"><?php echo $qtt_name ?></td>
                                
                                <?php 
								
									switch ($race_type)
									{ 
                                		case "Best" :
											echo '<td class="qtt-starter" rowspan="2">Winner : ' . $starter . '</td>';
											break;
											
										case "Point System":
											echo '<td class="qtt-starter" rowspan="2">Starter: ' . $starter . '</td>';
											break;
										case "Grid":
											echo '<td class="qtt-starter" rowspan="2">Starter: ' . $starter . '</td>';
											break;
									}
                                
                                ?>
                            </tr>
                            
                        </table>
        			</div>
                    
                    
                 
                
                	
            </div><!--qtt-header-->             
             
       		
            
            
            <div id="table-data">
            
            	
            
            	
  				<table id="summary">
    						
                            
                            
                            
                            	<tr>
                                <th>No</th>
    							<th>N.S</th>
    							<th>Name</th>
                                <th>Pengda</th>
                                <th>Team</th>
                                <th>Vehicle</th>
                                <th>Time</th>
                                
                                <?php
									
									switch($race_type)
									{
										case "Grid":
											echo '<th scope="col">Grid</th>';
											break;
										case "Best":
											echo '<th scope="col">Ranking</th>';
											break;
									}
								
								?>
                            	
                                
                                </tr>
                            
                            <?php $i = 1; ?>
    						<?php foreach($records as $row): ?>
                            <tr>
                            	<td><?php echo $i++ ?></td>
    							<td><?php echo $row->racer_id ?></td>
                                <td><?php echo $row->racer_name ?></td>
                                <td><?php echo $row->pengda_name ?></td>
                                <td><?php echo $row->racer_team ?></td>
                                <td><?php echo $row->racer_vehicle ?></td>
                                <td><?php echo $row->time ?></td>
                                 <?php
									
									switch($race_type)
									{
										case "Grid":
											echo "<td> $row->grid</td>";
											break;
											
										case "Best":
											echo "<td> $row->ranking</td>";
											break;
									}
								
								?>
                                
                                
                            </tr>
                            <?php endforeach ?>
                            
                            </table>
                            
                         
                            
                            
    					
                
                  
                  			  
                   
                   
                   
                   
                   
                   
                   
	
            	<?php echo form_close() ?>
                  
            
            </div>
        
        </div>
    
    </div>
    
    

</div>


</body>
</html>
