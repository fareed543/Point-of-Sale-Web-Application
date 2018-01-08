<?php require_once 'includes/header.php'; ?>
<section class="content">
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
				<div class="card">
					<div class="header">
						<h2>
							<?php echo $lang_choose_outlet; ?>
							<!--<small>All pictures taken from <a href="https://unsplash.com/" target="_blank">unsplash.com</a></small>-->
						</h2>
						<ul class="header-dropdown m-r--5">
							<li class="dropdown">
								<a href="javascript:void(0);" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
									<i class="material-icons">more_vert</i>
								</a>
								<ul class="dropdown-menu pull-right">
									<li><a href="javascript:void(0);">Action</a></li>
									<li><a href="javascript:void(0);">Another action</a></li>
									<li><a href="javascript:void(0);">Something else here</a></li>
								</ul>
							</li>
						</ul>
					</div>
					<div class="body">
						<div id="aniimated-thumbnials" class="list-unstyled row clearfix">							
							<?php
								$outletData = $this->Constant_model->getDataOneColumn('outlets', 'status', '1');
								
								for ($i = 0; $i < count($outletData); ++$i) {
									$outlet_id = $outletData[$i]->id;
									$outlet_name = $outletData[$i]->name;
									$outlet_address = $outletData[$i]->address;
									$outlet_contact = $outletData[$i]->contact_number;
								?>
								<a href="<?= base_url() ?>pos/updateOwnerOutlet?outlet_id=<?php echo $outlet_id; ?>">
									<div class="col-xs-6 col-sm-4 col-md-2 col-lg-2">
										<div class="demo-color-box bg-pink">
											<div class="row" <?php if ($i > 0) { ?> <?php } ?>>
												<i class="material-icons">store</i>
												<div class="color-code"><?php echo $outlet_name; ?></div>
												<div class="color-code"><!--<?php echo $lang_address; ?>:--> <?php echo $outlet_address; ?></div>
												<div class="color-code"><!--<?php echo $lang_telephone; ?>: --><?php echo $outlet_contact; ?></div>
											</div>
										</div>
									</div>
								</a>
								<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<?php require_once 'includes/footer.php'; ?>