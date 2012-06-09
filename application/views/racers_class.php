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
<script type="text/javascript" src="<?php echo js_asset_url('popup.js', '') ?>"></script>

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
        
        <div id="header-bottom"><!--header-bottom-->
        
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
        
        </div><!--/header-bottom-->
    
    </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        	
            <?php if(sizeof($records) > 0) : ?>
        		<h1 class="racers-class"><?php echo $title ?> Racers</h1>
            <?php endif ?>
            
            <h2 class="info">Currently, there <?php if(count($records) > 1) { echo 'are'; } else { echo 'is'; } ?> <?php echo count($records) ?> <?php if(count($records) > 1) { echo 'racers'; } else { echo 'racer'; } ?> in this class</h2>
            
            <?php if(sizeof($exist) > 0): ?>
            <div id="popupContact">  
        		<a id="popupContactClose">x</a>  
        		<h1>Title of our cool popup, yay!</h1>  
        		<?php foreach ($exist as $double): ?>
            		<h2 class="data-exist"><?php echo $double ?></h2>
            	<?php endforeach ?>
    		</div>  
    		<div id="backgroundPopup"></div>  
            <?php endif ?>
             
           	<div id="table-data"><!--table-data-->
            	
                <!--sends data to qtt function in racers controller-->
            	<?php echo form_open('racers/qtt') ?> 
                
            		<table id="all-racer"><!--all-racer-->
    					
                    	<?php if(sizeof($records) > 0) : ?>
                        	<tr>
                            	<th scope="col">No</th>
    							<th scope="col">N.S</th>
    							<th scope="col">Name</th>
                            	<th scope="col">Pengda</th>
                            	<th scope="col">Team</th>
                                <th scope="col">Kendaraan</th>
                                <th scope="col">Qtt</th>
                                <th scope="col">Race Type</th>
                                
    						</tr>
                            
                            <?php $i = 1 ?>
                            
                            <!--output the query from racers_model->list_racer_by_class($id)-->
                            <?php foreach($records as $row): ?>
    						
                            <tr>
                            	<td class="racer_ns_no"><?php echo $i++ ?></td>
                                
    							
                                <td class="racer_ns_col"><?php echo $row->racer_number ?></td>
                                <input type="hidden" name="racer_number[]" value="<?php echo $row->racer_number ?>" />
    							
                                <td class="racer_name_col"><?php echo anchor("racers/edit/$row->racer_number", "$row->racer_name") ?></td>							
                                <input type="hidden" name="racer_name[]" value="<?php echo $row->racer_name ?>" />
                                
                                <td class="racer_pengda_col"><?php echo $row->pengda_name ?></td>
                                <input type="hidden" name="racer_pengda[]" value="<?php echo $row->pengda_id ?>" />
                                
    							<td class="racer_team_col"><?php echo $row->racer_team ?></td>
                                <input type="hidden" name="racer_team[]" value="<?php echo $row->racer_team ?>" />
                                
                                <td class="racer_vehivle_col"><?php echo $row->racer_vehicle ?></td>
                                <input type="hidden" name="racer_vehicle[]" value="<?php echo $row->racer_vehicle ?>" />
                                
                                <!--send class_id to qtt function inside racers controller-->
                                <input type="hidden" name="class_id" value="<?php echo $row->class_id ?>"/>
                                	
                               	<td class="racer_class_col">
                                	<!--send qtt_id to qtt function inside racers controller-->
                                	<select name="qtt[]" id="qtt">
                                    	<option value=""></option>
                                    	<?php if (sizeof($division > 0)) : ?>
                                    		<?php foreach ($division as $option) : ?>
                                            	<option value="<?php echo $option->qtt_id ?>"><?php echo $option->qtt_name ?>
                                                </option>
                                           <?php endforeach ?>
                                        <?php endif  ?>
                                        </select>
                               </td>
                                    
                               <td class="racer_type_col">
                               		<!--send race_type_id to qtt function inside racers controller-->
                                  	<select name="race_type[]" id="race_type">
                                   		<?php if (sizeof($race_type > 0)) : ?>
                               				<?php foreach ($race_type as $option) : ?>
                                        		<option value="<?php echo $option->race_type_id ?>"><?php echo $option->race_type_name ?></option>		
                                            <?php endforeach ?>
                                     <?php endif  ?>
                                     </select>
                              </td>
                             
                                                                                      
                            <?php endforeach ?>
                            <!--output the query from racers_model->list_racer_by_class($id)-->
                            
                            </table><!--/all-racer-->
                  
                  			<div class="button"><input id="make-qtt" type="submit" name="submit-qtt" value="Generate Division" /></div>
                    
                  			<?php echo form_close() ?>
                            
                        <!--if we have no records-->
            			<?php else: ?>
                  
                  			<tr>
                        		<td><?php echo "You have " . sizeof($records) . " racer" ?>
                        	</tr>
                  
                  		<?php endif ?>
                  		<!--if we have no records-->
                        
                  	
            
            </div><!--/table-data-->
        
        </div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->

</body>
</html>
