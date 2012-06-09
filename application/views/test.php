<?php
echo "<table>";
 echo "<tr>";
  echo "<td>Field1</td>";
  echo "<td>Field2</td>";
  echo "<td>Field3</td>";
 echo "</tr>";
 
 foreach($query->result() as $row)
 { 
  echo "<tr>";
   echo "<td>".$row->racer_number."</td>";//use your table field here
   echo "<td>".$row->racer_pengda."</td>";//use your table field here
   echo "<td>".$row->racer_team."</td>";//use your table field here
  echo "</tr>"; 
 } 
echo "</table>";
?>


<table>
<tr><td>
<p>This is data p</p>
This is data out of p
<p>This is bold data p</p>
<b>This is bold data out of p</b><br />
This is normal data after br
<h3>H3 in a table</h3>
<div>This is data div</div>
This is data out of div
<div>This is data div (bold)</div>
This is data out of div
</td>
</tr></table>  