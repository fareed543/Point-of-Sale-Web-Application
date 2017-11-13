<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_order extends CI_Controller {

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
        $this->load->model('Purchaseorder_model');
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
    // View Purchase Order;
    public function po_view() {
        $paginationData = $this->Constant_model->getDataOneColumn('site_setting', 'id', '1');
        $pagination_limit = $paginationData[0]->pagination;
        $setting_dateformat = $paginationData[0]->datetime_format;

        $config = array();
        $config['base_url'] = base_url() . 'purchase_order/po_view/';

        $config['display_pages'] = true;
        $config['first_link'] = 'First';

        $config['total_rows'] = $this->Purchaseorder_model->record_po_count();
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

        $data['results'] = $this->Purchaseorder_model->fetch_po_data($config['per_page'], $page);

        $data['links'] = $this->pagination->create_links();

        if ($page == 0) {
            $have_count = $this->Purchaseorder_model->record_po_count();
            $sh_text = 'Showing 1 to ' . count($data['results']) . ' of ' . $this->Purchaseorder_model->record_po_count() . ' entries';
        } else {
            $start_sh = $page + 1;
            $end_sh = $page + count($data['results']);
            $sh_text = "Showing $start_sh to $end_sh of " . $this->Purchaseorder_model->record_po_count() . ' entries';
        }

        $data['dateformat'] = $setting_dateformat;
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
        $data['lang_send_to_supplier'] = $this->lang->line('send_to_supplier');
        $data['lang_received_from_supplier'] = $this->lang->line('received_from_supplier');

        $data['lang_purchase_order_number'] = $this->lang->line('purchase_order_number');
        $data['lang_created_date'] = $this->lang->line('created_date');
        $data['lang_create_purchase_order'] = $this->lang->line('create_purchase_order');
        $data['lang_note'] = $this->lang->line('note');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_choose_supplier'] = $this->lang->line('choose_supplier');

        $this->load->view('purchase_order', $data);
    }

    // Create Purchase Order;
    public function create_purchase_order() {
        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_dateformat = $settingData->datetime_format;

        $data['dateformat'] = $setting_dateformat;

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

        $data['lang_purchase_order_number'] = $this->lang->line('purchase_order_number');
        $data['lang_created_date'] = $this->lang->line('created_date');
        $data['lang_create_purchase_order'] = $this->lang->line('create_purchase_order');
        $data['lang_note'] = $this->lang->line('note');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_choose_supplier'] = $this->lang->line('choose_supplier');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_search_product_by_namecode'] = $this->lang->line('search_product_by_namecode');

        $data['lang_product_name'] = $this->lang->line('product_name');
        $data['lang_product_code'] = $this->lang->line('product_code');
        $data['lang_order_qty'] = $this->lang->line('order_qty');

        $this->load->view('create_purchase_order', $data);
    }

    // Edit Purchase Order;
    public function editpo() {
        $id = $this->input->get('id');

        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_dateformat = $settingData->datetime_format;

        $data['dateformat'] = $setting_dateformat;
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

        $data['lang_send_to_supplier'] = $this->lang->line('send_to_supplier');
        $data['lang_received_from_supplier'] = $this->lang->line('received_from_supplier');
        $data['lang_purchase_order_number'] = $this->lang->line('purchase_order_number');
        $data['lang_created_date'] = $this->lang->line('created_date');
        $data['lang_create_purchase_order'] = $this->lang->line('create_purchase_order');
        $data['lang_note'] = $this->lang->line('note');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_choose_supplier'] = $this->lang->line('choose_supplier');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_search_product_by_namecode'] = $this->lang->line('search_product_by_namecode');
        $data['lang_product_name'] = $this->lang->line('product_name');
        $data['lang_product_code'] = $this->lang->line('product_code');
        $data['lang_order_qty'] = $this->lang->line('order_qty');
        $data['lang_update_purchase_order'] = $this->lang->line('update_purchase_order');
        $data['lang_edit_po_before_sent'] = $this->lang->line('edit_po_before_sent');
        $data['lang_purchase_order_status'] = $this->lang->line('purchase_order_status');
        $data['lang_print_purchase_order'] = $this->lang->line('print_purchase_order');
        $data['lang_sent_to_supplier'] = $this->lang->line('sent_to_supplier');

        $this->load->view('edit_purchase_order', $data);
    }

    // Receive PO;
    public function receivepo() {
        $id = $this->input->get('id');

        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_dateformat = $settingData->datetime_format;

        $data['dateformat'] = $setting_dateformat;
        $data['currency'] = $settingData->currency;
        $data['id'] = $id;

        // Get Supplier Tax;
        $poDtaData = $this->Constant_model->getDataOneColumn('purchase_order', 'id', "$id");
        $poSupplier_id = $poDtaData[0]->supplier_id;

        $supplierData = $this->Constant_model->getDataOneColumn('suppliers', 'id', "$poSupplier_id");
        $supplier_tax = $supplierData[0]->tax;

        $data['tax'] = $supplier_tax;

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

        $data['lang_send_to_supplier'] = $this->lang->line('send_to_supplier');
        $data['lang_received_from_supplier'] = $this->lang->line('received_from_supplier');
        $data['lang_purchase_order_number'] = $this->lang->line('purchase_order_number');
        $data['lang_created_date'] = $this->lang->line('created_date');
        $data['lang_create_purchase_order'] = $this->lang->line('create_purchase_order');
        $data['lang_note'] = $this->lang->line('note');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_choose_supplier'] = $this->lang->line('choose_supplier');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_search_product_by_namecode'] = $this->lang->line('search_product_by_namecode');
        $data['lang_product_name'] = $this->lang->line('product_name');
        $data['lang_product_code'] = $this->lang->line('product_code');
        $data['lang_order_qty'] = $this->lang->line('order_qty');
        $data['lang_update_purchase_order'] = $this->lang->line('update_purchase_order');
        $data['lang_edit_po_before_sent'] = $this->lang->line('edit_po_before_sent');
        $data['lang_purchase_order_status'] = $this->lang->line('purchase_order_status');
        $data['lang_print_purchase_order'] = $this->lang->line('print_purchase_order');
        $data['lang_sent_to_supplier'] = $this->lang->line('sent_to_supplier');
        $data['lang_receive_from_supplier'] = $this->lang->line('receive_from_supplier');
        $data['lang_received_from_supplier'] = $this->lang->line('received_from_supplier');
        $data['lang_ordered_quantity'] = $this->lang->line('ordered_quantity');
        $data['lang_received_quantity'] = $this->lang->line('received_quantity');
        $data['lang_each_cost'] = $this->lang->line('each_cost');

        $this->load->view('receive_purchase_order', $data);
    }

    // View PO;
    public function viewpo() {
        $id = $this->input->get('id');

        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_dateformat = $settingData->datetime_format;

        $data['dateformat'] = $setting_dateformat;
        $data['currency'] = $settingData->currency;

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

        $data['lang_send_to_supplier'] = $this->lang->line('send_to_supplier');
        $data['lang_received_from_supplier'] = $this->lang->line('received_from_supplier');
        $data['lang_purchase_order_number'] = $this->lang->line('purchase_order_number');
        $data['lang_created_date'] = $this->lang->line('created_date');
        $data['lang_create_purchase_order'] = $this->lang->line('create_purchase_order');
        $data['lang_note'] = $this->lang->line('note');
        $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
        $data['lang_choose_supplier'] = $this->lang->line('choose_supplier');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_search_product_by_namecode'] = $this->lang->line('search_product_by_namecode');
        $data['lang_product_name'] = $this->lang->line('product_name');
        $data['lang_product_code'] = $this->lang->line('product_code');
        $data['lang_order_qty'] = $this->lang->line('order_qty');
        $data['lang_update_purchase_order'] = $this->lang->line('update_purchase_order');
        $data['lang_edit_po_before_sent'] = $this->lang->line('edit_po_before_sent');
        $data['lang_purchase_order_status'] = $this->lang->line('purchase_order_status');
        $data['lang_print_purchase_order'] = $this->lang->line('print_purchase_order');
        $data['lang_sent_to_supplier'] = $this->lang->line('sent_to_supplier');
        $data['lang_receive_from_supplier'] = $this->lang->line('receive_from_supplier');
        $data['lang_received_from_supplier'] = $this->lang->line('received_from_supplier');
        $data['lang_ordered_quantity'] = $this->lang->line('ordered_quantity');
        $data['lang_received_quantity'] = $this->lang->line('received_quantity');
        $data['lang_each_cost'] = $this->lang->line('each_cost');

        $this->load->view('view_purchase_order', $data);
    }

    // ****************************** View Page -- END ****************************** //
    // ****************************** Action To Database -- START ****************************** //
    // Delete Purchase Order;
    public function deletePO() {
        $id = $this->input->get('id');
        $po_numb = $this->input->get('po_numb');

        $ckExistResult = $this->db->query("SELECT * FROM purchase_order WHERE id = '$id' ");
        $ckExistRows = $ckExistResult->num_rows();

        if ($ckExistRows == 1) {
            if ($this->Constant_model->deleteData('purchase_order', $id)) {
                $this->Constant_model->deleteByColumn('purchase_order_items', 'po_id', $id);

                $this->session->set_flashdata('alert_msg', array('success', 'Delete Purchase Order', "Successfully Deleted Purchase Order : $po_numb"));
                redirect(base_url() . 'purchase_order/po_view');
            }
        }
        unset($ckExistResult);
        unset($ckExistRows);
    }

    // Receive Items From Supplier;
    public function ReceiveItemsPO() {
        $id = $this->input->post('id');
        $outlet_id = $this->input->post('outlet_id');

        $discount = $this->input->post('discount');
        $subTotal = $this->input->post('subTotal');
        $tax = $this->input->post('tax');
        $grandTotal = $this->input->post('grandTotal');

        $supplier_tax_per = $this->input->post('dbtax');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        $existItemResult = $this->db->query("SELECT * FROM purchase_order_items WHERE po_id = '$id' ORDER BY id ASC ");
        $existItemData = $existItemResult->result();
        for ($ex = 0; $ex < count($existItemData); ++$ex) {
            $ex_item_id = $existItemData[$ex]->id;
            $ex_pcode = $existItemData[$ex]->product_code;

            if (isset($_POST["receiveQty_$ex_item_id"]) && isset($_POST["receiveCost_$ex_item_id"])) {
                $rec_qty = $this->input->post("receiveQty_$ex_item_id");
                $rec_cost = $this->input->post("receiveCost_$ex_item_id");

                if ($rec_qty > 0) {
                    $upd_po_item_data = array(
                        'received_qty' => $rec_qty,
                        'cost' => $rec_cost,
                    );

                    $this->Constant_model->updateData('purchase_order_items', $upd_po_item_data, $ex_item_id);

                    // Update Product Cost;
                    $pcodeIdResult = $this->db->query("SELECT * FROM products WHERE code = '$ex_pcode' ");
                    $pcodeIdData = $pcodeIdResult->result();
                    $pcode_id = $pcodeIdData[0]->id;

                    $upd_product_cost_data = array(
                        'purchase_price' => $rec_cost,
                    );
                    $this->Constant_model->updateData('products', $upd_product_cost_data, $pcode_id);

                    // Update Product Inventory;
                    $ckInvResult = $this->db->query("SELECT * FROM inventory WHERE product_code = '$ex_pcode' AND outlet_id = '$outlet_id' ");
                    $ckInvRows = $ckInvResult->num_rows();
                    if ($ckInvRows == 1) {
                        $ckInvData = $ckInvResult->result();
                        $ckInv_id = $ckInvData[0]->id;
                        $ckInv_qty = $ckInvData[0]->qty;

                        $combine_qty = $ckInv_qty + $rec_qty;

                        $upd_inv_data = array(
                            'qty' => $combine_qty,
                        );
                        $this->Constant_model->updateData('inventory', $upd_inv_data, $ckInv_id);
                    } else {
                        $ins_inv_data = array(
                            'product_code' => $ex_pcode,
                            'outlet_id' => $outlet_id,
                            'qty' => $rec_qty,
                        );
                        $this->Constant_model->insertData('inventory', $ins_inv_data);
                    }
                    unset($ckInvResult);
                    unset($ckInvRows);
                }
            }
        }
        unset($existItemResult);
        unset($existItemData);

        // Check Item Received or Not;
        $ckAllItemResult = $this->db->query("SELECT * FROM purchase_order_items WHERE po_id = '$id' AND received_qty = '0' ");
        $ckAllItemRows = $ckAllItemResult->num_rows();

        if ($ckAllItemRows == 0) {
            $upd_data = array(
                'status' => '3',
                'received_user_id' => $us_id,
                'received_datetime' => $tm,
                'discount_amount' => $discount,
                'subTotal' => $subTotal,
                'tax' => $tax,
                'grandTotal' => $grandTotal,
                'supplier_tax' => $supplier_tax_per,
            );
            $this->Constant_model->updateData('purchase_order', $upd_data, $id);
        }

        $this->session->set_flashdata('alert_msg', array('success', 'Update Purchase Order', 'Successfully Received Item(s) from Supplier.'));
        redirect(base_url() . 'purchase_order/receivepo?id=' . $id);
    }

    // Update Purchase Order;
    public function updatePO() {
        $id = $this->input->post('id');
        $status = $this->input->post('po_status');

        $po_numb = strip_tags($this->input->post('po_number'));
        $outlet = strip_tags($this->input->post('outlet'));
        $supplier = strip_tags($this->input->post('supplier'));
        $po_date = strip_tags($this->input->post('po_date'));
        $note = strip_tags($this->input->post('note'));

        $row_count = $this->input->post('row_count');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        if (empty($po_numb)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Purchase Order', 'Please enter Purchase Order Number!'));
            redirect(base_url() . 'purchase_order/editpo?id=' . $id);
        } elseif (empty($outlet)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Purchase Order', 'Please select Outlet for Purchase Order!'));
            redirect(base_url() . 'purchase_order/editpo?id=' . $id);
        } elseif (empty($supplier)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Purchase Order', 'Please select Supplier for Purchase Order!'));
            redirect(base_url() . 'purchase_order/editpo?id=' . $id);
        } else {

            // Check PO Number;
            $ckPOResult = $this->db->query("SELECT * FROM purchase_order WHERE po_number = '$po_numb' AND id != '$id' ");
            $ckPORows = $ckPOResult->num_rows();
            if ($ckPORows > 0) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Create Purchase Order', "Purchase Order Number : $po_numb is already existing in the system! Please try another one!"));
                redirect(base_url() . 'purchase_order/editpo?id=' . $id);
            } else {
                $supplierDtaData = $this->Constant_model->getDataOneColumn('suppliers', 'id', $supplier);

                $supplier_name = $supplierDtaData[0]->name;
                $supplier_email = $supplierDtaData[0]->email;
                $supplier_address = $supplierDtaData[0]->address;
                $supplier_tel = $supplierDtaData[0]->tel;
                $supplier_fax = $supplierDtaData[0]->fax;

                $outletDtaData = $this->Constant_model->getDataOneColumn('outlets', 'id', $outlet);
                $outlet_name = $outletDtaData[0]->name;
                $outlet_address = $outletDtaData[0]->address;
                $outlet_contact = $outletDtaData[0]->contact_number;

                $upd_po_data = array(
                    'po_number' => $po_numb,
                    'supplier_id' => $supplier,
                    'supplier_name' => $supplier_name,
                    'supplier_email' => $supplier_email,
                    'supplier_address' => $supplier_address,
                    'supplier_tel' => $supplier_tel,
                    'supplier_fax' => $supplier_fax,
                    'outlet_id' => $outlet,
                    'outlet_name' => $outlet_name,
                    'outlet_address' => $outlet_address,
                    'outlet_contact' => $outlet_contact,
                    'note' => $note,
                    'updated_user_id' => $us_id,
                    'updated_datetime' => $tm,
                    'status' => $status,
                );
                $this->Constant_model->updateData('purchase_order', $upd_po_data, $id);

                // Update Existing Item -- START;
                $existItemResult = $this->db->query("SELECT * FROM purchase_order_items WHERE po_id = '$id' ORDER BY id ASC ");
                $existItemData = $existItemResult->result();
                for ($ex = 0; $ex < count($existItemData); ++$ex) {
                    $ex_item_id = $existItemData[$ex]->id;

                    $ex_upd_qty = $this->input->post("existQty_$ex_item_id");

                    $upd_po_item_data = array(
                        'ordered_qty' => $ex_upd_qty,
                    );
                    $this->Constant_model->updateData('purchase_order_items', $upd_po_item_data, $ex_item_id);
                }
                unset($existItemResult);
                unset($existItemData);
                // Update Existing Item -- END;
                // New Item -- START;
                // PO Items;
                for ($i = 1; $i < $row_count; ++$i) {
                    $pcode = $this->input->post("pcode_$i");
                    $qty = $this->input->post("qty_$i");

                    if ($qty > 0) {
                        $ins_po_item_data = array(
                            'po_id' => $id,
                            'product_code' => $pcode,
                            'ordered_qty' => $qty,
                        );
                        $this->Constant_model->insertData('purchase_order_items', $ins_po_item_data);
                    }
                }
                // New Item -- END;

                $this->session->set_flashdata('alert_msg', array('success', 'Update Purchase Order', 'Successfully Updated Purchase Order'));
                redirect(base_url() . 'purchase_order/editpo?id=' . $id);
            }
        }
    }

    // Insert New Purchase Order;
    public function insertNewPO() {
        $po_numb = strip_tags($this->input->post('po_number'));
        $outlet = strip_tags($this->input->post('outlet'));
        $supplier = strip_tags($this->input->post('supplier'));
        $po_date = strip_tags($this->input->post('po_date'));
        $note = strip_tags($this->input->post('note'));

        $row_count = $this->input->post('row_count');

        $us_id = $this->session->userdata('user_id');
        $tm = date('Y-m-d H:i:s', time());

        $po_date = date('Y-m-d', time());

        if (empty($po_numb)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Create Purchase Order', 'Please enter Purchase Order Number!'));
            redirect(base_url() . 'purchase_order/create_purchase_order');
        } elseif (empty($outlet)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Create Purchase Order', 'Please select Outlet for Purchase Order!'));
            redirect(base_url() . 'purchase_order/create_purchase_order');
        } elseif (empty($supplier)) {
            $this->session->set_flashdata('alert_msg', array('failure', 'Create Purchase Order', 'Please select Supplier for Purchase Order!'));
            redirect(base_url() . 'purchase_order/create_purchase_order');
        } else {

            /*
              $temp_fn 	= $_FILES['uploadFile']['name'];
              if(!empty($temp_fn)){
              if ($_FILES['uploadFile']['size'] > 2048000 ){
              $this->session->set_flashdata('alert_msg', array('failure', 'Create Purchase Order', "Upload file size must be less than 2MB!"));
              redirect(base_url().'purchase_order/create_purchase_order');
              die();
              }
              }
             */

            // Check PO Number;
            $ckPOResult = $this->db->query("SELECT * FROM purchase_order WHERE po_number = '$po_numb' ");
            $ckPORows = $ckPOResult->num_rows();
            if ($ckPORows > 0) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Create Purchase Order', "Purchase Order Number : $po_numb is already existing in the system! Please try another one!"));
                redirect(base_url() . 'purchase_order/create_purchase_order');
            } else {
                $supplierDtaData = $this->Constant_model->getDataOneColumn('suppliers', 'id', $supplier);

                $supplier_name = $supplierDtaData[0]->name;
                $supplier_email = $supplierDtaData[0]->email;
                $supplier_address = $supplierDtaData[0]->address;
                $supplier_tel = $supplierDtaData[0]->tel;
                $supplier_fax = $supplierDtaData[0]->fax;

                $outletDtaData = $this->Constant_model->getDataOneColumn('outlets', 'id', $outlet);
                $outlet_name = $outletDtaData[0]->name;
                $outlet_address = $outletDtaData[0]->address;
                $outlet_contact = $outletDtaData[0]->contact_number;

                $ins_po_data = array(
                    'po_number' => $po_numb,
                    'supplier_id' => $supplier,
                    'supplier_name' => $supplier_name,
                    'supplier_email' => $supplier_email,
                    'supplier_address' => $supplier_address,
                    'supplier_tel' => $supplier_tel,
                    'supplier_fax' => $supplier_fax,
                    'outlet_id' => $outlet,
                    'outlet_name' => $outlet_name,
                    'outlet_address' => $outlet_address,
                    'outlet_contact' => $outlet_contact,
                    'po_date' => $po_date,
                    'note' => $note,
                    'created_user_id' => $us_id,
                    'created_datetime' => $tm,
                    'status' => '1',
                );
                $po_id = $this->Constant_model->insertDataReturnLastId('purchase_order', $ins_po_data);

                /*
                  $mainPhoto_fn 		= $_FILES['uploadFile']['name'];
                  if(!empty($mainPhoto_fn)){
                  $main_ext 			= pathinfo($mainPhoto_fn, PATHINFO_EXTENSION);
                  $mainPhoto_name 	= $po_id."_".time().".$main_ext";

                  // Main Photo -- START;
                  $config['upload_path'] = './assets/upload/po/';
                  $config['allowed_types'] = '*';
                  $config['file_name'] = $mainPhoto_name;
                  $this->load->library('upload', $config);

                  if ( ! $this->upload->do_upload("uploadFile")) {
                  $error = array('error' => $this->upload->display_errors());
                  } else {

                  $upd_file_name_data 	= array(
                  "attachment_file"		=>	$mainPhoto_name
                  );
                  $this->Constant_model->updateData("purchase_order", $upd_file_name_data, $po_id);

                  }
                  }
                 */

                // PO Items;
                for ($i = 1; $i < $row_count; ++$i) {
                    $pcode = $this->input->post("pcode_$i");
                    $qty = $this->input->post("qty_$i");

                    if ($qty > 0) {
                        $ins_po_item_data = array(
                            'po_id' => $po_id,
                            'product_code' => $pcode,
                            'ordered_qty' => $qty,
                        );
                        $this->Constant_model->insertData('purchase_order_items', $ins_po_item_data);
                    }
                }

                $this->session->set_flashdata('alert_msg', array('success', 'Create Purchase Order', "Successfully Created Purchase Order : $po_numb"));
                redirect(base_url() . 'purchase_order/po_view');
            }
            unset($ckPOResult);
            unset($ckPORows);
        }
    }

    // ****************************** Action To Database -- END ****************************** //

    public function searchProduct() {
        $q = $this->input->get('q');

        $array = array();

        $searchResult = $this->db->query("SELECT * FROM products WHERE code LIKE '$q%' OR name LIKE '%$q%' ");
        $searchData = $searchResult->result();

        for ($s = 0; $s < count($searchData); ++$s) {
            $search_pcode = $searchData[$s]->code;
            $search_pname = $searchData[$s]->name;

            //$search_combile 	= $search_pcode." ($search_pname)";

            $search_combile = $search_pcode;

            $array[] = $search_combile;
        }
        unset($searchResult);
        unset($searchData);

        echo json_encode($array);
    }

    public function checkPcode() {
        $pcode = $this->input->get('pcode');

        $ckPcodeResult = $this->db->query("SELECT * FROM products WHERE code = '$pcode' ");
        $ckPcodeRows = $ckPcodeResult->num_rows();

        if ($ckPcodeRows == 0) {
            $response = array(
                'errorMsg' => 'failure',
                'name' => '',
            );
        } else {
            $ckPcodeData = $ckPcodeResult->result();
            $ckPcode_name = $ckPcodeData[0]->name;

            $response = array(
                'errorMsg' => 'success',
                'name' => $ckPcode_name,
            );
        }
        echo json_encode($response);
    }

    public function deletePOItem() {
        $po_item_id = $this->input->get('po_item_id');
        $po_id = $this->input->get('po_id');

        $ckFirstData = $this->Constant_model->getDataOneColumn('purchase_order_items', 'id', $po_item_id);
        if (count($ckFirstData) == 1) {
            if ($this->Constant_model->deleteData('purchase_order_items', $po_item_id)) {
                $this->session->set_flashdata('alert_msg', array('success', 'Update Purchase Order', 'Successfully Deleted Purchase Order Item.'));
                redirect(base_url() . 'purchase_order/editpo?id=' . $po_id);
            }
        } else {
            $this->session->set_flashdata('alert_msg', array('failure', 'Update Purchase Order', 'Error on deleting Purchase Order Item!'));
            redirect(base_url() . 'purchase_order/editpo?id=' . $po_id);
        }
    }

    // Export Purchase Order to PDF;
    public function exportPurchaseOrder() {
        $id = $this->input->get('id');

        $data['id'] = $id;

        $data['lang_purchase_order'] = $this->lang->line('purchase_order');
        $data['lang_purchase_order_number'] = $this->lang->line('purchase_order_number');
        $data['lang_suppliers'] = $this->lang->line('suppliers');
        $data['lang_created_date'] = $this->lang->line('created_date');
        $data['lang_product_name'] = $this->lang->line('product_name');
        $data['lang_product_code'] = $this->lang->line('product_code');
        $data['lang_ordered_quantity'] = $this->lang->line('ordered_quantity');
        $data['lang_note'] = $this->lang->line('note');
        $data['lang_outlets'] = $this->lang->line('outlets');
        $data['lang_address'] = $this->lang->line('address');
        $data['lang_telephone'] = $this->lang->line('telephone');
        $data['lang_fax'] = $this->lang->line('fax');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_ship_to'] = $this->lang->line('ship_to');
        $data['lang_authorized_by'] = $this->lang->line('authorized_by');
        $data['lang_signature'] = $this->lang->line('signature');

        $this->load->view('print_purchase_order', $data);
    }

}
