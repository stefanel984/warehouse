<?php
include("../connection.php");
$_SESSION['session_time']=time();
header('Content-type: text/html; charset=utf-8');
require('../lib/class_warehouse.php');


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
			{
                "targets": [ 6 ],
                "visible": true,
                "searchable": false,
				"bSortable":false
            },
			
		],
        "lengthMenu": [[-1], ['All']]	
    } );
} );
</script> 
<div id="show_qty">
	<table id="storeTable" class="display" cellspacing="0"  width="100%" >
		<thead>
			<tr>
				<th width="25%">Производ</th>
				<th width="25%">Компресор тип</th>
				<th width="25%">Шифра</th>
				<th width="7%">Количина</th>
				<th width="7%">Цена</th>
				<th width="12%">Едит</th>
				<th width="9%">Бриши</th>
				
			</tr>
		</thead>
		<tbody>
			<?php
			   $suma=0;
			   foreach($products_qty as $product_qty){
				  
			 ?>
			  <tr>
				 <td><?php echo $product_qty['name']; ?></td>
				 <td><?php echo $product_qty['tip_kompresor']; ?></td>
				 <td><?php echo $product_qty['product_number']; ?></td>
				 <td align="center"><?php echo $product_qty['qty']; ?></td>
				 <td align="center"><?php echo $product_qty['price']; ?></td>
				 <td align="center" class="edit" id="<?php echo $product_qty['id']; ?>"><img src='edit.png' height='20' width='20'></td>
				 <?php  if($product_qty['qty']>0){ ?>
				 <td align="center" class="delete" id="<?php echo $product_qty['product_number']; ?>"><img src='delete.png' height='20' width='20'></td>
				 <?php }else 
				       {?>
				 <td></td>  
			     <?php } ?>
			  </tr>
			 <?php
				   
			   } 
			?>
		</tbody>

	</table>
	<br/>
	<br/>
	
</div>
<div id="dialog-edit" title="Едит артикал">

</div>
<style>
a {
	color: #F00;
	text-decoration: none;
}
.edit{
	 cursor: pointer; 
}
.delete{
	 cursor: pointer; 
}

</style>
<script>
$(".delete").click(function() {
	var product_number=($(this).closest("td").attr("id"));
	$.post("new_update_product.php",
		  {
			op:'delete',
			product:product_number
		  },
		  function(data){
			  if(data>0){
				location.reload();
			  }else{
				alert("Настана проблем при бришењето на продуктот!!!");  
			  }
			  
		  }  
				  
	);
	
});
dialog_window= $( "#dialog-edit" )
      .dialog({
	  autoOpen: false,
      height: 450,
      width: 700,
      modal: true,
	 
  });
  $(".edit").click(function() {
	var id=($(this).closest("td").attr("id"));
	$("#dialog-edit").load("edit.php",{"id":id});
	dialog_window.dialog( "open" );
	
 
	});
	$(document).on("click","#saveBtn",function(){
	var product=new Array;
	$('.product').each(function(){
		idnames = $(this).attr("name");
		product.push(idnames);
		product.push($(this).val()); 
	});	
		$.post("new_update_product.php",
		      {
				op:'update',
				product:product
			  },
			  function(data){
				  if(data>0){
					dialog_window.dialog( "close" );
					location.reload();
				  }else{
					alert("Настана проблем при впишувањето!!!");  
				  }
				  
			  }  
		       		  
	    );

});
$(document).on("click","#closeBtn",function(){
	dialog_window.dialog( "close" );
	
});

</script>