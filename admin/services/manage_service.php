<?php
if(isset($_GET['id']) && $_GET['id'] > 0){
    $qry = $conn->query("SELECT * from `service_list` where id = '{$_GET['id']}' ");
    if($qry->num_rows > 0){
        foreach($qry->fetch_assoc() as $k => $v){
            $$k=$v;
        }
    }
}
?>
<div class="row mt-lg-n4 mt-md-n4 justify-content-center">
	<div class="col-lg-8 col-md-10 col-sm-12 col-xs-12">
		<div class="card rounded-0">
			<div class="card-header py-0">
				<div class="card-title py-1"><b><?= isset($id) ? "Update Service Details" : "New Service Entry" ?></b></div>
			</div>
			<div class="card-body">
				<div class="container-fluid mt-3">
					<form action="" id="service-form">
						<input type="hidden" name ="id" value="<?php echo isset($id) ? $id : '' ?>">
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="name" class="control-label"><b>Service Name</b></label>
								<input type="text" name="name" id="name" class="form-control form-control-sm rounded-0" placeholder = "Enter Service Name" value="<?php echo isset($name) ? $name : ''; ?>"  required/>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="category" class="control-label"><b>Category</b></label>
								<select name="category" id="category" class="form-select form-select-sm rounded-0" required="required">
									<option value="" disabled <?= !isset($category) ? 'selected' : '' ?>>-- Select Category --</option>
									<option value="Woodwork" <?= isset($category) && $category == 'Woodwork' ? 'selected' : '' ?>>Woodwork</option>
									<option value="Plumbing" <?= isset($category) && $category == 'Plumbing' ? 'selected' : '' ?>>Plumbing</option>
									<option value="Electrical" <?= isset($category) && $category == 'Electrical' ? 'selected' : '' ?>>Electrical</option>
									<option value="Painting" <?= isset($category) && $category == 'Painting' ? 'selected' : '' ?>>Painting</option>
									<option value="Construction" <?= isset($category) && $category == 'Construction' ? 'selected' : '' ?>>Construction</option>
									<option value="Tiling" <?= isset($category) && $category == 'Tiling' ? 'selected' : '' ?>>Tiling</option>

								</select>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="description" class="control-label"><b>Description</b></label>

								<textarea rows="3" name="description" id="description" class="form-control form-control-sm rounded-0" placeholder = "Enter Service Details"  required><?php echo isset($description) ? $description : ''; ?></textarea>
							</div>
						</div>
						<div class="row">
							<div class="form-group">
								<label for="" class="control-label"><b>Service Image</b></label>
								<div class="custom-file">
								<input type="file" class="form-control" id="customFile" name="image" onchange="displayImg(this,$(this))" accept="image/png, image/jpeg">
								</div>
							</div>
						</div>
						<div class="row">
							<div class="form-group d-flex justify-content-center">
								<img src="<?php echo validate_image(isset($meta['image_path']) ? $meta['image_path'] :'') ?>" alt="" id="cimg" class="img-fluid img-thumbnail">
							</div>
						</div>
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="price_details" class="control-label"><b>Initial Price</b></label>
								<textarea rows="3" name="price_details" id="price_details" class="form-control form-control-sm rounded-0" placeholder="Enter base price and pricing system (e.g., per sq feet, per hour, as per material quality)" required><?php echo isset($price_details) ? $price_details : ''; ?></textarea>
							</div>

						</div>

						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="price_type" class="control-label"><b>Price Type</b></label>
								<select name="price_type" id="price_type" class="form-select form-select-sm rounded-0" required="required">
									<option value="fixed" <?= isset($price_type) && $price_type == 'fixed' ? 'selected' : '' ?>>Fixed Price</option>
									<option value="negotiable" <?= isset($price_type) && $price_type == 'negotiable' ? 'selected' : '' ?>>Negotiable</option>
								</select>
							</div>
						</div>

						<!-- New Row for Company Address -->
						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="company_address" class="control-label"><b>Company Address</b></label>
								<textarea rows="3" name="company_address" id="company_address" class="form-control form-control-sm rounded-0" placeholder="Enter the company address" required><?php echo isset($company_address) ? $company_address : ''; ?></textarea>
							</div>
						</div>

						<!-- New Row for Contact Details -->
						<div class="row">
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="contact_number" class="control-label"><b>Company Contact Number</b></label>
								<input type="text" name="contact_number" id="contact_number" class="form-control form-control-sm rounded-0" placeholder="Enter the contact number" value="<?php echo isset($company_contact) ? $company_contact : ''; ?>" required>
							</div>
							<div class="form-group col-lg-6 col-md-6 col-sm-12 col-xs-12">
								<label for="email" class="control-label"><b>Company Email Address</b></label>
								<input type="email" name="email" id="email" class="form-control form-control-sm rounded-0" placeholder="Enter the email address" value="<?php echo isset($company_email) ? $company_email : ''; ?>" required>
							</div>
						</div>

						<div class="row">
							<div class="form-group col-lg-12 col-md-12 col-sm-12 col-xs-12">
								<label for="status" class="control-label"><b>Status</b></label>
								<select name="status" id="status" class="form-select form-select-sm rounded-0" required="required">
									<option value="1" <?= isset($status) && $status == 1 ? 'selected' : '' ?>>Active</option>
									<option value="0" <?= isset($status) && $status == 0 ? 'selected' : '' ?>>Inactive</option>
								</select>
							</div>
						</div>
					</form>
				</div>
			</div>
			<div class="card-footer py-1 text-center">
				<button class="btn btn-primary btn-sm bg-gradient-teal btn-flat border-0" form="service-form"><i class="fa fa-save"></i> Save</button>
				<a class="btn btn-light btn-sm bg-gradient-light border btn-flat" href="./?page=services"><i class="fa fa-times"></i> Cancel</a>
			</div>
		</div>
	</div>
</div>
<script>
	// used to preview an image before submitting it
	function displayImg(input,_this) {
	    if (input.files && input.files[0]) // if the image is inputted
		{
	        var reader = new FileReader();
	        reader.onload = function (e) {
	        	$('#cimg').attr('src', e.target.result); // When the file is read, the onload event triggers. The data URL of the file is set as the src attribute of the element with the ID cimg, allowing the image to be displayed on the page.
	        }

	        reader.readAsDataURL(input.files[0]);
	    }else{
			// Default Image Fallback
			$('#cimg').attr('src', "<?php echo validate_image(isset($meta['image_path']) ? $meta['image_path'] :'') ?>");
		}
	}
	//Form Submission with AJAX
	$(document).ready(function(){
		$('#service-form').submit(function(e){
			//The default form submission is prevented to allow custom handling using AJAX.
			e.preventDefault();
            var _this = $(this) //// Reference to the form element
			$('.err-msg').remove();  // Remove any previous error messages from the form
			setTimeout(() => {
				start_loader();
				$.ajax({
					url:_base_url_+"classes/Master.php?f=save_service",
					data: new FormData($(this)[0]),
					cache: false,
					contentType: false,
					processData: false,
					method: 'POST',
					type: 'POST',
					dataType: 'json',
					error:err=>{
						console.log(err)
						alert_toast("An error occured",'error');
						end_loader();
					},
					success:function(resp){
						if(typeof resp =='object' && resp.status == 'success'){
							location.replace('./?page=services/view_service&id='+resp.sid)
						}else if(resp.status == 'failed' && !!resp.msg){
							var el = $('<div>')
								el.addClass("alert alert-danger err-msg").text(resp.msg)
								_this.prepend(el)
								el.show('slow')
								$("html, body").scrollTop(0);
								end_loader()
						}else{
							alert_toast("An error occured",'error');
							end_loader();
							console.log(resp)
						}
					}
				})
			}, 200);
			
		})

	})
</script>
