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



<!--Select Dropdown js start-->     
<link href="<?= base_url() ?>assets/plugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" />
<script src="<?= base_url() ?>assets/plugins/bootstrap-select/js/bootstrap-select.js"></script>
<!--Select Dropdown js end-->
<script>
    $(function () {
        $("#startDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });
    });
</script>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">

                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li class="active"><a href="<?= base_url() ?>/expenses/view"><i class="material-icons">attach_money</i> Expenses</a></li>
                    <li class="active"><i class="material-icons">mode_edit</i> <?php echo $lang_edit_expenses; ?></li>
                </ol>

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



                                    <h3 class="card-inside-title"><?php echo $lang_edit_expenses; ?></h3>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                      <label class="form-label"><?php echo $lang_expenses_number; ?></label>
                                                    <input type="text" name="number" class="form-control" maxlength="250" autofocus required autocomplete="off" value="<?php echo $number; ?>" />
                                                  
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                     
                                                      <select name="outlet" class="form-control show-tick" data-live-search="true" required>
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
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label"><?php echo $lang_date; ?> </label>
                                                    <input type="text" name="date" id="startDate" class="form-control" required value="<?php echo date($site_dateformat, strtotime($date)); ?>" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                       

                                    </div>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                     <label class="form-label"><?php echo $lang_reason; ?></label>
                                                    <textarea name="reason" class="form-control" required><?php echo $reason; ?></textarea>
                                                   
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <label class="form-label"><?php echo $lang_amount; ?> (<?php echo $site_currency ?>)  </label>
                                                    <input type="text" name="amount" class="form-control" maxlength="250" autofocus required autocomplete="off" value="<?php echo $amount; ?>" />
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                   
                                                    <select name="category" class="form-control show-tick" style="" data-live-search="true" required>
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



                                    </div>
                                    <div class="row clearfix">

                                        <div class="col-sm-4">
                                            <div class="form-group form-float">
                                                <div class="form-line">
                                                    <input id="uploadFile" readonly />
                                                    <label class="form-label"><?php echo $lang_file; ?> (<?php echo $lang_less_than; ?> 2MB)</label>
                                                    <div class="fileUpload btn btn-primary" >
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
                                                        <label >
                                                            <a href="<?= base_url() ?>assets/upload/expenses/<?php echo $file_name; ?>" download>[<?php echo $lang_download_file; ?>]</a>
                                                        </label>
                                                        <?php
                                                    }
                                                    ?>
                                                    
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4"></div>
                                        <div class="col-md-4"></div>



                                    </div>

                                    <div class="row clearfix">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <input type="hidden" name="id" value="<?php echo $id; ?>" />
                                                <button class="btn btn-primary"><?php echo $lang_update; ?></button>
                                                <a class="btn btn-primary" href="<?= base_url() ?>expenses/view"><?php echo $lang_back; ?></a>
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

</section><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>