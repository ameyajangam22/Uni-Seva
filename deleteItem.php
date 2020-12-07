<?php
	$array = array("result" => "success");

/* The JSON string created from the array. */

include("./config.php");
session_start();

	if(isset($_GET['DISH_NAME'])){

		$dish=$_GET['DISH_NAME'];
		$sql="DELETE FROM menu where DISH_NAME='".$dish."'";
		$result=mysqli_query($conn,$sql);
			$json = json_encode($array);


		echo $json;

	}	


?>