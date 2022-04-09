<?php
require_once '../../config/config.php';
if (isset($_REQUEST['submit'])) {
	$name = $_REQUEST['name'];
	$phone = $_REQUEST['phone'];
	$service = $_REQUEST['service'];
	$date = $_REQUEST['date'];
	$amount = $_REQUEST['amount'];
	$paymentType = $_REQUEST['paymentType'];

	$checkUserExistOrNot = "SELECT * FROM patients WHERE phone='$phone'";
	$checkQuery = $conn->prepare($checkUserExistOrNot);
	$checkQuery->execute();
	$rowCount = $checkQuery->rowCount();

	if ($rowCount == 0) {
		$createPatientQuery = "INSERT INTO `patients`(`name`, `phone`, `service`, `date`, `amount`, `payment_type`) VALUES ('$name', '$phone', '$service','$date','$amount','$paymentType')";
		$createPatient = $conn->prepare($createPatientQuery);
		if ($createPatient->execute()) {
			echo "<script>
					alert('patient successfully created');
					window.location.href = '../../html/createPatients.php';
					</script>";
		}else
		{
			echo "<script>
				alert('failed to create patient');
				window.location.href = '../../html/createPatients.php';
				</script>";
		}
	}
	else
	{
		echo "<script>
			alert('patient already exist');
			window.location.href = '../../html/createPatients.php';
		</script>";
	}
}
?>