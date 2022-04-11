<?php 
include '../../vendor/autoload.php';
require_once '../../config/config.php';
$id = $_REQUEST['id'];
$mpdf = new \Mpdf\Mpdf(['mode' => 'utf-8',
    'format' => 'A4-L',
    'orientation' => 'L']);


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
 
 $html ='<!DOCTYPE html>
 <html>
 <head>
 	<title>'.$name.' Receipt</title>
 	<style type="text/css">
 		table{
            background-color: #fff;
            border-collapse: collapse;            
        }
        table thead tr{
            border: 1px solid #111;
            background-color: #f2f2f2;
            font-family: sans-serif;
        }
        table td {
            vertical-align: middle !important;
            text-align: center;
            font-family: sans-serif;
            font-size: 16px;
        }
        table th, table td {
            padding-top: 08px;
            padding-bottom: 08px;
        }
        .table-bordered{
            box-shadow: 0px 0px 5px 0.5px gray;
        }
        .table-bordered td, .table-bordered th {
            border: 1px solid #dee2e6;
        }
        .text-left{
            text-align: left;
        }
        .w-20{
            width: 20%;
        }
 	</style>
 </head>
 <body>
 	<div style="display: inline; align-items: center;">

 	<div class="logo_and_tag_line" style="width: 40%; float: left;padding: 5px">
 		<img src="../../assets/img/logo-icon.jpg" style="margin-left: 20px" width="90" height="90">
 		<p style="margin:0;padding:0;font-size: 25px; font-family: sans-serif; color: #0524a2;text-align: left;margin-left: 20px">Surgically redifining health</p>
 	</div>
 	<div class="surgical_details" style="float: right;margin-top: 20px;align-items: center;width: 55%;">
 		<img src="../../assets/img/logo-name.png" style="width: 22em">
 		<p style="margin:0;padding:0;font-size: 16px; font-family: sans-serif; color: #0524a2">DR. UNNATI PATEL(MS)</p>
 		<p style="margin-top:10px;padding:0;font-size: 16px; font-family: sans-serif; color: #0524a2">GENERAL & LAPAROSCOPIC SURGEON</p>
 	</div>
 </div>
 	<hr width="100%">
	<table class="table-bordered" style="width: 100%">
        <thead>
            <tr>
                <th style="width: 2% !important;">sr.no</th>
                <th style="width: 20%;"></th>
                <th style="width: 20%;"></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td style="text-align:left">Patients Name</td>
                <td style="text-align:left">'.$name.'</td>
            </tr>
            <tr>
					<td>2</td>
					<td style="text-align:left">patients Phone number</td>
					<td style="text-align:left">'.$phone.'</td>
				</tr>
				<tr>
					<td>3</td>
					<td style="text-align:left">Age</td>
					<td style="text-align:left">'.$age.'</td>
				</tr>
				<tr>
					<td>4</td>
					<td style="text-align:left">Service</td>
					<td style="text-align:left">'.$service.'</td>
				</tr>
				<tr>
					<td>5</td>
					<td style="text-align:left">service charge</td>
					<td style="text-align:left">'.$amount.' /-</td>
				</tr>
				<tr>
					<td>6</td>
					<td style="text-align:left">payment</td>
					<td style="text-align:left">'.$paymentType.'</td>
				</tr>
				<tr>
					<td colspan="3" style="font-size: 16px; text-align:left; font-family: sans-serif; color: gray">Clinic Address: Shop no 103, First Floor, Avadh Pride, Near Nirant Metro Station, Nirant Cross Road, vastral Ahmedabad,<br><br> Contact No. <strong>079 4604 5519, +91 9328847521</strong> </td>
				</tr>
        </tbody>
    </table>
 </body>
 </html>';

// echo $html;exit;
$mpdf->WriteHTML($html);

$mpdf->Output($name.'surgeon\'s | receipt.pdf', 'D');

$mpdf->Output("../../uploads/" . $name.md5(uniqid()). ".pdf", 'F');
