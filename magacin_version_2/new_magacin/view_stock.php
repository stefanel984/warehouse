<?php
include("connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('lib/class_warehouse.php');


 ?>
 <?php
    $products_qty=lagerList();
 ?>
<script>
$(document).ready(function() {
    $('#storeTable').DataTable( {
		 "columnDefs": [
            {
                "targets": [ 3 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			{
                "targets": [ 4 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			{
                "targets": [ 5 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			
		],
        "lengthMenu": [[5,10, 15], [5,10, 15]]	
    } );
} );
</script> 
<div style="margin-left:20px; margin-top:10px;">
Последни налози:<br/>
<?php
	$last_input=lastInput();
	$last_output=lastOutput();
	if(isset($last_input[0])){
?>
<a href="<?php echo "preview.php?id=".$last_input[0]['id']."&type=input";?>" target="_blank"><?php echo $last_input[0]['order_number_in']; ?> </a><br/>
<?php
	}
	if(isset($last_output[0])){
?>
<a href="<?php echo "preview.php?id=".$last_output[0]['id']."&type=output";?>" target="_blank"><?php echo $last_output[0]['order_number_out']; ?> </a>
<?php
	}
?>
</div>
<div id="show_qty">
	<table id="storeTable" class="display" cellspacing="0"  width="100%" >
		<thead>
			<tr>
				<th width="30%">Производ</th>
				<th width="30%">Компресор тип</th>
				<th width="25%">Шифра</th>
				<th width="4%">Количина</th>
				<th width="6%">Цена</th>
				<th width="6%">Вкупно продукт</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			   $suma=0;
			   foreach($products_qty as $product_qty){
				   $suma=$suma+($product_qty['price']*$product_qty['qty']);
			 ?>
			  <tr>
				 <td><?php echo $product_qty['name']; ?></td>
				 <td><?php echo $product_qty['tip_kompresor']; ?></td>
				 <td><?php echo $product_qty['product_number']; ?></td>
				 <td align="center"><?php echo $product_qty['qty']; ?></td>
				 <td align="center"><?php echo $product_qty['price']; ?></td>
				 <td align="center"><?php echo $product_qty['price']*$product_qty['qty']; ?></td>
			  </tr>
			 <?php
				   
			   } 
			?>
		</tbody>

	</table>
	<br/>
	<br/>
	<div style="margin-left:20px; margin-right:20px;">
	<?php echo "Вкупна вредност на магацин:".$suma;?>
	<input type="button" value="Вкупен магацин"  id="all_lager" /><br/><br/>
	<div style="margin-left:880px;">
	<input type="button" value="Материјално  работење"  id="all_lager_material" />
	</div>
	</div>
</div>
<style>
a {
	color: #F00;
	text-decoration: none;
}

</style>
<script>
$("#all_lager").click(function(){
	window.open('all_magacin_print.php','_blank');
});
$("#all_lager_material").click(function(){
	window.open('magacin_material_print.php','_blank');
});
</script>