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
                    <li><?php echo anchor('', 'Administer', 'class="race-summary"') ?>
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
                    					echo '<li>' . anchor("final_race/display_final_result/$class_id[$i]/$race_types[$i]", "$class_name[$i]") . '</li>';
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
        
        	<h1 id="all-racer">All Racers</h1>
            
            <div id="add-racer-wrapper">
            	<a href="http://localhost/race/index.php/racers/add" id="add-racer">Add Racer</a>
            </div>
            
            <div class="clear"></div>
			
			<div id="table-data"><!--table-data-->
            
            	<table id="all-racer"><!--all-racer-->
    						
            		<?php if(sizeof($records) > 0) : ?>
                		<tr>
                        	<th scope="col">No</th>
    						<th scope="col">N.S</th>
    						<th scope="col">Name</th>
                    		<th scope="col">Pengda</th>
                    		<th scope="col">Team</th>
                    		<th scope="col">Kendaraan</th>
                    		<th scope="col">Kelas</th>
    					</tr>
                        
                        <?php $i = 1 ?>    
                    	<?php foreach($records->result() as $row): ?>
    						
                    	<tr>
                        	<td class="racer_ns_no"><?php echo $row->id ?></td>
    						<td class="racer_ns_col"><?php echo $row->racer_number ?></td>
    						<td class="racer_name_col"><?php echo anchor("racers/edit/$row->racer_number", "$row->racer_name") ?></td>
                           	<td class="racer_pengda_col"><?php echo $row->pengda_name ?></td>
    						<td class="racer_team_col"><?php echo $row->racer_team ?></td>
                           	<td class="racer_vehivle_col"><?php echo $row->racer_vehicle ?></td>
                           	<td class="racer_class_col"><?php echo $row->class_name ?></td>
                       	</tr>
                            
                   		<?php endforeach ?>
                            
                	<?php else: ?>
                  
                  		<tr>
                        	<td><?php echo "You have " . sizeof($records) . " racer" ?>
                        </tr>
                  
                  <?php endif ?>
                  
                  </table><!--/all-racer-->
                  
                 	<?php echo $this->pagination->create_links(); ?>
            		
			</div><!--/table-data-->
        
        </div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->  

</body>
</html>
