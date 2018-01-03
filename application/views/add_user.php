<?php
	require_once 'includes/header.php';
?>
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<section class="content">
	<div class="container-fluid">
		<?php echo $lang_add_new_user; ?>
		<form action="<?= base_url() ?>setting/insertUser" method="post">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
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
							
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="text" name="fullname" class="form-control"  maxlength="499" autofocus required autocomplete="off" value="<?php	if (!empty($alert_msg)) {	echo $alert_msg[3];	}	?>" />
										<label class="form-label"><?php echo $lang_full_name; ?></label>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="email" name="email" class="form-control" maxlength="254" required autocomplete="off" value="<?php  if (!empty($alert_msg)) {	echo $alert_msg[4];}?>" />
										<label class="form-label"><?php echo $lang_email; ?></label>
									</div>
								</div>
							</div>
							
							
							
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="password" name="password" class="form-control" maxlength="499" required autocomplete="off" value="<?php	if (!empty($alert_msg)) { echo $alert_msg[5];}	?>" />
										<label class="form-label"><?php echo $lang_password; ?></label>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="password" name="conpassword" class="form-control" maxlength="499" required autocomplete="off" value="<?php	if (!empty($alert_msg)) {	echo $alert_msg[6];}	?>" />
										<label class="form-label"><?php echo $lang_confirm_password; ?></label>
									</div>
								</div>
							</div>
							
							<div class="col-sm-6">
								<div class="form-group form-float">
									<div class="form-line">
										<input type="password" onkeypress='return event.charCode >= 48 && event.charCode <= 57' name="pin" class="form-control" maxlength="4" required  value="" />
										<label class="form-label">Passcode</label>
									</div>
								</div>
							</div>
							
							
							<div class="col-sm-6">
								<p><?php echo $lang_role; ?></p>
								<select name="role" class="form-control show-tick" data-live-search="true">
									<option value=""><?php echo $lang_choose_role; ?></option>
									<?php
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
                                            if (!empty($alert_msg)) {
                                                if ($alert_msg[7] == $role_id) {
                                                    echo 'selected="selected"';
												}
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
								<p><?php echo $lang_outlets; ?></p>
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
                                            if (!empty($alert_msg)) {
                                                if ($alert_msg[8] == $outlet_id) {
                                                    echo 'selected="selected"';
												}
											}
                                            ?>>
											<?php echo $outlet_name; ?>
										</option>
										<?php
										}
									?>
								</select>
							</div>
							
							
							
							
                            <div class="col-sm-12">
                                <div class="form-group">
                                    <button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_add; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
								</div>
								
								<a href="<?= base_url() ?>setting/users" style="text-decoration: none;">
									<div class="btn btn-success"> 
										<i class="icono-caretLeft"></i><?php echo $lang_back; ?>
									</div>
								</a>
							</div>
							
							
							
						</div><!-- Panel Body // END -->
					</div><!-- Panel Default // END -->
				</div><!-- Col md 12 // END -->
			</div><!-- Row // END -->
		</form>
		
		
	</div>
</div>

<?php
	require_once 'includes/footer.php';
?>