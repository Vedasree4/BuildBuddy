<?php if($_settings->chk_flashdata('success')): ?>
<script>
	alert_toast("<?php echo $_settings->flashdata('success') ?>",'success')
</script>
<?php endif;?>
<div class="card card-outline rounded-0 card-navy">
	<div class="card-header ">
		<div class="card-tools d-flex justify-content-end">
			<a href="<?= base_url ?>admin?page=services/manage_service" id="create_new" class="btn btn-flat btn-primary bg-gradient-teal border-0 rounded00"><span class="fas fa-plus"></span>  Create New</a>
		</div>
	</div>
	<div class="card-body">
        <div class="container-fluid">
			<div class="table-responsive">
				<table class="table table-sm table-hover table-striped table-bordered" id="list">
					<colgroup>
						<col width="5%">
						<col width="20%">
						<col width="20%">
						<col width="30%">
						<col width="15">
						<col width="10%">
					</colgroup>
					<thead>
						<tr>
							<th>SNo.</th>
							<th>Date Created</th>
							<th>Name</th>
							<th>Category</th>
							<th>Desciption</th>
							<th>Price Details</th>
							<th>Price Type</th>
							<th>Status</th>
							<th>Company Address</th>
							<th>Company Contact</th>
							<th>Company Email</th>
							<th>Action</th>
							
						</tr>
					</thead>
					<tbody>
						<?php 
						$i = 1;
						$qry = $conn->query("SELECT * from `service_list` order by `name` asc ");
						while($row = $qry->fetch_assoc()):
						?>
							<tr>
								<td class="align-items-center text-center"><?php echo $i++; ?></td>
								<td class="align-items-center"><?php echo date("Y-m-d g:i A",strtotime($row['created_at'])) ?></td>
								<td class="align-items-center"><?= $row['name'] ?></td>
								<td class="align-items-center" style="width: 100px;"><?= $row['category'] ?></td> <!-- Added category column with reduced width -->
								<td class="align-items-center">
									<p class="truncate-1"><?= strip_tags(htmlspecialchars_decode($row['description'])) ?></p>
								</td>
								<!-- Added Price details and Price type with truncation -->
								<td class="align-items-center">
									<p class="truncate-1"><?= strip_tags(htmlspecialchars_decode($row['price_details'])) ?></p>
								</td>
								<td class="align-items-center"><?= htmlspecialchars($row['price_type']) ?></td>
								<td class="align-items-center text-center">
									<?php if($row['status'] == 1): ?>
										<span class="badge bg-success px-3 rounded-pill">Active</span>
									<?php else: ?>
										<span class="badge bg-danger px-3 rounded-pill">Inactive</span>
									<?php endif; ?>
								</td>
								<td class="align-items-center"><?= htmlspecialchars($row['company_address']) ?></td>
								<td class="align-items-center"><?= htmlspecialchars($row['company_contact']) ?></td>
								<td class="align-items-center"><?= htmlspecialchars($row['company_email']) ?></td>
								<td class="align-items-center" align="center">
									<div class="dropdown">
										<button type="button" class="btn btn-flat p-1 btn-default btn-sm border dropdown-toggle dropdown-icon" data-bs-toggle="dropdown">
												Action
										</button>
										<div class="dropdown-menu" role="menu">
											<a class="dropdown-item" href="./?page=services/view_service&id=<?php echo $row['id'] ?>"><span class="bi bi-card-text text-dark"></span> View</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item" href="./?page=services/manage_service&id=<?php echo $row['id'] ?>"><span class="bi bi-pencil-square text-primary"></span> Edit</a>
											<div class="dropdown-divider"></div>
											<a class="dropdown-item delete_data" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>"><span class="bi bi-trash text-danger"></span> Delete</a>
										</div>
									</div>
								</td>
							</tr>
						<?php endwhile; ?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function(){
		$('.delete_data').click(function(){
			_conf("Are you sure to delete this service permanently?","delete_service",[$(this).attr('data-id')])
		})
	})
	function delete_service($id){
		start_loader();
		$.ajax({
			url:_base_url_+"classes/Master.php?f=delete_service",
			method:"POST",
			data:{id: $id},
			dataType:"json",
			error:err=>{
				console.log(err)
				alert_toast("An error occured.",'error');
				end_loader();
			},
			success:function(resp){
				if(typeof resp== 'object' && resp.status == 'success'){
					location.reload();
				}else{
					alert_toast("An error occured.",'error');
					end_loader();
				}
			}
		})
	}
</script>
