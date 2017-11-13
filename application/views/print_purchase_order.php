<?php
$settingResult = $this->db->get_where('site_setting');
$settingData = $settingResult->row();
$setting_dateformat = $settingData->datetime_format;

$poDtaData = $this->Constant_model->getDataOneColumn('purchase_order', 'id', $id);

$po_numb = $poDtaData[0]->po_number;
$po_supplier_id = $poDtaData[0]->supplier_id;
$po_outlet_id = $poDtaData[0]->outlet_id;
$po_date = date("$setting_dateformat", strtotime($poDtaData[0]->po_date));
$po_attachment = $poDtaData[0]->attachment_file;
$po_note = $poDtaData[0]->note;
$po_status = $poDtaData[0]->status;

//$supplierNameData 		= $this->Constant_model->getDataOneColumn('suppliers', 'id', $po_supplier_id);
$supplier_name = $poDtaData[0]->supplier_name;
$supplier_address = $poDtaData[0]->supplier_address;
$supplier_email = $poDtaData[0]->supplier_email;
$supplier_tel = $poDtaData[0]->supplier_tel;
$supplier_fax = $poDtaData[0]->supplier_fax;

//$outletNameData 		= $this->Constant_model->getDataOneColumn('outlets', 'id', $po_outlet_id);
$outlet_name = $poDtaData[0]->outlet_name;
$outlet_address = $poDtaData[0]->outlet_address;
$outlet_contact = $poDtaData[0]->outlet_contact;
?>
<!doctype html>
<html>
    <head>
        <meta charset="utf-8" />
        <title>Print Purchase Order</title>
        <script src="<?= base_url() ?>assets/js/jquery-1.7.2.min.js"></script>

        <style type="text/css" media="all">
            body { 
                max-width: 950px; 
                margin:0 auto; 
                text-align:center; 
                color:#000; 
                font-family: Arial, Helvetica, sans-serif; 
                font-size:12px; 
            }
            #wrapper { 
                min-width: 950px; 
                margin: 0px auto; 
            }
            #wrapper img { 
                max-width: 300px; 
                width: auto; 
            }

            h2, h3, p { 
                margin: 5px 0;
            }
            .left { 
                width:100%; 
                float:left; 
                text-align:left; 
                margin-bottom: 3px;
                margin-top: 3px;
            }
            .right { 
                width:40%; 
                float:right; 
                text-align:right; 
                margin-bottom: 3px; 
            }
            .table, .totals { 
                width: 100%; 
                margin:10px 0; 
            }
            .table th { 
                border-top: 1px solid #000; 
                border-bottom: 1px solid #000; 
                padding-top: 4px;
                padding-bottom: 4px;
            }
            .table td { 
                padding:0; 
            }
            .totals td { 
                width: 24%; 
                padding:0; 
            }
            .table td:nth-child(2) { 
                overflow:hidden; 
            }

            @media print {
                body { text-transform: uppercase; }
                #buttons { display: none; }
                #wrapper { width: 100%; margin: 0; font-size:9px; }
                #wrapper img { max-width:300px; width: 80%; }
                #bkpos_wrp{
                    display: none;
                }
            }
        </style>
    </head>

    <body>
        <div id="wrapper">

            <table border="0" style="border-collapse: collapse; font-family: arial; font-size: 11px;" width="100%" height="auto">
                <tr>
                    <td width="100%" height="auto" align="center">
                        <h1 style="font-size: 40px; color: #005b8a;"><?php echo $lang_purchase_order; ?></h1>
                    </td>
                </tr>
            </table>
            <table border="0" style="border-collapse: collapse; font-family: arial; font-size: 13px; margin-top: 10px; border-bottom: 1px solid #656563; padding-bottom: 10px;" width="100%" height="auto">
                <tr>
                    <td width="50%" height="auto" valign="top">
                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                            <tr>
                                <td width="30%" style="font-size: 15px;" align="left"><?php echo $lang_suppliers; ?></td>
                                <td width="70%" style="font-size: 15px;" align="left">: <?php echo $supplier_name; ?></td>
                            </tr>
                            <tr>
                                <td width="30%" height="20px" align="left"><?php echo $lang_address; ?></td>
                                <td width="70%" align="left">: <?php echo $supplier_address; ?></td>
                            </tr>
                            <tr>
                                <td width="30%" height="20px" align="left"><?php echo $lang_email; ?></td>
                                <td width="70%" align="left">: <?php echo $supplier_email; ?></td>
                            </tr>
                            <tr>
                                <td width="30%" height="20px" align="left"><?php echo $lang_telephone; ?></td>
                                <td width="70%" align="left">: <?php echo $supplier_tel; ?></td>
                            </tr>
                            <tr>
                                <td width="30%" height="20px" align="left"><?php echo $lang_fax; ?></td>
                                <td width="70%" align="left">: <?php echo $supplier_fax; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" height="auto" align="right" valign="top">
                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                            <tr>
                                <td width="60%" height="20px" align="right" style="font-size: 15px; color: #005b8a;"><?php echo $lang_purchase_order_number; ?>&nbsp;&nbsp;</td>
                                <td width="40%" style="font-size: 15px; color: #005b8a;">: &nbsp;<?php echo $po_numb; ?></td>
                            </tr>
                            <tr>
                                <td width="60%" height="20px" align="right" style="font-size: 15px; color: #005b8a;"><?php echo $lang_created_date; ?>&nbsp;&nbsp;</td>
                                <td width="40%" style="font-size: 15px; color: #005b8a;">: &nbsp;<?php echo $po_date; ?></td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
            <table border="0" style="border-collapse: collapse; font-family: arial; font-size: 11px; margin-top: 0px;" width="100%" height="auto">
                <tr>
                    <td width="50%" height="auto" align="left">
                        <h1 style="font-size: 15px; color: #005b8a;"><?php echo $lang_ship_to; ?></h1>
                    </td>
                </tr>
            </table>
            <table border="0" style="border-collapse: collapse; font-family: arial; font-size: 13px; margin-top: 0px;" width="100%" height="auto">
                <tr>
                    <td width="50%" height="auto" valign="top">
                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                            <tr>
                                <td width="40%" height="20px" align="left"><?php echo $lang_outlets; ?></td>
                                <td width="60%" align="left">: <?php echo $outlet_name; ?></td>
                            </tr>
                            <tr>
                                <td width="40%" height="20px" align="left" valign="top"><?php echo $lang_address; ?></td>
                                <td width="60%" align="left">: <?php echo $outlet_address; ?></td>
                            </tr>
                            <tr>
                                <td width="40%" height="20px" align="left"><?php echo $lang_telephone; ?></td>
                                <td width="60%" align="left">: <?php echo $outlet_contact; ?></td>
                            </tr>
                        </table>
                    </td>
                    <td width="50%" height="auto" align="right" valign="top">&nbsp;</td>
                </tr>
            </table>
            <table border="0" style="border-collapse: collapse; font-family: arial; font-size: 13px; margin-top: 10px;" width="100%" height="auto">
                <tr>
                    <td width="40%" height="25px" style="padding-left: 10px; font-weight: bold; border-bottom: 1px solid #656563;" align="left">
                        <?php echo $lang_product_name; ?>
                    </td>
                    <td width="40%" height="25px" style="font-weight: bold; border-bottom: 1px solid #656563;" align="left">
                        <?php echo $lang_product_code; ?>
                    </td>
                    <td width="20%" height="25px" style="font-weight: bold; border-bottom: 1px solid #656563;" align="left">
                        <?php echo $lang_ordered_quantity; ?>
                    </td>
                </tr>
                <?php
                $poItemData = $this->Constant_model->getDataOneColumnSortColumn('purchase_order_items', 'po_id', $id, 'id', 'ASC');
                for ($pi = 0; $pi < count($poItemData); ++$pi) {
                    $po_item_id = $poItemData[$pi]->id;
                    $po_item_pcode = $poItemData[$pi]->product_code;
                    $po_item_qty = $poItemData[$pi]->ordered_qty;

                    $poNameResult = $this->db->query("SELECT * FROM products WHERE code = '$po_item_pcode' ");
                    $poNameData = $poNameResult->result();

                    $po_name = $poNameData[0]->name;
                    ?>
                    <tr>
                        <td height="25px" style="padding-left: 10px; border-bottom: 1px solid #656563;" align="left"><?php echo $po_item_pcode; ?></td>
                        <td style="border-bottom: 1px solid #656563;" align="left"><?php echo $po_name; ?></td>
                        <td style="border-bottom: 1px solid #656563;" align="left"><?php echo $po_item_qty; ?></td>
                    </tr>
                    <?php
                }
                ?>
            </table>

            <table border="0" style="border-collapse: collapse; font-family: arial; font-size: 13px; margin-top: 30px;" width="100%" height="auto">
                <tr>
                    <td width="50%" height="auto" align="left" valign="top">

                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                            <tr>
                                <td width="20%" valign="top" align="left"><b><?php echo $lang_note; ?></b> :</td>
                                <td width="80%" align="left"><?php echo nl2br($po_note); ?></td>
                            </tr>
                        </table>

                    </td>
                    <td width="50%" height="auto" align="right" valign="top">

                        <table border="0" style="border-collapse: collapse;" width="100%" height="auto">
                            <tr>
                                <td width="40%" align="right"><b><?php echo $lang_authorized_by; ?></b></td>
                                <td width="60%" style="border-bottom: 1px solid #656563"></td>
                            </tr>
                            <tr>
                                <td colspan="2" height="30px"></td>
                            </tr>
                            <tr>
                                <td width="40%" align="right"><b><?php echo $lang_signature; ?></b></td>
                                <td width="60%" style="border-bottom: 1px solid #656563"></td>
                            </tr>
                        </table>

                    </td>
                </tr>
            </table>
        </div>

        <script src="<?= base_url() ?>assets/js/jquery-1.10.2.js"></script>
        <script type="text/javascript">
            $(window).load(function () {
                window.print();
            });
        </script>
    </body>
</html>
