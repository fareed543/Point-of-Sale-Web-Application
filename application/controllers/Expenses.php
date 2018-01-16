<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Expenses extends CI_Controller {

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
        $this->load->model('Expenses_model');
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
    // View Product Category;
    public function view() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;
        $setting_dateformat = $paginationData[0]->datetime_format;
        $setting_currency = $paginationData[0]->currency;

        if ($setting_dateformat == 'Y-m-d') {
            $dateformat = 'yyyy-mm-dd';
        }
        if ($setting_dateformat == 'Y.m.d') {
            $dateformat = 'yyyy.mm.dd';
        }
        if ($setting_dateformat == 'Y/m/d') {
            $dateformat = 'yyyy/mm/dd';
        }
        if ($setting_dateformat == 'm-d-Y') {
            $dateformat = 'mm-dd-yyyy';
        }
        if ($setting_dateformat == 'm.d.Y') {
            $dateformat = 'mm.dd.yyyy';
        }
        if ($setting_dateformat == 'm/d/Y') {
            $dateformat = 'mm/dd/yyyy';
        }
        if ($setting_dateformat == 'd-m-Y') {
            $dateformat = 'dd-mm-yyyy';
        }
        if ($setting_dateformat == 'd.m.Y') {
            $dateformat = 'dd.mm.yyyy';
        }
        if ($setting_dateformat == 'd/m/Y') {
            $dateformat = 'dd/mm/yyyy';
        }

        //$paginationData 			= $this->Constant_model->getDataOneColumn("site_setting", "id", "1");
        //$pagination_limit 			= $paginationData[0]->pagination;
        //$siteSetting_dateformat 	= $paginationData[0]->datetime_format;
        //$siteSetting_currency 		= $paginationData[0]->currency;

        $config = array();
        $config['base_url'] = base_url() . 'expenses/view/';

        $config['display_pages'] = true;
        $config['first_link'] = 'First';

        $config['total_rows'] = $this->Expenses_model->record_expenses_count();
        $config['per_page'] = $pagination_limit;
        $config['uri_segment'] = 3;

        $config['full_tag_open'] = "<ul class='pagination pagination-right margin-none'>";
        $config['full_tag_close'] = '</ul>';
        $config['num_tag_open'] = '<li>';
        $config['num_tag_close'] = '</li>';
        $config['cur_tag_open'] = "<li class='disabled'><li class='active'><a href='#'>";
        $config['cur_tag_close'] = "<span class='sr-only'></span></a></li>";
        $config['next_tag_open'] = '<li>';
        $config['next_tagl_close'] = '</li>';
        $config['prev_tag_open'] = '<li>';
        $config['prev_tagl_close'] = '</li>';
        $config['first_tag_open'] = '<li>';
        $config['first_tagl_close'] = '</li>';
        $config['last_tag_open'] = '<li>';
        $config['last_tagl_close'] = '</li>';

        $this->pagination->initialize($config);

        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['results'] = $this->Expenses_model->fetch_expenses_data($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        if ($page == 0) {
            $have_count = $this->Expenses_model->record_expenses_count();
            $sh_text = 'Showing 1 to ' . count($data['results']) . ' of ' . $this->Expenses_model->record_expenses_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Expenses_model->record_expenses_count() . ' entries';
        }

        $data['site_currency'] = $setting_currency;
        $data['dateformat'] = $dateformat;
        $data['setting_dateformat'] = $setting_dateformat;
        $data['displayshowingentries'] = $sh_text;

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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_add_new_expenses'] = $this->lang->line('add_new_expenses');
        $data['lang_expenses_delete_confirm'] = $this->lang->line('expenses_delete_confirm');

        $this->load->view('expenses', $data);
    }

    // Search Expenses;
    public function searchExpenses() {
        $expenses_numb = $this->input->get('expenses_numb');
        $search_category = $this->input->get('search_category');
        $outlet = $this->input->get('outlet');
        $start_date = $this->input->get('start_date');
        $end_date = $this->input->get('end_date');

        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;
        $setting_dateformat = $paginationData[0]->datetime_format;
        $setting_currency = $paginationData[0]->currency;

        if ($setting_dateformat == 'Y-m-d') {
            $dateformat = 'yyyy-mm-dd';
        }
        if ($setting_dateformat == 'Y.m.d') {
            $dateformat = 'yyyy.mm.dd';
        }
        if ($setting_dateformat == 'Y/m/d') {
            $dateformat = 'yyyy/mm/dd';
        }
        if ($setting_dateformat == 'm-d-Y') {
            $dateformat = 'mm-dd-yyyy';
        }
        if ($setting_dateformat == 'm.d.Y') {
            $dateformat = 'mm.dd.yyyy';
        }
        if ($setting_dateformat == 'm/d/Y') {
            $dateformat = 'mm/dd/yyyy';
        }
        if ($setting_dateformat == 'd-m-Y') {
            $dateformat = 'dd-mm-yyyy';
        }
        if ($setting_dateformat == 'd.m.Y') {
            $dateformat = 'dd.mm.yyyy';
        }
        if ($setting_dateformat == 'd/m/Y') {
            $dateformat = 'dd/mm/yyyy';
        }

        $data['dateformat'] = $dateformat;
        $data['setting_dateformat'] = $setting_dateformat;
        $data['site_currency'] = $setting_currency;

        $data['search_expenses_numb'] = $expenses_numb;
        $data['search_category'] = $search_category;
        $data['search_outlet'] = $outlet;
        $data['search_start_date'] = $start_date;
        $data['search_end_date'] = $end_date;

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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_add_new_expenses'] = $this->lang->line('add_new_expenses');
        $data['lang_expenses_delete_confirm'] = $this->lang->line('expenses_delete_confirm');
        $data['lang_search_expenses'] = $this->lang->line('search_expenses');

        $this->load->view('search_expenses', $data);
    }

    // View Add New Expenses;
    public function addNewExpenses() {
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

        $data['site_dateformat'] = $siteSetting_dateformat;
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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_expenses_category_name'] = $this->lang->line('expenses_category_name');
        $data['lang_add_expenses_category'] = $this->lang->line('add_expenses_category');
        $data['lang_edit_expenses_category'] = $this->lang->line('edit_expenses_category');
        $data['lang_add_new_expenses'] = $this->lang->line('add_new_expenses');
        $data['lang_reason'] = $this->lang->line('reason');
        $data['lang_file'] = $this->lang->line('file');
        $data['lang_less_than'] = $this->lang->line('less_than');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_browse'] = $this->lang->line('browse');
        $data['lang_choose_expenses_category'] = $this->lang->line('choose_expenses_category');

        $this->load->view('add_expenses', $data);
    }

    // Edit Expenses;
    public function editExpenses() {
        $id = $this->input->get('id');

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

        $data['site_dateformat'] = $siteSetting_dateformat;
        $data['site_currency'] = $siteSetting_currency;
        $data['dateformat'] = $dateformat;
        $data['id'] = $id;

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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_add_new_expenses'] = $this->lang->line('add_new_expenses');
        $data['lang_expenses_delete_confirm'] = $this->lang->line('expenses_delete_confirm');
        $data['lang_edit_expenses'] = $this->lang->line('edit_expenses');
        $data['lang_reason'] = $this->lang->line('reason');
        $data['lang_replace'] = $this->lang->line('replace');
        $data['lang_download_file'] = $this->lang->line('download_file');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_less_than'] = $this->lang->line('less_than');
        $data['lang_file'] = $this->lang->line('file');
        $data['lang_choose_expenses_category'] = $this->lang->line('choose_expenses_category');
        $data['lang_browse'] = $this->lang->line('browse');

        $this->load->view('edit_expenses', $data);
    }

    // View Expenses Category;
    public function expense_category() {
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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_expenses_category_name'] = $this->lang->line('expenses_category_name');
        $data['lang_add_expenses_category'] = $this->lang->line('add_expenses_category');

        $this->load->view('expense_category', $data);
    }

    // View Add Expenses Category;
    public function expense_category_add() {
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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_expenses_category_name'] = $this->lang->line('expenses_category_name');
        $data['lang_add_expenses_category'] = $this->lang->line('add_expenses_category');

        $this->load->view('expense_category_add', $data);
    }

    // View Edit Expenses Category;
    public function expense_category_edit() {
        $id = $this->input->get('id');
        $data['id'] = $id;
		
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
        $data['lang_type'] = $this->lang->line('type');
        $data['lang_print'] = $this->lang->line('print');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_all_outlets'] = $this->lang->line('all_outlets');
        $data['lang_all_category'] = $this->lang->line('all_category');

        $data['lang_expenses_number'] = $this->lang->line('expenses_number');
        $data['lang_expenses_category'] = $this->lang->line('expenses_category');
        $data['lang_date_from'] = $this->lang->line('date_from');
        $data['lang_date_to'] = $this->lang->line('date_to');
        $data['lang_expenses_category_name'] = $this->lang->line('expenses_category_name');
        $data['lang_add_expenses_category'] = $this->lang->line('add_expenses_category');
        $data['lang_edit_expenses_category'] = $this->lang->line('edit_expenses_category');
		
		$expData = $this->Constant_model->getDataOneColumn('expense_categories', 'id', $id);
		$data['exp_name'] = $expData[0]->name;
		$data['status'] = $expData[0]->status;
        $this->load->view('expense_category_edit', $data);
    }

    // ****************************** View Page -- END ****************************** //
    // ****************************** Action To Database -- START ****************************** //
    // Update Expenses Category;
    public function updateExpenseCategory() {
        $id = $this->input->post('id');
        $name = strip_tags($this->input->post('name'));
        $status = strip_tags($this->input->post('status'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Expense Category', 'Please enter Expense Category Name!'));
            redirect(base_url() . 'expenses/expense_category_edit?id=' . $id);
        } else {
            $upd_data = array(
                'name' => $name,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
                'status' => $status,
            );
            if ($this->Constant_model->updatePaymentMethodData('expense_categories', $upd_data, $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Expense Category', "Successfully Updated Expense Category Name : $name!"));
                redirect(base_url() . 'expenses/expense_category_edit?id=' . $id);
            }
        }
    }

    // Insert Expenses Category;
    public function insertExpenseCategory() {
        $name = strip_tags($this->input->post('name'));
        $status = strip_tags($this->input->post('status'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Expense Category', 'Please enter Expense Category Name!'));
            redirect(base_url() . 'expenses/expense_category_add');
        } else {
            $ins_data = array(
                'name' => $name,
                'created_user_id' => $us_id,
                'created_datetime' => $tm,
                'status' => $status,
            );
            if ($this->Constant_model->insertData('expense_categories', $ins_data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Add Expense Category', "Successfully Added New Expense Category Name : $name!"));
                redirect(base_url() . 'expenses/expense_category');
            }
        }
    }

	
	public function deleteExpenseCategory() {
         $id = $this->input->get('id');
         if ($this->Constant_model->deletePaymentMethodData('expenses', $id)) {
             $this->session->set_flashdata('alert_msg', array('success', 'Delete Expenses', "Successfully Deleted Expenses!"));
             redirect(base_url() . 'expenses/expense_category');
         }
    }
	
    // Delete Expenses;
    public function deleteExpenses() {
        $id = $this->input->get('id');

        $expDtaData = $this->Constant_model->getDataOneColumn('expenses', 'id', $id);
        if (count($expDtaData) == 0) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Delete Expenses', 'Error on deleting Expenses!'));
            redirect(base_url() . 'expenses/view');
        } else {
            if ($this->Constant_model->deleteData('expenses', $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Delete Expenses', 'Successfully Deleted Expenses!'));
                redirect(base_url() . 'expenses/view');
            }
        }
    }

    // Update Expenses;
    public function updateExpenses() {
        $id = $this->input->post('id');
        $number = strip_tags($this->input->post('number'));
        $outlet = strip_tags($this->input->post('outlet'));
        $date = date('Y-m-d', strtotime(strip_tags($this->input->post('date'))));
        $amount = strip_tags($this->input->post('amount'));
        $reason = strip_tags($this->input->post('reason'));
        $exp_category = strip_tags($this->input->post('category'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        $temp_fn = $_FILES['uploadFile']['name'];
        if (!empty($temp_fn)) {
            $temp_fn_ext = pathinfo($temp_fn, PATHINFO_EXTENSION);

            if ($_FILES['uploadFile']['size'] > 2097152) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Upload file size must be less than 2MB!'));
                redirect(base_url() . 'expenses/addNewExpenses');

                die();
            }
        }

        if (empty($number)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Expenses', 'Please enter Expenses Number!'));
            redirect(base_url() . 'expenses/editExpenses?id=' . $id);
        } elseif (empty($outlet)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Expenses', 'Please Choose Expenses for Outlet!'));
            redirect(base_url() . 'expenses/editExpenses?id=' . $id);
        } elseif (empty($date)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Expenses', 'Please enter Expenses Date!'));
            redirect(base_url() . 'expenses/editExpenses?id=' . $id);
        } elseif (empty($amount)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Expenses', 'Please enter Expenses Amount!'));
            redirect(base_url() . 'expenses/editExpenses?id=' . $id);
        } elseif (empty($exp_category)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Expenses', 'Please select Expenses Category!'));
            redirect(base_url() . 'expenses/editExpenses?id=' . $id);
        } else {
            $upd_data = array(
                'expenses_number' => $number,
                'expense_category' => $exp_category,
                'outlet_id' => $outlet,
                'date' => $date,
                'amount' => $amount,
                'reason' => $reason,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
            );
            if ($this->Constant_model->updateData('expenses', $upd_data, $id)) {
                $temp_fn = $_FILES['uploadFile']['name'];
                if (!empty($temp_fn)) {
                    $temp_fn_ext = pathinfo($temp_fn, PATHINFO_EXTENSION);

                    $new_name = time() . ".$temp_fn_ext";

                    // Main Photo -- START;
                    $config['upload_path'] = './assets/upload/expenses/';
                    $config['allowed_types'] = '*';
                    $config['file_name'] = $new_name;
                    $this->load->library('upload', $config);

                    if (!$this->upload->do_upload('uploadFile')) {
                        $error = array('error' => $this->upload->display_errors());
                        //print_r($error);
                        //$this->load->view('upload_form', $error);
                        //$this->session->set_flashdata('alert_msg', array('error','warning','Error',"$error"));
                    } else {
                        $upd_file_name_data = array(
                            'file_name' => $new_name,
                        );
                        $this->Constant_model->updateData('expenses', $upd_file_name_data, $id);
                    }
                }

                $this->session->set_flashdata('alert_msg', array('success', 'Update Expenses', 'Successfully Updated Expenses!'));
                redirect(base_url() . 'expenses/editExpenses?id=' . $id);
            }
        }
    }

    // Insert;
    public function insertNewExpenses() {
        $number = strip_tags($this->input->post('number'));
        $outlet = strip_tags($this->input->post('outlet'));
        $date = date('Y-m-d', strtotime(strip_tags($this->input->post('date'))));
        $amount = strip_tags($this->input->post('amount'));
        $reason = strip_tags($this->input->post('reason'));
        $exp_category = strip_tags($this->input->post('category'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        $temp_fn = $_FILES['uploadFile']['name'];
        if (!empty($temp_fn)) {
            $temp_fn_ext = pathinfo($temp_fn, PATHINFO_EXTENSION);

            if ($_FILES['uploadFile']['size'] > 2097152) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Upload file size must be less than 2MB!'));
                redirect(base_url() . 'expenses/addNewExpenses');

                die();
            }
        }

        if (empty($number)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Please enter Expenses Number!'));
            redirect(base_url() . 'expenses/addNewExpenses');
        } elseif (empty($outlet)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Please Choose Expenses for Outlet!'));
            redirect(base_url() . 'expenses/addNewExpenses');
        } elseif (empty($date)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Please enter Expenses Date!'));
            redirect(base_url() . 'expenses/addNewExpenses');
        } elseif (empty($amount)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Please enter Expenses Amount!'));
            redirect(base_url() . 'expenses/addNewExpenses');
        } elseif (empty($exp_category)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Expenses', 'Please select Expenses Category!'));
            redirect(base_url() . 'expenses/addNewExpenses');
        } else {
            $ins_data = array(
                'expenses_number' => $number,
                'expense_category' => $exp_category,
                'outlet_id' => $outlet,
                'date' => $date,
                'amount' => $amount,
                'reason' => $reason,
                'created_user_id' => $us_id,
                'created_datetime' => $tm,
                'status' => '1',
            );
            $exp_id = $this->Constant_model->insertDataReturnLastId('expenses', $ins_data);

            $temp_fn = $_FILES['uploadFile']['name'];
            if (!empty($temp_fn)) {
                $temp_fn_ext = pathinfo($temp_fn, PATHINFO_EXTENSION);

                $new_name = time() . ".$temp_fn_ext";

                // Main Photo -- START;
                $config['upload_path'] = './assets/upload/expenses/';
                $config['allowed_types'] = '*';
                $config['file_name'] = $new_name;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    //$this->load->view('upload_form', $error);
                    //$this->session->set_flashdata('alert_msg', array('error','warning','Error',"$error"));
                } else {
                    $upd_file_name_data = array(
                        'file_name' => $new_name,
                    );
                    $this->Constant_model->updateData('expenses', $upd_file_name_data, $exp_id);
                }
            }

            $this->session->set_flashdata('alert_msg', array('success', 'Add New Expenses', 'Successfully Added New Expenses!'));
            redirect(base_url() . 'expenses/addNewExpenses');
        }
    }

    // ****************************** Action To Database -- END ****************************** //
    // ****************************** Export Excel -- START ****************************** //
    // Export Expenses;
    public function exportExpenses() {
        $user_role = $this->session->userdata('user_role');
        $user_outlet = $this->session->userdata('user_outlet');

        $siteSettingData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $site_dateformat = $siteSettingData[0]->datetime_format;
        $site_currency = $siteSettingData[0]->currency;

        $this->load->library('excel');

        require_once './application/third_party/PHPExcel.php';
        require_once './application/third_party/PHPExcel/IOFactory.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        );

        $acc_default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'c7c7c7'),
        );
        $outlet_style_header = array(
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 10,
                'name' => 'Arial',
                'bold' => true,
            ),
        );
        $top_header_style = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 15,
                'name' => 'Arial',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
        );
        $account_value_style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
        );
        $text_align_style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
                'bold' => true,
            ),
        );

        $lang_expenses_report = $this->lang->line('expenses_report');
        $lang_expenses_numb = $this->lang->line('expenses_number');
        $lang_expenses_category = $this->lang->line('expenses_category');
        $lang_outlet = $this->lang->line('outlet_name');
        $lang_expenses_date = $this->lang->line('date');
        $lang_reason = $this->lang->line('reason');
        $lang_amount = $this->lang->line('amount');
        $lang_total = $this->lang->line('total');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "$lang_expenses_report");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($top_header_style);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "$lang_expenses_numb");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "$lang_expenses_category");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "$lang_outlet");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "$lang_expenses_date");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "$lang_reason");
        $objPHPExcel->getActiveSheet()->setCellValue('F2', "$lang_amount ($site_currency)");

        $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $jj = 3;
        $total_exp_amt = 0;

        if ($user_role == '1') {
            $expResult = $this->db->query("SELECT * FROM expenses WHERE status = '1' ORDER BY date DESC ");
        } else {
            $expResult = $this->db->query("SELECT * FROM expenses WHERE status = '1' AND outlet_id = '$user_outlet' ORDER BY date DESC ");
        }
        $expData = $expResult->result();

        for ($e = 0; $e < count($expData); ++$e) {
            $exp_numb = $expData[$e]->expenses_number;
            $exp_outlet_id = $expData[$e]->outlet_id;
            $exp_date = date("$site_dateformat", strtotime($expData[$e]->date));
            $exp_reason = $expData[$e]->reason;
            $exp_amt = $expData[$e]->amount;

            $exp_cat_id = $expData[$e]->expense_category;

            $exp_cat_name = '';
            $expCatNameData = $this->Constant_model->getDataOneColumn('expense_categories', 'id', $exp_cat_id);
            if (count($expCatNameData) > 0) {
                $exp_cat_name = $expCatNameData[0]->name;
            }

            $total_exp_amt += $exp_amt;

            $outlet_name = '';
            $outletDtaData = $this->Constant_model->getDataOneColumn('outlets', 'id', "$exp_outlet_id");
            $outlet_name = $outletDtaData[0]->name;

            $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$exp_numb");
            $objPHPExcel->getActiveSheet()->setCellValue("B$jj", "$exp_cat_name");
            $objPHPExcel->getActiveSheet()->setCellValue("C$jj", "$outlet_name");
            $objPHPExcel->getActiveSheet()->setCellValue("D$jj", "$exp_date");
            $objPHPExcel->getActiveSheet()->setCellValue("E$jj", "$exp_reason");
            $objPHPExcel->getActiveSheet()->setCellValue("F$jj", "$exp_amt");

            $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($account_value_style_header);

            $objPHPExcel->getActiveSheet()->getDefaultStyle("D$jj")->getAlignment()->setWrapText(true);

            unset($exp_numb);
            unset($exp_outlet_id);
            unset($exp_date);
            unset($exp_reason);
            unset($exp_amt);

            ++$jj;
        }
        unset($expResult);
        unset($expData);

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$jj:E$jj");
        $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$lang_total");
        $objPHPExcel->getActiveSheet()->setCellValue("F$jj", "$total_exp_amt ($site_currency)");

        $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($text_align_style);
        $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getRowDimension("$jj")->setRowHeight(30);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Expenses_Report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function exportSearchExpenses() {
        $user_role = $this->session->userdata('user_role');
        $user_outlet = $this->session->userdata('user_outlet');

        $search_expenses_numb = $this->input->get('expenses_numb');
        $search_outlet = $this->input->get('outlet');
        $search_start_date = $this->input->get('start_date');
        $search_end_date = $this->input->get('end_date');

        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;
        $setting_dateformat = $paginationData[0]->datetime_format;
        $setting_currency = $paginationData[0]->currency;

        $this->load->library('excel');

        require_once './application/third_party/PHPExcel.php';
        require_once './application/third_party/PHPExcel/IOFactory.php';

        // Create new PHPExcel object
        $objPHPExcel = new PHPExcel();

        $default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => '000000'),
        );

        $acc_default_border = array(
            'style' => PHPExcel_Style_Border::BORDER_THIN,
            'color' => array('rgb' => 'c7c7c7'),
        );
        $outlet_style_header = array(
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 10,
                'name' => 'Arial',
                'bold' => true,
            ),
        );
        $top_header_style = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 15,
                'name' => 'Arial',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
            ),
        );
        $style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
                'bold' => true,
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
        );
        $account_value_style_header = array(
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
            ),
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
            ),
        );
        $text_align_style = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER,
            ),
            'borders' => array(
                'bottom' => $default_border,
                'left' => $default_border,
                'top' => $default_border,
                'right' => $default_border,
            ),
            'fill' => array(
                'type' => PHPExcel_Style_Fill::FILL_SOLID,
                'color' => array('rgb' => 'ffff03'),
            ),
            'font' => array(
                'color' => array('rgb' => '000000'),
                'size' => 12,
                'name' => 'Arial',
                'bold' => true,
            ),
        );

        $lang_expenses_report = $this->lang->line('expenses_report');
        $lang_expenses_numb = $this->lang->line('expenses_number');
        $lang_expenses_category = $this->lang->line('expenses_category');
        $lang_outlet = $this->lang->line('outlet_name');
        $lang_expenses_date = $this->lang->line('date');
        $lang_reason = $this->lang->line('reason');
        $lang_amount = $this->lang->line('amount');
        $lang_total = $this->lang->line('total');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:F1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "$lang_expenses_report");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($top_header_style);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "$lang_expenses_numb");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "$lang_expenses_category");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "$lang_outlet");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "$lang_expenses_date");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "$lang_reason");
        $objPHPExcel->getActiveSheet()->setCellValue('F2', "$lang_amount ($setting_currency)");

        $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $jj = 3;
        $total_exp_amt = 0;

        $sort = '';
        $date_sort = '';

        if (!empty($search_expenses_numb)) {
            $sort .= " AND expenses_number LIKE '$search_expenses_numb%' ";
        }
        if (!empty($search_outlet)) {
            if ($search_outlet == '-') {
                $sort .= ' AND outlet_id > 0 ';
            } else {
                $sort .= " AND outlet_id = '$search_outlet' ";
            }
        }
        if (!empty($search_start_date) && !empty($search_end_date)) {
            $url_start = $search_start_date;
            $url_end = $search_end_date;

            if ($setting_dateformat == 'd/m/Y') {
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
            if ($setting_dateformat == 'd.m.Y') {
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
            if ($setting_dateformat == 'd-m-Y') {
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

            if ($setting_dateformat == 'm/d/Y') {
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
            if ($setting_dateformat == 'm.d.Y') {
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
            if ($setting_dateformat == 'm-d-Y') {
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

            if ($setting_dateformat == 'Y.m.d') {
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
            if ($setting_dateformat == 'Y/m/d') {
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
            if ($setting_dateformat == 'Y-m-d') {
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

            //$start_date = $url_start.' 00:00:00';
            //$end_date 	= $url_end.' 23:59:59';

            $date_sort = " AND date >= '$url_start' AND date <= '$url_end' ";
        }

        $expResult = $this->db->query("SELECT * FROM expenses WHERE status = '1' $sort $date_sort ORDER BY date DESC ");
        $expData = $expResult->result();

        for ($e = 0; $e < count($expData); ++$e) {
            $id = $expData[$e]->id;
            $number = $expData[$e]->expenses_number;
            $outlet_id = $expData[$e]->outlet_id;
            $amount = $expData[$e]->amount;
            $date = date("$setting_dateformat", strtotime($expData[$e]->date));
            $exp_reason = $expData[$e]->reason;

            $exp_cat_id = $expData[$e]->expense_category;

            $exp_cat_name = '';
            $expCatNameData = $this->Constant_model->getDataOneColumn('expense_categories', 'id', $exp_cat_id);
            if (count($expCatNameData) > 0) {
                $exp_cat_name = $expCatNameData[0]->name;
            }

            $total_exp_amt += $amount;

            $outlet_name = '';
            $outletNameData = $this->Constant_model->getDataOneColumn('outlets', 'id', $outlet_id);
            $outlet_name = $outletNameData[0]->name;

            $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$number");
            $objPHPExcel->getActiveSheet()->setCellValue("B$jj", "$exp_cat_name");
            $objPHPExcel->getActiveSheet()->setCellValue("C$jj", "$outlet_name");
            $objPHPExcel->getActiveSheet()->setCellValue("D$jj", "$date");
            $objPHPExcel->getActiveSheet()->setCellValue("E$jj", "$exp_reason");
            $objPHPExcel->getActiveSheet()->setCellValue("F$jj", "$amount");

            $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($account_value_style_header);

            $objPHPExcel->getActiveSheet()->getDefaultStyle("D$jj")->getAlignment()->setWrapText(true);

            unset($id);
            unset($number);
            unset($outlet_id);
            unset($amount);
            unset($date);
            unset($exp_reason);

            ++$jj;
        }
        unset($expResult);
        unset($expData);

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$jj:E$jj");
        $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$lang_total");
        $objPHPExcel->getActiveSheet()->setCellValue("F$jj", "$total_exp_amt ($setting_currency)");

        $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($text_align_style);
        $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getRowDimension("$jj")->setRowHeight(30);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Expenses_Report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    // ****************************** Export Excel -- END ****************************** //
}
