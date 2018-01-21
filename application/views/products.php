<?php require_once 'includes/header.php'; ?>
<section class="content">
    <div class="container-fluid">

        <ol class="breadcrumb breadcrumb-bg-cyan">
            <li><a href="<?= base_url() ?>"><i class="material-icons">home</i> Home</a></li>
            <li class="active"><i class="material-icons">view_module</i> <?php echo $lang_list_products; ?></li>
        </ol>

        <div class="row clearfix">
            <!-- Task Info -->
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
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
                        <h2><?php echo $lang_list_products; ?></h2>

                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>products/addproduct">
                                <button class="btn btn-primary"><?php echo $lang_add_product; ?></button>
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
                                        <th width="10%"><?php echo $lang_code; ?></th>
                                        <th width="20%"><?php echo $lang_name; ?></th>
                                        <!--<th width="10%"><?php echo $lang_image; ?></th>-->
                                        <th width="15%"><?php echo $lang_category; ?></th>
                                        <th width="10%"><?php echo $lang_cost; ?></th>
                                        <th width="10%"><?php echo $lang_price; ?></th>
                                        <th width="10%"><?php echo $lang_status; ?></th>
                                        <th width="15%"><?php echo $lang_action; ?></th>
                                    </tr>
                                </thead>
                                <tbody>

                                    <?php
                                    if (count($results) > 0) {
                                        foreach ($results as $key => $data) {
                                            $id = $data->id;
                                            $cat_id = $data->category;
                                            $cost = $data->purchase_price;
                                            $price = $data->retail_price;
                                            $thumbnail = $data->thumbnail;
                                            $status = $data->status;

                                            $category_name = '-';
                                            $categoryData = $this->Constant_model->getDataOneColumn('category', 'id', $cat_id);
                                            if (count($categoryData) > 0) {
                                                $category_name = $categoryData[0]->name;
                                            }

                                            $large_file_path = '';
                                            ?>
                                            <tr>
                                                <td><?php echo $key; ?></td>
                                                <td><?php echo $data->code; ?></td>
                                                <td><?php echo $data->name; ?></td>
                                                <!--<td>
                                                <?php
                                                if ($thumbnail == 'no_image.jpg') {
                                                    $large_file_path = base_url() . 'assets/upload/products/small/no_image.jpg';
                                                    ?>
                                                                            <img src="<?= base_url() ?>assets/upload/products/xsmall/no_image.jpg"/>
                                                    <?php
                                                } else {
                                                    $large_file_path = base_url() . 'assets/upload/products/small/' . $data->code . '/' . $thumbnail;
                                                    ?>
                                                                            <img src="<?= base_url() ?>assets/upload/products/xsmall/<?php echo $data->code; ?>/<?php echo $thumbnail; ?>"/>
                                                <?php }
                                                ?>
                                                </td>-->
                                                <td><?php echo $category_name; ?></td>
                                                <td><?php echo number_format($cost, 2); ?></td>
                                                <td><?php echo number_format($price, 2); ?></td>
                                                <td style="font-weight: bold;">
                                                    <?php
                                                    if ($status == '1') {
                                                        echo $lang_active;
                                                    }
                                                    if ($status == '0') {
                                                        echo $lang_inactive;
                                                    }
                                                    ?>
                                                </td>
                                                <td>
                                                    <a href="<?= base_url() ?>products/editproduct?id=<?php echo $id; ?>" title="Edit">
                                                        <i class="material-icons">mode_edit</i>
                                                    </a>

                                                    <a onclick="openReceipt('<?= base_url() ?>products/printBarcode?pcode=<?php echo $data->code; ?>')" title="Print Barcode">
                                                        <i class="material-icons">view_column</i>
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