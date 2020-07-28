<?php
include("../connection.php");
require('class_warehouse.php');
$id=$_POST['id'];
$value=$_POST['value'];
$price=$_POST['price'];
$product_detail=takeProduct($id);
$back="<tr>
				<td width='300px' align='center'>".$product_detail[0]['name']."</td>
				<td width='200px' align='center'>".$product_detail[0]['product_number']."</td>
				<td width='100px' align='center'>".$value."<input type='hidden' value=".$value." name=".$product_detail[0]['product_number']." class='takeInput' /></td>
				<td width='100px' align='center'>".$price."<input type='hidden' value=".$price." name='price_".$id."' class='takeInput' /></td>
				<td width='150px' align='center'><span class='deleteInput'>-</span></td>
				
		</tr>";
			   
echo $back;

?>