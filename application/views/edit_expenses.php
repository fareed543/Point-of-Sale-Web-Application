<?php
require_once 'includes/header.php';

$expDtaData = $this->Constant_model->getDataOneColumn('expenses', 'id', $id);
if (count($expDtaData) == 0) {
    redirect(base_url());
}

$number = $expDtaData[0]->expenses_number;
$exp_outlet = $expDtaData[0]->outlet_id;
$date = $expDtaData[0]->date;
$amount = $expDtaData[0]->amount;
$reason = $expDtaData[0]->reason;
$file_name = $expDtaData[0]->file_name;
$exp_category = $expDtaData[0]->expense_category;
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


<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>

<script>
    $(function () {
        $("#startDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });
    });
</script>

<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_edit_expenses; ?> : <?php echo $number; ?></h1>
        </div>
    </div><!--/.row-->

    <form action="<?= base_url() ?>expenses/updateExpenses" method="post" enctype="multipart/form-data">
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
                                    <label><?php echo $lang_expenses_number; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="number" class="form-control" maxlength="250" autofocus required autocomplete="off" value="<?php echo $number; ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_outlets; ?> <span style="color: #F00">*</span></label>
                                    <select name="outlet" class="form-control" required>
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
                                            if ($outlet_id == $exp_outlet) {
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
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_date; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="date" id="startDate" class="form-control" required value="<?php echo date($site_dateformat, strtotime($date)); ?>" />
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_reason; ?> <span style="color: #F00">*</span></label>
                                    <textarea name="reason" class="form-control" style="width: 100%; height: 70px;" required><?php echo $reason; ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_amount; ?> (<?php echo $site_currency ?>) <span style="color: #F00">*</span></label>
                                    <input type="text" name="amount" class="form-control" maxlength="250" autofocus required autocomplete="off" value="<?php echo $amount; ?>" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_expenses_category; ?> <span style="color: #F00">*</span></label>
                                    <select name="category" class="form-control" required>
                                        <option value=""><?php echo $lang_choose_expenses_category; ?></option>
                                        <?php
                                        $expData = $this->Constant_model->getDataAll('expense_categories', 'name', 'ASC');
                                        for ($p = 0; $p < count($expData); ++$p) {
                                            $exp_id = $expData[$p]->id;
                                            $exp_name = $expData[$p]->name;
                                            ?>
                                            <option value="<?php echo $exp_id; ?>" <?php
                                            if ($exp_id == $exp_category) {
                                                echo 'selected="selected"';
                                            }
                                            ?>>
                                                        <?php echo $exp_name; ?>
                                            </option>
                                            <?php
                                            unset($exp_id);
                                            unset($exp_name);
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label style="letter-spacing: 0.5px;"><?php echo $lang_file; ?> (<?php echo $lang_less_than; ?> 2MB) <span style="color: #F00">*</span></label>
                                    <br />
                                    <input id="uploadFile" readonly style="height: 40px; width: 230px; border: 1px solid #ccc" />
                                    <div class="fileUpload btn btn-primary" style="padding: 9px 12px;">
                                        <?php
                                        if (!empty($file_name)) {
                                            echo '<span>' . $lang_replace . '</span>';
                                        } else {
                                            echo '<span>' . $lang_browse . '</span>';
                                        }
                                        ?>
                                        <input id="uploadBtn" name="uploadFile" type="file" class="upload" />
                                    </div>

                                    <?php
                                    if (!empty($file_name)) {
                                        ?>
                                        <label style="margin-top: 10px;">
                                            <a href="<?= base_url() ?>assets/upload/expenses/<?php echo $file_name; ?>" download>[<?php echo $lang_download_file; ?>]</a>
                                        </label>
                                        <?php
                                    }
                                    ?>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>

                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                    <button class="btn btn-primary">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_update; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</button>
                                </div>
                            </div>
                            <div class="col-md-4"></div>
                            <div class="col-md-4"></div>
                        </div>



                    </div><!-- Panel Body // END -->
                </div><!-- Panel Default // END -->

                <a href="<?= base_url() ?>expenses/view" style="text-decoration: none;">
                    <div class="btn btn-success" style="background-color: #999; color: #FFF; padding: 0px 12px 0px 2px; border: 1px solid #999;"> 
                        <i class="icono-caretLeft" style="color: #FFF;"></i><?php echo $lang_back; ?>
                    </div>
                </a>

            </div><!-- Col md 12 // END -->
        </div><!-- Row // END -->
    </form>

    <br /><br /><br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>