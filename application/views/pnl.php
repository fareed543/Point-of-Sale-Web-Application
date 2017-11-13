<?php
require_once 'includes/header.php';
?>

<?php
for ($i = 0; $i < 12; ++$i) {
    $months[] = date('Y-m', strtotime(date('Y-m-01') . " -$i months"));
}

$month_name_array = array();
$year_name_array = array();
for ($m = 0; $m < count($months); ++$m) {
    $year = date('Y', strtotime($months[$m]));
    $mon = date('m', strtotime($months[$m]));
    $month_name = date('M', strtotime($months[$m]));

    array_push($month_name_array, $month_name);
    array_push($year_name_array, $year);
}
?>


<script src="<?= base_url() ?>assets/js/highcharts.js"></script>
<script src="<?= base_url() ?>assets/js/exporting.js"></script>	
<script type="text/javascript">
    $(function () {
        $('#pnlcontainer').highcharts({
            title: {
                text: '<?php echo $lang_monthly_pnl_by_outlets; ?>',
                x: -20 //center
            },
            subtitle: {
                text: '',
                x: -20
            },
            xAxis: {
                categories: [
<?php
for ($mn = 0; $mn < count($month_name_array); ++$mn) {
    echo "'" . $month_name_array[$mn] . ' ' . $year_name_array[$mn] . "',";
}
?>
                ]
            },
            yAxis: {
                title: {
                    text: '<?php echo $lang_profit_amount; ?> (<?php echo $site_currency; ?>)'
                },
                plotLines: [{
                        value: 0,
                        width: 1,
                        color: '#808080'
                    }]
            },
            tooltip: {
                valueSuffix: ''
            },
            legend: {
                layout: 'vertical',
                align: 'right',
                verticalAlign: 'middle',
                borderWidth: 0
            },
            series: [
<?php
if ($user_role == '1') {
    $outletData = $this->Constant_model->getDataOneColumnSortColumn('outlets', 'status', '1', 'id', 'DESC');
} else {
    $outletData = $this->Constant_model->getDataTwoColumnSortColumn('outlets', 'id', "$user_outlet", 'status', '1', 'id', 'DESC');
}

for ($o = 0; $o < count($outletData); ++$o) {
    $outlet_id = $outletData[$o]->id;
    $outlet_name = $outletData[$o]->name;
    ?>
                    {
                        name: '<?php echo $outlet_name; ?>',
                        data: [
    <?php
    for ($m = 0; $m < count($months); ++$m) {
        $year = date('Y', strtotime($months[$m]));
        $mon = date('m', strtotime($months[$m]));

        $total_expenses_amt = 0;
        $total_monthly_amt = 0;
        $total_items_cost = 0;
        $total_tax_amt = 0;

        $number_of_day = cal_days_in_month(CAL_GREGORIAN, $mon, $year);

        for ($d = 1; $d <= $number_of_day; ++$d) {
            if (strlen($d) == 1) {
                $d = '0' . $d;
            }

            $full_date_start = $year . '-' . $mon . '-' . $d . ' 00:00:00';
            $full_date_end = $year . '-' . $mon . '-' . $d . ' 23:59:59';

            $exp_date_start = $year . '-' . $mon . '-' . $d;
            $exp_date_end = $year . '-' . $mon . '-' . $d;

            $orderResult = $this->db->query("SELECT id, grandtotal, tax FROM orders WHERE ordered_datetime >= '$full_date_start' AND ordered_datetime <= '$full_date_end' AND outlet_id = '$outlet_id' ");
            $orderData = $orderResult->result();
            for ($od = 0; $od < count($orderData); ++$od) {
                $order_id = $orderData[$od]->id;
                $total_monthly_amt += number_format($orderData[$od]->grandtotal, 2, '.', '');
                $total_tax_amt += $orderData[$od]->tax;

                $itemResult = $this->db->query("SELECT * FROM order_items WHERE order_id = '$order_id' ");
                $itemData = $itemResult->result();
                for ($it = 0; $it < count($itemData); ++$it) {
                    $each_item_cost = $itemData[$it]->cost;
                    $each_item_qty = $itemData[$it]->qty;

                    $each_rows = 0;
                    $each_rows = ($each_item_cost * $each_item_qty);

                    $total_items_cost += $each_rows;
                }
                unset($itemResult);
                unset($itemData);
            }
            unset($orderResult);
            unset($orderData);

            /*
              $expResult = $this->db->query("SELECT * FROM expenses WHERE date >= '$exp_date_start' AND date <= '$exp_date_end' AND outlet_id = '$outlet_id' AND status = '1' ");
              $expData = $expResult->result();
              for ($ep = 0; $ep < count($expData); ++$ep) {
              $total_expenses_amt += $expData[$ep]->amount;
              }
              unset($expResult);
              unset($expData);
             */
        }    // End of Number of Day Loop;

        echo($total_monthly_amt - ($total_expenses_amt + $total_items_cost + $total_tax_amt)) . ',';
    }
    ?>
                        ]

                    },
    <?php
}
?>
            ]
        });
    });
</script>



<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
    <div class="row">
        <div class="col-lg-12">
            <h1 class="page-header"><?php echo $lang_pnl; ?></h1>
        </div>
    </div><!--/.row-->

    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-default">
                <div class="panel-body">

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12">

                            <div id="pnlcontainer" style="min-width: 310px; height: 400px; margin: 0 auto"></div>

                        </div>
                    </div>

                    <div class="row" style="margin-top: 10px;">
                        <div class="col-md-12" style="font-size:15px;">
                            <b>Profit &amp; Loss</b> = Selling Price - Cost - tax
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