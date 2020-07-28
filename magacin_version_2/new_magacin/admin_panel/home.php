<?php
session_start();
if(empty($_SESSION['login_user'])){
	header('Location:index.php');
}
if(!isset($_SESSION['session_time'])){
      $_SESSION['session_time']=time();
	  
}else
{
   $totaltime=time()-$_SESSION['session_time'];
   if($totaltime>15*60){
	 $_SESSION['login_user']=''; 
	 header("Location:index.php");
	 session_unset();
	 session_destroy();
   }else
   {
	 $_SESSION['session_time']=time();   
   }
   
}


?>
<!doctype html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>WareHouse</title>
<link rel="stylesheet" href="../css/css.css"/>
<link rel="stylesheet" href="../css/style.css"/>
<script src="../js/jquery.min.js"></script>
<script src="../js/jquery.ui.shake.js"></script>
<script src="../js/jquery-1.10.2.js"></script>
<script src="../js/jquery-ui.js"></script>
<link rel="stylesheet" href="../css//smoothness/jquery-ui.css">
<script src="../js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="../css/jquery.dataTables.min.css">
</head>
<body>
	<div class="container">
		<div id="menu">
			<ul>
			    <li ><a href="#" id="home">Листа продукти</a></li>
				<li ><a href="#" id="new">Нов продукт</a></li>
				<li ><a href="#" id="comp">Компресорски тип</a></li>
				<li style="float:right; "> <a href="logout.php">Одјави се !</a></li>
				<li></li>
			</ul>
		</div>
		<div id="content">
		</div>
    </div>
<div id="dialog-new" title="Нов артикал">
Пармерн
</div>	
</body>
<style>
#menu a:hover {
	background-color: transparent;	
}
</style>
<script>
$('#content').load('view_parts.php');
$('#home').click(function(){
	location.reload();
	
});
$("#new").click(function() {
	$("#dialog-new").load("new.php");
	dialog_new.dialog( "open" );
	
 
});
$("#comp").click(function() {
	$("#dialog-new").load("compressor.php");
	dialog_new.dialog( "open" );
	
 
});
dialog_new= $( "#dialog-new" )
      .dialog({
	  autoOpen: false,
      height: 350,
      width: 700,
      modal: true,
	 
  });
$(document).on("click","#closeBtn",function(){
	dialog_new.dialog( "close" );
	
});  
$(document).on("click","#addBtn",function(){
	var product=new Array;
	$('.product').each(function(){
		idnames = $(this).attr("name");
		product.push(idnames);
		product.push($(this).val()); 
	});	
	var number=$('#number').val();
	var name=$('#name').val();
	if(number==''||name==''){
		alert('Пополнете ги сите полиња.Шифра и продукт.');
	}else{
		$.post("new_update_product.php",
		      {
				op:'new',
				product:product
			  },
			  function(data){
				  if(data>0){
					if(data>1){
						alert("Продукт со оваа шифра постои!!! Внесете уникат шифра на продукт"); 
					}else{
						dialog_window.dialog( "close" );
					    location.reload();
					}
					
				  }else{
					alert("Настана проблем при впишувањето!!!");  
				  }
				  
			  }  
		       		  
	    );
	}
});
$(document).on("click","#compBtn",function(){
	var product=new Array;
	$('.compressor').each(function(){
		idnames = $(this).attr("name");
		product.push(idnames);
		product.push($(this).val()); 
	});	
		$.post("new_update_product.php",
		      {
				op:'comp',
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

</script>