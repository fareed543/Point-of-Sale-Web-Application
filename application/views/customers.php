<?php	require_once 'includes/header.php';	?>
<section class="content">
	<div class="container-fluid">
		<div class="row clearfix">
			<!-- Task Info -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<ol class="breadcrumb breadcrumb-bg-cyan">
					<li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
					<li class="active"><i class="material-icons">store</i> <?php echo $lang_customers; ?></li>
				</ol>				
				<?php if (!empty($alert_msg)) { 
					$flash_status = $alert_msg[0];
					$flash_header = $alert_msg[1];
					$flash_desc = $alert_msg[2];
				?>
				<?php if ($flash_status == 'failure') {	?>
					<div class="alert alert-info">
						<strong>Heads up!</strong> <?php echo $flash_desc; ?>
					</div>
				<?php } ?>
							
				<?php if ($flash_status == 'success') {?>
					<div class="alert alert-success">
						<strong>Well done!</strong> <?php echo $flash_desc; ?>
					</div>
				<?php } ?>
				<?php } ?>
				
				<div class="card">
					<div class="header">
						<h2><?php echo $lang_customers; ?></h2>
						<ul class="header-dropdown m-r--5">
							<a href="<?= base_url() ?>customers/addCustomer">
								<button class="btn btn-primary">CREATE</button>
							</a>
							<a href="<?= base_url() ?>customers/addCustomer">
								<button class="btn btn-danger">DELETE</button>
							</a>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							<form action="<?= base_url() ?>customers/searchcustomer" method="get">
								<table class="table table-hover dashboard-task-infos">
									<tr>
										<th width="15%"><input type="text" name="name" class="form-control" /></th>
										<th width="15%"><input type="text" name="email" class="form-control" /></th>
										<th width="15%"><input type="text" name="mobile" class="form-control" /></th>
										<th width="10%"><button class="btn btn-primary"><?php echo $lang_search; ?></button></th>
									</tr>
								</table>
							</form>
							<table class="table table-hover dashboard-task-infos">
								<thead>
									<tr>
										<th width="15%"><?php echo $lang_customer_name; ?></th>
										<th width="15%"><?php echo $lang_email; ?></th>
										<th width="15%"><?php echo $lang_mobile; ?></th>
										<th width="10%"><?php echo $lang_action; ?></th>
									</tr>
								</thead>
								<tbody>
									<?php
										if (count($results) > 0) {
											foreach ($results as $data) {
												$cust_id = $data->id;
												$cust_fn = $data->fullname;
												$cust_em = $data->email;
												$cust_mb = $data->mobile;
											?>
											<tr>
												<td><?php echo $cust_fn; ?></td>
												<td><?php echo (!empty($cust_em))? $cust_em : '-'; ?></td>
												<td><?php echo (!empty($cust_mb))? $cust_mb :  '-'; ?></td>
												<td>
													<a href="<?= base_url() ?>customers/edit_customer?cust_id=<?php echo $cust_id; ?>">
														<i class="material-icons">mode_edit</i>
													</a>
													<a href="<?= base_url() ?>customers/customer_history?cust_id=<?php echo $cust_id; ?>">
														<i class="material-icons">history</i>
													</a>
													<a href="#">
														<i class="material-icons">delete_forever</i>
													</a>
												</td>
											</tr>
											<?php
											}
											} else {
										?>
										<tr class="no-records-found">
											<td colspan="5"><?php echo $lang_no_match_found; ?></td>
										</tr>
										<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Task Info -->
		</div>
	</div>
</section>
<?php	require_once 'includes/footer.php';	?>.