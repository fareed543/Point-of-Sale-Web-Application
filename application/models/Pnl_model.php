<?php

//defined('BASEPATH') OR exit('No direct script access allowed');

class Pnl_model extends CI_Model {

    public function __construct() {
        // Call the Model constructor
        parent::__construct();
        $this->load->database();
    }

}
