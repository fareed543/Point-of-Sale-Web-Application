<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth extends CI_Controller {

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
        $this->load->model('Auth_model');
        $this->load->library('form_validation');
        $this->load->helper('form');
        $this->load->helper('url');
    }

    public function index() {
        if ($this->session->userdata('user_email')) {
            redirect('dashboard', 'refresh');
        } else {
            $this->load->view('login', 'refresh');
        }
    }

    public function checkPin() {        
        $data = array(
            'pin' => $this->input->post('pin'),
        );
        $result = $this->Auth_model->verifyLogInwithPin($data);
        if ($result['valid']) {
            $response =  '1';
        } else {
            $response = '0';
        }
        /*header('Content-Type: application/json');
        echo json_encode( $arr );*/
        
        echo  $response;
    }

    public function login() {
        //$pin = $this->input->post('pin');
        if (!isset($_POST['sp_login'])) {
            $data = array(
                'pin' => $this->input->post('pin'),
            );
            $result = $this->Auth_model->verifyLogInwithPin($data);

            if ($result['valid']) {
                $user_id = $result['user_id'];
                $user_email = $result['user_email'];
                $role_id = $result['role_id'];
                $out_id = $result['outlet_id'];

                $userdata = array(
                    'sessionid' => 'pos',
                    'user_id' => $user_id,
                    'user_email' => $user_email,
                    'user_role' => $role_id,
                    'user_outlet' => $out_id,
                );

                $this->session->set_userdata($userdata);
                redirect(base_url() . 'dashboard', 'refresh');
            }
        }

        if (isset($_POST['sp_login'])) {
            $data = array(
                'email' => $this->input->post('email'),
                'password' => $this->input->post('password'),
            );

            $em = $this->input->post('email');
            $ps = $this->input->post('password');

            if (empty($em)) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Login', 'Please enter your username!'));
                redirect(base_url());
            } elseif (empty($ps)) {
                $this->session->set_flashdata('alert_msg', array('failure', 'Login', 'Please enter your password!'));
                redirect(base_url());
            } else {
                $result = $this->Auth_model->verifyLogIn($data);

                if ($result['valid']) {
                    $user_id = $result['user_id'];
                    $user_email = $result['user_email'];
                    $role_id = $result['role_id'];
                    $out_id = $result['outlet_id'];

                    $userdata = array(
                        'sessionid' => 'pos',
                        'user_id' => $user_id,
                        'user_email' => $user_email,
                        'user_role' => $role_id,
                        'user_outlet' => $out_id,
                    );

                    $this->session->set_userdata($userdata);

                    redirect(base_url() . 'dashboard', 'refresh');
                } else {
                    $this->session->set_flashdata('alert_msg', array('failure', 'Login', $result['error']));
                    redirect(base_url());
                }
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        redirect(base_url());
    }

    // Function to get the client IP address
    public function get_client_ip() {
        $ipaddress = '';
        if (getenv('HTTP_CLIENT_IP')) {
            $ipaddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipaddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipaddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipaddress = getenv('HTTP_FORWARDED');
        } elseif (getenv('REMOTE_ADDR')) {
            $ipaddress = getenv('REMOTE_ADDR');
        } else {
            $ipaddress = 'UNKNOWN';
        }

        return $ipaddress;
    }

}
