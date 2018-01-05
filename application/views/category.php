<?php	require_once 'includes/header.php';	?>
<section class="content">
	<div class="container-fluid">
		
		<div class="row clearfix">
			<!-- Task Info -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<?php
					if (!empty($alert_msg)) {
						$flash_status = $alert_msg[0];
						$flash_header = $alert_msg[1];
						$flash_desc = $alert_msg[2];
						
						if ($flash_status == 'failure') {
						?>
						<div class="row" id="notificationWrp">
							<div class="col-md-12">
								<div class="alert bg-warning" role="alert">
									<i class="icono-exclamationCircle" style="color: #FFF;"></i> 
									<?php echo $flash_desc; ?> <i class="icono-cross" id="closeAlert" style="cursor: pointer; color: #FFF; float: right;"></i>
								</div>
							</div>
						</div>
						<?php
						}
						if ($flash_status == 'success') {
						?>
						<div class="row" id="notificationWrp">
							<div class="col-md-12">
								<div class="alert bg-success" role="alert">
									<i class="icono-check" style="color: #FFF;"></i> 
									<?php echo $flash_desc; ?> <i class="icono-cross" id="closeAlert" style="cursor: pointer; color: #FFF; float: right;"></i>
								</div>
							</div>
						</div>
						<?php
						}
					}
				?>
				
				<div class="card">
					<div class="header">
						<h2><?php echo $lang_product_category; ?></h2>
						
						<ul class="header-dropdown m-r--5">
							
							<a href="<?= base_url() ?>products/addproductcategory">
								<button class="btn btn-primary"><?php echo $lang_add_product_category; ?></button>
							</a>
							<a href="setting/createuser">
								<button class="btn btn-primary">UPDATE</button>
							</a>
							<a href="setting/createuser">
								<button class="btn btn-danger">DELETE</button>
							</a>
						</ul>
					</div>
					<div class="body">
						<div class="table-responsive">
							<table class="table table-hover dashboard-task-infos">
								<thead>
									<tr>
										<th>#</th>
										<th width="60%"><?php echo $lang_name; ?></th>
										<th width="30%"><?php echo $lang_status; ?></th>
										<th width="10%"><?php echo $lang_action; ?></th>
									</tr>
								</thead>
								<tbody>
									
									<?php
                                        if (count($results) > 0) {
                                            foreach ($results as $key=>$data) {
                                                $id = $data->id;
                                                $name = $data->name;
                                                $status = $data->status;
											?>
											<tr>
												<td>
													<?php echo $key; ?>
													</td><td>
													<?php echo $name; ?>
												</td>
												<td>
													<?php
                                                        if ($status == '1') {
                                                            echo $lang_active;
														}
                                                        if ($status == '0') {
                                                            echo $lang_inactive;
														}
													?>
												</td>
												<td>
													<a href="<?= base_url() ?>products/editproductcategory?id=<?php echo $id; ?>">
														<i class="material-icons">mode_edit</i>
													</a>
													
													<a href="<?= base_url() ?>products/deleteproduct?id=<?php echo $id; ?>">
														<i class="material-icons">delete_forever</i>
													</a>
												</td>
											</tr>
											<?php
                                                unset($id);
                                                unset($name);
                                                unset($status);
											}
											} else {
										?>
										<tr class="no-records-found">
											<td colspan="3"><?php echo $lang_no_match_found; ?></td>
										</tr>
										<?php
										}
									?>
								</tbody>
							</table>
						</div>
					</div>
				</div>
			<?php	require_once 'includes/footer.php';	?>.						