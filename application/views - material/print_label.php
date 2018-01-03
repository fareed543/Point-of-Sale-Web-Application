<?php
$alert_msg = $this->session->flashdata('alert_msg');

$settingResult = $this->db->get_where('site_setting');
$settingData = $settingResult->row();

$setting_site_name = $settingData->site_name;
$setting_timezone = $settingData->timezone;
$setting_pagination = $settingData->pagination;
$setting_tax = $settingData->tax;
$setting_currency = $settingData->currency;
$setting_date = $settingData->datetime_format;
$setting_product = $settingData->display_product;
$setting_keyboard = $settingData->display_keyboard;
$setting_customer_id = $settingData->default_customer_id;

date_default_timezone_set("$setting_timezone");
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1" />

        <link href="<?= base_url() ?>assets/css/bootstrap.min.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/css/datepicker3.css" rel="stylesheet">
        <link href="<?= base_url() ?>assets/css/styles.css" rel="stylesheet">

        <link href="<?= base_url() ?>assets/css/icono.min.css" rel="stylesheet">

        <!--[if lt IE 9]>
        <script src="<?= base_url() ?>assets/js/html5shiv.js"></script>
        <script src="<?= base_url() ?>assets/js/respond.min.js"></script>
        <![endif]-->

        <script src="<?= base_url() ?>assets/js/jquery.min.js"></script>


        <title><?php echo $setting_site_name; ?></title>

        <style type="text/css">
            body{
                padding-top: 0px;
                background: #f1f4f7;
                color: #000;;
            }
            @media all {
                .page-break	{ /*display: none;*/ }
            }

            @media print {
                #bkpos_wrp{
                    display: none;
                }
                .page-break	{ display: block; page-break-before: always; }
            }
            td, th {
                padding: 0px;
            }
        </style>
    </head>

    <body>

        <div class="row" id="bkpos_wrp" style="padding-bottom: 10px; padding-top: 10px;">
            <div class="col-md-12">
                <center>
                    <a href="<?= base_url() ?>dashboard" style="text-decoration: none;">
                        <button class="btn btn-primary" style="padding: 6px 12px; border-radius: 2px;">Dashboard</button>
                    </a>
                    <h1 style="color: #00598c; margin-top: 10px;"><?php echo $setting_site_name; ?></h1>
                    <?php echo $lang_print_label_header; ?>
                </center>
            </div>
        </div><!-- /.row -->	

    <center>
        <?php
        if (count($results) > 0) {
            foreach ($results as $data) {
                $code = $data->code;

                $prod_name = '';
                $prod_price = '';
                $prod_code = '';

                $prodDtaResult = $this->db->query("SELECT * FROM products WHERE code = '$code' ");
                $prodDtaRows = $prodDtaResult->num_rows();
                if ($prodDtaRows == 1) {
                    $prodDtaData = $prodDtaResult->result();

                    $prod_name = $prodDtaData[0]->name;
                    $prod_price = $prodDtaData[0]->retail_price;
                    $prod_code = $prodDtaData[0]->code;

                    unset($prodDtaData);
                }
                unset($prodDtaResult);
                unset($prodDtaRows);

                $this->load->library('Barcode39');
                // set Barcode39 object
                $bc = new Barcode39("$code");
                // set text size
                $bc->barcode_text_size = 1;

                // display new barcode
                $bc->draw('./assets/barcode/' . $code . '.gif');
                ?>
                <div class="page-break" style="margin-top: 5px;">
                    <table border="0" style="border-collapse: collapse; margin-bottom: 20px;" width="140px" height="auto">
                        <tr>
                            <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 12px;">
                                <?php echo $prod_name; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 12px;">
                                <img src="<?= base_url() ?>assets/barcode/<?php echo $code; ?>.gif" />
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 11px;">
                                <?php echo $prod_code; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-family: Arial, Helvetica, sans-serif; text-align: center; font-size: 11px;">
                                <?php echo number_format($prod_price, 2, '.', ''); ?>
                            </td>
                        </tr>
                    </table>

                </div>
                <?php
            }
        }
        ?>
    </center>

    <div class="row" id="bkpos_wrp">
        <div class="col-md-12">
            <center><?php echo $links; ?></center>
        </div>
    </div><!-- /.row -->

</body>
</html>
