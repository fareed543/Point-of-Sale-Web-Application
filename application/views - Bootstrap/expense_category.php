<?php
require_once 'includes/header.php';
?>

<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>


<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_expenses_category; ?></h1>
        </div>
    </div><!--/.row-->

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
                        <div class="col-md-6">
                            <a href="<?= base_url() ?>expenses/expense_category_add" style="text-decoration: none">
                                <button class="btn btn-primary" style="padding: 0px 12px;"><i class="icono-plus"></i><?php echo $lang_add_expenses_category; ?></button>
                            </a>
                        </div>
                        <div class="col-md-6"></div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table" style="margin-bottom: 0px;">
                                    <thead>
                                        <tr>
                                            <th width="15%"><?php echo $lang_expenses_category_name; ?></th>
                                            <th width="10%"><?php echo $lang_status; ?></th>
                                            <th width="10%"><?php echo $lang_action; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $expData = $this->Constant_model->getDataAll('expense_categories', 'id', 'DESC');
                                        if (count($expData) > 0) {
                                            for ($i = 0; $i < count($expData); ++$i) {
                                                $exp_id = $expData[$i]->id;
                                                $exp_name = $expData[$i]->name;
                                                $exp_status = $expData[$i]->status;
                                                ?>
                                                <tr>
                                                    <td><?php echo $exp_name; ?></td>
                                                    <td style="font-weight: bold;">
                                                        <?php
                                                        if ($exp_status == '1') {
                                                            echo '<span style="color: #090;">' . $lang_active . '</span>';
                                                        }
                                                        if ($exp_status == '0') {
                                                            echo '<span style="color: #f9243f;">' . $lang_inactive . '</span>';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url() ?>expenses/expense_category_edit?id=<?php echo $exp_id; ?>" style="text-decoration: none;">
                                                            <button class="btn btn-primary">
                                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $lang_edit; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                            </button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                unset($exp_id);
                                                unset($exp_name);
                                                unset($exp_status);
                                            }
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="3"><?php echo $lang_no_match_found; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>



                </div><!-- Panel Body // END -->
            </div><!-- Panel Default // END -->
        </div><!-- Col md 12 // END -->
    </div><!-- Row // END -->

    <br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>