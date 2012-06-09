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
                    <li><?php echo anchor('', 'Race Summary', 'class="race-summary"') ?></a>
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
                     
                </ul><!--/menu-->
            
            </div><!--/header-bottom-right-->
        
        </div><!--/header-bottom-->
    
    </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        
        	<div class="race-div-wrapper">
            	<h1 class="race-division">Race Schedules</h1>
            </div>
        
			<?php
			
				if(sizeof($links) > 0)
				{
					for($i=0;$i<count($links);$i++)
            		{
						echo '<div class="division-links">';
                		echo '<div class="division-header-wrapper"><h2>' . $links[$i]->class_name . '</h2></div>';
                		echo '<ul>';
						
						if($links[$i]->status == "done")
						{
                			echo '<li>' . $links[$i]->qtt_name . image_asset('done.png', '', array('width'=>20, 'height'=>20, 'class'=>'done')) . '</li>';
						}
						else
						{
							echo '<li>' . anchor("racers/qttlist/" . $links[$i]->qtt_id . '/' . $links[$i]->class_id, $links[$i]->qtt_name). '</li>';	
						}
                		echo '<ul>';
						echo '</div>';
            		}
				}
				else
				{
					echo '<div class="division-links">';
					echo '<h2>We have no race schedule yet</h2>';
					echo '</div>';			
				}
			
			?>
			
		</div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->


</body>
</html>
