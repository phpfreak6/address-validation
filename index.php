<?php
include('config.php'); // include database file.

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Address Validator</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
   <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/style.css?<?php echo date('ymdhis');?>">
	<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
	
</head>
<body>
  
<div class="form_main"> <!-- form_main -->
  <form action="" method="post" id="address_form">
	<div class="form_wraper">
	   <div class="form_title">
			<h1>Address validator</h1>
            <h4>Validate/Standardizes addresses using USPS</h4>
	   </div>
	   <div class="forms_fields">
			<div class="form-group mb-3 mt-4">
				<label class="mb-2">Address Line 1</label>	
				<input required type="text" name="address_1" class="form-control"/>
				<span class="error address_1" style="display:none;">Please fill the address</span>
			</div>
			<div class="form-group mb-3">
				<label class="mb-2">Address Line 2</label>	
				<input required type="text" name="address_2" class="form-control"/>
			</div>
			<div class="form-group mb-3">
				<label class="mb-2">Country</label>	
				<select name="country" class="countries form-control" id="countryId">
					<option value="">Select Country</option>
				</select>
				<span class="error country" style="display:none;">Please select country</span>
			</div>
			<div class="form-group mb-4">
				<label class="mb-2">State</label>	
				<select name="state" class="states form-control" id="stateId">
					<option value="">Select State</option>
				</select>
				<span class="error state" style="display:none;">Please select state</span>
			</div>
			<div class="form-group mb-3">
				<label class="mb-2">City</label>	
				<select name="city" class="cities form-control" id="cityId">
					<option value="">Select City</option>
				</select>
				<span class="error city" style="display:none;">Please select city</span>
			</div>
			
			<div class="form-group mb-4">
				<label class="mb-2">Zip Code</label>	
				<input required type="text" name="zip" class="form-control"/>
			</div>
			<div class="form-submit text-center mb-2">
				<!--a class="btn btn-primary text-uppercase validate_btn" data-toggle="modal" data-target="#AddressModal"/>Validate</a-->
				<input type="hidden" name="actions" value="nonvalidate">
				<button type="submit" class="btn btn-primary text-uppercase validate_btn" value=""/>Validate</button>
			</div>
	   </div>	
	</div> 
	  </form>
	  <!-- Modal -->
		  <div class="modal fade AddressModal" id="AddressModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog">
			  <div class="modal-content">
				<div class="modal-header">
				  <h4 class="modal-title">Save Address</h4>
				  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
				  </button>
				</div>
				<div class="modal-body">
					<h4 class="address_head">Which address format do you want to save?</h4>
					<div class="addres_tabs">
					    <ul class="nav nav-tabs" role="tablist">
						  <li class="nav-item">
							<a href="#Original" role="tab" data-toggle="tab"
							   class="nav-link active"> Original </a>
						  </li>
						  <li class="nav-item">
							<a href="#Standardized" role="tab" data-toggle="tab"
							   class="nav-link">Standardized (usps)</a>
						  </li>
						</ul>
						<div class="tab-content">
						  <div class="tab-pane active" role="tabpanel" id="Original">
							 <div class="adress_data_box Original">
							    <p class="Original_add1"><p>
								<p class="Original_add2"><p>
								<p class="Original_city"><p>
								<p class="Original_state"><p>
								<p class="Original_zip"><p> 
							 </div>
						  </div>
						  <div class="tab-pane" role="tabpanel" id="Standardized">
							<div class="adress_data_box Standardized">
							    <p class="Standardized_add1"><p>
								<p class="Standardized_add2"><p>
								<p class="Standardized_city"><p>
								<p class="Standardized_state"><p>
								<p class="Standardized_zip"><p> 
							 </div>
							 <form action="" method="post" id="validateform">
								<input type="hidden" name="Standardized_add1" value="">
								<input type="hidden" name="Standardized_add2" value="">
								<input type="hidden" name="Standardized_city" value="">
								<input type="hidden" name="Standardized_state" value="">
								<input type="hidden" name="Standardized_zip" value="">
							 </form>
						  </div>
						</div>
					</div>
				</div>
				<div class="modal-footer">
					<input type="submit" class="btn btn-primary savedata" value="Save">
				</div>
			  </div>
			</div>
		  </div>
     <!-- Modal -->
</div>  <!-- form_main -->
  
  
  
  
  <!-----------Script files------------>
	<script src="js/jquery.min.js"></script>
	<script src="js/popper.min.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
	<script>
	$(document).ready(function(){
		$('.validate_btn').click(function(e){
			e.preventDefault();
			if($('input[name=address_1]').val() == ''){
				$('.address_1').show();
				$('#AddressModal').modal('hide');
				return false;
			}else if($('#countryId').val() == ''){
				$('.country').show();
				$('#AddressModal').modal('hide');
				return false;
			}else if($('#stateId').val() == ''){
				$('.state').show();
				$('#AddressModal').modal('hide');
				return false;
			}else if($('#cityId').val() == ''){
				$('.city').show();
				$('#AddressModal').modal('hide');
				return false;
			}
			var address_1 = $('input[name=address_1]').val();
			var address_2 = $('input[name=address_2]').val();
			var countryId = $('#countryId').val();
			var stateId = $('#stateId').val();
			var cityId = $('#cityId').val();
			var zip = $('input[name=zip]').val();
			$('.Original_add1').html('Address Line 1:'+address_1);
			$('.Original_add2').html('Address Line 2:'+address_2);
			$('.Original_city').html("City:"+cityId);
			$('.Original_state').html("State:"+stateId);
			$('.Original_zip').html("Zip:"+zip);
			$('.Standardized_add1').html('Address Line 1:'+address_1);
			$('.Standardized_add2').html('Address Line 2:'+address_2);
			$('.Standardized_city').html("City:"+cityId);
			$('.Standardized_state').html("State:"+stateId);
			$('.Standardized_zip').html("Zip:"+zip);
			
			$('input[name=Standardized_add1]').val(address_1);
			$('input[name=Standardized_add2]').val(address_2);
			$('input[name=Standardized_city]').val(cityId);
			$('input[name=Standardized_state]').val(stateId);
			$('input[name=Standardized_zip]').val(zip);
						
			$('#AddressModal').modal('show');
			$('a[href="#Standardized"]').click(function(event) {
				var formdata = $('#address_form').serialize();
				$.ajax({
					type: "POST",
					data: formdata,
					url: "ajax.php",
					success: function(html) {
						html = $.parseJSON(html);
						if(html.status == true){
							$('.savedata').prop('disabled', false);
							$('.Standardized_add1').html('Address Line 1:'+html.originaldata.Address1);
							$('.Standardized_add2').html('Address Line 2:'+html.originaldata.Address2);
							$('.Standardized_city').html("City:"+html.originaldata.City);
							$('.Standardized_state').html("State:"+html.originaldata.State);
							$('.Standardized_zip').html("Zip:"+html.originaldata.Zip5);
							
							$('input[name=Standardized_add1]').val(html.originaldata.Address1);
							$('input[name=Standardized_add2]').val(html.originaldata.Address2);
							$('input[name=Standardized_city]').val(html.originaldata.City);
							$('input[name=Standardized_state]').val(html.originaldata.State);
							$('input[name=Standardized_zip]').val(html.originaldata.Zip5);
						}else{
							$('.savedata').prop('disabled', true);
							$('.Standardized_add1').html(html.message[0]);
							$('.Standardized_add2').html('');
							$('.Standardized_city').html("");
							$('.Standardized_state').html("");
							$('.Standardized_zip').html("");
						}
					}
				});
			});
			$('a[href="#Original"]').click(function(event) {
				$('.savedata').prop('disabled', false);
			});
		});
		$('.savedata').click(function(event) {
			event.preventDefault();
			var formdata = $('#validateform').serialize();
			$.ajax({
				type: "POST",
				data: formdata,
				url: "ajax.php",
				success: function(html) {
					html = $.parseJSON(html);
					if(html.status == true){
						swal({
							icon: "success",
							title: "",
							text: html.message,
							type: "success"
						}).then(function(){ 
						   location.reload();
						});
					}
				}
			});
		});
		$("input[name=address_1]").keyup(function (e) {
			$('.address_1').hide();
		});
		$("#countryId").change(function (e) {
			$('.country').hide();
		});
		$("#stateId").change(function (e) {
			$('.state').hide();
		});
		$("#cityId").change(function (e) {
			$('.city').hide();
		});
	});
	</script>
	<script src="js/countrystatecity.js?v2"></script>
	

</body>
</html>
