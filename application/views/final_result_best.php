<?php

	include(APPPATH.'includes/site_info'.EXT);

?>

<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo css_asset('style.css'); ?>
<script type="text/javascript" src="<?php echo js_asset_url('jquery-1.7.2.min.js', '') ?>"></script>
<script type="text/javascript" src="<?php echo js_asset_url('hoverIntent.js', '') ?>"></script>
<script type="text/javascript" src="<?php echo js_asset_url('dropdown.js', '') ?>"></script>

</head>

<body >

<div id="header-wrapper">

	<div id="header">
    
   	  	<div id="header-top">
        
        	<h2><?php echo $site_title ?></h2>
            <h3 class="championship"><?php echo $site_title_sub ?></h3>
            <h3 class="circuit"><?php echo $site_track ?></h3>
        
      	</div>
        
        <div class="clear"></div>
        
        <div id="header-race">
        	<?php echo image_asset('header-image.jpg', '', array('alt'=>'matic-race!', 'width'=>773, 'height'=>124)) ?>
    		
    	</div>
        
        <div id="header-bottom">
        
        	<div id="header-bottom-left">
            	<h2 class="date">Minggu, 22 April 2012</h2>
            </div>
            
            <div id="header-bottom-right">
            
            	<ul id="menu"><!--menu-->
                	<li><?php echo anchor('racers/index', 'Racers', 'class="racers"') ?></a>
                    	<ul id="racer-by-class">
                        	<?php if(sizeof($class) > 0) : ?>
                            
                            	<?php foreach($class as $list): ?>
                            		<li><?php echo anchor("racers/racerclass/$list->class_id", "$list->class_name") ?></li>      
                                <?php endforeach ?>
                            <?php endif ?>    
                        </ul>
                    </li>
                    <li><?php echo anchor('racers/division_links', 'Race Schedule', 'class="race-schedule"') ?></li>
                    <li><a href="" class="race-summary">Race Summary</a>
                    	<ul id="race-summary-sub">
                        	<?php if(sizeof($class) > 0) : ?>
                            	<?php foreach($class as $list): ?>
                            		<li><?php echo anchor("racers/race_summary_by_class/$list->class_id", "$list->class_name") ?></li>      
                                <?php endforeach ?>
                            <?php endif ?>    
                        </ul>
                    </li>
                    <li><?php echo anchor('racers/administer', 'Administer', 'class="race-administer"') ?>
                    	<ul id="administer-sub">
                    		<li><?php echo anchor('administer/site_info', 'Site Info') ?></li>
                        </ul>
                    </li>
                </ul><!--/menu-->
            
            </div>
        
        </div>
    
    </div>
    
    <div class="clear"></div>
    
    <div id="content">
    
    	<div id="data">
        
        	<form method="post">
        
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
					$pick = $row->pick;
					
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
                                <input type="hidden" name="laps" value="<?php echo $laps ?>" />
                                <td class="race-data"><?php echo $race_num ?></td>
                                <input type="hidden" name="race_num" value="<?php echo $race_num ?>" />
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
											echo '<td class="qtt-starter" rowspan="2">Starter : ' . $starter . '</td>';
											break;
										case "Grid":
											echo '<td class="qtt-starter" rowspan="2">Winner : ' . $starter . '</td>';
											break;
									}
                                
                                ?>
                            </tr>
                            
                            <?php 
                            
								switch($race_type)
								{
                            		
									case "Best":
										echo '<tr>';
                						echo '<td class="qtt-tag">Pick :</td>';
                                		echo '<td class="qtt-data">' . $pick . '</td>';
										echo '<input type="hidden" name="pick" value="' . $pick . '"/>';
                            			echo '</tr>';
										break;
                                }
                            
                            ?>
                            
                        </table>
        			</div>
                    
                    
                 
                
                	
            </div><!--qtt-header-->             
             
       		
            
            
            <div id="table-data">
            
            	
            
            	
  				<table id="summary">
    						
                            
                            
                            
                            	<tr>
                                <th scope="col">No</th>
    							<th scope="col">N.S</th>
    							<th scope="col">Name</th>
                                <th scope="col">Pengda</th>
                                <th scope="col">Team</th>
                                <th scope="col">Vehicle</th>
                                <th scope="col">Time</th>
                                
                                <?php
									
									switch($race_type)
									{
										case "Grid":
											echo '<th scope="col">Grid</th>';
											break;
											
										case "Best":
											echo '<th scope="col">Ranking</th>';
											break;
										
										case "Point System":
											echo '<th scope="col">Point One</th>';
											echo '<th scope="col">Point Two</th>';
											echo '<th scope="col">Total</th>';
											break;	
											
									}
								
								?>
                            	
                                
                                </tr>
                            
                            <?php $i = 1; ?>
    						<?php foreach($records as $row): ?>
                            <tr>
                            	<td><?php echo $i++ ?></td>
    							<td><?php echo $row->racer_id ?></td>
                                <input type="hidden" name="racer_id[]" value="<?php echo $row->racer_id ?>" />
                                <td><?php echo $row->racer_name ?></td>
                                <input type="hidden" name="racer_name[]" value="<?php echo $row->racer_name ?>" />
                                <td><?php echo $row->pengda_name ?></td>
                                <td><?php echo $row->racer_team ?></td>
                                <td><?php echo $row->racer_vehicle ?></td>
                                
                                <?php if($edit): ?>
                                	<td><input type="text" name="racer_time[]" value="<?php echo $row->time ?>" class="summary-racer-time"/></td>
                                <?php else :?>
                                	<td><?php echo $row->time ?></td>
                                    
                                <?php endif ?>
                                
                                 <?php
								 
								 	
									
									switch($race_type)
									{
										case "Grid":
										
											if($edit)
											{
												echo '<td><input type="text" name="racer_grid[]" value="'
												. $row->grid  . '" class="summary-racer-grid"/></td>';
											}
											else
											{
												echo "<td> $row->grid</td>";
											}
											
											break;
											
										case "Best":
											if($edit)
											{
												echo '<td><input type="text" name="racer_best[]" value="'
												. $row->ranking  . '" id="racer-best"/></td>';
											}
											else
											{
												echo "<td> $row->ranking</td>";
											}
											
											break;
											
										case "Point System":
											
											if($edit)
											{
												echo '<td><input type="text" name="racer_point_one[]" value="'
												. $row->point_one  . '" id="point_one_edit"/></td>';
												echo '<td><input type="text" name="racer_point_two[]" value="'
												. $row->point_two  . '" id="point_two_edit"/></td>';
												echo '<td><input type="text" name="racer_total[]" value="'
												. $row->total_point  . '" id="total_edit"/></td>';
											}
											else
											{
												echo "<td> $row->point_one</td>";
												echo "<td> $row->point_two</td>";
												echo "<td> $row->total_point</td>";
											}
											
											break;
									}
								
								?>
                                
                                
                            </tr>
                            <?php endforeach ?>
                            
                            </table>
                            
                         
                            
                            
    					
                
                  
                  			  
                   
                   
                   
                   
                   
                <div class="edit-summary">  
                	<input type="submit" name="edit-summary" value="Edit" id="edit-summary-button" />   
                </div>
                
                <?php if($edit): ?>
                	<div class="save-summary">
                		<input type="submit" name="save-summary" value="Save" id="save-summary-button"/>
                    </div>
                <?php endif ?>
                
                <div class="print-summary">  
                	<?php echo anchor('racers/export_pdf/' . $this->uri->segment(3). '/' . $this->uri->segment(4) . '/' . $this->uri->segment(5) . '/' . $this->uri->segment(6), 'Print') ?>
                </div>
                
                <div class="clear"></div>
				
            	<?php echo form_close() ?>
                  
            
            </div>
        
        </div>
    
    </div>
    
    

</div>

<div id="wrapper">

</div>

</body>
</html>
