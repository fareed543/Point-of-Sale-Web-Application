<?php
require_once 'includes/header.php';
?>

<section class="content">
    <div class="container-fluid">
        <ol class="breadcrumb breadcrumb-bg-cyan">
            <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
            <li><a href="<?php echo base_url() ?>setting/payment_methods"><i class="material-icons">payment</i> <?php echo $lang_expenses_category; ?></a></li>
            <li class="active"><i class="material-icons">add</i> <?php echo $lang_add_payment_method; ?> </li>
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
		
		
        <form action="<?= base_url() ?>setting/insertPaymentMethod" method="post">
           
			<div class="row">
				<div class="col-md-12">
					<div class="panel panel-default">
						<div class="panel-body">
							<h3 class="card-inside-title">Basic Details</h3>
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" name="name" class="form-control" maxlength="99" autofocus required autocomplete="off" />
											<label class="form-label"><?php echo $lang_payment_method_name; ?></label>
										</div>
									</div>
								</div>
								
								<div class="col-sm-6">
									
								</div>
							</div>
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<button class="btn btn-primary"><?php echo $lang_add; ?></button>
										<a class="btn btn-primary" href="<?= base_url() ?>setting/payment_methods"><?php echo $lang_back; ?></a>
									</div>
								</div>
							</div>
						</div>
						
					</div><!-- Panel Body // END -->
				</div><!-- Panel Default // END -->
			
		</div>
            </form>
	</section><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>