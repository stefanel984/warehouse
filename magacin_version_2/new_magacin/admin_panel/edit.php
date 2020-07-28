<?php
include("../connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('../lib/class_warehouse.php');
$id=$_POST['id'];
?>
<?php
$product=takeProduct($id);
$qty=takeQtyOfProduct($product[0]['product_number']);
?>
<div style="margin-top:20px; margin-left:30px;">
	<table>
		<tr><td>Продукт:</td><td> <input type='text' name='name' size='30' value='<?php echo $product[0]['name'];?>' class='product'></td></tr>
		<tr><td>Шифра:</td><td><b><?php echo $product[0]['product_number']; ?></b></td></tr>
		<tr><td>Цена: </td><td><input type='text' name='price' size='10' value='<?php echo $product[0]['price'];?>' class='product'></td></tr>
		<tr><td>Количина: </td><td><input type='text' name='qty' size='10' value='<?php echo $qty[0]['qty'];?>' class='product'></td></tr>
<?php 
$tip_kompresor=selectCompressor($product[0]['id_compressor']); 
?>
		<tr><td>Компресор:</td><td><b><?php echo $tip_kompresor[0]['tip_kompresor']; ?></b></td></tr>
		<tr><td></td><td><input type='hidden' name='number' size='30' value='<?php echo $product[0]['product_number'];?>' class='product'></td></tr>
	</table>
	<br/>
	<br/>
	<div>
		<input type='button' id='saveBtn' value='Зачувај' />
		<input type='button' id='closeBtn' value='Затвори' />
	</div>	
</div>