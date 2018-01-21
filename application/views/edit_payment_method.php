<?php require_once 'includes/header.php';
	
$payDtaData = $this->Constant_model->getDataOneColumn('payment_method', 'id', $id);

if (count($payDtaData) == 0) {
    redirect(base_url());
}
$payment_name = $payDtaData[0]->name;
$payment_status = $payDtaData[0]->status;
?>
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>

<section class="content">
    <div class="container-fluid">
        <ol class="breadcrumb breadcrumb-bg-cyan">
            <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
            <li><a href="<?php echo base_url() ?>setting/payment_methods"><i class="material-icons">payment</i> <?php echo $lang_expenses_category; ?></a></li>
            <li class="active"><i class="material-icons">mode_edit</i> <?php echo $lang_edit_payment_method; ?> : <?php echo $payment_name; ?></li>
		</ol>
		
		<?php
			if (!empty($alert_msg)) {
				$flash_status = $alert_msg[0];
				$flash_header = $alert_msg[1];
				$flash_desc = $alert_msg[2];
			?>
			<?php if ($flash_status == 'failure') { ?>
				<div class="alert alert-info">
					<strong>Heads up!</strong> <?php echo $flash_desc; ?>
				</div>
			<?php } ?>
			<?php if ($flash_status == 'success') { ?>
				<div class="alert alert-success">
					<strong>Well done!</strong> <?php echo $flash_desc; ?>
				</div>
			<?php } ?>
		<?php } ?>
		
		
        <form action="<?= base_url() ?>setting/updatePaymentMethod" method="post">
            <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="card-inside-title">Basic Details</h3>
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" name="name" class="form-control" maxlength="99" autofocus required autocomplete="off" value="<?php echo $payment_name; ?>" />
											<label class="form-label"><?php echo $lang_payment_method_name; ?></label>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									<!--<p><?php echo $lang_status; ?></p>-->
									<select name="status" class="form-control show-tick" data-live-search="true">
										<option value="0" <?php	if ($payment_status == '0') {	echo 'selected="selected"';	}	?>><?php echo $lang_inactive; ?></option>
										<option value="1" <?php	if ($payment_status == '1') {	echo 'selected="selected"';	}	?>><?php echo $lang_active; ?></option>
									</select>
								</div>
							</div>
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<button class="btn btn-primary"><?php echo $lang_update; ?></button>
										<a class="btn btn-primary" href="<?= base_url() ?>setting/payment_methods"><?php echo $lang_back; ?></a>
									</div>
								</div>
							</div>
						</div>
						
					</div><!-- Panel Body // END -->
				</div><!-- Panel Default // END -->
			</form>
		</div>
	</section><!-- Right Colmn // END -->
	<?php require_once 'includes/footer.php'; ?>		