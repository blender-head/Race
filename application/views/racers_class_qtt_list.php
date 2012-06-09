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

<body>

<div id="header-wrapper"><!--header-wrapper-->

	<div id="header"><!--header-->
    
   	  	<div id="header-top"><!--header-top-->
        
        	<h2><?php echo $site_title ?></h2>
            <h3 class="championship"><?php echo $site_title_sub ?></h3>
            <h3 class="circuit"><?php echo $site_track ?></h3>
        
      	</div><!--/header-top-->
        
        <div class="clear"></div>
        
        <div id="header-race"><!--header-race-->
        	<?php echo image_asset('header-image.jpg', '', array('alt'=>'matic-race!', 'width'=>773, 'height'=>124)) ?>
    	</div><!--/header-race-->
        
        <div id="header-bottom">
        
        	<div id="header-bottom-left"><!--header-bottom-left-->
            	<h2 class="date">Minggu, 22 April 2012</h2>
            </div><!--/header-bottom-left-->
            
            <div id="header-bottom-right"><!--header-bottom-right-->
            
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
                    <li><?php echo anchor('', 'Race Summary', 'class="race-summary"') ?>
                    	<ul id="race-summary-sub">
                        	<?php if(sizeof($class) > 0) : ?>
                        		<?php foreach($class as $list): ?>
                            		<li><?php echo anchor("racers/race_summary_by_class/$list->class_id", "$list->class_name") ?></li>      
                                <?php endforeach ?>
                            <?php endif ?>  
                       </ul>  
                    </li>
                    <li><?php echo anchor('', 'Administer', 'class="race-administer"') ?>
                    	<ul id="administer-sub">
                    		<li><?php echo anchor('administer/site_info', 'Site Info') ?></li>
                        </ul>
                    </li>
                     <?php if($has_final): ?>
                    	<li><?php echo anchor('', 'Final Result', 'class="race-final"') ?>
                        	<ul id="race-final-sub">
                            	<?php 
									for($i=0;$i<count($class_name);$i++)
									{
                    					echo '<li>' . anchor("final_race/display_final_result/$class_id[$i]/$race_type[$i]", "$class_name[$i]") . '</li>';
                                    }
                                ?>
                        	</ul>
                        </li>
                    <?php endif ?>
                </ul><!--/menu-->
            
            </div><!--/header-bottom-right-->
        
        </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        
        	<?php echo form_open('racers/save_qtt', 'id="save_qtt"') ?>
            
            <?php 
			
				if(count($records) > 0)
				{
					foreach($records as $row) 
					{
						$class_name = $row->class_name;
						$qtt_name = $row->qtt_name;
						$starter = count($records);
						$race_type = $row->race_type_name;
					}
				}
				
			?>
            	
        	<div id="table-data"><!--table-data-->
            
            	<div id="info-qtt">
            		<?php echo image_asset('info_black.png', '', array('alt'=>'form-racer', 'width'=>28, 'height'=>28)) ?>
            	</div>
            	
				<table id="qtt-header"><!--qtt-header-->
                
                	<tr>
                    	<th colspan="2">Race Info</th>
                        <th></th>
                    </tr>
                	
                    <tr>
                		<td class="qtt_title"><div class="qtt-header-class">Kelas :</div></td>
                    	<td class="qtt-data"><?php if(count($records) > 0) { echo $class_name; } else { echo "No data"; } ?></td>
        			</tr>
                 
                	<tr>
                		<td class="qtt_title"><div class="qtt-header-race">Babak :</div></td>
                    	<td class="qtt-data"><?php if(count($records) > 0) { echo $qtt_name; } else { echo "No data"; } ?></td>
                	</tr>
                    
                    <tr>
                		<td class="qtt_title"><div class="qtt-header-starter">Starter : </div></td>
           				<td class="qtt-data"><?php if(count($records) > 0) { echo $starter . ' Racers'; } else { echo "No data"; } ?></td>
           			</tr>
                
                	<tr>
                		<td class="qtt_title"><div class="qtt-header-race-type">Race Type : </div></td>
           				<td class="qtt-data"><?php if(count($records) > 0) { echo $race_type; } else { echo "No data"; } ?></td>
           			</tr>
                
                	<tr>
                		<td class="qtt_title"><div class="qtt-header-race-laps">Laps :</div></td>
                    	<td class="qtt-data"><input type="text" name="laps" id="laps" /></td>
               		</tr>
                
                	<tr>
                		<td class="qtt_title"><div class="qtt-header-race-count">Race :</div></td>
                    	<td class="qtt-data"><input type="text" name="race_count" id="race-count" /></td>
                	</tr>
                    
                    <tr>
                    	<?php
							
							if(sizeof($records) > 0)
							{
								switch($race_type)
								{
                					case "Best":
										echo '<td class="qtt_title"><div class="qtt-header-pick">Pick :</div></td>';
                    					echo '<td class="qtt-data"><input type="text" name="race_pick" id="race-pick" /></td>';
								}
							}
						
						?>
                	</tr>
                	
                </table><!--qtt-header-->
            
           		<table id="all-racer"><!--all-racer-->
                
                	<?php if(sizeof($records) > 0) :?>
                    
    				<tr>
                    	<th>No</th>
    					<th>N.S</th>
    					<th>Name</th>
                        <th>Pengda</th>
                        <th>Team</th>
                        <th>Kendaraan</th>
                        <th>Time</th>
                        
                        <?php 
						
							if(sizeof($records) > 0)
							{
								switch ($race_type)
								{
									case "Point System":
										echo '<th>Point I</th>';
										echo '<th>Point II</th>';
										echo '<th>Total</th>';
										break;
										
									case "Grid" :
										echo '<th>Grid</th>';
										break;
								
									case "Best" :
										echo '<th>Ranking</th>';
										break;
								}
							}
						
						?>
                        
                    </tr>
                    
                    
                    <?php $i = 1 ?>
                            
                    <?php foreach($records as $row): ?>
                    
                    	<tr>
                        	<td class="racer_no_col_qttlist"><?php echo $i++ ?></td>
                            
    						<td class="racer_ns_col"><?php echo $row->racer_id ?></td>
                            <input type="hidden" name="racer_number[]" value="<?php echo $row->racer_id ?>" />
                            
    						<td class="racer_name_col"><?php echo anchor("racers/edit/$row->racer_id", "$row->racer_name") ?></td>
                            <input type="hidden" name="racer_name[]" value="<?php echo $row->racer_name ?>" />
                            
                            <td class="racer_pengda_col"><?php echo $row->pengda_name ?></td>
                            <input type="hidden" name="racer_pengda[]" value="<?php echo $row->racer_pengda ?>" />
                            
    						<td class="racer_team_col"><?php echo $row->racer_team ?></td>
                            <input type="hidden" name="racer_team[]" value="<?php echo $row->racer_team ?>" />
                            
                            <td class="racer_vehivle_col"><?php echo $row->racer_vehicle ?></td>
                            <input type="hidden" name="racer_vehicle[]" value="<?php echo $row->racer_vehicle ?>" />
                            
                            <td class="racer_time_col"><input type="text" name="racer-time[]" class="summary-racer-time" /></td>
                            
							<?php 
							
                            	switch ($race_type)
                     			{	
                            		case "Best" :
										echo '<td class="racer_time_col"><input type="text" name="racer-best[]" id="racer-best" /></td>';
										break;
										
									case "Grid" :
										echo '<td class="racer_time_col"><input type="text" name="racer-grid[]" class="summary-racer-grid" /></td>';
										break;	
										
									case "Point System" :
										echo '<td class="racer_point_one_col"><input type="text" name="racer-point-one[]" id="point_one" /></td>';
										echo '<td class="racer_point_two_col"><input type="text" name="racer-point-two[]" id="point_two" /></td>';
										echo '<td class="racer_total_col"><input type="text" name="total[]" id="total" /></td>';
										break;
											
                   				}
					
							?>
                            
                            <input type="hidden" name="class_id" value="<?php echo $row->class_id ?>" />
                            <input type="hidden" name="class_name" value="<?php echo $row->class_name ?>" />
                            <input type="hidden" name="race_type" value="<?php echo $row->race_type_name ?>" />
                            <input type="hidden" name="qtt" value="<?php echo $row->qtt_id ?>" />
                                                         
                        </tr>
                    
                    <?php endforeach ?>
                    
               		<?php echo form_close() ?>
                
                <?php else: ?>
                
                	<td style="text-align:center">Empty data</td>
                	
                <?php endif ?>
                
                 </table><!--/all-racer-->
                 
                 <?php if(sizeof($records) > 0): ?>
                 	<div id="qtt-save"><!--qtt-save-->
                		<input type="submit" name="submit-race" value="Save" id="save-qtt" />
                	</div><!--/qtt-save-->
                 <?php endif ?>
                  
            </div><!--/table-data-->
        
        </div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->

</body>
</html>
