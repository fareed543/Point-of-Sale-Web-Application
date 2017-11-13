<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Sales_model extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    /*
      public function record_sales_count()
      {
      $temp_outlet = $this->session->userdata('user_outlet');
      $temp_role = $this->session->userdata('user_role');

      if ($temp_role > 1) {
      $this->db->where('outlet_id', $temp_outlet);
      }

      $today_start = date('Y-m-d 00:00:00', time());
      $today_end = date('Y-m-d 23:59:59', time());

      $this->db->where('ordered_datetime >= ', "$today_start");
      $this->db->where('ordered_datetime <= ', "$today_end");

      //$this->db->where('status', '1');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get('orders');
      $this->db->save_queries = false;

      return $query->num_rows();
      }

      public function fetch_sales_data($limit, $start)
      {
      $temp_outlet = $this->session->userdata('user_outlet');
      $temp_role = $this->session->userdata('user_role');

      if ($temp_role > 1) {
      $this->db->where('outlet_id', $temp_outlet);
      }

      $today_start = date('Y-m-d 00:00:00', time());
      $today_end = date('Y-m-d 23:59:59', time());

      $this->db->where('ordered_datetime >= ', "$today_start");
      $this->db->where('ordered_datetime <= ', "$today_end");

      //$this->db->where('status', '1');
      $this->db->order_by('id', 'DESC');
      $this->db->limit($limit, $start);
      $query = $this->db->get('orders');

      $result = $query->result();

      $this->db->save_queries = false;

      return $result;
      }
     */

    /*
      public function record_bill_count()
      {
      $temp_outlet = $this->session->userdata('user_outlet');
      $temp_role = $this->session->userdata('user_role');

      if ($temp_role > 1) {
      $this->db->where('outlet_id', $temp_outlet);
      }

      $this->db->where('status', '0');
      $this->db->order_by('id', 'DESC');
      $query = $this->db->get('suspend');
      $this->db->save_queries = false;

      return $query->num_rows();
      }
      public function fetch_bill_data($limit, $start)
      {
      $temp_outlet = $this->session->userdata('user_outlet');
      $temp_role = $this->session->userdata('user_role');

      if ($temp_role > 1) {
      $this->db->where('outlet_id', $temp_outlet);
      }

      $this->db->where('status', '0');
      $this->db->order_by('id', 'DESC');
      $this->db->limit($limit, $start);
      $query = $this->db->get('suspend');

      $result = $query->result();

      $this->db->save_queries = false;

      return $result;
      }
     */
}
