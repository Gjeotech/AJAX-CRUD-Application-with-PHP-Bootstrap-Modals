<?php
include("dbcon/dbcon.php");

extract($_POST);

if(isset($_POST['nameSend']) && isset($_POST['emailSend']) && isset($_POST['mobilSend'])&& isset($_POST['placeSend'])){
	if(empty($_POST['nameSend']) && empty($_POST['emailSend']) && empty($_POST['mobilSend']) && empty($_POST['placeSend'])){
		echo "You must fill the form first";
	}else{
	$sql = "INSERT INTO `crud`(name,email,phone,place)
	VALUES ('$nameSend','$emailSend','$mobilSend','$placeSend')";
	$result = mysqli_query($con,$sql);
	 	
	if($result){
		$nameSend= '';
		$emailSend ='';
		$mobilSend ='';
		$placeSend ='';
		echo "<script>alert('Data Sent')</script>";
	}else{
		echo "<script>alert('Failed')</script>";
	}
	
}
}

?>