<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Constant_model extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    // Query Data from Table with Order;
    public function getDataAll($table, $order_column, $order_type) {
        $this->db->order_by("$order_column", "$order_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns;
    public function getPOSProducts($table, $col1_name, $col1_value) {


        $this->db->select('*');
        $this->db->from('products p');
        $this->db->join('inventory n', 'n.product_code = p.code', 'left');
        $this->db->where('p.status', 1);
        $query = $this->db->get();
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns;
    public function getDataOneColumn($table, $col1_name, $col1_value) {
        $this->db->where("$col1_name", $col1_value);

        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table By two columns;
    public function getDataTwoColumn($table, $col1_name, $col1_value, $col2_name, $col2_value) {

        if ($table == 'products') {
            $this->db->select('*');
            $this->db->from('products p');
            $this->db->join('inventory n', 'n.product_code = p.code', 'left');
            $this->db->where("p.".$col1_name, $col1_value);
            $this->db->where("p.".$col2_name, $col2_value);
            $query = $this->db->get();
            $result = $query->result();
            $this->db->save_queries = false;
        } else {
            $this->db->where("$col1_name", $col1_value);
            $this->db->where("$col2_name", $col2_value);

            $query = $this->db->get("$table");
            $result = $query->result();
            $this->db->save_queries = false;
        }
        return $result;
    }

    // Query Data from Table by One Columns and Sort;
    public function getDataOneColumnSortColumn($table, $col1_name, $col1_value, $sort_column, $sort_type) {
        $this->db->where("$col1_name", $col1_value);

        $this->db->order_by("$sort_column", "$sort_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Query Data from Table by One Columns and Sort;
    public function getDataTwoColumnSortColumn($table, $col1_name, $col1_value, $col2_name, $col2_value, $sort_column, $sort_type) {
        $this->db->where("$col1_name", $col1_value);
        $this->db->where("$col2_name", $col2_value);

        $this->db->order_by("$sort_column", "$sort_type");
        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Not Equal To;
    public function twoColumnNotEqual($table, $col1_name, $col1_value, $col2_name, $col2_value) {
        $this->db->where("$col1_name", $col1_value);
        $this->db->where("$col2_name != ", $col2_value);

        $query = $this->db->get("$table");
        $result = $query->result();
        $this->db->save_queries = false;

        return $result;
    }

    // Insert Data to Any Table;
    public function insertData($table, $data) {
        $this->db->insert("$table", $data);
		return $this->db->insert_id();
    }

    // Insert Data to Any Table and get the last id;
    public function insertDataReturnLastId($table, $data) {
        $this->db->insert("$table", $data);

        return $this->db->insert_id();
    }
	
	
	// Update Data to Any Table;
    public function updatePaymentMethodData($table, $data, $id) {
        $this->db->where('id', $id);
        $this->db->update("$table", $data);
        return true;
    }
	
	public function deletePaymentMethodData($table, $id) {
           
        $this->db->where('id', $id);
        $this->db->delete("$table");
        return true;
    }
	
	

    // Update Data to Any Table;
    public function updateData($table, $data, $id) {
        $this->db->where('user_id', $id);
        $this->db->update("$table", $data);

        return true;
    }

    // Delete Data from Any Table;
    public function deleteData($table, $id) {
        $this->db->where('user_id', $id);
        $this->db->delete("$table");
        return true;
    }

    public function deleteByColumn($table, $col_name, $col_value) {
        $this->db->where("$col_name", $col_value);
        $this->db->delete("$table");

        return true;
    }
     public function deleteDatabyID($table, $id) {
        $this->db->where('id', $id);
        $this->db->delete("$table");
        return true;
    }
    
      public function updateDatabyID($table, $data, $id) {
        $this->db->where('id', $id);
        $this->db->update("$table", $data);

        return true;
    }


}
