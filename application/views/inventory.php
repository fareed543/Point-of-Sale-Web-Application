<?php	require_once 'includes/header.php';	?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
            <div class="card">
                <div class="header">
                    <h2><?php echo $lang_inventory; ?></h2>
                    <ul class="header-dropdown m-r--5">
						
                        <a href="<?= base_url() ?>inventory/exportInventory" style="text-decoration: none;">
                            <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                <?php echo $lang_export_inventory; ?>
							</button>
						</a>
					</ul>
				</div>
				
                <div class="body">
                    <div class="table-responsive">
						<form action="<?= base_url() ?>inventory/searchInventory" method="get">
							<table class="table table-hover dashboard-task-infos">
                                <tr>
                                    <th width="15%"><input type="text" name="code" class="form-control" /></th>
                                    <th width="15%"><input type="text" name="name" class="form-control" /></th>
                                    <th width="15%">&nbsp;</th>
                                    <th width="10%"><button class="btn btn-primary"><?php echo $lang_search; ?></button></th>
								</tr>
							</table>	
						</form>
						
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th width="15%"><?php echo $lang_code; ?></th>
                                    <th width="15%"><?php echo $lang_name; ?></th>
                                    <th width="15%"><?php echo $lang_total_quantity; ?></th>
                                    <th width="10%"><?php echo $lang_action; ?></th>
								</tr>
							</thead>
                            <tbody> <?php
                                if (count($results) > 0) {
                                    foreach ($results as $data) {
                                        $id = $data->id;
                                        $code = $data->code;
                                        $name = $data->name;
										
                                        $inv_qty = 0;
										
                                        $ckInvResult = $this->db->query("SELECT qty, outlet_id FROM inventory WHERE product_code = '$code' ");
                                        $ckInvData = $ckInvResult->result();
                                        for ($k = 0; $k < count($ckInvData); ++$k) {
                                            $ckInv_qty = $ckInvData[$k]->qty;
                                            $ckOutlet_id = $ckInvData[$k]->outlet_id;
											
                                            // Check Outlet;
                                            $ckOutletResult = $this->db->query("SELECT id FROM outlets WHERE id = '$ckOutlet_id' ");
                                            $ckOutletRows = $ckOutletResult->num_rows();
                                            if ($ckOutletRows == 1) {
                                                $inv_qty += $ckInv_qty;
											}
                                            unset($ckOutletResult);
                                            unset($ckOutletRows);
											
                                            unset($ckInv_qty);
                                            unset($ckOutlet_id);
										}
                                        unset($ckInvResult);
                                        unset($ckInvData);
										
                                        $each_cost = 0;
                                        $getCostResult = $this->db->query("SELECT purchase_price FROM products WHERE code = '$code' ");
                                        $getCostData = $getCostResult->result();
										
                                        $each_cost = $getCostData[0]->purchase_price;
										
                                        unset($getCostResult);
                                        unset($getCostData);
										
                                        $each_row_cost = 0;
                                        $each_row_cost = $inv_qty * $each_cost;
									?>
									<tr>
										<td><?php echo $code; ?></td>
										<td><?php echo $name; ?></td>
										<td><?php echo $inv_qty; ?></td>
										<!-- <td><?php echo number_format($each_row_cost, 2, '.', ''); ?></td> -->
										<td>
											<a href="<?= base_url() ?>inventory/view_detail?pcode=<?php echo $code; ?>">
												<i class="material-icons">remove_red_eye</i>
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
                <div class="row clearfix">
                    <div class="col-md-6">
                        <?php echo $displayshowingentries; ?>
					</div>
                    <div class="col-md-6">
						<?php echo $links; ?>
					</div>
				</div>
			</div>
            </div>
		</div>
	</div>
</section>
<?php	require_once 'includes/footer.php';	?>