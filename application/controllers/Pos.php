<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Pos extends CI_Controller {

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
        $this->load->model('Pos_model');
        $this->load->model('Constant_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
        $this->load->library('pagination');
        $this->load->helper('email');

        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_timezone = $settingData->timezone;

        date_default_timezone_set("$setting_timezone");
    }

    public function index() {
        $settingResult = $this->db->get_where('site_setting');
        $settingData = $settingResult->row();

        $setting_tax = $settingData->tax;
        $setting_image = $settingData->display_product;

        $data['tax'] = $setting_tax;
        $data['display_prod'] = $setting_image;
        $data['keyboard'] = $settingData->display_keyboard;
        $data['pos_dateformat'] = $settingData->datetime_format;

        // Check Outlet & Role;
        $user_role = $this->session->userdata('user_role');
        $user_outlet = $this->session->userdata('user_outlet');

        $data['lang_add_customer'] = $this->lang->line('add_customer');
        $data['lang_scan_barcode'] = $this->lang->line('scan_barcode');
        $data['lang_hold'] = $this->lang->line('hold');
        $data['lang_cancel'] = $this->lang->line('cancel');
        $data['lang_qty'] = $this->lang->line('qty');
        $data['lang_per_item'] = $this->lang->line('per_item');
        $data['lang_payment'] = $this->lang->line('payment');
        $data['lang_today_sales'] = $this->lang->line('today_sales');
        $data['lang_opened_hold'] = $this->lang->line('opened_hold');
        $data['lang_total_items'] = $this->lang->line('total_items');
        $data['lang_total'] = $this->lang->line('total');
        $data['lang_discount'] = $this->lang->line('discount');
        $data['lang_tax'] = $this->lang->line('tax');
        $data['lang_total_payable'] = $this->lang->line('total_payable');
        $data['lang_products'] = $this->lang->line('products');
        $data['lang_logout'] = $this->lang->line('logout');
        $data['lang_dis_amt'] = $this->lang->line('dis_amt');
        $data['lang_search_product_by_namecode'] = $this->lang->line('search_product_by_namecode');
        $data['lang_add_new_customer'] = $this->lang->line('add_new_customer');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_customer_email'] = $this->lang->line('customer_email');
        $data['lang_customer_mobile'] = $this->lang->line('customer_mobile');
        $data['lang_add_customer'] = $this->lang->line('add_customer');
        $data['lang_success_add_cust'] = $this->lang->line('successfully_add_new_cust');
        $data['lang_opened_bill'] = $this->lang->line('opened_bill');
        $data['lang_search_opened_bills'] = $this->lang->line('search_opened_bills');
        $data['lang_ref_number'] = $this->lang->line('ref_number');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_save_to_opened_bill'] = $this->lang->line('save_to_opened_bill');
        $data['lang_hold_ref_number'] = $this->lang->line('hold_ref_number');
        $data['lang_submit'] = $this->lang->line('submit');
        $data['lang_customers'] = $this->lang->line('customers');
        $data['lang_please_add_product'] = $this->lang->line('please_add_product');
        $data['lang_total_payable_amt'] = $this->lang->line('total_payable_amt');
        $data['lang_total_purchase_items'] = $this->lang->line('total_purchase_items');
        $data['lang_paid_by'] = $this->lang->line('paid_by');
        $data['lang_cheque_number'] = $this->lang->line('cheque_number');
        $data['lang_card_number'] = $this->lang->line('card_number');
        $data['lang_paid_amt'] = $this->lang->line('paid_amt');
        $data['lang_gift_card_number'] = $this->lang->line('gift_card_number');
        $data['lang_return_change'] = $this->lang->line('return_change');
        $data['lang_submit'] = $this->lang->line('submit');
        $data['lang_out_of_stock'] = $this->lang->line('out_of_stock');
        $data['lang_please_update_inven'] = $this->lang->line('please_update_inven');

        
        /*echo "<pre>";
        print_r($data);
        exit;*/
        if ($user_role == '1') {
            if (isset($_COOKIE['outlet'])) {
                $data['outlet'] = $_COOKIE['outlet'];
                $this->load->view('pos', $data);
            } else {
                $data['lang_choose_outlet'] = $this->lang->line('choose_outlet');
                $data['lang_address'] = $this->lang->line('address');
                $data['lang_telephone'] = $this->lang->line('telephone');
                $this->load->view('choose_outlet_pos', $data);
            }
        } else {
            $data['outlet'] = $user_outlet;
            $this->load->view('pos', $data);
        }
    }

    // View Invoice;
    public function view_invoice() {
        $id = $this->input->get('id');

        $data['order_id'] = $id;

        $data['lang_address'] = $this->lang->line('address');
        $data['lang_telephone'] = $this->lang->line('telephone');
        $data['lang_sale_id'] = $this->lang->line('sale_id');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_mobile'] = $this->lang->line('mobile');
        $data['lang_products'] = $this->lang->line('products');
        $data['lang_qty'] = $this->lang->line('qty');
        $data['lang_per_item'] = $this->lang->line('per_item');
        $data['lang_total'] = $this->lang->line('total');
        $data['lang_total_items'] = $this->lang->line('total_items');
        $data['lang_sub_total'] = $this->lang->line('sub_total');
        $data['lang_tax'] = $this->lang->line('tax');
        $data['lang_grand_total'] = $this->lang->line('grand_total');
        $data['lang_paid_amt'] = $this->lang->line('paid_amt');
        $data['lang_paid_by'] = $this->lang->line('paid_by');
        $data['lang_card_number'] = $this->lang->line('card_number');
        $data['lang_cheque_number'] = $this->lang->line('cheque_number');
        $data['lang_discount'] = $this->lang->line('discount');
        $data['lang_return_change'] = $this->lang->line('return_change');
        $data['lang_unpaid_amount'] = $this->lang->line('unpaid_amount');
        $data['lang_paid_by'] = $this->lang->line('paid_by');
        $data['lang_back_to_pos'] = $this->lang->line('back_to_pos');
        $data['lang_print_small_receipt'] = $this->lang->line('print_small_receipt');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_print_a4'] = $this->lang->line('print_a4');

        $this->load->view('print_invoice', $data);
    }

    // View Invoice A4;
    public function view_invoice_a4() {
        $id = $this->input->get('id');

        $data['order_id'] = $id;

        $data['lang_address'] = $this->lang->line('address');
        $data['lang_telephone'] = $this->lang->line('telephone');
        $data['lang_sale_id'] = $this->lang->line('sale_id');
        $data['lang_date'] = $this->lang->line('date');
        $data['lang_customer_name'] = $this->lang->line('customer_name');
        $data['lang_mobile'] = $this->lang->line('mobile');
        $data['lang_products'] = $this->lang->line('products');
        $data['lang_qty'] = $this->lang->line('qty');
        $data['lang_per_item'] = $this->lang->line('per_item');
        $data['lang_total'] = $this->lang->line('total');
        $data['lang_total_items'] = $this->lang->line('total_items');
        $data['lang_sub_total'] = $this->lang->line('sub_total');
        $data['lang_tax'] = $this->lang->line('tax');
        $data['lang_grand_total'] = $this->lang->line('grand_total');
        $data['lang_paid_amt'] = $this->lang->line('paid_amt');
        $data['lang_paid_by'] = $this->lang->line('paid_by');
        $data['lang_card_number'] = $this->lang->line('card_number');
        $data['lang_cheque_number'] = $this->lang->line('cheque_number');
        $data['lang_discount'] = $this->lang->line('discount');
        $data['lang_return_change'] = $this->lang->line('return_change');
        $data['lang_unpaid_amount'] = $this->lang->line('unpaid_amount');
        $data['lang_paid_by'] = $this->lang->line('paid_by');
        $data['lang_back_to_pos'] = $this->lang->line('back_to_pos');
        $data['lang_print_small_receipt'] = $this->lang->line('print_small_receipt');
        $data['lang_email'] = $this->lang->line('email');
        $data['lang_print_a4'] = $this->lang->line('print_a4');

        $this->load->view('print_invoice_a4', $data);
    }

    // ****************************** View Page -- START ****************************** //
    // ****************************** View Page -- END ****************************** //
    // ****************************** Action To Database -- START ****************************** //
    // Update Outlet;
    public function updateOwnerOutlet() {
        $outlet_id = $this->input->get('outlet_id');

        $this->input->set_cookie('outlet', $outlet_id, 10800);
        redirect(base_url() . 'pos', 'refresh');
    }

    // Create Sales;
    public function insertSale() {


        if (isset($_POST['hold_bill_submit'])) {

            $customer = $this->input->post('customer');
            $hold_ref = $this->input->post('hold_ref');

            $row_count = $this->input->post('row_count');
            $subTotal = $this->input->post('subTotal');
            $dis_amt = $this->input->post('dis_amt');
            $grandTotal = $this->input->post('final_total_payable');
            $total_item_qty = $this->input->post('final_total_qty');
            $taxTotal = $this->input->post('tax_amt');

            $user_id = $this->session->userdata('user_id');
            $user_outlet = $this->input->post('outlet');
            $tm = date('Y-m-d H:i:s', time());

            if (empty($dis_amt)) {
                $dis_amt = 0;
            } elseif (strpos($dis_amt, '%') > 0) {
                $temp_dis_Array = explode('%', $dis_amt);
                $temp_dis = $temp_dis_Array[0];

                $temp_item_price = 0;

                for ($i = 1; $i <= $row_count; ++$i) {
                    $pcode = $this->input->post("pcode_$i");
                    $price = $this->input->post("price_$i");
                    $qty = $this->input->post("qty_$i");

                    if (!empty($pcode)) {
                        $temp_item_price += ($price * $qty);
                    }
                }

                $dis_amt = number_format(($temp_item_price * ($temp_dis / 100)), 2, '.', '');
            }

            // Get Customer Detail;
            $custDtaData = $this->Constant_model->getDataOneColumn('customers', 'id', $customer);
            $custDta_fn = $custDtaData[0]->fullname;
            $custDta_email = $custDtaData[0]->email;
            $custDta_mb = $custDtaData[0]->mobile;

            $ins_sus_data = array(
                'customer_id' => $customer,
                'fullname' => $custDta_fn,
                'email' => $custDta_email,
                'mobile' => $custDta_mb,
                'ref_number' => $hold_ref,
                'outlet_id' => $user_outlet,
                'subtotal' => $subTotal,
                'discount_total' => $dis_amt,
                'tax' => $taxTotal,
                'grandtotal' => $grandTotal,
                'total_items' => $total_item_qty,
                'created_user_id' => $user_id,
                'created_datetime' => $tm,
                'status' => '0',
				);
				$sus_id = $this->Constant_model->insertDataReturnLastId('suspend', $ins_sus_data);
				
				// Order Item -- START;
				for ($i = 1; $i <= $row_count; ++$i) {
					$pcode = $this->input->post("pcode_$i");
					$price = $this->input->post("price_$i");
					$qty = $this->input->post("qty_$i");
					
					if (!empty($pcode)) {
						$pcodeDtaData = $this->Constant_model->getDataOneColumn('products', 'code', $pcode);
						$pcode_name = $pcodeDtaData[0]->name;
						$pcode_categeory_id = $pcodeDtaData[0]->category;
						$pcode_cost = $pcodeDtaData[0]->purchase_price;
						
						$ins_sus_item_data = array(
                        'suspend_id' => $sus_id,
                        'product_code' => $pcode,
                        'product_name' => $pcode_name,
                        'product_category' => $pcode_categeory_id,
                        'product_cost' => $pcode_cost,
                        'qty' => $qty,
                        'product_price' => $price,
						);
						$this->Constant_model->insertData('suspend_items', $ins_sus_item_data);
					}
				}
				
				$this->session->set_flashdata('alert_msg', array('success', 'Add Opened Bill', 'Successfully Added to Opened Bill.'));
				redirect(base_url() . 'pos');
				} elseif (isset($_POST['add_prod_submit'])) {
				$pop_pcode = $this->input->post('pop_pcode');
				$pop_pname = $this->input->post('pop_pname');
				$pop_pcate = $this->input->post('pop_pcate');
				$pop_price = $this->input->post('pop_price');
				
				$user_id = $this->session->userdata('user_id');
				$tm = date('Y-m-d H:i:s', time());
				
				$ckProdCodeResult = $this->db->query("SELECT * FROM products WHERE code = '$pop_pcode' ");
				$ckProdCodeRows = $ckProdCodeResult->num_rows();
				
				if ($ckProdCodeRows > 0) {
				?>
                <script type="text/javascript">
                    alert("Product Code : <?php echo $pop_pcode; ?>is already existing in the system! Please try another one");
                    window.location.href = "<?= base_url() ?>pos";
				</script>
                <?php
					} else {
					$ins_prod_data = array(
                    'code' => $pop_pcode,
                    'name' => $pop_pname,
                    'category' => $pop_pcate,
                    'retail_price' => $pop_price,
                    'thumbnail' => 'no_image.jpg',
                    'created_user_id' => $user_id,
                    'created_datetime' => $tm,
                    'status' => '1',
					);
					$this->Constant_model->insertData('products', $ins_prod_data);
					
					$this->session->set_flashdata('alert_msg', array('success', 'Add New Product', 'Successfully Added New Product.'));
					redirect(base_url() . 'pos');
				}
				} else {
				
				
				
				$addi_card_numb = $this->input->post('addi_card_numb');
				$suspend_id = $this->input->post('suspend_id');
				$row_count = $this->input->post('row_count');
				$card_numb = $this->input->post('card_numb');
				
				
				$customer_id = $this->input->post('customer');
				$paid_by = $this->input->post('paid_by');
				$total_item_qty = $this->input->post('final_total_qty');
				
				
				
				if (($customer_id == 3 || $customer_id == 4)) {
					$paid_by = 0;
					$subTotal = 0;
					$dis_amt = 0;
					$grandTotal = 0;
					$taxTotal = 0;
					} else {
					$subTotal = $this->input->post('subTotal');
					$dis_amt = $this->input->post('dis_amt');
					$grandTotal = $this->input->post('final_total_payable');
					$taxTotal = $this->input->post('tax_amt');
				}
				
				
				
				$cheque = $this->input->post('cheque');
				$paid_amt = $this->input->post('paid');
				$return_change = $this->input->post('returned_change');
				
				$user_id = $this->session->userdata('user_id');
				$user_outlet = $this->input->post('outlet');
				$tm = date('Y-m-d H:i:s', time());
				
				$custDtaData = $this->Constant_model->getDataOneColumn('customers', 'id', $customer_id);
				$cust_full_name = $custDtaData[0]->fullname;
				$cust_email = $custDtaData[0]->email;
				$cust_mobile = $custDtaData[0]->mobile;
				
				$pay_name = '';
				$payNameData = $this->Constant_model->getDataOneColumn('payment_method', 'id', $paid_by);
				if (count($payNameData) == 1) {
					$pay_name = $payNameData[0]->name;
				}
				$vt_status = '';
				if ($this->input->post('advance') == 'on') {
					$advance = 1;
					$vt_status = '0';
					} else {
					$advance = 0;
					$vt_status = '1';
				}
				
				
				
				/* if ($paid_by == '6') {            // Debit;
					$vt_status = '0';
					} else {                        // Full Payment;
					$vt_status = '1';
				} */
				
				$outlet_name = '';
				$outlet_address = '';
				$outlet_contact = '';
				$outlet_footer = '';
				
				$outletDtaData = $this->Constant_model->getDataOneColumn('outlets', 'id', $user_outlet);
				$outlet_name = $outletDtaData[0]->name;
				$outlet_address = $outletDtaData[0]->address;
				$outlet_contact = $outletDtaData[0]->contact_number;
				$outlet_footer = $outletDtaData[0]->receipt_footer;
				
				$discount_percentage = '';
				
				if (empty($dis_amt)) {
					$dis_amt = 0;
					} elseif (strpos($dis_amt, '%') > 0) {
					$discount_percentage = $dis_amt;
					
					$temp_dis_Array = explode('%', $dis_amt);
					$temp_dis = $temp_dis_Array[0];
					
					$temp_item_price = 0;
					
					for ($i = 1; $i <= $row_count; ++$i) {
						$pcode = $this->input->post("pcode_$i");
						$price = $this->input->post("price_$i");
						$qty = $this->input->post("qty_$i");
						
						if (!empty($pcode)) {
							$temp_item_price += ($price * $qty);
						}
					}
					
					$dis_amt = number_format(($temp_item_price * ($temp_dis / 100)), 2, '.', '');
				}
				
				
				
				// Insert Into Order;
				$ins_order_data = array(
                'customer_id' => $customer_id,
                'customer_name' => $cust_full_name,
                'customer_email' => $cust_email,
                'customer_mobile' => $cust_mobile,
                'ordered_datetime' => $tm,
                'outlet_id' => $user_outlet,
                'outlet_name' => $outlet_name,
                'outlet_address' => $outlet_address,
                'outlet_contact' => $outlet_contact,
                'outlet_receipt_footer' => $outlet_footer,
                'gift_card' => $card_numb,
                'subtotal' => $subTotal,
                'discount_total' => $dis_amt,
                'discount_percentage' => $discount_percentage,
                'tax' => $taxTotal,
                'grandtotal' => $grandTotal,
                'total_items' => $total_item_qty,
                'payment_method' => $paid_by,
                'payment_method_name' => $pay_name,
                'cheque_number' => $cheque,
                'paid_amt' => $paid_amt,
                'return_change' => $return_change,
                'created_user_id' => $user_id,
                'created_datetime' => $tm,
                'vt_status' => $vt_status,
                'status' => '1',
                'card_number' => $addi_card_numb,
                'advance' => $advance
				);
				$order_id = $this->Constant_model->insertDataReturnLastId('orders', $ins_order_data);
				
				// Order Item -- START;
				// echo "<pre/>";
				for ($i = 1; $i <= $row_count; ++$i) {
					$pcode = $this->input->post("pcode_$i");
					$price = $this->input->post("price_$i");
					$qty = $this->input->post("qty_$i");
					// echo $pcode." " .$price." ".$qty;
					if (($customer_id == 3 || $customer_id == 4)) {
						$price = 0;
						} else {
						$price = $this->input->post("price_$i");
					}
					if (!empty($pcode)) {
						$pcode_name = '';
						$pcode_category = '0';
						$cost = 0;
						
						$pcodeDtaData = $this->Constant_model->getDataOneColumn('products', 'code', $pcode);
						if (count($pcodeDtaData) == 1) {
							$pcode_name = $pcodeDtaData[0]->name;
							$pcode_category = $pcodeDtaData[0]->category;
							$cost = $pcodeDtaData[0]->purchase_price;
							} else {
							if ($suspend_id > 0) {
								$ckSusItemResult = $this->db->query("SELECT * FROM suspend_items WHERE suspend_id = '$suspend_id' AND product_code = '$pcode' ");
								$ckSusItemRows = $ckSusItemResult->num_rows();
								if ($ckSusItemRows == 1) {
									$ckSusItemData = $ckSusItemResult->result();
									
									$pcode_name = $ckSusItemData[0]->product_name;
									$pcode_category = $ckSusItemData[0]->product_category;
									$cost = $ckSusItemData[0]->product_cost;
									
									unset($ckSusItemData);
								}
								unset($ckSusItemResult);
								unset($ckSusItemRows);
							}
						}
						
						$ins_order_item_data = array(
                        'order_id' => $order_id,
                        'product_code' => $pcode,
                        'product_name' => $pcode_name,
                        'product_category' => $pcode_category,
                        'cost' => $cost,
                        'price' => $price,
                        'qty' => $qty,
						);
						$this->Constant_model->insertData('order_items', $ins_order_item_data);
						
						// Deduction Inventory -- START;
						$ex_qty = 0;
						$ckInvData = $this->Constant_model->getDataTwoColumn('inventory', 'product_code', $pcode, 'outlet_id', $user_outlet);
						
						if (count($ckInvData) == 1) {
							$ex_inv_id = $ckInvData[0]->id;
							$ex_qty = $ckInvData[0]->qty;
							
							$deduct_qty = 0;
							$deduct_qty = $ex_qty - $qty;
							
							$upd_inv_data = array(
                            'qty' => $deduct_qty,
							);
							$this->Constant_model->updateData('inventory', $upd_inv_data, $ex_inv_id);
						}
						// Deduction Inventory -- END;
					}
				}
				// exit;
				// Order Item -- END;
				
				if ($suspend_id > 0) {
					$ckSusData = $this->Constant_model->getDataOneColumn('suspend', 'id', $suspend_id);
					
					if (count($ckSusData) == 1) {
						$upd_data = array(
                        'updated_user_id' => $user_id,
                        'updated_datetime' => $tm,
                        'status' => '1',
						);
						$this->Constant_model->updateData('suspend', $upd_data, $suspend_id);
					}
				}
				
				// Gift Card;
				if (!empty($card_numb)) {
					$ckGiftResult = $this->db->query("SELECT * FROM gift_card WHERE card_number = '$card_numb' ");
					$ckGiftRows = $ckGiftResult->num_rows();
					if ($ckGiftRows == 1) {
						$ckGiftData = $ckGiftResult->result();
						
						$ckGift_id = $ckGiftData[0]->id;
						
						$upd_gift_data = array(
                        'status' => '1',
                        'updated_user_id' => $user_id,
                        'updated_datetime' => $tm,
						);
						$this->Constant_model->updateData('gift_card', $upd_gift_data, $ckGift_id);
						
						unset($ckGiftData);
					}
					unset($ckGiftResult);
					unset($ckGiftRows);
				}
				
				redirect(base_url() . 'pos/view_invoice?id=' . $order_id, 'refresh');
			}
		}
		
		// ****************************** Action To Database -- END ****************************** //
		// Get Product Detail;
		public function getProductDetail() {
			$pcode = $this->input->get('pcode');
			$outlet_id = $this->input->get('outlet_id');
			
			$pcodeDtaData = $this->Constant_model->getDataOneColumn('products', 'code', $pcode);
			
			$prod_name = $pcodeDtaData[0]->name;
			$prod_price = $pcodeDtaData[0]->retail_price;
			
			// Check Inv;
			$qty = 0;
			$ckInvData = $this->Constant_model->getDataTwoColumn('inventory', 'product_code', $pcode, 'outlet_id', $outlet_id);
			if (count($ckInvData) > 0) {
				$qty = $ckInvData[0]->qty;
			}
			
			$response = array(
            'prod_name' => $prod_name,
            'price' => $prod_price,
            'qty' => $qty,
			);
			
			echo json_encode($response);
		}
		
		// Search Opened Bill by AJAX;
		public function getopenedBill() {
			$settingResult = $this->db->get_where('site_setting');
			$settingData = $settingResult->row();
			
			$pos_dateformat = $settingData->datetime_format;
			
			$role_id = $this->session->userdata('user_role');
			$outlet_id = $this->session->userdata('user_outlet');
			
			$search = $this->input->get('q');
			
			if (!empty($search)) {
				$searchResult = $this->db->query("SELECT * FROM suspend WHERE (ref_number LIKE '%$search%' || fullname LIKE '%$search%' || email LIKE '%$search%' || mobile LIKE '%$search%' ) AND status = '0' ");
				
				/*
					if ($role_id == '1') {
					$searchResult = $this->db->query("SELECT * FROM suspend WHERE (ref_number LIKE '%$search%' || fullname LIKE '%$search%' || email LIKE '%$search%' || mobile LIKE '%$search%' ) AND status = '0' ");
					} else {
					$searchResult = $this->db->query("SELECT * FROM suspend WHERE (ref_number LIKE '%$search%' || fullname LIKE '%$search%' || email LIKE '%$search%' || mobile LIKE '%$search%' ) AND outlet_id = '$outlet_id' AND status = '0' ");
					}
				*/
				
				$searchRows = $searchResult->num_rows();
				
				if ($searchRows > 0) {
					$searchData = $searchResult->result();
					echo '<center>';
					for ($i = 0; $i < count($searchData); ++$i) {
						$openedBill_id = $searchData[$i]->id;
						$opened_cust_id = $searchData[$i]->customer_id;
						$opened_cust_fn = $searchData[$i]->fullname;
						$openedBill_ref = $searchData[$i]->ref_number;
						$openedBill_grand = $searchData[$i]->grandtotal;
						$openedBill_item_qty = $searchData[$i]->total_items;
						$openedBill_date = date("$pos_dateformat H:i A", strtotime($searchData[$i]->created_datetime));
						
						echo '<a href="' . base_url() . 'pos?suspend_id=' . $openedBill_id . '" style="text-decoration: none;">
						<div class="col-md-5" style="background-color: #834f50; color: #FFF; margin: 7px 20px; padding-top: 10px; padding-bottom: 10px;">
						<b>Ref. No</b> : ' . $openedBill_ref . '<br />
						<b>Customer </b> : ' . $opened_cust_fn . '<br />
						<b>Date </b> : ' . $openedBill_date . '<br />
						<b>Item Qty.</b> : ' . $openedBill_item_qty . '<br /> 
						<b>Total </b> : ' . $openedBill_grand . '
						</div>
						</a>';
					}
					echo '</center>';
					} else {
					echo '<center>No Record Found!</center>';
				}
				} else {
				if ($role_id == '1') {
					$searchResult = $this->db->query("SELECT * FROM suspend WHERE status = '0' ORDER BY created_datetime DESC ");
					} else {
					$searchResult = $this->db->query("SELECT * FROM suspend WHERE status = '0' AND outlet_id = '$outlet_id' ORDER BY created_datetime DESC ");
				}
				
				$searchRows = $searchResult->num_rows();
				
				if ($searchRows > 0) {
					$searchData = $searchResult->result();
					echo '<center>';
					for ($i = 0; $i < count($searchData); ++$i) {
						$openedBill_id = $searchData[$i]->id;
						$opened_cust_id = $searchData[$i]->customer_id;
						$opened_cust_fn = $searchData[$i]->fullname;
						$openedBill_ref = $searchData[$i]->ref_number;
						$openedBill_grand = $searchData[$i]->grandtotal;
						$openedBill_item_qty = $searchData[$i]->total_items;
						$openedBill_date = date("$pos_dateformat H:i A", strtotime($searchData[$i]->created_datetime));
						
						echo '<a href="' . base_url() . 'pos?suspend_id=' . $openedBill_id . '" style="text-decoration: none;">
						<div class="col-md-5" style="background-color: #834f50; color: #FFF; margin: 7px 20px; padding-top: 10px; padding-bottom: 10px;">
						<b>Ref. No</b> : ' . $openedBill_ref . '<br />
						<b>Customer </b> : ' . $opened_cust_fn . '<br />
						<b>Date </b> : ' . $openedBill_date . '<br />
						<b>Item Qty.</b> : ' . $openedBill_item_qty . '<br /> 
						<b>Total </b> : ' . $openedBill_grand . '
						</div>
						</a>';
					}
					echo '</center>';
					} else {
					echo '<center>No Record Found!</center>';
				}
			}
		}
		
		// Send Email;
		public function send_invoice() {
			$settingResult = $this->db->get_where('site_setting');
			$settingData = $settingResult->row();
			
			$site_dateformat = $settingData->datetime_format;
			$site_name = $settingData->site_name;
			$setting_site_logo = $settingData->site_logo;
			
			$email = $this->input->post('email');
			$id = $this->input->post('id');
			
			$orderData = $this->Constant_model->getDataOneColumn('orders', 'id', $id);
			$ordered_dtm = date("$site_dateformat H:i A", strtotime($orderData[0]->ordered_datetime));
			$cust_fullname = $orderData[0]->customer_name;
			$cust_mobile = $orderData[0]->customer_mobile;
			$outlet_id = $orderData[0]->outlet_id;
			$subTotal = $orderData[0]->subtotal;
			$dis_amt = $orderData[0]->discount_total;
			$tax_amt = $orderData[0]->tax;
			$grandTotal = $orderData[0]->grandtotal;
			$us_id = $orderData[0]->created_user_id;
			$pay_method_id = $orderData[0]->payment_method;
			$pay_method_name = $orderData[0]->payment_method_name;
			$paid_amt = $orderData[0]->paid_amt;
			$return_change = $orderData[0]->return_change;
			$cheque_numb = $orderData[0]->cheque_number;
			$dis_percentage = $orderData[0]->discount_percentage;
			
			$card_numb = $orderData[0]->gift_card;
			
			$outlet_name = $orderData[0]->outlet_name;
			$outlet_address = $orderData[0]->outlet_address;
			$outlet_contact = $orderData[0]->outlet_contact;
			
			$receipt_header = '';
			$receipt_footer = $orderData[0]->outlet_receipt_footer;
			
			$staff_name = '';
			$staffData = $this->Constant_model->getDataOneColumn('users', 'id', $us_id);
			
			$staff_name = $staffData[0]->fullname;
			
			if ($pay_method_id == '5') {
				$pay_method_name = $pay_method_name . " (Cheque No. : $cheque_numb)";
			}
			
			if ($pay_method_id == '7') {
				$pay_method_name = $pay_method_name . " (Card No. : $card_numb)";
			}
			
			if (empty($cust_mobile)) {
				$cust_mobile = '-';
			}
			
			$unpaid_amt = 0;
			if (($pay_method_id == '6')) {
				$unpaid_amt = $paid_amt - $grandTotal;
			}
			
			// Send Email -- START;
			$this->load->library('email');
			$fromemail = 'noreply@pos.prosoft-apps.com';
			$toemail = "$email";
			$subject = "Receipt from $site_name";
			$mesg = '
			<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
			<html xmlns="http://www.w3.org/1999/xhtml">
			
			<head>
			<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
			<title>Reset BabyQ Password</title>
			<style type="text/css">
			
			@media only screen and (max-width: 550px), screen and (max-device-width: 550px) {
			body[yahoo] .hide {display: none!important;}
			body[yahoo] .buttonwrapper {background-color: transparent!important;}
			body[yahoo] .button {padding: 0px!important;}
			body[yahoo] .button a {background-color: #e05443; padding: 15px 15px 13px!important;}
			body[yahoo] .unsubscribe {display: block; margin-top: 20px; padding: 10px 50px; background: #2f3942; border-radius: 5px; text-decoration: none!important; font-weight: bold;}
			}
			
			/*@media only screen and (min-device-width: 601px) {
			.content {width: 600px !important;}
			.col425 {width: 425px!important;}
			.col380 {width: 380px!important;}
			}*/
			
			body { 
			max-width: 300px; 
			margin:0 auto; 
			text-align:center; 
			color:#000; 
			font-family: Arial, Helvetica, sans-serif; 
			font-size:12px; 
			}
			#wrapper { 
			min-width: 250px; 
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
			float: right; 
			text-align: right; 
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
			
			</style>
			</head>
			
			<body yahoo bgcolor="#f6f8f1" style="margin: 0; padding: 0; min-width: 100% !important;">
			<table width="100%" bgcolor="#f6f8f1" border="0" cellpadding="0" cellspacing="0">
			<tr>
			<td>
			<!--[if (gte mso 9)|(IE)]>
			<table width="600" align="center" cellpadding="0" cellspacing="0" border="0">
			<tr>
			<td>
			<![endif]-->     
			<table bgcolor="#ffffff" align="center" cellpadding="0" cellspacing="0" border="0" style="font-family: Arial, Helvetica, sans-serif; width: 100%; max-width: 600px;">
			<tr>
			<td style="padding: 30px 20px 30px 20px;">
			<table width="100%" border="0" cellspacing="0" cellpadding="0">
			<tr>
			<td style="font-size: 13px; line-height: 22px;">
			
			<div id="wrapper">
			<table border="0" style="border-collapse: collapse; width: 100%; height: auto;">
			<tr>
		    <td width="100%" align="center">
			<center>
			<img src="' . base_url() . 'assets/img/logo/' . $setting_site_logo . '" style="width: 80px;" />
			</center>
		    </td>
			</tr>
			<tr>
		    <td width="100%" align="center">
			<h2 style="padding-top: 0px; font-size: 24px;"><strong>' . $outlet_name . '</strong></h2>
		    </td>
			</tr>
			<tr>
			<td width="100%">
			<span style="width:100%; float:right; text-align:left; margin-bottom: 3px; margin-top: 3px;">Address : ' . $outlet_address . '</span>	
			<span style="width:100%; float:right; text-align:left; margin-bottom: 3px; margin-top: 3px;">Tel : ' . $outlet_contact . '</span> 
			<span style="width:100%; float:right; text-align:left; margin-bottom: 3px; margin-top: 3px;">Sale Id : ' . $id . '</span>
			<span style="width:100%; float:right; text-align:left; margin-bottom: 3px; margin-top: 3px;">Date : ' . $ordered_dtm . '</span>
			<span style="width:100%; float:right; text-align:left; margin-bottom: 3px; margin-top: 3px;">Customer Name &nbsp;: ' . $cust_fullname . '</span>
			<span style="width:100%; float:right; text-align:left; margin-bottom: 3px; margin-top: 3px;">Customer Phone : ' . $cust_mobile . '</span>
			</td>
			</tr>   
			</table>
			
			
			<div style="clear:both;"></div>
			<table class="table" cellspacing="0"  border="0"> 
			<thead> 
			<tr> 
			<th width="10%" style="border-top:1px solid #000; border-bottom: 1px solid #000;"><em>#</em></th> 
			<th width="35%" style="border-top:1px solid #000; border-bottom: 1px solid #000;" align="left">Product</th>
			<th width="10%" style="border-top:1px solid #000; border-bottom: 1px solid #000;">Quantity</th>
			<th width="25%" style="border-top:1px solid #000; border-bottom: 1px solid #000;">Per Item</th>
			<th width="20%" style="border-top:1px solid #000; border-bottom: 1px solid #000;" align="right">Subtotal</th> 
			</tr> 
			</thead> 
			<tbody>';
			
			$total_item_amt = 0;
			$total_item_qty = 0;
			
			$orderItemResult = $this->db->query("SELECT * FROM order_items WHERE order_id = '$id' ORDER BY id ");
			$orderItemData = $orderItemResult->result();
			for ($i = 0; $i < count($orderItemData); ++$i) {
				$pcode = $orderItemData[$i]->product_code;
				$name = $orderItemData[$i]->product_name;
				$qty = $orderItemData[$i]->qty;
				$price = $orderItemData[$i]->price;
				
				$each_row_price = 0;
				$each_row_price = $qty * $price;
				
				$total_item_amt += $each_row_price;
				
				$mesg .= '
				<tr>
				<td style="text-align:center; width:30px;" valign="top">' . ($i + 1) . '</td>
				<td style="text-align:left; width:130px; padding-bottom: 10px" valign="top">' . $name . '<br />[' . $pcode . ']</td>
				<td style="text-align:center; width:50px;" valign="top">' . $qty . '</td>
				<td style="text-align:center; width:50px;" valign="top">' . number_format($price, 2) . '</td>
				<td style="text-align:right; width:70px;" valign="top">' . number_format($each_row_price, 2) . '</td>
				</tr>';
				
				$total_item_qty += $qty;
				
				unset($pcode);
				unset($name);
				unset($qty);
				unset($price);
			}
			unset($orderItemResult);
			unset($orderItemData);
			
			$mesg .= '	 
			</tbody> 
			</table> 
			
			
			<table class="totals" cellspacing="0" border="0" style="margin-bottom:5px; border-top: 1px solid #000;" width="100%">
			<tbody>
			<tr>
			<td style="text-align:left; padding-top: 5px;" width="25%">Total Items</td>
			<td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;" width="25%">' . $total_item_qty . '</td>
			<td style="text-align:left; padding-left:1.5%;" width="25%">Total</td>
			<td style="text-align:right;font-weight:bold;" width="25%">' . number_format($total_item_amt, 2) . '</td>
			</tr>';
			
			if ($dis_amt > 0) {
				$mesg .= '
				<tr>
				<td style="text-align:left;"></td>
				<td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;"></td>
				<td style="text-align:left; padding-left:1.5%; padding-bottom: 5px;">Discount';
				
				if (!empty($dis_percentage)) {
					$mesg .= ' (' . $dis_percentage . ')';
				}
				
				$mesg .= '
				</td>
				<td style="text-align:right;font-weight:bold;">-' . number_format($dis_amt, 2) . '</td>
				</tr>';
			}
			
			$mesg .= '
			<tr>
			<td style="text-align:left; padding-top: 5px;">&nbsp;</td>
			<td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
			<td style="text-align:left; padding-left:1.5%;">Sub Total</td>
			<td style="text-align:right;font-weight:bold;">' . number_format($subTotal, 2) . '</td>
			</tr>
			<tr>
			<td style="text-align:left; padding-top: 5px;">&nbsp;</td>
			<td style="text-align:right; padding-right:1.5%; border-right: 1px solid #000;font-weight:bold;">&nbsp;</td>
			<td style="text-align:left; padding-left:1.5%;">Tax</td>
			<td style="text-align:right;font-weight:bold;">' . number_format($tax_amt, 2) . '</td>
			</tr>
			<tr>
			<td colspan="2" style="text-align:left; font-weight:bold; border-top:1px solid #000; padding-top:5px;">Grand Total</td>
			<td colspan="2" style="border-top:1px solid #000; padding-top:5px; text-align:right; font-weight:bold;">' . number_format($grandTotal, 2) . '</td>
    		</tr>
    		
			<tr>    
			<td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Paid</td>
			<td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;">' . number_format($paid_amt, 2) . '</td>
    		</tr>';
			
			if ($return_change > 0) {
				$mesg .= '
				<tr>
				<td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Change</td>
				<td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;">' . number_format($return_change, 2) . '</td>
				</tr>
				';
			}
			
			if ($unpaid_amt < 0) {
				$mesg .= '
				<tr>
				<td colspan="2" style="text-align:left; font-weight:bold; padding-top:5px;">Unpaid</td>
				<td colspan="2" style="padding-top:5px; text-align:right; font-weight:bold;">' . number_format($unpaid_amt, 2) . '</td>
				</tr>
				';
			}
			
			$mesg .= '
			<tr>
			<td style="text-align:left; padding-top: 5px; font-weight: bold; border-top: 1px solid #000;">Paid By : </td>
			<td style="text-align:right; padding-top: 5px; padding-right:1.5%; border-top: 1px solid #000;font-weight:bold;" colspan="3">' . $pay_method_name . '</td>
			</tr>
			</tbody>
			</table>
			<center>
			<div style="border-top:1px solid #000; padding-top:10px;">' . $receipt_footer . '</div>
			</center>
			</div>
			
			
			</td>
			</tr>
			<tr>
			<td height="20px"></td>
			</tr>
			<tr>
			<td style="font-size: 13px; line-height: 22px;">
			Sincerely,
			<Br />
			- ' . $site_name . ' 
			</td>
			</tr>
			</table>
			</td>
			</tr>
			
			
			</table>
			<!--[if (gte mso 9)|(IE)]>
			</td>
			</tr>
			</table>
			<![endif]-->
			</td>
			</tr>
			</table>
			</body>
			</html>	
			';
			
			$this->load->library('email');
			$config = array(
            'charset' => 'utf-8',
            'wordwrap' => true,
            'mailtype' => 'html',
			);
			$this->email->initialize($config);
			$this->email->to($toemail);
			$this->email->from($fromemail, "$site_name");
			$this->email->subject($subject);
			$this->email->message($mesg);
			$mail = $this->email->send();
			// Send Email -- END;
			
			return true;
		}
		
		public function addNewCustomer() {
			$fn = strip_tags($this->input->get('fn'));
			$em = strip_tags($this->input->get('em'));
			$mb = strip_tags($this->input->get('mb'));
			
			$user_id = $this->session->userdata('user_id');
			$tm = date('Y-m-d H:i:s', time());
			
			$ins_data = array(
            'fullname' => $fn,
            'email' => $em,
            'mobile' => $mb,
            'created_user_id' => $user_id,
            'created_datetime' => $tm,
			);
			$this->Constant_model->insertData('customers', $ins_data);
			
			$response = array(
            'errorMsg' => 'success',
			);
			echo json_encode($response);
		}
		
		public function loadCustomer() {
			$settingResult = $this->db->get_where('site_setting');
			$settingData = $settingResult->row();
			
			$site_default_cust_id = $settingData->default_customer_id;
			
			$getLastCustResult = $this->db->query('SELECT * FROM customers ORDER BY id ASC LIMIT 0,1');
			$getLastCustData = $getLastCustResult->result();
			
			$getLastCust_dtm = date('Y-m-d H:i:s', strtotime($getLastCustData[0]->created_datetime));
			
			unset($getLastCustResult);
			unset($getLastCustData);
			
			$current_date = date('Y-m-d H:i:s', time());
			
			$datetime1 = strtotime("$getLastCust_dtm");
			$datetime2 = strtotime("$current_date");
			$interval = abs($datetime2 - $datetime1);
			$minutes = round($interval / 60);
			
			if ($minutes <= 10) {
				$custData = $this->Constant_model->getDataAll('customers', 'id', 'DESC');
				} else {
				$custResult = $this->db->query("select * from customers order by case when id = '$site_default_cust_id' then 1 else 2 end ");
				$custData = $custResult->result();
			}
			
			$response = array('categories' => array());
			
			for ($i = 0; $i < count($custData); ++$i) {
				$cust_id = $custData[$i]->id;
				$cust_na = $custData[$i]->fullname;
				
				//Chef listings.
				$dataRow = array(
                'cust_id' => $cust_id,
                'cust_name' => $cust_na,
				);
				array_push($response['categories'], $dataRow);
			}
			
			$response['success'] = 'true';
			echo json_encode($response);
		}
		
		public function loadGiftCardValue() {
			$card_numb = $this->input->get('card_numb');
			
			$today = date('Y-m-d', time());
			
			$ckgiftResult = $this->db->query("SELECT * FROM gift_card WHERE card_number = '$card_numb' ");
			$ckgiftRows = $ckgiftResult->num_rows();
			if ($ckgiftRows == 1) {
				$ckgiftData = $ckgiftResult->result();
				
				$gift_value = $ckgiftData[0]->value;
				$gift_exp = $ckgiftData[0]->expiry_date;
				$gift_status = $ckgiftData[0]->status;
				
				if ($gift_status == '1') {
					$response = array(
                    'value' => '0',
                    'errorMsg' => 'used',
					);
					} elseif ($gift_exp < $today) {
					$response = array(
                    'value' => '0',
                    'errorMsg' => 'expired',
					);
					} else {
					$response = array(
                    'value' => $gift_value,
                    'errorMsg' => 'success',
					);
				}
				
				unset($ckgiftData);
				} else {
				$response = array(
                'value' => '0',
                'errorMsg' => 'failure',
				);
			}
			unset($ckgiftResult);
			unset($ckgiftRows);
			
			echo json_encode($response);
		}
		
		public function loadTodaySales() {
			$outlet_id = $this->input->get('outlet_id');
			
			$settingResult = $this->db->get_where('site_setting');
			$settingData = $settingResult->row();
			$setting_dateformat = $settingData->datetime_format;
			
			$today_date = date("$setting_dateformat", time());
			
			$today_start = date('Y-m-d 00:00:00', time());
			$today_end = date('Y-m-d 23:59:59', time());
			
			$total_cash = 0;
			$total_nett = 0;
			$total_visa = 0;
			$total_master = 0;
			$total_cheque = 0;
			$total_amt = 0;
			
			$orderResult = $this->db->query("SELECT * FROM orders 
			WHERE (ordered_datetime >= '$today_start' AND ordered_datetime <= '$today_end') 
			OR
			(adv_ordered_datetime >= '$today_start' AND adv_ordered_datetime <= '$today_end')
			AND outlet_id = '$outlet_id' ");
			$orderData = $orderResult->result();
			
			/* 			echo "<pre>";
				print_r($orderData);
			exit; */
			for ($i = 0; $i < count($orderData); ++$i) {
				$paidAmount = $orderData[$i]->paid_amt;
				$advPaidAmount = $orderData[$i]->adv_paid_amt;
				$grandTotal = $orderData[$i]->grandtotal;
				$payment_method = $orderData[$i]->payment_method;
				$adv_payment_method = $orderData[$i]->adv_payment_method;
				$vt_status = $orderData[$i]->vt_status;
				
				$dt = new DateTime($orderData[$i]->ordered_datetime);
				$ordered_datetime = $dt->format('Y-m-d');
				
				$advdt = new DateTime($orderData[$i]->adv_ordered_datetime);
				$adv_ordered_datetime = $advdt->format('Y-m-d');
				$return_change = $orderData[$i]->return_change;
				//$tm = date('Y-m-d H:i:s', time());
				if ($vt_status == 0) {
					if ($payment_method == '1') {
						
						if($return_change >0){
							$total_cash += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_cash += $paidAmount;
							$total_amt += $paidAmount;
						}
						
					}
					if ($payment_method == '2') {
						
						if($return_change >0){
							$total_nett += $paidAmount  - $return_change;
							$total_amt += $paidAmount  - $return_change;
							}else{
							$total_nett += $paidAmount;
							$total_amt += $paidAmount;
						}
					}
					if ($payment_method == '3') {
						if($return_change >0){
							$total_visa += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_visa += $paidAmount;
							$total_amt += $paidAmount;
							
						}
					}
					if ($payment_method == '4') {
						if($return_change >0){
							$total_master += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_master += $paidAmount;
							$total_amt += $paidAmount;
						}
					}
					if ($payment_method == '5') {
						if($return_change >0){
							$total_cheque += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_cheque += $paidAmount;
							$total_amt += $paidAmount;
						}
					}
					
					} else {
					
					
					if ($adv_payment_method == '1' && ($adv_ordered_datetime == date("Y-m-d"))) {
						$total_cash += $advPaidAmount;
						$total_amt += $advPaidAmount;
					}
					if ($payment_method == '1' && ($ordered_datetime == date("Y-m-d"))) {
						
						if($return_change >0){
							$total_cash += $paidAmount - $return_change;	
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_cash += $paidAmount;
							$total_amt += $paidAmount;
						}
					}
					
					
					if ($payment_method == '2' && ($ordered_datetime == date("Y-m-d"))) {
						if($return_change >0){
							$total_nett += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_nett += $paidAmount;
							$total_amt += $paidAmount;
							
						}
					}
					
					if ($adv_payment_method == '2' && ($adv_ordered_datetime == date("Y-m-d"))) {
						$total_nett += $advPaidAmount;
						$total_amt += $advPaidAmount;
					}
					
					if ($payment_method == '3' && ($ordered_datetime == date("Y-m-d"))) {
						
						if($return_change >0){
							$total_visa += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;	
							}else{
							$total_visa += $paidAmount;
							$total_amt += $paidAmount;
							
						}
					}
					
					if ($adv_payment_method == '3' && ($adv_ordered_datetime == date("Y-m-d"))) {
						$total_visa += $advPaidAmount;
						$total_amt += $advPaidAmount;
					}
					
					if ($adv_payment_method == '4' && ($adv_ordered_datetime == date("Y-m-d"))) {
						
						$total_master += $advPaidAmount;
						$total_amt += $advPaidAmount;
					}
					
					if ($payment_method == '4' && ($ordered_datetime == date("Y-m-d"))) {
						if($return_change >0){
							$total_master += $paidAmount - $return_change;
							$total_amt += $paidAmount - $return_change;
							}else{
							$total_master += $paidAmount;
							$total_amt += $paidAmount;
							
						}
					}
					
					
					if ($payment_method == '5' && ($ordered_datetime == date("Y-m-d"))) {
						if($return_change >0){
							$total_cheque += $paidAmount- $return_change;
							$total_amt += $paidAmount -$return_change;
							}else{
							$total_cheque += $paidAmount;
							$total_amt += $paidAmount;
						}
					}
					
					if ($adv_payment_method == '5' && ($adv_ordered_datetime == date("Y-m-d"))) {
						$total_cheque += $advPaidAmount;
						$total_amt += $advPaidAmount;
					}
				}
				
				unset($grandTotal);
				unset($payment_method);
			}
			
			unset($orderResult);
			unset($orderData);
			
			$response = array(
            'errorMsg' => 'success',
            'todaydate' => $today_date,
            'totalCash' => $total_cash,
            'totalNett' => $total_nett,
            'totalVisa' => $total_visa,
            'totalMaster' => $total_master,
            'totalCheque' => $total_cheque,
            'totalAmt' => $total_amt,
			);
			echo json_encode($response);
		}
		
	}
