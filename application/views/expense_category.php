<?php
require_once 'includes/header.php';
?>

<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>


<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li><i class="material-icons">view_module</i> <?php echo $lang_expenses_category; ?></li>
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

                <div class="card">
                    <div class="header">
                        <h2><?php echo $lang_expenses_category; ?></h2>

                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url() ?>expenses/expense_category_add">
                                <button class="btn btn-primary"><?php echo $lang_add_expenses_category; ?></button>
                            </a>
                            <a href="#">
                                <button class="btn btn-danger">DELETE</button>
                            </a>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
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
                                                <td>
                                                    <?php echo $exp_name; ?>
                                                </td>
                                                <td>
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
                                                    <a href="<?= base_url() ?>expenses/expense_category_edit?id=<?php echo $exp_id; ?>">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>

                                                    <a href="#">
                                                        <i class="material-icons">delete_forever</i>
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
                                        <tr class="no-records-found">
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
            </div>
        </div>
    </div>
</section><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>