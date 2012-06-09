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
                    <li><?php echo anchor('racers/add', 'Add Racer', 'class="add-racer"') ?></li>
                    <li><a href="" class="race-summary">Race Summary</a>
                    	<ul id="race-summary-sub">
                        	<?php if(sizeof($class) > 0) : ?>
                        		<?php foreach($class as $list): ?>
                            		<li><?php echo anchor("racers/race_summary_by_class/$list->class_id", "$list->class_name") ?></li>      
                                <?php endforeach ?>
                            <?php endif ?>    
                    </li>
                </ul><!--/menu-->
            
            </div><!--/header-bottom-right-->
        
        </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        
        	<form method="post" action="http://localhost/race/index.php/racers/save_qtt" id="save_qtt">
        
        	<table id="qtt-header"><!--qtt-header-->
            	<tr>
                	<td class="qtt_title">Kelas :</td>
                    <td class="qtt-data"><?php echo $class_name ?></td>
        		</tr>
                
                <tr>
                	<td class="qtt_title">Babak :</td>
                    <td class="qtt-data"><?php echo $qtt_name[0]['qtt_name'] ?></td>
                </tr>
                
                <tr>
                	<td class="qtt_title">Starter : </td>
           			<td class="qtt-data"><?php echo $starter ?> Racers</td>
           		</tr>
                
                <tr>
                	<td class="qtt_title">Race Type : </td>
           			<td class="qtt-data"><?php echo $race_type ?></td>
           		</tr>
                
                <tr>
                	<td class="qtt_title">Laps :</td>
                    <td class="qtt-data"><input if (form_error('laps')) { echo 'class="input-error"'; } type="text" name="laps" id="laps" /><div class="form-error"><span class="td-error"></td>
               	</tr>
                
                <tr>
                	<td class="qtt_title">Race :</td>
                    <td class="qtt-data"><input type="text" name="race_count" id="race-count" /><div class="form-error"></td>
                </tr>
                	
            </table><!--/qtt-header-->
             
             
       		<div id="table-data"><!--table-data-->
            
            	<table id="all-racer"><!--all-racer-->
    				<tr>
    					<th scope="col">N.S</th>
    					<th scope="col">Name</th>
                        <th scope="col">Pengda</th>
                        <th scope="col">Team</th>
                        <th scope="col">Kendaraan</th>
                        
                        <?php 
							switch ($race_type)
							{
								case "Point System":
									echo '<th scope="col">Time</th>';
									break;
										
								case "Grid" :
									echo '<th scope="col">Grid</th>';
									break;
								
								case "Best" :
									echo '<th scope="col">Ranking</th>';
									break;
							}
						
						?>
                        
                    </tr>
                            
                    <?php foreach($records as $row): ?>
                    
                    	<tr>
    						<td class="racer_ns_col"><?php echo $row->racer_number ?></td>
                            <input type="hidden" name="racer_number[]" value="<?php echo $row->racer_number ?>" />
                            
    						<td class="racer_name_col"><?php echo anchor("racers/edit/$row->racer_id", "$row->racer_name") ?></td>
                            <input type="hidden" name="racer_name[]" value="<?php echo $row->racer_name ?>" />
                            
                            <td class="racer_pengda_col"><?php echo $row->pengda_name ?></td>
                            <input type="hidden" name="racer_pengda[]" value="<?php echo $row->racer_pengda ?>" />
                            
    						<td class="racer_team_col"><?php echo $row->racer_team ?></td>
                            <input type="hidden" name="racer_team[]" value="<?php echo $row->racer_team ?>" />
                            
                            <td class="racer_vehivle_col"><?php echo $row->racer_vehicle ?></td>
                            <input type="hidden" name="racer_vehicle[]" value="<?php echo $row->racer_vehicle ?>" />
                            
							<?php 
							
                            	switch ($race_type)
                     			{	
                            		case "Best" :
										echo '<td class="racer_time_col"><input type="text" name="racer-best[]" /></td>';
										break;
										
									case "Grid" :
										echo '<td class="racer_time_col"><input type="text" name="racer-point[]" /></td>';
										break;	
										
									case "Point System" :
										echo '<td class="racer_time_col"><input type="text" name="racer-grid[]" /></td>';
										break;
											
                   				}
					
							?>
                            
                            <input type="hidden" name="class_id" value="<?php echo $row->class_id ?>" />
                            <input type="hidden" name="class_name" value="<?php echo $row->class_name ?>" />
                            <input type="hidden" name="race_type" value="<?php echo $row->race_type_name ?>" />
                            <input type="hidden" name="qtt" value="<?php echo $row->qtt_id ?>" />
                                                         
                        </tr>
                    
                    <?php endforeach ?>
                    
                </table><!--/all-racer-->
                            
                <input type="hidden" name="race_type" value="<?php echo $row->race_type_name ?>" />
                            
                <div id="qtt-save"><!--qtt-save-->
                	<input type="submit" name="submit-race" value="Save" id="save-qtt" />
                </div><!--/qtt-save-->
	
            	<?php echo form_close() ?>
                 
            
            </div>
        
        </div>
    
    </div>
    
    

</div>

</div>

</body>
</html>
