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

<div id="header-wrapper">

	<div id="header">
    
   	  	<div id="header-top">
        
        	<h2>The Master Of Matic Race</h2>
            <h3 class="championship">Championship 2012</h3>
            <h3 class="circuit">INT'L KARTING CIRCUIT SENTUL</h3>
        
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
            
            	<ul id="menu">
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
                    <li><a href="" class="race-summary">Race Summary</a></li>
                    <li><a href="racers/administer" class="race-administer">Administer</a></li>
                </ul>
            
            </div>
        
        </div>
    
    </div>
    
    <div class="clear"></div>
    
    <div id="content">
    
    	<div id="data">
        
        	<h1>Administer</h1>
            
            <div id="table-data">
            
            	
            
            	
    
    		</div>
    
	</div>



</body>
</html>
