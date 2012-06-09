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
                    <li><?php echo anchor('racers/division_links', 'Race Schedule', 'class="race-schedule"') ?></li>
                    <li><?php echo anchor('racers/division_links', 'Race Summary', 'class="race-summary"') ?>
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
                    					echo '<li>' . anchor("final_race/display_final_result/$class_ids[$i]/$race_types[$i]", "$class_name[$i]") . '</li>';
                                    }
                                ?>
                        	</ul>
                        </li>
                    <?php endif ?>
                </ul><!--/menu-->
                
            </div><!--/header-bottom-right-->
        
        </div><!--/header-bottom-->
    
    </div><!--/header-->
    
</div><!--header-wrapper-->

<div class="clear"></div>

<div id-"wrapper"><!--wrapper-->
    
	<div id="content"><!--content-->
    
		<div id="data"><!--data-->
        
    		<div id="table-data"><!--table-data-->
            
        		<?php
					foreach($titles as $title)
					{
						echo '<h1 id="division-link">' . $title. ' Race Summary</h1>';		
					}
				?>
                        
            	<table id="all-racer"><!--all-racer-->
            
            		<?php 
			
						$i = 0;
					
						foreach ($qtt_name as $link)
						{
							
							switch($race_name)
							{
								case "Best":
								
									if(!isset($pick[$i])) 
									{
										$pick[$i] = 0;	
									}
								
									echo '<tr>';
									echo '<td class="racer_name_col">' . anchor("racers/list_summary/$qtt_id[$i]/$pick[$i]/$race_type/$class_id", $link) . '</td>';
									echo '</tr>';
								
									$i++;
							
									if($i == count($qtt_name))
									{
										$i = NULL;	
									}
								
									break;
							
								case "Point System":
									echo '<tr>';
									echo '<td class="racer_name_col">' . anchor("racers/list_summary/$qtt_id[$i]/0/$race_type/$class_id", $link) . '</td>';
					
									$i++;
							
									if($i == count($qtt_name))
									{
										$i = NULL;	
									}
							
									break;
							
								case "Grid":
									echo '<tr>';
									echo '<td class="racer_name_col">' . anchor("racers/list_summary/$qtt_id[$i]/0/$race_type/$class_id", $link) . '</td>';
					
									$i++;
							
									if($i == count($qtt_name))
									{
									$i = NULL;	
									}
							
									break;
							}
						}
				
					?>
            
            	</table><!--/all-racer-->
            
            	<?php echo form_open('final_race/final_form') ?>
            
            		<?php if($link == "Race I"): ?>
                		<div class="final-button-race-2"><!--final-button-race-2-->
            				<input type="submit" name="final" value="Go to Race II" id="final-submit-race-2" />
                    	</div><!--/final-button-race-2-->
                	<?php else :?>
                		<div class="final-button"><!--final-button-->
                			<input type="submit" name="final" value="Go to Final" id="final-submit" />
                    	</div><!--/final-button-->
                	<?php endif ?>
                
                	<?php $i = 0; ?>
                	<?php foreach($qtt_id as $id) :?>
                		<input type="hidden" name="qtt[]" value="<?php echo $id ?>" />
                    
					<?php 
                    	switch($race_name)
						{
							case "Best":
								echo '<input type="hidden" name="pick[]" value="' . $pick[$i] . '" />';
						}
					?>
                    
						<?php $i++ ?>
                	<?php endforeach ?>
                
                	<input type="hidden" name="race_type" value="<?php echo $race_type ?>" />
                	<input type="hidden" name="class_id" value="<?php echo $class_id ?>" />
               
             	<?php echo form_close() ?>
           
			</div><!--/table-data-->
        
		</div><!--/data-->
    
	</div><!--/content-->
    
</div><!--/wrapper-->
    
</body>
</html>
