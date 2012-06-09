<?php 

	session_start(); 
	$_SESSION['qtt_link'] = $qtt_link;
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
        
        </div><!--/header-bottom-->
    
    </div><!--/header-->
    
</div><!--/header-wrapper-->
    
<div class="clear"></div>

<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        
        	<h1><?php echo $title[0] ?> Race Division</h1>
            
            <div id="table-data"><!--table-data-->
            
            	<table id="all-racer"><!--all-racer-->
            
            		<?php 
				
						//$qtt_num = array_pop($count); 
						//print_r($qtt_id_unique);
						//echo '<br />';
						//print_r($qtt_link_unique);
						
						for($i=0;$i<count($qtt_link);$i++)
						{
					
							//echo $i;
					
							echo '<div id="qtt-link">';
							
							//make link to qttlist function, with parameter qtt id and class id
							echo '<h2 class="racer-qtt">' . anchor("racers/qttlist/$qtt_id[$i]/$class_id", $qtt_link[$i]) . '</h2>';
							
							echo '</div>';
							
						}
		
					?>
            
        		</table><!--all-racer-->
     
     		</div><!--/table-data-->
        
     	</div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->


</body>
</html>
