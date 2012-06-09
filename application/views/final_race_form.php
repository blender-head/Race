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
            
            </div><!--/header-bottom-right-->
        
        </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        
        	<form method="post" action="http://localhost/race/index.php/final_race/save_final_result" id="save_qtt">
            
            <?php 
			
				if((count($records_1) > 0) && (count($records_2) > 0))
				{
					for($y=0;$y<count($records_1);$y++)
					{
						$class_name = $records_1[$y]->class_name;
						$race_type = $records_1[$y]->race_type_name;	
						$class_id = $records_1[$y]->class_id;	
					}
				}
				
				
			?>
            	
        
        	<div id="table-data"><!--table-data-->
            	
				<table id="qtt-header"><!--qtt-header-->
                	
                    <tr>
                		<td class="qtt_title">Kelas :</td>
                    	<td class="qtt-data"><?php echo $class_name ?></td>
        			</tr>
                 
                	<tr>
                		<td class="qtt_title">Babak :</td>
                    	<td class="qtt-data"><?php echo $final ?></td>
                	</tr>
                    
                    <tr>
                		<td class="qtt_title">Starter : </td>
           				<td class="qtt-data"><?php echo (count($records_1)) + (count($records_2)) ?></td>
           			</tr>
                
                	<tr>
                		<td class="qtt_title">Race Type : </td>
           				<td class="qtt-data"><?php echo $race_type ?></td>
           			</tr>
                
                	<tr>
                		<td class="qtt_title">Laps :</td>
                    	<td class="qtt-data"><input type="text" name="laps" id="laps" /></td>
               		</tr>
                
                	<tr>
                		<td class="qtt_title">Race :</td>
                    	<td class="qtt-data"><input type="text" name="race_count" id="race-count" /></td>
                	</tr>
                    
                    <tr>
                    	<?php
							
							/*
							if(sizeof($records) > 0)
							{
								switch($race_type)
								{
                					case "Best":
										echo '<td class="qtt_title">Pick :</td>';
                    					echo '<td class="qtt-data"><input type="text" name="race_pick" id="race-pick" /></td>';
								}
							}
							*/
						?>
                	</tr>
                	
                </table><!--qtt-header-->
            
           		<table id="all-racer"><!--all-racer-->
                
                	
                    
    				<tr>
                    	<th>No</th>
    					<th>N.S</th>
    					<th>Name</th>
                        <th>Pengda</th>
                        <th>Team</th>
                        <th>Kendaraan</th>
                        <th>Time</th>
                       	<th>Ranking</th>
				
                        
                    </tr>
                    
                    
                    
                            
                    <?php 
					
						$j = 0;
					
						for($i=0;$i<count($records_1);$i++)
						{
						
							echo '<tr>';
							echo '<td class="racer_ns_col">' . ++$j . '</td>';
							echo '<td class="racer_ns_col">' . $records_1[$i]->racer_id . '</td>';	
							echo '<input type="hidden" name="racer_id[]" value="' . $records_1[$i]->racer_id . '"/>';
							echo '<td class="racer_name_col">' . $records_1[$i]->racer_name . '</td>';
							echo '<input type="hidden" name="racer_name[]" value="' . $records_1[$i]->racer_name . '"/>';
							echo '<td class="racer_pengda_col">' . $records_1[$i]->pengda_name . '</td>';
							echo '<input type="hidden" name="racer_pengda[]" value="' . $records_1[$i]->pengda_name . '"/>';
							echo '<td class="racer_team_col">' . $records_1[$i]->racer_team . '</td>';
							echo '<input type="hidden" name="racer_team[]" value="' . $records_1[$i]->racer_team . '"/>';
							echo '<td class="racer_vehivle_col">' . $records_1[$i]->racer_vehicle . '</td>';
							echo '<input type="hidden" name="racer_vehicle[]" value="' . $records_1[$i]->racer_vehicle . '"/>';
							echo '<td class="racer_time_col"><input type="text" name="racer-time[]" /></td>';
							echo '<td class="racer_time_col"><input type="text" name="racer-best[]" /></td>';
							echo '</tr>';
						}
						
						for($z=0;$z<count($records_2);$z++)
						{
						
							echo '<tr>';
							echo '<td class="racer_ns_col">' . ++$j . '</td>';
							echo '<td class="racer_ns_col">' . $records_2[$z]->racer_id . '</td>';	
							echo '<input type="hidden" name="racer_id[]" value="' . $records_2[$z]->racer_id . '"/>';
							echo '<td class="racer_name_col">' . $records_2[$z]->racer_name . '</td>';
							echo '<input type="hidden" name="racer_name[]" value="' . $records_2[$z]->racer_name . '"/>';
							echo '<td class="racer_pengda_col">' . $records_2[$z]->pengda_name . '</td>';
							echo '<input type="hidden" name="racer_pengda[]" value="' . $records_2[$z]->pengda_name . '"/>';
							echo '<td class="racer_team_col">' . $records_2[$z]->racer_team . '</td>';
							echo '<input type="hidden" name="racer_team[]" value="' . $records_2[$z]->racer_team . '"/>';
							echo '<td class="racer_vehivle_col">' . $records_2[$z]->racer_vehicle . '</td>';
							echo '<input type="hidden" name="racer_vehicle[]" value="' . $records_2[$z]->racer_vehicle . '"/>';
							echo '<td class="racer_time_col"><input type="text" name="racer-time[]" /></td>';
							echo '<td class="racer_time_col"><input type="text" name="racer-best[]" /></td>';
							echo '</tr>';
						}
                    	
                    ?>
                    
                 </table>  
                    
                  <div id="qtt-save"><!--qtt-save-->
                		<input type="submit" name="submit-race" value="Save" id="save-qtt" />
                	</div><!--/qtt-save-->  
                    
               
                            
               
	
            	</form>
                
                
                  
            </div><!--/table-data-->
        
        </div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->

</body>
</html>
