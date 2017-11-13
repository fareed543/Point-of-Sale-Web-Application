<?php
require_once 'includes/header.php';
?>
<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_search_customer; ?></h1>
        </div>
    </div><!--/.row-->


    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <?php
                    if ($user_role < 3) {
                        ?>
                        <div class="row" style="border-bottom: 1px solid #e0dede; padding-bottom: 8px; margin-top: -5px;">
                            <div class="col-md-6">
                                <a href="<?= base_url() ?>customers/addCustomer" style="text-decoration: none;">
                                    <button type="button" class="btn btn-primary" style="padding-top: 2px; padding-bottom: 2px; border: 0px;">
                                        <i class="icono-plus"></i> <?php echo $lang_add_customer; ?>
                                    </button>
                                </a>
                            </div>
                            <div class="col-md-6" style="text-align: right;">
                                <a href="<?= base_url() ?>customers/exportSearchCustomer?search_name=<?php echo $search_name; ?>&search_email=<?php echo $search_email; ?>&search_mobile=<?php echo $search_mobile; ?>" style="text-decoration: none;">
                                    <button type="button" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                        <?php echo $lang_export; ?>
                                    </button>
                                </a>
                            </div>
                        </div>
                        <?php
                    }
                    ?>

                    <form action="<?= base_url() ?>customers/searchcustomer" method="get">
                        <div class="row" style="margin-top: 10px;">
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label><?php echo $lang_name; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="name" class="form-control" value="<?php echo $search_name; ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo $lang_email; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="email" class="form-control" value="<?php echo $search_email; ?>" />
                                </div>
                            </div>
                            <div class="col-md-3">
                                <div class="form-group">
                                    <label><?php echo $lang_mobile; ?> <span style="color: #F00">*</span></label>
                                    <input type="text" name="mobile" class="form-control" value="<?php echo $search_mobile; ?>" />
                                </div>
                            </div>
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label>&nbsp;</label><br />
                                    <button class="btn btn-primary" style="width: 100%;">&nbsp;&nbsp;<?php echo $lang_search; ?>&nbsp;&nbsp;</button>
                                </div>
                            </div>
                        </div>
                    </form>



                    <div class="row" style="margin-top: 0px;">
                        <div class="col-md-12">

                            <div class="table-responsive">
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th style="border-left: 1px solid #ddd; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd;" width="26%">
                                                <?php echo $lang_customer_name; ?>
                                            </th>
                                            <th style="border-left: 1px solid #ddd; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd;" width="26%">
                                                <?php echo $lang_email; ?>
                                            </th>
                                            <th style="border-left: 1px solid #ddd; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd;" width="20%">
                                                <?php echo $lang_mobile; ?>
                                            </th>
                                            <th style="border-left: 1px solid #ddd; border-bottom: 1px solid #ddd; border-top: 1px solid #ddd; border-right: 1px solid #ddd;" width="25%"><?php echo $lang_action; ?></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $result_count = 0;
                                        $sort = '';

                                        if (!empty($search_name)) {
                                            $sort .= " AND fullname LIKE '%$search_name%' ";
                                        }

                                        if (!empty($search_email)) {
                                            $sort .= " AND email LIKE '%$search_email%' ";
                                        }

                                        if (!empty($search_mobile)) {
                                            $sort .= " AND mobile LIKE '%$search_mobile%' ";
                                        }

                                        $searchResult = $this->db->query("SELECT * FROM customers WHERE created_datetime != '0000-00-00 00:00:00' $sort ORDER BY fullname ASC ");
                                        $searchRows = $searchResult->num_rows();

                                        if ($searchRows > 0) {
                                            $searchData = $searchResult->result();
                                            $result_count = count($searchData);

                                            for ($s = 0; $s < count($searchData); ++$s) {
                                                $cust_id = $searchData[$s]->id;
                                                $cust_fn = $searchData[$s]->fullname;
                                                $cust_em = $searchData[$s]->email;
                                                $cust_mb = $searchData[$s]->mobile;
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo $cust_fn; ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($cust_em)) {
                                                            echo $cust_em;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <?php
                                                        if (!empty($cust_mb)) {
                                                            echo $cust_mb;
                                                        } else {
                                                            echo '-';
                                                        }
                                                        ?>
                                                    </td>
                                                    <td>
                                                        <a href="<?= base_url() ?>customers/edit_customer?cust_id=<?php echo $cust_id; ?>" style="text-decoration: none;">
                                                            <button class="btn btn-primary" style="padding: 4px 12px;">&nbsp;&nbsp;<?php echo $lang_edit; ?>&nbsp;&nbsp;</button>
                                                        </a>

                                                        <a href="<?= base_url() ?>customers/customer_history?cust_id=<?php echo $cust_id; ?>" style="text-decoration: none; margin-left: 10px;">
                                                            <button class="btn btn-primary" style="padding: 4px 12px;">&nbsp;&nbsp;<?php echo $lang_sales_history; ?>&nbsp;&nbsp;</button>
                                                        </a>
                                                    </td>
                                                </tr>
                                                <?php
                                                unset($cust_id);
                                                unset($cust_fn);
                                                unset($cust_em);
                                                unset($cust_mb);
                                            }
                                            unset($searchData);
                                        } else {
                                            ?>
                                            <tr>
                                                <td colspan="4"><?php echo $lang_no_match_found; ?></td>
                                            </tr>
                                            <?php
                                        }
                                        unset($searchResult);
                                        unset($searchRows);
                                        ?>
                                    </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6" style="float: left; padding-top: 10px;">
                            <?php
                            if ($result_count > 0) {
                                ?>
                                Showing 1 to <?php echo $result_count; ?> of <?php echo $result_count; ?> 
                                <?php
                                if ($result_count == 1) {
                                    echo 'entry';
                                } else {
                                    echo 'entries';
                                }
                                ?>
                                <?php
                            }
                            ?>
                        </div>
                        <div class="col-md-6" style="text-align: right;">
                            <?php //echo $links; ?>
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