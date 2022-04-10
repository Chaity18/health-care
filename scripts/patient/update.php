<?php

require_once '../../config/config.php';
	$name = $_REQUEST['name'];
	$phone = $_REQUEST['phone'];
	$service = $_REQUEST['service'];
	$date = $_REQUEST['date'];
	$amount = $_REQUEST['amount'];
	$paymentType = $_REQUEST['paymentType'];
	$id = $_REQUEST['id'];

	$query = "UPDATE `patients` SET `name`= '$name',`phone`='$phone',`service`='$service',`date`='$date',`amount`='$amount',`payment_type`='$paymentType' WHERE id=$id"; 

	$updatePatient = $conn->prepare($query);
	if ($updatePatient->execute()) {
			$reponse = ['success' => true, 'msg' => 'successfully updated'];
	}else
	{
			$reponse = ['success' => false, 'msg' => 'failed to update'];
	}

echo json_encode($reponse);
 ?>