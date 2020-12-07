<?php 
	$array = array("result" => "success");
	include("./config.php");
	session_start();
	if(isset($_GET["DISH_NAME"])&&isset($_GET["qty"])&&isset($_GET["total_cost"])){

		$email=$_SESSION["email"];
		$DISH_NAME=$_GET["DISH_NAME"];
		$QUANTITY=$_GET["qty"];
		$PAYMENT_BALANCE=$_GET["total_cost"];

		
		$Status="Pending";
		$sql="INSERT into orders (EMAIL,DISH_NAME,QUANTITY,TIMESTAMP,STATUS,PAYMENT_BALANCE) Values('".$email."','".$DISH_NAME."',".$QUANTITY.",SYSDATE(),'".$Status."',".$PAYMENT_BALANCE.")";
		$result=mysqli_query($conn,$sql);

		$json = json_encode($sql);


		echo $json;



	}

?>