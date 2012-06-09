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
        
        </div><!--/header-bottom-->
    
    </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        	
            
        		<h1 class="racers-class">Racers</h1>
            
         
            
            
            
            <div id="table-data"><!--table-data-->
            	
                <!--sends data to qtt function in racers controller-->
            	<?php echo form_open('racers/qtt') ?> 
                
            		<table id="all-racer"><!--all-racer-->
    					
                    	
                        	<tr>
                            	<th scope="col">Time</th>
    							<th scope="col">Race</th>
    							<th scope="col">Babak</th>
                            	<th scope="col">Lap</th>
                            	<th scope="col">Kelas</th>
                                <th scope="col">Keterangan</th>
                                                          
    						</tr>
                            
                            
                            
                            <!--output the query from racers_model->list_racer_by_class($id)-->
                            
    						
                            <tr>
                            	<td class="race-time-schedule"><input type="text" /></td>
                                
    							<td class="race-schedule"><!--send qtt_id to qtt function inside racers controller-->
                                	<select name="qtt[]" id="qtt">
                                    			<?php 
												
													for($i=1;$i<50;$i++)
													{
														echo '<option>';
														echo $i;
														echo '</option>';
													}
                                            	?>
                                         		
                                        </select></td>
                               
    							
                                <td class="race-babak">
                                <select name="qtt[]" id="qtt">
                                	<?php foreach($qtt as $qtt_name): ?>
                                		<option value="<?php echo $qtt_name->qtt_id ?>"><?php echo $qtt_name->qtt_name ?></option>
                                   	<?php endforeach ?>
                                    </select>
                                    </td>	
                              
                                
                                                           
                                
                                <td class="racer_vehivle_col"><input type="text" /></td>
                               
                              
                                	
                               	<td class="racer_class_col">
                                	<select name="class_name[]" id="qtt">
                                	<?php foreach($class as $class_name): ?>
                                		<option value="<?php echo $class_name->class_id ?>"><?php echo $class_name->class_name ?></option>
                                   	<?php endforeach ?>
                                    </select>
                                	
                               </td>
                                    
                               <td class="racer_type_col">
                               		<!--send race_type_id to qtt function inside racers controller-->
                                  	<input type="text" />
                              </td>
                             
                           </tr>
                            
                            </table><!--/all-racer-->
                  
                  			<div class="button"><input id="make-qtt" type="submit" name="submit-qtt" value="Generate Division" /></div>
                    
                  			<?php echo form_close() ?>
                            
                        <!--if we have no records-->
            			
                  
 
                  		<!--if we have no records-->
                        
                  	
            
            </div><!--/table-data-->
        
        </div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->

</body>
</html>
