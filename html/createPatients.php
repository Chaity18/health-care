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
	<div class="alert alert-danger alert-dismissible fade" role="alert">
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
			    <form method="POST" action="../scripts/patient/create.php">
			    	<div class="row">
			    		<div class="col-md-6">
			    			<label>Name: </label>
			    			<input type="text" name="name" class="form-control">
			    		</div>
			    		<div class="col-md-6">
			    			<label>phone: </label>
			    			<input type="number" name="phone" class="form-control">
			    		</div>
			    		<div class="col-md-6">
			    			<label>Service: </label>
			    			<input type="text" name="service" class="form-control">
			    		</div>
			    		<div class="col-md-6">
			    			<label>Date: </label>
			    			<input type="date" name="date" class="form-control">
			    		</div>
			    		<div class="col-md-6">
			    			<label>Amount: </label>
			    			<input type="number" name="amount" class="form-control">
			    		</div>
			    		<div class="col-md-6">
			    			<label for="browser" class="form-label">Choose payment Type from the list:</label>
							<input class="form-control" list="types" name="paymentType">
							<datalist id="types">
							  <option value="cash">
							  <option value="credit">
							  <option value="cheque">
							</datalist>
			    		</div>		
			    	</div>
			  </div>
			  <div class="modal-footer">
			    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
			    <input type="submit" name="submit" class="btn btn-primary" value="save">
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
				<button type="button" class="btn btn-primary mb-2 mt-2" data-toggle="modal" data-target="#createModal">
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
							$query = "SELECT * FROM patients where status=1";
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

									echo "<td><a onclick='deletePatient(".$info['id'].")' class=' btn btn-danger  btn-sm text-white m-2'><i class='fa fa-trash'></i></a>";
									echo "<a onclick='updatePatient(".$info['id'].")' class='btn ml-2 btn-warning text-white m-2'><i class='fa fa-pencil'></i></a>";
									echo "<a href='../scripts/patient/createReceipt.php?id=".$info['id']."'class='btn ml-2 btn-success text-white m-2'><i class='fa fa-pencil-square-o'></i></a></td>";

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

});

function deletePatient(id) {
    	$confirm = confirm('Are you sure you want to delete this patient?');

    	if (confirm) {
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
</script>