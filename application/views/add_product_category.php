<?php
	require_once 'includes/header.php';
?>
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<section class="content">
	<div class="container-fluid">
	
		<ol class="breadcrumb breadcrumb-bg-cyan">
					<li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
					<li><a href="<?php echo base_url() ?>products/product_category"><i class="material-icons">view_module</i> <?php echo $lang_product_category; ?></a></li>
					<li class="active"><i class="material-icons">archive</i> <?php echo $lang_add_product_category; ?></li>
				</ol>
				
		
		<form action="<?= base_url() ?>products/insertProductCategory" method="post">
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
							
							<h3 class="card-inside-title">Infomation</h3>
                            <div class="row clearfix">
								
								<div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
											<input type="text" name="category" class="form-control" maxlength="499" autofocus required autocomplete="off" />
											<label class="form-label"><?php echo $lang_name; ?></label>
										</div>
									</div>
								</div>
								
							</div>
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<button class="btn btn-primary"><?php echo $lang_add; ?></button>
										<a class="btn btn-primary" href="<?= base_url() ?>products/product_category"><?php echo $lang_back; ?></a>
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

<?php
	require_once 'includes/footer.php';
	?>			