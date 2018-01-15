<?php
require_once 'includes/header.php';
?>

<link rel="stylesheet" href="<?= base_url() ?>assets/js/jquery-ui.css">
<script src="<?= base_url() ?>assets/js/jquery-1.12.4.js"></script>
<script src="<?= base_url() ?>assets/js/jquery-ui.js"></script>

<script>
    $(function () {
        $("#startDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });

        $("#endDate").datepicker({
            format: "<?php echo $dateformat; ?>",
            autoclose: true
        });
    });
</script>

<!-- Add jQuery library -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/jquery-latest.min.js"></script>

<!-- Add mousewheel plugin (this is optional) -->
<script type="text/javascript" src="<?= base_url() ?>assets/js/fancybox/lib/jquery.mousewheel-3.0.6.pack.js"></script>

<!-- Add fancyBox -->
<link rel="stylesheet" href="<?= base_url() ?>assets/js/fancybox/source/jquery.fancybox.css?v=2.1.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?= base_url() ?>assets/js/fancybox/source/jquery.fancybox.pack.js?v=2.1.5"></script>

<!-- Optionally add helpers - button, thumbnail and/or media -->
<link rel="stylesheet" href="<?= base_url() ?>assets/js/fancybox/source/helpers/jquery.fancybox-buttons.css?v=1.0.5" type="text/css" media="screen" />
<script type="text/javascript" src="<?= base_url() ?>assets/js/fancybox/source/helpers/jquery.fancybox-buttons.js?v=1.0.5"></script>
<script type="text/javascript" src="<?= base_url() ?>assets/js/fancybox/source/helpers/jquery.fancybox-media.js?v=1.0.6"></script>

<link rel="stylesheet" href="<?= base_url() ?>assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.css?v=1.0.7" type="text/css" media="screen" />
<script type="text/javascript" src="<?= base_url() ?>assets/js/fancybox/source/helpers/jquery.fancybox-thumbs.js?v=1.0.7"></script>



<?php
$url_name = '';
$url_start = '';
$url_end = '';

if (isset($_GET['report'])) {
    $url_name = $_GET['search_name'];
    $url_start = $_GET['start_date'];
    $url_end = $_GET['end_date'];
}
?>

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
                        <h3><?php echo $lang_debit; ?></h3>
                        <ul class="header-dropdown m-r--5">

                            <a href="<?= base_url() ?>debit/view" style="text-decoration: none;">
                                <button type="button" info="" class="btn btn-success" style="background-color: #5cb85c; border-color: #4cae4c;">
                                    <?php echo $lang_back; ?>
                                </button>
                            </a>
                        </ul>
                    </div>
                    <?php
                }
                ?>

                <div class="row header" style="margin-top: 10px;">
                    <form action="<?= base_url() ?>debit/searchDebit" method="get">
                        <div class="col-md-2"></div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_customer_name; ?></label>
                                <input type="text" name="search_name" class="form-control" />

                            </div>
                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_date_from; ?></label>
                                <input type="text" name="start_date" class="form-control" />

                            </div>

                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_date_to; ?></label>
                                <input type="text" name="end_date" class="form-control" />

                            </div>


                        </div>
                        <div class="col-md-2">
                            <div class="form-line">
                                <label class="form-label"><?php echo $lang_date_to; ?></label>
                                <input type="text" name="end_date" class="form-control" />

                            </div>


                        </div>

                        <div class="col-md-2">
                            <div class="form-line">
                                <input type="hidden" name="report" value="1" />
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
                                    <th width="16%"><?php echo $lang_sale_id; ?></th>
                                    <th width="16%"><?php echo $lang_date; ?></th>
                                    <th width="16%"><?php echo $lang_outlets; ?></th>
                                    <th width="16%"><?php echo $lang_customer_name; ?></th>
                                    <th width="16%"><?php echo $lang_grand_total; ?></th>

                                    <th width="25%"><?php echo $lang_unpaid_amount; ?></th>
                                    <th width="7%"><?php echo $lang_action; ?></th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                $name_sort = '';
                                $start_date_sort = '';
                                $end_date_sort = '';
                                $order_result_count = 0;

                                if (!empty($url_name)) {
                                    $name_sort = " AND customer_name LIKE '%$url_name%' ";
                                    $orderResult = $this->db->query("SELECT * FROM orders WHERE vt_status = '0' $name_sort ORDER BY id DESC ");
                                    $orderData = $orderResult->result();

                                    $order_result_count = count($orderData);
                                }

                                if (!empty($url_start) && !empty($url_end)) {
                                    if ($display_dateformat == 'd/m/Y') {
                                        $startArray = explode('/', $url_start);
                                        $endArray = explode('/', $url_end);

                                        $start_day = $startArray[0];
                                        $start_mon = $startArray[1];
                                        $start_yea = $startArray[2];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[0];
                                        $end_mon = $endArray[1];
                                        $end_yea = $endArray[2];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }
                                    if ($display_dateformat == 'd.m.Y') {
                                        $startArray = explode('.', $url_start);
                                        $endArray = explode('.', $url_end);

                                        $start_day = $startArray[0];
                                        $start_mon = $startArray[1];
                                        $start_yea = $startArray[2];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[0];
                                        $end_mon = $endArray[1];
                                        $end_yea = $endArray[2];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }
                                    if ($display_dateformat == 'd-m-Y') {
                                        $startArray = explode('-', $url_start);
                                        $endArray = explode('-', $url_end);

                                        $start_day = $startArray[0];
                                        $start_mon = $startArray[1];
                                        $start_yea = $startArray[2];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[0];
                                        $end_mon = $endArray[1];
                                        $end_yea = $endArray[2];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }

                                    if ($display_dateformat == 'm/d/Y') {
                                        $startArray = explode('/', $url_start);
                                        $endArray = explode('/', $url_end);

                                        $start_day = $startArray[1];
                                        $start_mon = $startArray[0];
                                        $start_yea = $startArray[2];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[1];
                                        $end_mon = $endArray[0];
                                        $end_yea = $endArray[2];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }
                                    if ($display_dateformat == 'm.d.Y') {
                                        $startArray = explode('.', $url_start);
                                        $endArray = explode('.', $url_end);

                                        $start_day = $startArray[1];
                                        $start_mon = $startArray[0];
                                        $start_yea = $startArray[2];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[1];
                                        $end_mon = $endArray[0];
                                        $end_yea = $endArray[2];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }
                                    if ($display_dateformat == 'm-d-Y') {
                                        $startArray = explode('-', $url_start);
                                        $endArray = explode('-', $url_end);

                                        $start_day = $startArray[1];
                                        $start_mon = $startArray[0];
                                        $start_yea = $startArray[2];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[1];
                                        $end_mon = $endArray[0];
                                        $end_yea = $endArray[2];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }

                                    if ($display_dateformat == 'Y.m.d') {
                                        $startArray = explode('.', $url_start);
                                        $endArray = explode('.', $url_end);

                                        $start_day = $startArray[2];
                                        $start_mon = $startArray[1];
                                        $start_yea = $startArray[0];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[2];
                                        $end_mon = $endArray[1];
                                        $end_yea = $endArray[0];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }
                                    if ($display_dateformat == 'Y/m/d') {
                                        $startArray = explode('/', $url_start);
                                        $endArray = explode('/', $url_end);

                                        $start_day = $startArray[2];
                                        $start_mon = $startArray[1];
                                        $start_yea = $startArray[0];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[2];
                                        $end_mon = $endArray[1];
                                        $end_yea = $endArray[0];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }
                                    if ($display_dateformat == 'Y-m-d') {
                                        $startArray = explode('-', $url_start);
                                        $endArray = explode('-', $url_end);

                                        $start_day = $startArray[2];
                                        $start_mon = $startArray[1];
                                        $start_yea = $startArray[0];

                                        $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;

                                        $end_day = $endArray[2];
                                        $end_mon = $endArray[1];
                                        $end_yea = $endArray[0];

                                        $url_end = $end_yea . '-' . $end_mon . '-' . $end_day;
                                    }

                                    $url_start = date('Y-m-d', strtotime($url_start));
                                    $url_end = date('Y-m-d', strtotime($url_end));

                                    $start_date = $url_start . ' 00:00:00';
                                    $end_date = $url_end . ' 23:59:59';

                                    $orderResult = $this->db->query("SELECT * FROM orders WHERE vt_status = '0' $name_sort AND created_datetime >= '$start_date' AND created_datetime <= '$end_date' ORDER BY id DESC ");
                                    $orderData = $orderResult->result();

                                    $order_result_count = count($orderData);
                                }

                                if ($order_result_count > 0) {
                                    foreach ($orderData as $data) {
                                        $id = $data->id;
                                        $cust_name = $data->customer_name;
                                        $order_date = date("$display_dateformat", strtotime($data->ordered_datetime));
                                        $outlet_name = $data->outlet_name;
                                        $grandTotal = $data->grandtotal;
                                        $paid_amt = $data->paid_amt;

                                        $unpaid_amt = 0;
                                        $unpaid_amt = $paid_amt - $grandTotal;
                                        ?>
                                        <tr>
                                            <td><?php echo $id; ?></td>
                                            <td><?php echo $order_date; ?></td>
                                            <td><?php echo $outlet_name; ?></td>
                                            <td><?php echo $cust_name; ?></td>
                                            <td><?php echo number_format($grandTotal, 2); ?></td>

                                            <td><?php echo number_format($unpaid_amt, 2); ?></td>


                                            <td>
                                                <a href="<?= base_url() ?>debit/make_payment?id=<?php echo $id; ?>">
                                                    <i class="material-icons">payment</i>
                                                </a>

                                            </td>
                                        </tr>
                                        <?php
                                    }
                                } else {
                                    ?>
                                    <tr class="no-records-found">
                                        <td colspan="5"><?php echo $lang_no_match_found; ?></td>
                                    </tr>
                                    <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
                </div>



            </div>
            <!--</div>-->
            <!-- #END# Task Info -->
        </div>
    </div>
</section>
<!-- Row // END -->

<br /><br /><br />

</div><!-- Right Colmn // END -->



<?php
require_once 'includes/footer.php';
?>