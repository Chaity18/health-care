<?php
require_once '../../config/config.php';
	$name = $_REQUEST['name'];
	$phone = $_REQUEST['phone'];
	$service = $_REQUEST['service'];
	$date = $_REQUEST['date'];
	$amount = $_REQUEST['amount'];
	$paymentType = $_REQUEST['paymentType'];

	$createPatientQuery = "INSERT INTO `patients`(`name`, `phone`, `service`, `date`, `amount`, `payment_type`) VALUES ('$name', '$phone', '$service','$date','$amount','$paymentType')";
	$createPatient = $conn->prepare($createPatientQuery);
	if ($createPatient->execute()) {
			$reponse = ['success' => true, 'msg' => 'successfully created'];
	}else
	{
			$reponse = ['success' => false, 'msg' => 'failed to create'];
	}

echo json_encode($reponse);

?>