<?php
	$array = array("result" => "success");

/* The JSON string created from the array. */
session_start();
include("./config.php");

	if(isset($_GET['DISH_NAME'])&&isset($_GET['price'])){

		$dish=$_GET['DISH_NAME'];
		$prices=$_GET['price'];
		$sql="UPDATE menu set price='".$prices."' where DISH_NAME='".$dish."'";
		$result=mysqli_query($conn,$sql);
			$json = json_encode($array);


		echo $json;

	}	


?>