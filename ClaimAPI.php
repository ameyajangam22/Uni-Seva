<?php
	include './config.php';
	if(isset($_POST["claimed"])&&isset($_POST["complaint_id"])){

		$retrievedBy=$_POST["claimed"];
		$complaint_id=$_POST["complaint_id"];
		$sql="UPDATE lost_and_found set RETREIVED_BY='".$retrievedBy."' and STATUS='Claimed' where COMPLAINT_ID='".$complaint_id."'";
		$result=mysqli_query($conn,$sql);
		if($result){
			header("Location: myFoundClaims.php");
		}


	}	

?>