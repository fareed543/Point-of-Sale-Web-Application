<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Gift_card extends CI_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     *
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Giftcard_model');
        $this->load->model('Constant_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('pagination');

        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_timezone = $settingData->timezone;

        date_default_timezone_set("$setting_timezone");
    }

    public function index() {
        $this->load->view('dashboard', 'refresh');
    }

    // ****************************** View Page -- START ****************************** //
    // View Gift Card;
    public function list_gift_card() {
        $siteSettingData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $siteSetting_dateformat = $siteSettingData[0]->datetime_format;
        $siteSetting_currency = $siteSettingData[0]->currency;

        $data['dateformat'] = $siteSetting_dateformat;
        $data['currency'] = $siteSetting_currency;

        $data['lang_dashboard'] = $this->lang->line('dashboard');
        $data['lang_customers'] = $this->lang->line('customers');
        $data['lang_gift_card'] = $this->lang->line('gift_card');
        $data['lang_add_gift_card'] = $this->lang->line('add_gift_card');
        $data['lang_list_gift_card'] = $this->lang->line('list_gift_card');
        $data['lang_debit'] = $this->lang->line('debit');
        $data['lang_sales'] = $this->lang->line('sales');
        $data['lang_today_sales'] = $this->lang->line('today_sales');
        $data['lang_opened_bill'] = $this->lang->line('opened_bill');
        $data['lang_reports'] = $this->lang->line('reports');
        $data['lang_sales_report'] = $this->lang->line('sales_report');
        $data['lang_expenses'] = $this->lang->line('expenses');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_pnl'] = $this->lang->line('pnl');
        $data['lang_pnl_report'] = $this->lang->line('pnl_report');
        $data['lang_pos'] = $this->lang->line('pos');
        $data['lang_return_order'] = $this->lang->line('return_order');
        $data['lang_return_order_report'] = $this->lang->line('return_order_report');
        $data['lang_inventory'] = $this->lang->line('inventory');
        $data['lang_products'] = $this->lang->line('products');
        $data['lang_list_products'] = $this->lang->line('list_products');
        $data['lang_print_product_label'] = $this->lang->line('print_product_label');
        $data['lang_product_category'] = $this->lang->line('product_category');
        $data['lang_purchase_order'] = $this->lang->line('purchase_order');
        $data['lang_setting'] = $this->lang->line('setting');
        $data['lang_outlets'] = $this->lang->line('outlets');
        $data['lang_users'] = $this->lang->line('users');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_system_setting'] = $this->lang->line('system_setting');
        $data['lang_payment_methods'] = $this->lang->line('payment_methods');
        $data['lang_logout'] = $this->lang->line('logout');
        $data['lang_point_of_sales'] = $this->lang->line('point_of_sales');
        $data['lang_amount'] = $this->lang->line('amount');
        $data['lang_monthly_sales_outlet'] = $this->lang->line('monthly_sales_outlet');
        $data['lang_no_match_found'] = $this->lang->line('no_match_found');
        $data['lang_create_return_order'] = $this->lang->line('create_return_order');

        $data['lang_action'] = $this->lang->line('action');
        $data['lang_edit'] = $this->lang->line('edit');
        $data['lang_status'] = $this->lang->line('status');
        $data['lang_add'] = $this->lang->line('add');
        $data['lang_back'] = $this->lang->line('back');
        $data['lang_update'] = $this->lang->line('update');
        $data['lang_active'] = $this->lang->line('active');
        $data['lang_inactive'] = $this->lang->line('inactive');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_search_product'] = $this->lang->line('search_product');
        $data['lang_add_to_list'] = $this->lang->line('add_to_list');
        $data['lang_submit'] = $this->lang->line('submit');
        $data['lang_receive'] = $this->lang->line('receive');
        $data['lang_view'] = $this->lang->line('view');
        $data['lang_created'] = $this->lang->line('created');
        $data['lang_tax'] = $this->lang->line('tax');
        $data['lang_discount_amount'] = $this->lang->line('discount_amount');
        $data['lang_total'] = $this->lang->line('total');
        $data['lang_totat_payable'] = $this->lang->line('totat_payable');
        $data['lang_discount'] = $this->lang->line('discount');
        $data['lang_sale_id'] = $this->lang->line('sale_id');
        $data['lang_tax_total'] = $this->lang->line('tax_total');
        $data['lang_export_to_excel'] = $this->lang->line('export_to_excel');
        $data['lang_sub_total'] = $this->lang->line('sub_total');
        $data['lang_grand_total'] = $this->lang->line('grand_total');
        $data['lang_total_quantity'] = $this->lang->line('total_quantity');
        $data['lang_quantity'] = $this->lang->line('quantity');
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_date_time'] = $this->lang->line('date_time');

        $data['lang_gift_card_number'] = $this->lang->line('gift_card_number');
        $data['lang_generate'] = $this->lang->line('generate');
        $data['lang_value'] = $this->lang->line('value');
        $data['lang_expiry_date'] = $this->lang->line('expiry_date');
        $data['lang_please_fillup'] = $this->lang->line('please_fillup');
        $data['lang_gift_card'] = $this->lang->line('gift_card');
        $data['lang_used'] = $this->lang->line('used');
        $data['lang_not_in_use'] = $this->lang->line('not_in_use');

        $this->load->view('gift_card', $data);
    }

    // Create Gift Card;
    public function add_gift_card() {
        $siteSettingData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $siteSetting_dateformat = $siteSettingData[0]->datetime_format;
        $siteSetting_currency = $siteSettingData[0]->currency;

        if ($siteSetting_dateformat == 'Y-m-d') {
            $dateformat = 'yyyy-mm-dd';
        }
        if ($siteSetting_dateformat == 'Y.m.d') {
            $dateformat = 'yyyy.mm.dd';
        }
        if ($siteSetting_dateformat == 'Y/m/d') {
            $dateformat = 'yyyy/mm/dd';
        }
        if ($siteSetting_dateformat == 'm-d-Y') {
            $dateformat = 'mm-dd-yyyy';
        }
        if ($siteSetting_dateformat == 'm.d.Y') {
            $dateformat = 'mm.dd.yyyy';
        }
        if ($siteSetting_dateformat == 'm/d/Y') {
            $dateformat = 'mm/dd/yyyy';
        }
        if ($siteSetting_dateformat == 'd-m-Y') {
            $dateformat = 'dd-mm-yyyy';
        }
        if ($siteSetting_dateformat == 'd.m.Y') {
            $dateformat = 'dd.mm.yyyy';
        }
        if ($siteSetting_dateformat == 'd/m/Y') {
            $dateformat = 'dd/mm/yyyy';
        }

        $data['site_currency'] = $siteSetting_currency;
        $data['dateformat'] = $dateformat;

        $data['lang_dashboard'] = $this->lang->line('dashboard');
        $data['lang_customers'] = $this->lang->line('customers');
        $data['lang_gift_card'] = $this->lang->line('gift_card');
        $data['lang_add_gift_card'] = $this->lang->line('add_gift_card');
        $data['lang_list_gift_card'] = $this->lang->line('list_gift_card');
        $data['lang_debit'] = $this->lang->line('debit');
        $data['lang_sales'] = $this->lang->line('sales');
        $data['lang_today_sales'] = $this->lang->line('today_sales');
        $data['lang_opened_bill'] = $this->lang->line('opened_bill');
        $data['lang_reports'] = $this->lang->line('reports');
        $data['lang_sales_report'] = $this->lang->line('sales_report');
        $data['lang_expenses'] = $this->lang->line('expenses');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_pnl'] = $this->lang->line('pnl');
        $data['lang_pnl_report'] = $this->lang->line('pnl_report');
        $data['lang_pos'] = $this->lang->line('pos');
        $data['lang_return_order'] = $this->lang->line('return_order');
        $data['lang_return_order_report'] = $this->lang->line('return_order_report');
        $data['lang_inventory'] = $this->lang->line('inventory');
        $data['lang_products'] = $this->lang->line('products');
        $data['lang_list_products'] = $this->lang->line('list_products');
        $data['lang_print_product_label'] = $this->lang->line('print_product_label');
        $data['lang_product_category'] = $this->lang->line('product_category');
        $data['lang_purchase_order'] = $this->lang->line('purchase_order');
        $data['lang_setting'] = $this->lang->line('setting');
        $data['lang_outlets'] = $this->lang->line('outlets');
        $data['lang_users'] = $this->lang->line('users');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_system_setting'] = $this->lang->line('system_setting');
        $data['lang_payment_methods'] = $this->lang->line('payment_methods');
        $data['lang_logout'] = $this->lang->line('logout');
        $data['lang_point_of_sales'] = $this->lang->line('point_of_sales');
        $data['lang_amount'] = $this->lang->line('amount');
        $data['lang_monthly_sales_outlet'] = $this->lang->line('monthly_sales_outlet');
        $data['lang_no_match_found'] = $this->lang->line('no_match_found');
        $data['lang_create_return_order'] = $this->lang->line('create_return_order');

        $data['lang_action'] = $this->lang->line('action');
        $data['lang_edit'] = $this->lang->line('edit');
        $data['lang_status'] = $this->lang->line('status');
        $data['lang_add'] = $this->lang->line('add');
        $data['lang_back'] = $this->lang->line('back');
        $data['lang_update'] = $this->lang->line('update');
        $data['lang_active'] = $this->lang->line('active');
        $data['lang_inactive'] = $this->lang->line('inactive');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_search_product'] = $this->lang->line('search_product');
        $data['lang_add_to_list'] = $this->lang->line('add_to_list');
        $data['lang_submit'] = $this->lang->line('submit');
        $data['lang_receive'] = $this->lang->line('receive');
        $data['lang_view'] = $this->lang->line('view');
        $data['lang_created'] = $this->lang->line('created');
        $data['lang_tax'] = $this->lang->line('tax');
        $data['lang_discount_amount'] = $this->lang->line('discount_amount');
        $data['lang_total'] = $this->lang->line('total');
        $data['lang_totat_payable'] = $this->lang->line('totat_payable');
        $data['lang_discount'] = $this->lang->line('discount');
        $data['lang_sale_id'] = $this->lang->line('sale_id');
        $data['lang_tax_total'] = $this->lang->line('tax_total');
        $data['lang_export_to_excel'] = $this->lang->line('export_to_excel');
        $data['lang_sub_total'] = $this->lang->line('sub_total');
        $data['lang_grand_total'] = $this->lang->line('grand_total');
        $data['lang_total_quantity'] = $this->lang->line('total_quantity');
        $data['lang_quantity'] = $this->lang->line('quantity');
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_date_time'] = $this->lang->line('date_time');

        $data['lang_gift_card_number'] = $this->lang->line('gift_card_number');
        $data['lang_generate'] = $this->lang->line('generate');
        $data['lang_value'] = $this->lang->line('value');
        $data['lang_expiry_date'] = $this->lang->line('expiry_date');
        $data['lang_please_fillup'] = $this->lang->line('please_fillup');

        $this->load->view('add_gift_card', $data);
    }

    // ****************************** View Page -- END ****************************** //
    // ****************************** Action To Database -- START ****************************** //
    // Delete Gift Card;
    public function deletegiftcard() {
        $id = $this->input->get('id');

        $giftData = $this->Constant_model->getDataOneColumn('gift_card', 'id', $id);
        if (count($giftData) == 1) {
            $gift_numb = $giftData[0]->card_number;

            if ($this->Constant_model->deleteData('gift_card', $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Delete Gift Card', "Successfully Deleted Gift Card Number : $gift_numb"));
                redirect(base_url() . 'gift_card/list_gift_card');
            }
        } else {
            $this->session->set_flashdata('alert_msg', array('failure', 'Delete Gift Card', 'Error on deleting Gift Card!'));
            redirect(base_url() . 'gift_card/list_gift_card');
        }
    }

    // Add Generate;
    public function insertGiftCard() {
        $card_numb = $this->input->post('gift_card_numb');
        $value = $this->input->post('value');
        $expiry_date = $this->input->post('expiry_date');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        $siteSettingData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $site_dateformat = $siteSettingData[0]->datetime_format;

        if (empty($card_numb)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Gift Card', 'Please enter Gift Card!'));
            redirect(base_url() . 'gift_card/add_gift_card');
        } elseif (empty($value)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Gift Card', 'Please enter Gift Card Value!'));
            redirect(base_url() . 'gift_card/add_gift_card');
        } elseif (empty($expiry_date)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Gift Card', 'Please enter Gift Card Expiry!'));
            redirect(base_url() . 'gift_card/add_gift_card');
        } else {
            $url_start = '';

            if ($site_dateformat == 'd/m/Y') {
                $startArray = explode('/', $expiry_date);

                $start_day = $startArray[0];
                $start_mon = $startArray[1];
                $start_yea = $startArray[2];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }
            if ($site_dateformat == 'd.m.Y') {
                $startArray = explode('.', $expiry_date);

                $start_day = $startArray[0];
                $start_mon = $startArray[1];
                $start_yea = $startArray[2];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }
            if ($site_dateformat == 'd-m-Y') {
                $startArray = explode('-', $expiry_date);

                $start_day = $startArray[0];
                $start_mon = $startArray[1];
                $start_yea = $startArray[2];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }

            if ($site_dateformat == 'm/d/Y') {
                $startArray = explode('/', $expiry_date);

                $start_day = $startArray[1];
                $start_mon = $startArray[0];
                $start_yea = $startArray[2];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }
            if ($site_dateformat == 'm.d.Y') {
                $startArray = explode('.', $expiry_date);

                $start_day = $startArray[1];
                $start_mon = $startArray[0];
                $start_yea = $startArray[2];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }
            if ($site_dateformat == 'm-d-Y') {
                $startArray = explode('-', $expiry_date);

                $start_day = $startArray[1];
                $start_mon = $startArray[0];
                $start_yea = $startArray[2];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }

            if ($site_dateformat == 'Y.m.d') {
                $startArray = explode('.', $expiry_date);

                $start_day = $startArray[2];
                $start_mon = $startArray[1];
                $start_yea = $startArray[0];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }
            if ($site_dateformat == 'Y/m/d') {
                $startArray = explode('/', $expiry_date);

                $start_day = $startArray[2];
                $start_mon = $startArray[1];
                $start_yea = $startArray[0];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }
            if ($site_dateformat == 'Y-m-d') {
                $startArray = explode('-', $expiry_date);

                $start_day = $startArray[2];
                $start_mon = $startArray[1];
                $start_yea = $startArray[0];

                $url_start = $start_yea . '-' . $start_mon . '-' . $start_day;
            }

            $ckGiftResult = $this->db->query("SELECT * FROM gift_card WHERE card_number = '$card_numb' ");
            $ckGiftRows = $ckGiftResult->num_rows();
            if ($ckGiftRows == 0) {
                $ins_data = array(
                    'card_number' => $card_numb,
                    'value' => $value,
                    'expiry_date' => $url_start,
                    'created_user_id' => $us_id,
                    'created_datetime' => $tm,
                    'status' => '0',
                );
                if ($this->Constant_model->insertData('gift_card', $ins_data)) {
                    $this->session->set_flashdata('alert_msg', array('success', 'Add Gift Card', "Successfully Added Gift Card Number : $card_numb"));
                    redirect(base_url() . 'gift_card/list_gift_card');
                }
            } else {
                $this->session->set_flashdata('alert_msg', array('failure', 'Add Gift Card', "Gift Card Number $card_numb is already existing! Please try another Card Number!"));
                redirect(base_url() . 'gift_card/add_gift_card');
            }
        }
    }

    // ****************************** Action To Database -- END ****************************** //
    // ****************************** Export Excel -- START ****************************** //
    // ****************************** Export Excel -- END ****************************** //
}
