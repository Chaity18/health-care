<?php
session_start();

include '../helper/header.php';
if (!isset($_COOKIE['user'])) {
  echo "<script>alert('please log in using username and password');
  window.location.href =   '../html/dashboard.php';
  </script>";
}
?>
<div class="container-fluid">
	<div class="alert alert-danger alert-dismissible fade" role="alert" id="msgId">
	  <strong id="message"></strong>
	  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
	    <span aria-hidden="true">&times;</span>
	  </button>
	</div>
	<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog modal-dialog-centered modal-xl" role="document">
			<div class="modal-content">
	  			<div class="modal-header">
	    			<h5 class="modal-title" id="exampleModalLabel">Create New Patient</h5>
				    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
				      <span aria-hidden="true">&times;</span>
				    </button>
	  			</div>
			  <div class="modal-body">
			  	<div class="alert alert-danger alert-dismissible fade" style="display: none" id="form_error" role="alert">
				  <strong id="error">Please Fill All the fields.</strong>
				  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
				    <span aria-hidden="true">&times;</span>
				  </button>
				</div>
			    <form method="POST">
			    	<div class="row">
			    		<div class="col-md-6">
			    			<label>Name: </label>
			    			<input type="text" name="name" class="form-control"  id="name" required>
			    		</div>
			    		<div class="col-md-6">
			    			<label>phone: </label>
			    			<input type="number" name="phone" class="form-control" id="phone" required>
			    		</div>
			    		<div class="col-md-6">
			    			<label>Gender:</label>
			    			<input class="form-control" list="gender" name="gender" id="genderValue" required>
							<datalist id="gender">
							  <option value="male">
							  <option value="female">
							</datalist>
			    		</div>	
			    			<div class="col-md-6">
			    			<label>Age:</label>
			    			<input class="form-control" type="number" name="age" id="age" required>
			    		</div>		
			    		<div class="col-md-6">
			    			<label>Service: </label>
			    			<input type="text" name="service" class="form-control" id="service" required>
			    		</div>
			    		<div class="col-md-6">
			    			<label>Date: </label>
			    			<input type="date" name="date" class="form-control" id="date" required>
			    		</div>
			    		<div class="col-md-6">
			    			<label>Amount: </label>
			    			<input type="number" name="amount" class="form-control" id="amount" required>
			    		</div>
			    		<div class="col-md-6">
			    			<label for="browser" class="form-label">Choose payment Type from the list:</label>
							<input class="form-control" list="types" name="paymentType" id="paymentType" required>
							<datalist id="types">
							  <option value="cash">
							  <option value="credit">
							  <option value="cheque">
							</datalist>
			    		</div>	
			    		<input type="hidden" name="id" id="p_id">	
			    	</div>
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    <button type="button" class="btn btn-primary" id="submitBtn">Save</button>
			    <button type="button" class="btn btn-primary" id="updateBtn" style="display: none">Update</button>
			  </div>
			    </form>
			</div>
		</div>
	</div>

	<div class="card">
		<div class="card-header">
			<div class="card-title">
				<h3 class="text-center">Patients Details</h3>
			</div>
		</div>
		<div class="card-body ">
			<div class="d-flex m-2 justify-content-end">
				<button type="button" id="modalButton" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#createModal">
  				create
				</button>
			</div>
			<div class="table-responsive">
				<table class="table table-striped table-hover" id="patients_table">
					<thead>
						<tr>
							<th>ID</th>
							<th>Name</th>
							<th>Phone</th>
							<th>Service</th>
							<th>Date</th>
							<th>Amount</th>
							<th>Payment Type</th>
							<th>Receipt ID</th>
							<th>Actions</th>
						</tr>
					</thead>
					<tbody>
						<?php
							require_once '../config/config.php';
							$query = "SELECT * FROM patients where status=1 ORDER BY id DESC";
							$getAllData = $conn->prepare($query);
							$getAllData->execute();
							$rowCount = $getAllData->rowCount();
							if ($rowCount > 0) {
								$data = $getAllData->fetchAll();
								$id = 1;
								foreach ($data as $info) {
									echo "<tr id='patient_".$info['id']."'>";
									echo "<td>".$id."</td>";
									echo "<td>".$info['name']."</td>";
									echo "<td>".$info['phone']."</td>";
									echo "<td>".$info['service']."</td>";
									echo "<td>".$info['date']."</td>";
									echo "<td>".$info['amount']."</td>";
									echo "<td>".$info['payment_type']."</td>";
									if ($info['receipt_id']==0) {
										echo "<td>None</td>";
									}else{
										echo "<td>".$info['receipt_id']."</td>";
									}				

									echo "<td><a onclick='deletePatient(".$info['id'].")' title='delete patient' class=' btn btn-danger  btn-sm text-white m-2'><i class='fa fa-trash'></i></a>";
									echo "<a onclick='updatePatient(".$info['id'].")' title='update patient' class='btn ml-2 btn-warning text-white m-2'><i class='fa fa-pencil'></i></a>";
									echo "<a href='../scripts/patient/createReceipt.php?id=".$info['id']."'class='btn ml-2 btn-success text-white m-2' title='geneate receipt'><i class='fa fa-pencil-square-o'></i></a></td>";

									echo "</tr>";
									$id++;
								}
							}

						?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>	
</div>


<?php
include '../helper/footer.php';
?>
<script type="text/javascript">
$(document).ready(function() {
   
    $('#patients_table').DataTable( {
        "paging":   true,
        "ordering": true,
        "info":     true
    });

    $('#submitBtn').click(function(e){
	    e.preventDefault();
	    var name = $("#name").val();
	  	var phone = $("#phone").val();
	  	var service = $("#service").val();
	  	var date = $("#date").val();
	  	var amount = $("#amount").val();
	  	var paymentType = $("#paymentType").val();
	  	var age = $("#age").val();
	  	var gender = $("#genderValue").val();

	  	if (name != '' && phone != '' && service != '' && date != '' && amount != '' && paymentType != '' && age != '' && gender != '') {
	  		$.ajax({
				url: "../scripts/patient/create.php",
				method: 'POST',
				data:{
					name: name,
					phone: phone,
					service: service,
					date: date,
					amount: amount,
					paymentType: paymentType,
					age: age,
					gender: gender,
				},
				success:function(result){
					res = JSON.parse(result);
		    		if (res.success) {
		    			$("#createModal").removeClass('show');
		    			$(".modal-backdrop").removeClass('show');
		    			$("#message").text(res.msg);
		    			$("#form_error").hide();
		    			$(".alert-danger").addClass( 'alert-success show');
		    			$(".alert-danger").removeClass( 'alert-danger');
		    			setTimeout(function(){
		    				$(".alert-success").removeClass( 'show');
		    				window.location.reload();
		    			}, 500);	
		    		}
				}
	  		});
	  	}else {
			$("#form_error").addClass('show');
			setTimeout(function(){
				$("#form_error").removeClass( 'show');
			}, 500);
	  	}
	});

	$('#updateBtn').click(function(e){
	    e.preventDefault();
	    var name = $("#name").val();
	  	var phone = $("#phone").val();
	  	var service = $("#service").val();
	  	var date = $("#date").val();
	  	var amount = $("#amount").val();
	  	var paymentType = $("#paymentType").val();
	  	var age = $("#age").val();
	  	var gender = $("#genderValue").val();
	  	var id = $("#p_id").val();

	  	if (id != '' && name != '' && phone != '' && service != '' && date != '' && amount != '' && paymentType != '' && age != '' && gender != '') {
	  		$.ajax({
				url: "../scripts/patient/update.php",
				method: 'POST',
				data:{
					id: id,
					name: name,
					phone: phone,
					service: service,
					date: date,
					amount: amount,
					paymentType: paymentType,
					age: age,
					gender: gender
				},
				success:function(result){
					res = JSON.parse(result);
		    		if (res.success) {
		    			$("#createModal").removeClass('show');
		    			$(".modal-backdrop").removeClass('show');
		    			$("#message").text(res.msg);
		    			$("#form_error").hide();
		    			$("#msgId").addClass( 'alert-success show');
		    			$("#msgId").removeClass( 'alert-danger');
		    			setTimeout(function(){
		    				$("#msgId").removeClass( 'show');
		    				window.location.reload();
		    			}, 1500);	
		    		}
				}
	  		});
	  	}else {
			$("#form_error").addClass('show');
			setTimeout(function(){
				$("#form_error").removeClass( 'show');
			}, 500);
	  	}
	});

});

function deletePatient(id) {
    	if (confirm('Are you sure you want to delete this patient?')) {
    		$.ajax({
    			url: "../scripts/patient/delete.php",
    			data: {id: id},
    			success: function(result){
		    		res = JSON.parse(result);
		    		if (res.success) {
		    			$("#message").text(res.msg);
		    			$(".alert-danger").addClass( 'show');
		    			setTimeout(function(){
		    				$(".alert-danger").removeClass( 'show');
		    				window.location.reload();
		    			}, 500);	
		    		}
		  		}
		  	});
    	}
    }

  function updatePatient(id)
  {  	
  		$.ajax({
    			url: "../scripts/patient/getInfo.php",
    			data: {id: id},
    			success: function(result){
		    		res = JSON.parse(result);
		    		if (res.success) {
		    			$("#exampleModalLabel").text('');
		    			$("#exampleModalLabel").text('Update '+ res.name);
		    			 $("#name").val(res.name);
					  	 $("#phone").val(res.phone);
					  	 $("#service").val(res.service);
					  	 $("#date").val(res.date);
					  	 $("#amount").val(res.amount);
					  	 $('#age').val(res.age);
					  	 $("#genderValue").val(res.gender);
					  	 $("#p_id").val(res.id);
					  	 $("#paymentType").val(res.paymentType);
					  	 $("#submitBtn").hide();
					  	 $("#updateBtn").show();
					  	 $("#modalButton").click();
		    		}
		  		}
		});
  }
</script>