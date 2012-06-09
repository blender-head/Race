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



<div id="wrapper"><!--wrapper-->
    
    <div id="content"><!--content-->
    
    	<div id="data"><!--data-->
        	
            
            
  
            
            <div id="table-data"><!--table-data-->
            	
                
            	<form action="http://localhost/race/index.php/racers/get_racer_test" method="post">
                
            		<table id="all-racer"><!--all-racer-->
    					
                    	
                        	<tr>
                            	<th scope="col">No</th>
    							<th scope="col">N.S</th>
    							<th scope="col">Name</th>
                            	<th scope="col">Pengda</th>
                            	<th scope="col">Team</th>
                                <th scope="col">Kendaraan</th>
                                <th scope="col">Qtt</th>
                                
                                
    						</tr>
                            
                            
                            
                            <!--output the query from racers_model->list_racer_by_class($id)-->
                            
    						
                          
                            	
    							
                                <input type="text" name="racer" id="racer_number" value="19"/>
                         
                             
                                                                                      
                            
                            
                            
                            </table><!--/all-racer-->
                  
                  			<div class="button"><input id="make-qtt" type="submit" name="submit-qtt" value="Generate Division" /></div>
                    		<p id="test"></p>
                  			</form>
                            
                        <!--if we have no records-->
            			
                  
                  			
                        
                  	
            
            </div><!--/table-data-->
        
        </div><!--/data-->
    
    </div><!--/content-->
    
</div><!--/wrapper-->

<script type="text/javascript">

$('input#racer_number').keyup(function() {
	
	var form_data = {
		id : $(this).val(),
	};
	
	$.ajax({
		url : "<?php echo site_url('racers/get_racer_test') ?>",
		type : 'POST',
		data : form_data,
		success : function(msg) {
				$('#test').html(msg);
			}
		
	});
	
	return false;
	
});

</script>

</body>
</html>
