<?php

require_once '../../config/config.php';
	$name = $_REQUEST['name'];
	$phone = $_REQUEST['phone'];
	$service = $_REQUEST['service'];
	$date = $_REQUEST['date'];
	$amount = $_REQUEST['amount'];
	$paymentType = $_REQUEST['paymentType'];
	$id = $_REQUEST['id'];
	$age = $_REQUEST['age'];
	$gender = $_REQUEST['gender'];

	$query = "UPDATE `patients` SET `name`= '$name',`phone`='$phone',`age`='$age',`gender`='$gender',`service`='$service',`date`='$date',`amount`='$amount',`payment_type`='$paymentType' WHERE id=$id"; 

	$updatePatient = $conn->prepare($query);
	if ($updatePatient->execute()) {
			$reponse = ['success' => true, 'msg' => 'successfully updated'];
	}else
	{
			$reponse = ['success' => false, 'msg' => 'failed to update'];
	}

echo json_encode($reponse);
 ?>