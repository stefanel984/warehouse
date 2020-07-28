<?php
include("../connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('../lib/class_warehouse.php');

?>
<style>
.choice{
	width:330px;
}
.choice option{
	width:330px;
}
</style>
<div style="margin-top:20px; margin-left:30px;">
	<table>
		<tr><td>Продукт:</td><td> <input type='text' name='name' size='30' value='' id='name' class='product'></td></tr>
		<tr><td>Шифра:</td><td><b><input type='text' name='number' size='30' value='' id='number' class='product'></td></tr>
		<tr><td>Цена: </td><td><input type='number' name='price' size='10' value='' class='product'></td></tr>
<?php 
 $comp_type=allTypeCompressor();
?>
		<tr><td>Компресор:</td><td><select name='compressor' class='product choice'>
		                            <?php foreach($comp_type as $type){?>
		                            <option value='<?php echo $type['id'] ?>'><?php echo $type['tip_kompresor'];?></option>
									<?php } ?>
		                            </select></td></tr>
		<tr><td>Количина: </td><td><input type='number' name='qty' size='10' value='' class='product'></td></tr>							
	</table>
	<br/>
	<br/>
	<div>
		<input type='button' id='addBtn' value='Зачувај' />
		<input type='button' id='closeBtn' value='Затвори' />
	</div>	
</div>