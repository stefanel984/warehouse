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
<link rel="stylesheet" href="css/css.css"/>
<link rel="stylesheet" href="css/style.css"/>
<script src="js/jquery.min.js"></script>
<script src="js/jquery.ui.shake.js"></script>
<script src="js/jquery-1.10.2.js"></script>
<script src="js/jquery-ui.js"></script>
<link rel="stylesheet" href="css/smoothness/jquery-ui.css">
<script src="js/jquery.dataTables.min.js"></script>
<link rel="stylesheet" href="css/jquery.dataTables.min.css">
</head>
<body>
	<div class="container">
		<div id="menu">
			<ul>
			    <li ><a href="#" id="home">Лагер листа</a></li>
				<li ><a href="#"  id="in">Влез</a></li>
				<li ><a href="#"  id="out">Излез</a></li>
				<li ><a href="#"  id="doc">Документи</a></li>
				<li style="float:right; "> <a href="logout.php">Одјави се !</a></li>
				<li></li>
			</ul>
		</div>
		<div id="content">
		</div>
    </div>		
</body>
<style>
</style>
<script>
$(document).ready(function() {

	$("#content").load("view_stock.php");
	$("#home").click(function(evt) {
		$("#content").empty();
		$("#content").load("view_stock.php");
		evt.preventDefault();
   });
   $("#in").click(function(evt) {
		$("#content").empty();
		$("#content").load("add_stock.php");
		evt.preventDefault();
   });
    $("#out").click(function(evt) {
		evt.preventDefault();
		$("#content").empty();
		$("#content").load("sale_stock.php");
		
   });
    $("#doc").click(function(evt) {
		$("#content").empty();
		$("#content").load("document_stock.php");
		evt.preventDefault();
   });
   

	 
	

});
$(document).on("click","#input_non_accept",function(){
	alert("Операцијата е откажана!!!");
	location.reload();
});
$(document).on("click",".deleteInput",function(){
	var tr=$(this).closest('tr');
	    tr.remove();
});
$(document).on("click","#input_accept",function(){
	var in_order=new Array;
	$('.takeInput').each(function(){            
        idnames = $(this).attr("name");
        in_order.push(idnames);
        in_order.push($(this).val());                 
     });
	 $.post("lib/make_input_db.php",
		      {
				in_order:in_order
			  },
			  function(data){
				  if(data>0){
					 $("#working_stock").html("<p>Последниот налог е успешно извршен</p><p>Моментално немате налог</p>");
				  }else{
					alert("Настана проблем при впишувањето!!!");  
				  }
				  
			  }  
		       		  
	    );	
		
});	
$(document).on("click","#output_non_accept",function(){
	alert("Операцијата е откажана!!!");
	location.reload();
});
$(document).on("click",".deleteOutput",function(){
	var tr=$(this).closest('tr');
	    tr.remove();
});
$(document).on("click","#output_accept",function(){
	var in_order=new Array;
	$('.takeOutput').each(function(){
                
        idnames = $(this).attr("name");
        in_order.push(idnames);
        in_order.push($(this).val());
		
                 
     });
	 $.post("lib/make_output_db.php",
		      {
				in_order:in_order
			  },
			  function(data){
				  if(data>0){
					 $("#working_stock").html("<p>Последниот налог е успешно извршен</p><p>Моментално немате налог</p>"); 
				  }else{
					alert("Настана проблем при впишувањето!!!");  
				  }
				  
			  }  
		       		  
	    );	
		
});	 
</script>