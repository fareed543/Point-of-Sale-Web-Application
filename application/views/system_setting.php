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

<style type="text/css">
    .fileUpload {
        position: relative;
        overflow: hidden;
        border-radius: 0px;
        margin-left: -4px;
        margin-top: -2px;
    }
    .fileUpload input.upload {
        position: absolute;
        top: 0;
        right: 0;
        margin: 0;
        padding: 0;
        font-size: 20px;
        cursor: pointer;
        opacity: 0;
        filter: alpha(opacity=0);
    }
</style>

<script type="text/javascript">
    $(document).ready(function () {
        document.getElementById("uploadBtn").onchange = function () {
            document.getElementById("uploadFile").value = this.value;
        };
    });
</script>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_system_setting; ?></h1>
        </div>
    </div><!--/.row-->

    <form action="<?= base_url() ?>setting/updateSiteSetting" method="post" enctype="multipart/form-data">
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


                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_site_name; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="site_name" class="form-control" placeholder="Site Name" maxlength="499" autofocus required value="<?php echo $site_name; ?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_system_timezone; ?></label>
                                    <select name="timezone" class="form-control" required>
                                        <?php
                                        $timeZoneData = $this->Constant_model->getDataAll('timezones', 'timezone', 'ASC');
                                        for ($t = 0; $t < count($timeZoneData); ++$t) {
                                            $timezone_name = $timeZoneData[$t]->timezone;
                                            ?>
                                            <option value="<?php echo $timezone_name; ?>" <?php
                                            if ($timezone_name == $timezone) {
                                                echo 'selected="selected"';
                                            }
                                            ?>>
                                                        <?php echo $timezone_name; ?>
                                            </option>
                                            <?php
                                            unset($timezone_name);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_pagination_per_page; ?> <span style="color: #F00">*</span></label>
                                    <select name="pagination" class="form-control" required>
                                        <option value="10" <?php
                                        if ($pagination == '10') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>10</option>
                                        <option value="20" <?php
                                        if ($pagination == '20') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>20</option>
                                        <option value="50" <?php
                                        if ($pagination == '50') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>50</option>
                                        <option value="100" <?php
                                        if ($pagination == '100') {
                                            echo 'selected="selected"';
                                        }
                                        ?>>100</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_tax; ?> (%) <span style="color: #F00">*</span></label>
                                    <input type="text" name="tax" class="form-control" placeholder="0" maxlength="2" required value="<?php echo $tax; ?>" autocomplete="off" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_currency; ?> <span style="color: #F00">*</span></label>
                                    <select name="currency" class="form-control" required>
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_system_date_format; ?> <span style="color: #F00">*</span></label>
                                    <select name="date_format" class="form-control" required>
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
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_pos_display_product; ?> <span style="color: #F00">*</span></label>
                                    <select name="display_product" class="form-control" required>
                                        <option value="1" <?php
                                        if ($display_product == '1') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_name; ?></option>
                                        <option value="2" <?php
                                        if ($display_product == '2') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_photo; ?></option>
                                        <option value="3" <?php
                                        if ($display_product == '3') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_both; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_pos_display_keyboard; ?> <span style="color: #F00">*</span></label>
                                    <select name="display_keyboard" class="form-control" required>
                                        <option value="1" <?php
                                        if ($keyborad == '1') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_yes; ?></option>
                                        <option value="0" <?php
                                        if ($keyborad == '0') {
                                            echo 'selected="selected"';
                                        }
                                        ?>><?php echo $lang_no; ?></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_pos_default_customer; ?> <span style="color: #F00">*</span></label>
                                    <select name="default_customer" class="form-control" required>
                                        <?php
                                        $customerData = $this->Constant_model->getDataAll('customers', 'id', 'ASC');
                                        for ($u = 0; $u < count($customerData); ++$u) {
                                            $customer_id = $customerData[$u]->id;
                                            $customer_name = $customerData[$u]->fullname;
                                            ?>
                                            <option value="<?php echo $customer_id; ?>" <?php
                                            if ($customer_id == $def_cust_id) {
                                                echo 'selected="selected"';
                                            }
                                            ?>>
                                                        <?php echo $customer_name; ?>
                                            </option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">

                                <div class="form-group">
                                    <label><?php echo $lang_logo; ?> <span style="color: #F00">*</span></label>
                                    <br />
                                    <input id="uploadFile" readonly style="height: 40px; width: 230px; border: 1px solid #ccc" />
                                    <div class="fileUpload btn btn-primary" style="padding: 9px 12px;">
                                        <span><?php echo $lang_browse; ?></span>
                                        <input id="uploadBtn" name="uploadFile" type="file" class="upload" />
                                    </div>
                                </div>

                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <img src="<?= base_url() ?>assets/img/logo/<?php echo $site_logo; ?>" height="100px" />
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row" style="margin-top: 20px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <button class="btn btn-primary">&nbsp;&nbsp;<?php echo $lang_update_system_setting; ?>&nbsp;&nbsp;</button>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>

                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->
            </div><!-- Col md 12 // END -->
        </div><!-- Row // END -->
    </form>

    <br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>