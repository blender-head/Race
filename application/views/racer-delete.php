<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo css_asset('add-racer.css'); ?>
<script type="text/javascript" src="<?php echo js_asset_url('jquery-1.7.2.min.js', '') ?>"></script>

</head>

<body>




	
        
        	
        	
            	<div class="form-delete">
                
                	<p>Are you sure you want to delete racer <span class="confirm">#<?php echo $racer_number ?></span>, <span class="confirm"><?php echo $racer_name ?></span>, from the database?</p>
                    
                    
                    	<?php echo anchor("racers/edit/$racer_number", 'Cancel', 'id="delete-cancel"'); ?>
                         <div class="clear"></div>
					 <?php echo anchor("racers/delete/$racer_number", 'Delete', 'id="delete-yes"'); ?>
                  	
                    
                    
                     <div class="clear"></div>
                   <?php
				   	
				   ?>
                
                </div>
                
               
    	
    		
        




</body>
</html>
