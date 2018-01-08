<?php	require_once 'includes/header.php';	?>
<section class="content">
	<div class="container-fluid">
		<div class="row clearfix">
			<!-- Task Info -->
			<div class="col-xs-12 col-sm-12 col-md-8 col-lg-8">
				<div class="card">
					<div class="header">
						<h2>Products</h2>
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
					
					

									
									
						<div class="table-responsive">
						<?php
							$allProdData = $this->Constant_model->getPOSProducts('products', 'status', '1');
							for ($ap = 0; $ap < count($allProdData); ++$ap) {
								if ($allProdData[$ap]->qty > 0) {
								?>
								<div class="col-xs-6 col-sm-4 col-md-3 col-lg-3">
									<div class="demo-color-box bg-red">
										<div class="color-name"><?php echo $allProdData[$ap]->name; ?></div>
										<div class="color-code"><?php echo $allProdData[$ap]->code; ?></div>
										<div class="color-code"><?php echo $allProdData[$ap]->color; ?></div>
										<div class="color-class-name">bg-red</div>
									</div>
								</div>
								<?php
								}
							}
						?>	
							<!--<table class="table table-hover dashboard-task-infos">
								<thead>
									<tr>
										<th>#</th>
										<th>Code</th>
										<th>Name</th>
										<th>Color</th>
										<th>image</th>
									</tr>
								</thead>
								<tbody>
									
									<?php
										$allProdData = $this->Constant_model->getPOSProducts('products', 'status', '1');
										for ($ap = 0; $ap < count($allProdData); ++$ap) {
											if ($allProdData[$ap]->qty > 0) {
											?>
											<tr>
												<td><?php echo $ap; ?></td>
												<td><?php echo $allProdData[$ap]->name; ?></td>
												<td><?php echo $allProdData[$ap]->code; ?></td>
												<td><span class="label bg-green"><?php echo $allProdData[$ap]->color; ?></span></td>
												<td><?= base_url() ?>assets/upload/products/xsmall/<?php echo $allProdData[$ap]->thumbnail; ?></td>
											</tr>
											<?php
											}
										}
									?>	
								</tbody>
							</table>-->
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Task Info -->
			<!-- Browser Usage -->
			<div class="col-xs-12 col-sm-12 col-md-4 col-lg-4">
				<div class="card">
					<div class="header">
						<h2> <i class="material-icons">shopping_basket</i> Cart</h2>
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
						<div class="table-responsive">
							<table class="table table-hover dashboard-task-infos">
								<thead>
									<tr>
										<th>#</th>
										<th>Task</th>
										<th>Status</th>
										<th>Manager</th>
										<th>Progress</th>
									</tr>
								</thead>
								<tbody>
								
								<?php
										$allProdData = $this->Constant_model->getPOSProducts('products', 'status', '1');
										for ($ap = 0; $ap < count($allProdData); ++$ap) {
											if ($allProdData[$ap]->qty > 0) {
												$pcode = $allProdData[$ap]->code;
												$name = $allProdData[$ap]->name;
												$color = $allProdData[$ap]->color;
												$image = $allProdData[$ap]->thumbnail;
											?>
											<tr>
												<td><?php echo $ap; ?></td>
												<td><?php echo $name; ?></td>
												<td><?php echo $pcode; ?></td>
												<td><span class="label bg-green"><?php echo $color; ?></span></td>
												<td>
													<i class="material-icons">mode_edit</i>
													<i class="material-icons">control_point</i>
													<i class="material-icons">remove_circle_outline</i>
													<i class="material-icons">delete_forever</i>
												</td>
											</tr>
											<?php
											}
										}
									?>	
								</tbody>
							</table>
						</div>
					</div>
				</div>
			</div>
			<!-- #END# Browser Usage -->
		</div>
	</div>
</section>
<?php	require_once 'includes/footer.php';	?>.