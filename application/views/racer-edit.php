<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<?php echo css_asset('add-racer.css'); ?>
<script type="text/javascript" src="<?php echo js_asset_url('jquery-1.7.2.min.js', '') ?>"></script>
<script>
	$(document).ready(function(){
             $("#delete-btn").click(function() {
  alert("Handler for .click() called.");
});
});
        }); 
</script>

</head>

<body>

<div id="wrapper">

	<div id="form-racer">
   		<?php echo image_asset('ngepottt.png', '', array('alt'=>'form-racer', 'width'=>680, 'height'=>311)) ?>
	</div>

	<div id="form-wrapper">

		<div id="form-data">
        
        	<?php echo form_open('racers/update') ?>
        	
            	<div class="form-item">
        			<label for="racer-number">Number <span class="asterisk">*</span>: </label>
            		<input <?php if (form_error('racer-number')) { echo 'class="input-error"'; } ?> type="text" name="racer-number" id="racer-number" value="<?php echo $racer_number; ?>" />
                	<div class="form-error"><span><?php echo form_error('racer-number') ?></span></div>
        		</div>
            
            	<div class="form-item">
        			<label for="racer-name">Name <span class="asterisk">*</span>: </label>
            		<input type="text" name="racer-name" id="racer-name" value="<?php echo $racer_name ?>" />
        		</div>
            
             	<div class="form-item">
        			<label for="racer-pengda">Pengda <span class="asterisk">*</span>: </label>
            		<select name="racer-pengda" id="racer-pengda">
                		<?php if (sizeof($pengda) > 0) : ?>
                    		<?php foreach ($pengda as $value): ?>
                        		<option value="<?php echo $value->pengda_id ?>" <?php if ($pengda_selected->pengda_name == $value->pengda_name) {echo 'selected="' . $pengda_selected->pengda_name . '"'; } ?>><?php echo $value->pengda_name ?></option>
                        	<?php endforeach ?>
                    	<?php endif ?>
                	</select>
        		</div>
            
            	<div class="form-item">
        			<label for="racer-team">Team <span class="asterisk">*</span>: </label>
            		<input type="text" name="racer-team" id="racer-team" value="<?php echo $racer_team ?>" />
           		</div>
            
            	<div class="form-item">
        			<label for="racer-vehicle">Vehicle <span class="asterisk">*</span>: </label>
            		<input type="text" name="racer-vehicle" id="racer-vehicle" value="<?php echo $racer_vehicle; ?>" />
               	</div>
            
            	<div class="form-item">
        			<label for="racer-class">Main Class <span class="asterisk">*</span>: </label>
            		<select name="racer-class" id="racer-class">
                		<?php if (sizeof($option) > 0) : ?>
                    		<?php foreach ($option as $value): ?>
                        	<option value="<?php echo $value->class_id ?>" <?php if ($class_name->class_name == $value->class_name) {echo 'selected="' . $class_name->class_name . '"'; } ?>><?php echo $value->class_name ?></option>
                        	<?php endforeach ?>
                    	<?php endif ?>
                	</select>
        		</div>
                
                <div class="form-item-add">
        		<label for="racer-class-add" id="label-racer">Additional Class : </label>
            	
                	<?php if (sizeof($option) > 0) : ?>
                    	
                    	<?php foreach ($option as $value): ?>
                        	<p class="checkbox-class"><input <?php if(!empty($add_class)) { for($i=0;$i<count($add_class);$i++) { if ($value->class_id == $add_class[$i]) { echo 'checked = "checked"';} } } ?> name="racer-class-add[]" type="checkbox" id="racer-class-add" <?php if($value->class_name == $class_name->class_name) { echo 'disabled="disabled"'; echo ' class="disabled"';}?> value="<?php echo $value->class_id ?>"><?php echo $value->class_name ?></p>
                        
                        <?php endforeach ?>
                        
                    <?php endif ?>
            </div>
                
                <td><input type="hidden" value="<?php echo $racer_number ?>" name="racer_number"/></td>
            
            	<table id="button-wrapper">
					<tr>
            			<td><input type="submit" value="Update Racer" id="update-btn" name="update"/></td>
	            		<td><input type="submit" value="Delete Racer" id="delete-btn" name="delete"/></td>
                	</tr>
               </table>
    	
    		<?php echo form_close() ?>
        
    	</div>

	</div>

</div>

</body>
</html>
