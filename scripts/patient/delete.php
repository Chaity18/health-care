<?php
require_once '../../config/config.php';

$id = $_REQUEST['id'];
$updateQuery = "UPDATE `patients` SET `status`='0' WHERE id=$id";
$update = $conn->prepare($updateQuery);
if ($update->execute()) {
	$reponse = ['success' => true, 'msg' => 'successfully deleted'];
}else{
	$reponse = ['success' => false, 'msg' => 'failed to delete'];
}

echo json_encode($reponse);
?>