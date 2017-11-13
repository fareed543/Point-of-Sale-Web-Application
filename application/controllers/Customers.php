<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Customers extends CI_Controller {

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
        $this->load->model('Customers_model');
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
    // View Customers;
    public function view() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;
        $setting_dateformat = $paginationData[0]->datetime_format;

        $config = array();
        $config['base_url'] = base_url() . 'customers/view/';

        $config['display_pages'] = true;
        $config['first_link'] = 'First';

        $config['total_rows'] = $this->Customers_model->record_customers_count();
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

        $data['results'] = $this->Customers_model->fetch_customers_data($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        if ($page == 0) {
            $have_count = $this->Customers_model->record_customers_count();

            $start_pg_point = 0;
            if ($have_count == 0) {
                $start_pg_point = 0;
            } else {
                $start_pg_point = 1;
            }

            $sh_text = "Showing $start_pg_point to " . count($data['results']) . ' of ' . $this->Customers_model->record_customers_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Customers_model->record_customers_count() . ' entries';
        }

        $data['displayshowingentries'] = $sh_text;
        $data['setting_dateformat'] = $setting_dateformat;

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
        $data['lang_add_customer'] = $this->lang->line('add_customer');
        $data['lang_export'] = $this->lang->line('export');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_mobile'] = $this->lang->line('mobile');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_action'] = $this->lang->line('action');
        $data['lang_edit'] = $this->lang->line('edit');
        $data['lang_sales_history'] = $this->lang->line('sales_history');
        $data['lang_no_match_found'] = $this->lang->line('no_match_found');
        $data['lang_create_return_order'] = $this->lang->line('create_return_order');

        $this->load->view('customers', $data);
    }

    // Edit Customer;
    public function edit_customer() {
        $cust_id = $this->input->get('cust_id');

        $data['cust_id'] = $cust_id;

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
        $data['lang_add_customer'] = $this->lang->line('add_customer');
        $data['lang_export'] = $this->lang->line('export');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_mobile'] = $this->lang->line('mobile');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_action'] = $this->lang->line('action');
        $data['lang_edit'] = $this->lang->line('edit');
        $data['lang_sales_history'] = $this->lang->line('sales_history');
        $data['lang_no_match_found'] = $this->lang->line('no_match_found');
        $data['lang_full_name'] = $this->lang->line('full_name');
        $data['lang_add'] = $this->lang->line('add');
        $data['lang_back'] = $this->lang->line('back');
        $data['lang_delete_customer'] = $this->lang->line('delete_customer');
        $data['lang_update'] = $this->lang->line('update');
        $data['lang_edit_customer'] = $this->lang->line('edit_customer');
        $data['lang_create_return_order'] = $this->lang->line('create_return_order');

        $this->load->view('edit_customer', $data);
    }

    // View Customer History;
    public function customer_history() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $setting_dateformat = $paginationData[0]->datetime_format;
        $setting_currency = $paginationData[0]->currency;

        $cust_id = $this->input->get('cust_id');

        $data['cust_id'] = $cust_id;
        $data['dateformat'] = $setting_dateformat;
        $data['currency'] = $setting_currency;

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

        $data['lang_view_history_customer'] = $this->lang->line('view_history_customer');

        $this->load->view('customer_history', $data);
    }

    // Search Customer;
    public function searchcustomer() {
        $name = $this->input->get('name');
        $email = $this->input->get('email');
        $mobile = $this->input->get('mobile');

        $data['search_name'] = $name;
        $data['search_email'] = $email;
        $data['search_mobile'] = $mobile;
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
        $data['lang_add_customer'] = $this->lang->line('add_customer');
        $data['lang_export'] = $this->lang->line('export');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_mobile'] = $this->lang->line('mobile');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_action'] = $this->lang->line('action');
        $data['lang_edit'] = $this->lang->line('edit');
        $data['lang_sales_history'] = $this->lang->line('sales_history');
        $data['lang_no_match_found'] = $this->lang->line('no_match_found');
        $data['lang_search_customer'] = $this->lang->line('search_customer');
        $data['lang_create_return_order'] = $this->lang->line('create_return_order');

        $this->load->view('search_customers', $data);
    }

    // Add Customer;
    public function addCustomer() {
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
        $data['lang_add_customer'] = $this->lang->line('add_customer');
        $data['lang_export'] = $this->lang->line('export');
        $data['lang_search'] = $this->lang->line('search');
        $data['lang_name'] = $this->lang->line('name');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_mobile'] = $this->lang->line('mobile');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_action'] = $this->lang->line('action');
        $data['lang_edit'] = $this->lang->line('edit');
        $data['lang_sales_history'] = $this->lang->line('sales_history');
        $data['lang_no_match_found'] = $this->lang->line('no_match_found');
        $data['lang_full_name'] = $this->lang->line('full_name');
        $data['lang_add'] = $this->lang->line('add');
        $data['lang_back'] = $this->lang->line('back');
        $data['lang_create_return_order'] = $this->lang->line('create_return_order');

        $this->load->view('add_customer', $data);
    }

    // ****************************** View Page -- END ****************************** //
    // ****************************** Action To Database -- START ****************************** //
    // Delete Customer;
    public function deleteCustomer() {
        $cust_id = $this->input->post('cust_id');
        $cust_fn = $this->input->post('cust_fn');

        if ($this->Constant_model->deleteData('customers', $cust_id)) {
            $this->session->set_flashdata('alert_msg', array('success', 'Delete Customer', "Successfully Deleted Customer : $cust_fn."));
            redirect(base_url() . 'customers/view');
        }
    }

    // Insert New Customer;
    public function insertCustomer() {
        $fullname = $this->input->post('fullname');
        $email = $this->input->post('email');
        $mobile = $this->input->post('mobile');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($fullname)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Add Customer', 'Please enter Customer Full Name!'));
            redirect(base_url() . 'customers/addCustomer');
        } else {
            if (!empty($email)) {
                $ckEmailData = $this->Constant_model->getDataOneColumn('customers', 'email', $email);

                if (count($ckEmailData) > 0) {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Add Customer', "Email Address : $email is already existing in the system! Please try another email address!"));
                    redirect(base_url() . 'customers/addCustomer');
                    die();
                }
            }

            $ins_cust_data = array(
                'fullname' => $fullname,
                'email' => $email,
                'mobile' => $mobile,
                'created_user_id' => $us_id,
                'created_datetime' => $tm,
            );
            if ($this->Constant_model->insertData('customers', $ins_cust_data)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Add Customer', "Successfully Added Customer : $fullname"));
                redirect(base_url() . 'customers/addCustomer');
            }
        }
    }

    public function updateCustomer() {
        $cust_id = $this->input->post('cust_id');
        $fn = $this->input->post('fullname');
        $email = $this->input->post('email');
        $mb = $this->input->post('mobile');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        $upd_data = array(
            'fullname' => $fn,
            'email' => $email,
            'mobile' => $mb,
        );
        $this->Constant_model->updateData('customers', $upd_data, $cust_id);

        $this->session->set_flashdata('alert_msg', array('success', 'Update Customer', 'Successfully Updated Customer Detail!'));
        redirect(base_url() . 'customers/edit_customer?cust_id=' . $cust_id);
    }

    // ****************************** Action To Database -- END ****************************** //
    // ****************************** Export Excel -- START ********************************** //

    public function exportCustomer() {
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

        $lang_customer_report = $this->lang->line('customer_report');
        $lang_customer_fullname = $this->lang->line('full_name');
        $lang_cust_email = $this->lang->line('email');
        $lang_cust_mobile = $this->lang->line('mobile');
        $lang_total_orders = $this->lang->line('total_order');
        $lang_total_spent_amt = $this->lang->line('total_amount_spent');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "$lang_customer_report");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "$lang_customer_fullname");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "$lang_cust_email");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "$lang_cust_mobile");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "$lang_total_orders");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "$lang_total_spent_amt ($site_currency)");

        $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $jj = 3;

        $custDtaResult = $this->db->query('SELECT * FROM customers ORDER BY fullname');
        $custDtaData = $custDtaResult->result();
        for ($t = 0; $t < count($custDtaData); ++$t) {
            $cust_id = $custDtaData[$t]->id;
            $cust_fn = $custDtaData[$t]->fullname;
            $cust_em = $custDtaData[$t]->email;
            $cust_mb = $custDtaData[$t]->mobile;

            if (empty($cust_em)) {
                $cust_em = '-';
            }
            if (empty($cust_mb)) {
                $cust_mb = '-';
            }

            $total_ordered_qty = 0;
            $total_ordered_amt = 0;

            $orderData = $this->Constant_model->getDataOneColumn('orders', 'customer_id', $cust_id);
            for ($d = 0; $d < count($orderData); ++$d) {
                $order_grandTotal = $orderData[$d]->grandtotal;

                $total_ordered_amt += $order_grandTotal;

                ++$total_ordered_qty;
            }

            $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$cust_fn");
            $objPHPExcel->getActiveSheet()->setCellValue("B$jj", "$cust_em");
            $objPHPExcel->getActiveSheet()->setCellValue("C$jj", "$cust_mb");
            $objPHPExcel->getActiveSheet()->setCellValue("D$jj", "$total_ordered_qty");
            $objPHPExcel->getActiveSheet()->setCellValue("E$jj", "$total_ordered_amt");

            $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($account_value_style_header);

            unset($cust_id);
            unset($cust_fn);
            unset($cust_em);
            unset($cust_mb);

            ++$jj;
        }
        unset($custDtaResult);
        unset($custDtaData);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Customer_Report.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    public function exportCustomerHistory() {
        $cust_id = $this->input->get('cust_id');

        $siteSettingData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $site_dateformat = $siteSettingData[0]->datetime_format;
        $site_currency = $siteSettingData[0]->currency;

        $custDtaData = $this->Constant_model->getDataOneColumn('customers', 'id', "$cust_id");
        $cust_fn = $custDtaData[0]->fullname;

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

        $lang_sales_history = $this->lang->line('sales_history');
        $lang_sale_id = $this->lang->line('sale_id');
        $lang_type = $this->lang->line('type');
        $lang_date_time = $this->lang->line('date_time');
        $lang_products = $this->lang->line('products');
        $lang_qty = $this->lang->line('quantity');
        $lang_total_qty = $this->lang->line('total_quantity');
        $lang_sub_total = $this->lang->line('sub_total');
        $lang_tax = $this->lang->line('tax');
        $lang_grand_total = $this->lang->line('grand_total');
        $lang_total = $this->lang->line('total');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:I1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "$lang_sales_history : $cust_fn");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('F1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('G1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('H1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('I1')->applyFromArray($top_header_style);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "$lang_sale_id");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "$lang_type");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "$lang_date_time");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "$lang_products");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "$lang_qty");
        $objPHPExcel->getActiveSheet()->setCellValue('F2', "$lang_total_qty");
        $objPHPExcel->getActiveSheet()->setCellValue('G2', "$lang_sub_total ($site_currency)");
        $objPHPExcel->getActiveSheet()->setCellValue('H2', "$lang_tax ($site_currency)");
        $objPHPExcel->getActiveSheet()->setCellValue('I2', "$lang_grand_total ($site_currency)");

        $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('F2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('G2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('H2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('I2')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(10);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('F')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('H')->setWidth(20);
        $objPHPExcel->getActiveSheet()->getColumnDimension('I')->setWidth(20);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $jj = 3;

        $total_sub_amt = 0;
        $total_tax_amt = 0;
        $total_grand_amt = 0;

        $orderResult = $this->db->query("SELECT * FROM orders WHERE customer_id = '$cust_id' ORDER BY id DESC ");
        $orderData = $orderResult->result();
        for ($d = 0; $d < count($orderData); ++$d) {
            $order_id = $orderData[$d]->id;
            $ordered_dtm = date("$site_dateformat H:i A", strtotime($orderData[$d]->ordered_datetime));
            $subTotal = $orderData[$d]->subtotal;
            $gstTotal = $orderData[$d]->tax;
            $grandTotal = $orderData[$d]->grandtotal;
            $total_item_qty = $orderData[$d]->total_items;
            $order_type = $orderData[$d]->status;

            $total_sub_amt += $subTotal;
            $total_tax_amt += $gstTotal;
            $total_grand_amt += $grandTotal;

            $pcodeArray = array();
            $pnameArray = array();
            $qtyArray = array();
            $type_name = '';

            if ($order_type == '1') {                // Order;
                $type_name = 'Sale';

                $oItemResult = $this->db->query("SELECT * FROM order_items WHERE order_id = '$order_id' ORDER BY id ");
                $oItemRows = $oItemResult->num_rows();
                if ($oItemRows > 0) {
                    $oItemData = $oItemResult->result();

                    for ($t = 0; $t < count($oItemData); ++$t) {
                        $oItem_pcode = $oItemData[$t]->product_code;
                        $oItem_pname = $oItemData[$t]->product_name;
                        $oItem_qty = $oItemData[$t]->qty;

                        array_push($pcodeArray, $oItem_pcode);
                        array_push($pnameArray, $oItem_pname);
                        array_push($qtyArray, $oItem_qty);

                        unset($oItem_pcode);
                        unset($oItem_pname);
                        unset($oItem_qty);
                    }

                    unset($oItemData);
                }
                unset($oItemResult);
                unset($oItemRows);
            } elseif ($order_type == '2') {    // Return;
                $type_name = 'Return';

                $rItemResult = $this->db->query("SELECT * FROM return_items WHERE order_id = '$order_id' ORDER BY id ");
                $rItemRows = $rItemResult->num_rows();
                if ($rItemRows > 0) {
                    $rItemData = $rItemResult->result();
                    for ($r = 0; $r < count($rItemData); ++$r) {
                        $rItem_pcode = $rItemData[$r]->product_code;
                        $rItem_qty = $rItemData[$r]->qty;

                        $productData = $this->Constant_model->getDataOneColumn('products', 'code', $rItem_pcode);
                        $rItem_pname = $productData[0]->name;

                        array_push($pcodeArray, $rItem_pcode);
                        array_push($pnameArray, $rItem_pname);
                        array_push($qtyArray, $rItem_qty);

                        unset($rItem_pcode);
                        unset($rItem_qty);
                        unset($rItem_pname);
                    }
                    unset($rItemData);
                }
                unset($rItemResult);
                unset($rItemRows);
            }

            $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$order_id");
            $objPHPExcel->getActiveSheet()->setCellValue("B$jj", "$type_name");
            $objPHPExcel->getActiveSheet()->setCellValue("C$jj", "$ordered_dtm");

            if (count($pcodeArray) > 0) {
                $f_pcode = '';
                $f_pcode = $pnameArray[0] . ' [' . $pcodeArray[0] . ']';
                $objPHPExcel->getActiveSheet()->setCellValue("D$jj", "$f_pcode");
            } else {
                $objPHPExcel->getActiveSheet()->setCellValue("D$jj", '');
            }

            if (count($qtyArray) > 0) {
                $f_qty = '';
                $f_qty = $qtyArray[0];
                $objPHPExcel->getActiveSheet()->setCellValue("E$jj", "$f_qty");
            } else {
                $objPHPExcel->getActiveSheet()->setCellValue("E$jj", '');
            }

            $objPHPExcel->getActiveSheet()->setCellValue("F$jj", "$total_item_qty");
            $objPHPExcel->getActiveSheet()->setCellValue("G$jj", "$subTotal");
            $objPHPExcel->getActiveSheet()->setCellValue("H$jj", "$gstTotal");
            $objPHPExcel->getActiveSheet()->setCellValue("I$jj", "$grandTotal");

            $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("G$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("H$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("I$jj")->applyFromArray($account_value_style_header);

            ++$jj;

            if (count($pcodeArray) > 1) {
                for ($p = 1; $p < count($pcodeArray); ++$p) {
                    $s_pcode = '';
                    $s_qty = '';

                    $s_pcode = $pnameArray[$p] . ' [' . $pcodeArray[$p] . ']';
                    $s_qty = $qtyArray[$p];

                    $objPHPExcel->getActiveSheet()->setCellValue("A$jj", '');
                    $objPHPExcel->getActiveSheet()->setCellValue("B$jj", '');
                    $objPHPExcel->getActiveSheet()->setCellValue("C$jj", '');
                    $objPHPExcel->getActiveSheet()->setCellValue("D$jj", "$s_pcode");
                    $objPHPExcel->getActiveSheet()->setCellValue("E$jj", "$s_qty");
                    $objPHPExcel->getActiveSheet()->setCellValue("F$jj", '');
                    $objPHPExcel->getActiveSheet()->setCellValue("G$jj", '');
                    $objPHPExcel->getActiveSheet()->setCellValue("H$jj", '');
                    $objPHPExcel->getActiveSheet()->setCellValue("I$jj", '');

                    $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("G$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("H$jj")->applyFromArray($account_value_style_header);
                    $objPHPExcel->getActiveSheet()->getStyle("I$jj")->applyFromArray($account_value_style_header);

                    ++$jj;
                }
            }

            unset($order_id);
            unset($ordered_dtm);
            unset($subTotal);
            unset($gstTotal);
            unset($grandTotal);
            unset($total_item_qty);
        }
        unset($orderResult);
        unset($orderData);

        $total_sub_amt = number_format($total_sub_amt, 2, '.', '');
        $total_tax_amt = number_format($total_tax_amt, 2, '.', '');
        $total_grand_amt = number_format($total_grand_amt, 2, '.', '');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells("A$jj:F$jj");
        $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$lang_total");
        $objPHPExcel->getActiveSheet()->setCellValue("G$jj", "$total_sub_amt ($site_currency)");
        $objPHPExcel->getActiveSheet()->setCellValue("H$jj", "$total_tax_amt ($site_currency)");
        $objPHPExcel->getActiveSheet()->setCellValue("I$jj", "$total_grand_amt ($site_currency)");

        $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($text_align_style);
        $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("F$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("G$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("H$jj")->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle("I$jj")->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getRowDimension("$jj")->setRowHeight(30);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Sales_History_for_' . $cust_fn . '.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    // Search Customer;
    public function exportSearchCustomer() {
        $search_name = $this->input->get('search_name');
        $search_email = $this->input->get('search_email');
        $search_mobile = $this->input->get('search_mobile');

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

        $lang_customer_report = $this->lang->line('customer_report');
        $lang_customer_fullname = $this->lang->line('full_name');
        $lang_cust_email = $this->lang->line('email');
        $lang_cust_mobile = $this->lang->line('mobile');
        $lang_total_orders = $this->lang->line('total_order');
        $lang_total_spent_amt = $this->lang->line('total_amount_spent');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:E1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', "$lang_customer_report");

        $objPHPExcel->getActiveSheet()->getStyle('A1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('B1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('C1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('D1')->applyFromArray($top_header_style);
        $objPHPExcel->getActiveSheet()->getStyle('E1')->applyFromArray($top_header_style);

        $objPHPExcel->getActiveSheet()->setCellValue('A2', "$lang_customer_fullname");
        $objPHPExcel->getActiveSheet()->setCellValue('B2', "$lang_cust_email");
        $objPHPExcel->getActiveSheet()->setCellValue('C2', "$lang_cust_mobile");
        $objPHPExcel->getActiveSheet()->setCellValue('D2', "$lang_total_orders");
        $objPHPExcel->getActiveSheet()->setCellValue('E2', "$lang_total_spent_amt ($site_currency)");

        $objPHPExcel->getActiveSheet()->getStyle('A2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('B2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('C2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('D2')->applyFromArray($style_header);
        $objPHPExcel->getActiveSheet()->getStyle('E2')->applyFromArray($style_header);

        $objPHPExcel->getActiveSheet()->getColumnDimension('A')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('B')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(30);
        $objPHPExcel->getActiveSheet()->getColumnDimension('D')->setWidth(40);
        $objPHPExcel->getActiveSheet()->getColumnDimension('E')->setWidth(30);

        $objPHPExcel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $jj = 3;

        $sort = '';

        if (!empty($search_name)) {
            $sort .= " AND fullname LIKE '%$search_name%' ";
        }
        if (!empty($search_mobile)) {
            $sort .= " AND mobile LIKE '$search_mobile%' ";
        }
        if (!empty($search_email)) {
            $sort .= " AND email LIKE '$search_email%' ";
        }

        $custResult = $this->db->query("SELECT * FROM customers WHERE created_datetime != '0000-00-00 00:00:00' $sort ORDER BY fullname ");
        $custData = $custResult->result();
        for ($i = 0; $i < count($custData); ++$i) {
            $cust_id = $custData[$i]->id;
            $cust_fn = $custData[$i]->fullname;
            $cust_em = $custData[$i]->email;
            $cust_mb = $custData[$i]->mobile;

            if (empty($cust_em)) {
                $cust_em = '-';
            }
            if (empty($cust_mb)) {
                $cust_mb = '-';
            }

            $total_ordered_qty = 0;
            $total_ordered_amt = 0;

            $orderData = $this->Constant_model->getDataOneColumn('orders', 'customer_id', $cust_id);
            for ($d = 0; $d < count($orderData); ++$d) {
                $order_grandTotal = $orderData[$d]->grandtotal;

                $total_ordered_amt += $order_grandTotal;

                ++$total_ordered_qty;
            }

            $objPHPExcel->getActiveSheet()->setCellValue("A$jj", "$cust_fn");
            $objPHPExcel->getActiveSheet()->setCellValue("B$jj", "$cust_em");
            $objPHPExcel->getActiveSheet()->setCellValue("C$jj", "$cust_mb");
            $objPHPExcel->getActiveSheet()->setCellValue("D$jj", "$total_ordered_qty");
            $objPHPExcel->getActiveSheet()->setCellValue("E$jj", "$total_ordered_amt");

            $objPHPExcel->getActiveSheet()->getDefaultStyle("D$jj")->getAlignment()->setWrapText(true);

            $objPHPExcel->getActiveSheet()->getStyle("A$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("B$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("C$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("D$jj")->applyFromArray($account_value_style_header);
            $objPHPExcel->getActiveSheet()->getStyle("E$jj")->applyFromArray($account_value_style_header);

            unset($cust_id);
            unset($cust_fn);
            unset($cust_ln);
            unset($cust_em);
            unset($cust_mb);
            unset($house_numb);
            unset($street_name);
            unset($city);
            unset($state);
            unset($zip_code);

            ++$jj;
        }
        unset($custResult);
        unset($custData);

        // Redirect output to a client’s web browser (Excel5)
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Customer_Report_Search_Result.xls"');
        header('Cache-Control: max-age=0');
        $objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
        $objWriter->save('php://output');
    }

    // ****************************** Export Excel -- START ********************************** //
}
