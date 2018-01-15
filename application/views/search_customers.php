<?php
require_once 'includes/header.php';
?>
<!-- Right Colmn // END -->
<section class="content">
    <div class="container-fluid">
        <div class="row clearfix">
            <!-- Task Info -->


            <!--<div class="col-xs-12 col-sm-12 col-md-12 col-lg-12">-->
            <div class="card">
                <?php
                if ($user_role < 3) {
                    ?>
                    <div class="header">
                        <h3><?php echo $lang_search_customer; ?></h3>
                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>customers/view" style="text-decoration: none;">
                                <button type="button" info="" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo "Back"; ?>
                                </button>
                            </a>
                        </ul>
                    </div>
                    <?php
                }
                ?>

                <div class="row header" style="margin-top: 10px;">
                    <form action="<?= base_url() ?>customers/searchcustomer" method="get">
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_name; ?></label>
                                <input type="text" name="name" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_email; ?></label>
                                <input type="text" name="email" class="form-control" />

                            </div>

                        </div>
                        <div class="col-md-3">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_mobile; ?></label>
                                <input type="text" name="mobile" class="form-control" />

                            </div>


                        </div>

                        <div class="col-md-3">
                            <div class="form-line">
                                <label>&nbsp;</label><br />
                                <button class="btn btn-primary" style="width: 100%;">&nbsp;&nbsp;<?php echo $lang_search; ?>&nbsp;&nbsp;</button>
                            </div>
                        </div>
                    </form>
                </div>

                <div class="body">
                    <div class="table-responsive">
                        <table class="table table-hover dashboard-task-infos">
                            <thead>
                                <tr>
                                    <th width="15%"><?php echo $lang_customer_name; ?></th>
                                    <th width="15%"><?php echo $lang_email; ?></th>
                                    <th width="15%"><?php echo $lang_mobile; ?></th>
                                    <!-- <th width="15%">Total Cost</th> -->
                                    <th width="10%"><?php echo $lang_action; ?></th>
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
                                            <td><?php echo $cust_fn; ?></td>
                                            <td> <?php
                                                if (!empty($cust_em)) {
                                                    echo $cust_em;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>
                                            <td> <?php
                                                if (!empty($cust_mb)) {
                                                    echo $cust_mb;
                                                } else {
                                                    echo '-';
                                                }
                                                ?>
                                            </td>

                                            <td>
                                                <a href="<?= base_url() ?>customers/edit_customer?cust_id=<?php echo $cust_id; ?>">
                                                    <i class="material-icons">mode_edit</i>
                                                </a>

                                                <a href="<?= base_url() ?>customers/customer_history?cust_id=<?php echo $cust_id; ?>">
                                                    <i class="material-icons">history</i>
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
                                    <tr class="no-records-found">
                                        <td colspan="5"><?php echo $lang_no_match_found; ?></td>
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
                <div class="row clearfix" >
                    <div class="col-md-6" style="float: left; padding-top: 10px; padding-left: 30px; padding-bottom: 15px;">
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
                    <div class="col-md-6" style="text-align: right; padding-right: 30px; padding-bottom: 15px;">
                        <?php // echo $links; ?>
                    </div>
                </div>


            </div>
            <!--</div>-->
            <!-- #END# Task Info -->
        </div>
    </div>
</section>


<?php
require_once 'includes/footer.php';
?>