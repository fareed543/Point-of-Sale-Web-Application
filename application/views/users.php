<?php	require_once 'includes/header.php';	?>
<section class="content">
	<div class="container-fluid">
		<div class="block-header">
			<h2>USERS</h2>
		</div>
		
		<div class="row clearfix">
			<!-- Task Info -->
			<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
				<div class="card">
					<div class="header">
						<h2>USERS</h2>
						<ul class="header-dropdown m-r--5">
							<a href="<?= base_url() ?>setting/adduser">
								<button class="btn btn-primary">CREATE</button>
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
										<th width="10%"><?php echo $lang_full_name; ?></th>
										<th width="20%"><?php echo $lang_email; ?></th>
										<th width="10%"><?php echo $lang_role; ?></th>
										<th width="10%"><?php echo $lang_outlets; ?></th>
										<th width="10%"><?php echo $lang_status; ?></th>
										<th width="30%"><?php echo $lang_action; ?></th>
									</tr>
								</thead>
								<tbody>
									
									<?php
                                        if (count($results) > 0) {
                                            foreach ($results as $k=>$data) {
                                                $id = $data->id;
                                                $fullname = $data->fullname;
                                                $email = $data->email;
                                                $role_id = $data->role_id;
                                                $outlet_id = $data->outlet_id;
                                                $status = $data->status;
                                                $outlet_name = '-';
                                                if ($outlet_id > 0) {
                                                    $outletNameData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$outlet_id");
                                                    if (count($outletNameData) > 0) {
                                                        $outlet_name = $outletNameData[0]->name;
													}
												}
                                                $role_name = '';
                                                $roleNameData = $this->Constant_model->getDataOneColumn('user_roles', 'id', "$role_id");
                                                $role_name = $roleNameData[0]->name;
											?>
											<tr>
												<td><?php echo $k;?></td>
												<td><?php echo $fullname; ?></td>
												<td><?php echo $email; ?></td>
												<td><?php echo $role_name; ?></td>
												<td><?php echo $outlet_name; ?></td>
												<td><?php  echo  ($status == '1')? $lang_active : $lang_inactive; ?></td>
												<td>
													<a href="<?= base_url() ?>setting/changePassword?id=<?php echo $id; ?>">
														<button class="btn btn-primary"><?php echo $lang_change_password; ?></button>
													</a>
													<a href="<?= base_url() ?>setting/edituser?id=<?php echo $id; ?>">
														<button class="btn btn-primary"><?php echo $lang_edit; ?></button>
													</a>
													<a href="<?= base_url() ?>setting/deleteUser?id=<?php echo $id; ?>">
														<button class="btn btn-primary"><?php echo $lang_change_password; ?></button>
													</a>
												</td>
											</tr>
										<?php } } ?>
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