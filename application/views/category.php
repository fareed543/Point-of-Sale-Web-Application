<?php require_once 'includes/header.php'; ?>
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li><i class="material-icons">view_module</i> <?php echo $lang_product_category; ?></li>
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
                        <h2><?php echo $lang_product_category; ?></h2>

                        <ul class="header-dropdown m-r--5">
                            <a href="<?= base_url() ?>products/addproductcategory">
                                <button class="btn btn-primary"><?php echo $lang_add_product_category; ?></button>
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
                                        <th>#</th>
                                        <th width="60%"><?php echo $lang_name; ?></th>
                                        <th width="30%"><?php echo $lang_status; ?></th>
                                        <th width="10%"><?php echo $lang_action; ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (count($results) > 0) {
                                        foreach ($results as $key => $data) {
                                            ?>
                                            <tr>
                                                <td>
                                                    <?php echo $data->id; ?>
                                                </td><td>
                                                    <?php echo $data->name; ?>
                                                </td>
                                                <td>
                                                    <?php
                                                    if ($data->status == '1') {
                                                        echo $lang_active;
                                                    }
                                                    if ($data->status == '0') {
                                                        echo $lang_inactive;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>products/editproductcategory?id=<?php echo $data->id; ?>">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>

                                                    <a href="<?= base_url() ?>products/deleteproductcategory/<?php echo $data->id; ?>/<?php echo $data->name; ?>/">
                                                        <i class="material-icons">delete_forever</i>
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
        </div>
    </div>
</section>
<?php require_once 'includes/footer.php'; ?>.															