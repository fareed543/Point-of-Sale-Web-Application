<?php
	require_once 'includes/header.php';

    $siteDtaData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');

    $site_name = $siteDtaData[0]->site_name;
    $timezone = $siteDtaData[0]->timezone;
    $pagination = $siteDtaData[0]->pagination;
    $tax = $siteDtaData[0]->tax;
    $currency = $siteDtaData[0]->currency;
    $dtm_format = $siteDtaData[0]->datetime_format;
    $display_product = $siteDtaData[0]->display_product;
    $keyborad = $siteDtaData[0]->display_keyboard;
    $def_cust_id = $siteDtaData[0]->default_customer_id;
    $site_logo = $siteDtaData[0]->site_logo;
?>
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<link href="<?= base_url() ?>assets/plugins/dropzone/dropzone.css" rel="stylesheet">
<script src="<?= base_url() ?>assets/plugins/dropzone/dropzone.js"></script>

<section class="content">
	<div class="container-fluid">
	<div class="row clearfix">
	<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

	<ol class="breadcrumb breadcrumb-bg-cyan">
					<li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
					<li class="active"><i class="material-icons">store</i> <?php echo $lang_system_setting; ?></li>
				</ol>
		
		<form action="<?= base_url() ?>setting/updateSiteSetting" method="post" enctype="multipart/form-data">
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
                                        <input type="text" name="site_name" class="form-control" maxlength="499" autofocus required value="<?php echo $site_name; ?>" autocomplete="off" />
											<label class="form-label"><?php echo $lang_site_name; ?></label>
										</div>
									</div>
								</div>

                                <div class="col-sm-6">
									<div class="form-group form-float">
										<div class="form-line">
                                        <input type="text" name="tax" class="form-control" maxlength="499" autofocus required value="<?php echo $tax; ?>" autocomplete="off" />
											<label class="form-label"><?php echo $lang_tax; ?></label>
										</div>
									</div>
								</div>


                            </div>
							
							<h3 class="card-inside-title">Admin Settings</h3>
                            <div class="row clearfix">
                                     <div class="col-sm-6">
									<!--<p><?php echo $lang_system_date_format; ?></p>-->
									<select  name="date_format" class="form-control show-tick" data-live-search="true">
                                    <option value="Y-m-d" <?php
                                        if ($dtm_format == 'Y-m-d') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>yyyy-mm-dd</option>
                                        <option value="Y.m.d" <?php
                                        if ($dtm_format == 'Y.m.d') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>yyyy.mm.dd</option>
                                        <option value="Y/m/d" <?php
                                        if ($dtm_format == 'Y/m/d') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>yyyy/mm/dd</option>
                                        <option value="m-d-Y" <?php
                                        if ($dtm_format == 'm-d-Y') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>mm-dd-yyyy</option>
                                        <option value="m.d.Y" <?php
                                        if ($dtm_format == 'm.d.Y') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>mm.dd.yyyy</option>
                                        <option value="m/d/Y" <?php
                                        if ($dtm_format == 'm/d/Y') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>mm/dd/yyyy</option>
                                        <option value="d-m-Y" <?php
                                        if ($dtm_format == 'd-m-Y') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>dd-mm-yyyy</option>
                                        <option value="d.m.Y" <?php
                                        if ($dtm_format == 'd.m.Y') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>dd.mm.yyyy</option>
                                        <option value="d/m/Y" <?php
                                        if ($dtm_format == 'd/m/Y') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>dd/mm/yyyy</option>
                                        </select>
								</div>

                                
								
                                <div class="col-sm-6">
									<!--<p><?php echo $lang_currency; ?></p>-->
									<select name="currency" class="form-control show-tick" data-live-search="true">
                                    <?php
                                    $currencyData = $this->Constant_model->getDataAll('currency', 'iso', 'ASC');
                                    for ($c = 0; $c < count($currencyData); ++$c) {
                                        $currency_iso = $currencyData[$c]->iso;
                                        ?>
                                        <option value="<?php echo $currency_iso; ?>" <?php
                                        if ($currency_iso == $currency) {
                                            echo 'selected="selected"';
                                        }
                                        ?>>
                                                    <?php echo $currency_iso; ?>
                                        </option>
                                        <?php
                                        unset($currency_iso);
                                    }
                                    ?>
                                        </select>
								</div>
                                </div>
                                <h3 class="card-inside-title">Admin Settings</h3>
                            <div class="row clearfix">
                                <div class="col-sm-6">
									<!--<p><?php echo $lang_pagination_per_page; ?></p>-->
									<select name="pagination" class="form-control show-tick" data-live-search="true">
                                    <option value="10" <?php if ($pagination == '10') { echo 'selected="selected"'; }?>>10</option>
                                        <option value="20" <?php if ($pagination == '20') { echo 'selected="selected"';} ?>>20</option>
                                        <option value="50" <?php if ($pagination == '50') { echo 'selected="selected"'; } ?>>50</option>
                                        <option value="100" <?php if ($pagination == '100') { echo 'selected="selected"'; } ?>>100</option>
                                        </select>
								</div>


                                
                                <div class="col-sm-6">
									<!--<p><?php echo $lang_pos_display_product; ?></p>-->
									<select name="display_product" class="form-control show-tick" data-live-search="true">
                                    <option value="1" <?php if ($display_product == '1') { echo 'selected="selected"'; } ?>><?php echo $lang_name; ?></option>
                                    <option value="2" <?php if ($display_product == '2') { echo 'selected="selected"'; } ?>><?php echo $lang_photo; ?></option>
                                    <option value="3" <?php if ($display_product == '3') { echo 'selected="selected"'; } ?>><?php echo $lang_both; ?></option>
                                    </select>
								</div>


                                <div class="col-sm-6">
									<!--<p><?php echo $lang_system_timezone; ?></p>-->
									<select name="timezone" class="form-control show-tick" data-live-search="true">
                                    <?php
                                        $timeZoneData = $this->Constant_model->getDataAll('timezones', 'timezone', 'ASC');
                                        for ($t = 0; $t < count($timeZoneData); ++$t) {
                                            $timezone_name = $timeZoneData[$t]->timezone;
                                            ?>
                                            <option value="<?php echo $timezone_name; ?>" <?php if ($timezone_name == $timezone) { echo 'selected="selected"'; }?>><?php echo $timezone_name; ?></option>
                                            <?php unset($timezone_name); } ?>
									</select>
								</div>


                                
                                <div class="col-sm-6">
									<!--<p><?php echo $lang_pos_display_keyboard; ?></p>-->
									<select name="display_keyboard" class="form-control show-tick" data-live-search="true">
                                    <option value="1" <?php if ($keyborad == '1') { echo 'selected="selected"'; } ?>><?php echo $lang_yes; ?></option>
                                        <option value="0" <?php if ($keyborad == '0') { echo 'selected="selected"'; } ?>><?php echo $lang_no; ?></option>
									</select>
								</div>
								

                                <div class="col-sm-6">
									<!--<p><?php echo $lang_pos_default_customer; ?></p>-->
									<select name="display_keyboard" class="form-control show-tick" data-live-search="true">
                                    <?php
                                        $customerData = $this->Constant_model->getDataAll('customers', 'id', 'ASC');
                                        for ($u = 0; $u < count($customerData); ++$u) {
                                            $customer_id = $customerData[$u]->id;
                                            $customer_name = $customerData[$u]->fullname;
                                            ?>
                                            <option value="<?php echo $customer_id; ?>" <?php if ($customer_id == $def_cust_id) { echo 'selected="selected"'; } ?>><?php echo $customer_name; ?></option>
                                            <?php } ?>
									</select>
								</div>



                                <div class="col-sm-6">
                                    <label><?php echo $lang_logo; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <input id="uploadFile" readonly style="height: 40px; width: 230px; border: 1px solid #ccc" />
                                    <div class="fileUpload btn btn-primary" style="padding: 9px 12px;">
                                        <span><?php echo $lang_browse; ?></span>
                                        <input id="uploadBtn" name="uploadFile" type="file" class="upload" />
                                    </div>
                                    <img src="<?= base_url() ?>assets/img/logo/<?php echo $site_logo; ?>" height="100px" />
                                    </div>
							
							<div class="row clearfix">
								<div class="col-sm-6">
									<div class="form-group">
										<button class="btn btn-primary"><?php echo $lang_update_system_setting; ?></button>
										<a class="btn btn-primary" href="<?= base_url() ?>setting/outlets"><?php echo $lang_back; ?></a>
									</div>
									
									
								</div>
							</div>
						</div>

                        <div class="row clearfix">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="card">
                        <div class="header">
                            <h2>
                                FILE UPLOAD - DRAG & DROP OR WITH CLICK & CHOOSE
                                <small>Taken from <a href="http://www.dropzonejs.com/" target="_blank">www.dropzonejs.com</a></small>
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
                            <form action="/" id="frmFileUpload" class="dropzone" method="post" enctype="multipart/form-data">
                                <div class="dz-message">
                                    <div class="drag-icon-cph">
                                        <i class="material-icons">touch_app</i>
                                    </div>
                                    <h3>Drop files here or click to upload.</h3>
                                    <em>(This is just a demo dropzone. Selected files are <strong>not</strong> actually uploaded.)</em>
                                </div>
                                <div class="fallback">
                                    <input name="file" type="file" multiple />
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
						
					</div><!-- Panel Body // END -->
				</div><!-- Panel Default // END -->
			</div><!-- Col md 12 // END -->
                        </form>
		</div><!-- Row // END -->
		</div><!-- Row // END -->
		</div><!-- Row // END -->
	
</section>
	


<?php
	require_once 'includes/footer.php';
	?>			