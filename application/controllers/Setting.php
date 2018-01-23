<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Setting extends CI_Controller {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->library('session');
        $this->load->model('Setting_model');
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
    // View Setting;
    public function system_setting() {
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

        $data['lang_system_setting'] = $this->lang->line('system_setting');
        $data['lang_site_name'] = $this->lang->line('site_name');
        $data['lang_system_timezone'] = $this->lang->line('system_timezone');
        $data['lang_pagination_per_page'] = $this->lang->line('pagination_per_page');
        $data['lang_tax'] = $this->lang->line('tax');
        $data['lang_currency'] = $this->lang->line('currency');
        $data['lang_system_date_format'] = $this->lang->line('system_date_format');
        $data['lang_pos_display_product'] = $this->lang->line('pos_display_product');
        $data['lang_pos_display_keyboard'] = $this->lang->line('pos_display_keyboard');
        $data['lang_pos_default_customer'] = $this->lang->line('pos_default_customer');
        $data['lang_logo'] = $this->lang->line('logo');
        $data['lang_browse'] = $this->lang->line('browse');
        $data['lang_update_system_setting'] = $this->lang->line('update_system_setting');
        $data['lang_yes'] = $this->lang->line('yes');
        $data['lang_no'] = $this->lang->line('no');
        $data['lang_both'] = $this->lang->line('both');
        $data['lang_photo'] = $this->lang->line('photo');
        $data['lang_name'] = $this->lang->line('name');

        $this->load->view('system_setting', $data);
    }

    // View Outlet;
    public function outlets() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;

        $config = array();
        $config['base_url'] = base_url() . 'setting/outlets/';
        $config['display_pages'] = true;
        $config['first_link'] = 'First';
        $config['total_rows'] = $this->Setting_model->record_outlet_count();
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
        $data['results'] = $this->Setting_model->fetch_outlet_data($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
        if ($page == 0) {
            $have_count = $this->Setting_model->record_outlet_count();
            $sh_text = 'Showing 1 to ' . count($data['results']) . ' of ' . $this->Setting_model->record_outlet_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Setting_model->record_outlet_count() . ' entries';
        }

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

        $data['lang_add_new_outlet'] = $this->lang->line('add_new_outlet');
        $data['lang_outlet_name'] = $this->lang->line('outlet_name');
        $data['lang_address'] = $this->lang->line('address');
        $data['lang_contact_number'] = $this->lang->line('contact_number');
        $data['lang_active'] = $this->lang->line('active');
        $data['lang_inactive'] = $this->lang->line('inactive');

        $this->load->view('outlets', $data);
    }

    // Add Outlet;
    public function addoutlet() {
        $path = '../js/ckfinder';
        $width = '100%';
        $this->editor($path, $width);    // Editor function below of this controller;

        $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
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

            $data['lang_add_new_outlet'] = $this->lang->line('add_new_outlet');
            $data['lang_outlet_name'] = $this->lang->line('outlet_name');
            $data['lang_address'] = $this->lang->line('address');
            $data['lang_contact_number'] = $this->lang->line('contact_number');
            $data['lang_receipt_footer'] = $this->lang->line('receipt_footer');
            $data['lang_add'] = $this->lang->line('add');
            $data['lang_back'] = $this->lang->line('back');

            $this->load->view('add_outlet', $data);
        }
    }

    // Edit Outlet;
    public function editoutlet() {
        $id = $this->input->get('id');

        $data['id'] = $id;

        $path = '../js/ckfinder';
        $width = '100%';
        $this->editor($path, $width);    // Editor function below of this controller;

        $this->form_validation->set_rules('description', 'Page Description', 'trim|required|xss_clean');
        if ($this->form_validation->run() == false) {
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

            $data['lang_add_new_outlet'] = $this->lang->line('add_new_outlet');
            $data['lang_outlet_name'] = $this->lang->line('outlet_name');
            $data['lang_address'] = $this->lang->line('address');
            $data['lang_contact_number'] = $this->lang->line('contact_number');
            $data['lang_receipt_footer'] = $this->lang->line('receipt_footer');
            $data['lang_update'] = $this->lang->line('update');
            $data['lang_back'] = $this->lang->line('back');
            $data['lang_edit_outlet'] = $this->lang->line('edit_outlet');
            $data['lang_delete_outlet'] = $this->lang->line('delete_outlet');

            $this->load->view('edit_outlet', $data);
        }
    }

    // View User;
    public function users() {
		
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;
        $config = array();
        $config['base_url'] = base_url() . 'setting/users/';
        $config['display_pages'] = true;
        $config['first_link'] = 'First';
        $config['total_rows'] = $this->Setting_model->record_user_count();		
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
        $data['results'] = $this->Setting_model->fetch_user_data($config['per_page'], $page);
        $data['links'] = $this->pagination->create_links();
		
        if ($page == 0) {
            $have_count = $this->Setting_model->record_user_count();
            $sh_text = 'Showing 1 to ' . count($data['results']) . ' of ' . $this->Setting_model->record_user_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Setting_model->record_user_count() . ' entries';
        }
		
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
        $data['lang_full_name'] = $this->lang->line('full_name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_role'] = $this->lang->line('role');
        $data['lang_change_password'] = $this->lang->line('change_password');
        $data['lang_add_new_user'] = $this->lang->line('add_new_user');
        $data['lang_demo_edit'] = $this->lang->line('demo_edit');
        $data['lang_active'] = $this->lang->line('active');
        $data['lang_inactive'] = $this->lang->line('inactive');
        $this->load->view('users', $data);
    }

    // Add User;
    public function adduser() {
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
        $data['lang_full_name'] = $this->lang->line('full_name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_role'] = $this->lang->line('role');
        $data['lang_change_password'] = $this->lang->line('change_password');
        $data['lang_add_new_user'] = $this->lang->line('add_new_user');
        $data['lang_demo_edit'] = $this->lang->line('demo_edit');
        $data['lang_password'] = $this->lang->line('password');
        $data['lang_confirm_password'] = $this->lang->line('confirm_password');
        $data['lang_choose_role'] = $this->lang->line('choose_role');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_active'] = $this->lang->line('active');
        $data['lang_inactive'] = $this->lang->line('inactive');
        $this->load->view('add_user', $data);
    }

    // Edit User;
    public function edituser() {
        $id = $this->input->get('id');
        $data['user_id'] = $id;
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
        $data['lang_full_name'] = $this->lang->line('full_name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_role'] = $this->lang->line('role');
        $data['lang_change_password'] = $this->lang->line('change_password');
        $data['lang_add_new_user'] = $this->lang->line('add_new_user');
        $data['lang_demo_edit'] = $this->lang->line('demo_edit');
        $data['lang_password'] = $this->lang->line('password');
        $data['lang_confirm_password'] = $this->lang->line('confirm_password');
        $data['lang_choose_role'] = $this->lang->line('choose_role');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_edit_user'] = $this->lang->line('edit_user');
        $data['lang_delete_user'] = $this->lang->line('delete_user');
        $data['lang_active'] = $this->lang->line('active');
        $data['lang_inactive'] = $this->lang->line('inactive');
		
		$userDtaData = $this->Constant_model->getDataOneColumn('pos_user', 'user_id', $id);
		if (count($userDtaData) == 0) {
			$this->load->view('users', $data);
		}
		
		$data['fullname'] = $userDtaData[0]->fullname;
		$data['email'] = $userDtaData[0]->email;
		$data['db_role_id'] = $userDtaData[0]->role_id;
		$data['db_outlet_id'] = $userDtaData[0]->outlet_id;
		$data['pin'] = $userDtaData[0]->pin;
		$data['status'] = $userDtaData[0]->status;
        $this->load->view('edit_user', $data);
    }

    // Change Password;
    public function changePassword() {
        $id = $this->input->get('id');
        $data['user_id'] = $id;
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
        $data['lang_change_password'] = $this->lang->line('change_password');
        $data['lang_new_password'] = $this->lang->line('new_password');
        $data['lang_confirm_password'] = $this->lang->line('confirm_password');
        $this->load->view('change_password', $data);
    }

    // Payment Method;
    public function payment_methods() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;

        $config = array();
        $config['base_url'] = base_url() . 'setting/payment_methods/';

        $config['display_pages'] = true;
        $config['first_link'] = 'First';

        $config['total_rows'] = $this->Setting_model->record_payment_count();
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

        $data['results'] = $this->Setting_model->fetch_payment_data($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        if ($page == 0) {
            $have_count = $this->Setting_model->record_payment_count();
            $sh_text = 'Showing 1 to ' . count($data['results']) . ' of ' . $this->Setting_model->record_payment_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Setting_model->record_payment_count() . ' entries';
        }

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

        $data['lang_payment_methods'] = $this->lang->line('payment_methods');
        $data['lang_add_payment_method'] = $this->lang->line('add_payment_method');
        $data['lang_payment_method_name'] = $this->lang->line('payment_method_name');
        $data['lang_delete_payment_method'] = $this->lang->line('delete_payment_method');

        $this->load->view('payment_methods', $data);
    }

    // Add New Payment Method;
    public function addpaymentmethod() {
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

        $data['lang_payment_methods'] = $this->lang->line('payment_methods');
        $data['lang_add_payment_method'] = $this->lang->line('add_payment_method');
        $data['lang_payment_method_name'] = $this->lang->line('payment_method_name');
        $data['lang_delete_payment_method'] = $this->lang->line('delete_payment_method');

        $this->load->view('add_payment_method', $data);
    }

    // Edit Payment Method;
    public function editpaymentmethod() {
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

        $data['lang_payment_methods'] = $this->lang->line('payment_methods');
        $data['lang_add_payment_method'] = $this->lang->line('add_payment_method');
        $data['lang_payment_method_name'] = $this->lang->line('payment_method_name');
        $data['lang_delete_payment_method'] = $this->lang->line('delete_payment_method');
        $data['lang_edit_payment_method'] = $this->lang->line('edit_payment_method');

        $this->load->view('edit_payment_method', $data);
    }

    // View Suppliers;
    public function suppliers() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;

        $config = array();
        $config['base_url'] = base_url() . 'setting/suppliers/';

        $config['display_pages'] = true;
        $config['first_link'] = 'First';

        $config['total_rows'] = $this->Setting_model->record_suppliers_count();
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

        $data['results'] = $this->Setting_model->fetch_suppliers_data($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        if ($page == 0) {
            $have_count = $this->Setting_model->record_suppliers_count();
            $sh_text = 'Showing 1 to ' . count($data['results']) . ' of ' . $this->Setting_model->record_suppliers_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Setting_model->record_suppliers_count() . ' entries';
        }

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

        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_telephone'] = $this->lang->line('telephone');
        $data['lang_fax'] = $this->lang->line('fax');
        $data['lang_add_supplier'] = $this->lang->line('add_supplier');
        $data['lang_delete_supplier'] = $this->lang->line('delete_supplier');
        $data['lang_supplier_tax'] = $this->lang->line('supplier_tax');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');

        $this->load->view('suppliers', $data);
    }

    // Add Supplier;
    public function addsupplier() {
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

        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_telephone'] = $this->lang->line('telephone');
        $data['lang_fax'] = $this->lang->line('fax');
        $data['lang_add_supplier'] = $this->lang->line('add_supplier');
        $data['lang_delete_supplier'] = $this->lang->line('delete_supplier');
        $data['lang_supplier_tax'] = $this->lang->line('supplier_tax');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_supplier_name'] = $this->lang->line('supplier_name');
        $data['lang_supplier_address'] = $this->lang->line('supplier_address');

        $this->load->view('add_supplier', $data);
    }

    // Edit Supplier;
    public function editsupplier() {
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

        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_telephone'] = $this->lang->line('telephone');
        $data['lang_fax'] = $this->lang->line('fax');
        $data['lang_add_supplier'] = $this->lang->line('add_supplier');
        $data['lang_delete_supplier'] = $this->lang->line('delete_supplier');
        $data['lang_supplier_tax'] = $this->lang->line('supplier_tax');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_supplier_name'] = $this->lang->line('supplier_name');
        $data['lang_supplier_address'] = $this->lang->line('supplier_address');
        $data['lang_edit_supplier'] = $this->lang->line('edit_supplier');

        $this->load->view('edit_supplier', $data);
    }

    // ****************************** View Page -- END ****************************** //
    // ****************************** Action To Database -- START ****************************** //
    // Delete Supplier;
    public function deleteSupplier() {
        $supplier_id = $this->input->post('supplier_id');
        $supplier_name = $this->input->post('supplier_name');

        if ($this->Constant_model->deleteData('suppliers', $supplier_id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete Supplier', "Successfully Deleted Supplier : $supplier_name."));
            redirect(base_url() . 'setting/suppliers');
        }
    }

    // Delete Outlet;
    public function deleteOutlet() {
         $outlet_id = $this->uri->segment(3, 0);
//        $outlet_id = $this->input->get('outlet_id');
        //$outlet_name = $this->input->post('outlet_name');

        if ($this->Constant_model->deleteDatabyID('outlets', $outlet_id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete Outlet', "Successfully Deleted Outlet."));
            redirect(base_url() . 'setting/outlets');
        }

        /*$outlet_id = $this->input->post('outlet_id');
        $outlet_name = $this->input->post('outlet_name');

        if ($this->Constant_model->deleteData('outlets', $outlet_id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete Outlet', "Successfully Deleted Outlet : $outlet_name."));
            redirect(base_url() . 'setting/outlets');
        }*/
    }

    // Delete User;
    public function deleteUser() {
	
		$id = $this->input->get('id');
        if ($this->Constant_model->deleteData('pos_user', $id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete User', "User Successfully Deleted."));
            redirect(base_url() . 'setting/users');
        }
	
        /*$us_id = $this->input->post('us_id');
        $us_name = $this->input->post('us_name');

        if ($this->Constant_model->deleteData('users', $us_id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete User', "Successfully Deleted User : $us_name."));
            redirect(base_url() . 'setting/users');
        }*/
    }

    // Delete Payment Method;
    public function deletePaymentMethod() {
        $pay_id = $this->uri->segment(3, 0);
        $pay_name = $this->uri->segment(4, 0);
       

        if ($this->Constant_model->deleteDatabyID('payment_method', $pay_id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete Payment Method', "Successfully Deleted Payment Method : $pay_name."));
            redirect(base_url() . 'setting/payment_methods');
        }
    }

    // Update Supplier;
    public function updateSupplier() {
        $id = $this->input->post('id');
        $name = strip_tags($this->input->post('name'));
        $email = strip_tags($this->input->post('email'));
        $tel = strip_tags($this->input->post('tel'));
        $fax = strip_tags($this->input->post('fax'));
        $address = strip_tags($this->input->post('address'));
        $status = strip_tags($this->input->post('status'));

        $tax = strip_tags($this->input->post('tax'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Supplier', 'Please enter Supplier Name!'));
            redirect(base_url() . 'setting/editsupplier?id=' . $id);
        } elseif (empty($tel)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Supplier', 'Please enter Supplier Telephone Number!'));
            redirect(base_url() . 'setting/editsupplier?id=' . $id);
        } elseif (empty($address)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Supplier', 'Please enter Supplier Address!'));
            redirect(base_url() . 'setting/editsupplier?id=' . $id);
        } else {
            $upd_data = array(
                'name' => $name,
                'tax' => $tax,
                'email' => $email,
                'address' => $address,
                'tel' => $tel,
                'fax' => $fax,
                'status' => $status,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
            );
            if ($this->Constant_model->updateData('suppliers', $upd_data, $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Supplier', "Successfully Updated Supplier : $name"));
                redirect(base_url() . 'setting/editsupplier?id=' . $id);
            }
        }
    }

    // Insert New Supplier;
    public function insertSupplier() {
        $name = strip_tags($this->input->post('name'));
        $email = strip_tags($this->input->post('email'));
        $tel = strip_tags($this->input->post('tel'));
        $fax = strip_tags($this->input->post('fax'));
        $address = strip_tags($this->input->post('address'));
        $tax = strip_tags($this->input->post('tax'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Supplier', 'Please enter Supplier Name!', "$name", "$email", "$tel", "$fax", "$address", "$tax"));
            redirect(base_url() . 'setting/addsupplier');
        } elseif (empty($tel)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Supplier', 'Please enter Supplier Telephone Number!', "$name", "$email", "$tel", "$fax", "$address", "$tax"));
            redirect(base_url() . 'setting/addsupplier');
        } elseif (empty($address)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Supplier', 'Please enter Supplier Address!', "$name", "$email", "$tel", "$fax", "$address", "$tax"));
            redirect(base_url() . 'setting/addsupplier');
        } else {
            $ins_data = array(
                'name' => $name,
                'tax' => $tax,
                'email' => $email,
                'address' => $address,
                'tel' => $tel,
                'fax' => $fax,
                'created_user_id' => $us_id,
                'created_datetime' => $tm,
                'status' => '1',
            );
            if ($this->Constant_model->insertData('suppliers', $ins_data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Add Supplier', "Successfully Added New Supplier : $name", '', '', '', '', '', ''));
                redirect(base_url() . 'setting/addsupplier');
            }
        }
    }

    // Update Payment Method;
    public function updatePaymentMethod() {
        $id = $this->input->post('id');
        $name = strip_tags($this->input->post('name'));
        $status = strip_tags($this->input->post('status'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Payment Method', 'Please enter Payment Method!'));
            redirect(base_url() . 'setting/editpaymentmethod?id=' . $id);
        } else {
            $upd_data = array(
                'name' => $name,
                'status' => $status,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
            );
            if ($this->Constant_model->updatePaymentMethodData('payment_method', $upd_data, $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Payment Method', 'Successfully Updated Payment Method.'));
                redirect(base_url() . 'setting/editpaymentmethod?id=' . $id);
            }
        }
    }

    // Insert New Payment Method;
    public function insertPaymentMethod() {
        $name = strip_tags($this->input->post('name'));
        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Payment Method', 'Please enter Payment Method Name!'));
            redirect(base_url() . 'setting/addpaymentmethod');
        } else {
            $ins_data = array(
                'name' => $name,
                'created_user_id' => $us_id,
                'created_datetime' => $tm,
                'status' => '1',
            );
            if ($this->Constant_model->insertData('payment_method', $ins_data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Add New Payment Method', 'Successfully Added New Payment Method.'));
                redirect(base_url() . 'setting/addpaymentmethod');
            }
        }
    }

    // Update Password;
    public function updatePassword() {
        $id = $this->input->post('id');
        $pass = $this->input->post('pass');
        $conpass = $this->input->post('conpass');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($pass)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Password', 'Please enter your New Password!'));
            redirect(base_url() . 'setting/changePassword?id=' . $id);
        } elseif (empty($conpass)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Password', 'Please enter your Confirm Password!'));
            redirect(base_url() . 'setting/changePassword?id=' . $id);
        } elseif ($pass != $conpass) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Password', 'New Password &amp; Confirm Password must be the same!'));
            redirect(base_url() . 'setting/changePassword?id=' . $id);
        } else {
            $password = $this->encryptPassword($pass);

            $upd_data = array(
                'password' => $password,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
            );
            if ($this->Constant_model->updateData('users', $upd_data, $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Password', 'Successfully Updated your New Password.'));
                redirect(base_url() . 'setting/changePassword?id=' . $id);
            }
        }
    }

    // Update User;
    public function updateUser() {
        $id = $this->input->post('id');
        $fn = strip_tags($this->input->post('fullname'));
        $email = strip_tags($this->input->post('email'));
        $role = strip_tags($this->input->post('role'));
        $outlet = strip_tags($this->input->post('outlet'));
        $pin = strip_tags($this->input->post('pin'));
        $status = strip_tags($this->input->post('status'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if ($role == '1') {
            $outlet = '0';
        }

        if (empty($fn)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update User', 'Please enter Full Name!'));
            redirect(base_url() . 'setting/edituser?id=' . $id);
        } elseif (empty($email)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update User', 'Please enter Email Address!'));
            redirect(base_url() . 'setting/edituser?id=' . $id);
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update User', 'Invalid Email Address!'));
            redirect(base_url() . 'setting/edituser?id=' . $id);
        } elseif (empty($role)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update User', 'Please Choose User Role!'));
            redirect(base_url() . 'setting/edituser?id=' . $id);
        } else {
            $ckEmailData = $this->Constant_model->twoColumnNotEqual('users', 'email', "$email", 'id', "$id");
            $ckPinData = $this->Constant_model->twoColumnNotEqual('users', 'pin', "$pin", 'id', "$id");

            if ((count($ckEmailData) == 0) && (count($ckPinData) == 0)) {
                $upd_data = array(
                    'fullname' => $fn,
                    'email' => $email,
                    'role_id' => $role,
                    'outlet_id' => $outlet,
                    'updated_user_id' => $us_id,
                    'updated_datetime' => $tm,
                    'pin' => $pin,
                    'status' => $status,
                );
                if ($this->Constant_model->updateData('users', $upd_data, $id)) {
                    $this->session->set_flashdata('alert_msg', array('success', 'Update User', 'Successfully Updated User Detail.'));
                    redirect(base_url() . 'setting/edituser?id=' . $id);
                }
            } else {
                if (count($ckEmailData) > 1) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Update User', 'Email Address, you updated already existing in the system!'));
                    redirect(base_url() . 'setting/edituser?id=' . $id);
                } elseif (count($ckPinData) > 1) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Update User', 'Other user hold PIN ' . $pin . ', please choose some other pin!'));
                    redirect(base_url() . 'setting/edituser?id=' . $id);
                }
            }
        }
    }

    // Insert New User;
    public function insertUser() {
        $fn = strip_tags($this->input->post('fullname'));
        $email = strip_tags($this->input->post('email'));
        $pass = strip_tags($this->input->post('password'));
        $conpass = strip_tags($this->input->post('conpassword'));
        $role = strip_tags($this->input->post('role'));
        $pin = strip_tags($this->input->post('pin'));
        $outlet = strip_tags($this->input->post('outlet'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($fn)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Please enter Full Name!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } elseif (empty($email)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Please enter Email Address!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } elseif (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Invalid Email Address!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } elseif (empty($pass)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Please enter Password!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } elseif (empty($conpass)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Please enter Confirm Password!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } elseif ($pass != $conpass) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Password &amp; Confirm Password must be the same!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } elseif (empty($role)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', 'Please Choose User Role!', "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
            redirect(base_url() . 'setting/adduser');
        } else {
            $ckEmailData = $this->Constant_model->getDataOneColumn('pos_user', 'email', "$email");
            $ckPinData = $this->Constant_model->getDataOneColumn('pos_user', 'pin', "$pin");

            if ((count($ckEmailData) == 0) && (count($ckPinData) == 0)) {
                $password = $this->encryptPassword($pass);

                $ins_user_data = array(
                    'fullname' => $fn,
                    'email' => $email,
                    'password' => $password,
                    'role_id' => $role,
                    'outlet_id' => $outlet,
                    'created_user_id' => $us_id,
                    'created_datetime' => $tm,
                    'pin' => $pin,
                    'status' => '1',
                );

                if ($this->Constant_model->insertData('pos_user', $ins_user_data)) {
                    $this->session->set_flashdata('alert_msg', array('success', 'Add New User', "Successfully Added New User Account with Email : $email.", '', '', '', '', '', ''));
                    redirect(base_url() . 'setting/users');
                }
            } else {

                if (count($ckPinData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', "PIN : $pin is already registered at the system! Please try another PIN!", "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
                    redirect(base_url() . 'setting/adduser');
                } elseif (count($ckEmailData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Add New User', "Email Address : $email is already registered at the system! Please try another Email Address!", "$fn", "$email", "$pass", "$conpass", "$role", "$outlet"));
                    redirect(base_url() . 'setting/adduser');
                }
            }
        }
    }

    // Update Outlet;
    public function updateOutlet() {
        $id = $this->input->post('id');

        $outlet_name = strip_tags($this->input->post('outlet_name'));
        $outlet_address = strip_tags($this->input->post('outlet_address'));
        $outlet_contact = strip_tags($this->input->post('outlet_contact'));

        $receipt_footer = $this->input->post('receipt_footer');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($outlet_name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Outlet', 'Please enter your Outlet Name!'));
            redirect(base_url() . 'setting/editoutlet?id=' . $id);
        } elseif (empty($outlet_address)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Outlet', 'Please enter your Outlet Address!'));
            redirect(base_url() . 'setting/editoutlet?id=' . $id);
        } elseif (empty($outlet_contact)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Outlet', 'Please enter your Outlet Contact!'));
            redirect(base_url() . 'setting/editoutlet?id=' . $id);
        } else {
            $upd_outlet_data = array(
                'name' => $outlet_name,
                'address' => $outlet_address,
                'contact_number' => $outlet_contact,
                'receipt_footer' => $receipt_footer,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
            );
            if ($this->Constant_model->updateDatabyID('outlets', $upd_outlet_data, $id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Outlet', "Successfully updated Outlet : $outlet_name."));
				redirect(base_url() . 'setting/outlets');
                //redirect(base_url() . 'setting/editoutlet?id=' . $id);
            }
        }
    }

    // Insert New Outlet;
    public function insertOutlet() {
        $outlet_name = strip_tags($this->input->post('outlet_name'));
        $outlet_address = strip_tags($this->input->post('outlet_address'));
        $outlet_contact = strip_tags($this->input->post('outlet_contact'));

        //$receipt_header 	= $this->input->post("receipt_header");
        $receipt_footer = $this->input->post('receipt_footer');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($outlet_name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Outlet', 'Please enter your Outlet Name!'));
            redirect(base_url() . 'setting/addoutlet');
        } elseif (empty($outlet_address)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Outlet', 'Please enter your Outlet Address!'));
            redirect(base_url() . 'setting/addoutlet');
        } elseif (empty($outlet_contact)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add New Outlet', 'Please enter your Outlet Contact!'));
            redirect(base_url() . 'setting/addoutlet');
        } else {
            $ins_outlet_data = array(
                'name' => $outlet_name,
                'address' => $outlet_address,
                'contact_number' => $outlet_contact,
                'receipt_footer' => $receipt_footer,
                'created_user_id' => $us_id,
                'created_datetime' => $tm,
                'status' => '1',
            );
            if ($this->Constant_model->insertData('outlets', $ins_outlet_data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Add New Outlet', "Successfully added New Outlet : $outlet_name."));
                //redirect(base_url() . 'setting/addoutlet');
				redirect(base_url() . 'setting/outlets');
            }
        }
    }

    // Update Site Setting;
    public function updateSiteSetting() {
        $site_name = strip_tags($this->input->post('site_name'));
        $timezone = strip_tags($this->input->post('timezone'));
        $pagination = strip_tags($this->input->post('pagination'));
        $tax = strip_tags($this->input->post('tax'));
        $currency = strip_tags($this->input->post('currency'));
        $date_format = strip_tags($this->input->post('date_format'));
        $display_product = strip_tags($this->input->post('display_product'));
        $display_keyboard = strip_tags($this->input->post('display_keyboard'));
        $default_customer = strip_tags($this->input->post('default_customer'));

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($site_name)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Site Setting', 'Please enter your Site Name!'));
            redirect(base_url() . 'setting/system_setting');
        } elseif (strlen($tax) == 0) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Site Setting', 'Please enter your Government Tax!'));
            redirect(base_url() . 'setting/system_setting');
        } elseif (!is_numeric($tax)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Site Setting', 'Government Tax must be Numeric Number!'));
            redirect(base_url() . 'setting/system_setting');
        } else {
            $temp_fn = $_FILES['uploadFile']['name'];
            if (!empty($temp_fn)) {
                $temp_fn_ext = pathinfo($temp_fn, PATHINFO_EXTENSION);

                if (($temp_fn_ext == 'jpg') || ($temp_fn_ext == 'png') || ($temp_fn_ext == 'jpeg')) {
                    if ($_FILES['uploadFile']['size'] > 500000) {
                        $this->session->set_flashdata('alert_msg', array('failure', 'Update Site Setting', 'Upload file size must be less than 500KB!'));
                        redirect(base_url() . 'setting/system_setting');

                        die();
                    }
                } else {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Update Product', 'Invalid File Format! Please upload JPG, PNG, JPEG File Format for Log In Logo!'));
                    redirect(base_url() . 'setting/system_setting');

                    die();
                }
            }

            $mainPhoto_fn = $_FILES['uploadFile']['name'];
            if (!empty($mainPhoto_fn)) {
                $main_ext = pathinfo($mainPhoto_fn, PATHINFO_EXTENSION);
                $mainPhoto_name = 'logo.jpg';

                // Main Photo -- START;
                $config['upload_path'] = './assets/img/';
                $config['allowed_types'] = 'jpg|png|jpeg';
                $config['file_name'] = $mainPhoto_name;
                $this->load->library('upload', $config);

                if (!$this->upload->do_upload('uploadFile')) {
                    $error = array('error' => $this->upload->display_errors());
                    //print_r($error);
                    //$this->load->view('upload_form', $error);
                    //$this->session->set_flashdata('alert_msg', array('error','warning','Error',"$error"));
                } else {
                    $width_array = array(200);
                    $height_array = array(200);
                    $dir_array = array('logo');

                    $this->load->library('image_lib');

                    for ($i = 0; $i < count($width_array); ++$i) {
                        $config['image_library'] = 'gd2';
                        $config['source_image'] = "./assets/img/$mainPhoto_name";
                        $config['maintain_ratio'] = true;
                        $config['width'] = $width_array[$i];
                        $config['height'] = $height_array[$i];
                        $config['quality'] = '100%';

                        $config['new_image'] = './assets/img/logo/' . $mainPhoto_name;

                        $this->image_lib->clear();
                        $this->image_lib->initialize($config);
                        $this->image_lib->resize();
                    }

                    $this->load->helper('file');
                    $path = './assets/img/' . $mainPhoto_name;

                    if (unlink($path)) {
                        
                    }
                }
                // Main Photo -- END;
            }// End of File;

            $update_data = array(
                'site_name' => $site_name,
                'timezone' => $timezone,
                'pagination' => $pagination,
                'tax' => $tax,
                'currency' => $currency,
                'datetime_format' => $date_format,
                'display_product' => $display_product,
                'display_keyboard' => $display_keyboard,
                'default_customer_id' => $default_customer,
                'updated_user_id' => $us_id,
                'updated_datetime' => $tm,
            );
            if ($this->Constant_model->updateData('site_setting', $update_data, '1')) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Site Setting', 'Successfully updated Site Setting.'));
                redirect(base_url() . 'setting/system_setting');
            }
        }
    }

    // ****************************** Action To Database -- END ****************************** //

    public function encryptPassword($password) {
        return md5("$password");
    }

    public function editor($path, $width) {
        //Loading Library For Ckeditor
        $this->load->library('Ckeditor');
        $this->load->library('Ckfinder');
        //configure base path of ckeditor folder
        $this->ckeditor->basePath = base_url() . 'assets/ckeditor/';
        $this->ckeditor->config['toolbar'] = 'Full';
        $this->ckeditor->config['language'] = 'en';
        $this->ckeditor->config['width'] = $width;
        //configure ckfinder with ckeditor config
        $this->ckfinder->SetupCKEditor($this->ckeditor, $path);
    }

    public function restore() {
        $this->db->from('ci_sessions')->truncate();

        $this->db->from('expenses')->truncate();

        $this->db->from('orders')->truncate();
        $this->db->from('suspend')->truncate();
        $this->db->from('order_items')->truncate();
        $this->db->from('purchase_order')->truncate();
        $this->db->from('purchase_order_items')->truncate();
        $this->db->from('return_items')->truncate();
        $this->db->from('return_items')->truncate();

        $this->db->from('inventory')->truncate();
        $this->db->from('products')->truncate();
        $this->db->from('category')->truncate();


        $this->session->set_flashdata('alert_msg', array('success', 'Update Site Setting', 'Store restored with default settings.'));
        redirect(base_url() . 'setting/system_setting');
        exit;
    }

}
