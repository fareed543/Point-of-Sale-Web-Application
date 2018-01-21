<?php require_once 'includes/header.php'; ?>

<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">
                <ol class="breadcrumb breadcrumb-bg-cyan">
                    <li><a href="<?php echo base_url() ?>"><i class="material-icons">home</i> Home</a></li>
                    <li><a href="<?php echo base_url() ?>/inventory/view"><i class="material-icons">store</i> <?php echo $lang_inventory; ?></a></li>
                    <li class="active"><i class="material-icons">search</i> <?php echo $lang_search; ?></li>
                </ol>
                <div class="card">
                    <div class="header">
                        <h2><?php echo $lang_inventory; ?></h2>
                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>inventory/exportInventory" >
                                <button type="button" class="btn btn-success" >
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
                                <tbody>
                                    <?php
                                    $sort = '';

                                    if (!empty($search_code)) {
                                        $sort .= " AND code LIKE '$search_code%' ";
                                    }

                                    if (!empty($search_name)) {
                                        $sort .= " AND name LIKE '%$search_name%' ";
                                    }

                                    $prodResult = $this->db->query("SELECT * FROM products WHERE created_datetime != '0000-00-00 00:00:00' $sort ");
                                    $prodRows = $prodResult->num_rows();

                                    $result_count = $prodRows;

                                    if ($prodRows > 0) {
                                        $prodData = $prodResult->result();
                                        for ($p = 0; $p < count($prodData); ++$p) {
                                            $code = $prodData[$p]->code;
                                            $name = $prodData[$p]->name;

                                            $inv_qty = 0;

                                            $ckInvResult = $this->db->query("SELECT qty FROM inventory WHERE product_code = '$code' ");
                                            $ckInvData = $ckInvResult->result();
                                            for ($k = 0; $k < count($ckInvData); ++$k) {
                                                $ckInv_qty = $ckInvData[$k]->qty;

                                                $inv_qty += $ckInv_qty;

                                                unset($ckInv_qty);
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
                                            unset($code);
                                            unset($name);
                                        }
                                        unset($prodData);
                                    } else {
                                        ?>
                                        <tr class="no-records-found">
                                            <td colspan="4"><?php echo $lang_no_match_found; ?></td>
                                        </tr>
                                        <?php
                                    }
                                    unset($prodResult);
                                    unset($prodRows);
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



<?php require_once 'includes/footer.php'; ?>