<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Expenses_model extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

    public function record_expenses_count() {
        $temp_user_id = $user_id = $this->session->userdata('user_id');
        $temp_outlet = $this->session->userdata('user_outlet');
        $temp_role = $this->session->userdata('user_role');

        if ($temp_role > 1) {
            $this->db->where('outlet_id', $temp_outlet);
        }

        $this->db->order_by('id', 'DESC');
        $query = $this->db->get('expenses');
        $this->db->save_queries = false;

        return $query->num_rows();
    }

    public function fetch_expenses_data($limit, $start) {
        $temp_user_id = $user_id = $this->session->userdata('user_id');
        $temp_outlet = $this->session->userdata('user_outlet');
        $temp_role = $this->session->userdata('user_role');

        if ($temp_role > 1) {
            $this->db->where('outlet_id', $temp_outlet);
        }

        $this->db->order_by('id', 'DESC');
        $this->db->limit($limit, $start);
        $query = $this->db->get('expenses');

        $result = $query->result();

        $this->db->save_queries = false;

        return $result;
    }

}
