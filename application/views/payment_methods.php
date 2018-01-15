<?php require_once 'includes/header.php'; ?>
<section class="content">
    <div class="container-fluid">
        <div class="block-header">
            <h2><?php echo $lang_payment_methods; ?></h2>
        </div>
        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="header">
                        <h2><?php echo $lang_payment_methods; ?></h2>
                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url() ?>setting/addpaymentmethod">
                                <button class="btn btn-primary">CREATE</button>
                            </a>

                            <a href="setting/createuser">
                                <button class="btn btn-danger">DELETE</button>
                            </a>
                        </ul>
                    </div>
                    <div class="body">
                        <div class="table-responsive">
                            <table class="table table-hover dashboard-task-infos">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th width="50%"><?php echo $lang_payment_method_name; ?></th>
                                        <th width="40%"><?php echo $lang_status; ?></th>
                                        <th width="10%"><?php echo $lang_action; ?></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (count($results) > 0) {
                                        foreach ($results as $key => $data) {
                                            $id = $data->id;
                                            $name = $data->name;
                                            $status = $data->status;
                                            ?>
                                            <tr>
                                                <td><?php echo $key; ?>
                                                <td><?php echo $name; ?>
                                                <td>
                                                    <?php
                                                    if ($status == '1') {
                                                        echo '<span>' . $lang_active . '</span>';
                                                    }
                                                    if ($status == '0') {
                                                        echo '<span>' . $lang_inactive . '</span>';
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>setting/editpaymentmethod?id=<?php echo $id; ?>">
                                                        <button class="btn btn-primary"><?php echo $lang_edit; ?></button>
                                                    </a>
                                                    <a href="<?= base_url() ?>setting/editpaymentmethod?id=<?php echo $id; ?>">
                                                        <button class="btn btn-primary"><?php echo $lang_edit; ?></button>
                                                    </a>
                                                </td>
                                            </tr>
                                            <?php
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
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>.