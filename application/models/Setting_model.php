<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Setting_model extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function record_outlet_count() {
        $temp_outlet = $this->session->userdata('user_outlet');
        $temp_role = $this->session->userdata('user_role');

        if ($temp_role > 1) {
            $this->db->where('id', $temp_outlet);
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('outlets');
        $this->db->save_queries = false;

        return $query->num_rows();
    }

    public function fetch_outlet_data($limit, $start) {
        $temp_outlet = $this->session->userdata('user_outlet');
        $temp_role = $this->session->userdata('user_role');

        if ($temp_role > 1) {
            $this->db->where('id', $temp_outlet);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('outlets');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }

    public function record_user_count() {
        $temp_user_id = $user_id = $this->session->userdata('user_id');
        $temp_outlet = $this->session->userdata('user_outlet');
        $temp_role = $this->session->userdata('user_role');
        if ($temp_role == 2) {
            $this->db->where('outlet_id', $temp_outlet);
        }
        if ($temp_role == 3) {
            $this->db->where('user_id', $temp_user_id);
        }
        $this->db->order_by('user_id', 'DESC');
        $query = $this->db->get('pos_user');
        $this->db->save_queries = false;
        return $query->num_rows();
    }

    public function fetch_user_data($limit, $start) {
        $temp_user_id = $user_id = $this->session->userdata('user_id');
        $temp_outlet = $this->session->userdata('user_outlet');
        $temp_role = $this->session->userdata('user_role');
        if ($temp_role > 1) {
            $this->db->where('outlet_id', $temp_outlet);
        }
        if ($temp_role == 3) {
            $this->db->where('user_id', $temp_user_id);
        }

        $this->db->order_by('user_id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('pos_user');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }

    public function record_payment_count() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('payment_method');
        $this->db->save_queries = false;

        return $query->num_rows();
    }

    public function fetch_payment_data($limit, $start) {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('payment_method');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }

    public function record_suppliers_count() {
        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('suppliers');
        $this->db->save_queries = false;

        return $query->num_rows();
    }

    public function fetch_suppliers_data($limit, $start) {
        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('suppliers');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }

}
