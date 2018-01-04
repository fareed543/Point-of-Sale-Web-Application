<?php
	require_once 'includes/header.php';
	
	$userDtaData = $this->Constant_model->getDataOneColumn('users', 'id', $id);

if (count($userDtaData) == 0) {
    redirect(base_url());
}

$fullname = $userDtaData[0]->fullname;
$email = $userDtaData[0]->email;
$db_role_id = $userDtaData[0]->role_id;
$db_outlet_id = $userDtaData[0]->outlet_id;
$pin = $userDtaData[0]->pin;
$status = $userDtaData[0]->status;

?>


<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<section class="content">
	<div class="container-fluid">
		<?php echo $lang_edit_user; ?> : <?php echo $fullname; ?>
		
		<form action="<?= base_url() ?>setting/updateUser" method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
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
							
							
							<h3 class="card-inside-title">Basic Infomation</h3>
                            <div class="row clearfix">
								
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" name="fullname" class="form-control"  maxlength="499" autocomplete="off" value="<?php echo $fullname; ?>" />
											<label class="form-label"><?php echo $lang_full_name; ?></label>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="email" name="email" class="form-control" maxlength="254" autocomplete="off" value="<?php echo $email; ?>" />
											<label class="form-label"><?php echo $lang_email; ?></label>
										</div>
									</div>
								</div>
								
							</div>
							
							<h3 class="card-inside-title">Login Details</h3>
							<div class="row clearfix">
								
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="password" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="pin" class="form-control" maxlength="4" value="" />
											<label class="form-label">Passcode</label>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<!--<p><?php echo $lang_outlets; ?></p>-->
									<select name="outlet" class="form-control show-tick" data-live-search="true">
										 <option value="1" <?php
                                        if ($status == '1') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_active; ?></option>
                                        <option value="0" <?php
                                        if ($status == '0') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_status; ?></option>
									</select>
								</div>
								
							</div>
							
							<h3 class="card-inside-title">Role</h3>
							<div class="row clearfix">
								
								<div class="col-sm-6">
									<!--<p><?php echo $lang_role; ?></p>-->
									<select name="role" class="form-control show-tick" data-live-search="true">
										<option value=""><?php echo $lang_choose_role; ?></option>
										<?php
                                        if ($user_role == 3) {
                                            
                                        }
                                        $roleData = $this->Constant_model->getDataAll('user_roles', 'id', 'ASC');
                                        for ($r = 0; $r < count($roleData); ++$r) {
                                            $role_id = $roleData[$r]->id;
                                            $role_name = $roleData[$r]->name;

                                            if ($user_role == 2) {
                                                if ($role_id == 1) {
                                                    continue;
                                                }
                                            }
                                            if ($user_role == 3) {
                                                if ($role_id < 3) {
                                                    continue;
                                                }
                                            }
                                            ?>
                                            <option value="<?php echo $role_id; ?>" <?php
                                            if ($db_role_id == $role_id) {
                                                echo 'selected="selected"';
                                            }
                                            ?>>
                                                        <?php echo $role_name; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
									</select>
								</div>
								
								
								<div class="col-sm-6">
									<!--<p><?php echo $lang_outlets; ?></p>-->
									<select name="outlet" class="form-control show-tick" data-live-search="true">
										<option value=""><?php echo $lang_choose_outlet; ?></option>
										<?php
                                        if ($user_role == 1) {
                                            $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'name', 'ASC');
                                        } else {
                                            $outletData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$user_outlet");
                                        }
                                        for ($u = 0; $u < count($outletData); ++$u) {
                                            $outlet_id = $outletData[$u]->id;
                                            $outlet_name = $outletData[$u]->name;
                                            ?>
                                            <option value="<?php echo $outlet_id; ?>" <?php
                                            if ($db_outlet_id == $outlet_id) {
                                                echo 'selected="selected"';
                                            }
                                            ?>>
                                                        <?php echo $outlet_name; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
									</select>
								</div>
								
								
								
							</div>
							
							
							
							
							<?/*?><h3 class="card-inside-title">Login Details</h3>
							<div class="row clearfix">
							<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="password" name="password" class="form-control" maxlength="499" autocomplete="off" value="<?php	if (!empty($alert_msg)) { echo $alert_msg[5];}	?>" />
											<label class="form-label"><?php echo $lang_password; ?></label>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="password" name="conpassword" class="form-control" maxlength="499" autocomplete="off" value="<?php	if (!empty($alert_msg)) {	echo $alert_msg[6];}	?>" />
											<label class="form-label"><?php echo $lang_confirm_password; ?></label>
										</div>
									</div>
								</div>
							</div>
							</div><?php */?>
							
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<button class="btn btn-primary"><?php echo $lang_add; ?></button>
										<a class="btn btn-primary" href="<?= base_url() ?>setting/users"><?php echo $lang_back; ?></a>
									</div>
									
									
								</div>
							</div>
						</div>
						
						
						
					</div><!-- Panel Body // END -->
				</div><!-- Panel Default // END -->
			</div><!-- Col md 12 // END -->
		</div><!-- Row // END -->
	</form>
	
	
</div>
</div>

<?php require_once 'includes/footer.php'; ?>			