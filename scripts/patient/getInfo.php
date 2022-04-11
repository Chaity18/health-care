<?php 
require_once '../../config/config.php';
$id = $_REQUEST['id'];

if (!empty($id)) {
	$query = "SELECT * FROM `patients` WHERE id = $id";
	$getDataQuery = $conn->prepare($query);
	$getDataQuery->execute();
	$data = $getDataQuery->fetchAll();

	foreach ($data as $d) {
		$id = $d['id'];
		$name = $d['name'];
		$phone = $d['phone'];
		$date = $d['date'];
		$amount = $d['amount'];
		$service = $d['service'];
		$paymentType = $d['payment_type'];
		$age = $d['age'];
		$gender = $d['gender'];
	}	
	$response = ['success' => true, 'id' => $id, 'name' => $name, 'phone' => $phone, 'date' => $date, 'amount' => $amount, 'service' => $service, 'paymentType' => $paymentType, 'age' => $age, 'gender' => $gender];

	echo json_encode($response);
}

 ?>